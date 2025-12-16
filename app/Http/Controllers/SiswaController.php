<?php

namespace App\Http\Controllers;

use App\Models\Sesi;
use Illuminate\Http\Request;
use App\Models\Siswa;


class SiswaController extends Controller
{
    public function sesi()
    {
        // ambil semua sesi (kelas)
        $data = Sesi::all();
        return view('siswa.sesi', compact('data'));
    }

    public function index($id)
    {
        // Ambil sesi tertentu + semua siswa di dalamnya
        $sesi = Sesi::with('siswa')->findOrFail($id);

        // Ambil semua sesi untuk dropdown di modal edit
        $sesiList = Sesi::all();

        // Kirim dua variabel ke view
        return view('siswa.index', compact('sesi', 'sesiList'));
    }


    public function detail($id)
        {
            // Ambil data siswa + relasi sesi + detail pembayaran
            $siswa = \App\Models\Siswa::with(['sesi', 'pembayaran'])->findOrFail($id);
        
            return view('siswa.detail', compact('siswa'));
        }

    public function cetak($id)
        {
            $siswa = \App\Models\Siswa::with(['sesi', 'pembayaran'])->findOrFail($id);
            return view('siswa.print', compact('siswa'));
        }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswa.edit', compact('siswa'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|string',
            'agama' => 'required|string',
            'tanggal_lahir' => 'required|date',
            'alamat' => 'required|string',
            'nama_ortu' => 'required|string',
            'no_ortu' => 'required|string',
            'id_sesi' => 'nullable|exists:tb_sesi,id_sesi',
            'foto_diri' => 'nullable|image|max:2048',
            'foto_kk' => 'nullable|image|max:2048',
            'foto_akta' => 'nullable|image|max:2048',
        ]);

        $data = $request->only([
            'nama', 'jenis_kelamin', 'agama', 'tanggal_lahir', 'alamat',
            'nama_ortu', 'no_ortu', 'id_sesi'
        ]);

        // Foto logic (tetap sama kayak sebelumnya)
        foreach (['foto_diri', 'foto_kk', 'foto_akta'] as $field) {
            if ($request->hasFile($field)) {
                if ($siswa->$field && file_exists(storage_path('app/public/' . $siswa->$field))) {
                    unlink(storage_path('app/public/' . $siswa->$field));
                }
                $folder = match($field) {
                    'foto_diri' => 'foto_siswa',
                    'foto_kk' => 'foto_kk',
                    'foto_akta' => 'foto_akta',
                };
                $data[$field] = $request->file($field)->store($folder, 'public');
            }
        }

        $siswa->update($data);

        return redirect()->route('siswa.index', $siswa->id_sesi)->with('success', 'Data berhasil diupdate');
    }


    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);

        // 🔹 Hapus semua detail pembayaran milik siswa ini
        $siswa->pembayaran()->delete();

        // 🔹 Hapus file foto jika ada
        $fotoFields = ['foto_diri', 'foto_kk', 'foto_akta'];
        foreach ($fotoFields as $field) {
            if ($siswa->$field && file_exists(public_path('storage/' . $siswa->$field))) {
                unlink(public_path('storage/' . $siswa->$field));
            }
        }

        // 🔹 Hapus data siswa
        $siswa->delete();

        // 🔹 Redirect kembali ke halaman siswa sesuai sesi
        return redirect()->route('siswa.index', $siswa->id_sesi)
            ->with('success', 'Data siswa dan riwayat pembayarannya berhasil dihapus.');
    }



}
