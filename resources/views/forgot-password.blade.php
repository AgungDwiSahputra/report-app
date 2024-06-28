<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Forgot Password</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <!-- Preload -->
        <link rel="preload" href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" as="font" type="font/ttf" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

        <!-- Style -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    </head>

    <body>
        <div class="mx-auto max-w-screen-2xl">
            <div class="w-screen h-12 bg-custom-green-600"></div>
            <div class="flex items-center justify-center flex-col">
                <img class="w-[152px] h-[auto]" loading="eager" src="{{ asset('images/logo/logo.png') }}" alt="Logo Kesatria Pantang Menyerah">
                <div class="w-4/5 rounded-3xl shadow-custom flex items-center justify-center flex-col mt-10 p-8">
                    <h1 class="text-center font-bold text-3xl mb-12">Atur Ulang Password Anda!</h1>

                    <form action="{{ route('post.forgot-password') }}" method="POST" id="profile-form" class="flex items-center justify-center flex-col gap-2">
                        @csrf
                        <!-- NRP -->
                        <div class="mb-2">
                            <input placeholder="NRP" type="number" name="nrp" id="input-nrp" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                        </div>

                        <button type="submit" class="block w-[180px] h-[50px] text-sm lg:leading-7 leading-9 text-center px-4 py-2 cursor-pointer bg-custom-green-700 text-white font-bold rounded-md shadow-sm hover:bg-[#1d4b13] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3F6137]">
                            Atur Ulang
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </body>

</html>
