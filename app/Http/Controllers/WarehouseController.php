<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WarehouseController extends Controller
{
    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/warehouse/json-adv";

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
        $url = env('API_URL') . "/warehouse/json";

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
        $url = env('API_URL') . "/warehouse" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }





    public function index(Request $request)
    {
        $providedToken = $request->cookie('token');

        $table_headers = ['Action', 'Kode', 'Nama', 'Jenis Lokasi', 'Alamat', 'Kota', 'Provinsi', 'Negara', 'Nama PIC', 'HP PIC', 'Email PIC', 'Keterangan'];
        $columns_shown = ['KODE', 'NAMA', 'JENIS_LOKASI', 'ALAMAT', 'NAMA_KOTA', 'NAMA_PROVINSI', 'NAMA_NEGARA', 'NAMA_PIC', 'HP_PIC', 'EMAIL_PIC', 'KETERANGAN'];

        //get dropdown all provinces data
        // $url_dropdown = env('API_URL') . "/vendor";
        // $response_dropdown = Http::withToken($providedToken)->get($url_dropdown);
        // $data_dropdown = $response_dropdown->json();
        // $vendors = $data_dropdown['data'];
        // //for each provinces, put KODE AND NAMA to array
        // $array_vendors_dropdown = [];
        // foreach ($vendors as $vendor) {
        //     $array_vendors_dropdown[$vendor['KODE']] = $vendor['NAMA'];
        // }

        //get dropdown all provinces data
        // $url_dropdown = env('API_URL') . "/account";
        // $response_dropdown = Http::withToken($providedToken)->get($url_dropdown);
        // $data_dropdown = $response_dropdown->json();
        // $accounts = $data_dropdown['data'];
        // //for each provinces, put KODE AND NAMA to array
        // $array_accounts_dropdown = [];
        // foreach ($accounts as $vendor) {
        //     $array_accounts_dropdown[$vendor['KODE']] = $vendor['NAMA_ACCOUNT'];
        // }

        // $url_dropdown_pics = env('API_URL') . "/user";
        // $response_dropdown_pics = Http::withToken($providedToken)->get($url_dropdown_pics);
        // $data_dropdown_pics = $response_dropdown_pics->json();
        // $pics = $data_dropdown_pics['data'];
        // $array_pics_dropdown = [];
        // foreach ($pics as $pic) {
        //     $array_pics_dropdown[$pic['KODE']] = $pic['NAMA'];
        // }

        //cities dropdown
        $url_dropdown_cities = env('API_URL') . "/city/dropdown";
        $response_dropdown_cities = Http::withToken($providedToken)->get($url_dropdown_cities);
        $data_dropdown_cities = $response_dropdown_cities->json();
        $cities = $data_dropdown_cities['data'];
        $array_cities_dropdown = [];
        foreach ($cities as $city) {
            $array_cities_dropdown[$city['KODE']] = $city['NAMA'];
        }



        // $url = env('API_URL') . "/warehouse";

        // // GET request to fetch cities from the API
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();
        $data = [];
        $length = 0;

        // Check if the response is successful and retrieve the cities
        if ($length > 0) {
            $warehohuses = $data['data'];

            $keys = count($warehohuses) > 0 ? array_keys($warehohuses[0]) : [];
            return view('pages.1master.3gudang.gudang', [
                'type_menu' => 'layout-master',
                'type_submenu' => '',
                'data' => $warehohuses,
                'keys' => $columns_shown,
                'type_menu' => 'layout-master', 'type_submenu' => '',
                'table_headers' => $table_headers,
                // 'array_accounts_dropdown' => $array_accounts_dropdown,
                'array_cities_dropdown' => $array_cities_dropdown
            ]);
        } else {
            $errorMessage = $data['message'] ?? 'Failed to retrieve cities';

            return view('pages.1master.3gudang.gudang', [
                'type_menu' => 'layout-master',
                'type_submenu' => '',
                'data' => [],
                'keys' => $columns_shown,
                'errorMessage' => $errorMessage,
                'type_menu' => 'layout-master', 'type_submenu' => '',
                'table_headers' => $table_headers,
                // 'array_accounts_dropdown' => $array_accounts_dropdown,
                'array_cities_dropdown' => $array_cities_dropdown

            ]);
        }
    }

    public function update(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/warehouse" . "/" . $request->KODE;
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
        $url = env('API_URL') . "/warehouse";
        //post with token
        $response = Http::withToken($providedToken)->post($url, $request->all());
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
        $url = env('API_URL') . "/warehouse" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/warehouse/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/warehouse/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/warehouse/restore', [cityController::class, 'restore'])->name('city.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/warehouse/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}