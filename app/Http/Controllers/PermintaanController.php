<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PermintaanController extends Controller
{
    public function index()
    {
        $permintaans = Permintaan::all();
        return view('user.permintaan-barang', ['permintaan' => $permintaans]);
    }
    public function index2()
    {
        $permintaanPending = Permintaan::where('status', 'Pending')->get();
        $permintaanAll = Permintaan::all();
        return view('admin.kelola-permintaan', [
            'permintaanPending' => $permintaanPending,
            'permintaan' => $permintaanAll
        ]);
    }
    public function tambahPermintaanSubmit(Request $request)
    {
        $request->validate([
            'nama_pengaju' => 'required|string|max:255',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'alasan' => 'required|string',
        ]);

        Permintaan::create([
            'nama_pengaju' => $request->nama_pengaju,
            'nama_barang' => $request->nama_barang,
            'jumlah' => $request->jumlah,
            'alasan' => $request->alasan,
        ]);

        ActivityLog::create([
                'user_id' => Auth::id(),
                'actor_name' => Auth::user()->name ?? null,
                'action' => 'Create Permintaan',
                'model_type' => Permintaan::class,
                'model_id' => $request->id,
                'description' => "Tambah permintaan: {$request->nama_barang} - qty {$request->jumlah}",
        ]);
        return redirect()->route('permintaanBarang')->with('success', 'Permintaan berhasil ditambahkan!');
    }

    public function hapusPermintaan($id){
        $permintaan = Permintaan::find($id);
        $namaBarang = $permintaan->nama_barang;
        $jumlah = $permintaan->jumlah;
        $permintaan->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Delete Permintaan',
            'model_type' => Permintaan::class,
            'model_id' => $id,
            'description' => "Hapus permintaan: {$namaBarang} - qty {$jumlah}",
        ]);

        return redirect()->route('permintaanBarang')->with('success','Permintaan berhasil dihapus');
    }

    public function hapusPermintaan2($id){
        $permintaan = Permintaan::find($id);
        $namaBarang = $permintaan->nama_barang;
        $jumlah = $permintaan->jumlah;
        $permintaan->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Delete Permintaan',
            'model_type' => Permintaan::class,
            'model_id' => $id,
            'description' => "Hapus permintaan: {$namaBarang} - qty {$jumlah}",
        ]);

        return redirect()->route('kelolaPermintaan')->with('success','Permintaan berhasil dihapus');
    }

    public function approvePermintaan($id)
    {
        $permintaan = Permintaan::find($id);
        if (!$permintaan) {
            return redirect()->route('kelolaPermintaan')->with('error', 'Permintaan tidak ditemukan');
        }

        $permintaan->update(['status' => 'Approved']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Approve Permintaan',
            'model_type' => Permintaan::class,
            'model_id' => $permintaan->id,
            'description' => "Approve permintaan: {$permintaan->nama_barang} - qty {$permintaan->jumlah} (dari {$permintaan->nama_pengaju})",
        ]);

        return redirect()->route('kelolaPermintaan')->with('success', 'Permintaan disetujui!');
    }

    public function rejectPermintaan($id)
    {
        $permintaan = Permintaan::find($id);
        if (!$permintaan) {
            return redirect()->route('kelolaPermintaan')->with('error', 'Permintaan tidak ditemukan');
        }

        $permintaan->update(['status' => 'Rejected']);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Reject Permintaan',
            'model_type' => Permintaan::class,
            'model_id' => $permintaan->id,
            'description' => "Reject permintaan: {$permintaan->nama_barang} - qty {$permintaan->jumlah} (dari {$permintaan->nama_pengaju})",
        ]);

        return redirect()->route('kelolaPermintaan')->with('success', 'Permintaan ditolak!');
    }
}
