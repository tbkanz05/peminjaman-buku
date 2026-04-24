<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function adminIndex()
    {
        $data = Peminjaman::with('user')->get();
        return view('admin.peminjaman', compact('data'));
    }

    public function acc($id)
    {
        $p = Peminjaman::find($id);
        $p->status = 'disetujui';
        $p->save();

        return back();
    }

    public function tolak($id)
    {
        $p = Peminjaman::find($id);
        $p->status = 'ditolak';
        $p->save();

        return back();
    }
}
