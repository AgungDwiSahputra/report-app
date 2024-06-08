<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

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
}
