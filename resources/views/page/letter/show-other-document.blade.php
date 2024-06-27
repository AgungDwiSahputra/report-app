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
            <div class="w-2/4 bg-custom-green-500 p-4 -ml-9 rounded-md shadow-md">
                <span class="block text-bold text-white">ID Surat: {{ $letter->id_pengajuan }} / No. Sprin/{{ $letter->pengajuan->id }}/{{ $letter->pengajuan->tanggal_romawi }}/{{ date('Y') }}</span>
                <span class="block text-bold text-white">Surat: {{ $letter->pengajuan->judul_pengajuan }}</span>
            </div>

            <div id="document-view" class="my-10">
                <iframe src="{{ url('storage/document/pengajuan/' . $letter->pengajuan->file_pengajuan) }}" width="100%" height="600px"></iframe>
            </div>

            @php
                // Cek jika angka pertama adalah 0, ganti dengan 62
                if (substr($letter->penerima->no_telp, 0, 1) === '0') {
                    $phone_number = '62' . substr($letter->penerima->no_telp, 1);
                }

                // Menghapus "Koramil " dari awal kalimat
                $wilayah_asal_danramil = str_replace("Koramil ", "", $letter->wilayah_asal);
                // Membuat format "1416/Muna"
                $wilayah_asal_dandim = preg_replace("/(\d{4})-\d{2}\/\w+/", "$1/Muna", $wilayah_asal_danramil);

                if($letter->pembuat->level == 'babinsa'){
                    $message = 'Ytg. '.$letter->penerima->jabatan . ' ' . $wilayah_asal_danramil.'. Kami ingin memberitahukan bahwa '. $letter->pembuat->jabatan . ' ' . $letter->wilayah_asal .' telah menyelesaikan laporan terbaru. Laporan ini memerlukan perhatian Anda segera untuk verifikasi lebih lanjut. Mohon klik link berikut untuk mengakses dan meninjau laporan tersebut: ' . route('verification-pengajuan.index') . '. 
                    Kami sangat menghargai waktu dan kerja sama Anda dalam memastikan informasi yang akurat dan langkah-langkah yang tepat dapat segera diambil. Terima kasih atas perhatiannya.';
                }else{
                    $message = 'Ytg. '.$letter->penerima->jabatan . ' ' . $wilayah_asal_dandim.'. Kami ingin memberitahukan bahwa '. $letter->pembuat->jabatan . ' ' . $letter->wilayah_asal .' telah menyelesaikan laporan terbaru. Laporan ini memerlukan perhatian Anda segera untuk verifikasi lebih lanjut. Mohon klik link berikut untuk mengakses dan meninjau laporan tersebut: ' . route('verification-pengajuan.index') . '. 
                    Kami sangat menghargai waktu dan kerja sama Anda dalam memastikan informasi yang akurat dan langkah-langkah yang tepat dapat segera diambil. Terima kasih atas perhatiannya.';
                }

                $encoded_message = urlencode($message);
            @endphp
            <div class="flex items-center justify-end gap-2">
                <a href="{{ route('pengajuan.show-other-index') }}" class="block btn-custom w-fit">Kembali</a>
                {{-- <a {{ $letter->pengajuan->status == 'publish' ? 'target="_BLANK" href="https://wa.me/' . $phone_number . '?text=' . $encoded_message . '" onclick="notification()"' : 'onclick="kirim_pengajuan()"' }} id="kirim-pengajuan" class="block btn-custom w-fit cursor-pointer">{{ $letter->pengajuan->status == 'publish' ? 'Kirim Notifikasi' : 'Kirim pengajuan' }}</a> --}}
                <a @if ($letter->pengajuan->status == 'publish') 
                        target="_BLANK" 
                        href="https://wa.me/{{ $phone_number }}?text={{ $encoded_message }}" 
                        onclick="notification()"
                    @else 
                        onclick="kirim_pengajuan()" 
                    @endif 
                    id="kirim-pengajuan" class="block btn-custom w-fit cursor-pointer">
                    {{ $letter->pengajuan->status == 'publish' ? 'Kirim Notifikasi' : 'Kirim pengajuan' }}
                </a>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
    <script type="text/javascript">
        $('#table-list-pengajuan').DataTable({
            scrollX: true,
            order: [
                [0, 'asc']
            ]
        });

        function kirim_pengajuan() {
            $.ajax({
                url: '{{ route('post.other-document-pengajuan') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Token CSRF untuk keamanan
                    id_pengajuan: '{{ $letter->id_pengajuan }}'
                },
                success: function(response) {
                    console.log(response);
                    if (response == 'berhasil') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil',
                            text: 'pengajuan Berhasil Terkirim',
                            customClass: {
                                confirmButton: 'btn-custom'
                            },
                            buttonsStyling: false
                        });

                        var phone_number = "{{ $phone_number }}";
                        var encoded_message = "{{ $encoded_message }}";
                        var link = `https://wa.me/${phone_number}?text=${encoded_message}`;

                        $('#kirim-pengajuan').attr({
                            'target': '_BLANK',
                            'href': link,
                            'onclick': 'notification()'
                        }).text('Kirim Notifikasi');
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Terdapat Kesalahan',
                            text: 'pengajuan Gagal Terkirim',
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
