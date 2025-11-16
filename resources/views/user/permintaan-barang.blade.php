@include('user.user-layout.header')
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">
            Permintaan Barang
        </h1>

        <!-- Request Form -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
                Tambah Permintaan Barang
            </h2>
            <form action="{{ route('tambahPermintaanSubmit') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nama_pengaju" class="block text-gray-600 font-medium mb-2">
                            Nama Pengguna
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_pengaju" name="nama_pengaju" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan nama yang mengajukan" required>
                    </div>
                    <div>
                        <label for="nama_barang" class="block text-gray-600 font-medium mb-2">
                            Nama Barang
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_barang" name="nama_barang" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan nama barang" required>
                    </div>
                    <div>
                        <label for="jumlah" class="block text-gray-600 font-medium mb-2">
                            Jumlah
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="number" id="jumlah" name="jumlah" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Masukkan jumlah barang" required>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="alasan" class="block text-gray-600 font-medium mb-2">
                        Alasan Permintaan
                        <span class="text-red-500">*</span>
                    </label>
                    <textarea id="alasan" name="alasan" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500" placeholder="Jelaskan alasan permintaan barang" required></textarea>
                </div>
                <button type="submit" name="insert" class="mt-4 bg-yellow-600 text-white px-6 py-2 rounded-lg hover:bg-yellow-700 transition duration-300">
                    Kirim Permintaan
                </button>
            </form>
        </div>

        <!-- Request History -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
                Riwayat Permintaan Barang
            </h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">
                                No
                            </th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">
                                Nama Pengguna
                            </th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">
                                Nama Barang
                            </th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">
                                Jumlah
                            </th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">
                                Status
                            </th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">
                                Tanggal
                            </th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if (empty($permintaan) || $permintaan->isEmpty())
                            <tr>
                                <td colspan="7" class="py-3 px-4 text-center">Belum ada permintaan yang diajukan</td>
                            </tr>
                        @else
                            @foreach ($permintaan as $permintaans)
                        <tr class='hover:bg-gray-50'>
                            <td class='py-3 px-4'>{{ $loop->iteration }}</td>
                            <td class='py-3 px-4'>{{ $permintaans->nama_pengaju }}</td>
                            <td class='py-3 px-4'>{{ $permintaans->nama_barang }}</td>
                            <td class='py-3 px-4'>{{ $permintaans->jumlah }}</td>
                            <td class='py-3 px-4'>
                                <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                                        @if($permintaans->status == 'Pending') bg-yellow-100 text-yellow-800
                                        @elseif($permintaans->status == 'Approved') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ $permintaans->status }}
                                </span>
                            </td>
                            <td class='py-3 px-4'>{{ $permintaans->created_at ? $permintaans->created_at->format('d/m/Y') : ($permintaans->tanggal ?? '-') }}</td>
                            <td class='py-3 px-4'>
                                <form action="{{ route('hapusPermintaan', ['id'=>$permintaans->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus barang ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline bg-none border-none cursor-pointer">Hapus</button>
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