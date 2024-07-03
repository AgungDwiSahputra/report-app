
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
                font-size: 14px;
                font-family: 'Ubuntu', sans-serif;
            }
            span{
                display: block;
            }
        </style>
    </head>

    <body style="background-color: white; color: black; padding: 10px;">
        @php
            // Menghapus "Koramil " dari awal kalimat
            $wilayah_asal_danramil = str_replace("Koramil ", "", $data->wilayah_asal);

            // Membuat format "1416/Muna"
            $wilayah_asal_dandim = preg_replace("/(\d{4})-\d{2}\/\w+/", "$1/Muna", $wilayah_asal_danramil);
        @endphp
        <div style="max-width: 650px; margin: 0 auto; padding: 20px;">
            <div style="margin-bottom: 20px;border-bottom: 1px solid black;width:350px">
                <span>KOMANDO RESOR MILITER 143/HALU OLEO</span>
                <span>KOMANDO DISTRIK MILITER {{ strtoupper($wilayah_asal_dandim) }}</span>
            </div>
            <br>
            <h1 style="text-align: center; font-weight: bold; font-size: 16px;margin:0;padding:0;">SURAT PERINTAH</h1>
            <span style="text-align: center; margin-bottom: 20px;">Nomor : Sprin/{{ $data->pengajuan->id }}/{{ $data->pengajuan->tanggal_romawi }}/{{ date('Y') }}</span>
    
            <table border="0" style="width: 100%">
                <tbody>
                    <tr>
                        <td style="vertical-align: top;width: 100px">Menimbang</td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">Bahwa perlu mengeluarkan surat perintah, guna memenuhi maksud dasar tersebut di bawah.</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;width: 100px">Dasar</td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">
                            {!! $data->dasar_perintah !!}
                            {{-- <ol type="1" style="padding-left: 15px;margin:1px">
                                <li>Surat keputusan Dandim 1416/Muna Nomor Kep/01/I/2020 tentang hukuman disiplin a.n. {{ $data->perintah->nama_lengkap }}, NRP {{ $data->perintah->NRP . ' ' . $data->pembuat->jabatan . ' ' . $data->wilayah_asal}} Rem 143/HO telah melakukan tindakan pelanggaran disiplin, tidak mengindahkan arahan pimpinan untuk membina rumah tangganya;</li>
                                <li>Pasal 8 huruf a dan pasal 9 huruf b Undang Undang Nomor 25 Tahun 2014 dan peraturan perundang undangan lain yang berkaitan.</li>
                            </ol> --}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h2 style="text-align: center; font-weight: bold; font-size: 16px;margin:0;margin-bottom:10px;padding:0;">DIPERINTAHKAN</h2>
            <table border="0" style="width: 100%">
                <tbody>
                    <tr>
                        <td style="vertical-align: top;width: 100px">Kepada</td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">{{ $data->perintah->nama_lengkap }}, NRP {{ $data->perintah->NRP . ' ' . $data->pembuat->jabatan . ' ' . $data->wilayah_asal}} Rem 143/HO</td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;width: 100px">Untuk</td>
                        <td style="vertical-align: top;">:</td>
                        <td style="vertical-align: top;">
                            <ol type="1" style="padding-left: 15px;margin:1px">
                                @foreach(explode(';', $data->deskripsi) as $key => $kegiatan)
                                    <li>{{ $kegiatan }}</li>
                                @endforeach
                                {{-- <li>Melaksanakan hukuman disiplin berupa penahanan ringan selama 14 (empat belas) hari, terhitung mulai tanggal 10 sampai dengan 24 Januari 2020.</li>
                                <li>Melaporkan pelaksanaan kepada Dandim 1416/Muna atas pelaksanaan surat perintah ini.</li>
                                <li>Melaksanakan perintah ini dengan rasa tanggung jawab.</li> --}}
                            </ol>
                        </td>
                    </tr>
                    <tr>
                        <td style="vertical-align: top;">Selesai.</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <div style="text-align: right; margin-bottom: 15px;border-bottom:1px solid black;width:200px;margin-left:auto">
                <span>Dikeluarkan di Raha</span>
                <span>Pada tanggal, {{ $data->pengajuan->tanggal_buat }}</span>
            </div>
            <div style="text-align: right;">
                <span>Komandan {{ $data->wilayah_asal }}</span>
                <img width="150" src="{{ public_path('images/ttd.png') }}" alt="Tanda Tangan Komandan">
                <br><br><br>
                <span style="font-weight: bold;">{{ $data->penerima->nama_lengkap }}</span>
                <span>NRP {{ $data->penerima->NRP }}</span>
            </div>
            <span style="margin-top: 20px;">
                Tembusan:
            </span>
            <ol type="1" style="margin-top: 0 !important;">
                @foreach(explode(';', $data->tembusan) as $key => $kegiatan)
                    <li>{{ $kegiatan }}</li>
                @endforeach
            </ol>
        </div>
    </body>

</html>