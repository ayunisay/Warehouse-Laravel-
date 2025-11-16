@include('user.user-layout.header')    
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Kelola Barang Keluar</h1>

        <!-- Add Item Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
                Tambah Barang Keluar
            </h2>
            <form action="{{ route('tambahBarangKeluarSubmit') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Barang Selection -->
                    <div>
                        <label for="barang_id" class="block text-gray-600 font-medium mb-2">
                            Nama Barang 
                            <span class="text-red-500">*</span>
                        </label>
                        <select id="barang_id" name="barang_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required onchange="loadItemDetails(this.value)">
                            <option value="" disabled selected>Pilih Barang</option>
                            @if(empty($stoks) || $stoks->isEmpty())
                                <option value='' disabled>Tidak ada barang tersedia</option>
                            @else
                                    @foreach($stoks as $stok)
                                        <option value="{{ $stok->id }}" data-stok="{{ $stok->jumlah }}">{{ $stok->nama_barang }}</option>
                                    @endforeach
                            @endif
                        </select>
                    </div>

                    <!-- Kategori (Auto-filled) -->
                    <div>
                        <label for="kategori" class="block text-gray-600 font-medium mb-2">Kategori</label>
                        <input type="text" id="kategori" class="w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none" readonly>
                    </div>

                    <!-- Lokasi Penyimpanan (Auto-filled) -->
                    <div>
                        <label for="lokasi" class="block text-gray-600 font-medium mb-2">Lokasi Penyimpanan</label>
                        <input type="text" id="lokasi" class="w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none" readonly>
                    </div>

                    <!-- Stok Tersedia (Auto-filled) -->
                    <div>
                        <label for="stok_tersedia" class="block text-gray-600 font-medium mb-2">Stok Tersedia</label>
                        <input type="number" id="stok_tersedia" class="w-full px-4 py-2 border rounded-lg bg-gray-100 focus:outline-none" readonly>
                    </div>

                    <!-- Jumlah Keluar -->
                    <div>
                        <label for="jumlah" class="block text-gray-600 font-medium mb-2">Jumlah Keluar <span class="text-red-500">*</span></label>
                        <input type="number" id="jumlah" name="jumlah" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan jumlah" min="1" required>
                    </div>

                    <!-- Tanggal Keluar -->
                    <div>
                        <label for="tanggal_keluar" class="block text-gray-600 font-medium mb-2">Tanggal Keluar <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal_keluar" name="tanggal_keluar" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="mt-4">
                    <label for="keterangan" class="block text-gray-600 font-medium mb-2">Keterangan Barang Keluar <span class="text-red-500">*</span></label>
                    <textarea id="keterangan" name="keterangan" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan keterangan" required></textarea>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex gap-4">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300 mr-3">
                        Tambah Barang Keluar
                    </button>
                    <a href="{{ route('barangKeluar') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                        Batal
                    </a>
                </div>
            </form>
        </div>

        <!-- Stock Table -->
        <div class="bg-white shadow-md rounded-lg p-6 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Daftar Barang Keluar</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">No</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Kategori</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Lokasi</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Jumlah</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Tanggal</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Keterangan</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if (empty($barangKeluar) || $barangKeluar->isEmpty())
                            <tr>
                                <td colspan="8" class="py-3 px-4 text-center text-gray-500">Belum ada data barang keluar</td>
                            </tr>
                        @else
                            @foreach ($barangKeluar as $item)
                            <tr class='hover:bg-gray-50'>
                                <td class='py-3 px-4'>{{ $loop->iteration }}</td>
                                <td class='py-3 px-4'>{{ $item->stok->nama_barang ?? 'N/A' }}</td>
                                <td class='py-3 px-4'>{{ $item->stok->kategori->nama_kategori ?? 'N/A' }}</td>
                                <td class='py-3 px-4'>{{ $item->stok->rak->lokasi ?? 'N/A' }}</td>
                                <td class='py-3 px-4'>{{ $item->jumlah }}</td>
                                <td class='py-3 px-4'>{{ \Carbon\Carbon::parse($item->tanggal_keluar)->format('d/m/Y') }}</td>
                                <td class='py-3 px-4'>{{ \Illuminate\Support\Str::limit($item->keterangan, 30) }}</td>
                                <td class='py-3 px-4'>
                                    <a href="{{ route('editBarangKeluar', ['id'=>$item->id]) }}" class="text-blue-500 hover:underline mr-3">
                                        Edit
                                    </a>
                                    |
                                    <form action="{{ route('hapusBarangKeluar', ['id'=>$item->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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

    <script>
        function loadItemDetails(itemId) {
            if (!itemId) {
                document.getElementById('kategori').value = '';
                document.getElementById('lokasi').value = '';
                document.getElementById('stok_tersedia').value = '';
                return;
            }

            fetch(`/api/item-details/${itemId}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('kategori').value = data.kategori_nama || 'N/A';
                    document.getElementById('lokasi').value = data.rak_lokasi || 'N/A';
                    document.getElementById('stok_tersedia').value = data.stok_tersedia || 0;
                    
                    // Reset jumlah
                    document.getElementById('jumlah').value = '';
                    document.getElementById('jumlah').max = data.stok_tersedia;
                })
                .catch(error => console.error('Error:', error));
        }

        // Set today's date as default
        document.getElementById('tanggal_keluar').valueAsDate = new Date();
    </script>

@include('user.user-layout.footer')