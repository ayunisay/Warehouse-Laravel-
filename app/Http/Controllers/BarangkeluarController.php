<?php

namespace App\Http\Controllers;

use App\Models\BarangKeluar;
use App\Models\Stok;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BarangkeluarController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $barangKeluar = BarangKeluar::with('stok.kategori', 'stok.rak')->get();
        $stoks = Stok::with('kategori', 'rak')->get();
        return view('user.barang-keluar', compact('barangKeluar', 'stoks'));
    }

    public function index2()
    {
        $barangKeluar = BarangKeluar::with('stok.kategori', 'stok.rak')->get();
        $stoks = Stok::with('kategori', 'rak')->get();
        return view('admin.riwayat', compact('barangKeluar', 'stoks'));
    }

    /**
     * Get item details for dropdown selection
     */
    public function getItemDetails($id)
    {
        $stok = Stok::with('kategori', 'rak')->find($id);
        
        if (!$stok) {
            return response()->json(['error' => 'Item not found'], 404);
        }
        
        return response()->json([
            'nama_barang' => $stok->nama_barang,
            'kategori_id' => $stok->kategori_id,
            'kategori_nama' => $stok->kategori->nama_kategori ?? 'N/A',
            'rak_id' => $stok->rak_id,
            'rak_lokasi' => $stok->rak->lokasi ?? 'N/A',
            'stok_tersedia' => $stok->jumlah,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahBarangKeluarSubmit(Request $request)
    {
        $request->validate([
            'barang_id' => 'required|integer|exists:stoks,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        // Check stock availability
        $stok = Stok::find($request->barang_id);
        if (!$stok) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan');
        }

        if ($request->jumlah > $stok->jumlah) {
            return redirect()->back()->with('error', 'Jumlah melebihi stok tersedia');
        }

        // Create barang keluar
        $bk = BarangKeluar::create([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan,
        ]);

        // Decrement stock
        $stok->decrement('jumlah', $request->jumlah);

        // Log activity
        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Create Barang Keluar',
            'model_type' => BarangKeluar::class,
            'model_id' => $bk->id,
            'description' => "Keluar: {$stok->nama_barang} - qty {$request->jumlah}",
        ]);

        return redirect()->route('barangKeluar')->with('success', 'Barang Keluar berhasil ditambahkan!');
    }

    /**
     * Edit barang keluar
     */
    public function editBarangKeluar($id)
    {
        $barangKeluar = BarangKeluar::with('stok.kategori', 'stok.rak')->find($id);
        $stoks = Stok::with('kategori', 'rak')->get();
        
        if (!$barangKeluar) {
            return redirect()->route('barangKeluar')->with('error', 'Data tidak ditemukan');
        }
        
        return view('user.barang-keluar-edit', compact('barangKeluar', 'stoks'));
    }

    /**
     * Update barang keluar
     */
    public function editBarangKeluarSubmit(Request $request, $id)
    {
        $request->validate([
            'barang_id' => 'required|integer|exists:stoks,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_keluar' => 'required|date',
            'keterangan' => 'required|string',
        ]);

        $barangKeluar = BarangKeluar::find($id);
        
        if (!$barangKeluar) {
            return redirect()->route('barangKeluar')->with('error', 'Data tidak ditemukan');
        }


        // restore previous stok then decrement new
        $oldStok = Stok::find($barangKeluar->barang_id);
        if ($oldStok) {
            $oldStok->increment('jumlah', $barangKeluar->jumlah);
        }

        $newStok = Stok::find($request->barang_id);
        if (!$newStok) {
            return redirect()->back()->with('error', 'Barang tidak ditemukan');
        }
        if ($request->jumlah > $newStok->jumlah) {
            // rollback restore
            if ($oldStok) { $oldStok->decrement('jumlah', $barangKeluar->jumlah); }
            return redirect()->back()->with('error', 'Jumlah melebihi stok tersedia');
        }

        $barangKeluar->update([
            'barang_id' => $request->barang_id,
            'jumlah' => $request->jumlah,
            'tanggal_keluar' => $request->tanggal_keluar,
            'keterangan' => $request->keterangan,
        ]);

        $newStok->decrement('jumlah', $request->jumlah);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Edit Barang Keluar',
            'model_type' => BarangKeluar::class,
            'model_id' => $barangKeluar->id,
            'description' => "Edit keluar: {$newStok->nama_barang} - qty {$request->jumlah}",
        ]);

        return redirect()->route('barangKeluar')->with('success', 'Barang Keluar berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function hapusBarangKeluar(string $id)
    {
        $bk = BarangKeluar::find($id);
        if ($bk) {
            // restore stock
            $stok = Stok::find($bk->barang_id);
            if ($stok) {
                $stok->increment('jumlah', $bk->jumlah);
            }

            ActivityLog::create([
                'user_id' => Auth::id(),
                'actor_name' => Auth::user()->name ?? null,
                'action' => 'Delete Barang Keluar',
                'model_type' => BarangKeluar::class,
                'model_id' => $bk->id,
                'description' => "Hapus keluar: {$stok->nama_barang} - qty {$bk->jumlah}",
            ]);

            $bk->delete();
        }
        return redirect()->route('barangKeluar')->with('success', 'Data Barang Keluar berhasil dihapus!');
    }
}
