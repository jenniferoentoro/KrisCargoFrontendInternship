<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CityController extends Controller
{

    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/city/json-adv";

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
        $url = env('API_URL') . "/city/json";

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
        $url = env('API_URL') . "/city" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }


    public function findByKodeProvince(Request $request, $KODE)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/city/byProvince/" . $KODE;

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

        $table_headers = ['Action', 'Kode', 'Nama', 'Nama Provinsi'];
        $columns_shown = ['KODE', 'NAMA', 'NAMA_PROVINSI'];

        //get dropdown all provinces data
        $url_dropdown = env('API_URL') . "/province";
        $response_dropdown = Http::withToken($providedToken)->get($url_dropdown);
        $data_dropdown = $response_dropdown->json();
        $provinces = $data_dropdown['data'];
        //for each provinces, put KODE AND NAMA to array
        $array_provinces_dropdown = [];
        foreach ($provinces as $province) {
            $array_provinces_dropdown[$province['KODE']] = $province['NAMA'];
        }


        // $url = env('API_URL') . "/city";

        // // GET request to fetch cities from the API
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();
        $cities = [];
        $length = 0;
        // Check if the response is successful and retrieve the cities
        if ($length > 0) {

            return view('pages.1master.2kota.kota', [
                'type_menu' => 'layout-master',
                'type_submenu' => '',
                'data' => $cities,
                'keys' => $columns_shown,
                'type_menu' => 'layout-master', 'type_submenu' => '',
                'table_headers' => $table_headers,
                'array_provinces_dropdown' => $array_provinces_dropdown
            ]);
        } else {
            $errorMessage = $data['message'] ?? 'Failed to retrieve cities';

            return view('pages.1master.2kota.kota', [
                'type_menu' => 'layout-master',
                'type_submenu' => '',
                'data' => [],
                'keys' => $columns_shown,
                'errorMessage' => $errorMessage,
                'type_menu' => 'layout-master', 'type_submenu' => '',
                'table_headers' => $table_headers,
                'array_provinces_dropdown' => $array_provinces_dropdown

            ]);
        }
    }

    public function update(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/city" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->put($url, [
            'NAMA' => $request->NAMA,
            "KODE_PROVINSI" => $request->KODE_PROVINSI,
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
        $url = env('API_URL') . "/city";
        //post with token
        $response = Http::withToken($providedToken)->post($url, [
            'NAMA' => $request->NAMA,
            "KODE_PROVINSI" => $request->KODE_PROVINSI,
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
        $url = env('API_URL') . "/city" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/city/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/city/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/city/restore', [cityController::class, 'restore'])->name('city.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/city/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
