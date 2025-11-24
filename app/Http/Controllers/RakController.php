<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use App\Models\Stok;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            $rak = Rak::create([
                'lokasi' => $request->lokasi,
            ]);

            ActivityLog::create([
                'user_id' => Auth::id(),
                'actor_name' => Auth::user()->name ?? null,
                'action' => 'Create Rak',
                'model_type' => Rak::class,
                'model_id' => $rak->id,
                'description' => "Tambah rak: {$request->lokasi}",
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
        // Prevent deleting a rak if there are stok records linked to it
        $hasStok = Stok::where('rak_id', $id)->exists();
        if ($hasStok) {
            return redirect()->route('tambahRak')->with('error', 'Rak tidak dapat dihapus karena masih ada stok terkait.');
        }

        $rak = Rak::find($id);
        if ($rak) {
            ActivityLog::create([
                'user_id' => Auth::id(),
                'actor_name' => Auth::user()->name ?? null,
                'action' => 'Delete Rak',
                'model_type' => Rak::class,
                'model_id' => $rak->id,
                'description' => "Hapus rak: {$rak->lokasi}",
            ]);
            $rak->delete();
        }
        return redirect()->route('tambahRak')->with('success','Rak berhasil dihapus');
    }
}
