<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Models\Stok;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $supplier = Supplier::create([
            'nama_supplier' => $request->nama_supplier,
            'kontak_supplier' => $request->kontak_supplier,
            'alamat_supplier' => $request->alamat_supplier,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Create Supplier',
            'model_type' => Supplier::class,
            'model_id' => $supplier->id,
            'description' => "Tambah supplier: {$request->nama_supplier}",
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

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Edit Supplier',
            'model_type' => Supplier::class,
            'model_id' => $supplier->id,
            'description' => "Edit supplier: {$request->nama_supplier}",
        ]);

        return redirect()->route('kelolaSupplier')->with('success', 'Supplier berhasil diupdate!');
    }

    public function hapusSupplier($id){
        // Prevent deleting a supplier if there are stok records linked to it
        $hasStok = Stok::where('supplier_id', $id)->exists();
        if ($hasStok) {
            return redirect()->route('kelolaSupplier')->with('error', 'Supplier tidak dapat dihapus karena masih ada stok terkait.');
        }

        $supplier = Supplier::find($id);
        $supplierName = $supplier->nama_supplier;
        $supplier->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Delete Supplier',
            'model_type' => Supplier::class,
            'model_id' => $id,
            'description' => "Hapus supplier: {$supplierName}",
        ]);

        return redirect()->route('kelolaSupplier')->with('success','Supplier berhasil dihapus');
    }
}
