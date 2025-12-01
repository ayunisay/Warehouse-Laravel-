# Warehouse Management System (WMS)

Sistem Manajemen Gudang berbasis web yang dikembangkan menggunakan Framework Laravel untuk mengelola inventaris secara digital dan real-time.

## 📋 Deskripsi

Warehouse Management System adalah aplikasi web yang dirancang untuk mengoptimalkan pengelolaan gudang melalui sistem inventaris digital, pelacakan barang keluar-masuk, sistem approval permintaan barang, dan audit trail yang komprehensif. Sistem ini menggunakan Role-Based Access Control (RBAC) untuk memisahkan hak akses antara Admin dan User.

## ✨ Fitur Utama

### Admin
- **Dashboard** - Monitoring total stok, transaksi, dan tren permintaan
- **Manajemen Stok** - CRUD stok barang dengan pengurangan otomatis
- **Kelola Kategori** - Manajemen kategori barang
- **Kelola Rak** - Pengaturan lokasi penyimpanan barang
- **Kelola Supplier** - Manajemen data supplier
- **Approval Permintaan** - Menyetujui/menolak permintaan barang dari user
- **Approval Laporan Kerusakan** - Mengelola laporan kerusakan barang
- **Riwayat Barang Keluar** - Monitoring semua transaksi barang keluar
- **Manajemen User** - CRUD data pengguna dan role
- **Audit Trail Lengkap** - Tracking semua aktivitas sistem
- **Generate Laporan** - Export laporan ke format CSV

### User
- **Dashboard** - Total stok, low stok, dan aktivitas terbaru
- **Lihat Stok** - View daftar stok tersedia (read-only)
- **Barang Keluar** - Input transaksi pengeluaran barang
- **Permintaan Barang** - Mengajukan request barang ke admin
- **Laporan Kerusakan** - Melaporkan barang rusak
- **Audit Trail Personal** - Melihat log aktivitas sendiri

## 🛠️ Tech Stack

- **Framework:** Laravel 12
- **Database:** MySQL 8.0
- **Frontend:** Blade Template Engine, Tailwind CSS
- **Backend:** PHP 8.3
- **Web Server:** Laragon
- **Version Control:** Git & GitHub

## 📦 Instalasi

### Prerequisites
- PHP >= 8.3
- Composer
- MySQL 8.0
- Node.js & NPM (untuk Tailwind CSS)

### Langkah Instalasi

1. **Clone Repository**
```bash
git clone https://github.com/ayunisay/Warehouse-Laravel.git
cd Warehouse-Laravel
```

2. **Install Dependencies**
```bash
composer install
npm install
```

3. **Setup Environment**
```bash
cp .env.example .env
```

4. **Generate Application Key**
```bash
php artisan key:generate
```

5. **Konfigurasi Database**

Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=warehouse2
DB_USERNAME=root
DB_PASSWORD=
```

6. **Jalankan Migration & Seeder**
```bash
php artisan migrate --seed
```

7. **Compile Assets**
```bash
npm run dev
```

8. **Jalankan Server**
```bash
php artisan serve
```

Aplikasi dapat diakses di `http://localhost:8000`

## 👥 Default Credentials

### Admin
```
Email: admin@gmail.com
Password: admin123
```

### User
```
Email: user@gmail.com
Password: user123
```

## 📂 Struktur Database

Sistem menggunakan database relasional dengan tabel utama:
- `users` - Data pengguna dan role
- `stocks` - Inventaris barang
- `categories` - Kategori barang
- `racks` - Lokasi penyimpanan
- `suppliers` - Data supplier
- `outbound_transactions` - Transaksi barang keluar
- `stock_requests` - Permintaan barang
- `damage_reports` - Laporan kerusakan
- `audit_logs` - Catatan aktivitas sistem

## 📈 Export Laporan

Sistem mendukung export laporan ke format **CSV** untuk:
- Laporan Stok Barang
- Riwayat Barang Keluar
- Permintaan Barang
- Laporan Kerusakan

## 📝 License

Project ini dibuat untuk keperluan tugas akademik di Universitas Singaperbangsa Karawang.

## 👨‍💻 Authors

- **Ayunisa Yasmin** - *Developer* - [ayunisay](https://github.com/ayunisay)
**Informatika, Fakultas Ilmu Komputer**  
**Universitas Singaperbangsa Karawang**

## 📧 Contact

Untuk pertanyaan atau saran, silakan hubungi:
- Email: 2310631170008@student.unsika.ac.id

## 🙏 Acknowledgments

- Framework Laravel Documentation
- Tailwind CSS Documentation
- MySQL Documentation
- Dosen Pembimbing & Universitas Singaperbangsa Karawang

---

⭐ Jangan lupa berikan star jika project ini bermanfaat!
