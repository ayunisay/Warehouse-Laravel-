@include('admin.admin-layout.header')
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Riwayat Keluar</h1>

        <!-- Transaction History Table -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Daftar Barang Keluar</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">No</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Tanggal</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Jumlah</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Keterangan</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class='hover:bg-gray-50'>
                            <td class='py-3 px-4'>no</td>
                            <td class='py-3 px-4'>nama_barang</td>
                            <td class='py-3 px-4'>tanggal</td>
                            <td class='py-3 px-4'>jumlah</td>
                            <td class='py-3 px-4'>keterangan</td>
                            <td class='py-3 px-4'>
                                <a href='#' onclick=\"return confirm('Yakin ingin menghapus?')\" class='text-red-500 hover:underline'>Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='6' class='py-3 px-4 text-center text-gray-500'>Belum ada data barang.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('admin.admin-layout.footer')