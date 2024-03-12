@extends('layouts.app')

@section('title', 'Harga LCL')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <br />
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 style="text-align: center;">Harga LCL</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('hargalclfix') }}</div>

                </div>
            </div>
            <div style="margin: top 5px;" class="row">
                <x-card-menu name="Rumus" :href="route('formula')" :img="'<i class=\'fa-solid fa-calculator fa-2xl\'></i>'" />
                <x-card-menu name="Kategori" :href="route('category')" :img="'<i class=\'fa-solid fa-object-ungroup fa-2xl\'></i>'" />
                <x-card-menu name="Satuan" :href="route('unit')" :img="'<i class=\'fa-solid fa-braille fa-2xl\'></i>'" />
                <x-card-menu name="Produk" :href="route('product')" :img="'<i class=\'fa-solid fa-truck-ramp-box fa-2xl\'></i>'" />
                <x-card-menu name="Harga LCL" :href="route('specialprice')" :img="'<i class=\'fa-solid fa-money-bill-1-wave fa-2xl\'></i>'" />
                






            </div>
        </div>
    </div>




@endsection

@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
