<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
    <body class="bg-gray-100 font-sans leading-normal tracking-normal min-h-screen flex flex-col">
        <!-- Navbar -->
        <nav class="bg-gradient-to-r from-blue-600 to-blue-800 text-white shadow-lg">
            <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                <!-- Logo -->
                <a href="#" class="text-2xl font-extrabold tracking-wide hover:text-yellow-400 transition duration-300">
                    <span class="text-yellow-400">Warehouse</span> Management
                </a>

                <!-- Navigation Links -->
                <div class="flex items-center space-x-11">
                    <ul class="flex space-x-6 text-sm font-medium">
                        <li>
                            <a href="{{ route('dashboardAdmin') }}" class="hover:text-yellow-400 transition duration-300">Dashboard</a>
                        </li>
                        <li>
                            <a href="{{ route('kelolaStok') }}" class="hover:text-yellow-400 transition duration-300">Stok</a>
                        </li>
                        <li>
                            <a href="{{ route('kelolaSupplier') }}" class="hover:text-yellow-400 transition duration-300">Supplier</a>
                        </li>
                        <li>
                            <a href="{{ route('kelolaUser') }}" class="hover:text-yellow-400 transition duration-300">User</a>
                        </li>
                        <li>
                            <a href="{{ route('riwayat') }}" class="hover:text-yellow-400 transition duration-300">Riwayat Keluar</a>
                        </li>
                        <li>
                            <a href="{{ route('kelolaPermintaan') }}" class="hover:text-yellow-400 transition duration-300">Permintaan Barang</a>
                        </li>
                    </ul>

                    <!-- Logout Button -->
                    <a href="{{ route('logout') }}" class="flex items-center bg-red-500 px-4 py-2 rounded hover:bg-red-600 transition duration-300">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H3" />
                        </svg>
                        Logout
                    </a>
                </div>
            </div>
        </nav>