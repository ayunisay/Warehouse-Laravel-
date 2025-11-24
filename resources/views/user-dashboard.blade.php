@include('user.user-layout.header')
<div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">User Dashboard</h1>

        <!-- Stock Summary -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Total Items -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Total Items</h2>
                <p class="text-4xl font-semibold text-blue-600 mt-4">{{ $totalItems ?? 0 }}</p>
                <p class="text-sm text-gray-500 mt-2">Total jenis barang tersedia di stok.</p>
            </div>

            <!-- Low Stock Items -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Low Stock Items</h2>
                <p class="text-4xl font-semibold text-red-600 mt-4">{{ $lowStockItems->count() ?? 0 }}</p>
                <p class="text-sm text-gray-500 mt-2">Barang dengan stok kurang dari 5.</p>
            </div>

            <!-- Recent Activities -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-xl font-bold text-gray-700">Recent Activities</h2>
                <p class="text-4xl font-semibold text-green-600 mt-4">{{ $recentActivities->count() ?? 0 }}</p>
                <p class="text-sm text-gray-500 mt-2">Aktivitas terbaru Anda (10 terakhir).</p>
            </div>
        </div>

        <!-- Low Stock Items -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Low Stock Items (Kurang dari 5)</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">No</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Nama Barang</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Kategori</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Stok</th>
                            <th class="py-2 px-4 border-b text-left text-gray-600 font-medium">Lokasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (empty($lowStockItems) || $lowStockItems->isEmpty())
                            <tr>
                                <td colspan='5' class='py-2 px-4 border-b text-center text-gray-500'>Semua barang stok normal</td>
                            </tr>
                        @else
                            @foreach($lowStockItems as $item)
                            <tr class='hover:bg-gray-50'>
                                <td class='py-2 px-4 border-b'>{{ $loop->iteration }}</td>
                                <td class='py-2 px-4 border-b'>{{ $item->nama_barang }}</td>
                                <td class='py-2 px-4 border-b'>{{ $item->kategori->nama_kategori ?? 'N/A' }}</td>
                                <td class='py-2 px-4 border-b'>
                                    <span class="inline-block px-3 py-1 bg-red-100 text-red-800 rounded font-semibold">
                                        {{ $item->jumlah }}
                                    </span>
                                </td>
                                <td class='py-2 px-4 border-b'>{{ $item->rak->lokasi ?? 'N/A' }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
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
                        @if(empty($recentActivities) || $recentActivities->isEmpty())
                            <tr>
                                <td colspan='5' class='py-3 px-6 border-b text-center text-gray-500'>Belum ada log aktivitas.</td>
                            </tr>
                        @else
                            @foreach($recentActivities as $log)
                                <tr class='hover:bg-gray-50'>
                                    <td class='py-3 px-6 border-b'>{{ \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y') }}</td>
                                    <td class='py-3 px-6 border-b'>{{ \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Jakarta')->format('H:i:s') }}</td>
                                    <td class='py-3 px-6 border-b'>{{ $log->actor_name ?? 'System' }}</td>
                                    <td class='py-3 px-6 border-b'>{{ $log->action }}</td>
                                    <td class='py-3 px-6 border-b'>{{ \Illuminate\Support\Str::limit($log->description, 60) }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('user.user-layout.footer')