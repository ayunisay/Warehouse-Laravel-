@include('admin-layout.header')

    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Admin Dashboard</h1>

        <!-- Statistics Section -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Items -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Total Items</h2>
                <p class="text-4xl font-semibold text-blue-600 mt-4">300</p>
                <p class="text-sm text-gray-500 mt-2">Total items available in stock.</p>
            </div>

            <!-- Pending Requests -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Pending Requests</h2>
                <p class="text-4xl font-semibold text-yellow-600 mt-4">100</p>
                <p class="text-sm text-gray-500 mt-2">User requests awaiting approval.</p>
            </div>

            <!-- Completed Transactions -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Completed Transactions</h2>
                <p class="text-4xl font-semibold text-green-600 mt-4">200</p>
                <p class="text-sm text-gray-500 mt-2">Transactions successfully completed.</p>
            </div>
        </div>

        <!-- Menu2 -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Generate Laporan -->
                <a href="./admin/generate_laporan.php" class="group block bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="bg-white bg-opacity-20 p-3 rounded-full">
                            <!-- Ikon Baru: Ikon Dokumen -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h7l5 5v11a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Generate Laporan</h3>
                            <p class="text-sm text-white text-opacity-80">Export laporan stok, laporan transaksi, dan laporan permintaan barang.</p>
                        </div>
                    </div>
                </a>

                <!-- Audit Trail -->
                <a href="./admin/audit_trail.php" class="group block bg-gradient-to-r from-green-500 to-green-600 text-white p-6 rounded-lg shadow-lg hover:shadow-xl transition duration-300">
                    <div class="flex items-center space-x-4">
                        <div class="bg-white bg-opacity-20 p-3 rounded-full">
                            <!-- Ikon Baru: Ikon Jejak -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.657 0 3-1.343 3-3S13.657 2 12 2 9 3.343 9 5s1.343 3 3 3zm0 0v13m0-13c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold">Audit Trail</h3>
                            <p class="text-sm text-white text-opacity-80">View system activity logs.</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>


            <!-- Tren Permintaan Barang -->
            <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
                <h2 class="text-2xl font-bold text-gray-700 mb-4">Tren Permintaan Barang</h2>
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Jumlah Permintaan</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class='hover:bg-gray-50'>
                            <td class='py-2 px-4 border-b'>nama barang</td>
                            <td class='py-2 px-4 border-b'>jumlah permintaan</td>
                            <td class='py-2 px-4 border-b'>status</td>
                        </tr>
                        <tr>
                            <td colspan='3' class='py-2 px-4 border-b text-center text-gray-500'>Belum ada data tren permintaan barang.</td>
                        </tr>
                    </tbody>
                </table>
            </div>

        <!-- User Laporan Table -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Laporan Kerusakan Barang</h2>
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Jumlah</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Deskripsi</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Status</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Tanggal</th>
                        <th class="py-3 px-4 border-b text-center text-gray-600 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr class='hover:bg-gray-50'>
                        <td class='py-3 px-4 border-b'>nama barang</td>
                        <td class='py-3 px-4 border-b'>jumlah</td>
                        <td class='py-3 px-4 border-b'>deskripsi</td>
                        <td class='py-3 px-4 border-b'>
                            <span class='px-2 py-1 rounded-lg text-white'>
                                status
                            </span>
                        </td>
                        <td class='py-3 px-4 border-b'>tanggal</td>
                        <td class='py-3 px-4 border-b text-center'>
                            <div class='flex items-center justify-center space-x-4'>
                                <a href='#' class='text-green-500 hover:underline flex items-center'>
                                     <svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5 mr-1' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                        <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M5 13l4 4L19 7' />
                                    </svg>
                                    Resolved
                                </a>
                                <a href='#' class='text-red-500 hover:underline flex items-center'>
                                    <svg xmlns='http://www.w3.org/2000/svg' class='h-5 w-5 mr-1' fill='none' viewBox='0 0 24 24' stroke='currentColor'>
                                         <path stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M6 18L18 6M6 6l12 12' />
                                    </svg>
                                    Rejected
                                </a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='6' class='py-3 px-4 border-b text-center text-gray-500'>Belum ada permintaan barang.</td>
                    </tr>
                </tbody>
        </table>

            <div class="overflow-x-auto mt-5">
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
                        <tr class='hover:bg-gray-50'>
                            <td class='py-3 px-4'>number</td>
                            <td class='py-3 px-4'>nama barang</td>
                            <td class='py-3 px-4'>jumlah</td>
                            <td class='py-3 px-4'>deskripsi</td>
                            <td class='py-3 px-4'>
                                <span class='px-2 py-1 rounded-lg text-white'>
                                    apa yak
                                </span>
                            </td>
                            <td class='py-3 px-4'>Tanggal</td>
                            <td class='py-3 px-4'>
                                <a href="#" class='text-red-500 hover:underline'>Hapus</a>
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

@include('admin-layout  .footer')