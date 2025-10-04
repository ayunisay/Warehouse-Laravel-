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
                            <th class="py-3 px-6 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Jumlah</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Alasan</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Pengguna</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Tanggal</th>
                            <th class="py-3 px-6 border-b text-center text-gray-600 font-medium w-40">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class='hover:bg-gray-50'>
                            <td class='py-3 px-6 border-b'>nama_barang</td>
                            <td class='py-3 px-4 border-b text-center'>jumlah</td>
                            <td class='py-3 px-4 border-b'>alasan</td>
                            <td class='py-3 px-4 border-b'>nama_pengaju</td>
                            <td class='py-3 px-4 border-b'>tanggal</td>
                            <td class='py-3 px-6 border-b text-center w-40'>
                                <div class='flex items-center justify-center space-x-4'>
                                    <a href='#' class='text-green-500 hover:underline flex items-center'>
                                        <svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5 mr-1' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7'/>
                                        </svg>
                                        Approve
                                    </a>
                                    <a href='#' class='text-red-500 hover:underline flex items-center'>
                                        <svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5 mr-1' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                            <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' />
                                        </svg>
                                        Reject
                                    </a>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='6' class='py-3 px-4 border-b text-center text-gray-500'>
                                Belum ada permintaan barang.
                            </td>
                        </tr>
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
                        <tr class='hover:bg-gray-50'>
                            <td class='py-3 px-4'>no</td>
                            <td class='py-3 px-4'>nama_pengaju</td>
                            <td class='py-3 px-4'>nama_barang</td>
                            <td class='py-3 px-4'>jumlah</td>
                            <td class='py-3 px-4'>
                                Status
                            </td>
                            <td class='py-3 px-4'>tanggal</td>
                            <td class='py-3 px-4'>
                                <a href='#' onclick=\"return confirm('Yakin ingin menghapus?')\" class='text-red-500 hover:underline'>Hapus</a>
                            </td>
                        </tr>
                        <tr>
                            <td colspan='7' class='py-3 px-4 text-center text-gray-500'>Belum ada data permintaan barang.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('admin.admin-layout.footer')