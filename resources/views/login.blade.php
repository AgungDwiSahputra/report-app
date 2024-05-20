<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Login SIKOM1416</title>

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
        <div class="container mx-auto">
            <div class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1">
                <div class="flex items-center justify-center flex-col h-screen bg-custom-green-500">
                    <h1 class="text-3xl font-bold text-white mb-5 text-center">Welcome <br>to SIKOM1416 !</h1>
                    <div class="lg:w-[439px] sm:w-[90%] h-[auto] bg-white rounded-2xl py-14 px-8">
                        <form action="" method="POST" id="login-form">
                            <!-- Input Text -->
                            <div class="mb-2">
                                <input placeholder="Username" type="text" name="username" id="text-input" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                            </div>
                
                            <!-- Input Password -->
                            <div class="mb-2">
                                <input placeholder="Password" type="password" name="password" id="password-input" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                            </div>
                            
                            <div class="mb-14 flex items-center justify-between">
                                <div>
                                    <!-- Ingat Saya ? -->
                                    <input type="checkbox" name="remember_me" id="remember_me" class="bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500">
                                    <label for="remember_me" class="text-gray-700 text-sm">Ingat Saya?</label>
                                </div>
                                <div>
                                    <!-- Lupa Kata Sandi -->
                                    <a href="#" class="text-gray-700 text-sm hover:text-blue-600">Lupa Kata Sandi</a>
                                </div>
                            </div>
                            
                            <!-- Button Action Masuk -->
                            <button type="submit" class="block mx-auto w-[180px] h-[50px] px-4 py-2 bg-[#3F6137] text-white rounded-md shadow-sm hover:bg-[#346c27] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3F6137]">
                                Masuk
                            </button>
                        </form>
                    </div>
                </div>
                <div class="lg:flex md:flex sm:hidden items-center justify-center lg:h-screen md:h-screen sm:h-0 lg:p-52 md:p-28 sm:p-0">
                    <img class="w-[100%] h-[auto]" loading="eager" src="{{ asset('images/logo/logo.png') }}" alt="Logo Kesatria Pantang Menyerah">
                </div>
            </div>
        </div>
    </body>
</html>
