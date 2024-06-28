<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

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
            return redirect()->route('page.profile')->with('success', 'Berhasil Masuk.');
        }

        return redirect()->back()->with('error', 'NRP atau Kata Sandi salah.');   
    }

    public function update(Request $request, $id) 
    {
        $request->validate([
            'nama' => 'required|string',
            'kata_sandi' => 'required|string',
            'nohp' => 'required',
            'npwp' => 'required',
            'nrp' => 'required',
            'tanggal_lahir' => 'required',
            'jabatan' => 'required',
            'penempatan' => 'required',
            'email' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg',
        ],[
            'nama.required' => 'Nama wajib diisi.',
            'kata_sandi.required' => 'Kata Sandi wajib diisi.',
            'nohp.required' => 'Nomor HP wajib diisi.',
            'npwp.required' => 'NPWP wajib diisi.',
            'nrp.required' => 'NRP wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jabatan.required' => 'Jabatan wajib diisi.',
            'penempatan.required' => 'Penempatan wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Email harus berupa alamat email yang valid.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Gambar harus berformat: jpeg, png, jpg.',
        ]);

        $nama = $this->filterText($request->nama);

        $currentDate = Date::now();
        $currentDay = $currentDate->day;
        $currentMonth = $currentDate->month;
        $currentYear = $currentDate->year;
        $currentHour = $currentDate->hour;
        $currentMinute = $currentDate->minute;
        $currentSecond = $currentDate->second;
        $dateTime = $currentYear.$currentMonth.$currentDay.$currentHour.$currentMinute.$currentSecond;

        $pengguna = Pengguna::findOrFail($id);
        $pengguna->nama_lengkap = $request->nama;
        // $pengguna->kata_sandi = Hash::make($request->kata_sandi);
        $pengguna->email = $request->email;
        $pengguna->no_telp = $request->nohp;
        $pengguna->NPWP = $request->npwp;
        $pengguna->NRP = $request->nrp;
        $pengguna->tgl_lahir = $request->tanggal_lahir;
        $pengguna->jabatan = $request->jabatan;
        $pengguna->penempatan = $request->penempatan;
        $pengguna->level = $request->level;

        if ($request->hasFile('image')) {
            // Hapus gambar lama jika ada
            if ($pengguna->foto_profil && $pengguna->foto_profil != '-') {
                Storage::disk('public')->delete('images/profile/' . $pengguna->foto_profil);
            }
    
            // Simpan gambar baru
            $image = $request->file('image');
            $imageName = $nama . '-' . $dateTime . '.' . $image->getClientOriginalExtension();
            $image->storeAs('images/profile', $imageName, 'public');
            $pengguna->foto_profil = $imageName;
        }

        $pengguna->save();

        return redirect()->back()->with('success', 'Pengguna Berhasil Dirubah.');    
    }
    
    public function change_password(Request $request, $id)
    {
        if(auth()->user()->level != 'admin'){
            $request->validate([
                'password-old' => 'required',
                'new-password' => 'required|confirmed',
            ], [
                'password-old.required' => 'Kata Sandi Lama wajib diisi.',
                'new-password.required' => 'Kata Sandi Baru wajib diisi.',
                'new-password.confirmed' => 'Konfirmasi Kata Sandi tidak cocok.',
            ]);
        }else{
            $request->validate([
                'new-password' => 'required|confirmed',
            ], [
                'new-password.required' => 'Kata Sandi Baru wajib diisi.',
                'new-password.confirmed' => 'Konfirmasi Kata Sandi tidak cocok.',
            ]);
        }
    
        // Ambil pengguna saat ini
        $pengguna = Pengguna::where('id', $id)->first();

        if(auth()->user()->level != 'admin'){
            // Periksa apakah kata sandi lama sesuai
            if (!Hash::check($request->input('password-old'), $pengguna->kata_sandi)) {
                return redirect()->back()->withErrors(['password-old' => 'Kata Sandi Lama tidak sesuai.']);
            }
        }

         // Update kata sandi baru
         $pengguna->kata_sandi = Hash::make($request->input('new-password'));
         $pengguna->save();
 
        if(auth()->user()->level != 'admin'){
            return redirect()->route('page.change-password', $pengguna->id)->with('success', 'Kata sandi berhasil diperbarui.');
        }else{
            // Cek jika angka pertama adalah 0, ganti dengan 62
            if (substr($pengguna->no_telp, 0, 1) === '0') {
                $phone_number = '62' . substr($pengguna->no_telp, 1);
            }
            $message = 'Password berhasil di perbaharui dengan data NRP *'. $pengguna->NRP .'*. Dengan Password baru *'. $request->input('new-password') .'*';

            $encoded_message = urlencode($message);
            
            return redirect('https://wa.me/'. $phone_number .'?text='. $encoded_message);
        }
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
