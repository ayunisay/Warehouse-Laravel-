@include('admin.admin-layout.header')    
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Kelola Supplier</h1>

        <!-- Add Supplier Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">
            Update Supplier
        </h2>
            <form action="{{ route('editSupplierSubmit', ['id' => $supplier->id]) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_supplier" class="block text-gray-600 font-medium mb-2">
                            Nama Supplier
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_supplier" name="nama_supplier" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan nama supplier" value="{{ $supplier->nama_supplier }}" required>
                    </div>
                    <div>
                        <label for="kontak_supplier" class="block text-gray-600 font-medium mb-2">
                            Kontak
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kontak_supplier" name="kontak_supplier" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan kontak supplier" value="{{ $supplier->kontak_supplier }}" required>
                    </div>
                    <div>
                        <label for="alamat_supplier" class="block text-gray-600 font-medium mb-2">
                            Alamat
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="alamat_supplier" name="alamat_supplier" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan alamat supplier" value="{{ $supplier->alamat_supplier }}" required>
                    </div>
                </div>
                <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                    Update Supplier
                </button>
                    <a href="{{ route('kelolaSupplier') }}" class="mt-4 bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">Batal</a>
            </form>
        </div>
    </div>
@include('admin.admin-layout.footer')