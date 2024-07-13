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
    <div class="lg:w-10/12 w-11/12 bg-white rounded-2xl lg:mt-[100px] mt-[60px] lg:ml-[100px] mx-auto mr-6 mb-6">
        <div id="box-heading" class="bg-custom-green-700 rounded-t-2xl py-3 px-5">
            <h1 class="text-2xl text-white font-bold">Buat Laporan</h1>
        </div>
        <a href="{{ route('report.create') }}" type="button" class="flex items-center justify-center gap-3 mr-auto w-full h-12 text-sm text-center px-4 py-2 mt-20 mb-10 cursor-pointer bg-custom-green-700 text-white font-bold shadow-sm hover:bg-[#1d4b13] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3F6137]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
            </svg>
            Buat Laporan Baru
        </a>
        <div class="p-8">
            <table id="table-list-laporan" class="w-full table-auto display" style="width: 100%">
                <thead class="bg-custom-green-600 text-white">
                    <tr>
                        <th>ID Laporan</th>
                        <th>No. Laporan</th>
                        <th>Jenis Laporan</th>
                        <th>Judul Laporan</th>
                        <th>Tanggal</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reports as $key => $data)
                        @php
                            $status = 'Belum Validasi';
                            $link = route('report.show', $data->id_laporan);
                            $color = 'text-blue-600';
                            if ($data->laporan->status == 'valid') {
                                $status = 'Tervalidasi';
                                $link = 'javascript:void(0);';
                                $color = '';
                            }
                            if ($data->laporan->status == 'publish') {
                                $status = 'Menunggu Konfirmasi';
                                $link = 'javascript:void(0);';
                                $color = '';
                            }
                            if ($data->laporan->status == 'verification') {
                                $status = 'Terverifikasi';
                                $link = 'javascript:void(0);';
                                $color = 'text-green-600';
                            }
                            if ($data->laporan->status == 'not-verify') {
                                $status = 'Laporan Tertolak (Revisi)';
                                $link = 'javascript:void(0);';
                                $color = 'text-red-600';
                            }
                        @endphp
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->laporan->id }}</td>
                            <td>{{ $data->laporan->jenis_laporan }}</td>
                            <td>{{ $data->laporan->judul_laporan }}</td>
                            <td>{{ $data->laporan->tanggal_buat }}</td>
                            <td>
                                <a href="{{ $link }}" class="flex items-center justify-center gap-1 font-bold hover:scale-105 {{ $color }}">
                                    @if ($data->laporan->status == 'invalid')
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>
                                    @endif
                                    {{ $status }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script type="text/javascript">
        $('#table-list-laporan').DataTable({
            scrollX: true,
            order: [
                [0, 'asc']
            ]
        });
    </script>
@endpush
