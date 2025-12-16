@extends('layouts.master')

@section('title', 'Detail Siswa')

@section('content')
<div class="col-lg-17" style="padding-left: 10px; padding-right: 10px;">
  <div class="card">
    <div class="card-body">
      <h3>Detail Siswa: {{ $siswa->nama }}</h3>
      <hr>

      <div class="row mb-3">
        <div class="col-md-6">
          <p><strong>Alamat:</strong> {{ $siswa->alamat }}</p>
          <p><strong>Jenis Kelamin:</strong> {{ $siswa->jenis_kelamin }}</p>
          <p><strong>Agama:</strong> {{ $siswa->agama }}</p>
          <p><strong>Tanggal Lahir:</strong> {{ $siswa->tanggal_lahir }}</p>
          <p><strong>Nama Orang Tua:</strong> {{ $siswa->nama_ortu }}</p>
          <p><strong>No. Orang Tua:</strong> {{ $siswa->no_ortu }}</p>
          <p><strong>Sesi:</strong> {{ $siswa->sesi->nama_sesi ?? '-' }}</p>
        </div>
        <div class="col-md-6 text-center">
          @if($siswa->foto_diri)
            <img src="{{ asset('storage/' . $siswa->foto_diri) }}" 
                 alt="Foto Diri" class="img-thumbnail mb-2" width="150">
          @endif
          <br>
          @if($siswa->foto_kk)
            <img src="{{ asset('storage/' . $siswa->foto_kk) }}" 
                 alt="Foto KK" class="img-thumbnail mb-2" width="150">
          @endif
          <br>
          @if($siswa->foto_akta)
            <img src="{{ asset('storage/' . $siswa->foto_akta) }}" 
                 alt="Foto Akta" class="img-thumbnail" width="150">
          @endif
        </div>
      </div>

      <hr>
      <h5>Riwayat Pembayaran</h5>
      <div class="table-responsive">
        <table class="table table-striped align-middle">
          <thead class="table-light text-center">
            <tr>
              <th>No</th>
              <th>Tanggal Pembayaran</th>
              <th>Jumlah</th>
              <th>Metode</th>
            </tr>
          </thead>
          <tbody>
            @forelse($siswa->pembayaran as $p)
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ $p->tanggal_pembayaran }}</td>
                <td class="text-center">Rp {{ number_format($p->jumlah_pembayaran, 0, ',', '.') }}</td>
                <td class="text-center">{{ $p->metode_pembayaran }}</td>
              </tr>
            @empty
              <tr>
                <td colspan="4" class="text-center text-muted">Belum ada pembayaran</td>
              </tr>
            @endforelse
          </tbody>
        </table>
      </div>

    <a href="{{ route('siswa.cetak', $siswa->id_siswa) }}" 
       class="btn btn-success mt-3" target="_blank">
       <iconify-icon icon="mdi:file-pdf-box"></iconify-icon> Cetak
    </a>

    <a href="{{ route('siswa.index', $siswa->id_sesi) }}" class="btn btn-secondary mt-3">
        <iconify-icon icon="tabler:arrow-back-up"></iconify-icon> Kembali
    </a>
    </div>
  </div>
</div>
@endsection
