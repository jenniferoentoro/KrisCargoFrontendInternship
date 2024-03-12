@extends('layouts.app')

@section('title', 'Master')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')
    <!-- <div class="main-content">
                                            <section class="section">
                                                <div class="section-header">
                                                    <h1>Home</h1>
                                                </div>
                                            </section>
                                        </div> -->

    <div class="main-content">
        <br />
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 style="text-align: center;">Master</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('master') }}</div>
                </div>
            </div>
            <div style="margin-top: 5px;" class="row">
                <x-card-menu name="Management User" :href="route('useracc')" :img="'<i class=\'fa-solid fa-user fa-2xl\'></i>'" />

                <x-card-menu name="Karyawan" :href="route('dash-karyawan')" :img="'<i class=\'fa-solid fa-user fa-2xl\'></i>'" />
                 
                <x-card-menu name="Negara" :href="route('negara')" :img="'<i class=\'fa-solid fa-globe fa-2xl\'></i>'" />
                <x-card-menu name="Provinsi" :href="route('provinsi')" :img="'<i class=\'fa-solid fa-map-location-dot fa-2xl\'></i>'" />
                <x-card-menu name="Kota" :href="route('kota')" :img="'<i class=\'fa-solid fa-building fa-2xl\'></i>'" />
                <x-card-menu name="Lokasi" :href="route('gudang')" :img="'<i class=\'fa-solid fa-warehouse fa-2xl\'></i>'" />
                <x-card-menu name="Pelabuhan" :href="route('pelabuhan')" :img="'<i class=\'fa-solid fa-anchor fa-2xl\'></i>'" />
                <x-card-menu name="Kapal" :href="route('kapal')" :img="'<i class=\'fa-solid fa-ship fa-2xl\'></i>'" />

                <x-card-menu name="Truck" :href="route('dash-truck')" :img="'<i class=\'fa-solid fa-map fa-2xl\'></i>'" />
                <x-card-menu name="Customer" :href="route('dash-customer')" :img="'<i class=\'fa-solid fa-people-roof fa-2xl\'></i>'" />
                <x-card-menu name="Vendor" :href="route('dash-vendor')" :img="'<i class=\'fa-solid fa-user-plus fa-2xl\'></i>'" />
                <x-card-menu name="Jenis Kiriman" :href="route('jeniskiriman')" :img="'<i class=\'fa-solid fa-toolbox fa-2xl\'></i>'" />
                <x-card-menu name="HPP" :href="route('hargalcl')" :img="'<i class=\'fa-solid fa-money-bill fa-2xl\'></i>'" />
                <x-card-menu name="Harga LCL" :href="route('hargalclfix')" :img="'<i class=\'fa-solid fa-money-bill fa-2xl\'></i>'" />
                <x-card-menu name="Accounting" :href="route('accounting')" :img="'<i class=\'fa-solid fa-book-bookmark fa-2xl\'></i>'" />



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
