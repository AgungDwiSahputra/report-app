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
            <h1 class="text-2xl text-white font-bold">Buat Form Laporan</h1>
        </div>

        <div class="p-8">
            <form action="{{ route('report.store') }}" method="POST" id="form-input" enctype="multipart/form-data">
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
                                <input readonly value="{{ $user->jabatan }}" placeholder="Dibuat Oleh" type="text" name="dibuat_oleh" id="dibuat_oleh" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
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
                                        @if($user->level == 'babinsa' && $data->level == 'danramil')
                                            <option value="{{ $data->id }}">{{ $data->jabatan }}</option>
                                        @elseif($user->level == 'danramil' && $data->level == 'dandim')
                                            <option value="{{ $data->id }}">{{ $data->jabatan }}</option>
                                        @else
                                            {{-- <option value="{{ $data->id }}">{{ $data->nama_lengkap }}</option> --}}
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Jenis Laporan -->
                        <div class="mb-2">
                            <label for="jenis_laporan" class="text-black text-sm font-bold">Jenis Laporan</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
                                        <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                                    </svg>
                                </span>
                                {{-- <select id="jenis_laporan" name="jenis_laporan" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                    <option value="">-- PILIH --</option>
                                    <option value="laporan01">Laporan Kegiatan 01</option>
                                    <option value="laporan02">Laporan Kegiatan 02</option>
                                </select> --}}
                                <input value="{{ old('jenis_laporan') }}" placeholder="Jenis laporan" type="text" name="jenis_laporan" id="jenis_laporan" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                            </div>
                        </div>
                        <!-- Judul Laporan -->
                        <div class="mb-2">
                            <label for="judul_laporan" class="text-black text-sm font-bold">Judul Laporan</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
                                        <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                                    </svg>
                                </span>
                                <input value="{{ old('judul_laporan') }}" placeholder="Judul Laporan" type="text" name="judul_laporan" id="judul_laporan" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                            </div>
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
                                    <option value="Koramil 1416-01/Katobu">Koramil 1416-01/Katobu</option>
                                    <option value="Koramil 1416-02/Tikep">Koramil 1416-02/Tikep</option>
                                    <option value="Koramil 1416-03/Tongkuno">Koramil 1416-03/Tongkuno</option>
                                    <option value="Koramil 1416-04/Kabawo">Koramil 1416-04/Kabawo</option>
                                    <option value="Koramil 1416-05/Maligano">Koramil 1416-05/Maligano</option>
                                    <option value="Koramil 1416-06/Lawa">Koramil 1416-06/Lawa</option>
                                    <option value="Koramil 1416-07/Tampo">Koramil 1416-07/Tampo</option>
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

                        <!-- Hal-Hal Menonjol -->
                        <div class="mb-2">
                            <label for="hal_menonjol" class="text-black text-sm font-bold">Hal-Hal Menonjol</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M6 3a3 3 0 0 0-3 3v12a3 3 0 0 0 3 3h12a3 3 0 0 0 3-3V6a3 3 0 0 0-3-3H6Zm1.5 1.5a.75.75 0 0 0-.75.75V16.5a.75.75 0 0 0 1.085.67L12 15.089l4.165 2.083a.75.75 0 0 0 1.085-.671V5.25a.75.75 0 0 0-.75-.75h-9Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <input value="{{ old('hal_menonjol') }}" placeholder="Hal-Hal Menonjol" type="text" name="hal_menonjol" id="hal_menonjol" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                            </div>
                        </div>
                        <!-- Deskripsi -->
                        <div class="mb-2">
                            <label for="deskripsi" class="text-black text-sm font-bold">Deskripsi Kagiatan</label>
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
                        <!-- Cuaca -->
                        <div class="mb-2">
                            <label for="cuaca" class="text-black text-sm font-bold">Cuaca</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M4.5 9.75a6 6 0 0 1 11.573-2.226 3.75 3.75 0 0 1 4.133 4.303A4.5 4.5 0 0 1 18 20.25H6.75a5.25 5.25 0 0 1-2.23-10.004 6.072 6.072 0 0 1-.02-.496Z" clip-rule="evenodd" />
                                    </svg>
                                </span>
                                <select id="cuaca" name="cuaca" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                    <option value="">-- PILIH --</option>
                                    <option value="hujan">Hujan</option>
                                    <option value="gerimis">Gerimis</option>
                                    <option value="mendung">Mendung</option>
                                    <option value="cerah-berawan">Cerah Berawan</option>
                                    <option value="cerah-tidak-berawan">Cerah Tidak Berawan</option>
                                </select>
                            </div>
                        </div>

                        @if(auth()->user()->level != 'babinsa')
                            <!-- Jumlah Personil -->
                            <div class="mb-2">
                                <label for="jml_personil" class="text-black text-sm font-bold">Jumlah Personil</label>
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                    <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                        <!-- SVG Ikon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                            <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                        </svg>
                                    </span>
                                    <input {{ old('jml_personil') }} placeholder="Jumlah Personil" type="number" name="jml_personil" id="jml_personil" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                </div>
                            </div>
                            <!-- Personil Hadir -->
                            <div class="mb-2">
                                <label for="personil_hadir" class="text-black text-sm font-bold">Personil Hadir</label>
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                    <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                        <!-- SVG Ikon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                            <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                        </svg>
                                    </span>
                                    <input value="{{ old('personil_hadir') }}" placeholder="Personil Hadir" type="number" name="personil_hadir" id="personil_hadir" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                </div>
                            </div>

                            <!-- Personil Kurang -->
                            <div class="mb-2">
                                <label for="personil_kurang" class="text-black text-sm font-bold">Personil Kurang</label>
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                    <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                        <!-- SVG Ikon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                            <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                        </svg>
                                    </span>
                                    <input value="{{ old('personil_kurang') }}" placeholder="Personil Kurang" type="number" name="personil_kurang" id="personil_kurang" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                </div>
                            </div>
                            <!-- Dinas Dalam -->
                            <div class="mb-2">
                                <label for="dinas_dalam" class="text-black text-sm font-bold">Dinas Dalam</label>
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                    <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                        <!-- SVG Ikon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                            <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                        </svg>
                                    </span>
                                    <input value="{{ old('dinas_dalam') }}" placeholder="Dinas Dalam" type="number" name="dinas_dalam" id="dinas_dalam" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                </div>
                            </div>

                            <!-- Dinas Luar -->
                            <div class="mb-2">
                                <label for="dinas_luar" class="text-black text-sm font-bold">Dinas Luar</label>
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                    <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                        <!-- SVG Ikon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                            <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                        </svg>
                                    </span>
                                    <input value="{{ old('dinas_luar') }}" placeholder="Dinas Luar" type="number" name="dinas_luar" id="dinas_luar" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                </div>
                            </div>
                            <!-- Piket Pos -->
                            <div class="mb-2">
                                <label for="piket_pos" class="text-black text-sm font-bold">Piket Pos</label>
                                <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                    <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                        <!-- SVG Ikon -->
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path fill-rule="evenodd" d="M8.25 6.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM15.75 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM2.25 9.75a3 3 0 1 1 6 0 3 3 0 0 1-6 0ZM6.31 15.117A6.745 6.745 0 0 1 12 12a6.745 6.745 0 0 1 6.709 7.498.75.75 0 0 1-.372.568A12.696 12.696 0 0 1 12 21.75c-2.305 0-4.47-.612-6.337-1.684a.75.75 0 0 1-.372-.568 6.787 6.787 0 0 1 1.019-4.38Z" clip-rule="evenodd" />
                                            <path d="M5.082 14.254a8.287 8.287 0 0 0-1.308 5.135 9.687 9.687 0 0 1-1.764-.44l-.115-.04a.563.563 0 0 1-.373-.487l-.01-.121a3.75 3.75 0 0 1 3.57-4.047ZM20.226 19.389a8.287 8.287 0 0 0-1.308-5.135 3.75 3.75 0 0 1 3.57 4.047l-.01.121a.563.563 0 0 1-.373.486l-.115.04c-.567.2-1.156.349-1.764.441Z" />
                                        </svg>
                                    </span>
                                    <input {{ old('piket_pos') }} placeholder="Piket Pos" type="number" name="piket_pos" id="piket_pos" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                </div>
                            </div>
                        @endif

                        <!-- Materil -->
                        <div class="mb-2">
                            <label for="materil" class="text-black text-sm font-bold">Materil</label>
                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                                <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                                    <!-- SVG Ikon -->
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M5.625 1.5c-1.036 0-1.875.84-1.875 1.875v17.25c0 1.035.84 1.875 1.875 1.875h12.75c1.035 0 1.875-.84 1.875-1.875V12.75A3.75 3.75 0 0 0 16.5 9h-1.875a1.875 1.875 0 0 1-1.875-1.875V5.25A3.75 3.75 0 0 0 9 1.5H5.625ZM7.5 15a.75.75 0 0 1 .75-.75h7.5a.75.75 0 0 1 0 1.5h-7.5A.75.75 0 0 1 7.5 15Zm.75 2.25a.75.75 0 0 0 0 1.5H12a.75.75 0 0 0 0-1.5H8.25Z" clip-rule="evenodd" />
                                        <path d="M12.971 1.816A5.23 5.23 0 0 1 14.25 5.25v1.875c0 .207.168.375.375.375H16.5a5.23 5.23 0 0 1 3.434 1.279 9.768 9.768 0 0 0-6.963-6.963Z" />
                                    </svg>
                                </span>
                                <select id="materil" name="materil" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                                    <option value="">-- PILIH --</option>
                                    <option value="lengkap">Lengkap</option>
                                    <option value="tidak-lengkap">Tidak Lengkap</option>
                                </select>
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
                    </div>

                    <div class="mt-9">
                        <!-- Button Tambah Lampiran -->
                        <a data-tab="tab-2" type="button" class="tab-link active block ml-auto w-[180px] h-[50px] text-sm lg:leading-7 leading-9 text-center px-4 py-2 cursor-pointer bg-custom-green-700 text-white font-bold rounded-md shadow-sm hover:bg-[#1d4b13] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3F6137]">
                            Tambah Lampiran
                        </a>
                    </div>
                </div>
                <div id="tab-2" class="tab-content hidden">
                    <div class="grid grid-cols-1 gap-4" id="file-upload-form">
                        <span class="text-black text-xs font-bold block">* Lampiran berupa foto</span>
                        <div class="mb-4 flex items-center">
                            <label for="file-0" class="file-label">
                                Unggah File
                            </label>
                            <input type="file" id="file-0" name="lampiran[]" class="file-input" onchange="updateFileName(0)">
                            <span id="file-name-0" class="file-name">Tidak ada file yang dipilih</span>
                        </div>
                    </div>
                    <button type="button" id="add-file-button" class="block mx-auto w-[60px] h-[50px] text-sm lg:leading-7 leading-9 text-center btn-custom">
                        +
                    </button>
    
                    <div class="mt-9 flex items-center justify-end gap-3">
                        <a data-tab="tab-1" type="button" class="tab-link active w-[180px] h-[50px] text-sm lg:leading-7 leading-9 text-center px-4 py-2 cursor-pointer bg-custom-green-700 text-white font-bold rounded-md shadow-sm hover:bg-[#1d4b13] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3F6137]">
                            Kembali
                        </a>
                        <!-- Button Tambah Lampiran -->
                        <button type="submit" class="w-[180px] h-[50px] text-sm lg:leading-7 leading-9 text-center btn-custom">
                            Unggah
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
@endpush
