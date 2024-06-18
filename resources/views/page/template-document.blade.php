
<!DOCTYPE html>
<html>

    <head>
        <style>
            @font-face {
                font-family: 'Ubuntu';
                src: url('{{ storage_path('fonts/Ubuntu-Regular.ttf') }}') format('truetype');
                font-weight: normal;
                font-style: normal;
            }
            @font-face {
                font-family: 'Ubuntu';
                src: url('{{ storage_path('fonts/Ubuntu-Bold.ttf') }}') format('truetype');
                font-weight: bold;
                font-style: normal;
            }
            @font-face {
                font-family: 'Ubuntu';
                src: url('{{ storage_path('fonts/Ubuntu-Italic.ttf') }}') format('truetype');
                font-weight: normal;
                font-style: italic;
            }
            @font-face {
                font-family: 'Ubuntu';
                src: url('{{ storage_path('fonts/Ubuntu-BoldItalic.ttf') }}') format('truetype');
                font-weight: bold;
                font-style: italic;
            }
            body {
                font-family: 'Ubuntu', sans-serif;
            }
            span{
                display: block;
            }
        </style>
    </head>

    <body class="overflow-x-hidden">
        <div class="text-center mb-5">
            <span style="text-align:left">KOMANDO DISTRIK MILITER 1416/MUNA</span>
            <span style="text-align:left;text-decoration:underline;">KOMANDO RAYON MILITER 1416-06/LAWA</span>
            <br><br><br>
            <center>
                <span>LAPORAN SITUASI HARIAN</span>
                <span>Nomor: RU/LSH/{{ date('Y') }}/{{ $data->pembuat->jabatan . " " . $data->wilayah_asal }}</span>
                <br>
                <span>PEMANTAUAN WILAYAH {{ $data->wilayah_asal }}</span>
                <span>TWP. {{ $data->laporan->waktu_buat }} WITA. {{ $data->laporan->tanggal_buat }}</span>
            </center>
        </div>
        <br>
        <div style="margin-bottom: 8px;">
            <span>Yth. {{ $data->penerima->nama_lengkap }}</span>
            <span>Dari {{ $data->pembuat->nama_lengkap }}</span>
        </div>

        <div style="margin-bottom: 8px;">
            <span>Ijin melaporkan</span>
            <ol type="1" style="margin-top: 0 !important;">
                <li>Perkembangan Situasi Wilayah {{ $data->laporan->wilayah_asal }} pada Hari Senin, {{ $data->laporan->tanggal_buat }}, Pukul {{ $data->laporan->waktu_buat }} WITA dalam keadaan aman terkendali.</li>
                <li>Hal-Hal Menonjol : {{ $data->hal_menonjol }}</li>
                <li>Cuaca : {{ $data->cuaca }}</li>
                @if(auth()->user()->level != 'babinsa')
                    <li>Jumlah Personil : {{ $data->jml_personil }}</li>
                    <li>Personil Hadir : {{ $data->personil_hadir }}</li>
                    <li>Personil Kurang : {{ $data->personil_kurang }}</li>
                @endif
            </ol>
        </div>

        <div style="margin-bottom: 8px;">
            <span>Keterangan</span>
            <ol type="1" style="margin-top: 0 !important;">
                @if(auth()->user()->level != 'babinsa')
                    <li>Dinas Dalam : {{ $data->dinas_dalam }}</li>
                    <li>Dinas Luar : {{ $data->dinas_luar }}</li>
                    <li>Piket Koramil : {{ $data->piket_pos }}</li>
                @endif
                <li>Materil : {{ $data->materil }}</li>
            </ol>
        </div>

        <div style="margin-bottom: 8px;">
            <span>Kegiatan Hari Ini</span>
            <ol type="1" style="margin-top: 0 !important;">
                @foreach(explode(';', $data->deskripsi) as $key => $kegiatan)
                    <li>{{ $kegiatan }}</li>
                @endforeach
            </ol>
        </div>

        <div style="margin-bottom: 8px;">
            <span>Demikian kami laporkan.</span>
            <span>Dokumen terlampir.</span>
        </div>

        <div style="margin-bottom: 8px;">
            <span>Tembusan</span>
            <ol type="1" style="margin-top: 0 !important;">
                @foreach(explode(';', $data->tembusan) as $key => $kegiatan)
                    <li>{{ $kegiatan }}</li>
                @endforeach
            </ol>
        </div>
    </body>

</html>