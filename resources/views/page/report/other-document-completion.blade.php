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
            <h1 class="text-2xl text-white font-bold">Kelengkapan Dokumen</h1>
        </div>
        <div class="p-8">
            <div class="w-2/4 bg-custom-green-500 p-4 -ml-9 rounded-md shadow-md">
                <span class="block text-bold text-white">ID Laporan: ***** / No. 12345678</span>
                <span class="block text-bold text-white">Laporan: *****</span>
            </div>

            <div id="document-view">
                <iframe src="{{ asset('storage/laporan/Laporan_Situasi_Harian.pdf') }}" width="100%" height="600px"></iframe>
            </div>
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
