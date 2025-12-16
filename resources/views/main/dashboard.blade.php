@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container py-4">
  <h3 class="mb-4 fw-bold">Dashboard Admin</h3>

{{-- === Statistik Utama === --}}
<div class="row g-3">
  {{-- Total Siswa --}}
  <div class="col-md-3">
    <a href="{{ route('siswa.sesi') }}" class="text-decoration-none text-dark">
      <div class="card shadow-sm p-3 text-center border-0 hover-card">
        <div class="d-flex justify-content-center align-items-center mb-2">
          <i class="bi bi-people-fill fs-2 text-primary me-2"></i>
          <h6 class="text-muted mb-0">Total Siswa</h6>
        </div>
        <h2 class="fw-bold">{{ $totalSiswa }}</h2>
      </div>
    </a>
  </div>

  {{-- Total Pembayaran --}}
  <div class="col-md-3">
    <a href="{{ route('print.index') }}" class="text-decoration-none text-dark">
      <div class="card shadow-sm p-3 text-center border-0 hover-card">
        <div class="d-flex justify-content-center align-items-center mb-2">
          <i class="bi bi-cash-stack fs-2 text-success me-2"></i>
          <h6 class="text-muted mb-0">Total Pembayaran</h6>
        </div>
        <h2 class="fw-bold">Rp {{ number_format($totalPembayaran, 0, ',', '.') }}</h2>
      </div>
    </a>
  </div>

  {{-- Belum Bayar --}}
  <div class="col-md-3">
    <a href="{{ route('pendaftaran.index') }}" class="text-decoration-none text-dark">
      <div class="card shadow-sm p-3 text-center border-0 hover-card">
        <div class="d-flex justify-content-center align-items-center mb-2">
          <i class="bi bi-clock-history fs-2 text-warning me-2"></i>
          <h6 class="text-muted mb-0">Belum Bayar</h6>
        </div>
        <h2 class="fw-bold">{{ $njir }}</h2>
      </div>
    </a>
  </div>

  {{-- Pendaftar Bulan Ini --}}
  <div class="col-md-3">
    <a href="{{ route('siswa.sesi') }}" class="text-decoration-none text-dark">
      <div class="card shadow-sm p-3 text-center border-0 hover-card">
        <div class="d-flex justify-content-center align-items-center mb-2">
          <i class="bi bi-calendar-check fs-2 text-danger me-2"></i>
          <h6 class="text-muted mb-0">Pendaftar Bulan Ini</h6>
        </div>
        <h2 class="fw-bold">{{ $pendaftarHariIni }}</h2>
      </div>
    </a>
  </div>
</div>

{{-- Tambahkan style hover agar interaktif --}}
<style>
  .hover-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border-radius: 12px;
  }
  .hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.15);
  }
</style>


  {{-- === Grafik === --}}
  <div class="card mt-4 shadow-sm">
    <div class="card-header fw-semibold">Grafik Pendaftar per Bulan</div>
    <div class="card-body">
      <canvas id="pendaftarChart" height="90"></canvas>
    </div>
  </div>

  {{-- === Data Terbaru === --}}
  <div class="row mt-4">
    <div class="col-md-6">
      <div class="card shadow-sm">
        <div class="card-header fw-semibold">Pendaftar Terbaru</div>
        <ul class="list-group list-group-flush">
          @foreach($latestSiswa as $s)
          <li class="list-group-item d-flex justify-content-between">
            <span>{{ $s->nama }}</span>
            <small class="text-muted">{{ $s->created_at->format('d M Y') }}</small>
          </li>
          @endforeach
        </ul>
      </div>
    </div>

<div class="col-md-6">
  <div class="card shadow-sm">
    <div class="card-header fw-semibold">Pembayaran Terbaru</div>
    <ul class="list-group list-group-flush">
      @foreach($latestPembayaran as $p)
        <li class="list-group-item d-flex justify-content-between">
          <span>{{ $p->siswa->nama ?? 'Tidak diketahui' }}</span>
          <small class="text-success">Rp {{ number_format($p->jumlah_pembayaran, 0, ',', '.') }}</small>
        </li>
      @endforeach
    </ul>
  </div>
</div>

  </div>
</div>

{{-- === Script Chart.js === --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const ctx = document.getElementById('pendaftarChart');
new Chart(ctx, {
  type: 'bar',
  data: {
    labels: {!! json_encode($dataBulan) !!},
    datasets: [{
      label: 'Jumlah Pendaftar',
      data: {!! json_encode($dataJumlah) !!},
      borderWidth: 1,
      backgroundColor: '#007bff55',
      borderColor: '#007bff'
    }]
  },
  options: {
    scales: { y: { beginAtZero: true } }
  }
});
</script>
@endsection

