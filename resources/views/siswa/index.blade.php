@extends('layouts.master')

@section('title', 'Data Siswa per Sesi')

@section('content')
<div class="col-lg-17" style="padding-left: 10px; padding-right: 10px;">
  <div class="card">
    <div class="card-body">
      <h3>Detail Sesi: {{ $sesi->nama_sesi }}</h3>
      <p>Deskripsi: {{ $sesi->deskripsi }}</p>
            <div class="container">
        <!-- Wrapper untuk tombol dan search bar -->
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-3">
          
            <div class="mb-2 mb-md-0">
              <a href="{{ route('siswa.sesi') }}" class="btn btn-secondary mt-3">
                <iconify-icon icon="tabler:arrow-back-up"></iconify-icon> Kembali
              </a>
            </div>


          <!-- Search bar di kanan -->
            {{-- <form action="dataguru.php" method="get">
              <div style="max-width: 400px; width: 100%;">
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search..." name="cari" aria-label="Search" aria-describedby="search-addon">
                  <button type="submit" class="btn btn-outline-secondary">
                    <iconify-icon icon="mdi:magnify" class="fs-6"></iconify-icon>
                  </button>
                </div>
              </div>
            </form> --}}

        </div>
      </div>
      
      <hr>

      <h5>Daftar Siswa di Sesi Ini</h5>
      <div class="table-responsive">
        <table class="table table-striped align-middle">
          <thead class="border-2 border-bottom border-primary border-0">
            
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Alamat</th>
              <th>Jenis Kelamin</th>
              <th>Tanggal Lahir</th>
              <th>No Telepon</th>
              <th>Foto</th>
              <th>Detail</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            @forelse ($sesi->siswa as $s)
            
              <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td>{{ $s->nama }}</td>
                <td>{{ $s->alamat }}</td>
                <td class="text-center">{{ $s->jenis_kelamin }}</td>
                <td class="text-center">{{ $s->tanggal_lahir }}</td>
                <td class="text-center">{{ $s->no_ortu }}</td>
                <td class="text-center">
                  @if($s->foto_diri)
                    <img src="{{ asset('storage/' . $s->foto_diri) }}" width="50" height="50" class="rounded">
                  @else
                    -
                  @endif
                </td>
                <td class="text-center">
                  <a href="{{ route('siswa.detail', $s->id_siswa) }}" class="btn btn-info btn-sm">Lihat Detail</a>
                </td>

                <td class="text-center">
                  <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $s->id_siswa }}">
                    Edit
                  </button>

                  <form action="{{ route('siswa.destroy', $s->id_siswa) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin hapus data ini?')">
                      Hapus
                    </button>
                  </form>
                </td>
                
              </tr>
            @empty
              <tr>
                <td colspan="6" class="text-center text-muted">Belum ada siswa di sesi ini.</td>
              </tr>

            @endforelse 

          </tbody>
        </table>

        

      </div>



    </div>
  </div>
</div>

@foreach($sesi->siswa as $s)
  <div class="modal fade" id="editModal{{ $s->id_siswa }}" tabindex="-1"
      aria-labelledby="editModalLabel{{ $s->id_siswa }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('siswa.update', $s->id_siswa) }}" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')

          <div class="modal-header">
            <h5 class="modal-title" id="editModalLabel{{ $s->id_siswa }}">
              Edit Data Siswa - {{ $s->nama }}
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
            <div class="row g-3">
              <div class="row g-3">
                {{-- Nama --}}
                <div class="col-md-6">
                  <label class="form-label">Nama</label>
                  <input type="text" name="nama" class="form-control" value="{{ $s->nama }}" required>
                </div>

                {{-- Jenis Kelamin --}}
                <div class="col-md-6">
                  <label class="form-label">Jenis Kelamin</label>
                  <select name="jenis_kelamin" class="form-control" required>
                    <option value="Laki-laki" {{ $s->jenis_kelamin == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ $s->jenis_kelamin == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                  </select>
                </div>

                {{-- Agama --}}
                <div class="col-md-6">
                  <label class="form-label">Agama</label>
                    <select name="agama" id="agama" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        @foreach(['Islam','Kristen','Hindu','Buddha','Konghucu'] as $agama)
                            <option value="{{ $agama }}" {{ old('agama', $s->agama ?? '') == $agama ? 'selected' : '' }}>
                                {{ $agama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal Lahir --}}
                <div class="col-md-6">
                  <label class="form-label">Tanggal Lahir</label>
                  <input type="date" name="tanggal_lahir" class="form-control" value="{{ $s->tanggal_lahir }}">
                </div>

                {{-- Alamat --}}
                <div class="col-12">
                  <label class="form-label">Alamat</label>
                  <textarea name="alamat" class="form-control" rows="2">{{ $s->alamat }}</textarea>
                </div>

                {{-- Nama Orang Tua --}}
                <div class="col-md-6">
                  <label class="form-label">Nama Orang Tua</label>
                  <input type="text" name="nama_ortu" class="form-control" value="{{ $s->nama_ortu }}">
                </div>

                {{-- Nomor Orang Tua --}}
                <div class="col-md-6">
                  <label class="form-label">No. Orang Tua</label>
                  <input type="text" name="no_ortu" class="form-control" value="{{ $s->no_ortu }}">
                </div>

                {{-- Pilih Sesi --}}
                <div class="col-md-6">
                  <label class="form-label">Sesi / Kelas</label>
                  <select name="id_sesi" class="form-control" required>
                    <option value="">-- Pilih Sesi --</option>
                    @foreach($sesiList as $opt)
                      <option value="{{ $opt->id_sesi }}" {{ $s->id_sesi == $opt->id_sesi ? 'selected' : '' }}>
                        {{ $opt->nama_sesi }}
                      </option>
                    @endforeach
                  </select>

                </div>

                {{-- Foto Diri --}}
                <div class="col-md-4">
                  <label class="form-label">Foto Diri</label>
                  <input type="file" name="foto_diri" class="form-control" accept="image/*">
                  @if($s->foto_diri)
                    <img src="{{ asset('storage/' . $s->foto_diri) }}" width="80" class="mt-2 rounded">
                  @endif
                </div>

                {{-- Foto KK --}}
                <div class="col-md-4">
                  <label class="form-label">Foto KK</label>
                  <input type="file" name="foto_kk" class="form-control" accept="image/*">
                  @if($s->foto_kk)
                    <img src="{{ asset('storage/' . $s->foto_kk) }}" width="80" class="mt-2 rounded">
                  @endif
                </div>

                {{-- Foto Akta --}}
                <div class="col-md-4">
                  <label class="form-label">Foto Akta</label>
                  <input type="file" name="foto_akta" class="form-control" accept="image/*">
                  @if($s->foto_akta)
                    <img src="{{ asset('storage/' . $s->foto_akta) }}" width="80" class="mt-2 rounded">
                  @endif
                </div>
              </div>

            </div>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-success">Simpan</button>
          </div>
        </form>
      </div>
    </div>
  </div>
@endforeach

@endsection



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

