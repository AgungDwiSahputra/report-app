<?php

namespace App\Http\Controllers;

use App\Models\DetailLaporan;
use App\Models\Laporan;
use App\Models\Pengguna;
use Illuminate\Http\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class ReportController extends Controller
{
    // Custom function
    public function downloadReport($filename)
    {
        // Tentukan path file di Storage
        $filePath = 'public/document/report/' . $filename;

        // Periksa apakah file ada
        if (!Storage::exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Ambil file dari Storage dan unduh
        return Storage::download($filePath);
    }
    // End Custom function
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

        if(auth()->user()->level == 'admin'){
            $reports = DetailLaporan::with([
                'laporan', 'pembuat', 'penerima'
            ])->get();
        }else{
            $reports = DetailLaporan::with([
                'laporan', 'pembuat', 'penerima'
            ])->where('dibuat_oleh', auth()->user()->id)->get();
        }

        foreach ($reports as $report) {
            $report->laporan->tanggal_buat = Carbon::parse($report->laporan->created_at)->translatedFormat('d F Y');
        }

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            'namePage' => $namePage,
            'reports' => $reports,
        ];

        return view('page.report.show-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $pengguna = Pengguna::where('level', '!=', 'admin')->get();

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            // 'namePage' => $namePage,

            'user' => auth()->user(),
            'pengguna' => $pengguna,
        ];

        return view('page.report.create-report', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $user = auth()->user();

        // Validasi data
        if ($user->level != 'babinsa') {
            $request->validate([
                'dibuat_oleh' => 'required',
                'diterima_oleh' => 'required',
                'jenis_laporan' => 'required',
                'judul_laporan' => 'required',
                'wilayah_asal' => 'required',
                'tanggal_dibuat' => 'required',
                'hal_menonjol' => 'required',
                'deskripsi' => 'required',
                'cuaca' => 'required',
                'jml_personil' => 'required',
                'personil_hadir' => 'required',
                'personil_kurang' => 'required',
                'dinas_dalam' => 'required',
                'dinas_luar' => 'required',
                'piket_pos' => 'required',
                'materil' => 'required',
                'tembusan' => 'required',
                'lampiran.*' => 'image|mimes:jpeg,png,jpg',
            ], [
                'dibuat_oleh.required' => 'Kolom dibuat oleh wajib diisi.',
                'diterima_oleh.required' => 'Kolom diterima oleh wajib diisi.',
                'jenis_laporan.required' => 'Kolom jenis laporan wajib diisi.',
                'judul_laporan.required' => 'Kolom judul laporan wajib diisi.',
                'wilayah_asal.required' => 'Kolom wilayah asal wajib diisi.',
                'tanggal_dibuat.required' => 'Kolom tanggal dibuat wajib diisi.',
                'hal_menonjol.required' => 'Kolom hal menonjol wajib diisi.',
                'deskripsi.required' => 'Kolom deskripsi wajib diisi.',
                'cuaca.required' => 'Kolom cuaca wajib diisi.',
                'jml_personil.required' => 'Kolom jumlah personil wajib diisi.',
                'personil_hadir.required' => 'Kolom personil hadir wajib diisi.',
                'personil_kurang.required' => 'Kolom personil kurang wajib diisi.',
                'dinas_dalam.required' => 'Kolom dinas dalam wajib diisi.',
                'dinas_luar.required' => 'Kolom dinas luar wajib diisi.',
                'piket_pos.required' => 'Kolom piket pos wajib diisi.',
                'materil.required' => 'Kolom materil wajib diisi.',
                'tembusan.required' => 'Kolom tembusan wajib diisi.',
                'lampiran.*.image' => 'Lampiran harus berupa gambar.',
                'lampiran.*.mimes' => 'Lampiran harus berformat jpeg, png, atau jpg.',
            ]);
        } else {
            $request->validate([
                'dibuat_oleh' => 'required',
                'diterima_oleh' => 'required',
                'jenis_laporan' => 'required',
                'judul_laporan' => 'required',
                'wilayah_asal' => 'required',
                'tanggal_dibuat' => 'required',
                'hal_menonjol' => 'required',
                'deskripsi' => 'required',
                'cuaca' => 'required',
                'materil' => 'required',
                'tembusan' => 'required',
                'lampiran.*' => 'image|mimes:jpeg,png,jpg',
            ], [
                'dibuat_oleh.required' => 'Kolom dibuat oleh wajib diisi.',
                'diterima_oleh.required' => 'Kolom diterima oleh wajib diisi.',
                'jenis_laporan.required' => 'Kolom jenis laporan wajib diisi.',
                'judul_laporan.required' => 'Kolom judul laporan wajib diisi.',
                'wilayah_asal.required' => 'Kolom wilayah asal wajib diisi.',
                'tanggal_dibuat.required' => 'Kolom tanggal dibuat wajib diisi.',
                'hal_menonjol.required' => 'Kolom hal menonjol wajib diisi.',
                'deskripsi.required' => 'Kolom deskripsi wajib diisi.',
                'cuaca.required' => 'Kolom cuaca wajib diisi.',
                'materil.required' => 'Kolom materil wajib diisi.',
                'tembusan.required' => 'Kolom tembusan wajib diisi.',
                'lampiran.*.image' => 'Lampiran harus berupa gambar.',
                'lampiran.*.mimes' => 'Lampiran harus berformat jpeg, png, atau jpg.',
            ]);
        }

        try {
            // Simpan data ke tabel laporan
            $laporan = new Laporan;
            $laporan->jenis_laporan = $request->jenis_laporan;
            $laporan->judul_laporan = $request->judul_laporan;
            $laporan->save();

            // Upload lampiran dan simpan path
            $lampiranPaths = [];
            foreach ($request->file('lampiran') as $index => $file) {
                $fileName = 'lampiran-' . $laporan->id . '-' . $index . '.' . $file->getClientOriginalExtension();
                $file->storeAs('images/report', $fileName, 'public');
                $lampiranPaths[] = $fileName;
            }

            // Simpan data ke tabel detail_laporan
            $detailLaporan = new DetailLaporan;
            $detailLaporan->id_laporan = $laporan->id;
            $detailLaporan->dibuat_oleh = $request->dibuat_oleh;
            $detailLaporan->diterima_oleh = $request->diterima_oleh;
            $detailLaporan->wilayah_asal = $request->wilayah_asal;
            $detailLaporan->hal_menonjol = $request->hal_menonjol;
            $detailLaporan->deskripsi = $request->deskripsi;
            $detailLaporan->cuaca = $request->cuaca;
            $detailLaporan->jml_personil = $request->jml_personil;
            $detailLaporan->personil_hadir = $request->personil_hadir;
            $detailLaporan->personil_kurang = $request->personil_kurang;
            $detailLaporan->dinas_dalam = $request->dinas_dalam;
            $detailLaporan->dinas_luar = $request->dinas_luar;
            $detailLaporan->piket_pos = $request->piket_pos;
            $detailLaporan->materil = $request->materil;
            $detailLaporan->tembusan = $request->tembusan;
            $detailLaporan->lampiran = implode(',', $lampiranPaths);
            $detailLaporan->save();

            return redirect()->route('report.show', $laporan->id)->with('success', 'Berhasil Mengunggah');
        } catch (\Exception $e) {
            return redirect()->route('report.index')->with('error', 'Terdapat kesalahan : ' . $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    //Validasi Report
    public function show_index(Request $request)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        if(auth()->user()->level == 'admin'){
            $reports = DetailLaporan::with([
                'laporan', 'pembuat', 'penerima'
            ])->get();
        }else{
            $reports = DetailLaporan::with([
                'laporan', 'pembuat', 'penerima'
            ])->where('dibuat_oleh', auth()->user()->id)->get();
        }

        foreach ($reports as $report) {
            $report->laporan->tanggal_buat = Carbon::parse($report->laporan->created_at)->translatedFormat('d F Y');
        }

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            // 'namePage' => $namePage,
            'reports' => $reports,
        ];

        return view('page.report.show-index-validate', $data);
    }

    public function show(Request $request, $id)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $pengguna = Pengguna::where('level', '!=', 'admin')->get();

        if(auth()->user()->level == 'admin'){
            $report = DetailLaporan::with([
                'laporan', 'pembuat', 'penerima'
            ])->where('id_laporan', $id)->first();
        }else{
            $report = DetailLaporan::with([
                'laporan', 'pembuat', 'penerima'
            ])->where('id_laporan', $id)->where('dibuat_oleh', auth()->user()->id)->first();
        }

        $report->laporan->tanggal_buat = Carbon::parse($report->laporan->created_at)->translatedFormat('Y-m-d');

        $lampiran = explode(',', $report->lampiran);

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            // 'namePage' => $namePage,

            'user' => auth()->user(),
            'pengguna' => $pengguna,
            'report' => $report,
            'lampiran' => $lampiran,
        ];

        return view('page.report.show', $data);
    }

    public function show_other_index(Request $request)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        if(auth()->user()->level == 'admin'){
            $reports = DetailLaporan::with(['laporan', 'pembuat', 'penerima'])
                ->whereHas('laporan', function ($query) {
                    $query->where('status', 'valid')
                        ->orWhere('status', 'publish')
                        ->orWhere('status', 'verification');
                })->get();
        }else{
            $reports = DetailLaporan::with(['laporan', 'pembuat', 'penerima'])
                ->whereHas('laporan', function ($query) {
                    $query->where('status', 'valid')
                        ->orWhere('status', 'publish')
                        ->orWhere('status', 'verification');
                })->where('dibuat_oleh', auth()->user()->id)->get();
        }

        foreach ($reports as $report) {
            $report->laporan->tanggal_ubah = Carbon::parse($report->laporan->updated_at)->translatedFormat('d F Y');
        }

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            'namePage' => $namePage,

            'reports' => $reports,
        ];

        return view('page.report.show-other-report', $data);
    }

    public function other_document_completion(Request $request, $id_laporan)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        if(auth()->user()->level == 'admin'){
            $report = DetailLaporan::with(['laporan', 'pembuat', 'penerima'])
                ->whereHas('laporan', function ($query) use ($id_laporan) {
                    $query->where('id', $id_laporan);
                })->first();
        }else{
            $report = DetailLaporan::with(['laporan', 'pembuat', 'penerima'])
                ->whereHas('laporan', function ($query) use ($id_laporan) {
                    $query->where('id', $id_laporan);
                })->where('dibuat_oleh', auth()->user()->id)->first();
        }

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            'namePage' => $namePage,

            'report' => $report,
        ];

        return view('page.report.other-document-completion', $data);
    }

    public function other_document_completion_publish(Request $request)
    {
        $status = 'gagal';
        try {
            $laporan = Laporan::findOrFail($request->id_laporan);
            $laporan->status = 'publish';
            $laporan->save();

            $status = 'berhasil';
        } catch (\Exception $e) {
            $status = 'gagal';
        }
        return $status;
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
        $user = auth()->user();
        // Validasi data
        if ($user->level != 'babinsa') {
            $request->validate([
                'dibuat_oleh' => 'required',
                'diterima_oleh' => 'required',
                'jenis_laporan' => 'required',
                'judul_laporan' => 'required',
                'wilayah_asal' => 'required',
                'tanggal_dibuat' => 'required',
                'hal_menonjol' => 'required',
                'deskripsi' => 'required',
                'cuaca' => 'required',
                'jml_personil' => 'required',
                'personil_hadir' => 'required',
                'personil_kurang' => 'required',
                'dinas_dalam' => 'required',
                'dinas_luar' => 'required',
                'piket_pos' => 'required',
                'materil' => 'required',
                'tembusan' => 'required',
                'lampiran.*' => 'image|mimes:jpeg,png,jpg',
            ], [
                'dibuat_oleh.required' => 'Kolom dibuat oleh wajib diisi.',
                'diterima_oleh.required' => 'Kolom diterima oleh wajib diisi.',
                'jenis_laporan.required' => 'Kolom jenis laporan wajib diisi.',
                'judul_laporan.required' => 'Kolom judul laporan wajib diisi.',
                'wilayah_asal.required' => 'Kolom wilayah asal wajib diisi.',
                'tanggal_dibuat.required' => 'Kolom tanggal dibuat wajib diisi.',
                'hal_menonjol.required' => 'Kolom hal menonjol wajib diisi.',
                'deskripsi.required' => 'Kolom deskripsi wajib diisi.',
                'cuaca.required' => 'Kolom cuaca wajib diisi.',
                'jml_personil.required' => 'Kolom jumlah personil wajib diisi.',
                'personil_hadir.required' => 'Kolom personil hadir wajib diisi.',
                'personil_kurang.required' => 'Kolom personil kurang wajib diisi.',
                'dinas_dalam.required' => 'Kolom dinas dalam wajib diisi.',
                'dinas_luar.required' => 'Kolom dinas luar wajib diisi.',
                'piket_pos.required' => 'Kolom piket pos wajib diisi.',
                'materil.required' => 'Kolom materil wajib diisi.',
                'tembusan.required' => 'Kolom tembusan wajib diisi.',
                'lampiran.*.image' => 'Lampiran harus berupa gambar.',
                'lampiran.*.mimes' => 'Lampiran harus berformat jpeg, png, atau jpg.',
            ]);
        } else {
            $request->validate([
                'dibuat_oleh' => 'required',
                'diterima_oleh' => 'required',
                'jenis_laporan' => 'required',
                'judul_laporan' => 'required',
                'wilayah_asal' => 'required',
                'tanggal_dibuat' => 'required',
                'hal_menonjol' => 'required',
                'deskripsi' => 'required',
                'cuaca' => 'required',
                'materil' => 'required',
                'tembusan' => 'required',
                'lampiran.*' => 'image|mimes:jpeg,png,jpg',
            ], [
                'dibuat_oleh.required' => 'Kolom dibuat oleh wajib diisi.',
                'diterima_oleh.required' => 'Kolom diterima oleh wajib diisi.',
                'jenis_laporan.required' => 'Kolom jenis laporan wajib diisi.',
                'judul_laporan.required' => 'Kolom judul laporan wajib diisi.',
                'wilayah_asal.required' => 'Kolom wilayah asal wajib diisi.',
                'tanggal_dibuat.required' => 'Kolom tanggal dibuat wajib diisi.',
                'hal_menonjol.required' => 'Kolom hal menonjol wajib diisi.',
                'deskripsi.required' => 'Kolom deskripsi wajib diisi.',
                'cuaca.required' => 'Kolom cuaca wajib diisi.',
                'materil.required' => 'Kolom materil wajib diisi.',
                'tembusan.required' => 'Kolom tembusan wajib diisi.',
                'lampiran.*.image' => 'Lampiran harus berupa gambar.',
                'lampiran.*.mimes' => 'Lampiran harus berformat jpeg, png, atau jpg.',
            ]);
        }

        $laporan = Laporan::findOrFail($id);
        try {
            // Simpan data ke tabel laporan
            $laporan->jenis_laporan = $request->jenis_laporan;
            $laporan->judul_laporan = $request->judul_laporan;
            $laporan->status = 'valid';
            $laporan->save();

            if ($request->hasFile('lampiran')) {
                // Hapus gambar lama jika ada
                foreach ($request->file('lampiran') as $index => $file) {
                    $fileName = 'lampiran-' . $laporan->id . '-' . $index . '.' . $file->getClientOriginalExtension();
                    Storage::disk('public')->delete('images/report/' . $fileName);
                }

                // Upload lampiran dan simpan path
                foreach ($request->file('lampiran') as $index => $file) {
                    $fileName = 'lampiran-' . $laporan->id . '-' . $index . '.' . $file->getClientOriginalExtension();
                    $file->storeAs('images/report', $fileName, 'public');
                }
            }

            // Simpan data ke tabel detail_laporan
            $detailLaporan = DetailLaporan::where('id_laporan', $laporan->id)->first();
            $detailLaporan->id_laporan = $laporan->id;
            $detailLaporan->dibuat_oleh = $request->dibuat_oleh;
            $detailLaporan->diterima_oleh = $request->diterima_oleh;
            $detailLaporan->wilayah_asal = $request->wilayah_asal;
            $detailLaporan->hal_menonjol = $request->hal_menonjol;
            $detailLaporan->deskripsi = $request->deskripsi;
            $detailLaporan->cuaca = $request->cuaca;
            $detailLaporan->jml_personil = $request->jml_personil;
            $detailLaporan->personil_hadir = $request->personil_hadir;
            $detailLaporan->personil_kurang = $request->personil_kurang;
            $detailLaporan->dinas_dalam = $request->dinas_dalam;
            $detailLaporan->dinas_luar = $request->dinas_luar;
            $detailLaporan->piket_pos = $request->piket_pos;
            $detailLaporan->materil = $request->materil;
            $detailLaporan->tembusan = $request->tembusan;
            $detailLaporan->save();

            $laporan->file_laporan = $this->generateReport($id);
            $laporan->save();

            return redirect()->route('report.other-document-completion', $laporan->id)->with('success', 'Berhasil Validasi');
        } catch (\Exception $e) {
            return redirect()->route('report.show', $laporan->id)->with('error', 'Terdapat kesalahan : ' . $e);
        }
    }

    public function edit($id) // Verifikasi Report
    {
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
