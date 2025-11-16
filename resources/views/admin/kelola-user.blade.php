@include('admin.admin-layout.header')
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Kelola User</h1>

        <!-- Add User Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
                Tambah User
            </h2>
            <form action="{{ route('tambahUserSubmit') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-gray-600 font-medium mb-2">
                            Nama
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan nama" required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-600 font-medium mb-2">
                            Email
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan email" required>
                    </div>
                    <div>
                        <label for="password" class="block text-gray-600 font-medium mb-2">
                            Password
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan password" required>
                    </div>
                    <div>
                        <label for="role" class="block text-gray-600 font-medium mb-2">
                            Role
                            <span class="text-red-500">*</span>
                        </label>
                        <select id="role" name="role" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" required>
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-2 mr-3 rounded-lg hover:bg-green-700 transition duration-300">
                    Tambah User
                </button>
                    <a href="{{ route('kelolaUser') }}" class="mt-4 bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">Batal</a>
            </form>
        </div>

        <!-- User Table -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Daftar Users</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">No</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Email</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Role</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if (empty($users) || $users->isEmpty())
                            <tr>
                                <td colspan="5" class="py-3 px-4 text-center">Belum ada data user yang ditambahkan</td>
                            </tr>
                        @else
                            @foreach ($users as $user)
                                <tr class='hover:bg-gray-50'>
                                    <td class='py-3 px-4'>{{ $loop->iteration }}</td>
                                    <td class='py-3 px-4'>{{ $user->name }}</td>
                                    <td class='py-3 px-4'>{{ $user->email }}</td>
                                    <td class='py-3 px-4 capitalize'>{{ $user->role }}</td>
                                    <td class='py-3 px-4'>
                                        <a href="{{ route('editUser', ['id'=>$user->id]) }}" class='text-blue-500 hover:underline mr-3'>Edit</a> |
                                        <form action="{{ route('deleteUser', ['id'=>$user->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class='text-red-500 hover:underline ml-3'>Hapus</button>
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