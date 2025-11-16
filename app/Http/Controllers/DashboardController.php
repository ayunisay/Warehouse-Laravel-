<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Permintaan;
use App\Models\BarangKeluar;
use App\Models\LaporanKerusakan;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboardUser()
    {
        // Get stock summary data
        $totalStok = Stok::sum('jumlah');
        $totalItems = Stok::count();
        
        // Get low stock items (less than 5)
        $lowStockItems = Stok::where('jumlah', '<', 5)->with('kategori', 'rak')->get();
        
        // Get user's recent activities (activity log)
        $recentActivities = ActivityLog::where('user_id', auth()->id())->orderBy('created_at', 'desc')->limit(10)->get();

        return view('user-dashboard', compact(
            'totalStok',
            'totalItems',
            'lowStockItems',
            'recentActivities'
        ));
    }

    public function dashboardAdmin()
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

        // Admin activity logs
        $auditLogs = ActivityLog::orderBy('created_at', 'desc')->limit(10)->get();

        return view('admin-dashboard', compact(
            'totalItems',
            'pendingRequests',
            'completedTransactions',
            'permintaanTrend',
            'laporanKerusakan',
            'auditLogs'
        ));
    }
}
