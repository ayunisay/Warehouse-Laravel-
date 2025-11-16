<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){
        $supplier = Supplier::all();
        return view('admin.kelola-supplier', ['supplier' => $supplier]);
    }

    public function tambahSupplierSubmit(Request $request)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'kontak_supplier' => 'required|string|max:255',
            'alamat_supplier' => 'required|string|max:255',
        ]);

        Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'kontak_supplier' => $request->kontak_supplier,
            'alamat_supplier' => $request->alamat_supplier,
        ]);

        return redirect()->route('kelolaSupplier')->with('success', 'Supplier berhasil ditambahkan!');
    }

    public function editSupplier($id)
    {
        $supplier = Supplier::find($id);
        
        if (!$supplier) {
            return redirect()->route('kelolaSupplier')->with('error', 'Data tidak ditemukan');
        }
        return view('admin.kelola-supplier-edit', compact('supplier'));
    }

    public function editSupplierSubmit(Request $request, $id)
    {
        $request->validate([
            'nama_supplier' => 'required|string|max:255',
            'kontak_supplier' => 'required|string|max:255',
            'alamat_supplier' => 'required|string|max:255',
        ]);

        $supplier = Supplier::find($id);

        if (!$supplier) {
            return redirect()->route('kelolaSupplier')->with('error', 'Data tidak ditemukan');
        }

        $supplier->update([
            'nama_supplier' => $request->nama_supplier,
            'kontak_supplier' => $request->kontak_supplier,
            'alamat_supplier' => $request->alamat_supplier,
        ]);

        return redirect()->route('kelolaSupplier')->with('success', 'Supplier berhasil diupdate!');
    }

    public function hapusSupplier($id){
        Supplier::find($id)->delete();
        return redirect()->route('kelolaSupplier')->with('success','Supplier berhasil dihapus');
    }
}
