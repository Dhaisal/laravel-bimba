@extends('layouts.master')

@section('title', 'Laporan Data Pendaftar (Berdasarkan Pembayaran)')

@section('content')
<div class="col-lg-17" style="padding-left: 10px; padding-right: 10px;">
  <div class="card">
    <div class="card-body ">
        <h3 class="fw-bold mb-3">Laporan Pendaftar (Berdasarkan Tanggal Pembayaran)</h3>
      <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">

            <div class="mb-2 mb-md-0">
                <a href="{{ route('dashboard') }}" class="btn btn-warning m-1 d-inline-flex align-items-center gap-1">
                    <iconify-icon icon="tabler:arrow-back-up" class="fs-5"></iconify-icon>
                    Kembali
                </a>
            </div>
        </div>    
      </div>

  <form method="GET" action="{{ route('print.index') }}" class="row g-3 mb-4">
    <div class="col-md-4">
      <label class="form-label">Dari Tanggal</label>
      <input type="date" name="dari" class="form-control" value="{{ old('dari', $dari) }}">
    </div>
    <div class="col-md-4">
      <label class="form-label">Sampai Tanggal</label>
      <input type="date" name="sampai" class="form-control" value="{{ old('sampai', $sampai) }}">
    </div>
    <div class="col-md-3">
      <label class="form-label">Kategori Data</label>
      <select name="tipe_data" class="form-select">
        <option value="sudah" {{ request('tipe_data') == 'sudah' ? 'selected' : '' }}>
          Sudah Administrasi
        </option>
        <option value="belum" {{ request('tipe_data') == 'belum' ? 'selected' : '' }}>
          Belum Administrasi
        </option>
      </select>
    </div>
    <div class="col-md-4 d-flex align-items-end">
      <button type="submit" class="btn btn-primary w-100">Tampilkan</button>
    </div>
  </form>


@if($pendaftar->count())

    <div class="text-end mt-3">
      <a href="{{ route('print.print', ['dari' => $dari, 'sampai' => $sampai, 'tipe' => $tipe]) }}" class="btn btn-success" target="_blank">
        Cetak Laporan
      </a>
    </div>
    <br>

    @if(($tipe ?? '') === 'sudah')
          {{-- TABLE PEMBAYARAN --}}
      <table class="table table-bordered table-striped">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama Siswa</th>
            <th>Alamat</th>
            <th>Tanggal Pembayaran</th>
            <th>Jumlah</th>
            <th>Metode</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pendaftar as $i => $rec)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $rec->siswa->nama ?? '-' }}</td>
            <td>{{ $rec->siswa->alamat ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($rec->tanggal_pembayaran)->format('d-m-Y') }}</td>
            <td>Rp {{ number_format($rec->jumlah_pembayaran,0,',','.') }}</td>
            <td>{{ $rec->metode_pembayaran }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
      

    @else
      {{-- TABLE PENDAFTARAN --}}
      <table class="table table-bordered table-striped">
        <thead class="table-light">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Tanggal Daftar</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pendaftar as $i => $row)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $row->nama ?? '-' }}</td>
            <td>{{ $row->alamat ?? '-' }}</td>
            <td>{{ $row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d-m-Y') : '-' }}</td>
            <td>Belum Administrasi</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif

  @else
    <p class="text-muted">Tidak ada data pembayaran/pendaftar untuk rentang tanggal tersebut.</p>
  @endif

</div>
</div>
</div>


@endsection
