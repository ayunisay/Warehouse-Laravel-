<?php

namespace App\Http\Controllers;

use App\Models\Stok;

use Illuminate\Http\Request;
use App\Models\Kategori; 
use App\Models\Rak;
use App\Models\Supplier;
class StokController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(){
        $stoks = Stok::all();
        $kategori = Kategori::all();
        $rak = Rak::all();
        $supplier = Supplier::all();
        return view('user.lihat-stok', ['stok' => $stoks, 'kategori' => $kategori, 'rak' => $rak, 'supplier' => $supplier]);
    }

    public function index2(){
        $stoks = Stok::all();
        $kategori = Kategori::all();
        $rak = Rak::all();
        $supplier = Supplier::all();
        return view('admin.kelola-stok', ['stok' => $stoks, 'kategori' => $kategori, 'rak' => $rak, 'supplier' => $supplier]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function tambahStokSubmit(Request $request)
        {
            $request->validate([
                'nama_barang' => 'required|string|max:255',
                'kategori_id' => 'required|integer|exists:kategori,id',
                'jumlah' => 'required|integer|min:1',
                'rak_id' => 'required|integer|exists:rak,id',
                'supplier_id' => 'nullable|integer|exists:supplier,id',
            ]);

            Stok::create([
                'nama_barang' => $request->nama_barang,
                'kategori_id' => $request->kategori_id,
                'jumlah' => $request->jumlah,
                'rak_id' => $request->rak_id,
                'supplier_id' => $request->supplier_id,
            ]);

            return redirect()->route('kelolaStok')->with('success', 'Stok berhasil ditambahkan!');
        }

    public function editStok($id)
    {
        $stok = Stok::with('kategori', 'rak')->find($id);
        $kategori = Kategori::all();
        $rak = Rak::all();
        $supplier = Supplier::all();
        
        if (!$stok) {
            return redirect()->route('kelolaStok')->with('error', 'Data tidak ditemukan');
        }
        return view('admin.kelola-stok-edit', compact('stok', 'kategori', 'rak', 'supplier'));
    }

    public function editStokSubmit(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori_id' => 'required|integer|exists:kategori,id',
            'jumlah' => 'required|integer|min:1',
            'rak_id' => 'required|integer|exists:rak,id',
            'supplier_id' => 'nullable|integer|exists:supplier,id',
        ]);

        $stoks = Stok::find($id);
        
        if (!$stoks) {
            return redirect()->route('kelolaStok')->with('error', 'Data tidak ditemukan');
        }

        $stoks->update([
            'nama_barang' => $request->nama_barang,
            'kategori_id' => $request->kategori_id,
            'jumlah' => $request->jumlah,
            'rak_id' => $request->rak_id,
            'supplier_id' => $request->supplier_id,
        ]);

        return redirect()->route('kelolaStok')->with('success', 'Stok berhasil diubah!');
    }

    public function hapusStok($id){
        Stok::find($id)->delete();
        return redirect()->route('kelolaStok')->with('success','Stok berhasil dihapus');
    }
}
