<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProductController extends Controller
{

    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/product/json-adv";

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
        $url = env('API_URL') . "/product/json";

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
        $url = env('API_URL') . "/product" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }


    public function index(Request $request)
    {
        $providedToken = $request->cookie('token');

        $table_headers = ['Action', 'Kode', 'Nama Product', 'Kategori', 'Rumus'];
        $columns_shown = ['KODE', 'NAMA_PRODUK', 'NAMA_KATEGORI', 'NAMA_RUMUS'];

        //    DROPDOWN CATEGOry
        $url = env('API_URL') . "/category";
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        $array_category_dropdown = [];
        foreach ($data['data'] as $item) {
            $array_category_dropdown[$item['KODE']] = $item['NAMA_KATEGORI'];
        }

        //   DROPDOWN formula
        $url = env('API_URL') . "/formula";
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        $array_formula_dropdown = [];
        foreach ($data['data'] as $item) {
            $array_formula_dropdown[$item['KODE']] = $item['NAMA_RUMUS'];
        }




        // $url = env('API_URL') . "/product";

        // // GET request to fetch cities from the API
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();

        $data = [];
        $length = 0;

        // Check if the response is successful and retrieve the cities
        if ($length > 0) {
            $cities = $data['data'];

            $keys = count($cities) > 0 ? array_keys($cities[0]) : [];
            return view('pages.1master.8zhargalclfix.product', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-hargalclfix',
                'data' => $cities,
                'keys' => $columns_shown,
                'table_headers' => $table_headers,
                'array_category_dropdown' => $array_category_dropdown,
                'array_formula_dropdown' => $array_formula_dropdown,
            ]);
        } else {
            $errorMessage = $data['message'] ?? 'Failed to retrieve cities';

            return view('pages.1master.8zhargalclfix.product', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-hargalclfix',
                'data' => [],
                'keys' => $columns_shown,
                'errorMessage' => $errorMessage,
                'table_headers' => $table_headers,
                'array_category_dropdown' => $array_category_dropdown,
                'array_formula_dropdown' => $array_formula_dropdown,

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
        $url = env('API_URL') . "/product" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->put($url, [
            'NAMA_PRODUK' => $request->NAMA_PRODUK,
            "KODE_KATEGORI" => $request->KODE_KATEGORI,
            "KODE_RUMUS" => $request->KODE_RUMUS,
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
        $url = env('API_URL') . "/product";
        //post with token
        $response = Http::withToken($providedToken)->post($url, [
            'NAMA_PRODUK' => $request->NAMA_PRODUK,
            "KODE_KATEGORI" => $request->KODE_KATEGORI,
            "KODE_RUMUS" => $request->KODE_RUMUS,
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
        $url = env('API_URL') . "/product" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/product/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/product/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/product/restore', [cityController::class, 'restore'])->name('city.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/product/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
