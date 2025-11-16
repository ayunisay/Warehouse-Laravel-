@include('admin.admin-layout.header')

    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Kelola Laporan Kerusakan</h1>

        <!-- Pending Reports -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Daftar Laporan Kerusakan - Menunggu Persetujuan</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">No</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Jumlah</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Deskripsi</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Tanggal</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if (empty($laporanPending) || $laporanPending->isEmpty())
                            <tr>
                                <td colspan="6" class="py-3 px-4 text-center text-gray-500">Tidak ada laporan yang menunggu persetujuan</td>
                            </tr>
                        @else
                            @foreach ($laporanPending as $report)
                            <tr class='hover:bg-gray-50'>
                                <td class='py-3 px-4'>{{ $loop->iteration }}</td>
                                <td class='py-3 px-4'>{{ $report->stok->nama_barang ?? 'N/A' }}</td>
                                <td class='py-3 px-4'>{{ $report->jumlah }}</td>
                                <td class='py-3 px-4'>{{ \Illuminate\Support\Str::limit($report->keterangan, 30) }}</td>
                                <td class='py-3 px-4'>{{ \Carbon\Carbon::parse($report->tanggal)->format('d/m/Y') }}</td>
                                <td class='py-3 px-4'>
                                    <form action="{{ route('approveLaporan', ['id'=>$report->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="text-green-500 hover:underline bg-none border-none cursor-pointer">Approved</button>
                                    </form>
                                    |
                                    <form action="{{ route('rejectLaporan', ['id'=>$report->id]) }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit" class="text-red-500 hover:underline bg-none border-none cursor-pointer">Rejected</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach 
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

        <!-- History Reports -->
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
                                <td colspan="7" class="py-3 px-4 text-center text-gray-500">Belum ada laporan kerusakan</td>
                            </tr>
                        @else
                            @foreach ($laporan as $report)
                            <tr class='hover:bg-gray-50'>
                                <td class='py-3 px-4'>{{ $loop->iteration }}</td>
                                <td class='py-3 px-4'>{{ $report->stok->nama_barang ?? 'N/A' }}</td>
                                <td class='py-3 px-4'>{{ $report->jumlah }}</td>
                                <td class='py-3 px-4'>{{ \Illuminate\Support\Str::limit($report->keterangan, 30) }}</td>
                                <td class='py-3 px-4'>
                                    <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                                        @if($report->status == 'Pending') bg-yellow-100 text-yellow-800
                                        @elseif($report->status == 'Approved') bg-green-100 text-green-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ $report->status }}
                                    </span>
                                </td>
                                <td class='py-3 px-4'>{{ \Carbon\Carbon::parse($report->tanggal)->format('d/m/Y') }}</td>
                                <td class='py-3 px-4'>
                                    <form action="{{ route('hapusLaporanAdmin', ['id'=>$report->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus laporan ini?')">
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
