@extends('layouts.master')

@section('title', isset($pendaftaran) ? 'Edit Pendaftaran' : 'Tambah Pendaftaran')

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
    <div class="card">
        <div class="card-body">
            <h3 class="mb-4">{{ isset($pendaftaran) ? 'Edit Data Pendaftar' : 'Tambah Data Pendaftar' }}</h3>

            <form 
                action="{{ isset($pendaftaran) ? route('pendaftaran.update', $pendaftaran->id_pendaftaran) : route('pendaftaran.store') }}" 
                method="POST" 
                enctype="multipart/form-data"
            >
                @csrf
                @if(isset($pendaftaran))
                    @method('PUT')
                @endif

                {{-- Nama --}}
                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" id="nama" class="form-control"
                        value="{{ old('nama', $pendaftaran->nama ?? '') }}" required>
                </div>

                {{-- Alamat --}}
                <div class="mb-3">
                    <label for="alamat" class="form-label">Alamat</label>
                    <textarea name="alamat" id="alamat" class="form-control" rows="3" required>{{ old('alamat', $pendaftaran->alamat ?? '') }}</textarea>
                </div>

                {{-- Jenis Kelamin --}}
                <div class="mb-3">
                    <label for="jenis_kelamin" class="form-label">Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        <option value="Laki-laki" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin ?? '') == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="Perempuan" {{ old('jenis_kelamin', $pendaftaran->jenis_kelamin ?? '') == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                </div>

                {{-- Agama --}}
                <div class="mb-3">
                    <label for="agama" class="form-label">Agama</label>
                    <select name="agama" id="agama" class="form-select" required>
                        <option value="">-- Pilih --</option>
                        @foreach(['Islam','Kristen','Hindu','Buddha','Konghucu'] as $agama)
                            <option value="{{ $agama }}" {{ old('agama', $pendaftaran->agama ?? '') == $agama ? 'selected' : '' }}>
                                {{ $agama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Tanggal Lahir --}}
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" id="tanggal_lahir" class="form-control"
                        value="{{ old('tanggal_lahir', $pendaftaran->tanggal_lahir ?? '') }}" required>
                </div>

                {{-- Nama Orang Tua --}}
                <div class="mb-3">
                    <label for="nama_ortu" class="form-label">Nama Orang Tua</label>
                    <input type="text" name="nama_ortu" id="nama_ortu" class="form-control"
                        value="{{ old('nama_ortu', $pendaftaran->nama_ortu ?? '') }}" required>
                </div>

                {{-- Nomor HP Orang Tua --}}
                <div class="mb-3">
                    <label for="no_ortu" class="form-label">No. HP Orang Tua</label>
                    <input type="text" name="no_ortu" id="no_ortu" class="form-control"
                        value="{{ old('no_ortu', $pendaftaran->no_ortu ?? '') }}" required>
                </div>

{{-- Foto Diri --}}
<div class="mb-3">
    <label for="foto_diri" class="form-label">Foto Diri</label>
    <input type="file" name="foto_diri" id="foto_diri" class="form-control" accept="image/*">
    @if(isset($pendaftaran) && $pendaftaran->foto_diri)
        <div class="mt-2">
            <small class="text-muted d-block">Foto saat ini:</small>
            <img src="{{ asset('storage/' . $pendaftaran->foto_diri) }}" 
                 alt="Foto Diri" 
                 class="img-thumbnail mt-1" 
                 width="120">
        </div>
    @endif
</div>

{{-- Foto KK --}}
<div class="mb-3">
    <label for="foto_kk" class="form-label">Foto Kartu Keluarga</label>
    <input type="file" name="foto_kk" id="foto_kk" class="form-control" accept="image/*">
    @if(isset($pendaftaran) && $pendaftaran->foto_kk)
        <div class="mt-2">
            <small class="text-muted d-block">Foto saat ini:</small>
            <img src="{{ asset('storage/' . $pendaftaran->foto_kk) }}" 
                 alt="Foto KK" 
                 class="img-thumbnail mt-1" 
                 width="120">
        </div>
    @endif
</div>

{{-- Foto Akta --}}
<div class="mb-3">
    <label for="foto_akta" class="form-label">Foto Akta Kelahiran</label>
    <input type="file" name="foto_akta" id="foto_akta" class="form-control" accept="image/*">
    @if(isset($pendaftaran) && $pendaftaran->foto_akta)
        <div class="mt-2">
            <small class="text-muted d-block">Foto saat ini:</small>
            <img src="{{ asset('storage/' . $pendaftaran->foto_akta) }}" 
                 alt="Foto Akta" 
                 class="img-thumbnail mt-1" 
                 width="120">
        </div>
    @endif
</div>


                {{-- Tombol --}}
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($pendaftaran) ? 'Update' : 'Simpan' }}
                    </button>
                    <a href="{{ route('pendaftaran.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
