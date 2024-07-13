<?php

namespace App\Http\Controllers;

use App\Models\DetailLaporan;
use App\Models\Laporan;
use Carbon\Carbon;
use Illuminate\Http\Request;

class VerificationReportController extends Controller
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

        if(auth()->user()->level == 'admin'){
            $reports = DetailLaporan::with(['laporan', 'pembuat', 'penerima'])
                ->whereHas('laporan', function ($query) {
                    $query->where('status', 'publish')
                        ->orWhere('status', 'not-verify')
                        ->orWhere('status', 'verification');
                })->get();
        }else{
            $reports = DetailLaporan::with(['laporan', 'pembuat', 'penerima'])
                ->whereHas('laporan', function ($query) {
                    $query->where('status', 'publish')
                        ->orWhere('status', 'not-verify')
                        ->orWhere('status', 'verification');
                })->where('diterima_oleh', auth()->user()->id)->get();
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

        return view('page.report.show-index-verification', $data);
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
    public function edit(Request $request, $id_laporan)
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
                })->where('diterima_oleh', auth()->user()->id)->first();
        }

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            'namePage' => $namePage,

            'report' => $report,
        ];

        return view('page.report.report-verification', $data);
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

        $laporan = Laporan::findOrFail($id);

        try {
            // Simpan data ke tabel laporan
            $laporan->status = $request->tindakan;
            $laporan->catatan = $request->catatan;
            $laporan->save();

            if($request->tindakan == 'verification'){
                return redirect()->route('verification-report.index')->with('success', 'Berhasil Verifikasi Laporan');
            }else{
                return redirect()->route('verification-report.index')->with('success', 'Berhasil Menolak Laporan');
            }
        } catch (\Exception $e) {
            return redirect()->route('verification-report.edit', $laporan->id)->with('error', 'Terdapat kesalahan : ' . $e);
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
