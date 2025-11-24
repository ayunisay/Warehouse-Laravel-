<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class KelolaUserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.kelola-user', ['users' => $users]);
    }

    public function tambahUserSubmit(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'role' => 'required|in:user,admin',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Create User',
            'model_type' => User::class,
            'model_id' => $user->id,
            'description' => "Buat user: {$request->name} ({$request->role})",
        ]);

        return redirect()->route('kelolaUser')->with('success', 'User berhasil ditambahkan!');
    }

    public function editUser($id)
    {
        $user = User::find($id);
        $users = User::all();
        return view('admin.kelola-user', ['users' => $users, 'editUser' => $user]);
    }

    public function editUserSubmit(Request $request, $id)
    {
        $user = User::find($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|string|min:6',
            'role' => 'required|in:user,admin',
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Edit User',
            'model_type' => User::class,
            'model_id' => $user->id,
            'description' => "Edit user: {$request->name} ({$request->role})",
        ]);

        return redirect()->route('kelolaUser')->with('success', 'User berhasil diperbarui!');
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if (!$user) {
            return redirect()->route('kelolaUser')->with('error', 'User tidak ditemukan.');
        }

        // Prevent deleting if this is the last account with this role
        $role = $user->role;
        $count = User::where('role', $role)->count();
        if ($count <= 1) {
            return redirect()->route('kelolaUser')->with('error', "Tidak dapat menghapus akun. Hanya tersisa satu akun dengan role '{$role}'.");
        }

        $userName = $user->name;
        $user->delete();

        ActivityLog::create([
            'user_id' => Auth::id(),
            'actor_name' => Auth::user()->name ?? null,
            'action' => 'Delete User',
            'model_type' => User::class,
            'model_id' => $id,
            'description' => "Hapus user: {$userName}",
        ]);

        return redirect()->route('kelolaUser')->with('success', 'User berhasil dihapus!');
    }
}

