@include('admin.admin-layout.header')
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Kelola User</h1>

        <!-- Add User Form -->
        <div class="bg-white shadow-md rounded-lg p-6 mb-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
                Update User
            </h2>
            <form action="{{ route('editUserSubmit', ['id' => $users->id]) }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="name" class="block text-gray-600 font-medium mb-2">
                            Nama
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="name" name="name" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan nama" value="{{ $users->name }}" required>
                    </div>
                    <div>
                        <label for="email" class="block text-gray-600 font-medium mb-2">
                            Email
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan email" value="{{ $users->email }}" required>
                    </div>
                    <div>
                        <label for="password" class="block text-gray-600 font-medium mb-2">
                            Password
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="password" id="password" name="password" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Masukkan password" value="{{ $users->password }}" required>
                    </div>
                    <div>
                        <label for="role" class="block text-gray-600 font-medium mb-2">
                            Role
                            <span class="text-red-500">*</span>
                        </label>
                        <select id="role" name="role" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500" value="{{ $users->role }}" required>
                            <option value="" disabled selected>Pilih Role</option>
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                </div>
                <button type="submit" class="mt-4 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">
                    Update User
                </button>
                    <a href="{{ route('kelolaUser') }}" class="mt-4 bg-gray-600 text-white px-6 py-2 rounded-lg hover:bg-gray-700 transition duration-300">Batal</a>
            </form>
        </div>
    </div>
@include('admin.admin-layout.footer')