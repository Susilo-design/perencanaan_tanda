@extends('layout.app')

@section('title', 'Mulai Perjalanan Anda - Nama Tanda')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-bg-100">
    <div class="container mx-auto px-6 py-12">
        {{-- Hero Section --}}
        <div class="text-center mb-16">
            <h1 class="text-5xl md:text-7xl font-bold text-text-100 mb-6">
                Tanda
            </h1>
            <p class="text-xl md:text-2xl text-text-200 mb-8">
                "Setiap Tujuan Butuh Tanda."
            </p>
            <p class="text-lg text-text-200 max-w-2xl mx-auto mb-12">
                Transformasikan impian Anda menjadi kenyataan dengan perencanaan yang terstruktur.
                Mulai perjalanan menuju kesuksesan Anda hari ini.
            </p>

            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('register') }}"
                   class="bg-primary-100 text-text-100 px-8 py-4 rounded-lg text-lg font-semibold hover:bg-primary-200 transform hover:scale-105 transition duration-300 shadow-lg">
                    Mulai Sekarang
                </a>
            </div>
        </div>


    </div>
</div>
@endsection

@push('styles')
<style>
    :root {
        --primary-100: #2ECC71;
        --primary-200: #00ae56;
        --primary-300: #006a18;
        --accent-100: #3498DB;
        --accent-200: #004079;
        --text-100: #FFFFFF;
        --text-200: #e0e0e0;
        --bg-100: #1A1E21;
        --bg-200: #292d30;
        --bg-300: #414548;
    }

    .bg-bg-100 { background-color: var(--bg-100); }
    .bg-bg-200 { background-color: var(--bg-200); }
    .bg-bg-300 { background-color: var(--bg-300); }
    .text-text-100 { color: var(--text-100); }
    .text-text-200 { color: var(--text-200); }
    .text-primary-100 { color: var(--primary-100); }
    .text-accent-100 { color: var(--accent-100); }
    .bg-primary-100 { background-color: var(--primary-100); }
    .bg-primary-200 { background-color: var(--primary-200); }
    .bg-primary-300 { background-color: var(--primary-300); }
    .bg-accent-100 { background-color: var(--accent-100); }
    .bg-accent-200 { background-color: var(--accent-200); }
    .hover\:bg-primary-200:hover { background-color: var(--primary-200); }
    .hover\:bg-primary-300:hover { background-color: var(--primary-300); }
    .hover\:bg-bg-300:hover { background-color: var(--bg-300); }
    .hover\:text-primary-100:hover { color: var(--primary-100); }
    .hover\:shadow-primary-100\/20:hover { box-shadow: 0 25px 50px -12px rgba(46, 204, 113, 0.2); }
    .from-primary-100 { --tw-gradient-from: var(--primary-100); }
    .to-primary-200 { --tw-gradient-to: var(--primary-200); }
    .hover\:from-primary-200:hover { --tw-gradient-from: var(--primary-200); }
    .hover\:to-primary-300:hover { --tw-gradient-to: var(--primary-300); }
    .border-primary-100 { border-color: var(--primary-100); }
    .bg-primary-100\/20 { background-color: rgba(46, 204, 113, 0.2); }
    .bg-accent-100\/20 { background-color: rgba(52, 152, 219, 0.2); }
</style>
@endpush
