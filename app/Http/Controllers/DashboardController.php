<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Sesi;
use App\Models\DetailPembayaran;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistik utama
        $totalSiswa = Siswa::count();
        $totalPembayaran = DetailPembayaran::sum('jumlah_pembayaran');
        $njir = pendaftaran::count();
        $sesiAktif = Sesi::count();
        $pendaftarHariIni = Siswa::whereMonth('created_at', Carbon::now()->month)->count();

        // Grafik jumlah pendaftar per bulan
        $dataBulan = [];
        $dataJumlah = [];
        $bulanIndo = ['Jan','Feb','Mar','Apr','Mei','Jun','Jul','Agu','Sep','Okt','Nov','Des'];
        for ($i = 1; $i <= 12; $i++) {
            $dataBulan[] = $bulanIndo[$i - 1];
            $dataJumlah[] = Siswa::whereMonth('created_at', $i)->count();
        }

        // Data terbaru
        $latestSiswa = Pendaftaran::latest()->take(5)->get();
        $latestPembayaran = DetailPembayaran::latest()->take(5)->get();

        return view('main.dashboard', compact(
            'totalSiswa',
            'totalPembayaran',
            'njir',
            'sesiAktif',
            'pendaftarHariIni',
            'dataBulan',
            'dataJumlah',
            'latestSiswa',
            'latestPembayaran'
        ));
    }
}
