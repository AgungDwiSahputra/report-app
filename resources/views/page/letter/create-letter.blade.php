@extends('main')

@push('style')
    <style>
        body {
            background-color: #dddddd;
        }
    </style>

    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.dataTables.min.css">
@endpush

@section('content')
    <div class="lg:w-10/12 w-11/12 bg-white rounded-2xl lg:mt-[100px] lg:ml-[100px] mt-[55px] ml-[10px] mr-6 mb-6">
        <div id="box-heading" class="bg-custom-green-700 rounded-t-2xl py-3 px-5">
            <h1 class="text-2xl text-white font-bold">Buat Form Pengajuan</h1>
        </div>

        <div class="p-8">
            <form action="{{ route('pengajuan.store') }}" method="POST" id="form-input" enctype="multipart/form-data">
                @csrf
                <div id="tab-1" class="tab-content active">
                    <div class="grid grid-cols-2 gap-4">
                        <!-- Dibuat Oleh -->
                        <div class="mb-2">
                            <label for="dibuat_oleh" class="text-black text-sm font-bold">Dibuat Oleh</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                        <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                    </svg>
                                </span>
                                {{-- <select id="dibuat_oleh" name="dibuat_oleh" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                    <option value="">-- PILIH --</option>
                                    <option value="danramil01">Danramil 01</option>
                                    <option value="danramil02">Danramil 02</option>
                                </select> --}}
                                @if(auth()->user()->level != 'admin')
                                    <input readonly value="{{ $user->jabatan }}" placeholder="Dibuat Oleh" type="text" name="dibuat_oleh" id="dibuat_oleh" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                @else
                                    <select id="dibuat_oleh" name="dibuat_oleh" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                        <option value="">-- PILIH --</option>
                                        @if(auth()->user()->level == 'admin')
                                            @foreach($pengguna as $data)
                                                @if($data->level == 'staf')
                                                    <option value="{{ $data->id }}">{{ $data->jabatan }}</option>
                                                @endif
                                            @endforeach
                                        @else
                                            <option value="{{ auth()->user()->id }}">{{ auth()->user()->jabatan }}</option>
                                        @endif
                                    </select>
                                @endif
                            </div>
                        </div>
                        <!-- Diterima Oleh -->
                        <div class="mb-2">
                            <label for="diterima_oleh" class="text-black text-sm font-bold">Diterima Oleh</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                        <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                    </svg>
                                </span>
                                <select id="diterima_oleh" name="diterima_oleh" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                    <option value="">-- PILIH --</option>
                                    @foreach($pengguna as $data)
                                        @if($data->level == "dandim")
                                            <option value="{{ $data->id }}" selected>{{ $data->jabatan }} 1416/Muna</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Jenis Pengajuan -->
                        <div class="mb-2">
                            <label for="jenis_pengajuan" class="text-black text-sm font-bold">Jenis Pengajuan</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
                                        <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                                    </svg>
                                </span>
                                {{-- <select id="jenis_pengajuan" name="jenis_pengajuan" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                    <option value="">-- PILIH --</option>
                                    <option value="pengajuan01">pengajuan Kegiatan 01</option>
                                    <option value="pengajuan02">pengajuan Kegiatan 02</option>
                                </select> --}}
                                <input value="{{ old('jenis_pengajuan') }}" placeholder="Jenis Pengajuan" type="text" name="jenis_pengajuan" id="jenis_pengajuan" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                            </div>
                        </div>
                        <!-- Judul Pengajuan -->
                        <div class="mb-2">
                            <label for="judul_pengajuan" class="text-black text-sm font-bold">Judul Pengajuan</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
                                        <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                                    </svg>
                                </span>
                                <input value="{{ old('judul_pengajuan') }}" placeholder="Judul Pengajuan" type="text" name="judul_pengajuan" id="judul_pengajuan" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-2">
                            <label for="deskripsi" class="text-black text-sm font-bold">Deskripsi</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input {{ old('deskripsi') }} placeholder="deskripsi" type="text" name="deskripsi" id="deskripsi" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                            </div>
                            <span class="text-xs text-red-600">*Point baru gunakan " ; " </span>
                        </div>

                        <!-- Wilayah Asal -->
                        <div class="mb-2">
                            <label for="wilayah_asal" class="text-black text-sm font-bold">Wilayah Asal</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M3 2.25a.75.75 0 0 0 0 1.5v16.5h-.75a.75.75 0 0 0 0 1.5H15v-18a.75.75 0 0 0 0-1.5H3ZM6.75 19.5v-2.25a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75v2.25a.75.75 0 0 1-.75.75h-3a.75.75 0 0 1-.75-.75ZM6 6.75A.75.75 0 0 1 6.75 6h.75a.75.75 0 0 1 0 1.5h-.75A.75.75 0 0 1 6 6.75ZM6.75 9a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM6 12.75a.75.75 0 0 1 .75-.75h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 6a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75Zm-.75 3.75A.75.75 0 0 1 10.5 9h.75a.75.75 0 0 1 0 1.5h-.75a.75.75 0 0 1-.75-.75ZM10.5 12a.75.75 0 0 0 0 1.5h.75a.75.75 0 0 0 0-1.5h-.75ZM16.5 6.75v15h5.25a.75.75 0 0 0 0-1.5H21v-12a.75.75 0 0 0 0-1.5h-4.5Zm1.5 4.5a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Zm.75 2.25a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75v-.008a.75.75 0 0 0-.75-.75h-.008ZM18 17.25a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75h-.008a.75.75 0 0 1-.75-.75v-.008Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <select id="wilayah_asal" name="wilayah_asal" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                    <option value="">-- PILIH --</option>
                                    <option value="Kodim 1416/Muna" selected>Kodim 1416/Muna</option>
                                    {{-- <option value="Koramil 1416-01/Katobu">Koramil 1416-01/Katobu</option>
                                    <option value="Koramil 1416-02/Tikep">Koramil 1416-02/Tikep</option>
                                    <option value="Koramil 1416-03/Tongkuno">Koramil 1416-03/Tongkuno</option>
                                    <option value="Koramil 1416-04/Kabawo">Koramil 1416-04/Kabawo</option>
                                    <option value="Koramil 1416-05/Maligano">Koramil 1416-05/Maligano</option>
                                    <option value="Koramil 1416-06/Lawa">Koramil 1416-06/Lawa</option>
                                    <option value="Koramil 1416-07/Tampo">Koramil 1416-07/Tampo</option> --}}
                                </select>
                            </div>
                        </div>
                        <!-- Tanggal Dibuat -->
                        <div class="mb-2">
                            <label for="tanggal_dibuat" class="text-black text-sm font-bold">Tanggal Dibuat</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path d="M12.75 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM7.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM8.25 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM9.75 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM10.5 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM12.75 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM14.25 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 17.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 15.75a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5ZM15 12.75a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM16.5 13.5a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" />
                                        <path fill-rule="evenodd" d="M6.75 2.25A.75.75 0 0 1 7.5 3v1.5h9V3A.75.75 0 0 1 18 3v1.5h.75a3 3 0 0 1 3 3v11.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V7.5a3 3 0 0 1 3-3H6V3a.75.75 0 0 1 .75-.75Zm13.5 9a1.5 1.5 0 0 0-1.5-1.5H5.25a1.5 1.5 0 0 0-1.5 1.5v7.5a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5v-7.5Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input readonly placeholder="Tanggal Dibuat" type="date" name="tanggal_dibuat" id="tanggal_dibuat" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                            </div>
                        </div>

                        <!-- Diperintahkan Kepada -->
                        <div class="mb-2">
                            <label for="diperintahkan_kepada" class="text-black text-sm font-bold">Diperintahkan Kepada</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M6 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3H6Zm1.5 1.5a.75.75 0 0 0-.75.75V16.5a.75.75 0 0 0 1.085.67L12 15.089l4.165 2.083a.75.75 0 0 0 1.085-.671V5.25a.75.75 0 0 0-.75-.75h-9Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <select id="diperintahkan_kepada" name="diperintahkan_kepada" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                    <option value="">-- PILIH --</option>
                                    @foreach($penggunaPerintah as $data)
                                        @if($data->level != 'admin' && $data->level != 'dandim')
                                            <option value="{{ $data->id }}">{{ $data->nama_lengkap }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                {{-- <input value="{{ old('diperintahkan_kepada') }}" placeholder="Diperintahkan Kepada" type="text" name="diperintahkan_kepada" id="diperintahkan_kepada" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md"> --}}
                            </div>
                        </div>

                        <!-- Tembusan -->
                        <div class="mb-2">
                            <label for="tembusan" class="text-black text-sm font-bold">Tembusan</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input value="{{ old('tembusan') }}" placeholder="Tembusan" type="text" name="tembusan" id="tembusan" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                            </div>
                            <span class="text-xs text-red-600">*Point baru gunakan " ; " </span>
                        </div>
                        <!-- Dasar Perintah -->
                        <div class="mb-2">
                            <label for="editor" class="text-black text-sm font-bold">Dasar Perintah</label>
                            <textarea rows="5" name="dasar_perintah" id="editor" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                {{ old('dasar_perintah') }}
                            </textarea>
                        </div>
                    </div>

                    <div class="mt-9">
                        <!-- Button Tambah Lampiran -->
                        <button type="submit" class="block w-[180px] h-[50px] text-sm lg:leading-7 leading-9 text-center btn-custom ml-auto">
                            Simpan
                        </button>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script type="text/javascript">
        // Tab Fitur
        $(document).ready(function() {
            $('.tab-link').click(function() {
                var tab_id = $(this).attr('data-tab');

                $('.tab-link').removeClass('active');
                $('.tab-content').addClass('hidden').removeClass('active');

                $(this).addClass('active');
                $("#" + tab_id).removeClass('hidden').addClass('active');
            });
        });
    </script>

    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', (event) => {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_dibuat').value = today;
        });
    </script>

    <script type="text/javascript">
        let fileIndex = 1;

        function updateFileName(index) {
            // Function untuk update nama file pada inputan
            const input = document.getElementById('file-' + index);
            const fileNameSpan = document.getElementById('file-name-' + index);
            fileNameSpan.textContent = input.files.length > 0 ? input.files[0].name : 'Tidak ada file yang dipilih';
        }

        $(document).ready(function() {
            // Untuk Menambahkan inputan file
            $('#add-file-button').click(function() {
                const newFileInputWrapper = $('<div class="mb-4 flex items-center file-input-wrapper"></div>');

                const newLabel = $('<label></label>')
                    .attr('for', 'file-' + fileIndex)
                    .addClass('file-label')
                    .text('Unggah File');

                const newInput = $('<input>')
                    .attr('type', 'file')
                    .attr('id', 'file-' + fileIndex)
                    .attr('name', 'lampiran[]')
                    .addClass('file-input')
                    .attr('onchange', 'updateFileName(' + fileIndex + ')');

                const newFileNameSpan = $('<span></span>')
                    .attr('id', 'file-name-' + fileIndex)
                    .addClass('file-name')
                    .text('Tidak ada file yang dipilih');

                newFileInputWrapper.append(newLabel, newInput, newFileNameSpan);
                $('#file-upload-form').append(newFileInputWrapper);

                fileIndex++;
            });
        });
    </script>

    <script type="text/javascript">
        function prossesUploadLampiran() {
            Swal.fire({
                title: "Berhasil Diunggah",
                icon: "success",
                customClass: {
                    confirmButton: 'btn-custom'
                },
                buttonsStyling: false
            });
        }
    </script>
    <!-- CKEditor 5 -->
    <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
    <script>
        CKEDITOR.ClassicEditor.create(document.getElementById("editor"), {
            toolbar: {
                items: [
                    // 'exportPDF','exportWord', '|',
                    // 'findAndReplace', 'selectAll', '|',
                    // 'heading', '|',
                    'bold', 'italic', 'strikethrough', 'underline', 
                    // 'code', 
                    'subscript', 'superscript', 'removeFormat', '|',
                    // 'bulletedList', 
                    'numberedList', 
                    // 'todoList', '|',
                    // 'outdent', 'indent', '|',
                    'undo', 'redo',
                    '-',
                    'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
                    'alignment', '|',
                    // 'link', 'uploadImage', 'blockQuote', 'insertTable', 'mediaEmbed', 'codeBlock', 'htmlEmbed', '|',
                    // 'specialCharacters', 'horizontalLine', 'pageBreak', '|',
                    // 'textPartLanguage', '|',
                    // 'sourceEditing'
                ],
                shouldNotGroupWhenFull: true
            },
            list: {
                properties: {
                    styles: true,
                    startIndex: true,
                    reversed: true
                }
            },
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            placeholder: 'Description',
            fontFamily: {
                options: [
                    'Montserrat, sans-serif',
                    'Arial, Helvetica, sans-serif',
                    'Courier New, Courier, monospace',
                    'Georgia, serif',
                    'Lucida Sans Unicode, Lucida Grande, sans-serif',
                    'Tahoma, Geneva, sans-serif',
                    'Times New Roman, Times, serif',
                    'Trebuchet MS, Helvetica, sans-serif',
                    'Verdana, Geneva, sans-serif'
                ],
                supportAllValues: true
            },
            fontSize: {
                options: [ '12px', '14px', '16px', '18px', '20px', '22px', '24px' ],
                supportAllValues: true
            },
            htmlSupport: {
                allow: [
                    {
                        name: /.*/,
                        attributes: true,
                        classes: true,
                        styles: true
                    }
                ]
            },
            htmlEmbed: {
                showPreviews: true
            },
            link: {
                decorators: {
                    addTargetToExternalLinks: true,
                    defaultProtocol: 'https://',
                    toggleDownloadable: {
                        mode: 'manual',
                        label: 'Downloadable',
                        attributes: {
                            download: 'file'
                        }
                    }
                }
            },
            mention: {
                feeds: [
                    {
                        marker: '@',
                        feed: [
                            '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                            '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                            '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                            '@sugar', '@sweet', '@topping', '@wafer'
                        ],
                        minimumCharacters: 1
                    }
                ]
            },
            removePlugins: [
                'AIAssistant',
                'CKBox',
                'CKFinder',
                'EasyImage',
                'MultiLevelList',
                'RealTimeCollaborativeComments',
                'RealTimeCollaborativeTrackChanges',
                'RealTimeCollaborativeRevisionHistory',
                'PresenceList',
                'Comments',
                'TrackChanges',
                'TrackChangesData',
                'RevisionHistory',
                'Pagination',
                'WProofreader',
                'MathType',
                'SlashCommand',
                'Template',
                'DocumentOutline',
                'FormatPainter',
                'TableOfContents',
                'PasteFromOfficeEnhanced',
                'CaseChange'
            ]
        });
    </script>
@endpush
