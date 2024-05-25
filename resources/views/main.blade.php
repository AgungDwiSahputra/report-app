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

    <body>
        <div class="max-w-[2500px] w-screen h-full relative overflow-hidden">
            <!-- Navbar -->
            <nav class="fixed lg:left-[57px] top-0 left-0 h-full bg-custom-green-500 lg:w-[305px] w-[230px] transform transition-transform duration-300 ease-in-out z-40 -translate-x-full shadow-2xl" id="navbar">
                <div class="container mx-auto flex flex-col h-full mt-12">
                    <img class="w-[60%] h-[auto] p-7 mx-auto" loading="lazy" src="{{ asset('images/logo/logo.png') }}" alt="Logo Kesatria Pantang Menyerah">
                    <ul class="text-white h-full overflow-y-auto flex-1">
                        <li class="list-navbar hover:bg-custom-green-600 {{ $page == 'profile' ? 'bg-custom-green-600' : '' }}"><a href="{{ route('page.profile') }}" class="block h-full w-full py-4 px-7">Profil</a></li>
                        <!-- Collaps Effect -->
                        <li class="menu-collaps cursor-pointer hover:bg-custom-green-600 {{ $page == 'create-report' || $page == 'show-report' || $page == 'show-other-document-report' ? 'bg-custom-green-600' : '' }}" data-collaps="laporan">
                            <a href="javascript:void(0)" class="h-full w-full py-4 px-7 flex items-center justify-between">Laporan
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <ul id="collaps-laporan" class="text-white hidden">
                                <li class="list-navbar hover:bg-custom-green-700 {{ $page == 'create-report' ? 'bg-custom-green-700' : '' }}"><a href="{{ route('page.create-report') }}" class="block h-full w-full py-4 pl-11 pr-7">Buat Laporan</a></li>
                                <li class="list-navbar hover:bg-custom-green-700 {{ $page == 'show-report' ? 'bg-custom-green-700' : '' }}"><a href="{{ route('page.show-report') }}" class="block h-full w-full py-4 pl-11 pr-7">Lihat & Verifikasi</a></li>
                                <li class="list-navbar hover:bg-custom-green-700 {{ $page == 'show-other-document-report' ? 'bg-custom-green-700' : '' }}"><a href="{{ route('page.show-other-document-report') }}" class="block h-full w-full py-4 pl-11 pr-7">Kelengkapan Dokumen</a></li>
                            </ul>
                        </li>
                        <!-- Collaps Effect -->
                        <li class="menu-collaps cursor-pointer hover:bg-custom-green-600 {{ $page == 'create-letter' || $page == 'show-letter' || $page == 'show-other-document-letter' ? 'bg-custom-green-600' : '' }}" data-collaps="surat-pengajuan">
                            <a href="javascript:void(0)" class="h-full w-full py-4 px-7 flex items-center justify-between">Surat Pengajuan
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <ul id="collaps-surat-pengajuan" class="text-white hidden">
                                <li class="list-navbar hover:bg-custom-green-700 {{ $page == 'create-letter' ? 'bg-custom-green-700' : '' }}"><a href="{{ route('page.create-letter') }}" class="block h-full w-full py-4 pl-11 pr-7">Buat Surat</a></li>
                                <li class="list-navbar hover:bg-custom-green-700 {{ $page == 'show-letter' ? 'bg-custom-green-700' : '' }}"><a href="{{ route('page.show-letter') }}" class="block h-full w-full py-4 pl-11 pr-7">Lihat & Verifikasi</a></li>
                                <li class="list-navbar hover:bg-custom-green-700 {{ $page == 'show-other-document-letter' ? 'bg-custom-green-700' : '' }}"><a href="{{ route('page.show-other-document-letter') }}" class="block h-full w-full py-4 pl-11 pr-7">Kelengkapan Dokumen</a></li>
                            </ul>
                        </li>
                        <!-- Collaps Effect -->
                        <li class="menu-collaps cursor-pointer hover:bg-custom-green-600 {{ $page == 'list-anggota' ? 'bg-custom-green-600' : '' }}" data-collaps="anggota">
                            <a href="javascript:void(0)" class="h-full w-full py-4 px-7 flex items-center justify-between">Anggota
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                                </svg>
                            </a>
                            <ul id="collaps-anggota" class="text-white hidden">
                                <li class="list-navbar hover:bg-custom-green-700 {{ $page == 'list-anggota' ? 'bg-custom-green-700' : '' }}"><a href="{{ route('page.list-anggota') }}" class="block h-full w-full py-4 pl-11 pr-7">Daftar Anggota</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <div class="fixed top-0 left-0 w-[57px] h-full bg-custom-green-700 lg:flex hidden items-center flex-col pt-3 z-50">
                <button id="menu-toggle" class="menu-toggle bg-transparent lg:block hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>
            </div>
            <div class="z-40 fixed top-0 left-0 w-full lg:h-[57px] h-[45px] bg-custom-green-700 flex items-center justify-start gap-5 lg:gap-0 lg:p-0 pl-5">
                <button id="menu-toggle" class="menu-toggle lg:hidden block bg-transparent">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="#FFFFFF" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
                    </svg>
                </button>

                <h1 class="text-lg font-bold text-white lg:ml-[70px]" id="text-navbar">{{ $namePage }}</h1>
            </div>

            {{-- Content --}}
            @yield('content')
            {{-- End Content --}}
            <!-- End Main Content -->
        </div>

        <!-- Jquery -->
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

        <!-- Script -->
        <script src="{{ asset('js/app.js') }}"></script>

        <!-- Script dari penggunaan template -->
        @stack('script')
    </body>

</html>
