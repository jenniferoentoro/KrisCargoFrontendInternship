<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CustomerGroupController extends Controller
{
    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer-group/json-adv";

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
        $url = env('API_URL') . "/customer-group/json";

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
        $url = env('API_URL') . "/customer-group" . "/" . $request->KODE;

        // GET request to fetch cities by KODE_PROVINCE from the API
        $response = Http::withToken($providedToken)->get($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    public function store(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer-group";
        //post with token
        $response = Http::withToken($providedToken)->post($url, [

            'NAMA' => $request->NAMA,
            'BADAN_HUKUM' => $request->BADAN_HUKUM,
            'ALAMAT' => $request->ALAMAT,
            'KODE_KOTA' => $request->KODE_KOTA,
            'TELP' => $request->TELP,
            'HP' => $request->HP,
            'EMAIL' => $request->EMAIL,
            'FAX' => $request->FAX,
            'CONTACT_PERSON' => $request->CONTACT_PERSON,
            'NO_HP_CP' => $request->NO_HP_CP,
            'NO_SMS_CP' => $request->NO_SMS_CP,
            'AKTIF' => $request->AKTIF,
            'KETERANGAN' => $request->KETERANGAN,
            'WEBSITE' => $request->WEBSITE,
            'EMAIL1' => $request->EMAIL1,
        ]);

        // return $request->NAMA;






        //get $data['data']['negara'] length

        // check if the status success
        // if ($response->json()['status'] == 'success') {
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);

        // } else {
        //     // return the message of the  error
        //     return response()->json(['status' => 'error', 'message' => $response->json()['message']]);
        // }



    }

    // public function storeContinue(Request $request)
    // {
    //     $providedToken = $request->cookie('token');
    //     $url = env('API_URL') . "/customer-group/continue";
    //     //post with token
    //     $response = Http::withToken($providedToken)->post($url, [

    //         'NAMA' => $request->NAMA,
    //         'BADAN_HUKUM' => $request->BADAN_HUKUM,
    //         'ALAMAT' => $request->ALAMAT,
    //         'KODE_KOTA' => $request->KODE_KOTA,
    //         'TELP' => $request->TELP,
    //         'HP' => $request->HP,
    //         'EMAIL' => $request->EMAIL,
    //         'FAX' => $request->FAX,
    //         'CONTACT_PERSON' => $request->CONTACT_PERSON,
    //         'NO_HP_CP' => $request->NO_HP_CP,
    //         'NO_SMS_CP' => $request->NO_SMS_CP,
    //         'AKTIF' => $request->AKTIF,
    //         'KETERANGAN' => $request->KETERANGAN,
    //         'WEBSITE' => $request->WEBSITE,
    //         'EMAIL1' => $request->EMAIL1,
    //     ]);
    //     $statusCode = $response->status();

    //     return response()->json($response->json(), $statusCode);
    // }
    public function index(Request $request)
    {
        $providedToken = $request->cookie('token');
        $table_headers = [
            'Action',
            'Kode',
            'Nama',
            'Badan Hukum',
            'Alamat',
            'Nama Kota',
            'Nama Provinsi',
            'Nama Negara',
            'Telpon',
            'HP',
            'Email',
            'Fax',
            'Contact Person',
            'No HP CP',
            'No WA CP',
            'Aktif',
            'Keterangan',
            'Website',
            'Email CP',
        ];
        $columns_shown = ['KODE', 'NAMA', 'BADAN_HUKUM', 'ALAMAT', 'NAMA_KOTA', 'NAMA_PROVINSI', 'NAMA_NEGARA', 'TELP', 'HP', 'EMAIL', 'FAX', 'CONTACT_PERSON', 'NO_HP_CP', 'NO_SMS_CP', 'AKTIF', 'KETERANGAN', 'WEBSITE', 'EMAIL1'];

        // $url_dropdown_country = env('API_URL') . "/negara";
        // $response_dropdown_country = Http::withToken($providedToken)->get($url_dropdown_country);
        // $data_dropdown_country = $response_dropdown_country->json();
        // $countries = $data_dropdown_country['data'];
        // $array_countries_dropdown = [];
        // foreach ($countries as $country) {
        //     $array_countries_dropdown[$country['KODE']] = $country['NAMA'];
        // }

        // $url_dropdown_province = env('API_URL') . "/province";
        // $response_dropdown_province = Http::withToken($providedToken)->get($url_dropdown_province);
        // $data_dropdown_province = $response_dropdown_province->json();
        // $provinces = $data_dropdown_province['data'];
        // $array_provinces_dropdown = [];
        // foreach ($provinces as $province) {
        //     $array_provinces_dropdown[$province['KODE']] = $province['NAMA'];
        // }

        $url_dropdown_city = env('API_URL') . "/city/dropdown";
        $response_dropdown_city = Http::withToken($providedToken)->get($url_dropdown_city);
        $data_dropdown_city = $response_dropdown_city->json();
        $cities = $data_dropdown_city['data'];
        $array_cities_dropdown = [];
        foreach ($cities as $city) {
            $array_cities_dropdown[$city['KODE']] = $city['NAMA'];
        }

        $array_active_dropdown = ['1' => 'Y', '0' => 'T'];

        // $url = env('API_URL') . "/customer-group";
        // //post with token
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();
        // //get $data['data']['customer_group'] length
        // $length = count($data['data']);
        $data = [];
        $length = 0;
        if ($length > 0) {
            // $keys = array_keys($data['data']['customer_group'][0]);

            return view('pages.1master.5customer.potensialgroupcustomer', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-customer', 'data' => $data['data'], 'keys' => $columns_shown, 'table_headers' => $table_headers,  'array_cities_dropdown' => $array_cities_dropdown, 'array_active_dropdown' => $array_active_dropdown]);
        } else {
            return view('pages.1master.5customer.potensialgroupcustomer', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-customer', 'data' => [], 'keys' => $columns_shown, 'table_headers' => $table_headers,  'array_cities_dropdown' => $array_cities_dropdown, 'array_active_dropdown' => $array_active_dropdown]);
        }
        // return view('pages.1master.5customer.potensialcustomer', ['type_menu' => 'layout-master', 'type_submenu' => '',]);
    }
    // make an update function
    public function update(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer-group" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->put($url, [
            'NAMA' => $request->NAMA,
            'BADAN_HUKUM' => $request->BADAN_HUKUM,
            'ALAMAT' => $request->ALAMAT,
            'KODE_KOTA' => $request->KODE_KOTA,
            // 'KODE_PROVINSI' => $request->KODE_PROVINSI,
            // 'KODE_NEGARA' => $request->KODE_NEGARA,
            'TELP' => $request->TELP,
            'HP' => $request->HP,
            'EMAIL' => $request->EMAIL,
            'FAX' => $request->FAX,
            'CONTACT_PERSON' => $request->CONTACT_PERSON,
            'NO_HP_CP' => $request->NO_HP_CP,
            'NO_SMS_CP' => $request->NO_SMS_CP,
            'AKTIF' => $request->AKTIF,
            'KETERANGAN' => $request->KETERANGAN,
            'WEBSITE' => $request->WEBSITE,
            'EMAIL1' => $request->EMAIL1,


        ]);

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    // public function updateContinue(Request $request)
    // {
    //     $providedToken = $request->cookie('token');
    //     $url = env('API_URL') . "/customer-group" . "/continue" . "/" . $request->KODE;
    //     //post with token
    //     $response = Http::withToken($providedToken)->put($url, [
    //         'NAMA' => $request->NAMA,
    //         'BADAN_HUKUM' => $request->BADAN_HUKUM,
    //         'ALAMAT' => $request->ALAMAT,
    //         'KODE_KOTA' => $request->KODE_KOTA,
    //         // 'KODE_PROVINSI' => $request->KODE_PROVINSI,
    //         // 'KODE_NEGARA' => $request->KODE_NEGARA,
    //         'TELP' => $request->TELP,
    //         'HP' => $request->HP,
    //         'EMAIL' => $request->EMAIL,
    //         'FAX' => $request->FAX,
    //         'CONTACT_PERSON' => $request->CONTACT_PERSON,
    //         'NO_HP_CP' => $request->NO_HP_CP,
    //         'NO_SMS_CP' => $request->NO_SMS_CP,
    //         'AKTIF' => $request->AKTIF,
    //         'KETERANGAN' => $request->KETERANGAN,
    //         'WEBSITE' => $request->WEBSITE,
    //         'EMAIL1' => $request->EMAIL1,


    //     ]);

    //     $statusCode = $response->status();

    //     return response()->json($response->json(), $statusCode);
    // }
    // make a delete function
    public function delete(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer-group" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer-group/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }

    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer-group/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/customer-group/restore', [customer-groupController::class, 'restore'])->name('customer-group.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer-group/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
