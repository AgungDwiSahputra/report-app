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
            <h1 class="text-2xl text-white font-bold">Kelengkapan Dokumen</h1>
        </div>
        <div class="p-8">
            <div class="lg:w-2/4 w-4/5 bg-custom-green-500 p-4 -ml-9 rounded-md shadow-md">
                <span class="block text-bold text-white">ID Laporan: {{ $report->id_laporan }} / No. RI/{{ $report->laporan->id }}/LSH/{{ date('Y') }}/{{ $report->pembuat->jabatan . " " . $report->wilayah_asal }}</span>
                <span class="block text-bold text-white">Laporan: {{ $report->laporan->judul_laporan }}</span>
            </div>

            <div id="document-view" class="my-10">
                <iframe src="{{ url('storage/document/report/' . $report->laporan->file_laporan) }}" width="100%" height="600px"></iframe>
            </div>

            @php
                
                // Cek jika angka pertama adalah 0, ganti dengan 62
                if (substr($report->penerima->no_telp, 0, 1) === '0') {
                    $phone_number = '62' . substr($report->penerima->no_telp, 1);
                }
                
                // Menghapus "Koramil " dari awal kalimat
                $wilayah_asal_danramil = str_replace("Koramil ", "", $report->wilayah_asal);
                // Membuat format "1416/Muna"
                $wilayah_asal_dandim = preg_replace("/(\d{4})-\d{2}\/\w+/", "$1/Muna", $wilayah_asal_danramil);
                if($report->pembuat->level == 'babinsa'){
                    $message = 'Ytg. '.$report->penerima->jabatan . ' ' . $wilayah_asal_danramil.'. Kami ingin memberitahukan bahwa '. $report->pembuat->jabatan . ' ' . $report->wilayah_asal .' telah menyelesaikan laporan terbaru. Laporan ini memerlukan perhatian Anda segera untuk verifikasi lebih lanjut. Mohon klik link berikut untuk mengakses dan meninjau laporan tersebut: ' . route('verification-report.index') . '. 
                    Kami sangat menghargai waktu dan kerja sama Anda dalam memastikan informasi yang akurat dan langkah-langkah yang tepat dapat segera diambil. Terima kasih atas perhatiannya.';
                }else{
                    $message = 'Ytg. '.$report->penerima->jabatan . ' ' . $wilayah_asal_dandim.'. Kami ingin memberitahukan bahwa '. $report->pembuat->jabatan . ' ' . $report->wilayah_asal .' telah menyelesaikan laporan terbaru. Laporan ini memerlukan perhatian Anda segera untuk verifikasi lebih lanjut. Mohon klik link berikut untuk mengakses dan meninjau laporan tersebut: ' . route('verification-report.index') . '. 
                    Kami sangat menghargai waktu dan kerja sama Anda dalam memastikan informasi yang akurat dan langkah-langkah yang tepat dapat segera diambil. Terima kasih atas perhatiannya.';
                }

                $encoded_message = urlencode($message);
            @endphp
            <div class="flex items-center justify-end gap-2">
                <a href="{{ route('report.show-other-index') }}" class="block btn-custom w-fit">Kembali</a>
                {{-- <a {{ $report->laporan->status == 'publish' ? 'target="_BLANK" href="https://wa.me/' . $phone_number . '?text=' . $encoded_message . '" onclick="notification()"' : 'onclick="kirim_laporan()"' }} id="kirim-laporan" class="block btn-custom w-fit cursor-pointer">{{ $report->laporan->status == 'publish' ? 'Kirim Notifikasi' : 'Kirim Laporan' }}</a> --}}
                <a @if ($report->laporan->status == 'publish') 
                        target="_BLANK" 
                        href="https://wa.me/{{ $phone_number }}?text={{ $encoded_message }}" 
                        onclick="notification()"
                    @else 
                        onclick="kirim_laporan()" 
                    @endif 
                    id="kirim-laporan" class="block btn-custom w-fit cursor-pointer">
                    {{ $report->laporan->status == 'publish' ? 'Kirim Notifikasi' : 'Kirim Laporan' }}
                </a>
            </div>
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

        function kirim_laporan() {
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
                            text: 'Laporan Berhasil Terkirim',
                            customClass: {
                                confirmButton: 'btn-custom'
                            },
                            buttonsStyling: false
                        });

                        var phone_number = "{{ $phone_number }}";
                        var encoded_message = "{{ $encoded_message }}";
                        var link = `https://wa.me/${phone_number}?text=${encoded_message}`;

                        $('#kirim-laporan').attr({
                            'target': '_BLANK',
                            'href': link,
                            'onclick': 'notification()'
                        }).text('Kirim Notifikasi');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terdapat Kesalahan',
                            text: 'Laporan Gagal Terkirim',
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

        function notification() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil',
                text: 'Notifikasi Berhasil Terkirim',
                customClass: {
                    confirmButton: 'btn-custom'
                },
                buttonsStyling: false
            });
        }
    </script>
@endpush
