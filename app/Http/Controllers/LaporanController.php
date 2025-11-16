<?php

namespace App\Http\Controllers;

use App\Models\LaporanKerusakan;
use App\Models\Stok;
use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        $laporan = LaporanKerusakan::with('stok.kategori', 'stok.rak')->get();
        $stoks = Stok::with('kategori', 'rak')->get();
        return view('user.laporan-kerusakan', ['laporan' => $laporan, 'stok' => $stoks]);
    }

    public function tambahLaporanSubmit(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|integer|exists:stoks,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        $stok = Stok::find($request->barang_id);
        if (!$stok) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan');
        }
        if ($request->jumlah > $stok->jumlah) {
            return redirect()->back()->with('error', 'Jumlah melebihi stok tersedia');
        }

        $laporan = LaporanKerusakan::create([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
            'status' => 'Pending',
        ]);

        // decrement stock immediately
        $stok->decrement('jumlah', $request->jumlah);

        // log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Create Laporan Kerusakan',
            'model_type' => LaporanKerusakan::class,
            'model_id' => $laporan->id,
            'description' => "Laporan: {$stok->nama_barang} - qty {$request->jumlah}",
        ]);

        return redirect()->route('laporanKerusakan')->with('success', 'Laporan kerusakan berhasil ditambahkan!');
    }

    public function editLaporan($id)
    {
        $laporan = LaporanKerusakan::with('stok.kategori', 'stok.rak')->find($id);
        $stoks = Stok::with('kategori', 'rak')->get();
        
        if (!$laporan) {
            return redirect()->route('laporanKerusakan')->with('error', 'Data tidak ditemukan');
        }
        
        return view('user.laporan-kerusakan-edit', compact('laporan', 'stoks'));
    }

    public function editLaporanSubmit(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|integer|exists:stoks,id',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'tanggal' => 'required|date',
        ]);

        $laporan = LaporanKerusakan::find($id);
        
        if (!$laporan) {
            return redirect()->route('laporanKerusakan')->with('error', 'Data tidak ditemukan');
        }

        $laporan->update([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'tanggal' => $request->tanggal,
        ]);

        return redirect()->route('laporanKerusakan')->with('success', 'Laporan kerusakan berhasil diubah!');
    }

    public function hapusLaporan($id)
    {
        $lap = LaporanKerusakan::find($id);
        if ($lap) {
            // restore stock
            $stok = Stok::find($lap->barang_id);
            if ($stok) {
                $stok->increment('jumlah', $lap->jumlah);
            }

            ActivityLog::create([
                'user_id' => Auth::id(),
                'actor_name' => Auth::user()->name ?? null,
                'action' => 'Delete Laporan Kerusakan',
                'model_type' => LaporanKerusakan::class,
                'model_id' => $lap->id,
                'description' => "Hapus laporan: {$stok->nama_barang} - qty {$lap->jumlah}",
            ]);

            $lap->delete();
        }

        return redirect()->route('laporanKerusakan')->with('success', 'Laporan kerusakan berhasil dihapus!');
    }

    // Admin methods
    public function index2()
    {
        $laporanPending = LaporanKerusakan::where('status', 'Pending')->with('stok.kategori', 'stok.rak')->get();
        $laporan = LaporanKerusakan::with('stok.kategori', 'stok.rak')->get();
        return view('admin.kelola-laporan-kerusakan', [
            'laporanPending' => $laporanPending,
            'laporan' => $laporan
        ]);
    }

    public function approveLaporan($id)
    {
        $laporan = LaporanKerusakan::find($id);
        
        if (!$laporan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $laporan->update(['status' => 'Approved']);
        return redirect()->back()->with('success', 'Laporan kerusakan berhasil disetujui!');
    }

    public function rejectLaporan($id)
    {
        $laporan = LaporanKerusakan::find($id);
        
        if (!$laporan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $laporan->update(['status' => 'Rejected']);
        return redirect()->back()->with('success', 'Laporan kerusakan berhasil ditolak!');
    }

    public function hapusLaporanAdmin($id)
    {
        LaporanKerusakan::destroy($id);
        return redirect()->back()->with('success', 'Laporan kerusakan berhasil dihapus!');
    }
}
