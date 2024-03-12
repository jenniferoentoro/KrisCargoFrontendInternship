@extends('layouts.app')

@section('title', 'Product')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet"
        href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <div class="main-content">
        <br/>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 style="text-align: center;">Product</h1>
                <div style="margin-top: 15px;">{{ Breadcrumbs::render('product') }}</div>
                
            </div>
        </div>

        <div style="margin-top: 5px;"  class="row">

            <x-card-menu name="Kategori" :href="route('kategori')" :img="'<i class=\'fa-solid fa-layer-group fa-2xl\'></i>'" />
            <x-card-menu name="Jenis Barang" :href="route('jenisbarang')" :img="'<i class=\'fa-solid fa-box-archive fa-2xl\'></i>'" />
            <x-card-menu name="Harga Curah" :href="route('hargacurah')" :img="'<i class=\'fa-solid fa-tag fa-2xl\'></i>'" />
            <x-card-menu name="Jenis Container (full)" :href="route('jeniscontainer')" :img="'<i class=\'fa-solid fa-boxes-stacked fa-2xl\'></i>'" />
            <x-card-menu name="Harga Full" :href="route('hargafull')" :img="'<i class=\'fa-solid fa-tags fa-2xl\'></i>'" />
            <x-card-menu name="Harga Per Customer" :href="route('hargapercustomer')" :img="'<i class=\'fa-solid fa-hand-holding-dollar fa-2xl\'></i>'" />

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
