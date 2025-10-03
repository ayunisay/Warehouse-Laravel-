@include('user.user-layout.header')    
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Kelola Barang Keluar</h1>

        <!-- Add Item Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8 mt-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
                tambah/edit
            </h2>
            <form method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="id_barang" class="block text-gray-600 font-medium mb-2">Nama Barang</label>
                        <select id="nama_barang" name="id_barang" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            <option value='' disabled>Tidak ada kategori tersedia</option>
                        </select>
                    </div>
                    <div>
                        <label for="id_kategori" class="block text-gray-600 font-medium mb-2">Kategori</label>
                        <select id="nama_kategori" name="nama_kategori" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <option value="" disabled selected>Pilih kategori</option>
                            <option value='' disabled>Tidak ada kategori tersedia</option>
                        </select>
                    </div>
                    <div>
                        <label for="jumlah" class="block text-gray-600 font-medium mb-2">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="keluarkan jumlah barang" value="jumlah" required>
                    </div>
                    <div>
                        <label for="id_rak" class="block text-gray-600 font-medium mb-2">Lokasi Penyimpanan</label>
                        <select id="lokasi" name="lokasi" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <option value="" disabled selected>Pilih lokasi</option>
                            <option value='' disabled>Tidak ada kategori tersedia</option>
                        </select>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="keterangan" class="block text-gray-600 font-medium mb-2">Keterangan Barang Keluar</label>
                    <textarea id="keterangan" name="keterangan" rows="4" class="w-full px-2 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 text-left" placeholder="Masukkan keterangan" required></textarea>
                </div>
                <button type="submit" name="" class="mt-4 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                    edit/tambah
                </button>
                    <a href="barang_keluar.php" class="mt-4 bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">Batal</a>
            </form>
        </div>

        <!-- Stock Table -->
        <div class="bg-white shadow-md rounded-lg p-8 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Daftar Barang Keluar</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">No</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Tanggal</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Jumlah</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Keterangan</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class='hover:bg-gray-50'>
                            <td class='py-3 px-4'>no</td>
                            <td class='py-3 px-4'>nama barang</td>
                            <td class='py-3 px-4'>tanggal</td>
                            <td class='py-3 px-4'>jumlah</td>
                            <td class='py-3 px-4'>keterangan</td>
                            <td class='py-3 px-4'>
                                <a href='#' class='text-blue-500 hover:underline'>Edit</a> |
                                <a href='#' class='text-red-500 hover:underline'>Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='6' class='py-3 px-4 text-center text-gray-500'>Belum ada data barang.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('user.user-layout.footer')