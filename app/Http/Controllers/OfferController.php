<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class OfferController extends Controller
{


    public function getOfferFormComponent(Request $request)
    {
        $urutan = $request->input('urutan', 1);
        $providedToken = $request->cookie('token');

        $url_all_dropdown = env('API_URL') . "/offer/dropdown";
        $response_all_dropdown = Http::withToken($providedToken)->get($url_all_dropdown);
        $data_all_dropdown = $response_all_dropdown->json();

        // $url_dropdown_harbor = env('API_URL') . "/harbor";
        // $response_dropdown_harbor = Http::withToken($providedToken)->get($url_dropdown_harbor);
        // $data_dropdown_harbor = $response_dropdown_harbor->json();
        $harbors = $data_all_dropdown['data']['harbors'];
        $array_harbor_dropdown = [];
        foreach ($harbors as $harbor) {
            $array_harbor_dropdown[$harbor['KODE']] = $harbor['NAMA_PELABUHAN'];
        }

        // $url_dropdown_unit = env('API_URL') . "/unit";
        // $response_dropdown_unit = Http::withToken($providedToken)->get($url_dropdown_unit);
        // $data_dropdown_unit = $response_dropdown_unit->json();
        $units = $data_all_dropdown['data']['units'];
        $array_unit_dropdown = [];
        foreach ($units as $unit) {
            $array_unit_dropdown[$unit['KODE']] = $unit['NAMA_SATUAN'];
        }



        // dropdown to fetch size
        // $url_dropdown_size = env('API_URL') . "/size";
        // $response_dropdown_size = Http::withToken($providedToken)->get($url_dropdown_size);
        // $data_dropdown_size = $response_dropdown_size->json();
        $sizes = $data_all_dropdown['data']['sizes'];
        $array_size_dropdown = [];
        foreach ($sizes as $size) {
            $array_size_dropdown[$size['KODE']] = $size['NAMA'];
        }

        // dropdown to fetch container-type
        // $url_dropdown_containertype = env('API_URL') . "/container-type";
        // $response_dropdown_containertype = Http::withToken($providedToken)->get($url_dropdown_containertype);
        // $data_dropdown_containertype = $response_dropdown_containertype->json();
        $containertypes = $data_all_dropdown['data']['containerTypes'];
        $array_containertype_dropdown = [];
        foreach ($containertypes as $containertype) {
            $array_containertype_dropdown[$containertype['KODE']] = $containertype['NAMA'];
        }

        // order-type
        // $url_dropdown_ordertype = env('API_URL') . "/order-type";
        // $response_dropdown_ordertype = Http::withToken($providedToken)->get($url_dropdown_ordertype);
        // $data_dropdown_ordertype = $response_dropdown_ordertype->json();
        $ordertypes = $data_all_dropdown['data']['orderTypes'];
        $array_ordertype_dropdown = [];
        foreach ($ordertypes as $ordertype) {
            $array_ordertype_dropdown[$ordertype['KODE']] = $ordertype['NAMA'];
        }

        // commodity
        // $url_dropdown_commodity = env('API_URL') . "/commodity";
        // $response_dropdown_commodity = Http::withToken($providedToken)->get($url_dropdown_commodity);
        // $data_dropdown_commodity = $response_dropdown_commodity->json();
        $commodities = $data_all_dropdown['data']['commodities'];
        $array_commodity_dropdown = [];
        foreach ($commodities as $commodity) {
            $array_commodity_dropdown[$commodity['KODE']] = $commodity['NAMA'];
        }

        // service
        // $url_dropdown_service = env('API_URL') . "/service";
        // $response_dropdown_service = Http::withToken($providedToken)->get($url_dropdown_service);
        // $data_dropdown_service = $response_dropdown_service->json();
        $services = $data_all_dropdown['data']['services'];
        $array_service_dropdown = [];
        foreach ($services as $service) {
            $array_service_dropdown[$service['KODE']] = $service['NAMA'];
        }
        // $url_dropdown_truckroute = env('API_URL') . "/truckroute";
        // $response_dropdown_truckroute = Http::withToken($providedToken)->get($url_dropdown_truckroute);
        // $data_dropdown_truckroute = $response_dropdown_truckroute->json();
        $truckroutes = $data_all_dropdown['data']['truckRoutes'];
        $array_truckroutes_dropdown = [];
        foreach ($truckroutes as $truckroute) {
            $array_truckroutes_dropdown[$truckroute['KODE']] = $truckroute['RUTE_ASAL'] . "-" . $truckroute['RUTE_TUJUAN'];
        }



        $componentHTML = View::make('components.form-input', [
            'input_fields' => [
                [
                    'number-master',
                    'KODE_PRAJOA[]',
                    [],
                    'No Prajoa',
                    'prajoa.json',
                    config('prajoa.table_headers'),
                    config('prajoa.columns_shown'),
                    1,
                    'readonly="readonly"',
                    'prajoa.json',
                    config('prajoa.table_headers'),
                    config('prajoa.columns_shown'),
                    'KODE_PRAJOA-' . $urutan,
                ],

                ['dropdown', 'POL', $array_harbor_dropdown, 'KODE_POL[]', '', 'KODE_POL-' . $urutan, 'KODE_POL'],
                ['dropdown', 'POD', $array_harbor_dropdown, 'KODE_POD[]', '', 'KODE_POD-' . $urutan, 'KODE_POD'],
                ['dropdown', 'Door POL', $array_truckroutes_dropdown, 'KODE_DOOR_POL[]', '', 'KODE_DOOR_POL-' . $urutan],
                ['dropdown', 'Door POD', $array_truckroutes_dropdown, 'KODE_DOOR_POD[]', '', 'KODE_DOOR_POD-' . $urutan],
                ['dropdown', 'UK Container', $array_size_dropdown, 'KODE_UK_KONTAINER[]', '', 'KODE_UK_KONTAINER-' . $urutan, 'KODE_UK_KONTAINER'],


                [
                    'dropdown',
                    'Jenis Container',
                    $array_containertype_dropdown,
                    'KODE_JENIS_CONTAINER[]',
                    '',
                    'KODE_JENIS_CONTAINER-' . $urutan,
                    'KODE_JENIS_CONTAINER'
                ],
                [
                    'dropdown',
                    'Commodity',
                    $array_commodity_dropdown,
                    'KODE_COMMODITY[]',
                    'required',
                    'KODE_COMMODITY-' . $urutan
                ],
                [
                    'dropdown',
                    'Service',
                    $array_service_dropdown,
                    'KODE_SERVICE[]',
                    'required',
                    'KODE_SERVICE-' . $urutan
                ],

                [
                    'dropdown',
                    'Stuffing',
                    ['DALAM' => 'DALAM', 'LUAR' => 'LUAR'],
                    'STUFFING[]',
                    '',
                    'STUFFING-' . $urutan,
                    'STUFFING'
                ],
                [
                    'dropdown',
                    'Stripping',
                    ['DALAM' => 'DALAM', 'LUAR' => 'LUAR'],
                    'STRIPPING[]',
                    '',
                    'STRIPPING-' . $urutan,
                    'STRIPPING'
                ],
                [
                    'dropdown',
                    'Buruh Muat',
                    ['INCL' => 'INCL', 'EXCL' => 'EXCL'],
                    'BURUH_MUAT[]',
                    'required',
                    'BURUH_MUAT-' . $urutan,
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
                    [["Alat" => "Alat", "Manual" => "Manual"]],
                    ['Pilihan Buruh Salin'],
                    ['BURUH_SALIN_KET'],
                    ['BURUH_SALIN_KET-' . $urutan],
                    'BURUH_SALIN',
                    'BURUH_SALIN-' . $urutan,
                    'addmore'
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
                    [["Alat" => "Alat", "Manual" => "Manual"]],
                    ['Pilihan Buruh Bongkar'],
                    ['BURUH_MUAT_KET'],
                    ['BURUH_MUAT_KET-' . $urutan],
                    'BURUH_BONGKAR',
                    'BURUH_BONGKAR-' . $urutan,
                    'addmore'
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
                    ['TSI-' . $urutan, 'TSI_NOMINAL-' . $urutan],
                    'ASURANSI',
                    'ASURANSI-' . $urutan,
                    'addmore'
                ],

                [
                    'text',
                    'Free Time Storage',
                    [],
                    'FREE_TIME_STORAGE[]',
                    'required',
                    'FREE_TIME_STORAGE-' . $urutan,
                ],
                [
                    'text',
                    'Free Time Demurrage',
                    [],
                    'FREE_TIME_DEMURRAGE[]',
                    'required',
                    'FREE_TIME_DEMURRAGE-' . $urutan,
                ],

                [
                    'number-master',
                    'HARGA[]',
                    [],
                    'Harga',
                    'prajoa.json',
                    config('prajoa.table_headers'),
                    config('prajoa.columns_shown'),
                    7,
                    'required',
                    'specialprice.json',
                    config('specialprice.table_headers'),
                    config('specialprice.columns_shown'),
                    'HARGA-' . $urutan

                ],

                ['dropdown', 'Satuan Harga', $array_unit_dropdown, 'SATUAN_HARGA[]', '', 'SATUAN_HARGA-' . $urutan, 'SATUAN_HARGA'],

            ],


        ])->render();

        return response()->json(['html' => $componentHTML]);
    }

    public function findByKode(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/offer" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    // make a delete function
    public function delete(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/offer" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    // make an update function
    public function update(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/offer" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->put($url, $request->all());
        // dd($response->json());
        // if success then return success else error for ajax response
        // if ($response->json()['status'] == 'success') {
        //     return response()->json(['status' => 'success']);
        // } else {
        //     return response()->json(['status' => 'error']);
        // }
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    public function store(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/offer";
        //post with token
        $response = Http::withToken($providedToken)->post($url, $request->all());
        //return with named route
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    // make me an index to return data to negara.blade.php
    public function index(Request $request)
    {
        $providedToken = $request->cookie('token');

        $table_headers = config('penawaran.table_headers_penawaran');
        $columns_shown = config('penawaran.columns_shown_penawaran');

        $url_all_dropdown = env('API_URL') . "/offer/dropdown";
        $response_all_dropdown = Http::withToken($providedToken)->get($url_all_dropdown);
        $data_all_dropdown = $response_all_dropdown->json();

        // dropdown to fetch customer
        // $url_dropdown_customer = env('API_URL') . "/customer/dropdown";
        // $response_dropdown_customer = Http::withToken($providedToken)->get($url_dropdown_customer);
        // $data_dropdown_customer = $response_dropdown_customer->json();
        $customers = $data_all_dropdown['data']['customers'];
        $array_customer_dropdown = [];
        foreach ($customers as $customer) {
            $array_customer_dropdown[$customer['KODE']] = $customer['NAMA'];
        }




        // dropdown to fetch harbors
        // $url_dropdown_harbor = env('API_URL') . "/harbor";
        // $response_dropdown_harbor = Http::withToken($providedToken)->get($url_dropdown_harbor);
        // $data_dropdown_harbor = $response_dropdown_harbor->json();
        $harbors = $data_all_dropdown['data']['harbors'];
        $array_harbor_dropdown = [];
        foreach ($harbors as $harbor) {
            $array_harbor_dropdown[$harbor['KODE']] = $harbor['NAMA_PELABUHAN'];
        }


        // dropdown to fetch size
        // $url_dropdown_size = env('API_URL') . "/size";
        // $response_dropdown_size = Http::withToken($providedToken)->get($url_dropdown_size);
        // $data_dropdown_size = $response_dropdown_size->json();
        $sizes = $data_all_dropdown['data']['sizes'];
        $array_size_dropdown = [];
        foreach ($sizes as $size) {
            $array_size_dropdown[$size['KODE']] = $size['NAMA'];
        }

        // dropdown to fetch container-type
        // $url_dropdown_containertype = env('API_URL') . "/container-type";
        // $response_dropdown_containertype = Http::withToken($providedToken)->get($url_dropdown_containertype);
        // $data_dropdown_containertype = $response_dropdown_containertype->json();
        $containertypes = $data_all_dropdown['data']['containerTypes'];
        $array_containertype_dropdown = [];
        foreach ($containertypes as $containertype) {
            $array_containertype_dropdown[$containertype['KODE']] = $containertype['NAMA'];
        }

        // order-type
        // $url_dropdown_ordertype = env('API_URL') . "/order-type";
        // $response_dropdown_ordertype = Http::withToken($providedToken)->get($url_dropdown_ordertype);
        // $data_dropdown_ordertype = $response_dropdown_ordertype->json();
        $ordertypes = $data_all_dropdown['data']['orderTypes'];
        $array_ordertype_dropdown = [];
        foreach ($ordertypes as $ordertype) {
            $array_ordertype_dropdown[$ordertype['KODE']] = $ordertype['NAMA'];
        }

        // commodity
        // $url_dropdown_commodity = env('API_URL') . "/commodity";
        // $response_dropdown_commodity = Http::withToken($providedToken)->get($url_dropdown_commodity);
        // $data_dropdown_commodity = $response_dropdown_commodity->json();
        $commodities = $data_all_dropdown['data']['commodities'];
        $array_commodity_dropdown = [];
        foreach ($commodities as $commodity) {
            $array_commodity_dropdown[$commodity['KODE']] = $commodity['NAMA'];
        }

        // service
        // $url_dropdown_service = env('API_URL') . "/service";
        // $response_dropdown_service = Http::withToken($providedToken)->get($url_dropdown_service);
        // $data_dropdown_service = $response_dropdown_service->json();
        $services = $data_all_dropdown['data']['services'];
        $array_service_dropdown = [];
        foreach ($services as $service) {
            $array_service_dropdown[$service['KODE']] = $service['NAMA'];
        }








        // truckroute
        // $url_dropdown_truckroute = env('API_URL') . "/truckroute";
        // $response_dropdown_truckroute = Http::withToken($providedToken)->get($url_dropdown_truckroute);
        // $data_dropdown_truckroute = $response_dropdown_truckroute->json();
        $truckroutes = $data_all_dropdown['data']['truckRoutes'];
        $array_truckroutes_dropdown = [];
        foreach ($truckroutes as $truckroute) {
            $array_truckroutes_dropdown[$truckroute['KODE']] = $truckroute['RUTE_ASAL'] . "-" . $truckroute['RUTE_TUJUAN'];
        }

        //unit
        // $url_dropdown_unit = env('API_URL') . "/unit";
        // $response_dropdown_unit = Http::withToken($providedToken)->get($url_dropdown_unit);
        // $data_dropdown_unit = $response_dropdown_unit->json();
        $units = $data_all_dropdown['data']['units'];
        $array_unit_dropdown = [];
        foreach ($units as $unit) {
            $array_unit_dropdown[$unit['KODE']] = $unit['NAMA_SATUAN'];
        }



        // $url_dropdown_sales = env('API_URL') . "/staff/jabatan/JBT.6";
        // $response_dropdown_sales = Http::withToken($providedToken)->get($url_dropdown_sales);
        // $data_dropdown_sales = $response_dropdown_sales->json();
        $sales = $data_all_dropdown['data']['staffs'];
        $array_sales_dropdown = [];
        foreach ($sales as $sale) {
            $array_sales_dropdown[$sale['KODE']] = $sale['NAMA'];
        }






        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/offer";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        //get $data['data']['negara'] length
        $length = count($data['data']);
        if ($length > 0) {
            // $keys = array_keys($data['data']['negara'][0]);
            return view('pages.2joa.3penawaran.penawaran', [
                'type_menu' => 'layout-joa', 'type_submenu' => '', 'data' => $data['data'], 'keys' => $columns_shown, 'table_headers' => $table_headers,
                'array_customers_dropdown' => $array_customer_dropdown,
                'array_harbor_dropdown' => $array_harbor_dropdown,
                'array_size_dropdown' => $array_size_dropdown,
                'array_containertype_dropdown' => $array_containertype_dropdown,
                'array_ordertype_dropdown' => $array_ordertype_dropdown,
                'array_commodity_dropdown' => $array_commodity_dropdown,
                'array_service_dropdown' => $array_service_dropdown,
                'array_truckroutes_dropdown' => $array_truckroutes_dropdown,
                'array_sales_dropdown' => $array_sales_dropdown,
                'array_unit_dropdown' => $array_unit_dropdown,



            ]);
        } else {
            return view('pages.2joa.3penawaran.penawaran', [
                'type_menu' => 'layout-joa', 'type_submenu' => '', 'data' => [], 'keys' => $columns_shown, 'table_headers' => $table_headers,
                'array_customers_dropdown' => $array_customer_dropdown,
                'array_harbor_dropdown' => $array_harbor_dropdown,
                'array_size_dropdown' => $array_size_dropdown,
                'array_containertype_dropdown' => $array_containertype_dropdown,
                'array_ordertype_dropdown' => $array_ordertype_dropdown,
                'array_commodity_dropdown' => $array_commodity_dropdown,
                'array_service_dropdown' => $array_service_dropdown,
                'array_truckroutes_dropdown' => $array_truckroutes_dropdown,
                'array_sales_dropdown' => $array_sales_dropdown,
                'array_unit_dropdown' => $array_unit_dropdown,

            ]);
        }
    }



    public function viewInvoice(Request $request, $KODE)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/offer/viewDetail/" . $KODE;
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json()['data']['DATA'];

        return view('components.offer-print', [
            'data' => $data,
        ]);
    }

    public function generateInvoice(Request $request, $KODE)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/offer/viewDetail/" . $KODE;
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json()['data']['DATA'];
        $data2 = ['data' => $data];


        $pdf = Pdf::loadView('components.offer-generate', $data2);
        $todayDate = Carbon::now()->format('d-m-Y');
        return $pdf->download('invoice-' . $KODE . '-' . $todayDate . '.pdf');
    }


    public function indexMaster(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/pra-joa";

        // Get the JSON response from the API
        $response = Http::withToken($providedToken)->get($url);

        // Check if the response is successful
        if ($response->successful()) {
            // Retrieve the JSON data from the response
            $data = $response->json();

            // Remove the "deleted_at" column from each item in the data
            $data['data'] = array_map(function ($item) {
                unset($item['deleted_at']);
                // unset($item['KODE_POL']);
                return $item;
            }, $data['data']);

            // Return the modified JSON data as a JSON response with the appropriate status code
            return response()->json($data, $response->status());
        } else {
            // If the response is not successful, return the response as it is with the appropriate status code
            return response()->json($response->json(), $response->status());
        }
    }

    public function indexTruckPrice(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/truck-price";

        // Get the JSON response from the API
        $response = Http::withToken($providedToken)->get($url);

        // Check if the response is successful
        if ($response->successful()) {
            // Retrieve the JSON data from the response
            $data = $response->json();

            // Remove the "deleted_at" column from each item in the data
            $data['data'] = array_map(function ($item) {
                unset($item['updated_at']);
                unset($item['created_at']);
                unset($item['deleted_at']);
                // unset($item['KODE_POL']);
                return $item;
            }, $data['data']);

            // Return the modified JSON data as a JSON response with the appropriate status code
            return response()->json($data, $response->status());
        } else {
            // If the response is not successful, return the response as it is with the appropriate status code
            return response()->json($response->json(), $response->status());
        }
    }

    public function indexHargaLCL(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/special-price";

        // Get the JSON response from the API
        $response = Http::withToken($providedToken)->get($url);

        // Check if the response is successful
        if ($response->successful()) {
            // Retrieve the JSON data from the response
            $data = $response->json();

            // Remove the "deleted_at" column from each item in the data
            $data['data'] = array_map(function ($item) {
                unset($item['updated_at']);
                unset($item['created_at']);
                unset($item['deleted_at']);
                // unset($item['KODE_POL']);
                return $item;
            }, $data['data']);

            // Return the modified JSON data as a JSON response with the appropriate status code
            return response()->json($data, $response->status());
        } else {
            // If the response is not successful, return the response as it is with the appropriate status code
            return response()->json($response->json(), $response->status());
        }
    }


    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/offer/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to get trash data from Route::delete('/offer/trash', [NegaraController::class, 'trash'])->name('negara.trash');
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/offer/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/offer/restore', [NegaraController::class, 'restore'])->name('negara.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/offer/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}