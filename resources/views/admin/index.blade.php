@extends('layouts.master')

@section('title', 'Admin')

@section('content')
<div class="container mt-4">
  <div class="card shadow">
    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
      <h4 class="mb-0">Profil Admin</h4>
      <a href="{{ route('admin.password') }}" class="btn btn-warning btn-sm">Ubah Password</a>
    </div>

    <div class="card-body">
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      <form action="{{ route('admin.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="text-center mb-4">
          @php
              $foto_src = $admin->photo ? asset('storage/' . $admin->photo) : asset('images/default-user.png');
          @endphp
          <img src="{{ $foto_src }}" alt="Foto Admin" class="rounded-circle mb-3" width="120" height="120" style="object-fit:cover; border:3px solid #eee;">
        </div>

        <div class="mb-3">
          <label class="form-label">Nama Lengkap</label>
          <input type="text" name="name" value="{{ old('name', $admin->name) }}" class="form-control" required>
          @error('name') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" value="{{ old('email', $admin->email) }}" class="form-control" required>
          @error('email') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
          <label class="form-label">Foto Profil</label>
          <input type="file" name="photo" class="form-control" accept="image/*">
          <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
          @error('photo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
