<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function viewUser()
    {
        $users = User::all();
        return view('admin.kelola-user', ['user' => $users]);
    }

    public function tambahUserSubmit (Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);

        return redirect()->route('kelolaUser')->with('success', 'User berhasil ditambahkan!');
    }

    public function editUser($id)
    {
        $users = User::find($id);

        if (!$users) {
            return redirect()->route('kelolaUser')->with('error', 'Data tidak ditemukan');
        }
        return view('admin.kelola-user-edit', compact('user'));
    }

    public function editUserSubmit(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|in:admin,user',
        ]);

        $users = User::find($id);

        if (!$users) {
            return redirect()->route('kelolaUser')->with('error', 'User tidak ditemukan');
        }

        $users->update([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ]);
        return redirect()->route('kelolaUser')->with('success', 'User berhasil diupdate!');
    }

    public function deleteUser($id){
        User::find($id)->delete();
        return redirect()->route('kelolaUser')->with('success','User berhasil dihapus');
    }
}
