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
            <table id="table-list-pengajuan" class="w-full table-auto display">
                <thead class="bg-custom-green-600 text-white">
                    <tr>
                        <th>ID Surat</th>
                        <th>No. Surat</th>
                        <th>Jenis Surat</th>
                        <th>Judul Surat</th>
                        <th>Tanggal</th>
                        <th>Tindakan</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($letters as $key => $data)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $data->id_pengajuan }}</td>
                            <td>{{ $data->pengajuan->jenis_pengajuan }}</td>
                            <td>{{ $data->pengajuan->jenis_pengajuan }}</td>
                            <td>{{ $data->pengajuan->tanggal_ubah }}</td>
                            <td class="flex items-center justify-center gap-4">
                                {{-- @if ($data->pengajuan->status != 'publish' && $data->pengajuan->status != 'verification') --}}
                                    <a href="{{ route('pengajuan.other-document-pengajuan', $data->id_pengajuan) }}" class="hover:shadow-lg hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                            <path d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                                            <path d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                                        </svg>
                                    </a>
                                {{-- @endif --}}
                                <a href="{{ route('download.pengajuan', $data->pengajuan->file_pengajuan) }}" class="hover:shadow-lg hover:scale-110">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                                        <path fill-rule="evenodd" d="M12 2.25a.75.75 0 0 1 .75.75v11.69l3.22-3.22a.75.75 0 1 1 1.06 1.06l-4.5 4.5a.75.75 0 0 1-1.06 0l-4.5-4.5a.75.75 0 1 1 1.06-1.06l3.22 3.22V3a.75.75 0 0 1 .75-.75Zm-9 13.5a.75.75 0 0 1 .75.75v2.25a1.5 1.5 0 0 0 1.5 1.5h13.5a1.5 1.5 0 0 0 1.5-1.5V16.5a.75.75 0 0 1 1.5 0v2.25a3 3 0 0 1-3 3H5.25a3 3 0 0 1-3-3V16.5a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                                    </svg>
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
        $('#table-list-pengajuan').DataTable({
            order: [
                [0, 'asc']
            ]
        });
    </script>
@endpush
