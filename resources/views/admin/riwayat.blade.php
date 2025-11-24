@include('admin.admin-layout.header')
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Riwayat Barang Keluar</h1>

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
                                    <form action="{{ route('hapusBarangKeluar2', ['id'=>$item->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
@include('admin.admin-layout.footer')