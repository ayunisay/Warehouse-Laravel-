<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
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

        return redirect()->route('kelolaUser')->with('success', 'User berhasil diperbarui!');
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
        return redirect()->route('kelolaUser')->with('success', 'User berhasil dihapus!');
    }
}

