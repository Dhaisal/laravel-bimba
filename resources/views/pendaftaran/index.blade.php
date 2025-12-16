
@extends('layouts.master')

@section('title', 'Daftar Pendaftar Bimba')

@section('content')
<div class="col-lg-17" style="padding-left: 10px; padding-right: 10px;">
  <div class="card">
    <div class="card-body ">
      <h2 >Data Pendaftar Bimba</h2> <br>
      <div class="container">
        <!-- Wrapper untuk tombol dan search bar -->
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
          
            <div class="mb-2 mb-md-0">
                <a href="{{ route('dashboard') }}" class="btn btn-warning m-1 d-inline-flex align-items-center gap-1">
                    <iconify-icon icon="tabler:arrow-back-up" class="fs-5"></iconify-icon>
                    Kembali
                </a>
            
                <a href="{{ route('pendaftaran.create') }}" class="btn btn-primary d-inline-flex align-items-center gap-1">
                    <iconify-icon icon="mdi:plus-bold" class="fs-5"></iconify-icon>
                    Tambah Data Pendaftar
                </a>
            </div>


            <form action="{{ route('pendaftaran.index') }}" method="GET">
                <div style="max-width: 400px; width: 100%;">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search..." name="cari" value="{{ request('cari') }}">
                        <button type="submit" class="btn btn-outline-secondary">
                            <iconify-icon icon="mdi:magnify" class="fs-6"></iconify-icon>
                        </button>
                    </div>
                </div>
            </form>

            @if($data->isEmpty())
              <div class="alert alert-warning">
                Data tidak ditemukan untuk kata kunci: <strong>{{ request('cari') }}</strong>
              </div>
            @endif


        </div>
      </div>
</div>
      <div class="table-responsive">
        <table class="table table-striped" >
          <thead>
            <tr class="border-2 border-bottom border-primary border-0"> 
            <th scope="col" class="text-center">No</th>
              <th scope="col" class="text-center">Nama</th>
              <th scope="col" class="text-center">Alamat</th>
              <th scope="col" class="text-center">Jenis Kelamin</th>
               <th scope="col" class="text-center">Tanggal lahir</th>
                <th scope="col" class="text-center">No Telepon</th>
                <th scope="col" class="text-center">Foto diri</th>
                <th scope="col" class="text-center">Aksi</th>
              <th scope="col" class="text-center">Opsi</th>
            </tr>
          </thead>
          <tfoot>
            <tr class="border-2 border-top border-primary border-0"> 
            <th scope="col" class="text-center">No</th>
              <th scope="col" class="text-center">Nama</th>
              <th scope="col" class="text-center">Alamat</th>
              <th scope="col" class="text-center">Jenis Kelamin</th>
                <th scope="col" class="text-center">Tanggal lahir</th>
                <th scope="col" class="text-center">No Telepon</th>
                <th scope="col" class="text-center">Foto diri</th>
                <th scope="col" class="text-center">Aksi</th>
              <th scope="col" class="text-center">Opsi</th>
            </tr>
          </tfoot>
        <tbody>
            @forelse ($data as $p)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $p->nama }}</td>
                    <td class="text-center">{{ $p->alamat }}</td>
                    <td class="text-center">{{ $p->jenis_kelamin }}</td>
                    <td class="text-center">{{ $p->tanggal_lahir }}</td>
                    <td class="text-center">{{ $p->no_ortu }}</td>
                    <td class="text-center">
                        @if($p->foto_diri)
                            <img src="{{ asset('storage/' . $p->foto_diri) }}" width="50" height="50" class="rounded">
                        @else
                            -
                        @endif
                    </td>
                    <td>
                       <a href="{{ route('pendaftaran.bayar', $p->id_pendaftaran) }}" class="btn btn-primary btn-sm">Pembayaran</a>
                    </td>
                    <td class="text-center">
                        <a href="{{ route('pendaftaran.edit', $p->id_pendaftaran) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('pendaftaran.destroy', $p->id_pendaftaran) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin mau hapus?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Belum ada data pendaftaran</td>
                </tr>
            @endforelse
        </tbody>

        </table>
      </div>
    </div>
  </div>
</div>

@endsection
