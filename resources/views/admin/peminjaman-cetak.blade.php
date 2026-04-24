<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Peminjaman Buku</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 20px;
            color: #000;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            text-transform: uppercase;
        }
        .header p {
            margin: 5px 0 0 0;
            font-size: 14px;
        }
        .title {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 20px;
            text-transform: uppercase;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        th, td {
            border: 1px solid #000;
            padding: 8px 12px;
            text-align: left;
            font-size: 14px;
        }
        th {
            background-color: #f2f2f2;
            -webkit-print-color-adjust: exact;
        }
        .text-center {
            text-align: center;
        }
        .signature-container {
            margin-top: 50px;
            width: 100%;
            display: flex;
            justify-content: flex-end;
        }
        .signature {
            text-align: center;
            width: 250px;
        }
        .signature p {
            margin: 0 0 70px 0;
            font-size: 14px;
        }
        .signature .name {
            font-weight: bold;
            text-decoration: underline;
            margin-bottom: 0;
        }
        @media print {
            body {
                padding: 0;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <div class="no-print" style="margin-bottom: 20px;">
        <button onclick="window.print()" style="padding: 10px 20px; cursor: pointer; background: #4f46e5; color: white; border: none; border-radius: 5px;">Cetak Sekarang</button>
        <button onclick="window.close()" style="padding: 10px 20px; cursor: pointer; background: #6b7280; color: white; border: none; border-radius: 5px; margin-left: 10px;">Tutup</button>
    </div>

    <div class="header">
        <h1>Perpustakaan Digital</h1>
        <p>Jl. Contoh Alamat No. 123, Kota, Provinsi, Kode Pos 12345</p>
        <p>Email: perpus@contoh.com | Telp: (021) 1234567</p>
    </div>

    <div class="title">
        Laporan Daftar Peminjaman Buku
    </div>

    <p style="font-size: 14px; margin-bottom: 10px;">Tanggal Dicetak: {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}</p>

    <table>
        <thead>
            <tr>
                <th class="text-center" width="5%">No</th>
                <th width="20%">Nama Siswa</th>
                <th width="25%">Judul Buku</th>
                <th width="15%">Tgl Pinjam</th>
                <th width="15%">Batas Kembali</th>
                <th width="10%" class="text-center">Status</th>
                <th width="10%">Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($data as $index => $d)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ $d->user->name }}</td>
                    <td>{{ $d->detail->buku->judul ?? 'Buku dihapus' }}</td>
                    <td>{{ \Carbon\Carbon::parse($d->created_at)->translatedFormat('d M Y') }}</td>
                    <td>{{ $d->jatuh_tempo ? \Carbon\Carbon::parse($d->jatuh_tempo)->translatedFormat('d M Y') : '-' }}</td>
                    <td class="text-center" style="text-transform: capitalize;">
                        {{ str_replace('_', ' ', $d->status) }}
                    </td>
                    <td>
                        @php
                            $displayDenda = $d->denda;
                            if (($d->status == 'disetujui' || $d->status == 'menunggu_kembali') && now()->startOfDay()->gt(\Carbon\Carbon::parse($d->jatuh_tempo)->startOfDay())) {
                                $lateDays = now()->startOfDay()->diffInDays(\Carbon\Carbon::parse($d->jatuh_tempo)->startOfDay());
                                $displayDenda = $lateDays * 2000;
                            }
                        @endphp
                        {{ $displayDenda > 0 ? 'Rp ' . number_format($displayDenda, 0, ',', '.') : '-' }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data peminjaman.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="signature-container">
        <div class="signature">
            <p>Mengetahui,<br>Kepala Perpustakaan</p>
            <p class="name">{{ Auth::user()->name }}</p>
            <span style="font-size: 12px;">NIP. 19800101 200501 1 001</span>
        </div>
    </div>

</body>
</html>
