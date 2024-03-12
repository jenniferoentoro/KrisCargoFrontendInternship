@extends('layouts.app')

@section('title', 'Vendor')

@push('style')
    @include('components.dashboard-styles')
@endpush


@section('main')
    <div class="main-content">
        <br />
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 style="text-align: center;">Vendor</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('vendor') }}</div>

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
            'Data Vendor' => [
                ['text', 'Nama Vendor', [], 'NAMA', 'required'],
                ['dropdown', 'Jenis Vendor', $array_vendor_types_dropdown, 'KODE_JENIS_VENDOR', 'required'],
                [
                    'dropdown',
                    'Badan Hukum',
                    ['PT' => 'PT', 'CV' => 'CV', 'UD' => 'UD', 'LL' => 'LL'],
                    'BADAN_HUKUM',
                    'required',
                ],
                ['dropdown', 'Status', ['F' => 'F', 'N' => 'N'], 'STATUS', 'required'],
                ['text', 'Telepon Kantor', [], 'TELP_KANTOR', 'required'],
                ['text', 'HP Kantor', [], 'HP_KANTOR', 'required'],
                ['text', 'Website', [], 'WEBSITE', 'required'],
                ['text', 'Email', [], 'EMAIL', 'required'],
            ],
            'Identitas Vendor' => [
                ['text', 'No. KTP', [], 'NO_KTP', 'required'],
                ['text', 'Nama KTP', [], 'NAMA_KTP', 'required'],
                ['text', 'Alamat KTP', [], 'ALAMAT_KTP', 'required'],
                ['text', 'RT', [], 'RT_KTP', 'required'],
                ['text', 'RW', [], 'RW_KTP', 'required'],
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
            'Contact Person' => [
                ['text', 'Nama CP', [], 'CP', 'required'],
                ['text', 'Jabatan CP', [], 'JABATAN_CP', 'required'],
                ['text', 'No. HP CP', [], 'NO_HP_CP', 'required'],
                ['text', 'Email CP', [], 'EMAIL_CP', 'required'],
            ],
            'Lainnya' => [
                ['text', 'Nama Rekening', [], 'NAMA_REKENING', 'required'],
                ['text', 'No. Rekening', [], 'NO_REKENING', 'required'],
                ['text', 'Nama Bank', [], 'NAMA_BANK', 'required'],
                ['text', 'Alamat Bank', [], 'ALAMAT_BANK', 'required'],
                ['text', 'Plafon', [], 'PLAFON', 'required'],
    
                ['text', 'TOP (Hari)', [], 'TOP', 'required'],
                [
                    'dropdown',
                    'Payment',
                    ['SEBELUM' => 'SEBELUM', 'SETELAH' => 'SETELAH', 'COD' => 'COD'],
                    'PAYMENT',
                    'required',
                ],
                ['text', 'Keterangan TOP', [], 'KETERANGAN_TOP', 'required'],
                ['file', 'Form Vendor', [], 'FORM_VENDOR', ''],
                ['date', 'Tanggal Awal Jadi Vendor', [], 'TGL_AWAL_JADI_VENDOR', 'required'],
            ],
        ],
        'submit_route_name' => 'vendor.store',
    ])

    @include('components.modal-trashbin')




    @include('components.modal-edit', [
        'input_fields' => [
            'Data Vendor' => [
                ['text', 'Nama Vendor', [], 'NAMA', 'required'],
                ['dropdown', 'Jenis Vendor', $array_vendor_types_dropdown, 'KODE_JENIS_VENDOR', 'required'],
                [
                    'dropdown',
                    'Badan Hukum',
                    ['PT' => 'PT', 'CV' => 'CV', 'UD' => 'UD', 'LL' => 'LL'],
                    'BADAN_HUKUM',
                    'required',
                ],
                ['dropdown', 'Status', ['F' => 'F', 'N' => 'N'], 'STATUS', 'required'],
                ['text', 'Telepon Kantor', [], 'TELP_KANTOR', 'required'],
                ['text', 'HP Kantor', [], 'HP_KANTOR', 'required'],
                ['text', 'Website', [], 'WEBSITE', 'required'],
                ['text', 'Email', [], 'EMAIL', 'required'],
            ],
            'Identitas Vendor' => [
                ['text', 'No. KTP', [], 'NO_KTP', 'required'],
                ['text', 'Nama KTP', [], 'NAMA_KTP', 'required'],
                ['text', 'Alamat KTP', [], 'ALAMAT_KTP', 'required'],
                ['text', 'RT', [], 'RT_KTP', 'required'],
                ['text', 'RW', [], 'RW_KTP', 'required'],
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
            'Contact Person' => [
                ['text', 'Nama CP', [], 'CP', 'required'],
                ['text', 'Jabatan CP', [], 'JABATAN_CP', 'required'],
                ['text', 'No. HP CP', [], 'NO_HP_CP', 'required'],
                ['text', 'Email CP', [], 'EMAIL_CP', 'required'],
            ],
            'Lainnya' => [
                ['text', 'Nama Rekening', [], 'NAMA_REKENING', 'required'],
                ['text', 'No. Rekening', [], 'NO_REKENING', 'required'],
                ['text', 'Nama Bank', [], 'NAMA_BANK', 'required'],
                ['text', 'Alamat Bank', [], 'ALAMAT_BANK', 'required'],
                ['text', 'Plafon', [], 'PLAFON', 'required'],
    
                ['text', 'TOP (Hari)', [], 'TOP', 'required'],
                [
                    'dropdown',
                    'Payment',
                    ['SEBELUM' => 'SEBELUM', 'SETELAH' => 'SETELAH', 'COD' => 'COD'],
                    'PAYMENT',
                    'required',
                ],
                ['text', 'Keterangan TOP', [], 'KETERANGAN_TOP', 'required'],
                ['file', 'Form Vendor', [], 'FORM_VENDOR', ''],
                ['date', 'Tanggal Awal Jadi Vendor', [], 'TGL_AWAL_JADI_VENDOR', 'required'],
            ],
        ],
        'submit_route_name' => 'vendor.update',
    ])


@endsection

@push('scripts')
    {{-- @include('components.data-table-scripts') --}}
    @include('components.data-table-ajax-scripts', [
        'keys' => $keys,
        'data_route_name' => 'vendor.json',
        'data_adv_route_name' => 'vendor.jsonadv',
    ])
    @include('components.data-table-advance-script')
    @include('components.modal-scripts', [
        'open_modal_edit_route_name' => 'vendor.findByKode',
        'delete_route_name' => 'vendor.delete',
        'next_id_route_name' => 'vendor.getNextId',
        'continue_submit_route_name' => null,
        'continue_edit_submit_route_name' => null,
        'restore_route_name' => 'vendor.restore',
        'trash_route_name' => 'vendor.trash',
        'columns' => $table_headers,
        'keys' => $keys,
        'files_route_name' => 'vendor.getFiles',
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
