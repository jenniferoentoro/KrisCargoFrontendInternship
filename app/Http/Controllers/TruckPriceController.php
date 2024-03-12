<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TruckPriceController extends Controller
{

    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/truck-price/json-adv";

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
        $url = env('API_URL') . "/truck-price/json";

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
        $url = env('API_URL') . "/truck-price" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }


    public function findByKodeProvince(Request $request, $KODE)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/truck-price/byProvince/" . $KODE;

        // GET request to fetch cities by KODE_PROVINCE from the API
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();

        if ($response->successful()) {
            $cities = $data['data'];

            return view('your.view', ['cities' => $cities]);
        } else {
            $errorMessage = $data['message'] ?? 'Failed to retrieve cities';

            return view('your.error.view', ['errorMessage' => $errorMessage]);
        }
    }


    public function index(Request $request)
    {
        $providedToken = $request->cookie('token');

        $table_headers = ['Action', 'Kode', 'Rute Truck', 'Customer', 'Nama Commodity', 'Nama Truck', 'Berlaku', 'Harga Jual', 'Keterangan'];
        $columns_shown = ['KODE', 'NAMA_RUTE_TRUCK', 'NAMA_CUSTOMER', 'NAMA_COMMODITY', 'NAMA_TRUCK', 'BERLAKU', 'HARGA_JUAL', 'KETERANGAN'];

        $url_all_dropdown = env('API_URL') . "/truck-price/dropdown";
        $response_all_dropdown = Http::withToken($providedToken)->get($url_all_dropdown);
        $data_all_dropdown = $response_all_dropdown->json();

        // $url_dropdown_city = env('API_URL') . "/truckroute";
        // $response_dropdown_city = Http::withToken($providedToken)->get($url_dropdown_city);
        // $data_dropdown_city = $response_dropdown_city->json();
        $truck_routes = $data_all_dropdown['data']['truckRoutes'];
        $array_rute_truck_dropdown = [];
        foreach ($truck_routes as $truck_route) {
            $array_rute_truck_dropdown[$truck_route['KODE']] = $truck_route['KODE'] . ' | ' . $truck_route['RUTE_ASAL'] . ' - ' . $truck_route['RUTE_TUJUAN'];
        }

        // CUSTOMER
        // make url for dropdown customer
        // $url_dropdown_customer = env('API_URL') . "/customer";
        // $response_dropdown_customer = Http::withToken($providedToken)->get($url_dropdown_customer);
        // $data_dropdown_customer = $response_dropdown_customer->json();
        $customers = $data_all_dropdown['data']['customers'];
        $array_customer_dropdown = [];
        foreach ($customers as $customer) {
            $array_customer_dropdown[$customer['KODE']] = $customer['NAMA'];
        }


        // make url for dropdown cost-group
        // $url_dropdown_cost_group = env('API_URL') . "/size";
        // $response_dropdown_cost_group = Http::withToken($providedToken)->get($url_dropdown_cost_group);
        // $data_dropdown_cost_group = $response_dropdown_cost_group->json();
        // $cost_groups = $data_dropdown_cost_group['data'];
        // $array_cost_ukuran_dropdown = [];
        // foreach ($cost_groups as $cost_group) {
        //     $array_cost_ukuran_dropdown[$cost_group['KODE']] = $cost_group['KETERANGAN'];
        // }

        // get vendor from API
        // $url_dropdown_vendor = env('API_URL') . "/vendor";
        // $response_dropdown_vendor = Http::withToken($providedToken)->get($url_dropdown_vendor);
        // $data_dropdown_vendor = $response_dropdown_vendor->json();
        // $vendors = $data_dropdown_vendor['data'];
        // $array_vendor_dropdown = [];
        // foreach ($vendors as $vendor) {
        //     $array_vendor_dropdown[$vendor['KODE']] = $vendor['NAMA'];
        // }


        // API endpoint to fetch commodity
        // $url_dropdown_commodity = env('API_URL') . "/commodity";
        // $response_dropdown_commodity = Http::withToken($providedToken)->get($url_dropdown_commodity);
        // $data_dropdown_commodity = $response_dropdown_commodity->json();
        $commodities = $data_all_dropdown['data']['commodities'];
        $array_commodity_dropdown = [];
        foreach ($commodities as $commodity) {
            $array_commodity_dropdown[$commodity['KODE']] = $commodity['NAMA'];
        }

        //api for truck
        // $url_dropdown_truck = env('API_URL') . "/truck";
        // $response_dropdown_truck = Http::withToken($providedToken)->get($url_dropdown_truck);
        // $data_dropdown_truck = $response_dropdown_truck->json();
        $trucks = $data_all_dropdown['data']['trucks'];
        $array_truck_dropdown = [];
        foreach ($trucks as $truck) {
            $array_truck_dropdown[$truck['KODE']] = $truck['NAMA'];
        }





        // $url = env('API_URL') . "/truck-price";

        // // GET request to fetch cities from the API
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();


        $data = [];
        $length = 0;
        // Check if the response is successful and retrieve the cities
        if ($length > 0) {
            $cities = $data['data'];

            $keys = count($cities) > 0 ? array_keys($cities[0]) : [];
            return view('pages.1master.4truck.truckprice', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-truck',
                'data' => $cities,
                'keys' => $columns_shown,
                'table_headers' => $table_headers,
                'array_rute_truck_dropdown' => $array_rute_truck_dropdown,
                'array_truck_dropdown' => $array_truck_dropdown,
                'array_customer_dropdown' => $array_customer_dropdown,

                'array_commodity_dropdown' => $array_commodity_dropdown,

            ]);
        } else {
            $errorMessage = $data['message'] ?? 'Failed to retrieve cities';

            return view('pages.1master.4truck.truckprice', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-truck',
                'data' => [],
                'keys' => $columns_shown,
                'errorMessage' => $errorMessage,
                'table_headers' => $table_headers,
                'array_rute_truck_dropdown' => $array_rute_truck_dropdown,
                'array_truck_dropdown' => $array_truck_dropdown,
                'array_customer_dropdown' => $array_customer_dropdown,
                'array_commodity_dropdown' => $array_commodity_dropdown,


            ]);
        }
    }

    // $table->string("KODE")->primary();
    // $table->string('NAMA_PELABUHAN');
    // $table->unsignedBigInteger('KODE_KOTA');
    // $table->string('KETERANGAN');
    // $table->foreign('KODE_KOTA')->references('KODE')->on('cities')->onDelete('restrict');
    // $table->softDeletes();
    public function update(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/truck-price" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->put($url, [
            "KODE_RUTE_TRUCK" => $request->KODE_RUTE_TRUCK,
            // "KODE_VENDOR" => $request->KODE_VENDOR,
            // "UK_KONTAINER" => $request->UK_KONTAINER,
            "KODE_CUSTOMER" => $request->KODE_CUSTOMER,
            "KODE_COMMODITY" => $request->KODE_COMMODITY,
            "KODE_TRUCK" => $request->KODE_TRUCK,
            "BERLAKU" => $request->BERLAKU,
            "HARGA_JUAL" => $request->HARGA_JUAL,
            "KETERANGAN" => $request->KETERANGAN,
        ]);
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
        $url = env('API_URL') . "/truck-price";
        //post with token
        $response = Http::withToken($providedToken)->post($url, [

            "KODE_RUTE_TRUCK" => $request->KODE_RUTE_TRUCK,
            // "KODE_VENDOR" => $request->KODE_VENDOR,
            // "UK_KONTAINER" => $request->UK_KONTAINER,
            "KODE_CUSTOMER" => $request->KODE_CUSTOMER,
            "KODE_COMMODITY" => $request->KODE_COMMODITY,
            "KODE_TRUCK" => $request->KODE_TRUCK,
            "BERLAKU" => $request->BERLAKU,
            "HARGA_JUAL" => $request->HARGA_JUAL,
            "KETERANGAN" => $request->KETERANGAN,
        ]);
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

    public function delete(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/truck-price" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/truck-price/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/truck-price/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/truck-price/restore', [cityController::class, 'restore'])->name('city.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/truck-price/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
