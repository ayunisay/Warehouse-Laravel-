<?php

namespace App\Http\Controllers;

use App\Models\Permintaan;
use Illuminate\Http\Request;

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

        return redirect()->route('permintaanBarang')->with('success', 'Permintaan berhasil ditambahkan!');
    }

    // public function editKategori(Kategori $kategori, $id)
    // {
    //     $kategoris = Kategori::find($id);
    //     return view('edit-kategori', ['kategori' => $kategoris]);
    // }

    // public function editKategoriSimpan(Request $request, $id){
    //     $request->validate([
    //         'nama_kategori' => 'required|string|sometimes|max:255',
    //     ]);

    //     Kategori::where('id', $id)->update([
    //         'nama_kategori' => $request->nama_kategori,
    //     ]);
    //     return redirect()->route('kategori')->with('success','Kategori berhasil diedit');
    //}

    public function hapusPermintaan($id){
        Permintaan::find($id)->delete();
        return redirect()->route('permintaanBarang')->with('success','Permintaan berhasil dihapus');
    }

    public function hapusPermintaan2($id){
        Permintaan::find($id)->delete();
        return redirect()->route('kelolaPermintaan')->with('success','Permintaan berhasil dihapus');
    }

    public function approvePermintaan($id)
    {
        $permintaan = Permintaan::find($id);
        $permintaan->update(['status' => 'Approved']);
        return redirect()->route('kelolaPermintaan')->with('success', 'Permintaan disetujui!');
    }

    public function rejectPermintaan($id)
    {
        $permintaan = Permintaan::find($id);
        $permintaan->update(['status' => 'Rejected']);
        return redirect()->route('kelolaPermintaan')->with('success', 'Permintaan ditolak!');
    }
}
