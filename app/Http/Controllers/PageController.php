<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Pengajuan;
use App\Models\Pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index()
    {
        return redirect()->route('page.login');
    }
    public function dashboard(Request $request)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $report = Laporan::select('status', DB::raw('count(*) as total'))->groupBy('status')->get();
        $total_report = 0;
        foreach ($report as $key => $data) {
            $total_report += $data->total;
        }
        $letter = Pengajuan::select('status', DB::raw('count(*) as total'))->groupBy('status')->get();
        $total_letter = 0;
        foreach ($letter as $key => $data) {
            $total_letter += $data->total;
        }

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            'namePage' => $namePage,
            'report' => $report,
            'total_report' => $total_report,
            'letter' => $letter,
            'total_letter' => $total_letter,
        ];

        return view('page.dashboard', $data);
    }
    public function login()
    {
        return view('login');
    }

    public function forgot_password(Request $request)
    {
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

        return view('forgot-password', $data);
    }

    public function post_forgot_password(Request $request) {
        $data_anggota = Pengguna::where('nrp', $request->nrp)->first();
        $admin = Pengguna::where('level', "admin")->first();
        
        // Cek jika angka pertama adalah 0, ganti dengan 62
        if (substr($admin->no_telp, 0, 1) === '0') {
            $phone_number = '62' . substr($admin->no_telp, 1);
        }
        $message = 'Permintaan Perubahan Password oleh *'. $data_anggota->nama_lengkap .'* dengan NRP *'. $request->nrp .'*';

        $encoded_message = urlencode($message);

        return redirect('https://wa.me/'. $phone_number .'?text='. $encoded_message);
    }

    public function change_password(Request $request, $id)
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

            'pengguna' => $pengguna,
        ];

        return view('change-password', $data);
    }

    public function profile(Request $request, $page = null)
    {
        // Mendapatkan URL saat ini
        $currentUrl = $request->path();

        // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
        $page = last(explode('/', $currentUrl));
        $namePage = $this->kebabToTitleCase($page);

        $user = auth()->user();

        $data = [
            'title' => 'SIKOM1416 | ' . $namePage,
            'page' => $page,
            'namePage' => $namePage,

            // Data Tambahan
            'user' => $user,
        ];

        return view('page.profile', $data);
    }

    // Laporan
    // public function create_report(Request $request, $page = null)
    // {
    //     // Mendapatkan URL saat ini
    //     $currentUrl = $request->path();

    //     // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
    //     $page = last(explode('/', $currentUrl));
    //     $namePage = $this->kebabToTitleCase($page);

    //     $data = [
    //         'title' => 'SIKOM1416 | ' . $namePage,
    //         'page' => $page,
    //         'namePage' => $namePage,
    //     ];

    //     return view('page.create-report', $data);
    // }

    // public function show_report(Request $request, $page = null)
    // {
    //     // Mendapatkan URL saat ini
    //     $currentUrl = $request->path();

    //     // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
    //     $page = last(explode('/', $currentUrl));
    //     $namePage = $this->kebabToTitleCase($page);

    //     $data = [
    //         'title' => 'SIKOM1416 | ' . $namePage,
    //         'page' => $page,
    //         'namePage' => $namePage,
    //     ];

    //     return view('page.show-report', $data);
    // }

    // public function show_other_document_report(Request $request, $page = null)
    // {
    //     // Mendapatkan URL saat ini
    //     $currentUrl = $request->path();

    //     // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
    //     $page = last(explode('/', $currentUrl));
    //     $namePage = $this->kebabToTitleCase($page);

    //     $data = [
    //         'title' => 'SIKOM1416 | ' . $namePage,
    //         'page' => $page,
    //         'namePage' => $namePage,
    //     ];

    //     return view('page.show-other-report', $data);
    // }
    // End Laporan

    // Surat
    // public function create_letter(Request $request, $page = null)
    // {
    //     // Mendapatkan URL saat ini
    //     $currentUrl = $request->path();

    //     // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
    //     $page = last(explode('/', $currentUrl));
    //     $namePage = $this->kebabToTitleCase($page);

    //     $data = [
    //         'title' => 'SIKOM1416 | ' . $namePage,
    //         'page' => $page,
    //         'namePage' => $namePage,
    //     ];

    //     return view('page.create-letter', $data);
    // }

    // public function show_letter(Request $request, $page = null)
    // {
    //     // Mendapatkan URL saat ini
    //     $currentUrl = $request->path();

    //     // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
    //     $page = last(explode('/', $currentUrl));
    //     $namePage = $this->kebabToTitleCase($page);

    //     $data = [
    //         'title' => 'SIKOM1416 | ' . $namePage,
    //         'page' => $page,
    //         'namePage' => $namePage,
    //     ];

    //     return view('page.show-letter', $data);
    // }

    // public function show_other_document_letter(Request $request, $page = null)
    // {
    //     // Mendapatkan URL saat ini
    //     $currentUrl = $request->path();

    //     // Memproses bagian URL yang diinginkan, misalnya, mengambil segmen terakhir
    //     $page = last(explode('/', $currentUrl));
    //     $namePage = $this->kebabToTitleCase($page);

    //     $data = [
    //         'title' => 'SIKOM1416 | ' . $namePage,
    //         'page' => $page,
    //         'namePage' => $namePage,
    //     ];

    //     return view('page.show-other-letter', $data);
    // }
    // End Surat

}
