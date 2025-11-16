<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\BarangKeluar;
use App\Models\Permintaan;
use App\Models\LaporanKerusakan;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller
{
    public function generateView()
    {
        return view('admin.generate-laporan');
    }

    public function exportStok()
    {
        $fileName = 'stok_export_' . date('Ymd_His') . '.csv';
        $stoks = Stok::with('kategori', 'rak', 'supplier')->get();

        $response = new StreamedResponse(function() use ($stoks) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Nama Barang', 'Kategori', 'Jumlah', 'Rak', 'Supplier']);
            foreach ($stoks as $s) {
                fputcsv($handle, [
                    $s->id,
                    $s->nama_barang,
                    $s->kategori->nama_kategori ?? '',
                    $s->jumlah,
                    $s->rak->lokasi ?? '',
                    $s->supplier->nama_supplier ?? '',
                ]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        return $response;
    }

    public function exportBarangKeluar()
    {
        $fileName = 'barang_keluar_export_' . date('Ymd_His') . '.csv';
        $items = BarangKeluar::with('stok.kategori', 'stok.rak')->get();

        $response = new StreamedResponse(function() use ($items) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Nama Barang', 'Kategori', 'Jumlah', 'Tanggal Keluar', 'Keterangan']);
            foreach ($items as $it) {
                fputcsv($handle, [
                    $it->id,
                    $it->stok->nama_barang ?? '',
                    $it->stok->kategori->nama_kategori ?? '',
                    $it->jumlah,
                    $it->tanggal_keluar,
                    $it->keterangan,
                ]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        return $response;
    }

    public function exportPermintaan()
    {
        $fileName = 'permintaan_export_' . date('Ymd_His') . '.csv';
        $items = Permintaan::all();

        $response = new StreamedResponse(function() use ($items) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Nama Pengaju', 'Nama Barang', 'Jumlah', 'Alasan', 'Status', 'Tanggal']);
            foreach ($items as $it) {
                fputcsv($handle, [
                    $it->id,
                    $it->nama_pengaju,
                    $it->nama_barang,
                    $it->jumlah,
                    $it->alasan,
                    $it->status,
                    $it->created_at,
                ]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        return $response;
    }

    public function exportLaporanKerusakan()
    {
        $fileName = 'laporan_kerusakan_export_' . date('Ymd_His') . '.csv';
        $items = LaporanKerusakan::with('stok')->get();

        $response = new StreamedResponse(function() use ($items) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['ID', 'Nama Barang', 'Jumlah', 'Keterangan', 'Status', 'Tanggal']);
            foreach ($items as $it) {
                fputcsv($handle, [
                    $it->id,
                    $it->stok->nama_barang ?? '',
                    $it->jumlah,
                    $it->keterangan,
                    $it->status,
                    $it->tanggal,
                ]);
            }
            fclose($handle);
        });

        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');
        return $response;
    }
}
