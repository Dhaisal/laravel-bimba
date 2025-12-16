@extends('layouts.master')

@section('title', 'Konfirmasi Pembayaran Pendaftaran')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $err )
                <li>{{$err}}</li>
            @endforeach
        </ul>
    </div>
@endif

@section('content')
<div class="col-lg-17" style="padding-left: 10px; padding-right: 10px;">
    <div class="card shadow-sm">
        <div class="card-body">
            <h3 class="mb-4 text-center">Konfirmasi Data Pendaftar</h3>
            <p class="text-muted text-center mb-4">Pastikan data berikut benar sebelum melakukan pembayaran.</p>

            {{-- Data Pendaftar --}}
            <div class="mb-4">
                <h5 class="mb-3">Data Diri</h5>
                <table class="table table-bordered">
                    <tr><th>Nama Lengkap</th><td>{{ $pendaftaran->nama }}</td></tr>
                    <tr><th>Alamat</th><td>{{ $pendaftaran->alamat }}</td></tr>
                    <tr><th>Jenis Kelamin</th><td>{{ $pendaftaran->jenis_kelamin }}</td></tr>
                    <tr><th>Agama</th><td>{{ $pendaftaran->agama }}</td></tr>
                    <tr><th>Tanggal Lahir</th><td>{{ \Carbon\Carbon::parse($pendaftaran->tanggal_lahir)->format('d M Y') }}</td></tr>
                    <tr><th>Nama Orang Tua</th><td>{{ $pendaftaran->nama_ortu }}</td></tr>
                    <tr><th>No. HP Orang Tua</th><td>{{ $pendaftaran->no_ortu }}</td></tr>
                </table>
            </div>

            {{-- Foto Dokumen --}}
            <div class="mb-4">
                <h5 class="mb-3">Berkas Pendaftaran</h5>
                <div class="row text-center">
                    <div class="col-md-4 mb-3">
                        <p class="fw-bold mb-2">Foto Diri</p>
                        @if($pendaftaran->foto_diri)
                            <img src="{{ asset('storage/' . $pendaftaran->foto_diri) }}" class="img-fluid rounded shadow" style="max-height:200px;">
                        @else
                            <p class="text-muted">Tidak ada file</p>
                        @endif
                    </div>
                    <div class="col-md-4 mb-3">
                        <p class="fw-bold mb-2">Kartu Keluarga</p>
                        @if($pendaftaran->foto_kk)
                            <img src="{{ asset('storage/' . $pendaftaran->foto_kk) }}" class="img-fluid rounded shadow" style="max-height:200px;">
                        @else
                            <p class="text-muted">Tidak ada file</p>
                        @endif
                    </div>
                    <div class="col-md-4 mb-3">
                        <p class="fw-bold mb-2">Akta Kelahiran</p>
                        @if($pendaftaran->foto_akta)
                            <img src="{{ asset('storage/' . $pendaftaran->foto_akta) }}" class="img-fluid rounded shadow" style="max-height:200px;">
                        @else
                            <p class="text-muted">Tidak ada file</p>
                        @endif
                    </div>
                </div>
            </div>

            {{-- Form Pembayaran --}}
            <div class="mt-5">
                <h5 class="mb-3">Detail Pembayaran</h5>

                <form action="{{ route('pendaftaran.konfirmasi', $pendaftaran->id_pendaftaran) }}" method="POST">
                    @csrf
                    <input type="hidden" name="id_pendaftaran" value="{{ $pendaftaran->id_pendaftaran }}">

                    {{-- Jumlah Pembayaran --}}
                    <div class="mb-3">
                        <label class="form-label">Jumlah Pembayaran</label>
                        <input type="text" class="form-control" value="Rp 500.000" readonly>
                        <input type="hidden" name="jumlah" value="500000">
                    </div>

                    {{-- Metode Pembayaran --}}
                    <div class="mb-3">
                        <label for="metode_pembayaran" class="form-label">Metode Pembayaran</label>
                        <select name="metode_pembayaran" id="metode_pembayaran" class="form-select" required>
                            <option value="">-- Pilih Metode --</option>
                            <option value="Tunai">Cash</option>
                            <option value="Transfer">Transfer Bank</option>
                        </select>
                    </div>

                    {{-- Pilih Sesi --}}
                    <div class="mb-3">
                        <label for="id_sesi" class="form-label">Pilih Sesi</label>
                        <select name="id_sesi" id="id_sesi" class="form-select" required>
                            <option value="">-- Pilih Sesi --</option>
                            @foreach($sesi as $k)
                                <option value="{{ $k->id_sesi }}">{{ $k->nama_sesi }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tombol --}}
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            Konfirmasi & Bayar
                        </button>
                        <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary btn-lg">Kembali</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
