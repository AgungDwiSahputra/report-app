<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuan;
use App\Models\Pengajuan;
use App\Models\Pengguna;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengajuanController extends Controller
{
    // Custom Function
    public function downloadPengajuan($filename)
    {
        // Tentukan path file di Storage
        $filePath = 'public/document/pengajuan/' . $filename;

        // Periksa apakah file ada
        if (!Storage::exists($filePath)) {
            return response()->json(['error' => 'File not found'], 404);
        }

        // Ambil file dari Storage dan unduh
        return Storage::download($filePath);
    }
    // End Custom Function
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

        $letters = DetailPengajuan::with([
            'pengajuan', 'pembuat', 'penerima'
        ])->where('dibuat_oleh', auth()->user()->id)->get();

        foreach ($letters as $report) {
            $report->pengajuan->tanggal_buat = Carbon::parse($report->pengajuan->created_at)->translatedFormat('d F Y');
        }

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            'namePage' => $namePage,
            'letters' => $letters,
        ];

        return view('page.letter.index', $data);
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

        $pengguna = Pengguna::where('level', '=', 'dandim')->get();
        $penggunaPerintah = Pengguna::get();

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            // 'namePage' => $namePage,

            'user' => auth()->user(),
            'pengguna' => $pengguna,
            'penggunaPerintah' => $penggunaPerintah,
        ];

        return view('page.letter.create-letter', $data);
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
        $request->validate([
            'dibuat_oleh' => 'required',
            'diterima_oleh' => 'required',
            'jenis_pengajuan' => 'required',
            'judul_pengajuan' => 'required',
            'wilayah_asal' => 'required',
            'tanggal_dibuat' => 'required',
            'deskripsi' => 'required',
            'diperintahkan_kepada' => 'required',
            'dasar_perintah' => 'required',
            'tembusan' => 'required',
        ], [
            'dibuat_oleh.required' => 'Kolom dibuat oleh wajib diisi.',
            'diterima_oleh.required' => 'Kolom diterima oleh wajib diisi.',
            'jenis_pengajuan.required' => 'Kolom jenis pengajuan wajib diisi.',
            'judul_pengajuan.required' => 'Kolom judul pengajuan wajib diisi.',
            'wilayah_asal.required' => 'Kolom wilayah asal wajib diisi.',
            'tanggal_dibuat.required' => 'Kolom tanggal dibuat wajib diisi.',
            'deskripsi.required' => 'Kolom deskripsi wajib diisi.',
            'diperintahkan_kepada.required' => 'Kolom diperintahkan kepada wajib diisi.',
            'dasar_perintah.required' => 'Kolom dasar perintah wajib diisi.',
            'tembusan.required' => 'Kolom tembusan wajib diisi.',
        ]);

        try {
            // Simpan data ke tabel pengajuan
            $pengajuan = new Pengajuan;
            $pengajuan->jenis_pengajuan = $request->jenis_pengajuan;
            $pengajuan->judul_pengajuan = $request->judul_pengajuan;
            $pengajuan->status = 'disagree';
            $pengajuan->save();

            // Simpan data ke tabel detail_pengajuan
            $detailPengajuan = new DetailPengajuan;
            $detailPengajuan->id_pengajuan = $pengajuan->id;
            $detailPengajuan->dibuat_oleh = auth()->user()->id;
            $detailPengajuan->diterima_oleh = $request->diterima_oleh;
            $detailPengajuan->wilayah_asal = $request->wilayah_asal;
            $detailPengajuan->deskripsi = $request->deskripsi;
            $detailPengajuan->diperintahkan_kepada = $request->diperintahkan_kepada;
            $detailPengajuan->dasar_perintah = $request->dasar_perintah;
            $detailPengajuan->tembusan = $request->tembusan;
            $detailPengajuan->save();

            return redirect()->route('pengajuan.show', $pengajuan->id)->with('success', 'Berhasil Menyimpan');
        } catch (\Exception $e) {
            return redirect()->route('pengajuan.create')->with('error', 'Terdapat kesalahan : ' . $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    // Validasi Pengajuan
    public function show_index(Request $request)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $letters = DetailPengajuan::with([
            'pengajuan', 'pembuat', 'penerima'
        ])->where('dibuat_oleh', auth()->user()->id)->get();

        foreach ($letters as $report) {
            $report->pengajuan->tanggal_buat = Carbon::parse($report->pengajuan->created_at)->translatedFormat('d F Y');
        }

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            // 'namePage' => $namePage,
            'letters' => $letters,
        ];

        return view('page.letter.show-index', $data);
    }
    public function show_other_index(Request $request)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $letters = DetailPengajuan::with(['pengajuan', 'pembuat', 'penerima'])
            ->whereHas('pengajuan', function ($query) {
                $query->where('status', 'agree')
                    ->orWhere('status', 'valid')
                    ->orWhere('status', 'publish');
            })->where('dibuat_oleh', auth()->user()->id)->get();

        foreach ($letters as $report) {
            $report->pengajuan->tanggal_ubah = Carbon::parse($report->pengajuan->updated_at)->translatedFormat('d F Y');
        }

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            'namePage' => $namePage,

            'letters' => $letters,
        ];

        return view('page.letter.show-other-index', $data);
    }
    public function show_other_document(Request $request, $id_pengajuan) {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $letter = DetailPengajuan::with(['pengajuan', 'pembuat', 'penerima'])
            ->whereHas('pengajuan', function ($query) use ($id_pengajuan) {
                $query->where('id', $id_pengajuan);
            })->where('dibuat_oleh', auth()->user()->id)->first();

        $letter->pengajuan->tanggal_romawi = Carbon::parse($letter->pengajuan->updated_at)->translatedFormat('n');
        $tanggal_romawi = array(
            1 => 'I', 
            2 => 'II', 
            3 => 'III', 
            4 => 'IV', 
            5 => 'V', 
            6 => 'VI', 
            7 => 'VII', 
            8 => 'VIII', 
            9 => 'IX', 
            10 => 'X', 
            11 => 'XI', 
            12 => 'XII'
        );
        $letter->pengajuan->tanggal_romawi = $tanggal_romawi[$letter->pengajuan->tanggal_romawi];

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            'namePage' => $namePage,

            'letter' => $letter,
        ];

        return view('page.letter.show-other-document', $data);
    }

    public function post_show_other_document(Request $request)
    {
        $status = 'gagal';
        try {
            $pengajuan = Pengajuan::findOrFail($request->id_pengajuan);
            $pengajuan->status = 'publish';
            $pengajuan->save();

            $status = 'berhasil';
        } catch (\Exception $e) {
            $status = 'gagal';
        }
        return $status;
    }
    
    public function show(Request $request, $id)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $pengguna = Pengguna::where('level', '=', 'dandim')->get();
        $penggunaPerintah = Pengguna::get();

        $letter = DetailPengajuan::with([
            'pengajuan', 'pembuat', 'penerima'
        ])->where('id_pengajuan', $id)->where('dibuat_oleh', auth()->user()->id)->first();

        $letter->pengajuan->tanggal_buat = Carbon::parse($letter->pengajuan->created_at)->translatedFormat('Y-m-d');

        $lampiran = explode(',', $letter->lampiran);

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            // 'namePage' => $namePage,

            'user' => auth()->user(),
            'pengguna' => $pengguna,
            'penggunaPerintah' => $penggunaPerintah,
            'letter' => $letter,
            'lampiran' => $lampiran,
        ];

        return view('page.letter.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        
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
        // Validasi data
        $request->validate([
            'dibuat_oleh' => 'required',
            'diterima_oleh' => 'required',
            'jenis_pengajuan' => 'required',
            'judul_pengajuan' => 'required',
            'wilayah_asal' => 'required',
            'tanggal_dibuat' => 'required',
            'deskripsi' => 'required',
            'diperintahkan_kepada' => 'required',
            'dasar_perintah' => 'required',
            'tembusan' => 'required',
        ], [
            'dibuat_oleh.required' => 'Kolom dibuat oleh wajib diisi.',
            'diterima_oleh.required' => 'Kolom diterima oleh wajib diisi.',
            'jenis_pengajuan.required' => 'Kolom jenis pengajuan wajib diisi.',
            'judul_pengajuan.required' => 'Kolom judul pengajuan wajib diisi.',
            'wilayah_asal.required' => 'Kolom wilayah asal wajib diisi.',
            'tanggal_dibuat.required' => 'Kolom tanggal dibuat wajib diisi.',
            'deskripsi.required' => 'Kolom deskripsi wajib diisi.',
            'diperintahkan_kepada.required' => 'Kolom diperintahkan kepada wajib diisi.',
            'dasar_perintah.required' => 'Kolom dasar perintah wajib diisi.',
            'tembusan.required' => 'Kolom tembusan wajib diisi.',
        ]);

        $pengajuan = Pengajuan::findOrFail($id);
        try {
            // Simpan data ke tabel pengajuan
            $pengajuan->jenis_pengajuan = $request->jenis_pengajuan;
            $pengajuan->judul_pengajuan = $request->judul_pengajuan;
            $pengajuan->status = 'valid';
            $pengajuan->save();
            
            // Simpan data ke tabel detail_pengajuan
            $detailPengajuan = DetailPengajuan::where('id_pengajuan', $pengajuan->id)->first();
            $detailPengajuan->id_pengajuan = $pengajuan->id;
            $detailPengajuan->dibuat_oleh = auth()->user()->id;
            $detailPengajuan->diterima_oleh = $request->diterima_oleh;
            $detailPengajuan->wilayah_asal = $request->wilayah_asal;
            $detailPengajuan->deskripsi = $request->deskripsi;
            $detailPengajuan->diperintahkan_kepada = $request->diperintahkan_kepada;
            $detailPengajuan->dasar_perintah = $request->dasar_perintah;
            $detailPengajuan->tembusan = $request->tembusan;
            $detailPengajuan->save();
            
            $pengajuan->file_pengajuan = $this->generatePengajuan($id);
            $pengajuan->save();

            return redirect()->route('pengajuan.other-document-pengajuan', $pengajuan->id)->with('success', 'Berhasil Menyimpan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terdapat kesalahan : ' . $e);
        }
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

    public function contoh_report() {
        return view('page.template-surat-pengajuan');
    }
}
