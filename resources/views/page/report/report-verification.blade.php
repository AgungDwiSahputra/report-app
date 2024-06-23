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
            <h1 class="text-2xl text-white font-bold">Verifikasi Laporan</h1>
        </div>
        <div class="p-8">
            <div class="w-2/4 bg-custom-green-500 p-4 -ml-9 rounded-md shadow-md">
                <span class="block text-bold text-white">ID Laporan: {{ $report->id_laporan }} / No. RI/{{ $report->laporan->id }}/LSH/{{ date('Y') }}/{{ $report->pembuat->jabatan . " " . $report->wilayah_asal }}</span>
                <span class="block text-bold text-white">Laporan: {{ $report->laporan->judul_laporan }}</span>
            </div>

            <div id="document-view" class="my-10">
                <iframe src="{{ url('storage/document/report/' . $report->laporan->file_laporan) }}" width="100%" height="600px"></iframe>
            </div>
            <form action="{{ route('verification-report.update', $report->laporan->id) }}" method="POST">
                @method('PUT')
                @csrf
                <div class="flex items-center justify-start gap-5">
                    <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500">
                        <span class="inline-flex items-center px-3 border-r-1 border-solid border-gray-300">
                            <!-- SVG Ikon -->
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                            </svg>
                        </span>
                        <select id="tindakan" name="tindakan" class="w-full h-10 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-custom-green-500 focus:border-custom-green-500 hover:border-custom-green-500 active:border-custom-green-500 sm:text-md">
                            <option value="">-- PILIH --</option>
                            <option value="verification" {{ old('tindakan') == 'verification' ? 'selected' : '' }}>Verifikasi</option>
                            <option value="not-verify" {{ old('tindakan') == 'not-verify' ? 'selected' : '' }}>Tolak Laporan</option>
                        </select>
                    </div>
                    <div>
                        <a href="{{ route('verification-report.index') }}" type="button"><button class="btn-custom">Kembali</button></a>
                        <button type="submit" class="btn-custom">Kirim</button>
                    </div>
                </div>
            </form>
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

        function notification() {
            $.ajax({
                url: '{{ route('report.other-document-completion-publish') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF untuk keamanan
                    id_laporan: '{{ $report->id_laporan }}'
                },
                success: function(response) {
                    if (response == 'berhasil') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'Notifikasi Berhasil Terkirim',
                            customClass: {
                                confirmButton: 'btn-custom'
                            },
                            buttonsStyling: false
                        });

                        $('.btn-custom').attr('href', "{{ route('report.show-other-index') }}")
                            .removeAttr('target')
                            .removeAttr('onclick')
                            .text('Kembali');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terdapat Kesalahan',
                            text: 'Notifikasi Gagal Terkirim',
                            customClass: {
                                confirmButton: 'btn-custom'
                            },
                            buttonsStyling: false
                        });
                    }
                },
                error: function() {
                    alert('Terjadi kesalahan. Silakan coba lagi.');
                }
            });
        }
    </script>
@endpush
