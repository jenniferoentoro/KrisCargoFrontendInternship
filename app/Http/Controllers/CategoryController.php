<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CategoryController extends Controller
{

    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/category/json-adv";

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
        $url = env('API_URL') . "/category/json";

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
        $url = env('API_URL') . "/category" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    // make a delete function
    public function delete(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/category" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    // make an update function
    public function update(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/category" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->put($url, [
            'NAMA_KATEGORI' => $request->NAMA_KATEGORI,
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
        $url = env('API_URL') . "/category";
        //post with token
        $response = Http::withToken($providedToken)->post($url, [
            'NAMA_KATEGORI' => $request->NAMA_KATEGORI,
        ]);
        //return with named route
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    // make me an index to return data to negara.blade.php
    public function index(Request $request)
    {
        $table_headers = ['Action', 'Kode', 'Nama Kategori'];
        $columns_shown = ['KODE', 'NAMA_KATEGORI'];


        // $providedToken = $request->cookie('token');
        // $url = env('API_URL') . "/category";
        // //post with token
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();
        // //get $data['data']['negara'] length
        // $length = count($data['data']);

        $data = [];
        $length = 0;
        if ($length > 0) {
            // $keys = array_keys($data['data']['negara'][0]);
            return view('pages.1master.8zhargalclfix.category', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-hargalclfix', 'data' => $data['data'], 'keys' => $columns_shown, 'table_headers' => $table_headers]);
        } else {
            return view('pages.1master.8zhargalclfix.category', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-hargalclfix', 'data' => [], 'keys' => $columns_shown, 'table_headers' => $table_headers]);
        }
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/category/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to get trash data from Route::delete('/category/trash', [NegaraController::class, 'trash'])->name('negara.trash');
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/category/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/category/restore', [NegaraController::class, 'restore'])->name('negara.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/category/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
