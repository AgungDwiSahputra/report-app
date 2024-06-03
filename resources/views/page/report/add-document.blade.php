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
            <h1 class="text-2xl text-white font-bold">Lampiran</h1>
        </div>

        <div class="p-8">
            <form action="" method="POST" id="profile-form">
                <div class="grid grid-cols-1 gap-4" id="file-upload-form">
                    <span class="text-black text-xs font-bold block">* Lampiran berupa foto</span>
                    <div class="mb-4 flex items-center">
                        <label for="file" class="file-label">
                            Unggah File
                        </label>
                        <input type="file" id="file-0" name="lampiran-0" class="file-input" onchange="updateFileName(0)">
                        <span id="file-name-0" class="file-name">Tidak ada file yang dipilih</span>
                    </div>
                </div>
                <button type="button" id="add-file-button" class="block mx-auto w-[60px] h-[50px] text-sm lg:leading-7 leading-9 text-center btn-custom">
                    +
                </button>

                <div class="mt-9">
                    <!-- Button Tambah Lampiran -->
                    <button type="button" onclick="prossesUploadLampiran()" class="block ml-auto w-[180px] h-[50px] text-sm lg:leading-7 leading-9 text-center btn-custom">
                        Tambah Lampiran
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="text/javascript">
        $('#table-list-laporan').DataTable({
            order: [
                [0, 'asc']
            ]
        });
    </script>

    <script type="text/javascript">
        let fileIndex = 1;

        function updateFileName(index) {
            const input = document.getElementById('file-' + index);
            const fileNameSpan = document.getElementById('file-name-' + index);
            fileNameSpan.textContent = input.files.length > 0 ? input.files[0].name : 'Tidak ada file yang dipilih';
        }

        $(document).ready(function() {
            $('#add-file-button').click(function() {
                const newFileInputWrapper = $('<div class="mb-4 flex items-center file-input-wrapper"></div>');

                const newLabel = $('<label></label>')
                    .attr('for', 'file-' + fileIndex)
                    .addClass('file-label')
                    .text('Unggah File');

                const newInput = $('<input>')
                    .attr('type', 'file')
                    .attr('id', 'file-' + fileIndex)
                    .attr('name', 'lampiran-' + fileIndex)
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
