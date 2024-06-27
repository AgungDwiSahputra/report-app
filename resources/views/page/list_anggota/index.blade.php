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
            <h1 class="text-2xl text-white font-bold">Daftar Anggota</h1>
        </div>
        <div class="p-8">
            @if(auth()->user()->level == 'admin')
                <a href="{{ route('list-anggota.create') }}" type="button" class="btn-custom mb-8">+ Tambah Anggota</a>
            @endif
            <table id="table-list-laporan" class="w-full table-auto display" style="width: 100%">
                <thead class="bg-custom-green-600 text-white">
                    <tr>
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Jabatan</th>
                        <th>NRP</th>
                        <th>Penempatan</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($pengguna as $key => $data)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $data->nama_lengkap }}</td>
                            <td>{{ ucfirst($data->level) }}</td>
                            <td>{{ $data->NRP }}</td>
                            <td>{{ $data->penempatan }}</td>
                            <td class="flex items-center justify-center">
                                @if(auth()->user()->level == 'admin')
                                    <a href="{{ route('list-anggota.edit', $data->id) }}" class="hover:shadow-lg hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>
                                    </a>
                                @else
                                    <a href="{{ route('list-anggota.show', $data->id) }}" class="hover:shadow-lg hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>
                                    </a>
                                @endif
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
        $(document).ready(function() {
            // Custom sorting function for the 'jabatan' column
            $.fn.dataTable.ext.order['jabatan-pre'] = function(settings, col) {
                var order = ['dandim', 'staf', 'danramil', 'babinsa'];
                return this.api().column(col, { order: 'index' }).nodes().map(function(td, i) {
                    return order.indexOf($(td).text());
                });
            };

            // Initialize DataTable with custom sorting
            $('#table-list-laporan').DataTable({
                scrollX: true,
                "columnDefs": [
                    {
                        "targets": 2, // index of the 'jabatan' column
                        "orderDataType": "jabatan-pre"
                    }
                ],
                order: [
                    [2, 'asc']
                ]
            });
        });
    </script>
@endpush
