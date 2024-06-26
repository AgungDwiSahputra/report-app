<?php

namespace App\Http\Controllers;

use App\Models\DetailLaporan;
use App\Models\DetailPengajuan;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;
use PDF;

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

    // Generating PDF
    public function generateReport($id_laporan)
    {
        $data = DetailLaporan::with(['laporan', 'pembuat', 'penerima'])
            ->whereHas('laporan', function ($query) use ($id_laporan) {
                $query->where('id', $id_laporan);
            })->first();

        $data->cuaca = str_replace('-', ' ', $data->cuaca);
        // Ubah menjadi Title Case
        $data->cuaca = ucwords($data->cuaca);

        $data->laporan->tanggal_buat = Carbon::parse($data->laporan->created_at)
            ->setTimezone('Asia/Makassar')
            ->translatedFormat('l, d F Y');
        $data->laporan->waktu_buat = Carbon::parse($data->laporan->created_at)->setTimezone('Asia/Makassar')->translatedFormat('H.i');

        $data->lampiran = explode(',', $data->lampiran);

        $pdf = PDF::loadView('page.template-document', compact('data'));

        // Buat nama file dengan ekstensi .pdf
        $filename = 'Laporan_Situasi_Harian_' . $id_laporan . '.pdf';

        // Simpan file PDF ke folder storage/app/public/document/report
        Storage::makeDirectory('public/document/report');
        Storage::put('public/document/report/' . $filename, $pdf->output());
        return $filename;
    }

    public function generatePengajuan($id_pengajuan)
    {
        $data = DetailPengajuan::with(['pengajuan', 'pembuat', 'penerima', 'perintah'])
            ->whereHas('pengajuan', function ($query) use ($id_pengajuan) {
                $query->where('id', $id_pengajuan);
            })->first();

        $data->pengajuan->tanggal_buat = Carbon::parse($data->pengajuan->created_at)
            ->setTimezone('Asia/Makassar')
            // ->translatedFormat('l, d F Y');
            ->translatedFormat('d F Y');
        $data->pengajuan->tanggal_romawi = Carbon::parse($data->pengajuan->updated_at)->translatedFormat('n');
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
        $data->pengajuan->tanggal_romawi = $tanggal_romawi[$data->pengajuan->tanggal_romawi];

        $data->pengajuan->waktu_buat = Carbon::parse($data->pengajuan->created_at)->setTimezone('Asia/Makassar')->translatedFormat('H.i');

        // $data->lampiran = explode(',', $data->lampiran);

        $pdf = PDF::loadView('page.template-surat-pengajuan', compact('data'));

        // Buat nama file dengan ekstensi .pdf
        $filename = 'Surat_Pengajuan_Situasi_Harian_' . $id_pengajuan . '.pdf';

        // Simpan file PDF ke folder storage/app/public/document/pengajuan
        Storage::makeDirectory('public/document/pengajuan');
        Storage::put('public/document/pengajuan/' . $filename, $pdf->output());
        return $filename;
    }
    // End Function Custom
}
