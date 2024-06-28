@extends('main')

@push('style')
@endpush

@section('content')
    <div class="w-full h-full lg:pt-[85px] lg:pl-[85px] lg:pr-6 lg:pb-6 p-5 pt-14">
        <div class="grid grid-cols-1 mb-8">
            <div class="relative hover-effect rounded-full mx-auto">
                <img id="user-image" src="{{ Storage::url('images/profile/' . $pengguna->foto_profil) }}" alt="User Icon" class="lg:w-[286px] lg:h-[286px] w-52 h-52 rounded-full object-cover">
            </div>
        </div>
        <div>
            <form action="{{ route('post.change-password', $pengguna->id) }}" method="POST" id="profile-form" class="flex items-center justify-center flex-col">
                @csrf

                @if(auth()->user()->level != 'admin')
                    <!-- Password Old -->
                    <div class="mb-2">
                        <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                            <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                <!-- SVG Ikon -->
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                    <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                                </svg>
                            </span>
                            <input value="{{ old('password-old') }}" placeholder="Masukan Kata Sandi Lama" type="text" name="password-old" id="password-old" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                        </div>
                    </div>
                @endif

                <!-- New Password -->
                <div class="mb-2">
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <input value="{{ old('new-password') }}" placeholder="Masukan Kata Sandi Baru" type="password" name="new-password" id="new-password" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
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
                        <input value="{{ old('new-password_confirmation') }}" placeholder="Konfirmasi Kata Sandi" type="password" name="new-password_confirmation" id="new-password_confirmation" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
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
