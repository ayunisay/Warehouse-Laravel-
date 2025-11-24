@include('user.user-layout.header')
<!-- Main Content -->
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Laporan Kerusakan</h1>

        <!-- Damage Report Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
               Tambah Laporan Kerusakan
            </h2>
            <form action="{{ route('tambahLaporanSubmit') }}" method="POST">
                @csrf   
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="barang_id" class="block text-gray-600 font-medium mb-2">Nama Barang <span class="text-red-500">*</span></label>
                        <select id="barang_id" name="barang_id" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            @if (empty($stok) || $stok->isEmpty())
                                <option value='' disabled>Tidak ada barang tersedia</option>
                            @else
                                @foreach ($stok as $stokItem)
                                    <option value='{{ $stokItem->id }}'>{{ $stokItem->nama_barang }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <div>
                        <label for="jumlah" class="block text-gray-600 font-medium mb-2">Jumlah <span class="text-red-500">*</span></label>
                        <input type="number" id="jumlah" name="jumlah" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Masukkan jumlah barang" min="1" required>
                    </div>
                    <div>
                        <label for="tanggal" class="block text-gray-600 font-medium mb-2">Tanggal <span class="text-red-500">*</span></label>
                        <input type="date" id="tanggal" name="tanggal" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="keterangan" class="block text-gray-600 font-medium mb-2">Deskripsi Kerusakan <span class="text-red-500">*</span></label>
                    <textarea id="keterangan" name="keterangan" rows="3" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Jelaskan kerusakan atau kehilangan barang" required></textarea>
                </div>
                <div class="mt-6 flex gap-4">
                    <button type="submit" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-300">Kirim Laporan</button>
                    <a href="{{ route('laporanKerusakan') }}" class="bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">Batal</a>
                </div>
            </form>
        </div>

        <!-- Damage Report History -->
        <div class="bg-white shadow-md rounded-lg p-6 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Riwayat Laporan Kerusakan</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">No</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Jumlah</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Deskripsi</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Status</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Tanggal</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if (empty($laporan) || $laporan->isEmpty())
                            <tr>
                                <td colspan='7' class='py-3 px-4 text-center text-gray-500'>Belum ada laporan kerusakan</td>
                            </tr>
                        @else
                            @foreach ($laporan as $laporans)
                                <tr class='hover:bg-gray-50'>
                                    <td class='py-3 px-4'>{{ $loop->iteration }}</td>
                                    <td class='py-3 px-4'>{{ $laporans->stok->nama_barang ?? 'N/A' }}</td>
                                    <td class='py-3 px-4'>{{ $laporans->jumlah }}</td>
                                    <td class='py-3 px-4'>{{ \Illuminate\Support\Str::limit($laporans->keterangan, 30) }}</td>
                                    <td class='py-3 px-4'>
                                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                                            @if($laporans->status == 'Pending') bg-yellow-100 text-yellow-800
                                            @elseif($laporans->status == 'Approved') bg-green-100 text-green-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ $laporans->status }}
                                        </span>
                                    </td>
                                    <td class='py-3 px-4'>{{ \Carbon\Carbon::parse($laporans->tanggal)->format('d/m/Y') }}</td>
                                    <td class='py-3 px-4'>
                                        @if($laporans->status == 'Pending')
                                            <a href="{{ route('editLaporan', ['id'=>$laporans->id]) }}" class="text-blue-500 hover:underline mr-3">Edit</a>
                                        @endif
                                        |
                                        <form action="{{ route('hapusLaporan', ['id'=>$laporans->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
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
@include('user.user-layout.footer')