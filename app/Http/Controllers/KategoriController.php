<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Models\Stok;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            $kategori = Kategori::create([
                'nama_kategori' => $request->nama_kategori,
            ]);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'actor_name' => Auth::user()->name ?? null,
                'action' => 'Create Kategori',
                'model_type' => Kategori::class,
                'model_id' => $kategori->id,
                'description' => "Tambah kategori: {$request->nama_kategori}",
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
        // Prevent deleting a category if there are stok records linked to it
        $hasStok = Stok::where('kategori_id', $id)->exists();
        if ($hasStok) {
            return redirect()->route('tambahKategori')->with('error', 'Kategori tidak dapat dihapus karena masih ada stok terkait.');
        }

        $kategori = Kategori::find($id);
        if ($kategori) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'actor_name' => Auth::user()->name ?? null,
                'action' => 'Delete Kategori',
                'model_type' => Kategori::class,
                'model_id' => $kategori->id,
                'description' => "Hapus kategori: {$kategori->nama_kategori}",
            ]);
            $kategori->delete();
        }
        return redirect()->route('tambahKategori')->with('success','Kategori berhasil dihapus');
    }
}
