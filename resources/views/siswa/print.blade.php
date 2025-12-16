<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Data Siswa - {{ $siswa->nama }}</title>
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
    }

    .header img {
      width: 70px;
      position: absolute;
      top: 25px;
      left: 50px;
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

    .section-title {
      font-weight: bold;
      margin-top: 25px;
      margin-bottom: 8px;
      text-transform: uppercase;
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

    .no-border td {
      border: none;
      padding: 4px 6px;
    }

    .photo {
      text-align: center;
      margin-top: 10px;
    }

    .photo img {
      border: 1px solid #000;
      width: 100px;
      height: 130px;
      object-fit: cover;
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
    <h4>Komplek Pesona Prima Pataruman 2 Blok B1, No. 10, RT.01/12, <br> Kel. Pataruman, Kec. Cihampelas, Kab. Bandung Barat, Prov. Jawa Barat
      <br>
      Telp: 0838-4372-9851 | Email: coninieyani@gmail.com</h4>
  </div>

  <h4 style="text-align:center; text-transform:uppercase; text-decoration:underline;">Data Diri Siswa</h4>

  <table class="no-border">
    <tr>
      <td width="25%"><strong>Nama Lengkap</strong></td>
      <td width="45%">: {{ $siswa->nama }}</td>
      <td width="30%" rowspan="6" class="photo">
        @if($siswa->foto_diri)
            <img src="{{ asset('storage/' . $siswa->foto_diri) }}" 
                 alt="Foto Diri" class="img-thumbnail mb-2" width="150">
    
        @else
          <div style="width:100px;height:130px;border:1px solid #000;display:inline-block;line-height:130px;">Tidak ada foto</div>
        @endif
      </td>
    </tr>
    <tr><td><strong>Jenis Kelamin</strong></td><td>: {{ $siswa->jenis_kelamin }}</td></tr>
    <tr><td><strong>Agama</strong></td><td>: {{ $siswa->agama }}</td></tr>
    <tr><td><strong>Tanggal Lahir</strong></td><td>: {{ $siswa->tanggal_lahir }}</td></tr>
    <tr><td><strong>Alamat</strong></td><td>: {{ $siswa->alamat }}</td></tr>
    <tr><td><strong>Sesi</strong></td><td>: {{ $siswa->sesi->nama_sesi ?? '-' }}</td></tr>
  </table>

  <h4 class="section-title">Data Orang Tua</h4>
  <table class="no-border">
    <tr><td width="25%"><strong>Nama Orang Tua</strong></td><td>: {{ $siswa->nama_ortu }}</td></tr>
    <tr><td><strong>No. HP Orang Tua</strong></td><td>: {{ $siswa->no_ortu }}</td></tr>
  </table>

  <h4 class="section-title">Riwayat Pembayaran</h4>
  <table>
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal Pembayaran</th>
        <th>Jumlah</th>
        <th>Metode Pembayaran</th>
      </tr>
    </thead>
    <tbody>
      @forelse ($siswa->pembayaran as $p)
        <tr>
          <td>{{ $loop->iteration }}</td>
          <td>{{ \Carbon\Carbon::parse($p->tanggal_pembayaran)->format('d/m/Y') }}</td>
          <td>Rp {{ number_format($p->jumlah_pembayaran, 0, ',', '.') }}</td>
          <td>{{ $p->metode_pembayaran }}</td>
        </tr>
      @empty
        <tr><td colspan="4" style="text-align:center;">Belum ada pembayaran</td></tr>
      @endforelse
    </tbody>
  </table>

  <div class="footer">
    <p>Cihampelas, {{ \Carbon\Carbon::now()->format('d F Y') }}</p>
    <p><strong>Kepala Sekolah</strong></p>
    <br><br>
    <p><u><strong>(....................................)</strong></u></p>
  </div>
</body>
</html>

<script>
    window.print();
    window.onafterpoint=function(){
        window.close();
        };
</script>