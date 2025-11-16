@include('admin.admin-layout.header')
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Kelola Stok</h1>


        <div class="mt-8 bg-white shadow-md rounded-lg p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Add Kategori -->
                <a href="{{ route('tambahKategori') }}" class="group block bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="bg-white bg-opacity-20 p-3 rounded-full">
                            <!-- Ikon Baru: Ikon Folder -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2V7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Add Kategori</h3>
                            <p class="text-sm text-white text-opacity-80">Tambah kategori barang</p>
                        </div>
                    </div>
                </a>

                <!-- Add Rak -->
                <a href="{{ route('tambahRak') }}" class="group block bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="bg-white bg-opacity-20 p-3 rounded-full">
                            <!-- Ikon Baru: Ikon Rak -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Add New Rak</h3>
                            <p class="text-sm text-white text-opacity-80">Tambah lokasi penyimpanan</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Add Item Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
                Tambah Stok Barang
            </h2>
            <form action="{{ route('tambahStokSubmit') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="nama_barang" class="block text-gray-600 font-medium mb-2">
                            Nama Barang
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_barang" name="nama_barang" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan nama barang" value="" required>
                    </div>
                    <div>
                        <label for="kategori_id" class="block text-gray-600 font-medium mb-2">
                            Kategori
                            <span class="text-red-500">*</span>
                        </label>
                        <select id="kategori_id" name="kategori_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <option value="" disabled selected>Pilih kategori</option>
                            @if (empty($kategori) || $kategori->isEmpty())
                                <option value='' disabled>Tidak ada kategori tersedia</option>
                            @else
                                @foreach ($kategori as $kategoris)
                                    <option value='{{ $kategoris->id }}'>{{ $kategoris->nama_kategori }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="rak_id" class="block text-gray-600 font-medium mb-2">
                            Lokasi Penyimpanan
                            <span class="text-red-500">*</span>
                        </label>
                        <select id="rak_id" name="rak_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                            <option value='' disabled selected>Pilih lokasi</option>
                            @if (empty($rak) || $rak->isEmpty())
                                <option value='' disabled>Tidak ada lokasi tersedia</option>
                            @else
                                @foreach ($rak as $raks)
                                    <option value='{{ $raks->id }}'>{{ $raks->lokasi }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        <label for="supplier_id" class="block text-gray-600 font-medium mb-2">
                            Supplier
                            <span class="text-red-500">*</span>
                        </label>
                        <select id="supplier_id" name="supplier_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value='' disabled selected>Pilih supplier</option>
                            @if (empty($supplier) || $supplier->isEmpty())
                                <option value='' disabled>Tidak ada supplier tersedia</option>
                            @else
                                @foreach ($supplier as $suppliers)
                                    <option value='{{ $suppliers->id }}'>{{ $suppliers->nama_supplier }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                    <div>
                        <label for="jumlah" class="block text-gray-600 font-medium mb-2">
                            Jumlah
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="jumlah" name="jumlah" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan jumlah barang" value="jumlah" required>
                    </div>
                <button type="submit" class="mt-8 bg-green-600 text-white px-6 py-2 mr-3 rounded-lg hover:bg-green-700 transition duration-300">
                    Tambah Stok
                </button>
                    <a href="{{ route('kelolaStok') }}" class="mt-4 bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">Batal</a>
            </form>
        </div>

        <!-- Stock Table -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Daftar Barang</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">No</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Kategori</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Jumlah</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Lokasi</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Supplier</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if (empty($stok) || $stok->isEmpty())
                            <tr>
                                <td colspan="7" class="py-3 px-4 text-center">Belum ada barang yang ditambahkan</td>
                            </tr>
                        @else
                            @foreach ($stok as $stoks)
                                <tr class='hover:bg-gray-50'>
                                    <td class='py-3 px-4'>{{ $loop->iteration }}</td>
                                    <td class='py-3 px-4'>{{ $stoks -> nama_barang }}</td>
                                    <td class='py-3 px-4'>{{ $stoks -> kategori -> nama_kategori ?? '-' }}</td>
                                    <td class='py-3 px-4'>{{ $stoks -> jumlah }}</td>
                                    <td class='py-3 px-4'>{{ $stoks -> rak -> lokasi ?? '-' }}</td>
                                    <td class='py-3 px-4'>{{ $stoks -> supplier -> nama_supplier ?? '-' }}</td>
                                    <td class="py-3 px-4">
                                        <a href="{{ route('editStok', ['id'=>$stoks->id]) }}" class="text-blue-500 hover:underline mr-3">Edit</a>
                                        |
                                        <form action="{{ route('hapusStok', ['id'=>$stoks->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
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