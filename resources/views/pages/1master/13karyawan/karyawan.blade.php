@extends('layouts.app')

@section('title', 'Karyawan')

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
                    <h1 style="text-align: center;">Karyawan</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('karyawan') }}</div>
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
            'Data Karyawan' => [
                ['text', 'Nama', [], 'NAMA', 'required'],
                ['text', 'Email', [], 'EMAIL', 'required'],
                // ['password', 'Password', [], 'PASSWORD', 'required'],
                // ['password', 'Confirm Password', [], 'CONFIRM_PASSWORD', 'required'],
                ['text', 'Nickname', [], 'NICKNAME', 'required'],
                ['dropdown', 'Jabatan', $array_position_dropdown, 'KODE_JABATAN', 'required'],
                ['dropdown', 'Lokasi', $array_warehouse_dropdown, 'KODE_LOKASI', 'required'],
    
                ['text', 'NIK', [], 'NIK', 'required'],
                ['text', 'No. SIM', [], 'NO_SIM', 'required'],
                ['text', 'Alamat KTP', [], 'ALAMAT_KTP', 'required'],
                ['text', 'Alamat Domisili', [], 'ALAMAT_DOMISILI', 'required'],
                ['date', 'TTL', [], 'TTL', 'required'],
                [
                    'dropdown',
                    'Jenis Kelamin',
                    ['LAKI-LAKI' => 'LAKI-LAKI', 'PEREMPUAN' => 'PEREMPUAN'],
                    'JENIS_KELAMIN',
                    'required',
                ],
                [
                    'dropdown',
                    'Agama',
                    [
                        'ISLAM' => 'ISLAM',
                        'KRISTEN' => 'KRISTEN',
                        'KATOLIK' => 'KATOLIK',
                        'HINDU' => 'HINDU',
                        'BUDDHA' => 'BUDDHA',
                        'KONGHUCU' => 'KONGHUCU',
                    ],
                    'AGAMA',
                    'required',
                ],
                [
                    'dropdown',
                    'Status Pernikahan',
                    ['BELUM MENIKAH' => 'BELUM MENIKAH', 'SUDAH MENIKAH' => 'SUDAH MENIKAH'],
                    'STATUS_PERNIKAHAN',
                    'required',
                ],
                ['number', 'Jumlah Anak', [], 'JUMLAH_ANAK', 'required'],
                ['text', 'No. HP', [], 'NO_HP', 'required'],
                ['text', 'No. HP Kantor', [], 'NO_HP_KANTOR', 'required'],
                ['text', 'No. HP Keluarga', [], 'NO_HP_KELUARGA', 'required'],
                ['text', 'Keterangan Keluarga', [], 'KETERANGAN_KELUARGA', ''],
    
                ['date', 'Tgl Mulai Kerja', [], 'TGL_MULAI_KERJA', 'required'],
                ['date', 'Tgl Selesai Kontrak', [], 'TGL_SELESAI_KONTRAK', 'required'],
                [
                    'dropdown',
                    'Status Karyawan',
                    [
                        'HARIAN' => 'HARIAN',
                        'BULANAN' => 'BULANAN',
                    ],
                    'STATUS_KARYAWAN',
                    'required',
                ],
                ['time', 'Jam Masuk', [], 'JAM_MASUK', 'required'],
                ['time', 'Jam Keluar', [], 'JAM_KELUAR', 'required'],
                ['text', 'Account Number', [], 'ACCOUNT_NUMBER', 'required'],
                ['text', 'Bank', [], 'BANK', 'required'],
                ['text', 'Atas Nama', [], 'ATAS_NAMA', 'required'],
            ],
            'Fasilitas Karyawan' => [
                [
                    'dropdown',
                    'Gaji Pokok',
                    ['HARIAN' => 'HARIAN', 'BULANAN' => 'BULANAN'],
                    'GAJI_POKOK',
                    'required',
                ],
                ['number', 'Gaji Pokok', [], 'DET_GAJI_POKOK', ''],
                [
                    'dropdown',
                    'BPJS Kesehatan',
                    [
                        'PERUSAHAAN' => 'PERUSAHAAN',
                        'MANDIRI' => 'MANDIRI',
                        'ASURANSI' => 'ASURANSI',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'BPJS_KESEHATAN',
                    'required',
                ],
                ['number', 'BPJS Kesehatan', [], 'DET_BPJS_KESEHATAN', ''],
                [
                    'dropdown',
                    'BPJS Ketenagakerjaan',
                    [
                        'PERUSAHAAN' => 'PERUSAHAAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'BPJS_KETENAGAKERJAAN',
                    'required',
                ],
                ['number', 'BPJS Ketenagakerjaan', [], 'DET_BPJS_KETENAGAKERJAAN', ''],
    
                [
                    'dropdown',
                    'Uang Makan',
                    [
                        'HARIAN' => 'HARIAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'UANG_MAKAN',
                    'required',
                ],
    
                ['number', 'Uang Makan', [], 'DET_UANG_MAKAN', ''],
    
                [
                    'dropdown',
                    'Uang Transport',
                    [
                        'HARIAN' => 'HARIAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'UANG_TRANSPORT',
                    'required',
                ],
                ['number', 'Uang Transport', [], 'DET_UANG_TRANSPORT', ''],
    
                [
                    'dropdown',
                    'Uang Lembur',
                    [
                        'HARIAN' => 'HARIAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'UANG_LEMBUR',
                    'required',
                ],
                ['number', 'Uang Lembur', [], 'DET_UANG_LEMBUR', ''],
    
                [
                    'dropdown',
                    'Pulsa',
                    [
                        'BULANAN' => 'BULANAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'PULSA',
                    'required',
                ],
                ['number', 'Pulsa', [], 'DET_PULSA', ''],
    
                [
                    'dropdown',
                    'Tunjangan Kendaraan',
                    [
                        'ADA' => 'ADA',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'TUNJANGAN_KENDARAAN',
                    'required',
                ],
                ['number', 'Tunjangan Kendaraan', [], 'DET_TUNJANGAN_KENDARAAN', ''],
    
                [
                    'dropdown',
                    'Tunjangan Lain',
                    [
                        'ADA' => 'ADA',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'TUNJANGAN_LAIN',
                    'required',
                ],
    
                ['number', 'Tunjangan Lain', [], 'DET_TUNJANGAN_LAIN', ''],
                ['text', 'Keterangan Tunjangan Lain', [], 'KETERANGAN_TUNJANGAN_LAIN', ''],
    
                [
                    'dropdown',
                    'Insentif',
                    [
                        'BULANAN' => 'BULANAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'INSENTIF',
                    'required',
                ],
                [
                    'dropdown',
                    'THR',
                    [
                        'TAHUNAN' => 'TAHUNAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'THR',
                    'required',
                ],
            ],
    
            'Upload Dokumen' => [
                ['file', 'Foto KTP', [], 'FOTO_KTP', ''],
                ['file', 'Foto SIM', [], 'FOTO_SIM', ''],
                ['file', 'Foto KK', [], 'FOTO_KK', ''],
                ['file', 'Foto BPJS Kesehatan', [], 'FOTO_BPJS_KESEHATAN', ''],
                ['file', 'Foto BPJS Ketenagakerjaan', [], 'FOTO_BPJS_KETENAGAKERJAAN', ''],
                ['file', 'Foto Karyawan', [], 'FOTO_KARYAWAN', ''],
                ['file', 'Foto Kontrak Kerja', [], 'FOTO_KONTRAK_KERJA', ''],
            ],
        ],
        'submit_route_name' => 'karyawan.store',
    ])


    @include('components.modal-trashbin')





    @include('components.modal-edit', [
        'input_fields' => [
            'Data Karyawan' => [
                ['text', 'Nama', [], 'NAMA', 'required'],
                ['text', 'Email', [], 'EMAIL', 'required'],
                ['text', 'Nickname', [], 'NICKNAME', 'required'],
                ['dropdown', 'Jabatan', $array_position_dropdown, 'KODE_JABATAN', 'required'],
                ['dropdown', 'Lokasi', $array_warehouse_dropdown, 'KODE_LOKASI', 'required'],
                ['text', 'NIK', [], 'NIK', 'required'],
                ['text', 'No. SIM', [], 'NO_SIM', 'required'],
                ['text', 'Alamat KTP', [], 'ALAMAT_KTP', 'required'],
                ['text', 'Alamat Domisili', [], 'ALAMAT_DOMISILI', 'required'],
                ['date', 'TTL', [], 'TTL', 'required'],
                [
                    'dropdown',
                    'Jenis Kelamin',
                    ['LAKI-LAKI' => 'LAKI-LAKI', 'PEREMPUAN' => 'PEREMPUAN'],
                    'JENIS_KELAMIN',
                    'required',
                ],
                [
                    'dropdown',
                    'Agama',
                    [
                        'ISLAM' => 'ISLAM',
                        'KRISTEN' => 'KRISTEN',
                        'KATOLIK' => 'KATOLIK',
                        'HINDU' => 'HINDU',
                        'BUDDHA' => 'BUDDHA',
                        'KONGHUCU' => 'KONGHUCU',
                    ],
                    'AGAMA',
                    'required',
                ],
                [
                    'dropdown',
                    'Status Pernikahan',
                    ['BELUM MENIKAH' => 'BELUM MENIKAH', 'SUDAH MENIKAH' => 'SUDAH MENIKAH'],
                    'STATUS_PERNIKAHAN',
                    'required',
                ],
                ['number', 'Jumlah Anak', [], 'JUMLAH_ANAK', 'required'],
                ['text', 'No. HP', [], 'NO_HP', 'required'],
                ['text', 'No. HP Kantor', [], 'NO_HP_KANTOR', 'required'],
                ['text', 'No. HP Keluarga', [], 'NO_HP_KELUARGA', 'required'],
                ['text', 'Keterangan Keluarga', [], 'KETERANGAN_KELUARGA', ''],
    
                ['date', 'Tgl Mulai Kerja', [], 'TGL_MULAI_KERJA', 'required'],
                ['date', 'Tgl Selesai Kontrak', [], 'TGL_SELESAI_KONTRAK', 'required'],
                [
                    'dropdown',
                    'Status Karyawan',
                    [
                        'HARIAN' => 'HARIAN',
                        'BULANAN' => 'BULANAN',
                    ],
                    'STATUS_KARYAWAN',
                    'required',
                ],
                ['time', 'Jam Masuk', [], 'JAM_MASUK', 'required'],
                ['time', 'Jam Keluar', [], 'JAM_KELUAR', 'required'],
                ['text', 'Account Number', [], 'ACCOUNT_NUMBER', 'required'],
                ['text', 'Bank', [], 'BANK', 'required'],
                ['text', 'Atas Nama', [], 'ATAS_NAMA', 'required'],
            ],
            'Fasilitas Karyawan' => [
                [
                    'dropdown',
                    'Gaji Pokok',
                    ['HARIAN' => 'HARIAN', 'BULANAN' => 'BULANAN'],
                    'GAJI_POKOK',
                    'required',
                ],
                ['number', 'Gaji Pokok', [], 'DET_GAJI_POKOK', ''],
                [
                    'dropdown',
                    'BPJS Kesehatan',
                    [
                        'PERUSAHAAN' => 'PERUSAHAAN',
                        'MANDIRI' => 'MANDIRI',
                        'ASURANSI' => 'ASURANSI',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'BPJS_KESEHATAN',
                    'required',
                ],
                ['number', 'BPJS Kesehatan', [], 'DET_BPJS_KESEHATAN', ''],
                [
                    'dropdown',
                    'BPJS Ketenagakerjaan',
                    [
                        'PERUSAHAAN' => 'PERUSAHAAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'BPJS_KETENAGAKERJAAN',
                    'required',
                ],
                ['number', 'BPJS Ketenagakerjaan', [], 'DET_BPJS_KETENAGAKERJAAN', ''],
    
                [
                    'dropdown',
                    'Uang Makan',
                    [
                        'HARIAN' => 'HARIAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'UANG_MAKAN',
                    'required',
                ],
    
                ['number', 'Uang Makan', [], 'DET_UANG_MAKAN', ''],
    
                [
                    'dropdown',
                    'Uang Transport',
                    [
                        'HARIAN' => 'HARIAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'UANG_TRANSPORT',
                    'required',
                ],
                ['number', 'Uang Transport', [], 'DET_UANG_TRANSPORT', ''],
    
                [
                    'dropdown',
                    'Uang Lembur',
                    [
                        'HARIAN' => 'HARIAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'UANG_LEMBUR',
                    'required',
                ],
                ['number', 'Uang Lembur', [], 'DET_UANG_LEMBUR', ''],
    
                [
                    'dropdown',
                    'Pulsa',
                    [
                        'BULANAN' => 'BULANAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'PULSA',
                    'required',
                ],
                ['number', 'Pulsa', [], 'DET_PULSA', ''],
    
                [
                    'dropdown',
                    'Tunjangan Kendaraan',
                    [
                        'ADA' => 'ADA',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'TUNJANGAN_KENDARAAN',
                    'required',
                ],
                ['number', 'Tunjangan Kendaraan', [], 'DET_TUNJANGAN_KENDARAAN', ''],
    
                [
                    'dropdown',
                    'Tunjangan Lain',
                    [
                        'ADA' => 'ADA',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'TUNJANGAN_LAIN',
                    'required',
                ],
                ['number', 'Tunjangan Lain', [], 'DET_TUNJANGAN_LAIN', ''],
                ['text', 'Keterangan Tunjangan Lain', [], 'KETERANGAN_TUNJANGAN_LAIN', ''],
    
                [
                    'dropdown',
                    'Insentif',
                    [
                        'BULANAN' => 'BULANAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'INSENTIF',
                    'required',
                ],
                [
                    'dropdown',
                    'THR',
                    [
                        'TAHUNAN' => 'TAHUNAN',
                        'TIDAK ADA' => 'TIDAK ADA',
                    ],
                    'THR',
                    'required',
                ],
            ],
    
            'Upload Dokumen' => [
                ['file', 'Foto KTP', [], 'FOTO_KTP', ''],
                ['file', 'Foto SIM', [], 'FOTO_SIM', ''],
                ['file', 'Foto KK', [], 'FOTO_KK', ''],
                ['file', 'Foto BPJS Kesehatan', [], 'FOTO_BPJS_KESEHATAN', ''],
                ['file', 'Foto BPJS Ketenagakerjaan', [], 'FOTO_BPJS_KETENAGAKERJAAN', ''],
                ['file', 'Foto Karyawan', [], 'FOTO_KARYAWAN', ''],
                ['file', 'Foto Kontrak Kerja', [], 'FOTO_KONTRAK_KERJA', ''],
            ],
        ],
        'submit_route_name' => 'karyawan.update',
    ])

@endsection

@push('scripts')
    {{-- @include('components.data-table-scripts') --}}
    @include('components.data-table-ajax-scripts', [
        'keys' => $keys,
        'data_route_name' => 'karyawan.json',
        'data_adv_route_name' => 'karyawan.jsonadv',
    ])
    @include('components.data-table-advance-script')
    @include('components.modal-scripts', [
        'open_modal_edit_route_name' => 'karyawan.findByKode',
        'delete_route_name' => 'karyawan.delete',
        'next_id_route_name' => 'karyawan.getNextId',
        'continue_submit_route_name' => null,
        'continue_edit_submit_route_name' => null,
        'restore_route_name' => 'karyawan.restore',
        'trash_route_name' => 'karyawan.trash',
        'columns' => $table_headers,
        'keys' => $keys,
        'files_route_name' => 'karyawan.getFiles',
    ])
    <script>
        var itemId = 0;
        var deletedItemIds = [];

        // if TIDAK ADA IS PICKED IN SELECT, THEN SET VALUE - IN DET_
        let array_to_check = ['BPJS_KESEHATAN', 'BPJS_KETENAGAKERJAAN', 'UANG_MAKAN', 'UANG_TRANSPORT', 'UANG_LEMBUR',
            'PULSA', 'TUNJANGAN_KENDARAAN', 'TUNJANGAN_LAIN'
        ];

        array_to_check.forEach(function(item) {
            $(`select[name=${item}]`).change(function() {
                if ($(this).val() == 'TIDAK ADA') {
                    // $(`input[name=DET_${item}]`).val('-');
                    $(`input[name=DET_${item}]`).attr('disabled', true);
                } else {
                    // $(`input[name=DET_${item}]`).val('');
                    $(`input[name=DET_${item}]`).attr('disabled', false);
                }
            });
        });
    </script>




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
