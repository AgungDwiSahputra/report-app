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
    <div class="w-10/12 bg-white rounded-2xl mt-[100px] ml-[100px] mr-6 mb-6">
        <div id="box-heading" class="bg-custom-green-700 rounded-t-2xl py-3 px-5">
            <h1 class="text-2xl text-white font-bold">Buat Pengajuan</h1>
        </div>
        <a href="#" type="button" class="flex items-center justify-center gap-3 mr-auto w-full h-12 text-sm text-center px-4 py-2 mt-20 mb-10 cursor-pointer bg-custom-green-700 text-white font-bold shadow-sm hover:bg-[#1d4b13] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#3F6137]">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                <path fill-rule="evenodd" d="M12 3.75a.75.75 0 0 1 .75.75v6.75h6.75a.75.75 0 0 1 0 1.5h-6.75v6.75a.75.75 0 0 1-1.5 0v-6.75H4.5a.75.75 0 0 1 0-1.5h6.75V4.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
            </svg>
            Buat Pengajuan Baru
        </a>

        <div class="p-8">
            <table id="table-list-laporan" class="w-full table-auto display">
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
                    <tr>
                        <td>1</td>
                        <td>12345</td>
                        <td>Lorem, ipsum dolor.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>20 Sept 2023</td>
                        <td>Tervalidasi</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>12345</td>
                        <td>Lorem, ipsum dolor.</td>
                        <td>Lorem ipsum dolor sit amet.</td>
                        <td>20 Sept 2023</td>
                        <td>Review</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script type="text/javascript">
        $('#table-list-laporan').DataTable({
            order: [
                [0, 'asc']
            ]
        });
    </script>
@endpush
