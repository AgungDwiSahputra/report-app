<?php

namespace App\Http\Controllers;

use App\Models\DetailPengajuan;
use App\Models\Pengajuan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificationPengajuanController extends Controller
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

        $letters = DetailPengajuan::with(['pengajuan', 'pembuat', 'penerima'])
            ->whereHas('pengajuan', function ($query) {
                $query->where('status', 'publish')
                    ->orWhere('status', 'not-verify')
                    ->orWhere('status', 'agree');
            })->where('diterima_oleh', auth()->user()->id)->get();

        foreach ($letters as $letter) {
            $letter->pengajuan->tanggal_buat = Carbon::parse($letter->pengajuan->created_at)->translatedFormat('d F Y');
        }

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            // 'namePage' => $namePage,
            'letters' => $letters,
        ];

        return view('page.letter.show-index-verification', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id_pengajuan)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $letter = DetailPengajuan::with(['pengajuan', 'pembuat', 'penerima'])
            ->whereHas('pengajuan', function ($query) use ($id_pengajuan) {
                $query->where('id', $id_pengajuan);
            })->where('diterima_oleh', auth()->user()->id)->first();

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

        return view('page.letter.letter-verification', $data);
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
        $request->validate([
            'tindakan' => 'required',
        ], [
            'tindakan.required' => 'Tindakan wajib di pilih',
        ]);

        $letter = Pengajuan::findOrFail($id);

        try {
            // Simpan data ke tabel letter
            $letter->status = $request->tindakan;
            $letter->save();

            if($request->tindakan == 'agree'){
                return redirect()->route('verification-pengajuan.index')->with('success', 'Berhasil Verifikasi Surat Pengajuan');
            }else{
                return redirect()->route('verification-pengajuan.index')->with('success', 'Berhasil Menolak Surat Pengajuan');
            }
        } catch (\Exception $e) {
            return redirect()->route('verification-pengajuan.edit', $letter->id)->with('error', 'Terdapat kesalahan : ' . $e);
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
}
