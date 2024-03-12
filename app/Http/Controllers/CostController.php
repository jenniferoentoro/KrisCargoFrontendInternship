<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CostController extends Controller
{

    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost/json-adv";

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
        $url = env('API_URL') . "/cost/json";

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
        $url = env('API_URL') . "/cost" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }


    public function findByKodeProvince(Request $request, $KODE)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost/byProvince/" . $KODE;

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

        $table_headers = ['Action', 'Kode', 'Nama Biaya', 'Nama klmpk Biaya', 'Nama jenis biaya', 'COA', 'Keterangan'];
        $columns_shown = ['KODE', 'NAMA_BIAYA', 'NAMA_KEL_BIAYA', 'NAMA_JEN_BIAYA',  'NAMA_ACC', 'KETERANGAN'];

        $url_dropdown_city = env('API_URL') . "/cost-type";
        $response_dropdown_city = Http::withToken($providedToken)->get($url_dropdown_city);
        $data_dropdown_city = $response_dropdown_city->json();
        $cities = $data_dropdown_city['data'];
        $array_cities_dropdown = [];
        foreach ($cities as $city) {
            $array_cities_dropdown[$city['KODE']] = $city['NAMA'];
        }

        // dropdown accounting
        $url_dropdown_accounting = env('API_URL') . "/account";
        $response_dropdown_accounting = Http::withToken($providedToken)->get($url_dropdown_accounting);
        $data_dropdown_accounting = $response_dropdown_accounting->json();
        $accountings = $data_dropdown_accounting['data'];
        $array_accountings_dropdown = [];
        foreach ($accountings as $accounting) {
            $array_accountings_dropdown[$accounting['KODE']] = $accounting['NAMA_ACCOUNT'];
        }


        // make url for dropdown cost-group
        $url_dropdown_cost_group = env('API_URL') . "/cost-group";
        $response_dropdown_cost_group = Http::withToken($providedToken)->get($url_dropdown_cost_group);
        $data_dropdown_cost_group = $response_dropdown_cost_group->json();
        $cost_groups = $data_dropdown_cost_group['data'];
        $array_cost_groups_dropdown = [];
        foreach ($cost_groups as $cost_group) {
            $array_cost_groups_dropdown[$cost_group['KODE']] = $cost_group['NAMA'];
        }




        $array_active_dropdown = ['1' => 'Y', '0' => 'T'];



        // $url = env('API_URL') . "/cost";

        // // GET request to fetch cities from the API
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();

        $data = [];
        $length = 0;

        // Check if the response is successful and retrieve the cities
        if ($length > 0) {
            $cities = $data['data'];

            $keys = count($cities) > 0 ? array_keys($cities[0]) : [];
            return view('pages.1master.8hargalcl.cost', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-hargalcl',
                'data' => $cities,
                'keys' => $columns_shown,
                'table_headers' => $table_headers,
                'array_cities_dropdown' => $array_cities_dropdown,
                'array_cost_groups_dropdown' => $array_cost_groups_dropdown,
                'array_active_dropdown' => $array_active_dropdown,
                'array_accountings_dropdown' => $array_accountings_dropdown
            ]);
        } else {
            $errorMessage = $data['message'] ?? 'Failed to retrieve cities';

            return view('pages.1master.8hargalcl.cost', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-hargalcl',
                'data' => [],
                'keys' => $columns_shown,
                'errorMessage' => $errorMessage,
                'table_headers' => $table_headers,
                'array_cities_dropdown' => $array_cities_dropdown,
                'array_cost_groups_dropdown' => $array_cost_groups_dropdown,
                'array_active_dropdown' => $array_active_dropdown,
                'array_accountings_dropdown' => $array_accountings_dropdown

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
        $url = env('API_URL') . "/cost" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->put($url, [

            "KD_KEL_BIAYA" => $request->KD_KEL_BIAYA,
            "KD_JEN_BIAYA" => $request->KD_JEN_BIAYA,
            "NAMA_BIAYA" => $request->NAMA_BIAYA,
            "ACC" => $request->ACC,
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
        $url = env('API_URL') . "/cost";
        //post with token
        $response = Http::withToken($providedToken)->post($url, [

            "KD_KEL_BIAYA" => $request->KD_KEL_BIAYA,
            "KD_JEN_BIAYA" => $request->KD_JEN_BIAYA,
            "NAMA_BIAYA" => $request->NAMA_BIAYA,
            "ACC" => $request->ACC,
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
        $url = env('API_URL') . "/cost" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/cost/restore', [cityController::class, 'restore'])->name('city.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/cost/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
