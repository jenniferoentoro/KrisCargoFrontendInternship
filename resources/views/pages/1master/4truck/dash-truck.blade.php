@extends('layouts.app')

@section('title', 'Rute')

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
                    <h1 style="text-align: center;">Truck</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('dash-truck') }}</div>

                </div>
            </div>
            <div style="margin: top 5px;" class="row">
                {{-- <x-card-menu name="Pelabuhan" :href="route('pelabuhan')" :img="'<i class=\'fa-solid fa-anchor fa-2xl\'></i>'" /> --}}
                <x-card-menu name="Jenis Truck" :href="route('truck')" :img="'<i class=\'fa-solid fa-truck fa-2xl\'></i>'" />

                <x-card-menu name="Rute Truck" :href="route('rutetruck')" :img="'<i class=\'fa-solid fa-route fa-2xl\'></i>'" />
                <x-card-menu name="Tarif Truck" :href="route('truckprice')" :img="'<i class=\'fa-solid fa-money-bill fa-2xl\'></i>'" />

                {{-- <x-card-menu name="Rute pengiriman" :href="route('rutepengiriman')" :img="'<i class=\'fa-solid fa-route fa-2xl\'></i>'" /> --}}






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
