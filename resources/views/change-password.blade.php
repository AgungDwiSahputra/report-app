@extends('main')

@push('style')
@endpush

@section('content')
    <div class="w-full h-full lg:pt-[85px] lg:pl-[85px] lg:pr-6 lg:pb-6 p-5 pt-14">
        <div class="grid grid-cols-1 mb-8">
            <div class="flex items-center justify-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="lg:w-[286px] lg:h-[286px] w-52 h-52">
                    <path fill-rule="evenodd" d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" />
                </svg>
                {{-- <img class="rounded-full w-[286px] h-[286px]" src="" alt="Profile Foto"> --}}
            </div>
        </div>
        <div>
            <form action="" method="POST" id="profile-form" class="flex items-center justify-center flex-col">
                <!-- Password Old -->
                <div class="mb-2">
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <input placeholder="Masukan Kata Sandi Lama" type="text" name="password-old" id="password-old" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                    </div>
                </div>

                <!-- New Password -->
                <div class="mb-2">
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <input placeholder="Masukan Kata Sandi Baru" type="password" name="new-password" id="new-password" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="mb-2">
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <input placeholder="Konfirmasi Kata Sandi" type="password" name="confirm-password" id="confirm-password" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                    </div>
                </div>

                <div class="flex items-center justify-center gap-5 lg:col-span-3 md:col-span-2 mt-9">
                    <!-- Button Ganti Kata Sandi -->
                    <button type="submit" class="block mr-auto w-[180px] h-[50px] text-sm lg:leading-7 leading-9 text-center px-4 py-2 cursor-pointer bg-custom-green-700 text-white font-bold rounded-md shadow-sm hover:bg-[#1d4b13] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3F6137]">
                        Ubah Kata Sandi
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
@endpush
