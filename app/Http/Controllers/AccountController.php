<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AccountController extends Controller
{

    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/account/json-adv";

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
        $url = env('API_URL') . "/account/json";

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
        $url = env('API_URL') . "/account" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }


    public function findByKodeProvince(Request $request, $KODE)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/account/byProvince/" . $KODE;

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

        $table_headers = ['Action', 'Kode', 'Nama Account', 'Induk', 'Detil', 'Nama Kelompok Biaya', 'Keterangan'];
        $columns_shown = ['KODE', 'NAMA_ACCOUNT', 'NAMA_INDUK', 'DETIL', 'NAMA_COST_GROUP',  'KETERANGAN'];

        // $url_dropdown_city = env('API_URL') . "/account";
        // $response_dropdown_city = Http::withToken($providedToken)->get($url_dropdown_city);
        // $data_dropdown_city = $response_dropdown_city->json();
        // $cities = $data_dropdown_city['data'];
        // $array_induk_dropdown = [];
        // foreach ($cities as $city) {
        //     $array_induk_dropdown[$city['KODE']] = $city['NAMA_ACCOUNT'];
        // }

        // dropdown account induk but check first if there is a value in the request
        $url_dropdown_account = env('API_URL') . "/account";
        $response_dropdown_account = Http::withToken($providedToken)->get($url_dropdown_account);
        $data_dropdown_account = $response_dropdown_account->json();
        $accounts = $data_dropdown_account['data'];
        $array_induk_dropdown = [];
        // add blank value to the dropdown
        // $array_induk_dropdown[''] = '';
        foreach ($accounts as $account) {
            $array_induk_dropdown[$account['KODE']] = $account['KODE'] . " - " . $account['NAMA_ACCOUNT'];
        }


        // make url for dropdown cost-group
        $url_dropdown_cost_group = env('API_URL') . "/cost-group";
        $response_dropdown_cost_group = Http::withToken($providedToken)->get($url_dropdown_cost_group);
        $data_dropdown_cost_group = $response_dropdown_cost_group->json();
        $cost_groups = $data_dropdown_cost_group['data'];
        $array_cost_group_dropdown = [];
        foreach ($cost_groups as $cost_group) {
            $array_cost_group_dropdown[$cost_group['KODE']] = $cost_group['NAMA'];
        }


        $array_detil_dropdown = [
            '1' => 'TRUE',
            '0' => 'FALSE',

        ];






        // $url = env('API_URL') . "/account";

        // // GET request to fetch cities from the API
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();

        $length = 0;

        // Check if the response is successful and retrieve the cities
        if ($length > 0) {
            $cities = [];

            $keys = count($cities) > 0 ? array_keys($cities[0]) : [];
            return view('pages.1master.9accounting.accounting', [
                'type_menu' => 'layout-master',
                'type_submenu' => '',
                'data' => $cities,
                'keys' => $columns_shown,
                'table_headers' => $table_headers,
                'array_induk_dropdown' => $array_induk_dropdown,
                'array_cost_group_dropdown' => $array_cost_group_dropdown,
                'array_detil_dropdown' => $array_detil_dropdown,
                'kode_enabled' => true,

            ]);
        } else {
            $errorMessage = $data['message'] ?? 'Failed to retrieve cities';

            return view('pages.1master.9accounting.accounting', [
                'type_menu' => 'layout-master',
                'type_submenu' => '',
                'data' => [],
                'keys' => $columns_shown,
                'errorMessage' => $errorMessage,
                'table_headers' => $table_headers,
                'array_induk_dropdown' => $array_induk_dropdown,
                'array_cost_group_dropdown' => $array_cost_group_dropdown,
                'array_detil_dropdown' => $array_detil_dropdown,
                'kode_enabled' => true,


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
        $url = env('API_URL') . "/account" . "/" . $request->KODE_OLD;
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
        $url = env('API_URL') . "/account";
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
        $url = env('API_URL') . "/account" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/account/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/account/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/account/restore', [cityController::class, 'restore'])->name('city.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/account/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
