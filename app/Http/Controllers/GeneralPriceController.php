<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class GeneralPriceController extends Controller
{

    public function findByKode(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/general-price" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }


    public function findByKodeProvince(Request $request, $KODE)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/general-price/byProvince/" . $KODE;

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

        $table_headers = ['Action', 'Kode', 'Nama Harga Umum', 'Produk', 'POL', 'POD', 'Rumus', 'Harga Jual', 'Berlaku'];
        $columns_shown = ['KODE', 'NAMA_HARGA_UMUM', 'NAMA_PRODUK', 'NAMA_POL', 'NAMA_POD', 'NAMA_RUMUS', 'HARGA_JUAL', 'BERLAKU'];

        // make url for dropdown produk
        $url_dropdown_produk = env('API_URL') . "/product";
        $response_dropdown_produk = Http::withToken($providedToken)->get($url_dropdown_produk);
        $data_dropdown_produk = $response_dropdown_produk->json();
        $produks = $data_dropdown_produk['data'];
        $array_produk_dropdown = [];
        foreach ($produks as $produk) {
            $array_produk_dropdown[$produk['KODE']] = $produk['NAMA_PRODUK'];
        }

        // kode pol
        $url_dropdown_pol = env('API_URL') . "/harbor";
        $response_dropdown_pol = Http::withToken($providedToken)->get($url_dropdown_pol);
        $data_dropdown_pol = $response_dropdown_pol->json();
        $pols = $data_dropdown_pol['data'];
        $array_pol_dropdown = [];
        foreach ($pols as $pol) {
            $array_pol_dropdown[$pol['KODE']] = $pol['NAMA_PELABUHAN'];
        }

        // rumus
        $url_dropdown_rumus = env('API_URL') . "/formula";
        $response_dropdown_rumus = Http::withToken($providedToken)->get($url_dropdown_rumus);
        $data_dropdown_rumus = $response_dropdown_rumus->json();
        $rumuss = $data_dropdown_rumus['data'];
        $array_rumus_dropdown = [];
        foreach ($rumuss as $rumus) {
            $array_rumus_dropdown[$rumus['KODE']] = $rumus['NAMA_RUMUS'];
        }






        $url = env('API_URL') . "/general-price";

        // GET request to fetch cities from the API
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();

        // Check if the response is successful and retrieve the cities
        if ($response->successful()) {
            $cities = $data['data'];

            $keys = count($cities) > 0 ? array_keys($cities[0]) : [];
            return view('pages.1master.8zhargalclfix.umum', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-hargalclfix',
                'data' => $cities,
                'keys' => $columns_shown,
                'table_headers' => $table_headers,
                'array_produk_dropdown' => $array_produk_dropdown,
                'array_pol_dropdown' => $array_pol_dropdown,
                'array_rumus_dropdown' => $array_rumus_dropdown,

            ]);
        } else {
            $errorMessage = $data['message'] ?? 'Failed to retrieve cities';

            return view('pages.1master.8zhargalclfix.umum', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-hargalclfix',
                'data' => [],
                'keys' => $columns_shown,
                'errorMessage' => $errorMessage,
                'table_headers' => $table_headers,
                'array_produk_dropdown' => $array_produk_dropdown,
                'array_pol_dropdown' => $array_pol_dropdown,
                'array_rumus_dropdown' => $array_rumus_dropdown,


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
        $url = env('API_URL') . "/general-price" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->put($url, [
            "NAMA_HARGA_UMUM" => $request->NAMA_HARGA_UMUM,
            "KODE_PRODUK" => $request->KODE_PRODUK,
            "KODE_POL" => $request->KODE_POL,
            "KODE_POD" => $request->KODE_POD,
            "KODE_RUMUS" => $request->KODE_RUMUS,
            "HARGA_JUAL" => $request->HARGA_JUAL,
            "BERLAKU" => $request->BERLAKU,
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
        $url = env('API_URL') . "/general-price";
        //post with token
        $response = Http::withToken($providedToken)->post($url, [
            "NAMA_HARGA_UMUM" => $request->NAMA_HARGA_UMUM,
            "KODE_PRODUK" => $request->KODE_PRODUK,
            "KODE_POL" => $request->KODE_POL,
            "KODE_POD" => $request->KODE_POD,
            "KODE_RUMUS" => $request->KODE_RUMUS,
            "HARGA_JUAL" => $request->HARGA_JUAL,
            "BERLAKU" => $request->BERLAKU,
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
        $url = env('API_URL') . "/general-price" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/general-price/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/general-price/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/general-price/restore', [cityController::class, 'restore'])->name('city.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/general-price/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
