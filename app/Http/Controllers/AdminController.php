<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $admin = Auth::user();
        return view('admin.index', compact('admin'));
    }

    public function update(Request $request)
    {
        $admin = User::find(Auth::id());

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // simpan foto kalau diupload
        if ($request->hasFile('photo')) {
            // hapus foto lama
            if ($admin->photo && Storage::exists($admin->photo)) {
                Storage::delete($admin->photo);
            }

            // simpan foto baru ke storage/app/public/admin
            $path = $request->file('photo')->store('admin', 'public');
            $admin->photo = $path;
        }

        // update data
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect()->route('admin.index')->with('success', 'Profil berhasil diperbarui!');
    }

        public function editPassword()
    {
        return view('admin.password');
    }

    public function updatePassword(Request $request)
    {

        
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:6',
            'konfirmasi' => 'required|same:password_baru',
        ]);

        $user = User::find(Auth::id());

        // Cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->with('error', 'Password lama salah!');
        }

        // Update password baru
        $user->password = Hash::make($request->password_baru);
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Password berhasil diubah!');
    }
}
