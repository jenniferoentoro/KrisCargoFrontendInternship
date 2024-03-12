<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/user/json-adv";

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
        $url = env('API_URL') . "/user/json";

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
        $url = env('API_URL') . "/user" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function resetPassword(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/user/reset-password"; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->post($url, $request->all());

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }


    public function changePassword(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/user/change-password"; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->post($url, $request->all());

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }


    public function index(Request $request)
    {
        $providedToken = $request->cookie('token');

        $table_headers = ['Action', 'Kode', 'Email', 'Nama', 'Jabatan'];
        $columns_shown = ['KODE', 'EMAIL', 'NAMA', 'NAMA_JABATAN'];

        // $url_dropdown_city = env('API_URL') . "/user";
        // $response_dropdown_city = Http::withToken($providedToken)->get($url_dropdown_city);
        // $data_dropdown_city = $response_dropdown_city->json();
        // $cities = $data_dropdown_city['data'];
        // $array_induk_dropdown = [];
        // foreach ($cities as $city) {
        //     $array_induk_dropdown[$city['KODE']] = $city['NAMA_ACCOUNT'];
        // }

        // dropdown account induk but check first if there is a value in the request
        $url_dropdown_position = env('API_URL') . "/position";
        $response_dropdown_position = Http::withToken($providedToken)->get($url_dropdown_position);
        $data_dropdown_position = $response_dropdown_position->json();
        $positions = $data_dropdown_position['data'];
        $array_positions_dropdown = [];
        foreach ($positions as $position) {
            $array_positions_dropdown[$position['KODE']] = $position['NAMA'];
        }










        // $url = env('API_URL') . "/user";

        // // GET request to fetch cities from the API
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();

        $data = [];
        $length = 0;

        // Check if the response is successful and retrieve the cities
        if ($length > 0) {
            $cities = $data['data'];

            $keys = count($cities) > 0 ? array_keys($cities[0]) : [];
            return view('pages.1master.0auser.user', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-useracc',
                'data' => $cities,
                'keys' => $columns_shown,
                'table_headers' => $table_headers,
                'array_positions_dropdown' => $array_positions_dropdown,

            ]);
        } else {
            $errorMessage = $data['message'] ?? 'Failed to retrieve cities';

            return view('pages.1master.0auser.user', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-useracc',
                'data' => [],
                'keys' => $columns_shown,
                'errorMessage' => $errorMessage,
                'table_headers' => $table_headers,
                'array_positions_dropdown' => $array_positions_dropdown,



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
        $url = env('API_URL') . "/user" . "/" . $request->KODE;
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
        $url = env('API_URL') . "/user";
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
        $url = env('API_URL') . "/user" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/user/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/user/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/user/restore', [cityController::class, 'restore'])->name('city.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/user/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
