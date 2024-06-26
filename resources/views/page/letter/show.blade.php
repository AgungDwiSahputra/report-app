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
            <h1 class="text-2xl text-white font-bold">Lihat & Validasi</h1>
        </div>

        <div class="p-8">
            <form action="{{ route('pengajuan.update', $letter->id_pengajuan) }}" method="POST" id="form-input" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-4">
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
                            <input readonly value="{{ $letter->pembuat->jabatan }}" placeholder="Dibuat Oleh" type="text" name="dibuat_oleh" id="dibuat_oleh" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
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
                                        <option value="{{ $data->id }}" {{ $letter->penerima->id == $data->id ? 'selected' : '' }}>{{ $data->jabatan }}</option>
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
                            <input value="{{ $letter->pengajuan->jenis_pengajuan }}" placeholder="Jenis Pengajuan" type="text" name="jenis_pengajuan" id="jenis_pengajuan" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
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
                            <input value="{{ $letter->pengajuan->judul_pengajuan }}" placeholder="Judul Pengajuan" type="text" name="judul_pengajuan" id="judul_pengajuan" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
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
                                <option value="Kodim 1416/Muna" selected>Kodim 1416/Muna</option>
                                {{-- <option value="Koramil 1416-01/Katobu" {{ $letter->wilayah_asal == 'Koramil 1416-01/Katobu' ? 'selected' : '' }}>Koramil 1416-01/Katobu</option>
                                <option value="Koramil 1416-02/Tikep" {{ $letter->wilayah_asal == 'Koramil 1416-02/Tikep' ? 'selected' : '' }}>Koramil 1416-02/Tikep</option>
                                <option value="Koramil 1416-03/Tongkuno" {{ $letter->wilayah_asal == 'Koramil 1416-03/Tongkuno' ? 'selected' : '' }}>Koramil 1416-03/Tongkuno</option>
                                <option value="Koramil 1416-04/Kabawo" {{ $letter->wilayah_asal == 'Koramil 1416-04/Kabawo' ? 'selected' : '' }}>Koramil 1416-04/Kabawo</option>
                                <option value="Koramil 1416-05/Maligano" {{ $letter->wilayah_asal == 'Koramil 1416-05/Maligano' ? 'selected' : '' }}>Koramil 1416-05/Maligano</option>
                                <option value="Koramil 1416-06/Lawa" {{ $letter->wilayah_asal == 'Koramil 1416-06/Lawa' ? 'selected' : '' }}>Koramil 1416-06/Lawa</option>
                                <option value="Koramil 1416-07/Tampo" {{ $letter->wilayah_asal == 'Koramil 1416-07/Tampo' ? 'selected' : '' }}>Koramil 1416-07/Tampo</option> --}}
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
                            <input value="{{ $letter->pengajuan->tanggal_buat }}" placeholder="Tanggal Dibuat" type="date" name="tanggal_dibuat" id="tanggal_dibuat" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
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
                            <input value="{{ $letter->deskripsi }}" placeholder="deskripsi" type="text" name="deskripsi" id="deskripsi" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                        </div>
                        <span class="text-xs text-red-600">*Point baru gunakan " ; " </span>
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
                                        <option value="{{ $data->id }}" {{ $letter->diperintahkan_kepada == $data->id ? 'selected' : '' }}>{{ $data->nama_lengkap }}</option>
                                    @endif
                                @endforeach
                            </select>
                            {{-- <input value="{{ $letter->diperintahkan_kepada }}" placeholder="Diperintahkan Kepada" type="text" name="diperintahkan_kepada" id="diperintahkan_kepada" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md"> --}}
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
                            <input value="{{ $letter->tembusan }}" placeholder="Tembusan" type="text" name="tembusan" id="tembusan" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                        </div>
                        <span class="text-xs text-red-600">*Point baru gunakan " ; " </span>
                    </div>
                    <!-- Dasar Perintah -->
                    <div class="mb-2">
                        <label for="editor" class="text-black text-sm font-bold">Dasar Perintah</label>
                        <textarea rows="5" name="dasar_perintah" id="editor" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                            {{ old('dasar_perintah', $data->dasar_perintah) }}
                        </textarea>
                    </div>
                </div>

                <!-- Bagian Lampiran -->
                <div class="flex items-center justify-center mt-10">
                    {{-- <button type="button" data-target="#lampiran-tab" class="tab active w-full px-4 py-2 bg-custom-green-600 text-white font-bold shadow-sm hover:bg-[#1d4b13] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3F6137]">Lampiran</button> --}}
                    <button type="button" data-target="#validasi-tab" class="tab w-full px-4 py-2 bg-custom-green-500 text-white font-bold shadow-sm hover:bg-[#1d4b13] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3F6137]">Validasi</button>
                </div>
                <div id="lampiran-tab" class="tab-target" hidden>
                </div>
                <div id="validasi-tab" class="tab-target">
                    <button type="simpan" class="btn-custom mt-3">Simpan</button>
                </div>
                {{-- <div class="w-full overflow-x-auto">
                    <table id="table-list-pengajuan" class="w-full table-auto display">
                        <thead class="bg-custom-green-600 text-white">
                            <tr>
                                <th class="w-40">No. pengajuan</th>
                                <th>Tindakan</th>
                                <th>Tipe pengajuan</th>
                                <th class="lg:w-2/5 w-4/5">Lampiran</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($lampiran as $key => $data)
                                <tr>
                                    <td>{{ $letter->id_pengajuan }}</td>
                                    <td>
                                        <input type="file" id="file-{{ $key }}" name="lampiran[]" class="file-input" onchange="updateFileName({{ $key }})" hidden>
                                        <label for="file-{{ $key }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6 mx-auto hover:shadow-lg hover:scale-110">
                                                <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                                <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                            </svg>                                  
                                        </label>
                                    </td>
                                    <td>{{ $letter->pengajuan->jenis_pengajuan }}</td>
                                    <td id="lampiran-{{ $key }}" class="w-2/4 cursor-pointer text-blue-600 hover:font-bold" onclick="openPopup('{{ asset('storage/images/letter/' . $data) }}')">{{ $data }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div> --}}
            </form>
        </div>
    </div>

    {{-- <div id="popup-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
        <div class="bg-white rounded-lg overflow-hidden shadow-xl transform transition-all sm:max-w-3xl sm:w-full">
            <div class="px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">
                            Lampiran Gambar
                        </h3>
                        <div class="mt-2">
                            <img id="popup-image" src="" alt="Lampiran Gambar" class="w-full h-auto max-h-96">
                        </div>
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="button" onclick="closePopup()" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                    Tutup
                </button>
            </div>
        </div>
    </div> --}}
    
@endsection

@push('script')
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script type="text/javascript">
        $('#table-list-pengajuan').DataTable({
            order: [
                [0, 'asc']
            ]
        });
    </script>

    <script type="text/javascript">
        $('.tab').on('click', function() {
            let target = $(this).data('target');

            if ($('.tab').hasClass('bg-custom-green-500')) {
                $('.tab').removeClass('bg-custom-green-500');
                $('.tab').removeClass('bg-custom-green-600');
                $('.tab').addClass('bg-custom-green-500');
                $(this).addClass('bg-custom-green-600');
            }
            if ($('.tab-target' + target).is('[hidden]')) {
                $('.tab-target').attr('hidden', true)
                $('.tab-target' + target).removeAttr('hidden')
            }
        })
    </script>

    <script type="text/javascript">
        // Popup
        function openPopup(imageSrc) {
            console.log(imageSrc);
            document.getElementById('popup-image').src = imageSrc;
            document.getElementById('popup-modal').classList.remove('hidden');
        }

        function closePopup() {
            document.getElementById('popup-modal').classList.add('hidden');
        }
    </script>


    <script type="text/javascript">
        // Update file name pada inputan file
        function updateFileName(index) {
            const $input = $('#file-' + index);
            const $fileNameSpan = $('#lampiran-' + index);
            $fileNameSpan.removeAttr('onclick');
            $fileNameSpan.removeClass('text-blue-600 hover:font-bold');
            $fileNameSpan.text($input[0].files.length > 0 ? $input[0].files[0].name : 'Tidak ada file yang dipilih');
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
