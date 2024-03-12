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
                    <h1 style="text-align: center;">HPP</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('hargalcl') }}</div>

                </div>
            </div>
            <div style="margin: top 5px;" class="row">
                <x-card-menu name="Kelompok Biaya" :href="route('costgroup')" :img="'<i class=\'fa-solid fa-wallet fa-2xl\'></i>'" />
                <x-card-menu name="Jenis Biaya" :href="route('costtype')" :img="'<i class=\'fa-solid fa-filter-circle-dollar fa-2xl\'></i>'" />
                <x-card-menu name="Nama Biaya" :href="route('cost')" :img="'<i class=\'fa-solid fa-hand-holding-dollar fa-2xl\'></i>'" />
                <x-card-menu name="HPP Biaya" :href="route('costrate')" :img="'<i class=\'fa-solid fa-money-check-dollar fa-2xl\'></i>'" />
                <x-card-menu name="HPP THC & LOLO POL" :href="route('thclolopol')" :img="'<i class=\'fa-solid fa-helmet-safety fa-2xl\'></i>'" />
                <x-card-menu name="HPP THC & LOLO POD" :href="route('thclolopod')" :img="'<i class=\'fa-solid fa-helmet-safety fa-2xl\'></i>'" />







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
