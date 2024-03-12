@extends('layouts.app')

@section('title', 'Penawaran')

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
                    <h1 style="text-align: center;">Penawaran</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('penawaran') }}</div>
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
                    <div class="row">
                        <div class="col p-0">


                            @include('components.offer-front-form-input', [
                                'input_fields' => [
                                    'Penawaran' => [
                                        ['date', 'Tanggal Quotation', [], 'TANGGAL', ''],
                                        [
                                            'dropdown',
                                            'Rate Status',
                            
                                            ['FLOATING' => 'FLOATING', 'KONTRAK' => 'KONTRAK'],
                            
                                            'RATE_STATUS',
                                            'required',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Jenis Order',
                                            $array_ordertype_dropdown,
                                            'KODE_JENIS_ORDER',
                                            'required',
                                            'FCL',
                                            ['number-master'],
                                            ['KODE_PRAJOA[]'],
                                            [[]],
                                            ['No Prajoa'],
                                            ['prajoa.json'],
                                            [config('prajoa.table_headers')],
                                            [config('prajoa.columns_shown')],
                                            [1],
                                            ['readonly="readonly"'],
                                            ['KODE_PRAJOA'],
                                        ],
                                        [
                                            'dropdown',
                                            'Customer baru / lama',
                                            ['BARU' => 'BARU', 'LAMA' => 'LAMA'],
                                            'CHOOSECUSTOMER',
                                            'required',
                                            'BARU',
                                            ['text', 'text', 'text'],
                                            ['NAMA_CUSTOMER', 'CONTACT_PERSON', 'EMAIL'],
                                            [[], [], []],
                                            ['Nama Customer', 'Contact Person', 'Email'],
                                            'dropdown',
                                            'KODE_CUSTOMER',
                                            $array_customers_dropdown,
                                            'Kode Customer',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Status',
                                            ['F' => 'F', 'N' => 'N'],
                                            'STATUS',
                                            'required',
                                            'F',
                                            ['dropdown', 'dropdown', 'text'],
                                            ['PPN', 'PPN_PERCENTAGE', 'PPH'],
                                            [
                                                ['EXCL' => 'EXCL', 'INCL' => 'INCL'],
                                                ['1.1%' => '1.1%', '11%' => '11%'],
                                                [],
                                            ],
                                            ['PPN', 'PPN PERCENTAGE', 'PPH'],
                                        ],
                                    ],
                                    'Detail Quotation' => [
                                        [
                                            'dropdown',
                                            'POL',
                                            $array_harbor_dropdown,
                                            'KODE_POL[]',
                                            '',
                                            'KODE_POL',
                                            'KODE_POL',
                                        ],
                                        [
                                            'dropdown',
                                            'POD',
                                            $array_harbor_dropdown,
                                            'KODE_POD[]',
                                            '',
                                            'KODE_POD',
                                            'KODE_POD',
                                        ],
                                        [
                                            'dropdown',
                                            'Door POL',
                                            $array_truckroutes_dropdown,
                                            'KODE_DOOR_POL[]',
                                            '',
                                            'KODE_DOOR_POL',
                                        ],
                                        [
                                            'dropdown',
                                            'Door POD',
                                            $array_truckroutes_dropdown,
                                            'KODE_DOOR_POD[]',
                                            '',
                                            'KODE_DOOR_POD',
                                        ],
                                        [
                                            'dropdown',
                                            'UK Container',
                                            $array_size_dropdown,
                                            'KODE_UK_KONTAINER[]',
                                            '',
                                            'KODE_UK_KONTAINER',
                                            'KODE_UK_KONTAINER',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Jenis Container',
                                            $array_containertype_dropdown,
                                            'KODE_JENIS_CONTAINER[]',
                                            '',
                                            'KODE_JENIS_CONTAINER',
                                            'KODE_JENIS_CONTAINER',
                                        ],
                                        [
                                            'dropdown',
                                            'Commodity',
                                            $array_commodity_dropdown,
                                            'KODE_COMMODITY[]',
                                            'required',
                                            'KODE_COMMODITY',
                                        ],
                                        [
                                            'dropdown',
                                            'Service',
                                            $array_service_dropdown,
                                            'KODE_SERVICE[]',
                                            'required',
                                            'KODE_SERVICE',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Stuffing',
                                            ['DALAM' => 'DALAM', 'LUAR' => 'LUAR', '-' => '-'],
                                            'STUFFING[]',
                                            '',
                                            'STUFFING',
                                            'STUFFING',
                                        ],
                                        [
                                            'dropdown',
                                            'Stripping',
                                            ['DALAM' => 'DALAM', 'LUAR' => 'LUAR', '-' => '-'],
                                            'STRIPPING[]',
                                            '',
                                            'STRIPPING',
                                            'STRIPPING',
                                        ],
                                        [
                                            'dropdown',
                                            'Buruh Muat',
                                            ['INCL' => 'INCL', 'EXCL' => 'EXCL'],
                                            'BURUH_MUAT[]',
                                            'required',
                                            'BURUH_MUAT',
                                        ],
                                        [
                                            'dropdown',
                                            'Buruh Salin',
                                            ['INCL' => 'INCL', 'EXCL' => 'EXCL'],
                                            'BURUH_SALIN[]',
                                            '',
                                            'INCL',
                                            ['dropdown'],
                                            ['BURUH_SALIN_KET[]'],
                                            [['Alat' => 'Alat', 'Manual' => 'Manual']],
                                            ['Pilihan Buruh Salin'],
                                            ['BURUH_SALIN_KET'],
                                            ['BURUH_SALIN_KET'],
                                            'BURUH_SALIN',
                                            'BURUH_SALIN',
                                            'addmore',
                                        ],
                                        [
                                            'dropdown',
                                            'Buruh Bongkar',
                                            ['INCL' => 'INCL', 'EXCL' => 'EXCL'],
                                            'BURUH_BONGKAR[]',
                                            'required',
                                            'INCL',
                                            ['dropdown'],
                                            ['BURUH_MUAT_KET[]'],
                                            [['Alat' => 'Alat', 'Manual' => 'Manual']],
                                            ['Pilihan Buruh Bongkar'],
                                            ['BURUH_MUAT_KET'],
                                            ['BURUH_MUAT_KET'],
                                            'BURUH_BONGKAR',
                                            'BURUH_BONGKAR',
                                            'addmore',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Asuransi',
                                            ['YA' => 'YA', 'TIDAK' => 'TIDAK'],
                                            'ASURANSI[]',
                                            'required',
                                            'YA',
                                            ['number-decimal', 'number'],
                                            ['TSI[]', 'TSI_NOMINAL[]'],
                                            [[], []],
                                            ['% TSI', 'TSI Nominal'],
                                            ['TSI', 'TSI_NOMINAL'],
                                            ['TSI', 'TSI_NOMINAL'],
                                            'ASURANSI',
                                            'ASURANSI',
                                            'addmore',
                                        ],
                                        [
                                            'text',
                                            'Free Time Storage',
                                            [],
                                            'FREE_TIME_STORAGE[]',
                                            'required',
                                            'FREE_TIME_STORAGE',
                                        ],
                                        [
                                            'text',
                                            'Free Time Demurrage',
                                            [],
                                            'FREE_TIME_DEMURRAGE[]',
                                            'required',
                                            'FREE_TIME_DEMURRAGE',
                                        ],
                            
                                        // [
                                        //     'number-master',
                                        //     'HARGA[]',
                                        //     [],
                                        //     'Harga',
                                        //     'penawaran.truckprice',
                                        //     config('penawaran.table_headers_truck_price'),
                                        //     config('penawaran.columns_shown_truck_price'),
                                        //     7,
                                        //     'required',
                                        //     'penawaran.hargalcl',
                                        //     config('penawaran.table_headers_harga_lcl'),
                                        //     config('penawaran.columns_shown_harga_lcl'),
                                        //     'HARGA',
                                        // ],
                            
                                        [
                                            'number-master',
                                            'HARGA[]',
                                            [],
                                            'Harga',
                                            'prajoa.json',
                                            config('less-prajoa.table_headers'),
                                            config('less-prajoa.columns_shown'),
                                            7,
                                            'required',
                                            'specialprice.json',
                                            config('specialprice.table_headers'),
                                            config('specialprice.columns_shown'),
                                            'HARGA',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Satuan Harga',
                                            $array_unit_dropdown,
                                            'SATUAN_HARGA[]',
                                            '',
                                            'SATUAN_HARGA',
                                            'SATUAN_HARGA',
                                        ],
                                    ],
                                    'Informasi Lain' => [
                                        [
                                            'dropdown',
                                            'Payment',
                                            [
                                                'SEBELUM BONGKAR' => 'SEBELUM BONGKAR',
                                                'SETELAH BONGKAR' => 'SETELAH BONGKAR',
                                                'COD' => 'COD',
                                            ],
                                            'PAYMENT',
                                            'required',
                                        ],
                                        ['number', 'TOP', [], 'TOP', 'required'],
                            
                                        ['textarea', 'Keterangan TOP', [], 'KETERANGAN_TOP', 'required'],
                            
                                        ['textarea', 'Keterangan Tambahan', [], 'KETERANGAN_TAMBAHAN', ''],
                                        ['dropdown', 'Sales', $array_sales_dropdown, 'SALES', 'required'],
                                    ],
                                ],
                                'submit_route_name' => 'penawaran.store',
                            ])

                            @include('components.offer-front-form-edit', [
                                'input_fields' => [
                                    'Penawaran' => [
                                        ['date', 'Tanggal Quotation', [], 'TANGGAL', ''],
                                        [
                                            'dropdown',
                                            'Rate Status',
                            
                                            ['FLOATING' => 'FLOATING', 'KONTRAK' => 'KONTRAK'],
                            
                                            'RATE_STATUS',
                                            'required',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Jenis Order',
                                            $array_ordertype_dropdown,
                                            'KODE_JENIS_ORDER',
                                            'required',
                                            'FCL',
                                            ['number-master'],
                                            ['KODE_PRAJOA[]'],
                                            [[]],
                                            ['No Prajoa'],
                                            ['prajoa.json'],
                                            [config('prajoa.table_headers')],
                                            [config('prajoa.columns_shown')],
                                            [1],
                                            ['readonly="readonly"'],
                                            ['KODE_PRAJOA'],
                                        ],
                                        [
                                            'dropdown',
                                            'Customer baru / lama',
                                            ['BARU' => 'BARU', 'LAMA' => 'LAMA'],
                                            'CHOOSECUSTOMER',
                                            'required',
                                            'BARU',
                                            ['text', 'text', 'text'],
                                            ['NAMA_CUSTOMER', 'CONTACT_PERSON', 'EMAIL'],
                                            [[], [], []],
                                            ['Nama Customer', 'Contact Person', 'Email'],
                                            'dropdown',
                                            'KODE_CUSTOMER',
                                            $array_customers_dropdown,
                                            'Kode Customer',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Status',
                                            ['F' => 'F', 'N' => 'N'],
                                            'STATUS',
                                            'required',
                                            'F',
                                            ['dropdown', 'dropdown', 'text'],
                                            ['PPN', 'PPN_PERCENTAGE', 'PPH'],
                                            [
                                                ['EXCL' => 'EXCL', 'INCL' => 'INCL'],
                                                ['1.1%' => '1.1%', '11%' => '11%'],
                                                [],
                                            ],
                                            ['PPN', 'PPN PERCENTAGE', 'PPH'],
                                        ],
                                    ],
                                    'Detail Quotation' => [
                                        [
                                            'dropdown',
                                            'POL',
                                            $array_harbor_dropdown,
                                            'KODE_POL[]',
                                            '',
                                            'KODE_POL',
                                            'KODE_POL',
                                        ],
                                        [
                                            'dropdown',
                                            'POD',
                                            $array_harbor_dropdown,
                                            'KODE_POD[]',
                                            '',
                                            'KODE_POD',
                                            'KODE_POD',
                                        ],
                                        [
                                            'dropdown',
                                            'Door POL',
                                            $array_truckroutes_dropdown,
                                            'KODE_DOOR_POL[]',
                                            '',
                                            'KODE_DOOR_POL',
                                        ],
                                        [
                                            'dropdown',
                                            'Door POD',
                                            $array_truckroutes_dropdown,
                                            'KODE_DOOR_POD[]',
                                            '',
                                            'KODE_DOOR_POD',
                                        ],
                                        [
                                            'dropdown',
                                            'UK Container',
                                            $array_size_dropdown,
                                            'KODE_UK_KONTAINER[]',
                                            '',
                                            'KODE_UK_KONTAINER',
                                            'KODE_UK_KONTAINER',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Jenis Container',
                                            $array_containertype_dropdown,
                                            'KODE_JENIS_CONTAINER[]',
                                            '',
                                            'KODE_JENIS_CONTAINER',
                                            'KODE_JENIS_CONTAINER',
                                        ],
                                        [
                                            'dropdown',
                                            'Commodity',
                                            $array_commodity_dropdown,
                                            'KODE_COMMODITY[]',
                                            'required',
                                            'KODE_COMMODITY',
                                        ],
                                        [
                                            'dropdown',
                                            'Service',
                                            $array_service_dropdown,
                                            'KODE_SERVICE[]',
                                            'required',
                                            'KODE_SERVICE',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Stuffing',
                                            ['DALAM' => 'DALAM', 'LUAR' => 'LUAR', '-' => '-'],
                                            'STUFFING[]',
                                            '',
                                            'STUFFING',
                                            'STUFFING',
                                        ],
                                        [
                                            'dropdown',
                                            'Stripping',
                                            ['DALAM' => 'DALAM', 'LUAR' => 'LUAR', '-' => '-'],
                                            'STRIPPING[]',
                                            '',
                                            'STRIPPING',
                                            'STRIPPING',
                                        ],
                                        [
                                            'dropdown',
                                            'Buruh Muat',
                                            ['INCL' => 'INCL', 'EXCL' => 'EXCL'],
                                            'BURUH_MUAT[]',
                                            'required',
                                            'BURUH_MUAT',
                                        ],
                                        [
                                            'dropdown',
                                            'Buruh Salin',
                                            ['INCL' => 'INCL', 'EXCL' => 'EXCL'],
                                            'BURUH_SALIN[]',
                                            '',
                                            'INCL',
                                            ['dropdown'],
                                            ['BURUH_SALIN_KET[]'],
                                            [['Alat' => 'Alat', 'Manual' => 'Manual']],
                                            ['Pilihan Buruh Salin'],
                                            ['BURUH_SALIN_KET'],
                                            ['BURUH_SALIN_KET'],
                                            'BURUH_SALIN',
                                            'BURUH_SALIN',
                                            'addmore',
                                        ],
                                        [
                                            'dropdown',
                                            'Buruh Bongkar',
                                            ['INCL' => 'INCL', 'EXCL' => 'EXCL'],
                                            'BURUH_BONGKAR[]',
                                            'required',
                                            'INCL',
                                            ['dropdown'],
                                            ['BURUH_MUAT_KET[]'],
                                            [['Alat' => 'Alat', 'Manual' => 'Manual']],
                                            ['Pilihan Buruh Bongkar'],
                                            ['BURUH_MUAT_KET'],
                                            ['BURUH_MUAT_KET'],
                                            'BURUH_BONGKAR',
                                            'BURUH_BONGKAR',
                                            'addmore',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Asuransi',
                                            ['YA' => 'YA', 'TIDAK' => 'TIDAK'],
                                            'ASURANSI[]',
                                            'required',
                                            'YA',
                                            ['number-decimal', 'number'],
                                            ['TSI[]', 'TSI_NOMINAL[]'],
                                            [[], []],
                                            ['% TSI', 'TSI Nominal'],
                                            ['TSI', 'TSI_NOMINAL'],
                                            ['TSI', 'TSI_NOMINAL'],
                                            'ASURANSI',
                                            'ASURANSI',
                                            'addmore',
                                        ],
                                        [
                                            'text',
                                            'Free Time Storage',
                                            [],
                                            'FREE_TIME_STORAGE[]',
                                            'required',
                                            'FREE_TIME_STORAGE',
                                        ],
                                        [
                                            'text',
                                            'Free Time Demurrage',
                                            [],
                                            'FREE_TIME_DEMURRAGE[]',
                                            'required',
                                            'FREE_TIME_DEMURRAGE',
                                        ],
                            
                                        [
                                            'number-master',
                                            'HARGA[]',
                                            [],
                                            'Harga',
                                            'prajoa.json',
                                            config('less-prajoa.table_headers'),
                                            config('less-prajoa.columns_shown'),
                                            7,
                                            'required',
                                            'specialprice.json',
                                            config('specialprice.table_headers'),
                                            config('specialprice.columns_shown'),
                                            'HARGA',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Satuan Harga',
                                            $array_unit_dropdown,
                                            'SATUAN_HARGA[]',
                                            '',
                                            'SATUAN_HARGA',
                                            'SATUAN_HARGA',
                                        ],
                                    ],
                                    'Informasi Lain' => [
                                        [
                                            'dropdown',
                                            'Payment',
                                            [
                                                'SEBELUM BONGKAR' => 'SEBELUM BONGKAR',
                                                'SETELAH BONGKAR' => 'SETELAH BONGKAR',
                                                'COD' => 'COD',
                                            ],
                                            'PAYMENT',
                                            'required',
                                        ],
                                        ['number', 'TOP', [], 'TOP', 'required'],
                            
                                        ['textarea', 'Keterangan TOP', [], 'KETERANGAN_TOP', 'required'],
                            
                                        ['textarea', 'Keterangan Tambahan', [], 'KETERANGAN_TAMBAHAN', ''],
                                        ['dropdown', 'Sales', $array_sales_dropdown, 'SALES', 'required'],
                                    ],
                                ],
                                'submit_route_name' => 'penawaran.update',
                            ])
                        </div>

                    </div>
                </div>

            </div>


            @include('components.offer-data-table', [
                'columns' => $table_headers,
                'keys' => $keys,
            ])



            <br><br>


        </div>
    </div>


    @include('components.modal-data-table')

    @include('components.modal-trashbin')








@endsection

@push('scripts')
    @include('components.data-table-scripts')
    @include('components.data-table-advance-script')
    @include('components.modal-data-table-ajax-scripts')
    @include('components.offer-front-form-scripts', [
        'open_modal_edit_route_name' => 'penawaran.findByKode',
        'delete_route_name' => 'penawaran.delete',
        'next_id_route_name' => 'penawaran.getNextId',
        'continue_submit_route_name' => null,
        'continue_edit_submit_route_name' => null,
        'restore_route_name' => 'penawaran.restore',
        'trash_route_name' => 'penawaran.trash',
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

    <script src="{{ asset('js/page/index-0.js') }}"></script>
    <script>
      
        flatpickr("#TANGGAL", {
            defaultDate: "today", 
            dateFormat: "d-m-Y", 
            disableMobile: "true",
        });




        $('.thclolopod').on('shown.bs.modal', function() {
            $('.thclolopod .dropdownselect2fix').select2();
        });
        $('.thclolopol').on('shown.bs.modal', function() {
            $('.thclolopol .dropdownselect2fix').select2();
        });

        $('.addValueTHCPOD').on('click', function() {
            openLoadingModal();
            $.ajax({
                url: "{{ route('thclolo.getNextId') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log(response);

                        var nextKode = response.data;
                        var form = $('.addnewValueModal form')[0];
                        $('.addKodeValuethclolopod').val(nextKode);
                        var modal = $('.thclolopod')[0];
                        modal.style.display = 'block';
                        $(modal.querySelector('.modal-content')).addClass(
                            'animate__bounceInDown');

                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                },
                complete: function() {
                    closeLoadingModal();



                }
            });

            $('.thclolopod .dropdownselect2fix').select2({
                    searchInputPlaceholder: 'Ketik disini untuk mencari...',
                    dropdownParent: $('.thclolopod')
                }

            );

        });

        $('.addValueTHCPOL').on('click', function() {


            openLoadingModal();

            $.ajax({
                url: "{{ route('thclolo.getNextId') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log(response);

                        var nextKode = response.data;
                        var form = $('.addnewValueModal form')[0];
                        $('.addKodeValuethclolopol').val(nextKode);
                        var modal = $('.thclolopol')[0];
                        modal.style.display = 'block';
                        $(modal.querySelector('.modal-content')).addClass(
                            'animate__bounceInDown');

                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                },
                complete: function() {
                    closeLoadingModal();



                }
            });

            $('.thclolopol .dropdownselect2fix').select2({
                    searchInputPlaceholder: 'Ketik disini untuk mencari...',
                    dropdownParent: $('.thclolopol')
                }

            );

        });

        $('.addValueCostRate').on('click', function() {
            openLoadingModal();
            $.ajax({
                url: "{{ route('costrate.getNextId') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log(response);
                        var nextKode = response.data;
                        var form = $('.addnewValueModal form')[0];
                        $('.addKodeValuecostrate').val(nextKode);
                        var modal = $('.costrate')[0];
                        modal.style.display = 'block';
                        $(modal.querySelector('.modal-content')).addClass(
                            'animate__bounceInDown');
                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                },
                complete: function() {
                    closeLoadingModal();



                }
            });

            $('.costrate .dropdownselect2fix').select2({
                    searchInputPlaceholder: 'Ketik disini untuk mencari...',
                    dropdownParent: $('.costrate')
                }

            );

        });


        $('.addValueTruckRoute').on('click', function() {

            openLoadingModal();

            $.ajax({
                url: "{{ route('rutetruck.getNextId') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log(response);

                        var nextKode = response.data;
                        var form = $('.addnewValueModal form')[0];
                        $('.addKodeValuerutetruck').val(nextKode);
                        var modal = $('.rutetruck')[0];
                        modal.style.display = 'block';
                        $(modal.querySelector('.modal-content')).addClass(
                            'animate__bounceInDown');

                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                },
                complete: function() {
                    closeLoadingModal();



                }
            });

            $('.rutetruck .dropdownselect2fix').select2({
                    searchInputPlaceholder: 'Ketik disini untuk mencari...',
                    dropdownParent: $('.rutetruck')
                }

            );

        });



        $('.closethclolopol').on('click', function() {

            var modal = $('.thclolopol')[0];
            modal.querySelector('.modal-content').classList.remove(
                'animate__bounceInDown');
            modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
            setTimeout(function() {
                modal.style.display = 'none';
                modal.querySelector('.modal-content').classList.remove(
                    'animate__fadeOutUp');
            }, 1000);
        });

        $('.closethclolopod').on('click', function() {

            var modal = $('.thclolopod')[0];
            modal.querySelector('.modal-content').classList.remove(
                'animate__bounceInDown');
            modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
            setTimeout(function() {
                modal.style.display = 'none';
                modal.querySelector('.modal-content').classList.remove(
                    'animate__fadeOutUp');
            }, 1000);
        });

        $('.closerutetruck').on('click', function() {

            var modal = $('.rutetruck')[0];
            modal.querySelector('.modal-content').classList.remove(
                'animate__bounceInDown');
            modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
            setTimeout(function() {
                modal.style.display = 'none';
                modal.querySelector('.modal-content').classList.remove(
                    'animate__fadeOutUp');
            }, 1000);
        });

        $('.closecostrate').on('click', function() {

            var modal = $('.costrate')[0];
            modal.querySelector('.modal-content').classList.remove(
                'animate__bounceInDown');
            modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
            setTimeout(function() {
                modal.style.display = 'none';
                modal.querySelector('.modal-content').classList.remove(
                    'animate__fadeOutUp');
            }, 1000);
        });

        $('#resetthclolopol').click(function() {
            // Store the value of KODE field
            var kodeValue = $('.addKodeValuethclolopol').val();

            // Reset the form (this will clear all inputs)
            $('.addDatathclolopol')[0].reset();

            $('.addDatathclolopol input').removeClass('is-invalid');
            $('.addDatathclolopol .error-message').remove();

            // Set the value of KODE field back to its original value
            $('.addKodeValuethclolopol').val(kodeValue);

            // clear image preview
            $('.addDatathclolopol .image-preview img').attr('src', '');
            $('.addDatathclolopol .link-preview a').attr('href', '');
            $('.addDatathclolopol .link-preview a').text('');

        });

        $('#resetthclolopod').click(function() {
            // Store the value of KODE field
            var kodeValue = $('.addKodeValuethclolopod').val();

            // Reset the form (this will clear all inputs)
            $('.addDatathclolopod')[0].reset();

            $('.addDatathclolopod input').removeClass('is-invalid');
            $('.addDatathclolopod .error-message').remove();

            // Set the value of KODE field back to its original value
            $('.addKodeValuethclolopod').val(kodeValue);

            // clear image preview
            $('.addDatathclolopod .image-preview img').attr('src', '');
            $('.addDatathclolopod .link-preview a').attr('href', '');
            $('.addDatathclolopod .link-preview a').text('');

        });

        $('#resetcostrate').click(function() {
            // Store the value of KODE field
            var kodeValue = $('.addKodeValuecostrate').val();

            // Reset the form (this will clear all inputs)
            $('.addDatacostrate')[0].reset();

            $('.addDatacostrate input').removeClass('is-invalid');
            $('.addDatacostrate .error-message').remove();

            // Set the value of KODE field back to its original value
            $('.addKodeValuecostrate').val(kodeValue);

            // clear image preview
            $('.addDatacostrate .image-preview img').attr('src', '');
            $('.addDatacostrate .link-preview a').attr('href', '');
            $('.addDatacostrate .link-preview a').text('');

        });

        $('#resetrutetruck').click(function() {
            // Store the value of KODE field
            var kodeValue = $('.addKodeValuerutetruck').val();

            // Reset the form (this will clear all inputs)
            $('.addDatarutetruck')[0].reset();

            $('.addDatarutetruck input').removeClass('is-invalid');
            $('.addDatarutetruck .error-message').remove();

            // Set the value of KODE field back to its original value
            $('.addKodeValuerutetruck').val(kodeValue);

            // clear image preview
            $('.addDatarutetruck .image-preview img').attr('src', '');
            $('.addDatarutetruck .link-preview a').attr('href', '');
            $('.addDatarutetruck .link-preview a').text('');

        });
    </script>
@endpush
