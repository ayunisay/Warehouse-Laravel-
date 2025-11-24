@include('admin.admin-layout.header')

<div class="container mx-auto mt-8 flex-grow">
        <div class="bg-white shadow-md rounded-lg p-6 mt-8">
            <h1 class="text-2xl font-bold text-gray-700 mb-4">Tambah Kategori</h1>
            <form action="{{ route('tambahKategoriSubmit') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="nama_kategori" class="block text-gray-600 font-medium mb-2">Nama Kategori</label>
                    <input type="text" id="nama_kategori" name="nama_kategori" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan nama kategori" required>
                </div>
                <button type="submit" name="add_category" class="mt-4 bg-green-600 text-white px-6 py-2 rounded-lg hover:bg-green-700 transition duration-300">Tambah Kategori</button>
            </form>
        </div>

        <!-- Daftar Kategori -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Daftar Kategori</h2>
            <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">No</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Nama Kategori</th>
                        <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @if ($kategori == null)
                        <td>Belum ada kategori yang ditambahkan</td>
                    @else
                        @foreach ($kategori as $kategoris)
                            <tr>
                                <td class="py-3 px-4">{{ $loop->iteration }}</td>
                                <td class="py-3 px-4">{{ $kategoris -> nama_kategori }}</td>
                                <td class="py-3 px-4">
                                    <form action="{{ route('hapusKategori', ['id'=>$kategoris->id]) }}" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:underline bg-none border-none cursor-pointer">Hapus</button>
                                    </form>
                                </td>
                                </tr>
                        @endforeach 
                    @endif
                </tbody>
            </table>
        </div>
</div>

@include('admin.admin-layout.footer')
