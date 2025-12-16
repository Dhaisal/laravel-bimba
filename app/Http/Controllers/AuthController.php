<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Storage;


class AuthController extends Controller
{
    public function showLogin() {
        if (Auth::user() !== null) {
            return redirect('/dashboard');
        }
        return view('auth.login');
    }


    public function login(Request $request) {
        $credentials = $request->only('email', 'password');


        $user = User::where('email', $credentials['email'])->first();


        if ($user && Hash::check($credentials['password'], $user->password)) {
            Auth::login($user);
            // dd(Auth::check(), Auth::user()); // ini harusnya true
            return redirect()->route('dashboard');
        }


        return back()->with('error', 'Emaill atau Password salah');
    }


    public function edit() {
        return view('auth.edit', ['user' => Auth::user()]);
    }


    public function update(Request $request) {
        $user = Auth::user();


        $request->validate([
            'name' => 'required',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);


        $data = $request->only('name');
        
        $filePath = $user->avatar; 
    
        if ($request->hasFile('avatar')) {
            
            if ($user->avatar) {
                Storage::disk('public')->delete($user->avatar);
            }
            
    
            $file = $request->file('avatar');
            $fileName = time() ."-ID-" . Auth::user()->id . '.' . $file->extension(); 
            $filePath = $file->storeAs('avatars', $fileName, 'public');
            $data['avatar'] = $filePath;
        } 


        $user->update($data);


        return redirect()->route('auth.edit')->with('success', 'Profil berhasil diperbarui');
    }


public function logout(Request $request)
{
    Auth::logout(); // keluarin user dari session

    $request->session()->invalidate(); // hapus semua session
    $request->session()->regenerateToken(); // regenerasi CSRF token

    return redirect('/login'); // balik ke halaman login
}

}

