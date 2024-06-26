<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ListAnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $user = auth()->user();
        $pengguna = Pengguna::where('level', '!=', 'admin')->where('id', '!=', $user->id)->get();

        // Sort by level
        $sortLevel = ['dandim', 'staf', 'danramil', 'babinsa'];
        $pengguna = $pengguna->sortBy(function ($pengguna) use ($sortLevel) {
            return array_search($pengguna->level, $sortLevel);
        });

        // if (in_array($user->level, ['babinsa', 'danramil', 'dandim', 'staf'])) {
        //     $pengguna->where('level', $user->level);
        // }

        // $pengguna = $pengguna->get();

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            'namePage' => $namePage,

            // Data Tambahan
            'pengguna' => $pengguna,
        ];

        return view('page.list_anggota.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if(auth()->user()->level != 'admin'){
            return redirect()->route('list-anggota.index')->with('error', 'Kamu tidak memiliki akses ke halaman ini.');
        }
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            'namePage' => $namePage,
        ];

        return view('page.list_anggota.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(auth()->user()->level != 'admin'){
            return redirect()->route('list-anggota.index')->with('error', 'Kamu tidak memiliki akses ke halaman ini.');
        }

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

        $pengguna = new Pengguna;
        $pengguna->nama_lengkap = $request->nama;
        $pengguna->kata_sandi = Hash::make($request->kata_sandi);
        $pengguna->email = $request->email;
        $pengguna->no_telp = $request->nohp;
        $pengguna->NPWP = $request->npwp;
        $pengguna->NRP = $request->nrp;
        $pengguna->tgl_lahir = $request->tanggal_lahir;
        $pengguna->jabatan = $request->jabatan;
        $pengguna->penempatan = $request->penempatan;
        $pengguna->level = $request->level;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = $nama . '-' . $dateTime . '.' . $image->getClientOriginalExtension();

            $image->storeAs('images/profile', $imageName, 'public');

            $pengguna->foto_profil = $imageName;
        }else{
            $pengguna->foto_profil = '-';
        }

        $pengguna->save();

        return redirect()->route('list-anggota.index')->with('success', 'Pengguna Baru Berhasil Ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $pengguna = Pengguna::where('id', $id)->first();

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            // 'namePage' => $namePage,

            // Data Tambahan
            'pengguna' => $pengguna,
        ];

        return view('page.list_anggota.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        if(auth()->user()->level != 'admin'){
            return redirect()->route('list-anggota.index')->with('error', 'Kamu tidak memiliki akses ke halaman ini.');
        }

        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $pengguna = Pengguna::where('id', $id)->first();

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            'namePage' => $namePage,

            // Data Tambahan
            'pengguna' => $pengguna,
        ];

        return view('page.list_anggota.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->level != 'admin'){
            return redirect()->route('list-anggota.index')->with('error', 'Kamu tidak memiliki akses ke halaman ini.');
        }
        
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
