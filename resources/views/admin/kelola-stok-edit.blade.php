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
                Update Stok Barang
            </h2>
            <form action="{{ route('editStokSubmit', ['id' => $stok->id]) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label for="nama_barang" class="block text-gray-600 font-medium mb-2">
                            Nama Barang
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_barang" name="nama_barang" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan nama barang" value="{{ $stok->nama_barang }}" required>
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
                                    <option value='{{ $kategoris->id }}' {{ $stok->kategori_id == $kategoris->id ? 'selected' : '' }}>
                                        {{ $kategoris->nama_kategori }}
                                    </option>
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
                                    <option value='{{ $raks->id }}' {{ $stok->rak_id == $raks->id ? 'selected' : '' }}>
                                        {{ $raks->lokasi }}
                                    </option>
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
                                    <option value='{{ $suppliers->id }}' {{ $stok->supplier_id == $suppliers->id ? 'selected' : '' }}>
                                        {{ $suppliers->nama_supplier }}
                                    </option>
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
                        <input type="number" id="jumlah" name="jumlah" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan jumlah barang" value="{{ $stok->jumlah }}" required>
                    </div>
                    
                <button type="submit" class="mt-8 bg-green-600 text-white px-6 py-2 mr-3 rounded-lg hover:bg-green-700 transition duration-300">
                    Update Stok
                </button>
                    <a href="{{ route('kelolaStok') }}" class="mt-4 bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">Batal</a>
            </form>
        </div>
    </div>
@include('admin.admin-layout.footer')