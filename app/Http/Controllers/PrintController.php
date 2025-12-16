<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DetailPembayaran;
use App\Models\Pendaftaran;
use Carbon\Carbon;

class PrintController extends Controller
{
    public function index(Request $request)
    {
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');
        $tipe = $request->input('tipe_data', 'sudah'); // default: sudah administrasi

        $records = collect();

        if ($tipe === 'sudah') {
            // Sudah bayar = ambil dari DetailPembayaran
            if ($dari && $sampai) {
                $from =Carbon::parse($dari)->startOfDay();
                $to   =Carbon::parse($sampai)->endOfDay();

                $records = DetailPembayaran::with('siswa')
                    ->whereBetween('tanggal_pembayaran', [$from, $to])
                    ->orderBy('tanggal_pembayaran', 'asc')
                    ->get();
            }
        } else {
            // Belum bayar = ambil langsung dari tabel Pendaftaran
            if ($dari && $sampai) {
                $from =Carbon::parse($dari)->startOfDay();
                $to   =Carbon::parse($sampai)->endOfDay();

                $records = Pendaftaran::query()
                    ->whereBetween('created_at', [$from, $to])
                    ->orderBy('created_at', 'asc')
                    ->get();
            } else {
                // Kalau tanggal belum diisi, ambil semua
                $records = Pendaftaran::orderBy('created_at', 'asc')->get();
            }
        }

        return view('print.index', [
            'pendaftar' => $records,
            'dari' => $dari,
            'sampai' => $sampai,
            'tipe' => $tipe,
        ]);
    }


    public function cetak(Request $request)
    {
        $dari = $request->input('dari');
        $sampai = $request->input('sampai');
        $tipe = $request->input('tipe', 'sudah');

        if ($tipe === 'sudah') {
            $from =Carbon::parse($dari)->startOfDay();
            $to   =Carbon::parse($sampai)->endOfDay();

            $records =DetailPembayaran::with('siswa')
                ->whereBetween('tanggal_pembayaran', [$from, $to])
                ->orderBy('tanggal_pembayaran', 'asc')
                ->get();
        } else {
            $from =Carbon::parse($dari)->startOfDay();
            $to   =Carbon::parse($sampai)->endOfDay();

            $records =Pendaftaran::query()
                ->whereBetween('created_at', [$from, $to])
                ->orderBy('created_at', 'asc')
                ->get();
        }

        return view('print.print', [
            'pendaftar' => $records,
            'dari' => $dari,
            'sampai' => $sampai,
            'tipe' => $tipe,
        ]);
    }

    
}
