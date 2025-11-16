@include('user.user-layout.header')    
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Kelola Barang Keluar</h1>

        <!-- Edit Item Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
                Update Barang Keluar
            </h2>
            <form action="{{ route('editBarangKeluarSubmit', ['id' => $barangKeluar->id]) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama Barang Selection -->
                    <div>
                        <label for="barang_id" class="block text-gray-600 font-medium mb-2">
                            Nama Barang 
                            <span class="text-red-500">*</span>
                        </label>
                        <select id="barang_id" name="barang_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" required onchange="loadItemDetails(this.value)">
                            <option value="" disabled>Pilih Barang</option>
                            @foreach($stoks as $stok)
                                <option value='{{ $stok->id }}' {{ $stok->id == $barangKeluar->barang_id ? 'selected' : '' }}>{{ $stok->nama_barang }}</option>
                            @endforeach
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
                        <input type="number" id="jumlah" name="jumlah" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan jumlah" min="1" value="{{ $barangKeluar->jumlah }}" required>
                    </div>

                    <!-- Tanggal Keluar -->
                    <div>
                        <label for="tanggal_keluar" class="block text-gray-600 font-medium mb-2">Tanggal Keluar <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal_keluar" name="tanggal_keluar" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" value="{{ $barangKeluar->tanggal_keluar }}" required>
                    </div>
                </div>

                <!-- Keterangan -->
                <div class="mt-4">
                    <label for="keterangan" class="block text-gray-600 font-medium mb-2">Keterangan Barang Keluar <span class="text-red-500">*</span></label>
                    <textarea id="keterangan" name="keterangan" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan keterangan" required>{{ $barangKeluar->keterangan }}</textarea>
                </div>

                <!-- Buttons -->
                <div class="mt-6 flex gap-4">
                    <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                        Update Perubahan
                    </button>
                    <a href="{{ route('barangKeluar') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">
                        Batal
                    </a>
                </div>
            </form>
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
                })
                .catch(error => console.error('Error:', error));
        }

        // Load initial details
        window.addEventListener('load', function() {
            const barangId = document.getElementById('barang_id').value;
            if (barangId) {
                loadItemDetails(barangId);
            }
        });
    </script>

@include('user.user-layout.footer')
