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

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Edit Laporan Kerusakan',
            'model_type' => LaporanKerusakan::class,
            'model_id' => $laporan->id,
            'description' => "Edit laporan: {$request->nama_barang} - qty {$request->jumlah}",
        ]);

        return redirect()->route('laporanKerusakan')->with('success', 'Laporan kerusakan berhasil diubah!');
    }

    public function hapusLaporan($id)
    {
        $laporan = LaporanKerusakan::find($id);
        if ($laporan) {
            // restore stock
            $stok = Stok::find($laporan->barang_id);
            if ($stok) {
                $stok->increment('jumlah', $laporan->jumlah);
            }

            ActivityLog::create([
                'user_id' => Auth::id(),
                'actor_name' => Auth::user()->name ?? null,
                'action' => 'Delete Laporan Kerusakan',
                'model_type' => LaporanKerusakan::class,
                'model_id' => $laporan->id,
                'description' => "Hapus laporan: {$stok->nama_barang} - qty {$laporan->jumlah}",
            ]);

            $laporan->delete();
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

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Approve Laporan Kerusakan',
            'model_type' => LaporanKerusakan::class,
            'model_id' => $laporan->id,
            'description' => "Approve laporan kerusakan: {$laporan->stok->nama_barang} - qty {$laporan->jumlah}",
        ]);

        return redirect()->back()->with('success', 'Laporan kerusakan berhasil disetujui!');
    }

    public function rejectLaporan($id)
    {
        $laporan = LaporanKerusakan::find($id);
        
        if (!$laporan) {
            return redirect()->back()->with('error', 'Data tidak ditemukan');
        }

        $laporan->update(['status' => 'Rejected']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Reject Laporan Kerusakan',
            'model_type' => LaporanKerusakan::class,
            'model_id' => $laporan->id,
            'description' => "Reject laporan kerusakan: {$laporan->stok->nama_barang} - qty {$laporan->jumlah}",
        ]);

        return redirect()->back()->with('success', 'Laporan kerusakan berhasil ditolak!');
    }

    public function hapusLaporanAdmin($id)
    {
        $laporan = LaporanKerusakan::find($id);
        if ($laporan) {
            $namaBarang = $laporan->stok->nama_barang ?? 'Unknown';
            $jumlah = $laporan->jumlah;
            LaporanKerusakan::destroy($id);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'actor_name' => Auth::user()->name ?? null,
                'action' => 'Delete Laporan Kerusakan',
                'model_type' => LaporanKerusakan::class,
                'model_id' => $id,
                'description' => "Hapus laporan kerusakan: {$namaBarang} - qty {$jumlah}",
            ]);
        }

        return redirect()->back()->with('success', 'Laporan kerusakan berhasil dihapus!');
    }
}
