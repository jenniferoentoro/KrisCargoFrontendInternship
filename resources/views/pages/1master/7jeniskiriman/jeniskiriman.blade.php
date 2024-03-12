@extends('layouts.app')

@section('title', 'Jenis Kiriman')

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
                    <h1 style="text-align: center;">Jenis Kiriman</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('jeniskiriman') }}</div>

                </div>
            </div>
            <div style="margin: top 5px;" class="row">
                <x-card-menu name="Size Container" :href="route('ukuran')" :img="'<i class=\'fa-solid fa-boxes-packing fa-2xl\'></i>'" />
                <x-card-menu name="Jenis Container" :href="route('jeniskontainer')" :img="'<i class=\'fa-solid fa-boxes-stacked fa-2xl\'></i>'" />
                <x-card-menu name="Commodity" :href="route('commodity')" :img="'<i class=\'fa-solid fa-fish fa-2xl\'></i>'" />
                <x-card-menu name="Jenis Order" :href="route('jenisorder')" :img="'<i class=\'fa-solid fa-list-check fa-2xl\'></i>'" />

                <x-card-menu name="Service" :href="route('service')" :img="'<i class=\'fa-solid fa-people-carry-box fa-2xl\'></i>'" />






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
