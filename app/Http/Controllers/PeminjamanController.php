<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;
use App\Models\Peminjaman;
use App\Models\DetailPeminjaman;

class PeminjamanController extends Controller
{
    public function index()
    {
        $buku = Buku::all();
        return view('pinjam.index', compact('buku'));
    }

    public function riwayat()
    {
        $data = Peminjaman::where('user_id', auth()->id())->with('detail.buku')->latest()->get();
        return view('pinjam.riwayat', compact('data'));
    }

    public function adminIndex()
    {
        $data = Peminjaman::with('user', 'detail.buku')->latest()->get();
        return view('admin.peminjaman', compact('data'));
    }

    public function cetak()
    {
        $data = Peminjaman::with('user', 'detail.buku')->latest()->get();
        return view('admin.peminjaman-cetak', compact('data'));
    }

    public function store(Request $request)
    {
        $buku = Buku::findOrFail($request->buku_id);
        
        if ($buku->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku ini sudah habis!');
        }

        // Kurangi stok segera saat mengajukan
        $buku->stok -= 1;
        $buku->save();

        $pinjam = Peminjaman::create([
            'user_id' => auth()->id(),
            'tanggal_pinjam' => now(),
            'jatuh_tempo' => $request->jatuh_tempo ?? now()->addDays(7),
            'status' => 'menunggu'
        ]);

        DetailPeminjaman::create([
            'peminjaman_id' => $pinjam->id,
            'buku_id' => $request->buku_id
        ]);

        return back()->with('success', 'Berhasil mengajukan pinjaman. Stok buku telah dikurangi.');
    }

    public function acc($id)
    {
        $p = Peminjaman::find($id);

        // ubah status
        $p->status = 'disetujui';
        $p->save();

        return back()->with('success', 'Peminjaman telah disetujui');
    }

    public function tolak($id)
    {
        $p = Peminjaman::find($id);
        
        // Kembalikan stok karena peminjaman ditolak
        $detail = DetailPeminjaman::where('peminjaman_id', $p->id)->first();
        if ($detail) {
            $buku = Buku::find($detail->buku_id);
            if ($buku) {
                $buku->stok += 1;
                $buku->save();
            }
        }

        $p->status = 'ditolak';
        $p->save();

        return back()->with('success', 'Peminjaman ditolak dan stok buku telah dikembalikan');
    }

    public function kembali($id)
    {
        $p = Peminjaman::find($id);
        
        if ($p->status != 'disetujui') {
            return back()->with('error', 'Hanya buku yang sedang dipinjam yang bisa dikembalikan.');
        }

        // ubah status menjadi menunggu konfirmasi pengembalian
        $p->status = 'menunggu_kembali';
        $p->save();

        return back()->with('success', 'Permintaan pengembalian telah dikirim. Menunggu konfirmasi admin.');
    }

    public function accKembali($id)
    {
        $p = Peminjaman::findOrFail($id);
        
        if ($p->status != 'menunggu_kembali') {
            return back()->with('error', 'Status tidak valid untuk konfirmasi pengembalian.');
        }

        // ambil detail buku
        $detail = DetailPeminjaman::where('peminjaman_id', $p->id)->first();
        $buku = Buku::find($detail->buku_id);

        // tambah stok kembali
        if ($buku) {
            $buku->stok += 1;
            $buku->save();
        }

        // hitung denda final
        $jatuh_tempo = \Carbon\Carbon::parse($p->jatuh_tempo)->startOfDay();
        $hari_kembali = now()->startOfDay(); // Denda dihitung sampai hari disetujui kembali
        
        if ($hari_kembali->gt($jatuh_tempo)) {
            $selisih = $hari_kembali->diffInDays($jatuh_tempo);
            $p->denda = $selisih * 2000;
        }

        // ubah status menjadi kembali
        $p->status = 'kembali';
        $p->tanggal_kembali = now();
        $p->save();

        $msg = 'Pengembalian buku telah disetujui.';
        if ($p->denda > 0) {
            $msg .= ' Denda tercatat: Rp ' . number_format($p->denda, 0, ',', '.');
        }

        return back()->with('success', $msg);
    }

    public function destroy($id)
    {
        $p = Peminjaman::findOrFail($id);
        
        // Hapus detailnya dulu
        DetailPeminjaman::where('peminjaman_id', $p->id)->delete();
        
        $p->delete();

        return back()->with('success', 'Data peminjaman berhasil dihapus');
    }
}
