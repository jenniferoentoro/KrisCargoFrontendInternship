<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ThcLoloPortDischargeController extends Controller
{

    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/thc-lolo-port-discharge/json-adv";

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
        $url = env('API_URL') . "/thc-lolo-port-discharge/json";

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
        $url = env('API_URL') . "/thc-lolo-port-discharge" . "/" . $request->KODE; // API endpoint to fetch provinces by KODE
        // GET request to the API with the provided token and KODE
        $response = Http::withToken($providedToken)->get($url);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }





    public function index(Request $request)
    {
        $providedToken = $request->cookie('token');

        $table_headers = ['Action', 'Kode', 'Vendor', 'Pelabuhan', 'Ukuran', 'Jenis Container', 'THC', 'LOLO Luar', 'LOLO Dalam', 'Tgl. Mulai Berlaku', 'Tgl. Akhir Berlaku'];
        $columns_shown = ['KODE', 'NAMA_VENDOR', 'NAMA_PELABUHAN', 'NAMA_UK_KONTAINER', 'NAMA_JENIS_KONTAINER', 'THC', 'LOLO_LUAR', 'LOLO_DALAM', 'TGL_MULAI_BERLAKU', 'TGL_AKHIR_BERLAKU'];

        //get dropdown all provinces data
        $url_dropdown = env('API_URL') . "/vendor";
        $response_dropdown = Http::withToken($providedToken)->get($url_dropdown);
        $data_dropdown = $response_dropdown->json();
        $vendors = $data_dropdown['data'];
        //for each provinces, put KODE AND NAMA to array
        $array_vendors_dropdown = [];
        foreach ($vendors as $vendor) {
            $array_vendors_dropdown[$vendor['KODE']] = $vendor['NAMA'];
        }

        //get dropdown all provinces data
        $url_dropdown = env('API_URL') . "/harbor";
        $response_dropdown = Http::withToken($providedToken)->get($url_dropdown);
        $data_dropdown = $response_dropdown->json();
        $harbors = $data_dropdown['data'];
        //for each provinces, put KODE AND NAMA to array
        $array_harbors_dropdown = [];
        foreach ($harbors as $vendor) {
            $array_harbors_dropdown[$vendor['KODE']] = $vendor['NAMA_PELABUHAN'];
        }

        // size
        $url_dropdown = env('API_URL') . "/size";
        $response_dropdown = Http::withToken($providedToken)->get($url_dropdown);
        $data_dropdown = $response_dropdown->json();
        $sizes = $data_dropdown['data'];
        //for each provinces, put KODE AND NAMA to array
        $array_sizes_dropdown = [];
        foreach ($sizes as $size) {
            $array_sizes_dropdown[$size['KODE']] = $size['KODE'];
        }

        // jenis kontainer
        $url_dropdown = env('API_URL') . "/container-type";
        $response_dropdown = Http::withToken($providedToken)->get($url_dropdown);
        $data_dropdown = $response_dropdown->json();
        $jenis_kontainers = $data_dropdown['data'];
        //for each provinces, put KODE AND NAMA to array
        $array_jenis_kontainers_dropdown = [];
        foreach ($jenis_kontainers as $jenis_kontainer) {
            $array_jenis_kontainers_dropdown[$jenis_kontainer['KODE']] = $jenis_kontainer['KODE'];
        }




        // $url = env('API_URL') . "/thc-lolo-port-discharge";

        // // GET request to fetch cities from the API
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();

        $data = [];
        $length = 0;

        // Check if the response is successful and retrieve the cities
        if ($length > 0) {
            $cities = $data['data'];

            $keys = count($cities) > 0 ? array_keys($cities[0]) : [];
            return view('pages.1master.8hargalcl.thclolopod', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-hargalcl',
                'data' => $cities,
                'keys' => $columns_shown,

                'table_headers' => $table_headers,
                'array_vendors_dropdown' => $array_vendors_dropdown,
                'array_harbors_dropdown' => $array_harbors_dropdown,
                'array_sizes_dropdown' => $array_sizes_dropdown,
                'array_jenis_kontainers_dropdown' => $array_jenis_kontainers_dropdown,
            ]);
        } else {
            $errorMessage = $data['message'] ?? 'Failed to retrieve cities';

            return view('pages.1master.8hargalcl.thclolopod', [
                'type_menu' => 'layout-master',
                'type_submenu' => 'layout-hargalcl',
                'data' => [],
                'keys' => $columns_shown,
                'errorMessage' => $errorMessage,

                'table_headers' => $table_headers,
                'array_vendors_dropdown' => $array_vendors_dropdown,
                'array_harbors_dropdown' => $array_harbors_dropdown,
                'array_sizes_dropdown' => $array_sizes_dropdown,
                'array_jenis_kontainers_dropdown' => $array_jenis_kontainers_dropdown,

            ]);
        }
    }

    public function update(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/thc-lolo-port-discharge" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->put($url, [
            "KODE_VENDOR" => $request->KODE_VENDOR,
            "KODE_PELABUHAN" => $request->KODE_PELABUHAN,
            "KODE_UK_KONTAINER" => $request->KODE_UK_KONTAINER,
            "KODE_JENIS_KONTAINER" => $request->KODE_JENIS_KONTAINER,
            "THC" => $request->THC,
            "LOLO_LUAR" => $request->LOLO_LUAR,
            "LOLO_DALAM" => $request->LOLO_DALAM,
            "TGL_MULAI_BERLAKU" => $request->TGL_MULAI_BERLAKU,
            "TGL_AKHIR_BERLAKU" => $request->TGL_AKHIR_BERLAKU,


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
        $url = env('API_URL') . "/thc-lolo-port-discharge";
        //post with token
        $response = Http::withToken($providedToken)->post($url, [
            "KODE_VENDOR" => $request->KODE_VENDOR,
            "KODE_PELABUHAN" => $request->KODE_PELABUHAN,
            "KODE_UK_KONTAINER" => $request->KODE_UK_KONTAINER,
            "KODE_JENIS_KONTAINER" => $request->KODE_JENIS_KONTAINER,
            "THC" => $request->THC,
            "LOLO_LUAR" => $request->LOLO_LUAR,
            "LOLO_DALAM" => $request->LOLO_DALAM,
            "TGL_MULAI_BERLAKU" => $request->TGL_MULAI_BERLAKU,
            "TGL_AKHIR_BERLAKU" => $request->TGL_AKHIR_BERLAKU,

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
        $url = env('API_URL') . "/thc-lolo-port-discharge" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/thc-lolo-port-discharge/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/thc-lolo-port-discharge/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/thc-lolo-port-discharge/restore', [cityController::class, 'restore'])->name('city.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/thc-lolo-port-discharge/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
