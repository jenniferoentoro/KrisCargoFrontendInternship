<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ProvinceController extends Controller
{
    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/province/json-adv";

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
        $url = env('API_URL') . "/province/json";

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
        $url = env('API_URL') . "/province" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    // public function findByKodeNegara(Request $request, $KODE)
    // {
    //     $providedToken = $request->cookie('token');
    //     $url = env('API_URL') . "/provinces" . "/" . $KODE; // API endpoint to fetch provinces by KODE
    //     // GET request to the API with the provided token and KODE
    //     $response = Http::withToken($providedToken)->get($url);
    //     $data = $response->json();

    //     dd($data);

    //     if ($response->successful()) {
    //         $provinces = $data['data']['provinces'];

    //         return view('your.view', ['provinces' => $provinces]);
    //     } else {
    //         $errorMessage = $data['message'] ?? 'Failed to retrieve provinces';
    //         return view('your.error.view', ['errorMessage' => $errorMessage]);
    //     }
    // }
    public function index(Request $request)
    {
        $providedToken = $request->cookie('token');

        $table_headers = ['Action', 'Kode', 'Nama', 'Nama Negara'];
        $columns_shown = ['KODE', 'NAMA', 'NAMA_NEGARA'];

        //get dropdown all countries data
        $url_dropdown = env('API_URL') . "/negara";
        $response_dropdown = Http::withToken($providedToken)->get($url_dropdown);
        $data_dropdown = $response_dropdown->json();
        $countries = $data_dropdown['data'];
        // for each countries, put AND KODE into array
        $array_countries_dropdown = [];
        foreach ($countries as $country) {
            $array_countries_dropdown[$country['KODE']] = $country['NAMA'];
        }

        // $url = env('API_URL') . "/province";
        // //post with token
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();
        // //get $data['data']['customer_group'] length

        // $length = count($data['data']);
        $data = [];
        $length = 0;
        if ($length > 0) {


            return view('pages.1master.1provinsi.provinsi', ['type_menu' => 'layout-master', 'type_submenu' => '', 'data' => $data['data'], 'keys' => $columns_shown, 'table_headers' => $table_headers, 'array_countries_dropdown' => $array_countries_dropdown]);
        } else {
            return view('pages.1master.1provinsi.provinsi', ['type_menu' => 'layout-master', 'type_submenu' => '', 'data' => [], 'keys' => $columns_shown, 'table_headers' => $table_headers, 'array_countries_dropdown' => $array_countries_dropdown]);
        }
        // return view('pages.1master.5customer.potensialcustomer', ['type_menu' => 'layout-master', 'type_submenu' => '',]);
    }

    public function store(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/province";
        //post with token
        $response = Http::withToken($providedToken)->post($url, [
            'NAMA' => $request->NAMA,
            'KODE_NEGARA' => $request->KODE_NEGARA,
        ]);
        // $newId = $response->json()['data']['id'];
        // $url = env('API_URL') . "/province" . "/" . $newId;
        // // get new data with token
        // $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    public function update(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/province" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->put($url, [
            'NAMA' => $request->NAMA,
            'KODE_NEGARA' => $request->KODE_NEGARA,
        ]);
        //return with named route
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    public function delete(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/province" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/province/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/province/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/province/restore', [provinceController::class, 'restore'])->name('province.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/province/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
