@extends('layouts.app')

@section('title', 'Pra JOA')

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
                    <h1 style="text-align: center;">Pra JOA</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('prajoa') }}</div>
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


                            @include('components.front-form-input', [
                                'input_fields' => [
                                    'Pra Joa' => [
                                        [
                                            'dropdown',
                                            'Kode Customer',
                                            $array_customers_dropdown,
                                            'KODE_CUSTOMER',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'Kode Vendor Pelayaran Forwarding',
                                            $array_vendor_dropdown,
                                            'KODE_VENDOR_PELAYARAN_FORWARDING',
                                            'required',
                                        ],
                                        ['dropdown', 'Kode POL', $array_harbor_dropdown, 'KODE_POL', 'required'],
                                        ['dropdown', 'Kode POD', $array_harbor_dropdown, 'KODE_POD', 'required'],
                                        [
                                            'dropdown',
                                            'Kode UK Container',
                                            $array_size_dropdown,
                                            'KODE_UK_CONTAINER',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'Kode Jenis Container',
                                            $array_containertype_dropdown,
                                            'KODE_JENIS_CONTAINER',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'Kode Jenis Order',
                                            $array_ordertype_dropdown,
                                            'KODE_JENIS_ORDER',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'Kode Commodity',
                                            $array_commodity_dropdown,
                                            'KODE_COMMODITY',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'Kode Service',
                                            $array_service_dropdown,
                                            'KODE_SERVICE',
                                            'required',
                                        ],
                                        ['dropdown', 'Status', ['F' => 'F', 'N' => 'N'], 'STATUS', 'required'],
                            
                                        [
                                            'dropdown',
                                            'THC POL Included',
                                            [true => 'INCLUDE', false => 'EXCLUDE'],
                                            'THC_POL_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_THC_POL'],
                                            [[]],
                                            ['THC POL'],
                                            ['thclolo.json'],
                                            [config('thclolo.table_headers')],
                                            [config('thclolo.columns_shown')],
                                            [[1]],
                                            ['addValueTHCPOL'],
                                        ],
                                        [
                                            'dropdown',
                                            'THC POD Included',
                                            [true => 'INCLUDE', false => 'EXCLUDE'],
                                            'THC_POD_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_THC_POD'],
                                            [[]],
                                            ['THC POD'],
                                            ['thclolo.json'],
                                            [config('thclolo.table_headers')],
                                            [config('thclolo.columns_shown')],
                                            [[1]],
                                            ['addValueTHCPOD'],
                                        ],
                                        [
                                            'dropdown',
                                            'LOLO POL Dalam Luar',
                                            ['DALAM' => 'DALAM', 'LUAR' => 'LUAR'],
                                            'LOLO_POL_DALAM_LUAR',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'LOLO POD Dalam Luar',
                                            ['DALAM' => 'DALAM', 'LUAR' => 'LUAR'],
                                            'LOLO_POD_DALAM_LUAR',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'LOLO POL Included',
                                            [true => 'INCLUDE', false => 'EXCLUDE'],
                                            'LOLO_POL_INCL',
                                            'required',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'LOLO POD Included',
                                            [true => 'INCLUDE', false => 'EXCLUDE'],
                                            'LOLO_POD_INCL',
                                            'required',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Rework Included',
                                            [true => 'Y', false => 'N'],
                                            'REWORK_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            ['NOMINAL_REWORK', 'KETERANGAN_REWORK'],
                                            [[], []],
                                            ['Nominal Rework', 'Keterangan Rework'],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [22],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Asuransi Included',
                                            [true => 'Y', false => 'N'],
                                            'ASURANSI_INCL',
                                            'required',
                                            true,
                                            ['number', 'number-decimal'],
                                            ['NOMINAL_TSI', 'PERSEN_ASURANSI'],
                                            [[], []],
                                            ['Nominal TSI', 'Persen Asuransi'],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Buruh Muat Included',
                                            [true => 'Y', false => 'N'],
                                            'BURUH_MUAT_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_HPP_BIAYA_BURUH_MUAT'],
                                            [[]],
                                            ['HPP Biaya Buruh Muat'],
                                            ['costrate.json'],
                                            [config('costrate.table_headers')],
                                            [config('costrate.columns_shown')],
                                            [[9]],
                                            ['addValueCostRate'],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Alat Berat POL Included',
                                            [true => 'Y', false => 'N'],
                                            'ALAT_BERAT_POL_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            ['NOMINAL_ALAT_BERAT_POL', 'KETERANGAN_ALAT_BERAT_POL'],
                                            [[], []],
                                            ['Nominal Alat Berat POL', 'Keterangan Alat Berat POL'],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [27],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Buruh Stripping Included',
                                            [true => 'Y', false => 'N'],
                                            'BURUH_STRIPPING_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_HPP_BIAYA_BURUH_STRIPPING'],
                                            [[]],
                                            ['HPP Biaya Buruh Stripping'],
                                            ['costrate.json'],
                                            [config('costrate.table_headers')],
                                            [config('costrate.columns_shown')],
                                            [[9]],
                                            ['addValueCostRate'],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Alat Berat POD Stripping Included',
                                            [true => 'Y', false => 'N'],
                                            'ALAT_BERAT_POD_STRIPPING_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            [
                                                'NOMINAL_ALAT_BERAT_POD_STRIPPING',
                                                'KETERANGAN_ALAT_BERAT_POD_STRIPPING',
                                            ],
                                            [[], []],
                                            [
                                                'Nominal Alat Berat POD Stripping',
                                                'Keterangan Alat Berat POD Stripping',
                                            ],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [34],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Buruh Bongkar Included',
                                            [true => 'Y', false => 'N'],
                                            'BURUH_BONGKAR_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_HPP_BIAYA_BURUH_BONGKAR'],
                                            [[]],
                                            ['HPP Biaya Buruh Bongkar'],
                                            ['costrate.json'],
                                            [config('costrate.table_headers')],
                                            [config('costrate.columns_shown')],
                                            [[9]],
                                            ['addValueCostRate'],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Alat Berat POD Bongkar Included',
                                            [true => 'Y', false => 'N'],
                                            'ALAT_BERAT_POD_BONGKAR_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            [
                                                'NOMINAL_ALAT_BERAT_POD_BONGKAR',
                                                'KETERANGAN_ALAT_BERAT_POD_BONGKAR',
                                            ],
                                            [[], []],
                                            [
                                                'Nominal Alat Berat POD Bongkar',
                                                'Keterangan Alat Berat POD Bongkar',
                                            ],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [37],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Truck POL Included',
                                            [true => 'Y', false => 'N'],
                                            'TRUCK_POL_INCL',
                                            'required',
                                            true,
                                            ['dropdown'],
                                            ['KODE_RUTE_TRUCK_POL'],
                                            [$array_truckroutes_dropdown],
                                            ['Rute Truck POL'],
                                            ['addValueTruckRoute'],
                                        ],
                                        [
                                            'dropdown',
                                            'Truck POD Included',
                                            [true => 'Y', false => 'N'],
                                            'TRUCK_POD_INCL',
                                            'required',
                                            true,
                                            ['dropdown'],
                                            ['KODE_RUTE_TRUCK_POD'],
                                            [$array_truckroutes_dropdown],
                                            ['Rute Truck POD'],
                                            ['addValueTruckRoute'],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Fee Agent POL Included',
                                            [true => 'Y', false => 'N'],
                                            'FEE_AGENT_POL_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            ['NOMINAL_FEE_AGENT_POL', 'KETERANGAN_FEE_AGENT_POL'],
                                            [[], []],
                                            ['Nominal Fee Agent POL', 'Keterangan Fee Agent POL'],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [47],
                                        ],
                                        [
                                            'dropdown',
                                            'Fee Agent POD Included',
                                            [true => 'Y', false => 'N'],
                                            'FEE_AGENT_POD_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            ['NOMINAL_FEE_AGENT_POD', 'KETERANGAN_FEE_AGENT_POD'],
                                            [[], []],
                                            ['Nominal Fee Agent POD', 'Keterangan Fee Agent POD'],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [50],
                                        ],
                                        [
                                            'dropdown',
                                            'Toeslag Included',
                                            [true => 'Y', false => 'N'],
                                            'TOESLAG_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            ['NOMINAL_TOESLAG', 'KETERANGAN_TOESLAG'],
                                            [[], []],
                                            ['Nominal Toeslag', 'Keterangan Toeslag'],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [53],
                                        ],
                                        [
                                            'dropdown',
                                            'Seal Included',
                                            [true => 'Y', false => 'N'],
                                            'SEAL_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_HPP_BIAYA_SEAL'],
                                            [[]],
                                            ['HPP Biaya Seal'],
                                            ['costrate.json'],
                                            [config('costrate.table_headers')],
                                            [config('costrate.columns_shown')],
                                            [[9]],
                                            ['addValueCostRate'],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'OPS Included',
                                            [true => 'Y', false => 'N'],
                                            'OPS_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_HPP_BIAYA_OPS'],
                                            [[]],
                                            ['HPP Biaya OPS'],
                                            ['costrate.json'],
                                            [config('costrate.table_headers')],
                                            [config('costrate.columns_shown')],
                                            [[9]],
                                            ['addValueCostRate'],
                                        ],
                                        [
                                            'dropdown',
                                            'Karantina Included',
                                            [true => 'Y', false => 'N'],
                                            'KARANTINA_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            ['NOMINAL_KARANTINA', 'KETERANGAN_KARANTINA'],
                                            [[], []],
                                            ['Nominal Karantina', 'Keterangan Karantina'],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [60],
                                        ],
                                        [
                                            'dropdown',
                                            'Cashback Included',
                                            [true => 'Y', false => 'N'],
                                            'CASHBACK_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_CASHBACK', 'KETERANGAN_CASHBACK'],
                                            [[], []],
                                            ['Nominal Cashback', 'Keterangan Cashback'],
                                        ],
                                        [
                                            'dropdown',
                                            'Claim Included',
                                            [true => 'Y', false => 'N'],
                                            'CLAIM_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_CLAIM', 'KETERANGAN_CLAIM'],
                                            [[], []],
                                            ['Nominal Claim', 'Keterangan Claim'],
                                        ],
                                        // [
                                        //     'dropdown',
                                        //     'Biaya Lain Included',
                                        //     [true => 'Y', false => 'N'],
                                        //     'BIAYA_LAIN_INCL',
                                        //     'required',
                                        //     'Y',
                                        //     ['number', 'text'],
                                        //     ['NOMINAL_BIAYA_LAIN[]', 'KETERANGAN_BIAYA_LAIN'],
                                        //     [[], []],
                                        //     ['Nominal Biaya Lain', 'Keterangan Biaya Lain'],
                                        // ],
                            
                                        [
                                            'dropdown',
                                            'BL Included',
                                            [true => 'Y', false => 'N'],
                                            'BL_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_BL', 'KETERANGAN_BL'],
                                            [[], []],
                                            ['Nominal BL', 'Keterangan BL'],
                                        ],
                                        [
                                            'dropdown',
                                            'DO Included',
                                            [true => 'Y', false => 'N'],
                                            'DO_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_DO', 'KETERANGAN_DO'],
                                            [[], []],
                                            ['Nominal DO', 'Keterangan DO'],
                                        ],
                                        [
                                            'dropdown',
                                            'APBS Included',
                                            [true => 'Y', false => 'N'],
                                            'APBS_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_APBS', 'KETERANGAN_APBS'],
                                            [[], []],
                                            ['Nominal APBS', 'Keterangan APBS'],
                                        ],
                                        [
                                            'dropdown',
                                            'Cleaning Included',
                                            [true => 'Y', false => 'N'],
                                            'CLEANING_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_CLEANING', 'KETERANGAN_CLEANING'],
                                            [[], []],
                                            ['Nominal Cleaning', 'Keterangan Cleaning'],
                                        ],
                                        [
                                            'dropdown',
                                            'Biaya Lain Included',
                                            [true => 'Y', false => 'N'],
                                            'BIAYA_LAIN_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_BIAYA_LAIN[]'],
                                            [[]],
                                            ['HPP Biaya Lain'],
                                            ['costrate.json'],
                                            [config('costrate.table_headers')],
                                            [config('costrate.columns_shown')],
                                            [[9]],
                                            ['addValueCostRate'],
                                        ],
                                        [
                                            'dropdown',
                                            'DOC Included',
                                            [true => 'Y', false => 'N'],
                                            'DOC_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_DOC', 'KETERANGAN_DOC'],
                                            [[], []],
                                            ['Nominal DOC', 'Keterangan DOC'],
                                        ],
                                        ['number', 'Harga Jual', [], 'HARGA_JUAL', ''],
                                    ],
                                ],
                                'submit_route_name' => 'prajoa.store',
                                'summary' => true,
                            ])

                            @include('components.front-form-edit', [
                                'input_fields' => [
                                    'Pra Joa' => [
                                        [
                                            'dropdown',
                                            'Kode Customer',
                                            $array_customers_dropdown,
                                            'KODE_CUSTOMER',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'Kode Vendor Pelayaran Forwarding',
                                            $array_vendor_dropdown,
                                            'KODE_VENDOR_PELAYARAN_FORWARDING',
                                            'required',
                                        ],
                                        ['dropdown', 'Kode POL', $array_harbor_dropdown, 'KODE_POL', 'required'],
                                        ['dropdown', 'Kode POD', $array_harbor_dropdown, 'KODE_POD', 'required'],
                                        [
                                            'dropdown',
                                            'Kode UK Container',
                                            $array_size_dropdown,
                                            'KODE_UK_CONTAINER',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'Kode Jenis Container',
                                            $array_containertype_dropdown,
                                            'KODE_JENIS_CONTAINER',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'Kode Jenis Order',
                                            $array_ordertype_dropdown,
                                            'KODE_JENIS_ORDER',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'Kode Commodity',
                                            $array_commodity_dropdown,
                                            'KODE_COMMODITY',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'Kode Service',
                                            $array_service_dropdown,
                                            'KODE_SERVICE',
                                            'required',
                                        ],
                                        ['dropdown', 'Status', ['F' => 'F', 'N' => 'N'], 'STATUS', 'required'],
                            
                                        [
                                            'dropdown',
                                            'THC POL Included',
                                            [true => 'INCLUDE', false => 'EXCLUDE'],
                                            'THC_POL_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_THC_POL'],
                                            [[]],
                                            ['THC POL'],
                                            ['thclolo.json'],
                                            [config('thclolo.table_headers')],
                                            [config('thclolo.columns_shown')],
                                            [[1]],
                                            ['addValueTHCPOL'],
                                        ],
                                        [
                                            'dropdown',
                                            'THC POD Included',
                                            [true => 'INCLUDE', false => 'EXCLUDE'],
                                            'THC_POD_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_THC_POD'],
                                            [[]],
                                            ['THC POD'],
                                            ['thclolo.json'],
                                            [config('thclolo.table_headers')],
                                            [config('thclolo.columns_shown')],
                                            [[1]],
                                            ['addValueTHCPOD'],
                                        ],
                                        [
                                            'dropdown',
                                            'LOLO POL Dalam Luar',
                                            ['DALAM' => 'DALAM', 'LUAR' => 'LUAR'],
                                            'LOLO_POL_DALAM_LUAR',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'LOLO POD Dalam Luar',
                                            ['DALAM' => 'DALAM', 'LUAR' => 'LUAR'],
                                            'LOLO_POD_DALAM_LUAR',
                                            'required',
                                        ],
                                        [
                                            'dropdown',
                                            'LOLO POL Included',
                                            [true => 'INCLUDE', false => 'EXCLUDE'],
                                            'LOLO_POL_INCL',
                                            'required',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'LOLO POD Included',
                                            [true => 'INCLUDE', false => 'EXCLUDE'],
                                            'LOLO_POD_INCL',
                                            'required',
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Rework Included',
                                            [true => 'Y', false => 'N'],
                                            'REWORK_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            ['NOMINAL_REWORK', 'KETERANGAN_REWORK'],
                                            [[], []],
                                            ['Nominal Rework', 'Keterangan Rework'],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [22],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Asuransi Included',
                                            [true => 'Y', false => 'N'],
                                            'ASURANSI_INCL',
                                            'required',
                                            true,
                                            ['number', 'number-decimal'],
                                            ['NOMINAL_TSI', 'PERSEN_ASURANSI'],
                                            [[], []],
                                            ['Nominal TSI', 'Persen Asuransi'],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Buruh Muat Included',
                                            [true => 'Y', false => 'N'],
                                            'BURUH_MUAT_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_HPP_BIAYA_BURUH_MUAT'],
                                            [[]],
                                            ['HPP Biaya Buruh Muat'],
                                            ['costrate.json'],
                                            [config('costrate.table_headers')],
                                            [config('costrate.columns_shown')],
                                            [[9]],
                                            ['addValueCostRate'],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Alat Berat POL Included',
                                            [true => 'Y', false => 'N'],
                                            'ALAT_BERAT_POL_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            ['NOMINAL_ALAT_BERAT_POL', 'KETERANGAN_ALAT_BERAT_POL'],
                                            [[], []],
                                            ['Nominal Alat Berat POL', 'Keterangan Alat Berat POL'],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [27],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Buruh Stripping Included',
                                            [true => 'Y', false => 'N'],
                                            'BURUH_STRIPPING_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_HPP_BIAYA_BURUH_STRIPPING'],
                                            [[]],
                                            ['HPP Biaya Buruh Stripping'],
                                            ['costrate.json'],
                                            [config('costrate.table_headers')],
                                            [config('costrate.columns_shown')],
                                            [[9]],
                                            ['addValueCostRate'],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Alat Berat POD Stripping Included',
                                            [true => 'Y', false => 'N'],
                                            'ALAT_BERAT_POD_STRIPPING_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            [
                                                'NOMINAL_ALAT_BERAT_POD_STRIPPING',
                                                'KETERANGAN_ALAT_BERAT_POD_STRIPPING',
                                            ],
                                            [[], []],
                                            [
                                                'Nominal Alat Berat POD Stripping',
                                                'Keterangan Alat Berat POD Stripping',
                                            ],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [34],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Buruh Bongkar Included',
                                            [true => 'Y', false => 'N'],
                                            'BURUH_BONGKAR_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_HPP_BIAYA_BURUH_BONGKAR'],
                                            [[]],
                                            ['HPP Biaya Buruh Bongkar'],
                                            ['costrate.json'],
                                            [config('costrate.table_headers')],
                                            [config('costrate.columns_shown')],
                                            [[9]],
                                            ['addValueCostRate'],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Alat Berat POD Bongkar Included',
                                            [true => 'Y', false => 'N'],
                                            'ALAT_BERAT_POD_BONGKAR_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            [
                                                'NOMINAL_ALAT_BERAT_POD_BONGKAR',
                                                'KETERANGAN_ALAT_BERAT_POD_BONGKAR',
                                            ],
                                            [[], []],
                                            [
                                                'Nominal Alat Berat POD Bongkar',
                                                'Keterangan Alat Berat POD Bongkar',
                                            ],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [37],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Truck POL Included',
                                            [true => 'Y', false => 'N'],
                                            'TRUCK_POL_INCL',
                                            'required',
                                            true,
                                            ['dropdown'],
                                            ['KODE_RUTE_TRUCK_POL'],
                                            [$array_truckroutes_dropdown],
                                            ['Rute Truck POL'],
                                            ['addValueTruckRoute'],
                                        ],
                                        [
                                            'dropdown',
                                            'Truck POD Included',
                                            [true => 'Y', false => 'N'],
                                            'TRUCK_POD_INCL',
                                            'required',
                                            true,
                                            ['dropdown'],
                                            ['KODE_RUTE_TRUCK_POD'],
                                            [$array_truckroutes_dropdown],
                                            ['Rute Truck POD'],
                                            ['addValueTruckRoute'],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'Fee Agent POL Included',
                                            [true => 'Y', false => 'N'],
                                            'FEE_AGENT_POL_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            ['NOMINAL_FEE_AGENT_POL', 'KETERANGAN_FEE_AGENT_POL'],
                                            [[], []],
                                            ['Nominal Fee Agent POL', 'Keterangan Fee Agent POL'],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [47],
                                        ],
                                        [
                                            'dropdown',
                                            'Fee Agent POD Included',
                                            [true => 'Y', false => 'N'],
                                            'FEE_AGENT_POD_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            ['NOMINAL_FEE_AGENT_POD', 'KETERANGAN_FEE_AGENT_POD'],
                                            [[], []],
                                            ['Nominal Fee Agent POD', 'Keterangan Fee Agent POD'],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [50],
                                        ],
                                        [
                                            'dropdown',
                                            'Toeslag Included',
                                            [true => 'Y', false => 'N'],
                                            'TOESLAG_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            ['NOMINAL_TOESLAG', 'KETERANGAN_TOESLAG'],
                                            [[], []],
                                            ['Nominal Toeslag', 'Keterangan Toeslag'],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [53],
                                        ],
                                        [
                                            'dropdown',
                                            'Seal Included',
                                            [true => 'Y', false => 'N'],
                                            'SEAL_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_HPP_BIAYA_SEAL'],
                                            [[]],
                                            ['HPP Biaya Seal'],
                                            ['costrate.json'],
                                            [config('costrate.table_headers')],
                                            [config('costrate.columns_shown')],
                                            [[9]],
                                            ['addValueCostRate'],
                                        ],
                            
                                        [
                                            'dropdown',
                                            'OPS Included',
                                            [true => 'Y', false => 'N'],
                                            'OPS_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_HPP_BIAYA_OPS'],
                                            [[]],
                                            ['HPP Biaya OPS'],
                                            ['costrate.json'],
                                            [config('costrate.table_headers')],
                                            [config('costrate.columns_shown')],
                                            [[9]],
                                            ['addValueCostRate'],
                                        ],
                                        [
                                            'dropdown',
                                            'Karantina Included',
                                            [true => 'Y', false => 'N'],
                                            'KARANTINA_INCL',
                                            'required',
                                            true,
                                            ['number-master', 'text'],
                                            ['NOMINAL_KARANTINA', 'KETERANGAN_KARANTINA'],
                                            [[], []],
                                            ['Nominal Karantina', 'Keterangan Karantina'],
                                            ['prajoa.json'],
                                            [config('less-prajoa.table_headers')],
                                            [config('less-prajoa.columns_shown')],
                                            [60],
                                        ],
                                        [
                                            'dropdown',
                                            'Cashback Included',
                                            [true => 'Y', false => 'N'],
                                            'CASHBACK_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_CASHBACK', 'KETERANGAN_CASHBACK'],
                                            [[], []],
                                            ['Nominal Cashback', 'Keterangan Cashback'],
                                        ],
                                        [
                                            'dropdown',
                                            'Claim Included',
                                            [true => 'Y', false => 'N'],
                                            'CLAIM_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_CLAIM', 'KETERANGAN_CLAIM'],
                                            [[], []],
                                            ['Nominal Claim', 'Keterangan Claim'],
                                        ],
                                        // [
                                        //     'dropdown',
                                        //     'Biaya Lain Included',
                                        //     [true => 'Y', false => 'N'],
                                        //     'BIAYA_LAIN_INCL',
                                        //     'required',
                                        //     'Y',
                                        //     ['number', 'text'],
                                        //     ['NOMINAL_BIAYA_LAIN[]', 'KETERANGAN_BIAYA_LAIN'],
                                        //     [[], []],
                                        //     ['Nominal Biaya Lain', 'Keterangan Biaya Lain'],
                                        // ],
                            
                                        [
                                            'dropdown',
                                            'BL Included',
                                            [true => 'Y', false => 'N'],
                                            'BL_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_BL', 'KETERANGAN_BL'],
                                            [[], []],
                                            ['Nominal BL', 'Keterangan BL'],
                                        ],
                                        [
                                            'dropdown',
                                            'DO Included',
                                            [true => 'Y', false => 'N'],
                                            'DO_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_DO', 'KETERANGAN_DO'],
                                            [[], []],
                                            ['Nominal DO', 'Keterangan DO'],
                                        ],
                                        [
                                            'dropdown',
                                            'APBS Included',
                                            [true => 'Y', false => 'N'],
                                            'APBS_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_APBS', 'KETERANGAN_APBS'],
                                            [[], []],
                                            ['Nominal APBS', 'Keterangan APBS'],
                                        ],
                                        [
                                            'dropdown',
                                            'Cleaning Included',
                                            [true => 'Y', false => 'N'],
                                            'CLEANING_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_CLEANING', 'KETERANGAN_CLEANING'],
                                            [[], []],
                                            ['Nominal Cleaning', 'Keterangan Cleaning'],
                                        ],
                                        [
                                            'dropdown',
                                            'Biaya Lain Included',
                                            [true => 'Y', false => 'N'],
                                            'BIAYA_LAIN_INCL',
                                            'required',
                                            true,
                                            ['kode-master', 'text'],
                                            ['KODE_BIAYA_LAIN[]'],
                                            [[]],
                                            ['HPP Biaya Lain'],
                                            ['costrate.json'],
                                            [config('costrate.table_headers')],
                                            [config('costrate.columns_shown')],
                                            [[9]],
                                            ['addValueCostRate'],
                                        ],
                                        [
                                            'dropdown',
                                            'DOC Included',
                                            [true => 'Y', false => 'N'],
                                            'DOC_INCL',
                                            'required',
                                            true,
                                            ['number', 'text'],
                                            ['NOMINAL_DOC', 'KETERANGAN_DOC'],
                                            [[], []],
                                            ['Nominal DOC', 'Keterangan DOC'],
                                        ],
                                        ['number', 'Harga Jual', [], 'HARGA_JUAL', ''],
                                    ],
                                ],
                                'prajoa' => true,
                                'submit_route_name' => 'prajoa.update',
                                'summary' => true,
                            ])
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


    @include('components.modal-data-table')

    @include('components.modal-trashbin')






    @include('components.modal-input-newvalue', [
        'input_fields' => [
            'THC LOLO POL' => [
                ['dropdown', 'Vendor', $array_vendor_dropdown, 'KODE_VENDOR', 'required'],
                ['dropdown', 'Pelabuhan', $array_harbor_dropdown, 'KODE_PELABUHAN', 'required'],
                ['number', 'THC', [], 'THC', 'required'],
                ['number', 'LOLO Luar', [], 'LOLO_LUAR', 'required'],
                ['number', 'LOLO Dalam', [], 'LOLO_DALAM', 'required'],
    
                ['date', 'Tgl. Mulai Berlaku', [], 'TGL_MULAI_BERLAKU', 'required'],
                ['date', 'Tgl. Akhir Berlaku', [], 'TGL_AKHIR_BERLAKU', 'required'],
            ],
        ],
        'submit_route_name' => 'thclolo.store',
        'idunique' => 'thclolopol',
    ])

    @include('components.modal-input-newvalue', [
        'input_fields' => [
            'THC LOLO POD' => [
                ['dropdown', 'Vendor', $array_vendor_dropdown, 'KODE_VENDOR', 'required'],
                ['dropdown', 'Pelabuhan', $array_harbor_dropdown, 'KODE_PELABUHAN', 'required'],
                ['number', 'THC', [], 'THC', 'required'],
                ['number', 'LOLO Luar', [], 'LOLO_LUAR', 'required'],
                ['number', 'LOLO Dalam', [], 'LOLO_DALAM', 'required'],
    
                ['date', 'Tgl. Mulai Berlaku', [], 'TGL_MULAI_BERLAKU', 'required'],
                ['date', 'Tgl. Akhir Berlaku', [], 'TGL_AKHIR_BERLAKU', 'required'],
            ],
        ],
        'submit_route_name' => 'thclolo.store',
        'idunique' => 'thclolopod',
    ])

    @include('components.modal-input-newvalue', [
        'input_fields' => [
            'HPP Biaya' => [
                ['dropdown', 'Nama Biaya', $array_cost_dropdown, 'KODE_BIAYA', 'required'],
                ['dropdown', 'Vendor', $array_vendor_dropdown, 'KODE_VENDOR', 'required'],
                ['dropdown', 'Pelabuhan Asal', $array_harbor_dropdown, 'KODE_PELABUHAN_ASAL', ''],
                ['dropdown', 'Pelabuhan Tujuan', $array_harbor_dropdown, 'KODE_PELABUHAN_TUJUAN', ''],
    
                ['dropdown', 'Commodity', $array_commodity_dropdown, 'KODE_COMMODITY', ''],
                ['dropdown', 'Ukuran Kontainer', $array_cost_ukuran_dropdown, 'UK_KONTAINER', ''],
                ['number', 'Tarif', [], 'TARIF', 'required'],
                ['date', 'TGL Berlaku', [], 'TGL_BERLAKU', 'required'],
    
                ['text', 'Keterangan', [], 'KETERANGAN', 'required'],
                ['dropdown', 'Customer', $array_customers_dropdown, 'KODE_CUSTOMER', 'required'],
            ],
        ],
        'submit_route_name' => 'costrate.store',
        'idunique' => 'costrate',
    ])

    @include('components.modal-input-newvalue', [
        'input_fields' => [
            'Rute Truck' => [
                ['datalist', 'Rute Asal', $array_truckroutesasal_dropdown, 'RUTE_ASAL', 'required'],
                ['dropdown', 'Nama Kota Asal', $array_cities_dropdown, 'KD_KOTA_ASAL', 'required'],
                ['datalist', 'Rute Tujuan', $array_truckroutestujuan_dropdown, 'RUTE_TUJUAN', 'required'],
                ['dropdown', 'Nama Kota Tujuan', $array_cities_dropdown, 'KD_KOTA_TUJUAN', 'required'],
                ['text', 'Keterangan', [], 'KETERANGAN', 'required'],
            ],
        ],
        'submit_route_name' => 'rutetruck.store',
        'idunique' => 'rutetruck',
    ])

    @include('components.modal-summary-prajoa')


@endsection

@push('scripts')
    @include('components.data-table-ajax-scripts', [
        'keys' => $keys,
        'data_route_name' => 'prajoa.json',
        'data_adv_route_name' => 'prajoa.jsonadv',
    ])
    @include('components.data-table-advance-script')
    @include('components.modal-data-table-ajax-scripts')
    @include('components.prajoa-front-form-scripts', [
        'open_modal_edit_route_name' => 'prajoa.findByKode',
        'delete_route_name' => 'prajoa.delete',
        'next_id_route_name' => 'prajoa.getNextId',
        'continue_submit_route_name' => null,
        'continue_edit_submit_route_name' => null,
        'restore_route_name' => 'prajoa.restore',
        'trash_route_name' => 'prajoa.trash',
        'columns' => $table_headers,
        'keys' => $keys,
        'array_costrate_dropdown' => $array_costrate_dropdown,
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
        $('.thclolopod').on('shown.bs.modal', function() {
            // Reinitialize Select2 for the dropdown inside the modal
            $('.thclolopod .dropdownselect2fix').select2();
        });
        $('.thclolopol').on('shown.bs.modal', function() {
            // Reinitialize Select2 for the dropdown inside the modal
            $('.thclolopol .dropdownselect2fix').select2();
        });

        $('.addValueTHCPOD').on('click', function() {

            // ajax to get next kode

            openLoadingModal();

            $.ajax({
                url: "{{ route('thclolo.getNextId') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log(response);

                        var nextKode = response.data;
                        var form = $('.addnewValueModal form')[0];
                        // Iterate over the keys of the response data
                        // set next kode in form
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


            // ajax to get next kode

            openLoadingModal();

            $.ajax({
                url: "{{ route('thclolo.getNextId') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log(response);

                        var nextKode = response.data;
                        var form = $('.addnewValueModal form')[0];
                        // Iterate over the keys of the response data
                        // set next kode in form
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

            // ajax to get next kode

            openLoadingModal();

            $.ajax({
                url: "{{ route('costrate.getNextId') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log("sss")
                        console.log(response);

                        var nextKode = response.data;
                        var form = $('.addnewValueModal form')[0];
                        // Iterate over the keys of the response data
                        // set next kode in form
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

            // ajax to get next kode

            openLoadingModal();

            $.ajax({
                url: "{{ route('rutetruck.getNextId') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log(response);

                        var nextKode = response.data;
                        var form = $('.addnewValueModal form')[0];
                        // Iterate over the keys of the response data
                        // set next kode in form
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

        // document.ready


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

            $('.thclolopol .dropdownselect2fix').select2({
                searchInputPlaceholder: 'Ketik disini untuk mencari...',
                dropdownParent: $('.thclolopol')
            });

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

            $('.thclolopod .dropdownselect2fix').select2({
                searchInputPlaceholder: 'Ketik disini untuk mencari...',
                dropdownParent: $('.thclolopod')
            });

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

            $('.costrate .dropdownselect2fix').select2({
                searchInputPlaceholder: 'Ketik disini untuk mencari...',
                dropdownParent: $('.costrate')
            });


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
            $('.rutetruck .dropdownselect2fix').select2({
                searchInputPlaceholder: 'Ketik disini untuk mencari...',
                dropdownParent: $('.rutetruck')
            });

        });
    </script>
@endpush
