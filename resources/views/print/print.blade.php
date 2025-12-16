<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Laporan Pendaftar</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
      margin: 30px;
    }

    .header {
      text-align: center;
      border-bottom: 3px solid #000;
      padding-bottom: 8px;
      margin-bottom: 15px;
      position: relative;
    }

    .header img {
      width: 70px;
      position: absolute;
      top: 10px;
      left: 30px;
    }

    .header h2, .header h4 {
      margin: 0;
      line-height: 1.4;
    }

    .header h2 {
      font-size: 18px;
      font-weight: bold;
      text-transform: uppercase;
    }

    .header h4 {
      font-size: 12px;
      font-weight: normal;
    }

    h4.title {
      text-align: center;
      margin-bottom: 4px;
    }

    p.period {
      text-align: center;
      margin-top: 0;
      margin-bottom: 20px;
      font-size: 12px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 15px;
    }

    th, td {
      border: 1px solid #000;
      padding: 6px;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .footer {
      margin-top: 40px;
      text-align: right;
      font-size: 12px;
    }
  </style>
</head>
<body>
  <div class="header">
    <img src="{{ asset('assets/images/logos/logo-biMBA_.jpg') }}" alt="Logo Sekolah">
    <h2>Bimba AIUEO Cab. Pataruman</h2>
    <h4>
      Komplek Pesona Prima Pataruman 2 Blok B1, No. 10, RT.01/12, <br>
      Kel. Pataruman, Kec. Cihampelas, Kab. Bandung Barat, Prov. Jawa Barat <br>
      Telp: 0838-4372-9851 | Email: coninieyani@gmail.com
    </h4>
  </div>

  {{-- Judul menyesuaikan --}}
  @if($tipe == 'belum')
    <h4 class="title">Laporan Pendaftar Belum Administrasi</h4>
  @else
    <h4 class="title">Laporan Pendaftar (Berdasarkan Pembayaran)</h4>
  @endif

  @if($dari && $sampai)
    <p class="period">Periode: {{ date('d-m-Y', strtotime($dari)) }} s/d {{ date('d-m-Y', strtotime($sampai)) }}</p>
  @endif

  {{-- Tabel menyesuaikan tipe --}}
  @if($pendaftar->count() > 0)
    @if($tipe == 'sudah')
      <table>
        <thead>
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
            <td>Rp {{ number_format($rec->jumlah_pembayaran, 0, ',', '.') }}</td>
            <td>{{ $rec->metode_pembayaran }}</td>
          </tr>
          @endforeach
        </tbody>
      </table>

    @else
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>Nama Pendaftar</th>
            <th>Alamat</th>
            <th>Tanggal Pendaftaran</th>
            <th>Status</th>
          </tr>
        </thead>
        <tbody>
          @foreach($pendaftar as $i => $rec)
          <tr>
            <td>{{ $i + 1 }}</td>
            <td>{{ $rec->nama ?? '-' }}</td>
            <td>{{ $rec->alamat ?? '-' }}</td>
            <td>{{ \Carbon\Carbon::parse($rec->created_at)->format('d-m-Y') }}</td>
            <td>Belum Bayar</td>
          </tr>
          @endforeach
        </tbody>
      </table>
    @endif
  @else
    <p style="text-align:center; margin-top:20px;">Tidak ada data untuk ditampilkan.</p>
  @endif

  <div class="footer">
    <p>Cihampelas, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
    <p><strong>Kepala Sekolah</strong></p>
    <br><br><br>
    <p><u><strong>(....................................)</strong></u></p>
  </div>

  <script>
    window.print();
    window.onafterprint = function(){ window.close(); };
  </script>
</body>
</html>
