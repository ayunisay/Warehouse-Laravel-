@include('admin.admin-layout.header')    
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Kelola Supplier</h1>

        <!-- Add Supplier Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">
            Tambah Supplier
        </h2>
            <form action="{{ route('tambahSupplierSubmit') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_supplier" class="block text-gray-600 font-medium mb-2">
                            Nama Supplier
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_supplier" name="nama_supplier" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan nama supplier" required>
                    </div>
                    <div>
                        <label for="kontak_supplier" class="block text-gray-600 font-medium mb-2">
                            Kontak
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="kontak_supplier" name="kontak_supplier" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan kontak supplier" required>
                    </div>
                    <div>
                        <label for="alamat_supplier" class="block text-gray-600 font-medium mb-2">
                            Alamat
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="alamat_supplier" name="alamat_supplier" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan alamat supplier" required>
                    </div>
                </div>
                <button type="submit" name="add_supplier" class="mt-4 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300 mr-3">
                    Tambah Supplier
                </button>
                    <a href="{{ route('kelolaSupplier') }}" class="mt-4 bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">Batal</a>
            </form>
        </div>

        <!-- Supplier Table -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
                Daftar Supplier
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">No</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Supplier</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Kontak</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Alamat</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if (empty($supplier) || $supplier->isEmpty())
                            <tr>
                                <td colspan="8" class="py-3 px-4 text-center text-gray-500">Belum ada data supplier</td>
                            </tr>
                        @else
                            @foreach ($supplier as $suppliers)
                                <tr class='hover:bg-gray-50'>
                                    <td class='py-3 px-4'>{{ $loop->iteration }}</td>
                                    <td class='py-3 px-4'>{{ $suppliers -> nama_supplier }}</td>
                                    <td class='py-3 px-4'>{{ $suppliers -> kontak_supplier }}</td>
                                    <td class='py-3 px-4'>{{ $suppliers -> alamat_supplier }}</td>
                                    <td class='py-3 px-4'>
                                        <a href='{{ route('editSupplier', ['id' => $suppliers->id]) }}' class='text-blue-500 hover:underline mr-3'>Edit</a> |
                                        <form action="{{ route('hapusSupplier', ['id'=>$suppliers->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus supplier ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline ml-3">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('admin.admin-layout.footer')