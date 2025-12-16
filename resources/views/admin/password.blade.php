@extends('layouts.master')

@section('title', 'Konfirmasi Pembayaran Pendaftaran')

@section('content')
<div class="container mt-4">
  <div class="card shadow-sm p-4" style="max-width: 500px; margin:auto;">
    <h4 class="text-center mb-4">Ubah Password</h4>

    @if (session('success'))
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
      Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: '{{ session("success") }}',
        showConfirmButton: false,
        timer: 1500
      });
      </script>
    @endif

    @if (session('error'))
      <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
      <script>
      Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: '{{ session("error") }}',
      });
      </script>
    @endif

    <form action="{{ route('admin.password.update') }}" method="POST">
      @csrf
      @method('PUT')

      <div class="mb-3">
        <label class="form-label">Password Lama</label>
        <input type="password" name="password_lama" class="form-control" required>
        @error('password_lama') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Password Baru</label>
        <input type="password" name="password_baru" class="form-control" required>
        @error('password_baru') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="mb-3">
        <label class="form-label">Konfirmasi Password Baru</label>
        <input type="password" name="konfirmasi" class="form-control" required>
        @error('konfirmasi') <small class="text-danger">{{ $message }}</small> @enderror
      </div>

      <div class="d-flex justify-content-between">
        <a href="{{ route('admin.index') }}" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-success">Simpan</button>
      </div>
    </form>
  </div>
</div>
@endsection
