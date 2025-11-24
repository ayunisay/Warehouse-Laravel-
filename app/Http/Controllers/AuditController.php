<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog;
use App\Models\LaporanKerusakan;
use App\Models\Permintaan;
use App\Models\Stok;
use Illuminate\Http\Request;

class AuditController extends Controller
{
    public function index()
    {
        return view('admin.audit-trail');
    }

    public function auditTrail()
    {
        // Get stock summary data
        $totalStok = Stok::sum('jumlah');
        $totalItems = Stok::count();

        
        // Get pending requests count
        $pendingRequests = Permintaan::where('status', 'Pending')->count();
        
        // Get completed/approved requests count
        $completedTransactions = Permintaan::where('status', 'Approved')->count();
        
        // Get trend data for permintaan (last 7 days)
        $permintaanTrend = Permintaan::where('created_at', '>=', now()->subDays(7))
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->get();
        
        // Get laporan kerusakan untuk ditampilkan di dashboard
        $laporanKerusakan = LaporanKerusakan::with('stok')
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Show all activity logs to admin (admin + user actions)
        $auditLogs = ActivityLog::orderBy('created_at', 'desc')->get();

        return view('admin.audit-trail', compact(
            'totalItems',
            'pendingRequests',
            'completedTransactions',
            'permintaanTrend',
            'laporanKerusakan',
            'auditLogs'
        ));
    }

    public function deleteAllLogs(Request $request)
    {
        // Remove all activity logs (admin action)
        ActivityLog::truncate();
        return redirect()->route('auditTrail')->with('success', 'Semua log aktivitas berhasil dihapus.');
    }
}
