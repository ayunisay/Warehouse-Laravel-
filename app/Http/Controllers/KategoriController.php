<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
        public function viewKategori(){
            $kategoris = Kategori::all();
            return view('admin.add-kategori', ['kategori' => $kategoris]);
        }

        public function tambahKategoriSubmit(Request $request)
        {
            $request->validate([
                'nama_kategori' => 'required|string|max:255',
            ]);

            Kategori::create([
                'nama_kategori' => $request->nama_kategori,
            ]);

            return redirect()->route('tambahKategori')->with('success', 'Kategori berhasil ditambahkan!');
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

    public function hapusKategori($id){
        Kategori::find($id)->delete();
        return redirect()->route('tambahKategori')->with('success','Kategori berhasil dihapus');
    }
}
