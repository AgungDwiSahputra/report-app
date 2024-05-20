@extends('main')

@push('style') @endpush

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
            <form action="" method="POST" id="profile-form" class="md:grid lg:grid-cols-3 md:grid-cols-2 md:gap-4">
                <!-- Username -->
                <div class="mb-2">
                    <label for="input-username" class="text-black text-sm font-bold">Username</label>
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>                              
                        </span>
                        <input placeholder="Username" type="text" name="username" id="input-username" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                    </div>
                </div>

                <!-- Nama Lengkap -->
                <div class="mb-2">
                    <label for="input-nama" class="text-black text-sm font-bold">Nama Lengkap</label>
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M4.5 3.75a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-15Zm4.125 3a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Zm-3.873 8.703a4.126 4.126 0 0 1 7.746 0 .75.75 0 0 1-.351.92 7.47 7.47 0 0 1-3.522.877 7.47 7.47 0 0 1-3.522-.877.75.75 0 0 1-.351-.92ZM15 8.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15ZM14.25 12a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H15a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15Z" clip-rule="evenodd" />
                            </svg>                                                            
                        </span>
                        <input placeholder="Nama Lengkap" type="text" name="nama" id="input-nama" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                    </div>
                </div>

                <!-- Nomor Telepon -->
                <div class="mb-2">
                    <label for="input-nohp" class="text-black text-sm font-bold">No. Telepon</label>
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M1.5 4.5a3 3 0 0 1 3-3h1.372c.86 0 1.61.586 1.819 1.42l1.105 4.423a1.875 1.875 0 0 1-.694 1.955l-1.293.97c-.135.101-.164.249-.126.352a11.285 11.285 0 0 0 6.697 6.697c.103.038.25.009.352-.126l.97-1.293a1.875 1.875 0 0 1 1.955-.694l4.423 1.105c.834.209 1.42.959 1.42 1.82V19.5a3 3 0 0 1-3 3h-2.25C8.552 22.5 1.5 15.448 1.5 6.75V4.5Z" clip-rule="evenodd" />
                            </svg>                                                                                          
                        </span>
                        <input placeholder="0822xxxxxxxx" type="number" name="nohp" id="input-nohp" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                    </div>
                </div>

                <!-- NPWP -->
                <div class="mb-2">
                    <label for="input-npwp" class="text-black text-sm font-bold">NPWP</label>
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M4.5 3.75a3 3 0 0 0-3 3v.75h21v-.75a3 3 0 0 0-3-3h-15Z" />
                                <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-7.5Zm-18 3.75a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
                            </svg>                                                          
                        </span>
                        <input placeholder="9012xxxxxxxxxxx" type="number" name="npwp" id="input-npwp" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                    </div>
                </div>

                <!-- NRP -->
                <div class="mb-2">
                    <label for="input-nrp" class="text-black text-sm font-bold">NRP</label>
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M4.5 3.75a3 3 0 0 0-3 3v.75h21v-.75a3 3 0 0 0-3-3h-15Z" />
                                <path fill-rule="evenodd" d="M22.5 9.75h-21v7.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3v-7.5Zm-18 3.75a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3a.75.75 0 0 0 0-1.5h-3Z" clip-rule="evenodd" />
                            </svg>                                                                                         
                        </span>
                        <input placeholder="234xxxxxxxxxx" type="number" name="nrp" id="input-nrp" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                    </div>
                </div>

                <!-- Tanggal Lahir -->
                <div class="mb-2">
                    <label for="input-tanggal-lahir" class="text-black text-sm font-bold">Tanggal Lahir</label>
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                                <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                            </svg>                                                                                                                      
                        </span>
                        <input placeholder="Tanggal Lahir" type="date" name="tanggal-lahir" id="input-tanggal-lahir" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                    </div>
                </div>

                <!-- Jabatan -->
                <div class="mb-2">
                    <label for="input-jabatan" class="text-black text-sm font-bold">Jabatan</label>
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                            </svg>                                                            
                        </span>
                        <input placeholder="Danramil" type="text" name="jabatan" id="input-jabatan" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                    </div>
                </div>

                <!-- Penempatan -->
                <div class="mb-2">
                    <label for="input-penempatan" class="text-black text-sm font-bold">Penempatan</label>
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M11.47 3.841a.75.75 0 0 1 1.06 0l8.69 8.69a.75.75 0 1 0 1.06-1.061l-8.689-8.69a2.25 2.25 0 0 0-3.182 0l-8.69 8.69a.75.75 0 1 0 1.061 1.06l8.69-8.689Z" />
                                <path d="m12 5.432 8.159 8.159c.03.03.06.058.091.086v6.198c0 1.035-.84 1.875-1.875 1.875H15a.75.75 0 0 1-.75-.75v-4.5a.75.75 0 0 0-.75-.75h-3a.75.75 0 0 0-.75.75V21a.75.75 0 0 1-.75.75H5.625a1.875 1.875 0 0 1-1.875-1.875v-6.198a2.29 2.29 0 0 0 .091-.086L12 5.432Z" />
                            </svg>                                                            
                        </span>
                        <input placeholder="Koramil Tikep" type="text" name="penempatan" id="input-penempatan" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                    </div>
                </div>

                <!-- Email -->
                <div class="mb-2">
                    <label for="input-email" class="text-black text-sm font-bold">Email</label>
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path d="M1.5 8.67v8.58a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V8.67l-8.928 5.493a3 3 0 0 1-3.144 0L1.5 8.67Z" />
                                <path d="M22.5 6.908V6.75a3 3 0 0 0-3-3h-15a3 3 0 0 0-3 3v.158l9.714 5.978a1.5 1.5 0 0 0 1.572 0L22.5 6.908Z" />
                            </svg>                                                            
                        </span>
                        <input placeholder="Email" type="mail" name="email" id="input-email" class="w-full px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                    </div>
                </div>

                
                <div class="flex items-center justify-center gap-5 lg:col-span-3 md:col-span-2 mt-9">
                    <!-- Button Ganti Kata Sandi -->
                    <a type="button" class="block ml-auto w-[180px] h-[50px] text-sm lg:leading-7 leading-9 text-center px-4 py-2 cursor-pointer bg-white text-custom-green-600 hover:text-white border border-custom-green-600 font-bold rounded-md shadow-sm hover:bg-custom-green-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3F6137]">
                        Perbarui Profile
                    </a>
                    <!-- Button Ganti Kata Sandi -->
                    <a type="button" class="block mr-auto w-[180px] h-[50px] text-sm lg:leading-7 leading-9 text-center px-4 py-2 cursor-pointer bg-custom-green-700 text-white font-bold rounded-md shadow-sm hover:bg-[#1d4b13] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3F6137]">
                        Ganti Kata Sandi
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script') @endpush