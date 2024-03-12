<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SpecialPriceController extends Controller
{
    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/special-price/json-adv";

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
        $url = env('API_URL') . "/special-price/json";

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
        $url = env('API_URL') . "/special-price" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }


    public function findByKodeProvince(Request $request, $KODE)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/special-price/byProvince/" . $KODE;

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

        $table_headers = ['Action', 'Kode', 'Produk', 'POL', 'POD', 'Rumus', 'Kategori', 'Harga Jual', 'Berlaku', 'Customer'];
        $columns_shown = ['KODE',  'NAMA_PRODUK', 'NAMA_POL', 'NAMA_POD', 'NAMA_RUMUS', 'NAMA_KATEGORI', 'HARGA_JUAL', 'BERLAKU', 'NAMA_CUSTOMER'];

        $url_all_dropdown = env('API_URL') . "/special-price/dropdown";
        $response_all_dropdown = Http::withToken($providedToken)->get($url_all_dropdown);
        $data_all_dropdown = $response_all_dropdown->json();

        // make url for dropdown produk
        // $url_dropdown_produk = env('API_URL') . "/product/dropdown";
        // $response_dropdown_produk = Http::withToken($providedToken)->get($url_dropdown_produk);
        // $data_dropdown_produk = $response_dropdown_produk->json();
        $produks = $data_all_dropdown['data']['products'];
        $array_produk_dropdown = [];
        foreach ($produks as $produk) {
            // $array_produk_dropdown[$produk['KODE']] = $produk['NAMA_PRODUK'];
            //get nama category
            // $url_dropdown_category = env('API_URL') . "/category" . "/" . $produk['KODE_KATEGORI'];
            // $response_dropdown_category = Http::withToken($providedToken)->get($url_dropdown_category);
            // $data_dropdown_category = $response_dropdown_category->json();
            // $category = $data_dropdown_category['data'];

            // // get nama formula
            // $url_dropdown_formula = env('API_URL') . "/formula" . "/" . $produk['KODE_RUMUS'];
            // $response_dropdown_formula = Http::withToken($providedToken)->get($url_dropdown_formula);
            // $data_dropdown_formula = $response_dropdown_formula->json();
            // $formula = $data_dropdown_formula['data'];


            $array_produk_dropdown[$produk['KODE']] = $produk['KODE'] . " - " .  $produk['NAMA_PRODUK'] . " | " . $produk['KODE_KATEGORI'] . " - " . $produk['NAMA_KATEGORI'] . " | " . $produk['KODE_RUMUS'] . " - " .  $produk['NAMA_RUMUS'];
        }

        // kode pol
        // $url_dropdown_pol = env('API_URL') . "/harbor";
        // $response_dropdown_pol = Http::withToken($providedToken)->get($url_dropdown_pol);
        // $data_dropdown_pol = $response_dropdown_pol->json();
        $pols = $data_all_dropdown['data']['harbors'];
        $array_pol_dropdown = [];
        foreach ($pols as $pol) {


            $array_pol_dropdown[$pol['KODE']] = $pol['KODE'] . " | " . $pol['NAMA_PELABUHAN'];
        }



        // customer
        // $url_dropdown_customer = env('API_URL') . "/customer";
        // $response_dropdown_customer = Http::withToken($providedToken)->get($url_dropdown_customer);
        // $data_dropdown_customer = $response_dropdown_customer->json();
        $customers = $data_all_dropdown['data']['customers'];
        $array_customer_dropdown = [];
        foreach ($customers as $customer) {
            $array_customer_dropdown[$customer['KODE']] = $customer['NAMA'];
        }






        // $url = env('API_URL') . "/special-price";

        // // GET request to fetch cities from the API
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();

        $data = [];
        $length = 0;

        // Check if the response is successful and retrieve the cities
        if ($length > 0) {
            $cities = $data['data'];

            $keys = count($cities) > 0 ? array_keys($cities[0]) : [];
            return view('pages.1master.8zhargalclfix.khusus', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-hargalclfix',
                'data' => $cities,
                'keys' => $columns_shown,
                'table_headers' => $table_headers,
                'array_produk_dropdown' => $array_produk_dropdown,
                'array_pol_dropdown' => $array_pol_dropdown,

                'array_customer_dropdown' => $array_customer_dropdown,

            ]);
        } else {
            $errorMessage = $data['message'] ?? 'Failed to retrieve cities';

            return view('pages.1master.8zhargalclfix.khusus', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-hargalclfix',
                'data' => [],
                'keys' => $columns_shown,
                'errorMessage' => $errorMessage,
                'table_headers' => $table_headers,
                'array_produk_dropdown' => $array_produk_dropdown,
                'array_pol_dropdown' => $array_pol_dropdown,
                'array_customer_dropdown' => $array_customer_dropdown,


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
        $url = env('API_URL') . "/special-price" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->put($url, [

            "KODE_PRODUK" => $request->KODE_PRODUK,
            "KODE_POL" => $request->KODE_POL,
            "KODE_POD" => $request->KODE_POD,

            "HARGA_JUAL" => $request->HARGA_JUAL,
            "BERLAKU" => $request->BERLAKU,
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
        $url = env('API_URL') . "/special-price";
        //post with token
        $response = Http::withToken($providedToken)->post($url, [

            "KODE_PRODUK" => $request->KODE_PRODUK,
            "KODE_POL" => $request->KODE_POL,
            "KODE_POD" => $request->KODE_POD,

            "HARGA_JUAL" => $request->HARGA_JUAL,
            "BERLAKU" => $request->BERLAKU,
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
        $url = env('API_URL') . "/special-price" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/special-price/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/special-price/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/special-price/restore', [cityController::class, 'restore'])->name('city.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/special-price/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
