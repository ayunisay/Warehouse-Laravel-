@include('admin.admin-layout.header')

    <div class="container mx-auto mt-8 flex-grow">
        <h1 class="text-3xl font-bold text-gray-700 mb-6">Audit Trail</h1>


        <div class="bg-white shadow-md rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-700 mb-4">Log Aktivitas Sistem</h2>
            <div class="mt-8">
                    <form method="POST" action="{{ route('deleteAllLogs') }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus semua log aktivitas?');">
                        @csrf
                        <button type="submit" name="delete_all_logs" class="bg-red-600 text-white px-6 py-2 rounded-lg hover:bg-red-700 transition duration-300">
                            Hapus Semua Log
                        </button>
                    </form>
                </div>
            <div class="overflow-x-auto mt-2">
                <table class="min-w-full bg-white border border-gray-300 rounded-lg">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="py-3 px-6 border-b text-left text-gray-600 font-medium">Tanggal</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Waktu</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Pengguna</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Aksi</th>
                            <th class="py-3 px-4 border-b text-left text-gray-600 font-medium">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @if(empty($auditLogs) || $auditLogs->isEmpty())
                            <tr>
                                <td colspan='4' class='py-3 px-4 text-center text-gray-500'>Belum ada aktivitas.</td>
                            </tr>
                        @else
                            @foreach($auditLogs as $log)
                                <tr class='hover:bg-gray-50'>
                                    <td class='py-3 px-4'>{{ \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Jakarta')->format('d/m/Y') }}</td>
                                    <td class='py-3 px-4'>{{ \Carbon\Carbon::parse($log->created_at)->setTimezone('Asia/Jakarta')->format('H:i:s') }}</td>
                                    <td class='py-3 px-4'>{{ $log->actor_name ?? 'System' }}</td>
                                    <td class='py-3 px-4'>{{ $log->action }}</td>
                                    <td class='py-3 px-4'>{{ \Illuminate\Support\Str::limit($log->description, 80) }}</td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@include('admin.admin-layout.footer')
