<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KelAnggota;
use App\Models\Keuangan;
use RealRashid\SweetAlert\Facades\Alert;

class KeuanganController extends Controller
{

    public function index(Request $request)
    {
        $tahunSekarang = date('Y');
        $namaAnggota = KelAnggota::all();
        $dataBulan = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];

        // Fungsi pencarian berdasarkan nama anggota
        if ($request->has('search') && $request->search != '') {
            $namaAnggota = KelAnggota::where('Nama_Anggota', 'like', '%' . $request->search . '%')->get();
        } else {
            $namaAnggota = KelAnggota::all();
        }
        foreach ($namaAnggota as $anggota) {
            foreach ($dataBulan as $index => $bulan) {
                $bulanAngka = $index + 1;
                $keuangan = Keuangan::where('member_id', $anggota->id)
                    ->whereMonth('tanggal', $bulanAngka)
                    ->whereYear('tanggal', $tahunSekarang)
                    ->first();

                $anggota->{$bulan . '_status'} = $keuangan && $keuangan->status_pembayaran == 'Lunas' ? 'Lunas' : '';
            }
        }

        return view('admin.keuangan.pemasukan', compact('namaAnggota', 'dataBulan', 'tahunSekarang'));
    }


    public function store(Request $request)
    {
        $anggota = KelAnggota::where('Nama_Anggota', $request->input('Nama_Anggota'))->first();
        if (!$anggota) {
            toast('Anggota tidak ditemukan.', 'error');
            return redirect()->back();
        }

        // Cek apakah sudah ada pembayaran lunas pada tanggal yang sama
        $keuanganExist = Keuangan::where('member_id', $anggota->id)
            ->where('tanggal', $request->input('tanggal'))
            ->where('status_pembayaran', 'Lunas')
            ->exists();

        if ($keuanganExist) {
            toast('Pembayaran pada tanggal ini sudah Lunas.', 'error');
            return redirect()->back();
        }

        $keuangan = new Keuangan([
            'member_id' => $anggota->id,
            'tanggal' => $request->input('tanggal'),
            'jumlah' => $request->input('jumlah'),
            'status_pembayaran' => $request->input('status_pembayaran')
        ]);

        try {
            $keuangan->save();
            toast('Data berhasil disimpan.', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            toast('Gagal menyimpan data: ' . $e->getMessage(), 'error');
            return redirect()->back();
        }
    }
}
