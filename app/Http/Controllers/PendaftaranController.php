<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\pendaftaran;
use App\Models\sesi;
use Illuminate\Support\Facades\Storage;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // ambil kata kunci dari input form (name="cari")
        $search = $request->input('cari');

        // kalau ada keyword pencarian
        if ($search) {
            $data = Pendaftaran::where('nama', 'like', "%{$search}%")
                ->orWhere('alamat', 'like', "%{$search}%")
                ->orWhere('jenis_kelamin', 'like', "%{$search}%")
                ->orWhere('agama', 'like', "%{$search}%")
                ->orWhere('tanggal_lahir', 'like', "%{$search}%")
                ->orWhere('nama_ortu', 'like', "%{$search}%")
                ->orWhere('no_ortu', 'like', "%{$search}%")   
                ->get();
        } else {
            // kalau gak ada, tampilkan semua data
            $data = Pendaftaran::all();
        }

        return view('pendaftaran.index', compact('data', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pendaftaran.form');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'nama' => 'required|string|max:255',
        'alamat' => 'required|string',
        'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        'agama' => 'required|in:Islam,Kristen,Hindu,Buddha,Konghucu',
        'tanggal_lahir' => 'required|date',
        'nama_ortu' => 'required|string|max:255',
        'no_ortu' => 'required|string|max:20',
        'foto_diri' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'foto_kk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'foto_akta' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $data = $request->only([
        'nama', 'alamat', 'jenis_kelamin', 'agama',
        'tanggal_lahir', 'nama_ortu', 'no_ortu'
    ]);

    if ($request->hasFile('foto_diri')) {
        $data['foto_diri'] = $request->file('foto_diri')->store('uploads', 'public');
    }

    if ($request->hasFile('foto_kk')) {
        $data['foto_kk'] = $request->file('foto_kk')->store('uploads', 'public');
    }

    if ($request->hasFile('foto_akta')) {
        $data['foto_akta'] = $request->file('foto_akta')->store('uploads', 'public');
    }

    pendaftaran::create($data);

    return redirect()->route('pendaftaran.index')->with('success', 'Pendaftaran berhasil disimpan.');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pendaftaran = pendaftaran::findOrFail($id);
        return view('pendaftaran.form', compact('pendaftaran'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        $pendaftaran = pendaftaran::findOrFail($id);

        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|in:Islam,Kristen,Hindu,Buddha,Konghucu',
            'tanggal_lahir' => 'required|date',
            'nama_ortu' => 'required|string|max:255',
            'no_ortu' => 'required|string|max:20',
            'foto_diri' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_kk' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'foto_akta' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ambil semua input tanpa _token dan _method
        $data = $request->except(['_token', '_method']);

        // 🔹 Hapus & update foto diri
        if ($request->hasFile('foto_diri')) {
            if ($pendaftaran->foto_diri && Storage::disk('public')->exists($pendaftaran->foto_diri)) {
                Storage::disk('public')->delete($pendaftaran->foto_diri);
            }
            $data['foto_diri'] = $request->file('foto_diri')->store('uploads', 'public');
        }

        // 🔹 Hapus & update foto KK
        if ($request->hasFile('foto_kk')) {
            if ($pendaftaran->foto_kk && Storage::disk('public')->exists($pendaftaran->foto_kk)) {
                Storage::disk('public')->delete($pendaftaran->foto_kk);
            }
            $data['foto_kk'] = $request->file('foto_kk')->store('uploads', 'public');
        }

        // 🔹 Hapus & update foto Akta
        if ($request->hasFile('foto_akta')) {
            if ($pendaftaran->foto_akta && Storage::disk('public')->exists($pendaftaran->foto_akta)) {
                Storage::disk('public')->delete($pendaftaran->foto_akta);
            }
            $data['foto_akta'] = $request->file('foto_akta')->store('uploads', 'public');
        }

        // Update semua data
        $pendaftaran->update($data);

        return redirect()->route('pendaftaran.index')->with('success', 'Data berhasil diperbarui dan file lama dihapus.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pendaftaran = pendaftaran::findOrFail($id);

        // 🔹 Hapus semua file terkait dari storage
        $fileList = ['foto_diri', 'foto_kk', 'foto_akta'];

        foreach ($fileList as $fileField) {
            if ($pendaftaran->$fileField && Storage::disk('public')->exists($pendaftaran->$fileField)) {
                Storage::disk('public')->delete($pendaftaran->$fileField);
            }
        }

        // 🔹 Hapus data dari database
        $pendaftaran->delete();

        return redirect()->route('pendaftaran.index')->with('success', 'Data dan semua file terkait berhasil dihapus.');
    }

    public function bayar(string $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
        $sesi = sesi::all(); // ambil dari tabel sesi
        return view('pendaftaran.bayar', compact('pendaftaran', 'sesi'));
    }

    public function konfirmasi(Request $request, $id)
    {
        $pendaftaran = Pendaftaran::findOrFail($id);
    
        $request->validate([
            'id_sesi' => 'required',
            'metode_pembayaran' => 'required',
        ]);
    
        //  Pindah ke tabel siswa
        $siswa = \App\Models\Siswa::create([
            'nama' => $pendaftaran->nama,
            'alamat' => $pendaftaran->alamat,
            'jenis_kelamin' => $pendaftaran->jenis_kelamin,
            'agama' => $pendaftaran->agama,
            'tanggal_lahir' => $pendaftaran->tanggal_lahir,
            'nama_ortu' => $pendaftaran->nama_ortu,
            'no_ortu' => $pendaftaran->no_ortu,
            'foto_diri' => $pendaftaran->foto_diri,
            'foto_kk' => $pendaftaran->foto_kk,
            'foto_akta' => $pendaftaran->foto_akta,
            'id_sesi' => $request->id_sesi,
        ]);
    
        // Tambah ke tabel detail_pembayaran
        \App\Models\DetailPembayaran::create([
            'id_siswa' => $siswa->id_siswa,
            'tanggal_pembayaran' => now(),
            'jumlah_pembayaran' => 500000,
            'metode_pembayaran' => $request->metode_pembayaran,
        ]);
    
        // Hapus pendaftar + file-nya
        // foreach (['foto_diri','foto_kk','foto_akta'] as $fileField) {
        //     if ($pendaftaran->$fileField && Storage::disk('public')->exists($pendaftaran->$fileField)) {
        //         Storage::disk('public')->delete($pendaftaran->$fileField);
        //     }
        // }
        $pendaftaran->delete();
    
        return redirect()->route('pendaftaran.index')
            ->with('success', 'Pendaftar berhasil dikonfirmasi sebagai siswa baru dan pembayaran tercatat.');
    }



}