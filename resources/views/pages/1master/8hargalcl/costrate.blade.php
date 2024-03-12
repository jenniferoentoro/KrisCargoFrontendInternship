@extends('layouts.app')

@section('title', 'HPP Biaya')

@push('style')
    <!-- CSS Libraries -->

    @include('components.dashboard-styles')
@endpush

@section('main')
    <div class="main-content">
        <br />
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 style="text-align: center;">HPP Biaya</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('costrate') }}</div>

                </div>
            </div>
            <div>
                <div>
                    <div class="row">
                        <div class="col-4">
                            <div id="addDataButtonContainer">
                                <button id="addDataButton" class="btn btn-primary mb-3">+ Add data</button>
                            </div>
                        </div>
                        <div class="col-4">
                        </div>
                        <div class="col-4" align="right">
                            <div id="AdvanceMode">
                                <button id="" class="trashbin btn btn-danger mb-3">Trash Bin</button>
                                <button id="advance" class="btn btn-primary mb-3">Advanced</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            @include('components.data-table', [
                'columns' => $table_headers,
                'keys' => $keys,
            ])



            <br><br>


        </div>
    </div>
    @include('components.modal-trashbin')

    @include('components.modal-input', [
        'input_fields' => [
            'HPP Biaya' => [
                ['dropdown', 'Nama Biaya', $array_cost_dropdown, 'KODE_BIAYA', 'required'],
                ['dropdown', 'Vendor', $array_vendor_dropdown, 'KODE_VENDOR', 'required'],
                ['dropdown', 'Pelabuhan Asal', $array_pelabuhan_dropdown, 'KODE_PELABUHAN_ASAL', ''],
                ['dropdown', 'Pelabuhan Tujuan', $array_pelabuhan_dropdown, 'KODE_PELABUHAN_TUJUAN', ''],
    
                ['dropdown', 'Commodity', $array_commodity_dropdown, 'KODE_COMMODITY', ''],
                ['dropdown', 'Ukuran Kontainer', $array_cost_ukuran_dropdown, 'UK_KONTAINER', ''],
                ['number', 'Tarif', [], 'TARIF', 'required'],
                ['date', 'TGL Berlaku', [], 'TGL_BERLAKU', 'required'],
    
                ['text', 'Keterangan', [], 'KETERANGAN', 'required'],
                ['dropdown', 'Customer', $array_customers_dropdown, 'KODE_CUSTOMER', 'required'],
            ],
        ],
        'submit_route_name' => 'costrate.store',
    ])


    @include('components.modal-edit', [
        'input_fields' => [
            'HPP Biaya' => [
                ['dropdown', 'Nama Biaya', $array_cost_dropdown, 'KODE_BIAYA', 'required'],
                ['dropdown', 'Vendor', $array_vendor_dropdown, 'KODE_VENDOR', 'required'],
                ['dropdown', 'Pelabuhan Asal', $array_pelabuhan_dropdown, 'KODE_PELABUHAN_ASAL', ''],
                ['dropdown', 'Pelabuhan Tujuan', $array_pelabuhan_dropdown, 'KODE_PELABUHAN_TUJUAN', ''],
    
                ['dropdown', 'Commodity', $array_commodity_dropdown, 'KODE_COMMODITY', ''],
                ['dropdown', 'Ukuran Kontainer', $array_cost_ukuran_dropdown, 'UK_KONTAINER', ''],
                ['number', 'Tarif', [], 'TARIF', 'required'],
                ['date', 'TGL Berlaku', [], 'TGL_BERLAKU', 'required'],
    
                ['text', 'Keterangan', [], 'KETERANGAN', 'required'],
                ['dropdown', 'Customer', $array_customers_dropdown, 'KODE_CUSTOMER', 'required'],
            ],
        ],
        'submit_route_name' => 'costrate.update',
    ])


@endsection


@push('scripts')
    {{-- @include('components.data-table-scripts') --}}
    @include('components.data-table-ajax-scripts', [
        'keys' => $keys,
        'data_route_name' => 'costrate.json',
        'data_adv_route_name' => 'costrate.jsonadv',
    ])
    @include('components.data-table-advance-script')
    @include('components.modal-scripts', [
        'open_modal_edit_route_name' => 'costrate.findByKode',
        'delete_route_name' => 'costrate.delete',
        'next_id_route_name' => 'costrate.getNextId',
        'continue_submit_route_name' => null,
        'continue_edit_submit_route_name' => null,
        'restore_route_name' => 'costrate.restore',
        'trash_route_name' => 'costrate.trash',
        'columns' => $table_headers,
        'keys' => $keys,
    ])


    <!-- Page Specific JS File -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>


    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
