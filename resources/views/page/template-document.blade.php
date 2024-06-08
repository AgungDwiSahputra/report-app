
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ isset($title) ? $title : 'SIKOM1416' }}</title>

        <link rel="shortcut icon" href="{{ asset('images/logo/logo.png') }}" type="image/x-icon">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- Preload -->
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" as="font" type="font/ttf" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Style dari penggunaan template -->
        @stack('style')
    </head>

    <body class="overflow-x-hidden">
        <div class="text-center mb-5">
            <h1>KOMANDO DISTRIK MILITER 1416/MUNA</h1>
            <h2>KOMANDO RAYON MILITER 1416-06/LAWA</h2>
            <h3>LAPORAN SITUASI HARIAN</h3>
            <p>Nomor: RU/LSH/2024/Babinsa Koramil 1416-06/LAWA</p>
            <p>PEMANTAUAN WILAYAH KORAMIL 1416-06/LAWA</p>
            <p>TWP. 15.00 WIB. 19 MEI 2024</p>
        </div>

        <div class="mb-5">
            <p>Yth. Dandim 1416/Muna</p>
            <p>Dari Danramil 1416-06/Lawa</p>
        </div>

        <div class="mb-5">
            <p>Ijin melaporkan</p>
            <p>Perkembangan Situasi Wilayah Koramil 1416-06/Lawa pada Hari Senin, 19 Mei 2024, Pukul 15.00 WITA dalam keadaan aman terkendali.</p>
            <p>1. Hal-hal menonjol : {{ $situasi }}</p>
            <p>2. Cuaca : {{ $cuaca }}</p>
            <p>3. Jumlah Personil : {{ $jumlah_personil }}</p>
            <p>4. Personil Hadir : {{ $personil_hadir }}</p>
            <p>5. Personil Kurang : {{ $personil_kurang }}</p>
        </div>

        <div class="mb-5">
            <p>Keterangan</p>
            <p>1. Dinas Dalam</p>
            <p>2. Dinas Luar</p>
            <p>3. Piket Koramil</p>
            <p>4. Materil</p>
        </div>

        <div class="mb-5">
            <p>Kegiatan Hari Ini</p>
            <p>1. Xxx</p>
            <p>2. Xxx</p>
            <p>3. Xxx</p>
        </div>

        <div class="mb-5">
            <p>Demikian kami laporkan.</p>
            <p>Dokumen terlampir.</p>
        </div>

        <div class="mb-5">
            <p>Tembusan</p>
            <p>1. Xxx</p>
            <p>2. Xxx</p>
            <p>3. Xxx</p>
        </div>

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <!-- Script -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Script dari penggunaan template -->
        @stack('script')
    </body>

</html>