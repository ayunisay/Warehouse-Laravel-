@include('user.user-layout.header')
<!-- Main Content -->
    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Laporan Kerusakan</h1>

        <!-- Damage Report Form -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">
                <?php echo $edit_data ? "Edit Laporan Kerusakan" : "Tambah Laporan Kerusakan"; ?>
            </h2>
            <form method="POST">
                <?php if ($edit_data): ?>
                    <input type="hidden" name="id_barang" value="<?php echo htmlspecialchars($edit_data['id_barang']); ?>">
                <?php endif; ?>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="id_barang" class="block text-gray-600 font-medium mb-2">Nama Barang</label>
                        <select id="id_barang" name="id_barang" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" required>
                            <option value="" disabled selected>Pilih Barang</option>
                            <?php
                            $barangResult = $conn->query("SELECT * FROM stok_barang");
                            if ($barangResult && $barangResult->num_rows > 0) {
                                while ($id_barang = $barangResult->fetch_assoc()) {
                                    $selected = ($edit_data && $edit_data['id_barang'] === $id_barang['id_barang']) ? 'selected' : '';
                                    echo "<option value='" . htmlspecialchars($id_barang['id_barang']) . "' $selected>" . htmlspecialchars($id_barang['nama_barang']) . "</option>";
                                }
                            } else {
                                echo "<option value='' disabled>Tidak ada kategori tersedia</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="jumlah" class="block text-gray-600 font-medium mb-2">Jumlah</label>
                        <input type="number" id="jumlah" name="jumlah" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Masukkan jumlah barang" value="<?php echo $edit_data ? htmlspecialchars($edit_data['jumlah']) : ''; ?>" " required>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="deskripsi" class="block text-gray-600 font-medium mb-2">Deskripsi Kerusakan</label>
                    <textarea id="deskripsi" name="deskripsi" rows="4" class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500" placeholder="Jelaskan kerusakan atau kehilangan barang" required><?php echo $edit_data ? htmlspecialchars($edit_data['deskripsi']) : ''; ?></textarea>
                </div>
                <button type="submit" name="insert" class="mt-4 bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-300">Kirim Laporan</button>
            </form>
        </div>

        <!-- Damage Report History -->
        <div class="bg-white shadow-md rounded-lg p-6 mt-8 flex-grow">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Riwayat Laporan Kerusakan</h2>
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
                        <?php
                        // Ambil data dari tabel request
                        $sql = "SELECT barang_rusak.id_barang_rsk, stok_barang.id_barang, stok_barang.nama_barang, barang_rusak.jumlah, barang_rusak.deskripsi, barang_rusak.status, barang_rusak.tanggal FROM barang_rusak JOIN stok_barang ON barang_rusak.id_barang = stok_barang.id_barang ORDER BY barang_rusak.tanggal DESC"; 
                        $result = $conn->query($sql);
                        $no = 1;

                        if ($result && $result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr class='hover:bg-gray-50'>
                                        <td class='py-3 px-4'>" . htmlspecialchars($no++) . "</td>
                                        <td class='py-3 px-4'>" . htmlspecialchars($row['nama_barang']) . "</td>
                                        <td class='py-3 px-4'>" . htmlspecialchars($row['jumlah']) . "</td>
                                        <td class='py-3 px-4'>" . htmlspecialchars($row['deskripsi']) . "</td>
                                        <td class='py-3 px-4'>
                                            <span class='px-2 py-1 rounded-lg text-white " .  
                                            ($row['status'] === 'Resolved' ? 'bg-green-500' : ($row['status'] === 'Rejected' ? 'bg-red-500' : 'bg-yellow-500')) . "'>
                                                " . htmlspecialchars($row['status']) . "
                                            </span>
                                        </td>
                                        <td class='py-3 px-4'>" . htmlspecialchars($row['tanggal']) . "</td>
                                        <td class='py-3 px-4'>";
                                        if ($row['status'] === 'Pending') {
                                            echo "<a href='?edit=" . $row['id_barang_rsk'] . "' class='text-blue-500 hover:underline'>Edit</a> | <a href='?delete=" . $row['id_barang_rsk'] . "' onclick=\"return confirm('Yakin ingin menghapus?')\" class='text-red-500 hover:underline'>Hapus</a>";
                                } else {
                                    echo "<span class='text-gray-400'>-</span>";
                                }
                                echo "</td>
                                    </tr>";
                            }
                        } else {
                            echo "<tr>
                                    <td colspan='7' class='py-3 px-4 text-center text-gray-500'>Belum ada data permintaan barang.</td>
                                  </tr>";
                        }
                        ?>
                    </tbody>
                </table>
        </div>
    </div>
@include('user.user-layout.footer')