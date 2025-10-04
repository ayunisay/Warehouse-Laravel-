@include('admin.admin-layout.header')
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Kelola User</h1>

        <!-- Add User Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
                edit/tambah
            </h2>
            <form method="POST">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="username" class="block text-gray-600 font-medium mb-2">Username</label>
                        <input type="text" id="username" name="username" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan username" value="username" required>
                    </div>
                    <div>
                        <label for="password" class="block text-gray-600 font-medium mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan password" value="password" required>
                    </div>
                    <div>
                        <label for="role" class="block text-gray-600 font-medium mb-2">Role</label>
                        <select id="role" name="role" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="user">>User</option>
                            <option value="admin">>Admin</option>
                        </select>
                    </div>
                </div>
                <button type="submit" name="update/insert" class="mt-4 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                    edit/tambah
                </button>
                    <a href="kelola_user.php" class="mt-4 bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">Batal</a>
            </form>
        </div>

        <!-- User Table -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Daftar Users</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Username</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Role</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                    <tr class='hover:bg-gray-50'>
                        <td class='py-3 px-4'>username</td>
                        <td class='py-3 px-4 capitalize'>role</td>
                        <td class='py-3 px-4'>
                            <a href='#' class='text-blue-500 hover:underline'>Edit</a> |
                            <a href='#' onclick=\"return confirm('Yakin ingin menghapus?')\" class='text-red-500 hover:underline'>Hapus</a>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='3' class='py-3 px-4 text-center text-gray-500'>Belum ada data user.</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@include('admin.admin-layout.footer')