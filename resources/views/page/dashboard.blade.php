@extends('main')

@push('style')
@endpush

@section('content')
    <div class="w-full h-full lg:pt-[85px] lg:pl-[85px] lg:pr-6 lg:pb-6 p-5 pt-14">
        <p class="font-bold">Informasi Laporan</p>
        <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-2 gap-4">
            @php
                $statuses = [
                    'publish' => 'Menunggu Konfirmasi',
                    'verification' => 'Terverifikasi',
                    'not-verify' => 'Direvisi',
                    'valid' => 'Tervalidasi',
                    'invalid' => 'Belum Validasi'
                ];
            @endphp

            <div class="h-32 flex items-center justify-center flex-col border-green-400 bg-white rounded-md shadow-md px-4 py-2">
                <span class="block text-sm text-center">Jumlah Laporan Dibuat</span>
                <span class="block text-3xl text-center font-bold">{{ $total_report }}</span>
            </div>

            @foreach($statuses as $status => $label)
                @php
                    $reportData = $report->firstWhere('status', $status);
                    $totalReport = $reportData ? $reportData->total : 0;
                @endphp
                <div class="h-32 flex items-center justify-center flex-col border-green-400 bg-white rounded-md shadow-md px-4 py-2">
                    <span class="block text-sm text-center">Jumlah Laporan {{ $label }}</span>
                    <span class="block text-3xl text-center font-bold">{{ $totalReport }}</span>
                </div>
            @endforeach
        </div>

        <p class="font-bold mt-5">Informasi Surat</p>
        <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-2 gap-4">
            <div class="h-32 flex items-center justify-center flex-col border-green-400 bg-white rounded-md shadow-md px-4 py-2">
                <span class="block text-sm text-center">Jumlah Surat Dibuat</span>
                <span class="block text-3xl text-center font-bold">{{ $total_letter }}</span>
            </div>

            @php
                $letterStatuses = [
                    'publish' => 'Menunggu Verifikasi',
                    'agree' => 'Terverifikasi',
                    'not-verify' => 'Direvisi',
                    'valid' => 'Tervalidasi',
                    'invalid' => 'Belum Validasi'
                ];
            @endphp

            @foreach($letterStatuses as $status => $label)
                @php
                    $letterData = $letter->firstWhere('status', $status);
                    $totalLetter = $letterData ? $letterData->total : 0;
                @endphp
                <div class="h-32 flex items-center justify-center flex-col border-green-400 bg-white rounded-md shadow-md px-4 py-2">
                    <span class="block text-sm text-center">Jumlah Surat {{ $label }}</span>
                    <span class="block text-3xl text-center font-bold">{{ $totalLetter }}</span>
                </div>
            @endforeach

        </div>
    </div>
@endsection

@push('script')
@endpush
