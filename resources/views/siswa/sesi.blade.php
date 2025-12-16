
@extends('layouts.master')

@section('title', 'Data Sesi Bimba')

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
            </div>

        </div>
      </div>
</div>
      <div class="table-responsive">
        <table class="table table-striped" >
          <thead>
            <tr class="border-2 border-bottom border-primary border-0"> 
            <th scope="col" class="text-center">No</th>
              <th scope="col" class="text-center">Nama Sesi</th>
              <th scope="col" class="text-center">Deskripsi</th>
              <th scope="col" class="text-center">Opsi</th>
            </tr>
          </thead>
          <tfoot>
            <tr class="border-2 border-top border-primary border-0"> 
            <th scope="col" class="text-center">No</th>
              <th scope="col" class="text-center">Nama Sesi</th>
              <th scope="col" class="text-center">Deskripsi</th>
              <th scope="col" class="text-center">Opsi</th>
            </tr>
          </tfoot>
        <tbody>
            @forelse ($data as $p)
                <tr>
                    <td class="text-center">{{ $loop->iteration }}</td>
                    <td class="text-center">{{ $p->nama_sesi }}</td>
                    <td class="text-center">{{ $p->deskripsi }}</td>
                    <td class="text-center">
                        <a href="{{ route('siswa.index', $p->id_sesi) }}" class="btn btn-info btn-sm">
                            <iconify-icon icon="mdi:eye" class="fs-5"></iconify-icon>
                            Lihat Siswa
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="9" class="text-center">Belum ada data sesi</td>
                </tr>
            @endforelse
        </tbody>

        </table>
      </div>
    </div>
  </div>
</div>

@endsection
