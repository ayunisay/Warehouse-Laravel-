@include('admin.admin-layout.header')    
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Kelola Supplier</h1>

        <!-- Add Supplier Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
        <h2 class="text-2xl font-bold text-gray-700 mb-4">
            edit/tambah
        </h2>
            <form method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_supp" class="block text-gray-600 font-medium mb-2">Nama Supplier</label>
                        <input type="text" id="nama_supp" name="nama_supp" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan nama supplier" value="#" required>
                    </div>
                    <div>
                        <label for="kontak" class="block text-gray-600 font-medium mb-2">Kontak</label>
                        <input type="text" id="kontak" name="kontak" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan kontak supplier" value="#" required>
                    </div>
                    <div>
                        <label for="alamat" class="block text-gray-600 font-medium mb-2">Alamat</label>
                        <input type="text" id="alamat" name="alamat" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan alamat supplier" value="#" required>
                    </div>
                </div>
                <button type="submit" name="#" class="mt-4 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                    edit/tambah
                </button>
                    <a href="kelola_supplier.php" class="mt-4 bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">Batal</a>
            </form>
        </div>

        <!-- Supplier Table -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Daftar Supplier</h2>
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
                        <tr class='hover:bg-gray-50'>
                            <td class='py-3 px-4'>no</td>
                            <td class='py-3 px-4'>nama_supp</td>
                            <td class='py-3 px-4'>kontak</td>
                            <td class='py-3 px-4'>alamat</td>
                            <td class='py-3 px-4'>
                                <a href='#' class='text-blue-500 hover:underline'>Edit</a> |
                                <a href='#' onclick=\"return confirm('Yakin ingin menghapus?')\" class='text-red-500 hover:underline'>Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='5' class='py-3 px-4 text-center text-gray-500'>Belum ada data supplier.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('admin.admin-layout.footer')