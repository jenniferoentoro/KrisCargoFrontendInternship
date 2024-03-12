@extends('layouts.app')

@section('title', 'JOA')

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
                    <h1 style="text-align: center;">JOA</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('dash-joa') }}</div>
                </div>
            </div>
            <div style="margin-top: 5px;" class="row">
                <x-card-menu name="Pra JOA" :href="url('prajoa')" :img="'<i class=\'fa-solid fa-money-check-dollar fa-2xl\'></i>'" />
                    <x-card-menu name="Aproval" :href="url('aproval')" :img="'<i class=\'fa-solid fa-file fa-2xl\'></i>'" />
                    <x-card-menu name="Penawaran" :href="url('penawaran')" :img="'<i class=\'fa-solid fa-rectangle-list fa-2xl\'></i>'" />
                    <x-card-menu name="Acc Customer" :href="url('acccustomer')" :img="'<i class=\'fa-solid fa-clipboard-check fa-2xl\'></i>'" />
                    <x-card-menu name="JOA" :href="url('joa')" :img="'<i class=\'fa-solid fa-money-check-dollar fa-2xl\'></i>'" />
                
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
