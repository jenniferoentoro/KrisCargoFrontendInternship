@extends('layouts.app')

@section('title', 'Accounting')

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
                    <h1 style="text-align: center;">Accounting</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('accounting') }}</div>

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
            'Account' => [
                ['text', 'Nama Account', [], 'NAMA_ACCOUNT', 'required'],
                ['dropdown', 'Induk', $array_induk_dropdown, 'INDUK', ''],
                ['dropdown', 'Detil', $array_detil_dropdown, 'DETIL', 'required'],
                ['dropdown', 'Kelompok Biaya', $array_cost_group_dropdown, 'KODE_COST_GROUP', 'required'],
                ['text', 'Keterangan', [], 'KETERANGAN', 'required'],
            ],
        ],
        'submit_route_name' => 'accounting.store',
    ])


    @include('components.modal-edit', [
        'input_fields' => [
            'Account' => [
                ['text', 'Nama Account', [], 'NAMA_ACCOUNT', 'required'],
                ['dropdown', 'Induk', $array_induk_dropdown, 'INDUK', ''],
                ['dropdown', 'Detil', $array_detil_dropdown, 'DETIL', 'required'],
                ['dropdown', 'Kelompok Biaya', $array_cost_group_dropdown, 'KODE_COST_GROUP', 'required'],
                ['text', 'Keterangan', [], 'KETERANGAN', 'required'],
            ],
        ],
        'submit_route_name' => 'accounting.update',
    ])


@endsection


@push('scripts')
    {{-- @include('components.data-table-scripts') --}}
    @include('components.data-table-ajax-scripts', [
        'keys' => $keys,
        'data_route_name' => 'accounting.json',
        'data_adv_route_name' => 'accounting.jsonadv',
    ])
    @include('components.data-table-advance-script')
    @include('components.modal-scripts', [
        'open_modal_edit_route_name' => 'accounting.findByKode',
        'delete_route_name' => 'accounting.delete',
        'next_id_route_name' => 'accounting.getNextId',
        'continue_submit_route_name' => null,
        'continue_edit_submit_route_name' => null,
        'restore_route_name' => 'accounting.restore',
        'trash_route_name' => 'accounting.trash',
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
