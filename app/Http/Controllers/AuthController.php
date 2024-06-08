<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request) 
    {
        $request->validate([
            'NRP' => 'required',
            'kata_sandi' => 'required',
        ], [
            'NRP.required' => 'NRP wajib diisi.',
            'kata_sandi.required' => 'Kata Sandi wajib diisi.',
        ]);

        $credentials = [
            'NRP' => $request->input('NRP'),
            'password' => $request->input('kata_sandi')
        ];

        if (Auth::guard('web')->attempt($credentials)) {
            return redirect()->intended('page.profile')->with('success', 'Berhasil Masuk.');
        }

        return redirect()->back()->with('error', 'NRP atau Kata Sandi salah.');   
    }
    
    public function change_password(Request $request, $id)
    {
        $request->validate([
            'password-old' => 'required',
            'new-password' => 'required|confirmed',
        ], [
            'password-old.required' => 'Kata Sandi Lama wajib diisi.',
            'new-password.required' => 'Kata Sandi Baru wajib diisi.',
            'new-password.confirmed' => 'Konfirmasi Kata Sandi tidak cocok.',
        ]);
    
        // Ambil pengguna saat ini
        $pengguna = Pengguna::where('id', $id)->first();

        // Periksa apakah kata sandi lama sesuai
        if (!Hash::check($request->input('password-old'), $pengguna->kata_sandi)) {
            return redirect()->back()->withErrors(['password-old' => 'Kata Sandi Lama tidak sesuai.']);
        }

         // Update kata sandi baru
         $pengguna->kata_sandi = Hash::make($request->input('new-password'));
         $pengguna->save();
 
         return redirect()->route('page.change-password', $pengguna->id)->with('success', 'Kata sandi berhasil diperbarui.');
    }

    public function logout(Request $request) {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate the session token
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Berhasil keluar.');
    }
}
