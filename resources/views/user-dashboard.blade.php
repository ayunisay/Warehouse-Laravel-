@include('user.user-layout.header')
<div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">User Dashboard</h1>

        <!-- Stock Summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Items -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Total Items</h2>
                <p class="text-4xl font-semibold text-blue-600 mt-4">400</p>
                <p class="text-sm text-gray-500 mt-2">Total items available in stock.</p>
            </div>

            <!-- Low Stock Items -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Low Stock Items</h2>
                <p class="text-4xl font-semibold text-red-600 mt-4">200</p>
                <p class="text-sm text-gray-500 mt-2">Items that are running low in stock.</p>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Recent Activities</h2>
                <p class="text-4xl font-semibold text-green-600 mt-4">102</p>
                <p class="text-sm text-gray-500 mt-2">Recent transactions or updates.</p>
            </div>
        </div>

        <!-- Low Stock Items -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Low Stock Items</h2>
            <table class="min-w-full bg-white border border-gray-300">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Item Name</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Stock</th>
                        <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Location</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class='hover:bg-gray-50'>
                        <td class='py-2 px-4 border-b'>name</td>
                        <td class='py-2 px-4 border-b'>stock</td>
                        <td class='py-2 px-4 border-b'>location</td>
                    </tr>
                    <tr>
                        <td colspan='3' class='py-2 px-4 border-b text-center text-gray-500'>No low stock items found.</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <!-- Audit Trail Table -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Log Aktivitas Sistem</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-6 border-b text-left text-gray-600 font-medium">Tanggal</th>
                            <th class="py-3 px-6 border-b text-left text-gray-600 font-medium">Waktu</th>
                            <th class="py-3 px-6 border-b text-left text-gray-600 font-medium">Pengguna</th>
                            <th class="py-3 px-6 border-b text-left text-gray-600 font-medium">Aksi</th>
                            <th class="py-3 px-6 border-b text-left text-gray-600 font-medium">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <tr class='hover:bg-gray-50'>
                            <td class='py-3 px-6 border-b'>tanggal</td>
                            <td class='py-3 px-6 border-b'>waktu</td>
                            <td class='py-3 px-6 border-b'>nama pengaju</td>
                            <td class='py-3 px-6 border-b'>aksi</td>
                            <td class='py-3 px-6 border-b'>detail</td>
                        </tr>
                        <tr>
                            <td colspan='5' class='py-3 px-6 border-b text-center text-gray-500'>Belum ada log aktivitas.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('user.user-layout.footer')