<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    // Function Custom
    // Fungsi untuk mengubah text random menjadi bentuk huruf aja dan kasih simbol penghubung jika ada spasi
    public function filterText($text)
    {
        // Hanya menyimpan huruf dan spasi
        $filteredText = preg_replace('/[^a-zA-Z\s-]/', '', $text);

        // Mengganti spasi dengan tanda hubung
        $filteredText = preg_replace('/\s+/', '-', $filteredText);

        return $filteredText;
    }

    // Fungsi untuk mengubah kebab-case menjadi Title Case
    public function kebabToTitleCase($text)
    {
        // Ganti tanda hubung dengan spasi
        $text = str_replace('-', ' ', $text);
        // Ubah menjadi Title Case
        $text = ucwords($text);

        return $text;
    }
    // End Function Custom

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

    public function change_password(Request $request)
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

        return view('change-password', $data);
    }

    public function profile(Request $request, $page = null)
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

    public function show_other_document_report(Request $request, $page = null)
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

        return view('page.show-other-report', $data);
    }
    // End Laporan

    // Surat
    public function create_letter(Request $request, $page = null)
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

        return view('page.create-letter', $data);
    }

    public function show_letter(Request $request, $page = null)
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

        return view('page.show-letter', $data);
    }

    public function show_other_document_letter(Request $request, $page = null)
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

        return view('page.show-other-letter', $data);
    }
    // End Surat

    public function list_anggota(Request $request, $page = null)
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

        return view('page.list-anggota', $data);
    }
}
