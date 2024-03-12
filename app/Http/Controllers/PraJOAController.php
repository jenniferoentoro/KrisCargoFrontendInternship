<?php

namespace App\Http\Controllers;

use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PraJOAController extends Controller
{

    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/pra-joa/json-adv";

        $response = Http::withToken($providedToken)->post($url, $request->all());
        // return $response->json();
        $data = $response['data'];
        $totalRecords = $data['recordsTotal'];
        $filteredRecords = $data['recordsFiltered'];

        return [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data['data'],
        ];
    }

    public function dataTableJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/pra-joa/json";

        $response = Http::withToken($providedToken)->post($url, $request->all());
        // return $response->json();
        $data = $response['data'];
        $totalRecords = $data['recordsTotal'];
        $filteredRecords = $data['recordsFiltered'];

        return [
            'draw' => $request->input('draw'),
            'recordsTotal' => $totalRecords,
            'recordsFiltered' => $filteredRecords,
            'data' => $data['data'],
        ];
    }

    public function findByKode(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/pra-joa" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    // make a delete function
    public function delete(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/pra-joa" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    // make an update function
    public function update(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/pra-joa" . "/" . $request->KODE;

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
        $url = env('API_URL') . "/pra-joa";
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

        $table_headers = config('prajoa.table_headers');
        $columns_shown = config('prajoa.columns_shown');

        $url_all_dropdown = env('API_URL') . "/pra-joa/dropdown";
        $response_all_dropdown = Http::withToken($providedToken)->get($url_all_dropdown);
        $data_all_dropdown = $response_all_dropdown->json();

        // vendor which kode
        // $url_dropdown_vendor = env('API_URL') . "/vendor";
        // $response_dropdown_vendor = Http::withToken($providedToken)->get($url_dropdown_vendor);
        // $data_dropdown_vendor = $response_dropdown_vendor->json();
        $vendors = $data_all_dropdown['data']['vendors'];
        $array_vendor_dropdown = [];
        foreach ($vendors as $vendor) {
            if ($vendor['KODE_JENIS_VENDOR'] == 'JV.1' || $vendor['KODE_JENIS_VENDOR'] == 'JV.6') {
                $array_vendor_dropdown[$vendor['KODE']] = $vendor['NAMA'];
            }
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
            $array_size_dropdown[$size['KODE']] = $size['KODE'];
        }

        // dropdown to fetch container-type
        // $url_dropdown_containertype = env('API_URL') . "/container-type";
        // $response_dropdown_containertype = Http::withToken($providedToken)->get($url_dropdown_containertype);
        // $data_dropdown_containertype = $response_dropdown_containertype->json();
        $containertypes = $data_all_dropdown['data']['containerTypes'];
        $array_containertype_dropdown = [];
        foreach ($containertypes as $containertype) {
            $array_containertype_dropdown[$containertype['KODE']] = $containertype['KODE'];
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
            $array_service_dropdown[$service['KODE']] = $service['KODE'];
        }

        // thc-lolo-port-loading
        // $url_dropdown_thcloloportloading = env('API_URL') . "/thc-lolo-port-loading";
        // $response_dropdown_thcloloportloading = Http::withToken($providedToken)->get($url_dropdown_thcloloportloading);
        // $data_dropdown_thcloloportloading = $response_dropdown_thcloloportloading->json();
        // $thcloloportloadings = $data_dropdown_thcloloportloading['data'];
        // $array_thcloloportloading_dropdown = [];
        // foreach ($thcloloportloadings as $thcloloportloading) {
        //     $array_thcloloportloading_dropdown[$thcloloportloading['KODE']] = "THC = "  . $thcloloportloading['THC'] . " - Lolo Luar " . $thcloloportloading['LOLO_LUAR'] . " - Lolo Dalam " . $thcloloportloading['LOLO_DALAM'];
        // }

        // thc-lolo-port-discharge
        // $url_dropdown_thcloloportdischarge = env('API_URL') . "/thc-lolo-port-discharge";
        // $response_dropdown_thcloloportdischarge = Http::withToken($providedToken)->get($url_dropdown_thcloloportdischarge);
        // $data_dropdown_thcloloportdischarge = $response_dropdown_thcloloportdischarge->json();
        // $thcloloportdischarges = $data_dropdown_thcloloportdischarge['data'];
        // $array_thcloloportdischarge_dropdown = [];
        // foreach ($thcloloportdischarges as $thcloloportdischarge) {
        //     $array_thcloloportdischarge_dropdown[$thcloloportdischarge['KODE']] = "THC = "  . $thcloloportdischarge['THC'] . " - Lolo Luar " . $thcloloportdischarge['LOLO_LUAR'] . " - Lolo Dalam " . $thcloloportdischarge['LOLO_DALAM'];
        // }

        //thc-lolo
        // $url_dropdown_thclolo = env('API_URL') . "/thc-lolo";
        // $response_dropdown_thclolo = Http::withToken($providedToken)->get($url_dropdown_thclolo);
        // $data_dropdown_thclolo = $response_dropdown_thclolo->json();
        $thclolos = $data_all_dropdown['data']['thcLolos'];
        $array_thclolo_dropdown = [];
        foreach ($thclolos as $thclolo) {
            $array_thclolo_dropdown[$thclolo['KODE']] = "THC = "  . $thclolo['THC'] . " - Lolo Luar = " . $thclolo['LOLO_LUAR'] . " - Lolo Dalam = " . $thclolo['LOLO_DALAM'];
        }


        // cost-rate
        // $url_dropdown_costrate = env('API_URL') . "/cost-rate";
        // $response_dropdown_costrate = Http::withToken($providedToken)->get($url_dropdown_costrate);
        // $data_dropdown_costrate = $response_dropdown_costrate->json();
        $costrates = $data_all_dropdown['data']['costRates'];
        $array_costrate_dropdown = [];
        foreach ($costrates as $costrate) {
            $array_costrate_dropdown[$costrate['KODE']] = $costrate['TARIF'] . " - " . $costrate['KETERANGAN'];
        }

        // truckroute
        // $url_dropdown_truckroute = env('API_URL') . "/truckroute";
        // $response_dropdown_truckroute = Http::withToken($providedToken)->get($url_dropdown_truckroute);
        // $data_dropdown_truckroute = $response_dropdown_truckroute->json();
        $truckroutes = $data_all_dropdown['data']['truckRoutes'];
        $array_truckroutes_dropdown = [];
        foreach ($truckroutes as $truckroute) {
            $array_truckroutes_dropdown[$truckroute['KODE']] = $truckroute['RUTE_ASAL'] . " - " . $truckroute['RUTE_TUJUAN'];
        }

        // $url_dropdown_city = env('API_URL') . "/cost";
        // $response_dropdown_city = Http::withToken($providedToken)->get($url_dropdown_city);
        // $data_dropdown_city = $response_dropdown_city->json();
        $costs = $data_all_dropdown['data']['costs'];
        $array_cost_dropdown = [];
        foreach ($costs as $cost) {
            $array_cost_dropdown[$cost['KODE']] = $cost['NAMA_BIAYA'];
        }

        // make url for dropdown cost-group
        // $url_dropdown_cost_group = env('API_URL') . "/cost-group";
        // $response_dropdown_cost_group = Http::withToken($providedToken)->get($url_dropdown_cost_group);
        // $data_dropdown_cost_group = $response_dropdown_cost_group->json();
        $cost_groups = $data_all_dropdown['data']['costGroups'];
        $array_cost_ukuran_dropdown = [];
        foreach ($cost_groups as $cost_group) {
            $array_cost_ukuran_dropdown[$cost_group['KODE']] = $cost_group['NAMA'];
        }








        // API endpoint to fetch customer
        // $url_dropdown_customer = env('API_URL') . "/customer/dropdown";
        // $response_dropdown_customer = Http::withToken($providedToken)->get($url_dropdown_customer);
        // $data_dropdown_customer = $response_dropdown_customer->json();
        $customers = $data_all_dropdown['data']['customers'];
        $array_customers_dropdown = [];
        foreach ($customers as $customer) {
            $array_customers_dropdown[$customer['KODE']] = $customer['NAMA'];
        }

        // $url_dropdown_truckroute = env('API_URL') . "/truckroute";
        // $response_dropdown_truckroute = Http::withToken($providedToken)->get($url_dropdown_truckroute);
        // $data_dropdown_truckroute = $response_dropdown_truckroute->json();
        $truckroutes = $data_all_dropdown['data']['truckRoutes'];
        $array_truckroutesasal_dropdown = [];
        $array_truckroutestujuan_dropdown = [];
        foreach ($truckroutes as $truckroute) {
            $array_truckroutesasal_dropdown[$truckroute['RUTE_ASAL']] = $truckroute['KODE'];
            $array_truckroutestujuan_dropdown[$truckroute['RUTE_TUJUAN']] = $truckroute['KODE'];
        }




        // $url_dropdown_city = env('API_URL') . "/city/dropdown";
        // $response_dropdown_city = Http::withToken($providedToken)->get($url_dropdown_city);
        // $data_dropdown_city = $response_dropdown_city->json();
        $cities = $data_all_dropdown['data']['cities'];
        $array_cities_dropdown = [];
        foreach ($cities as $city) {
            $array_cities_dropdown[$city['KODE']] = $city['NAMA'];
        }







        // $providedToken = $request->cookie('token');
        // $url = env('API_URL') . "/pra-joa";
        // //post with token
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();
        // //get $data['data']['negara'] length
        // $length = count($data['data']);
        $data = [];
        $length = 0;
        if ($length > 0) {
            // $keys = array_keys($data['data']['negara'][0]);
            return view('pages.2joa.1prajoa.prajoa', [
                'type_menu' => 'layout-joa', 'type_submenu' => '', 'data' => $data['data'], 'keys' => $columns_shown, 'table_headers' => $table_headers,
                'array_harbor_dropdown' => $array_harbor_dropdown,
                'array_size_dropdown' => $array_size_dropdown,
                'array_containertype_dropdown' => $array_containertype_dropdown,
                'array_ordertype_dropdown' => $array_ordertype_dropdown,
                'array_commodity_dropdown' => $array_commodity_dropdown,
                'array_service_dropdown' => $array_service_dropdown,
                'array_vendor_dropdown' => $array_vendor_dropdown,
                // 'array_thcloloportloading_dropdown' => $array_thcloloportloading_dropdown,
                // 'array_thcloloportdischarge_dropdown' => $array_thcloloportdischarge_dropdown,
                'array_costrate_dropdown' => $array_costrate_dropdown,
                'array_truckroutes_dropdown' => $array_truckroutes_dropdown,
                'array_cost_dropdown' => $array_cost_dropdown,
                'array_cost_ukuran_dropdown' => $array_cost_ukuran_dropdown,
                'array_vendor_dropdown' => $array_vendor_dropdown,

                'array_customers_dropdown' => $array_customers_dropdown,
                'array_cities_dropdown' => $array_cities_dropdown,
                'array_truckroutesasal_dropdown' => $array_truckroutesasal_dropdown,
                'array_truckroutestujuan_dropdown' => $array_truckroutestujuan_dropdown,
                'array_thclolo_dropdown' => $array_thclolo_dropdown,



            ]);
        } else {
            return view('pages.2joa.1prajoa.prajoa', [
                'type_menu' => 'layout-joa', 'type_submenu' => '', 'data' => [], 'keys' => $columns_shown, 'table_headers' => $table_headers,
                'array_harbor_dropdown' => $array_harbor_dropdown,
                'array_size_dropdown' => $array_size_dropdown,
                'array_containertype_dropdown' => $array_containertype_dropdown,
                'array_ordertype_dropdown' => $array_ordertype_dropdown,
                'array_commodity_dropdown' => $array_commodity_dropdown,
                'array_service_dropdown' => $array_service_dropdown,
                'array_vendor_dropdown' => $array_vendor_dropdown,
                // 'array_thcloloportloading_dropdown' => $array_thcloloportloading_dropdown,
                // 'array_thcloloportdischarge_dropdown' => $array_thcloloportdischarge_dropdown,
                'array_costrate_dropdown' => $array_costrate_dropdown,
                'array_truckroutes_dropdown' => $array_truckroutes_dropdown,
                'array_cost_dropdown' => $array_cost_dropdown,
                'array_cost_ukuran_dropdown' => $array_cost_ukuran_dropdown,
                'array_customers_dropdown' => $array_customers_dropdown,
                'array_cities_dropdown' => $array_cities_dropdown,
                'array_truckroutesasal_dropdown' => $array_truckroutesasal_dropdown,
                'array_truckroutestujuan_dropdown' => $array_truckroutestujuan_dropdown,
                'array_thclolo_dropdown' => $array_thclolo_dropdown,
            ]);
        }
    }

    //do async request to get data from API
    // public function index(Request $request)
    // {
    //     $providedToken = $request->cookie('token');

    //     $table_headers = config('prajoa.table_headers');
    //     $columns_shown = config('prajoa.columns_shown');

    //     // Define an array of URLs to fetch data from
    //     $url_dropdowns = [
    //         'vendor' => env('API_URL') . "/vendor",
    //         'harbor' => env('API_URL') . "/harbor",
    //         'size' => env('API_URL') . "/size",
    //         'container-type' => env('API_URL') . "/container-type",
    //         'order-type' => env('API_URL') . "/order-type",
    //         'commodity' => env('API_URL') . "/commodity",
    //         'service' => env('API_URL') . "/service",
    //         'thc-lolo' => env('API_URL') . "/thc-lolo",
    //         'cost-rate' => env('API_URL') . "/cost-rate",
    //         'truckroute' => env('API_URL') . "/truckroute",
    //         'city' => env('API_URL') . "/city/dropdown",
    //         'cost-group' => env('API_URL') . "/cost-group",
    //         'customer' => env('API_URL') . "/customer/dropdown",
    //     ];

    //     // Initialize an array to hold the promises
    //     $promises = [];

    //     // Make asynchronous HTTP requests for each dropdown URL
    //     foreach ($url_dropdowns as $key => $url) {
    //         $promise = Http::async()->withToken($providedToken)->get($url);
    //         $promises[$key] = $promise;
    //     }

    //     // Wait for all promises to be fulfilled
    //     $responses = [];
    //     foreach ($promises as $key => $promise) {
    //         $responses[$key] = $promise->wait();
    //     }

    //     // Process the responses and populate dropdown arrays as needed
    //     $array_vendor_dropdown = [];
    //     $array_harbor_dropdown = [];
    //     $array_size_dropdown = [];
    //     $array_containertype_dropdown = [];
    //     $array_ordertype_dropdown = [];
    //     $array_commodity_dropdown = [];
    //     $array_service_dropdown = [];
    //     $array_thclolo_dropdown = [];
    //     $array_costrate_dropdown = [];
    //     $array_truckroutes_dropdown = [];
    //     $array_cost_dropdown = [];
    //     $array_cost_ukuran_dropdown = [];
    //     $array_customers_dropdown = [];
    //     $array_cities_dropdown = [];
    //     $array_truckroutesasal_dropdown = [];
    //     $array_truckroutestujuan_dropdown = [];

    //     foreach ($responses as $key => $response) {
    //         $data = $response->json()['data'];
    //         switch ($key) {
    //             case 'vendor':
    //                 // Populate $array_vendor_dropdown
    //                 // ...
    //                 foreach ($data as $vendor) {
    //                     if ($vendor['KODE_JENIS_VENDOR'] == 'JV.1' || $vendor['KODE_JENIS_VENDOR'] == 'JV.6') {
    //                         $array_vendor_dropdown[$vendor['KODE']] = $vendor['NAMA'];
    //                     }
    //                 }

    //                 break;
    //             case 'harbor':
    //                 // Populate $array_harbor_dropdown
    //                 // ...
    //                 foreach ($data as $harbor) {
    //                     $array_harbor_dropdown[$harbor['KODE']] = $harbor['NAMA_PELABUHAN'];
    //                 }

    //                 break;
    //             case 'size':
    //                 // Populate $array_size_dropdown
    //                 // ...
    //                 foreach ($data as $size) {
    //                     $array_size_dropdown[$size['KODE']] = $size['KODE'];
    //                 }

    //                 break;
    //             case 'container-type':
    //                 // Populate $array_containertype_dropdown
    //                 // ...
    //                 foreach ($data as $containertype) {
    //                     $array_containertype_dropdown[$containertype['KODE']] = $containertype['KODE'];
    //                 }

    //                 break;

    //             case 'order-type':
    //                 // Populate $array_ordertype_dropdown
    //                 // ...
    //                 foreach ($data as $ordertype) {
    //                     $array_ordertype_dropdown[$ordertype['KODE']] = $ordertype['NAMA'];
    //                 }

    //                 break;

    //             case 'commodity':
    //                 // Populate $array_commodity_dropdown
    //                 // ...
    //                 foreach ($data as $commodity) {
    //                     $array_commodity_dropdown[$commodity['KODE']] = $commodity['NAMA'];
    //                 }

    //                 break;

    //             case 'service':
    //                 // Populate $array_service_dropdown
    //                 // ...
    //                 foreach ($data as $service) {
    //                     $array_service_dropdown[$service['KODE']] = $service['KODE'];
    //                 }

    //                 break;

    //             case 'thc-lolo':
    //                 // Populate $array_thclolo_dropdown
    //                 // ...
    //                 foreach ($data as $thclolo) {
    //                     $array_thclolo_dropdown[$thclolo['KODE']] = "THC = "  . $thclolo['THC'] . " - Lolo Luar " . $thclolo['LOLO_LUAR'] . " - Lolo Dalam " . $thclolo['LOLO_DALAM'];
    //                 }

    //                 break;

    //             case 'cost-rate':
    //                 // Populate $array_costrate_dropdown
    //                 // ...
    //                 foreach ($data as $costrate) {
    //                     $array_costrate_dropdown[$costrate['KODE']] = $costrate['TARIF'] . " - " . $costrate['KETERANGAN'];
    //                 }

    //                 break;

    //             case 'truckroute':
    //                 // Populate $array_truckroutes_dropdown
    //                 // ...
    //                 foreach ($data as $truckroute) {
    //                     $array_truckroutes_dropdown[$truckroute['KODE']] = $truckroute['RUTE_ASAL'] . " - " . $truckroute['RUTE_TUJUAN'];
    //                 }

    //                 break;

    //             case 'cost':
    //                 // Populate $array_cost_dropdown
    //                 // ...
    //                 foreach ($data as $cost) {
    //                     $array_cost_dropdown[$cost['KODE']] = $cost['NAMA_BIAYA'];
    //                 }

    //                 break;

    //             case 'cost-group':
    //                 // Populate $array_cost_ukuran_dropdown
    //                 // ...
    //                 foreach ($data as $cost_group) {
    //                     $array_cost_ukuran_dropdown[$cost_group['KODE']] = $cost_group['NAMA'];
    //                 }

    //                 break;

    //             case 'customer':
    //                 // Populate $array_customers_dropdown
    //                 // ...
    //                 foreach ($data as $customer) {
    //                     $array_customers_dropdown[$customer['KODE']] = $customer['NAMA'];
    //                 }

    //                 break;

    //             case 'city':
    //                 // Populate $array_cities_dropdown
    //                 // ...
    //                 foreach ($data as $city) {
    //                     $array_cities_dropdown[$city['KODE']] = $city['NAMA'];
    //                 }

    //                 break;

    //             default:
    //                 break;
    //         }
    //     }

    //     $providedToken = $request->cookie('token');
    //     $url = env('API_URL') . "/pra-joa";
    //     //post with token
    //     $response = Http::withToken($providedToken)->get($url);
    //     $data = $response->json();
    //     //get $data['data']['negara'] length
    //     $length = count($data['data']);
    //     if ($length > 0) {
    //         // $keys = array_keys($data['data']['negara'][0]);
    //         return view('pages.2joa.1prajoa.prajoa', [
    //             'type_menu' => 'layout-joa', 'type_submenu' => '', 'data' => $data['data'], 'keys' => $columns_shown, 'table_headers' => $table_headers,
    //             'array_harbor_dropdown' => $array_harbor_dropdown,
    //             'array_size_dropdown' => $array_size_dropdown,
    //             'array_containertype_dropdown' => $array_containertype_dropdown,
    //             'array_ordertype_dropdown' => $array_ordertype_dropdown,
    //             'array_commodity_dropdown' => $array_commodity_dropdown,
    //             'array_service_dropdown' => $array_service_dropdown,
    //             'array_vendor_dropdown' => $array_vendor_dropdown,
    //             // 'array_thcloloportloading_dropdown' => $array_thcloloportloading_dropdown,
    //             // 'array_thcloloportdischarge_dropdown' => $array_thcloloportdischarge_dropdown,
    //             'array_costrate_dropdown' => $array_costrate_dropdown,
    //             'array_truckroutes_dropdown' => $array_truckroutes_dropdown,
    //             'array_cost_dropdown' => $array_cost_dropdown,
    //             'array_cost_ukuran_dropdown' => $array_cost_ukuran_dropdown,
    //             'array_vendor_dropdown' => $array_vendor_dropdown,

    //             'array_customers_dropdown' => $array_customers_dropdown,
    //             'array_cities_dropdown' => $array_cities_dropdown,
    //             'array_truckroutesasal_dropdown' => $array_truckroutesasal_dropdown,
    //             'array_truckroutestujuan_dropdown' => $array_truckroutestujuan_dropdown,
    //             'array_thclolo_dropdown' => $array_thclolo_dropdown,



    //         ]);
    //     } else {
    //         return view('pages.2joa.1prajoa.prajoa', [
    //             'type_menu' => 'layout-joa', 'type_submenu' => '', 'data' => [], 'keys' => $columns_shown, 'table_headers' => $table_headers,
    //             'array_harbor_dropdown' => $array_harbor_dropdown,
    //             'array_size_dropdown' => $array_size_dropdown,
    //             'array_containertype_dropdown' => $array_containertype_dropdown,
    //             'array_ordertype_dropdown' => $array_ordertype_dropdown,
    //             'array_commodity_dropdown' => $array_commodity_dropdown,
    //             'array_service_dropdown' => $array_service_dropdown,
    //             'array_vendor_dropdown' => $array_vendor_dropdown,
    //             // 'array_thcloloportloading_dropdown' => $array_thcloloportloading_dropdown,
    //             // 'array_thcloloportdischarge_dropdown' => $array_thcloloportdischarge_dropdown,
    //             'array_costrate_dropdown' => $array_costrate_dropdown,
    //             'array_truckroutes_dropdown' => $array_truckroutes_dropdown,
    //             'array_cost_dropdown' => $array_cost_dropdown,
    //             'array_cost_ukuran_dropdown' => $array_cost_ukuran_dropdown,
    //             'array_customers_dropdown' => $array_customers_dropdown,
    //             'array_cities_dropdown' => $array_cities_dropdown,
    //             'array_truckroutesasal_dropdown' => $array_truckroutesasal_dropdown,
    //             'array_truckroutestujuan_dropdown' => $array_truckroutestujuan_dropdown,
    //             'array_thclolo_dropdown' => $array_thclolo_dropdown,
    //         ]);
    //     }
    // }




    public function indexMaster(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/pra-joa";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        //return with named route
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/pra-joa/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to get trash data from Route::delete('/pra-joa/trash', [NegaraController::class, 'trash'])->name('negara.trash');
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/pra-joa/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/pra-joa/restore', [NegaraController::class, 'restore'])->name('negara.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/pra-joa/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
