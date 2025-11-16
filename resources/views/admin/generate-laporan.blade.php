@include('admin.admin-layout.header')

    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Generate Laporan</h1>

        <!-- Export Stock Report -->
        <div class="bg-white shadow-md rounded-lg p-6 pb-10 mb-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Laporan Stok</h2>
            <p class="text-gray-600 mb-8">Ekspor laporan stok barang yang tersedia di gudang.</p>
            <a href="{{ route('exportStok') }}" class="bg-teal-600 text-white px-10 py-4 rounded-lg hover:bg-teal-700 transition duration-300">Export Stok (CSV)</a>
        </div>

        <!-- Export Transaction Report -->
        <div class="bg-white shadow-md rounded-lg p-6 pb-10 mb-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Laporan Barang Keluar</h2>
            <p class="text-gray-600 mb-8">Ekspor laporan pengambilan barang.</p>
            <a href="{{ route('exportBarangKeluar') }}" class="bg-teal-600 text-white px-10 py-4 rounded-lg hover:bg-teal-700 transition duration-300">Export Barang Keluar (CSV)</a>
        </div>

        <!-- Export Request Report -->
        <div class="bg-white shadow-md rounded-lg pb-10 p-6 mb-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Laporan Permintaan Barang</h2>
            <p class="text-gray-600 mb-8">Ekspor laporan permintaan barang.</p>
            <a href="{{ route('exportPermintaan') }}" class="bg-teal-600 text-white px-10 py-4 rounded-lg hover:bg-teal-700 transition duration-300">Export Permintaan (CSV)</a>
        </div>

        <!-- Export Laporan Kerusakan -->
        <div class="bg-white shadow-md rounded-lg p-6 pb-10">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Laporan Kerusakan</h2>
            <p class="text-gray-600 mb-8">Ekspor seluruh laporan kerusakan barang.</p>
            <a href="{{ route('exportLaporanKerusakan') }}" class="bg-teal-600 text-white px-10 py-4 rounded-lg hover:bg-teal-700 transition duration-300">Export Laporan Kerusakan (CSV)</a>
        </div>
    </div>

@include('admin.admin-layout.footer')
