<?php

namespace App\Http\Controllers;

use App\Models\Pengguna;
use Illuminate\Http\Request;

class PageController extends Controller
{
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
