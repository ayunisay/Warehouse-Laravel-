@include('user.user-layout.header')
<!-- Main Content -->
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Laporan Kerusakan</h1>

        <!-- Edit Damage Report Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
               Edit Laporan Kerusakan
            </h2>
            <form action="{{ route('editLaporanSubmit', ['id' => $laporan->id]) }}" method="POST">
                @csrf   
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="barang_id" class="block text-gray-600 font-medium mb-2">Nama Barang <span class="text-red-500">*</span></label>
                        <select id="barang_id" name="barang_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                            <option value="" disabled>Pilih Barang</option>
                            @foreach ($stoks as $stokItem)
                                <option value='{{ $stokItem->id }}' {{ $stokItem->id == $laporan->barang_id ? 'selected' : '' }}>{{ $stokItem->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="jumlah" class="block text-gray-600 font-medium mb-2">Jumlah <span class="text-red-500">*</span></label>
                        <input type="number" id="jumlah" name="jumlah" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Masukkan jumlah barang" min="1" value="{{ $laporan->jumlah }}" required>
                    </div>
                    <div>
                        <label for="tanggal" class="block text-gray-600 font-medium mb-2">Tanggal <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal" name="tanggal" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" value="{{ $laporan->tanggal }}" required>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="keterangan" class="block text-gray-600 font-medium mb-2">Deskripsi Kerusakan <span class="text-red-500">*</span></label>
                    <textarea id="keterangan" name="keterangan" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Jelaskan kerusakan atau kehilangan barang" required>{{ $laporan->keterangan }}</textarea>
                </div>
                <div class="mt-6 flex gap-4">
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-300">Simpan Perubahan</button>
                    <a href="{{ route('laporanKerusakan') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">Batal</a>
                </div>
            </form>
        </div>
    </div>
@include('user.user-layout.footer')
