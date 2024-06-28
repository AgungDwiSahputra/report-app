
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
                font-size:14px;
                font-family: 'Ubuntu', sans-serif;
            }
            span{
                display: block;
            }
        </style>
    </head>

    <body class="overflow-x-hidden">
        @php
            // Menghapus "Koramil " dari awal kalimat
            $wilayah_asal_danramil = str_replace("Koramil ", "", $data->wilayah_asal);

            // Membuat format "1416/Muna"
            $wilayah_asal_dandim = preg_replace("/(\d{4})-\d{2}\/\w+/", "$1/Muna", $wilayah_asal_danramil);
        @endphp
        <div class="text-center mb-5">
            <span style="text-align:left">KOMANDO DISTRIK MILITER 1416/MUNA</span>
            <span style="text-align:left;text-decoration:underline;">KOMANDO RAYON MILITER {{ $wilayah_asal_danramil }}</span>
            <br><br><br>
            <center>
                <span>LAPORAN SITUASI HARIAN</span>
                <span>Nomor: RI/{{ $data->laporan->id }}/LSH/{{ date('Y') }}/{{ $data->pembuat->jabatan }}</span>
                <br>
                <span>PEMANTAUAN WILAYAH {{ strtoupper($data->wilayah_asal) }}</span>
                <span>TWP. {{ $data->laporan->waktu_buat }} WITA. {{ $data->laporan->tanggal_buat }}</span>
            </center>
        </div>
        <br>
        <div style="margin-bottom: 8px;">
            @if($data->pembuat->level == 'babinsa')
                <span>Yth. {{ $data->penerima->jabatan }}</span>
            @else
                <span>Yth. {{ $data->penerima->jabatan }}</span>
            @endif
            <span>Dari {{ $data->pembuat->jabatan }}</span>
        </div>

        <div style="margin-bottom: 8px;">
            <span>Ijin melaporkan</span>
            <table style="width: 100%;margin-left:20px">
                <tr>
                    <td style="vertical-align: top;width: 10px">1.</td>
                    <td style="vertical-align: top;" colspan="3">Perkembangan Situasi Wilayah {{ $data->laporan->wilayah_asal }} pada Hari Senin, {{ $data->laporan->tanggal_buat }}, Pukul {{ $data->laporan->waktu_buat }} WITA dalam keadaan aman terkendali.</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;width: 10px">2.</td>
                    <td style="vertical-align: top;width: 150px">Hal-Hal Menonjol</td>
                    <td style="vertical-align: top;width: 10px">:</td>
                    <td style="vertical-align: top;">{{ $data->hal_menonjol }}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;width: 10px">3.</td>
                    <td style="vertical-align: top;width: 150px">Cuaca</td>
                    <td style="vertical-align: top;width: 10px">:</td>
                    <td style="vertical-align: top;">{{ $data->cuaca }}</td>
                </tr>
            @if(auth()->user()->level != 'babinsa')
                <tr>
                    <td style="vertical-align: top;width: 10px">4.</td>
                    <td style="vertical-align: top;width: 150px">Jumlah Personil</td>
                    <td style="vertical-align: top;width: 10px">:</td>
                    <td style="vertical-align: top;">{{ $data->jml_personil }}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;width: 10px">5.</td>
                    <td style="vertical-align: top;width: 150px">Personil Hadir</td>
                    <td style="vertical-align: top;width: 10px">:</td>
                    <td style="vertical-align: top;">{{ $data->personil_hadir }}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;width: 10px">6.</td>
                    <td style="vertical-align: top;width: 150px">Personil Kurang</td>
                    <td style="vertical-align: top;width: 10px">:</td>
                    <td style="vertical-align: top;">{{ $data->personil_kurang }}</td>
                </tr>
            @endif
            </table>
        </div>

        <div style="margin-bottom: 8px;">
            <span>Keterangan</span>
            <table style="width: 100%;margin-left:20px">
                <tr>
                    <td style="vertical-align: top;width: 10px">1.</td>
                    <td style="vertical-align: top;width: 150px">Materil</td>
                    <td style="vertical-align: top;width: 10px">:</td>
                    <td style="vertical-align: top;">{{ ucwords($data->materil) }}</td>
                </tr>
            @if(auth()->user()->level != 'babinsa')
                <tr>
                    <td style="vertical-align: top;width: 10px">2.</td>
                    <td style="vertical-align: top;width: 150px">Dinas Dalam</td>
                    <td style="vertical-align: top;width: 10px">:</td>
                    <td style="vertical-align: top;">{{ $data->dinas_dalam }}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;width: 10px">2.</td>
                    <td style="vertical-align: top;width: 150px">Dinas Luar</td>
                    <td style="vertical-align: top;width: 10px">:</td>
                    <td style="vertical-align: top;">{{ $data->dinas_luar }}</td>
                </tr>
                <tr>
                    <td style="vertical-align: top;width: 10px">3.</td>
                    <td style="vertical-align: top;width: 150px">Piket Koramil</td>
                    <td style="vertical-align: top;width: 10px">:</td>
                    <td style="vertical-align: top;">{{ $data->piket_pos }}</td>
                </tr>
            @endif
            </table>
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
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <h3>Lampiran</h3>
        <table>
            @foreach($data->lampiran as $lampiran)
                <tr>
                    <td>
                        <img width="400px" src="{{ public_path('storage/images/report/' . $lampiran) }}" alt="Image Lampiran">
                    </td>
                </tr>
            @endforeach
        </table>
    </body>

</html>