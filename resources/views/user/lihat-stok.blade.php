@include('user.user-layout.header')
 <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Lihat Stok</h1>

        <!-- Stock Table -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Daftar Barang</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">No</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Jumlah</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Lokasi</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Kategori</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class='hover:bg-gray-50'>
                            <td class='py-3 px-4'>no</td>
                            <td class='py-3 px-4'>nama_barang</td>
                            <td class='py-3 px-4'>jumlah</td>
                            <td class='py-3 px-4'>lokasi</td>
                            <td class='py-3 px-4'>nama kategori</td>
                        </tr>
                        <tr>
                            <td colspan='6' class='py-3 px-4 text-center text-gray-500'>Belum ada data barang.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('user.user-layout.footer')
