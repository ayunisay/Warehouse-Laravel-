<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
        public function viewRak(){
            $raks = Rak::all();
            return view('admin.add-rak', ['rak' => $raks]);
        }

        public function tambahRakSubmit(Request $request)
        {
            $request->validate([
                'lokasi' => 'required|string|max:255',
            ]);

            Rak::create([
                'lokasi' => $request->lokasi,
            ]);

            return redirect()->route('tambahRak')->with('success', 'Rak berhasil ditambahkan!');
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

    public function hapusRak($id){
        Rak::find($id)->delete();
        return redirect()->route('tambahRak')->with('success','Rak berhasil dihapus');
    }
}
