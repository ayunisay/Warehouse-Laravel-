@include('admin.admin-layout.header')
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Kelola Permintaan User</h1>

        <!-- User Requests Table -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Daftar Permintaan Barang</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Jumlah</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Alasan</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Pengguna</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Tanggal</th>
                            <th class="py-3 px-4 border-b text-center text-gray-600 font-medium w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if (empty($permintaanPending) || $permintaanPending->isEmpty())
                            <tr>
                                <td colspan="8" class="py-3 px-4 text-center text-gray-500">Belum ada permintaan yang diajukan</td>
                            </tr>
                        @else
                            @foreach ($permintaanPending as $permintaans)
                        <tr class='hover:bg-gray-50'>
                            <td class='py-3 px-4'>{{ $permintaans->nama_barang }}</td>
                            <td class='py-3 px-4'>{{ $permintaans->jumlah }}</td>
                            <td class='py-3 px-4'>{{ $permintaans->alasan ?? '-' }}</td>
                            <td class='py-3 px-4'>{{ $permintaans->nama_pengaju }}</td>
                            <td class='py-3 px-4'>{{ $permintaans->created_at ? $permintaans->created_at->format('d/m/Y') : ($permintaans->tanggal ?? '-') }}</td>
                            <td class='py-3 px-2'>
                                <form action="{{ route('approvePermintaan', ['id'=>$permintaans->id]) }}" method="POST" style="display:inline;">
                                    @csrf
                                    <button type="submit" class="text-green-500 hover:underline bg-none border-none cursor-pointer">Approved</button>
                                </form>
                                |
                                <form action="{{ route('rejectPermintaan', ['id'=>$permintaans->id]) }}" method="POST" style="display:inline;">
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

        <!-- Request History -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Riwayat Permintaan Barang</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">No</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Pengguna</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Jumlah</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Status</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Tanggal</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if (empty($permintaan) || $permintaan->isEmpty())
                            <tr>
                                <td colspan="8" class="py-3 px-4 text-center text-gray-500">Belum ada permintaan yang diajukan</td>
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
                                <form action="{{ route('hapusPermintaanAdmin', ['id'=>$permintaans->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus permintaan ini?')">
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