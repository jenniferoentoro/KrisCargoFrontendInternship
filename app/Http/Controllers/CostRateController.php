<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CostRateController extends Controller
{
    public function findOceanFreight(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost-rate/find-ocean-freight";
        //post with token
        $response = Http::withToken($providedToken)->post($url, $request->all());

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    public function findFreightSurcharge(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost-rate/find-freight-surcharge";
        //post with token
        $response = Http::withToken($providedToken)->post($url, $request->all());

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost-rate/json-adv";

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
        $url = env('API_URL') . "/cost-rate/json";

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
    public function indexMaster(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost-rate";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        //return with named route
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    public function findByKode(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost-rate" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }


    public function findByKodeProvince(Request $request, $KODE)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost-rate/byProvince/" . $KODE;

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

        $table_headers = ['Action', 'Kode', 'Nama Biaya', 'Nama Vendor', 'Pelabuhan Asal', 'Pelabuhan Tujuan', 'Nama Commodity', 'Ukuran Kontainer', 'Berlaku', 'Tarif', 'Keterangan', 'Customer'];
        $columns_shown = ['KODE', 'NAMA_BIAYA', 'NAMA_VENDOR', 'NAMA_PELABUHAN_ASAL', 'NAMA_PELABUHAN_TUJUAN', 'NAMA_COMMODITY',  'NAMA_UK_KONTAINER', 'TGL_BERLAKU', 'TARIF', 'KETERANGAN', 'NAMA_CUSTOMER'];

        $url_all_dropdown = env('API_URL') . "/pra-joa/dropdown";
        $response_all_dropdown = Http::withToken($providedToken)->get($url_all_dropdown);
        $data_all_dropdown = $response_all_dropdown->json();

        // $url_dropdown_city = env('API_URL') . "/cost";
        // $response_dropdown_city = Http::withToken($providedToken)->get($url_dropdown_city);
        // $data_dropdown_city = $response_dropdown_city->json();
        $cost_groups = $data_all_dropdown['data']['costs'];
        $array_cost_dropdown = [];
        foreach ($cost_groups as $cost) {
            $array_cost_dropdown[$cost['KODE']] = $cost['NAMA_BIAYA'];
        }

        // make url for dropdown cost-group
        // $url_dropdown_cost_group = env('API_URL') . "/size";
        // $response_dropdown_cost_group = Http::withToken($providedToken)->get($url_dropdown_cost_group);
        // $data_dropdown_cost_group = $response_dropdown_cost_group->json();
        $cost_groups = $data_all_dropdown['data']['sizes'];
        $array_cost_ukuran_dropdown = [];
        foreach ($cost_groups as $cost_group) {
            $array_cost_ukuran_dropdown[$cost_group['KODE']] = $cost_group['NAMA'];
        }

        // API endpoint to fetch vendor
        // $url_dropdown_vendor = env('API_URL') . "/vendor";
        // $response_dropdown_vendor = Http::withToken($providedToken)->get($url_dropdown_vendor);
        // $data_dropdown_vendor = $response_dropdown_vendor->json();
        $vendors = $data_all_dropdown['data']['vendors'];
        $array_vendor_dropdown = [];
        foreach ($vendors as $vendor) {
            $array_vendor_dropdown[$vendor['KODE']] = $vendor['NAMA'];
        }


        // API endpoint to fetch commodity
        // $url_dropdown_commodity = env('API_URL') . "/commodity";
        // $response_dropdown_commodity = Http::withToken($providedToken)->get($url_dropdown_commodity);
        // $data_dropdown_commodity = $response_dropdown_commodity->json();
        $commodities = $data_all_dropdown['data']['commodities'];
        $array_commodity_dropdown = [];
        foreach ($commodities as $commodity) {
            $array_commodity_dropdown[$commodity['KODE']] = $commodity['NAMA'];
        }

        // API endpoint to fetch pelabuhan
        // $url_dropdown_pelabuhan = env('API_URL') . "/harbor";
        // $response_dropdown_pelabuhan = Http::withToken($providedToken)->get($url_dropdown_pelabuhan);
        // $data_dropdown_pelabuhan = $response_dropdown_pelabuhan->json();
        $pelabuhans = $data_all_dropdown['data']['harbors'];
        $array_pelabuhan_dropdown = [];
        foreach ($pelabuhans as $pelabuhan) {
            $array_pelabuhan_dropdown[$pelabuhan['KODE']] = $pelabuhan['KODE'];
        }

        // API endpoint to fetch customer
        // $url_dropdown_customer = env('API_URL') . "/customer";
        // $response_dropdown_customer = Http::withToken($providedToken)->get($url_dropdown_customer);
        // $data_dropdown_customer = $response_dropdown_customer->json();
        $customers = $data_all_dropdown['data']['customers'];
        $array_customers_dropdown = [];
        foreach ($customers as $customer) {
            $array_customers_dropdown[$customer['KODE']] = $customer['NAMA'];
        }





        // $url = env('API_URL') . "/cost-rate";

        // // GET request to fetch cities from the API
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();

        $data = [];
        $length = 0;

        // Check if the response is successful and retrieve the cities
        if ($length > 0) {
            $cities = $data['data'];

            $keys = count($cities) > 0 ? array_keys($cities[0]) : [];
            return view('pages.1master.8hargalcl.costrate', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-hargalcl',
                'data' => $cities,
                'keys' => $columns_shown,
                'table_headers' => $table_headers,
                'array_cost_dropdown' => $array_cost_dropdown,
                'array_cost_ukuran_dropdown' => $array_cost_ukuran_dropdown,
                'array_vendor_dropdown' => $array_vendor_dropdown,
                'array_commodity_dropdown' => $array_commodity_dropdown,
                'array_pelabuhan_dropdown' => $array_pelabuhan_dropdown,
                'array_customers_dropdown' => $array_customers_dropdown,

            ]);
        } else {
            $errorMessage = $data['message'] ?? 'Failed to retrieve cities';

            return view('pages.1master.8hargalcl.costrate', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-hargalcl',
                'data' => [],
                'keys' => $columns_shown,
                'errorMessage' => $errorMessage,
                'table_headers' => $table_headers,
                'array_cost_dropdown' => $array_cost_dropdown,
                'array_cost_ukuran_dropdown' => $array_cost_ukuran_dropdown,
                'array_vendor_dropdown' => $array_vendor_dropdown,
                'array_commodity_dropdown' => $array_commodity_dropdown,
                'array_pelabuhan_dropdown' => $array_pelabuhan_dropdown,
                'array_customers_dropdown' => $array_customers_dropdown,


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
        $url = env('API_URL') . "/cost-rate" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->put($url, [
            "KODE_BIAYA" => $request->KODE_BIAYA,
            "KODE_VENDOR" => $request->KODE_VENDOR,
            "KODE_PELABUHAN_ASAL" => $request->KODE_PELABUHAN_ASAL,
            "KODE_PELABUHAN_TUJUAN" => $request->KODE_PELABUHAN_TUJUAN,
            "UK_KONTAINER" => $request->UK_KONTAINER,
            "KODE_COMMODITY" => $request->KODE_COMMODITY,
            "TGL_BERLAKU" => $request->TGL_BERLAKU,
            "TARIF" => $request->TARIF,
            "KETERANGAN" => $request->KETERANGAN,
            "KODE_CUSTOMER" => $request->KODE_CUSTOMER,
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
        $url = env('API_URL') . "/cost-rate";
        //post with token
        $response = Http::withToken($providedToken)->post($url, [

            "KODE_BIAYA" => $request->KODE_BIAYA,
            "KODE_VENDOR" => $request->KODE_VENDOR,
            "KODE_PELABUHAN_ASAL" => $request->KODE_PELABUHAN_ASAL,
            "KODE_PELABUHAN_TUJUAN" => $request->KODE_PELABUHAN_TUJUAN,
            "UK_KONTAINER" => $request->UK_KONTAINER,
            "KODE_COMMODITY" => $request->KODE_COMMODITY,
            "TGL_BERLAKU" => $request->TGL_BERLAKU,
            "TARIF" => $request->TARIF,
            "KETERANGAN" => $request->KETERANGAN,
            "KODE_CUSTOMER" => $request->KODE_CUSTOMER,
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
        $url = env('API_URL') . "/cost-rate" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost-rate/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost-rate/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/cost-rate/restore', [cityController::class, 'restore'])->name('city.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost-rate/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
