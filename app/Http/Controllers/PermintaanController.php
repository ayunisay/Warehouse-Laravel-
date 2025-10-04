<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermintaanController extends Controller
{
    public function index()
    {
        return view('user.permintaan-barang');
    }
    public function index2()
    {
        return view('admin.kelola-permintaan');
    }
}
