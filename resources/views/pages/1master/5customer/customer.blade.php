@extends('layouts.app')

@section('title', 'Customer')

@push('style')
    @include('components.dashboard-styles')
@endpush

@section('main')
    <div class="main-content">
        <br />
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 style="text-align: center;">Customer</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('customer') }}</div>

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

    @include('components.modal-input', [
        'input_fields' => [
            'Data Customer' => [
                ['dropdown', 'Customer Group', $array_customergroup_dropdown, 'KODE_GROUP', 'required'],
    
                ['text', 'Nama', [], 'NAMA', 'required'],
                ['dropdown', 'Jenis Usaha', $array_businesstype_dropdown, 'KODE_USAHA', 'required'],
    
                [
                    'dropdown',
                    'Badan Hukum',
                    ['PT' => 'PT', 'CV' => 'CV', 'UD' => 'UD', 'LL' => 'LL'],
                    'BADAN_HUKUM',
                    'required',
                ],
                ['dropdown', 'Status', ['F' => 'F', 'N' => 'N'], 'JENIS', 'required'],
    
                ['text', 'Telepon Kantor', [], 'TELP', 'required'],
                ['text', 'HP Kantor', [], 'HP', 'required'],
                ['text', 'Website', [], 'WEBSITE', 'required'],
                ['text', 'Email', [], 'EMAIL', 'required'],
            ],
            'Identitas Customer' => [
                ['text', 'No. KTP', [], 'NO_KTP', 'required'],
                ['text', 'Nama KTP', [], 'NAMA_KTP', 'required'],
                ['text', 'Alamat KTP', [], 'ALAMAT_KTP', 'required'],
                ['text', 'RT KTP', [], 'RT_KTP', 'required'],
                ['text', 'RW KTP', [], 'RW_KTP', 'required'],
                ['text', 'Kelurahan/Desa KTP', [], 'KELURAHAN_KTP', 'required'],
                ['text', 'Kecamatan KTP', [], 'KECAMATAN_KTP', 'required'],
                ['dropdown', 'Kota/Kabupaten KTP', $array_cities_dropdown, 'KODE_KOTA_KTP', 'required'],
                ['file', 'Foto KTP', [], 'FOTO_KTP', ''],
            ],
            'NPWP' => [
                ['text', 'No. NPWP', [], 'NO_NPWP', 'required'],
    
                ['text', 'Nama NPWP', [], 'NAMA_NPWP', 'required'],
                ['text', 'Alamat NPWP', [], 'ALAMAT_NPWP', 'required'],
                ['text', 'RT NPWP', [], 'RT_NPWP', 'required'],
                ['text', 'RW NPWP', [], 'RW_NPWP', 'required'],
                ['text', 'Kelurahan/Desa NPWP', [], 'KELURAHAN_NPWP', 'required'],
                ['text', 'Kecamatan NPWP', [], 'KECAMATAN_NPWP', 'required'],
                ['dropdown', 'Kota/Kabupaten NPWP', $array_cities_dropdown, 'KODE_KOTA_NPWP', 'required'],
                ['file', 'Foto NPWP', [], 'FOTO_NPWP', ''],
            ],
            'Contact Person 1' => [
                ['text', 'Contact Person 1', [], 'CONTACT_PERSON_1', 'required'],
                ['text', 'Jabatan 1', [], 'JABATAN_1', 'required'],
                ['text', 'No. HP 1', [], 'NO_HP_1', 'required'],
                ['text', 'Email 1', [], 'EMAIL_1', 'required'],
            ],
            'Contact Person 2' => [
                ['text', 'Contact Person 2', [], 'CONTACT_PERSON_2', ''],
                ['text', 'Jabatan 2', [], 'JABATAN_2', ''],
                ['text', 'No. HP 2', [], 'NO_HP_2', ''],
                ['text', 'Email 2', [], 'EMAIL_2', ''],
            ],
    
            'Lainnya' => [
                ['dropdown', 'AR', $array_ars_dropdown, 'KODE_AR', 'required'],
                ['dropdown', 'Sales', $array_sales_dropdown, 'KODE_SALES', 'required'],
                // pengirim/penerima/lain
                [
                    'dropdown',
                    'Dibayar Oleh',
                    ['PENGIRIM' => 'PENGIRIM', 'PENERIMA' => 'PENERIMA', 'LAIN' => 'LAIN'],
                    'DIBAYAR',
                    'required',
                ],
                ['dropdown', 'Lokasi Bayar', ['POL' => 'POL', 'POD' => 'POD'], 'LOKASI', 'required'],
                ['number', 'Plafon', [], 'PLAFON', 'required'],
    
                ['number', 'TOP (Hari)', [], 'TOP', 'required'],
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
                ['text', 'Keterangan TOP', [], 'KETERANGAN_TOP', 'required'],
                ['file', 'Form Customer', [], 'FORM_CUSTOMER', ''],
                ['date', 'Tanggal Jadi Customer', [], 'TGL_REG', 'required'],
            ],
        ],
        'submit_route_name' => 'customer.store',
    ])

    @include('components.modal-trashbin')




    @include('components.modal-edit', [
        'input_fields' => [
            'Data Customer' => [
                ['dropdown', 'Customer Group', $array_customergroup_dropdown, 'KODE_GROUP', 'required'],
    
                ['text', 'Nama', [], 'NAMA', 'required'],
                ['dropdown', 'Jenis Usaha', $array_businesstype_dropdown, 'KODE_USAHA', 'required'],
    
                [
                    'dropdown',
                    'Badan Hukum',
                    ['PT' => 'PT', 'CV' => 'CV', 'UD' => 'UD', 'LL' => 'LL'],
                    'BADAN_HUKUM',
                    'required',
                ],
                ['dropdown', 'Status', ['F' => 'F', 'N' => 'N'], 'JENIS', 'required'],
    
                ['text', 'Telepon Kantor', [], 'TELP', 'required'],
                ['text', 'HP Kantor', [], 'HP', 'required'],
                ['text', 'Website', [], 'WEBSITE', 'required'],
                ['text', 'Email', [], 'EMAIL', 'required'],
            ],
            'Identitas Customer' => [
                ['text', 'No. KTP', [], 'NO_KTP', 'required'],
                ['text', 'Nama KTP', [], 'NAMA_KTP', 'required'],
                ['text', 'Alamat KTP', [], 'ALAMAT_KTP', 'required'],
                ['text', 'RT KTP', [], 'RT_KTP', 'required'],
                ['text', 'RW KTP', [], 'RW_KTP', 'required'],
                ['text', 'Kelurahan/Desa KTP', [], 'KELURAHAN_KTP', 'required'],
                ['text', 'Kecamatan KTP', [], 'KECAMATAN_KTP', 'required'],
                ['dropdown', 'Kota/Kabupaten KTP', $array_cities_dropdown, 'KODE_KOTA_KTP', 'required'],
                ['file', 'Foto KTP', [], 'FOTO_KTP', ''],
            ],
            'NPWP' => [
                ['text', 'No. NPWP', [], 'NO_NPWP', 'required'],
    
                ['text', 'Nama NPWP', [], 'NAMA_NPWP', 'required'],
                ['text', 'Alamat NPWP', [], 'ALAMAT_NPWP', 'required'],
                ['text', 'RT NPWP', [], 'RT_NPWP', 'required'],
                ['text', 'RW NPWP', [], 'RW_NPWP', 'required'],
                ['text', 'Kelurahan/Desa NPWP', [], 'KELURAHAN_NPWP', 'required'],
                ['text', 'Kecamatan NPWP', [], 'KECAMATAN_NPWP', 'required'],
                ['dropdown', 'Kota/Kabupaten NPWP', $array_cities_dropdown, 'KODE_KOTA_NPWP', 'required'],
                ['file', 'Foto NPWP', [], 'FOTO_NPWP', ''],
            ],
            'Contact Person 1' => [
                ['text', 'Contact Person 1', [], 'CONTACT_PERSON_1', 'required'],
                ['text', 'Jabatan 1', [], 'JABATAN_1', 'required'],
                ['text', 'No. HP 1', [], 'NO_HP_1', 'required'],
                ['text', 'Email 1', [], 'EMAIL_1', 'required'],
            ],
            'Contact Person 2' => [
                ['text', 'Contact Person 2', [], 'CONTACT_PERSON_2', ''],
                ['text', 'Jabatan 2', [], 'JABATAN_2', ''],
                ['text', 'No. HP 2', [], 'NO_HP_2', ''],
                ['text', 'Email 2', [], 'EMAIL_2', ''],
            ],
    
            'Lainnya' => [
                ['dropdown', 'AR', $array_ars_dropdown, 'KODE_AR', 'required'],
                ['dropdown', 'Sales', $array_sales_dropdown, 'KODE_SALES', 'required'],
                [
                    'dropdown',
                    'Dibayar Oleh',
                    ['PENGIRIM' => 'PENGIRIM', 'PENERIMA' => 'PENERIMA', 'LAIN' => 'LAIN'],
                    'DIBAYAR',
                    'required',
                ],
                ['dropdown', 'Lokasi Bayar', ['POL' => 'POL', 'POD' => 'POD'], 'LOKASI', 'required'],
                ['number', 'Plafon', [], 'PLAFON', 'required'],
    
                ['number', 'TOP (Hari)', [], 'TOP', 'required'],
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
                ['text', 'Keterangan TOP', [], 'KETERANGAN_TOP', 'required'],
                ['file', 'Form Customer', [], 'FORM_CUSTOMER', ''],
                ['date', 'Tanggal Jadi Customer', [], 'TGL_REG', 'required'],
            ],
        ],
        'submit_route_name' => 'customer.update',
    ])


@endsection

@push('scripts')
    {{-- @include('components.data-table-scripts') --}}
    @include('components.data-table-ajax-scripts', [
        'keys' => $keys,
        'data_route_name' => 'customer.json',
        'data_adv_route_name' => 'customer.jsonadv',
    ])
    @include('components.data-table-advance-script')
    @include('components.modal-scripts', [
        'open_modal_edit_route_name' => 'customer.findByKode',
        'delete_route_name' => 'customer.delete',
        'next_id_route_name' => 'customer.getNextId',
        'continue_submit_route_name' => null,
        'continue_edit_submit_route_name' => null,
        'restore_route_name' => 'customer.restore',
        'trash_route_name' => 'customer.trash',
        'columns' => $table_headers,
        'keys' => $keys,
        'files_route_name' => 'customer.getFiles',
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
