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
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" as="font" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Style dari penggunaan template -->
        @stack('style')
    </head>

    <body class="overflow-x-hidden">
        <div class="max-w-[2500px] w-screen h-full relative overflow-hidden">
            <!-- Navbar -->
            <nav class="fixed lg:left-[57px] top-0 left-0 h-full bg-custom-green-500 lg:w-[305px] w-[230px] transform transition-transform duration-300 ease-in-out z-40 -translate-x-full shadow-2xl" id="navbar">
                <div class="container mx-auto flex flex-col h-full mt-12 gap-5">
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
                                <li class="list-navbar hover:bg-custom-green-700 {{ $page == 'create-report' ? 'bg-custom-green-700' : '' }}"><a href="{{ route('report.index') }}" class="block h-full w-full py-4 pl-11 pr-7">Buat Laporan</a></li>
                                <li class="list-navbar hover:bg-custom-green-700 {{ $page == 'show-report' ? 'bg-custom-green-700' : '' }}"><a href="{{ route('report.show-index') }}" class="block h-full w-full py-4 pl-11 pr-7">Lihat & Verifikasi</a></li>
                                <li class="list-navbar hover:bg-custom-green-700 {{ $page == 'show-other-document-report' ? 'bg-custom-green-700' : '' }}"><a href="{{ route('report.show-other-index') }}" class="block h-full w-full py-4 pl-11 pr-7">Kelengkapan Dokumen</a></li>
                            </ul>
                        </li>
                        <!-- Collaps Effect -->
                        @if(auth()->check())
                            @if(auth()->user()->level == 'staf')
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
                            @endif
                        @endif
                        <!-- Collaps Effect -->
                        @if(auth()->check())
                            {{-- @if(auth()->user()->level == 'admin') --}}
                                <li class="menu-collaps cursor-pointer hover:bg-custom-green-600 {{ $page == 'list-anggota' ? 'bg-custom-green-600' : '' }}" data-collaps="anggota">
                                    <a href="javascript:void(0)" class="h-full w-full py-4 px-7 flex items-center justify-between">Anggota
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M12.53 16.28a.75.75 0 0 1-1.06 0l-7.5-7.5a.75.75 0 0 1 1.06-1.06L12 14.69l6.97-6.97a.75.75 0 1 1 1.06 1.06l-7.5 7.5Z" clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <ul id="collaps-anggota" class="text-white hidden">
                                        <li class="list-navbar hover:bg-custom-green-700 {{ $page == 'list-anggota' ? 'bg-custom-green-700' : '' }}"><a href="{{ route('list-anggota.index') }}" class="block h-full w-full py-4 pl-11 pr-7">Daftar Anggota</a></li>
                                    </ul>
                                </li>
                            {{-- @endif --}}
                        @endif
                    </ul>
                    <div class="flex items-start justify-between flex-row flex-100 px-5">
                        <a href="#" class="flex items-center justify-start gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#FFFFFF" class="w-6 h-6 text-white">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm11.378-3.917c-.89-.777-2.366-.777-3.255 0a.75.75 0 0 1-.988-1.129c1.454-1.272 3.776-1.272 5.23 0 1.513 1.324 1.513 3.518 0 4.842a3.75 3.75 0 0 1-.837.552c-.676.328-1.028.774-1.028 1.152v.75a.75.75 0 0 1-1.5 0v-.75c0-1.279 1.06-2.107 1.875-2.502.182-.088.351-.199.503-.331.83-.727.83-1.857 0-2.584ZM12 18a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-white font-bold">Bantuan</span>
                        </a>
                        <a href="javascript:void(0)" onclick="submitForm()" class="flex items-center justify-start gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#FFFFFF" class="w-6 h-6 text-white">
                                <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v9a.75.75 0 0 1-1.5 0V3a.75.75 0 0 1 .75-.75ZM6.166 5.106a.75.75 0 0 1 0 1.06 8.25 8.25 0 1 0 11.668 0 .75.75 0 1 1 1.06-1.06c3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                            </svg>
                            <span class="text-white font-bold">Keluar</span>
                        </a>
                        <form id="logout-form" action="{{ route('post.logout') }}" method="POST" hidden>
                            @csrf
                            <button type="submit">submit</button>
                        </form>
                    </div>
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

                <h1 class="text-lg font-bold text-white lg:ml-[70px]" id="text-navbar">{{ isset($namePage) ? $namePage : '' }}</h1>
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

        <script>
            function submitForm() {
                $('#logout-form').submit();
            }
        </script>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                @if ($errors->any())
                    Swal.fire({
                        icon: 'error',
                        title: 'Terdapat Kesalahan',
                        html: `
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        `,
                        customClass: {
                            confirmButton: 'btn-custom'
                        },
                        buttonsStyling: false
                    });
                @endif
    
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '{{ session('success') }}',
                        customClass: {
                            confirmButton: 'btn-custom'
                        },
                        buttonsStyling: false
                    });
                @endif
    
                @if (session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Terdapat Kesalahan',
                        text: '{{ session('error') }}',
                        customClass: {
                            confirmButton: 'btn-custom'
                        },
                        buttonsStyling: false
                    });
                @endif
            });
        </script>

        <!-- Script dari penggunaan template -->
        @stack('script')
    </body>

</html>
