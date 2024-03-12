<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Yajra\DataTables\DataTables;

class CustomerController extends Controller
{
    // public function json(Request $request)
    // {
    //     $providedToken = $request->cookie('token');
    //     $url = env('API_URL') . "/customer/json";

    //     // GET request to fetch cities by KODE_PROVINCE from the API
    //     $response = Http::withToken($providedToken)->get($url);
    //     return DataTables::of($response['data'])->make(true);
    // }

    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer/json-adv";

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
        $url = env('API_URL') . "/customer/json";

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
        $url = env('API_URL') . "/customer" . "/" . $request->KODE;

        // GET request to fetch cities by KODE_PROVINCE from the API
        $response = Http::withToken($providedToken)->get($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function store(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer";

        // Get pictures
        $file_ktp = $request->file('FOTO_KTP');
        $file_npwp = $request->file('FOTO_NPWP');
        $file_form = $request->file('FORM_CUSTOMER');

        $httpRequest = Http::withToken($providedToken);

        // Attach the file if it exists
        if ($file_ktp) {
            $httpRequest->attach('FOTO_KTP', file_get_contents($file_ktp), $file_ktp->getClientOriginalName());
        }
        if ($file_npwp) {
            $httpRequest->attach('FOTO_NPWP', file_get_contents($file_npwp), $file_npwp->getClientOriginalName());
        }
        if ($file_form) {
            $httpRequest->attach('FORM_CUSTOMER', file_get_contents($file_form), $file_form->getClientOriginalName());
        }


        // Make the HTTP request with the attached files
        $response = $httpRequest->post($url, $request->all());

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }


    public function update(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer" . "/" . $request->KODE;

        $httpRequest = Http::withToken($providedToken);

        // Attach the files if they exist
        if ($request->hasFile('FOTO_KTP')) {
            $file_ktp = $request->file('FOTO_KTP');
            $httpRequest->attach('FOTO_KTP', file_get_contents($file_ktp), $file_ktp->getClientOriginalName());
        }
        if ($request->hasFile('FOTO_NPWP')) {
            $file_npwp = $request->file('FOTO_NPWP');
            $httpRequest->attach('FOTO_NPWP', file_get_contents($file_npwp), $file_npwp->getClientOriginalName());
        }
        if ($request->hasFile('FORM_CUSTOMER')) {
            $file_form = $request->file('FORM_CUSTOMER');
            $httpRequest->attach('FORM_CUSTOMER', file_get_contents($file_form), $file_form->getClientOriginalName());
        }
        //send request to API with x-www-form-urlencoded
        //remove _method from request
        $request->request->remove('_method');
        $response = $httpRequest->post($url, $request->all());
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }





    // make me an index to return data to customer.blade.php
    public function index(Request $request)
    {
        $providedToken = $request->cookie('token');
        $table_headers = [
            'Action',
            'Kode',
            'Nama',
            'Badan Hukum',
            'Nama Group',

            'No. KTP',
            'Nama KTP',
            'Alamat KTP',
            'RT KTP',
            'RW KTP',
            'Kelurahan KTP',
            'Kecamatan KTP',
            'Kota KTP',
            'Provinsi KTP',
            'Negara KTP',
            'Status',
            'Nama NPWP',
            'No. NPWP',
            'Alamat NPWP',
            'RT NPWP',
            'RW NPWP',
            'Kelurahan NPWP',
            'Kecamatan NPWP',
            'Kota NPWP',
            'Provinsi NPWP',
            'Negara NPWP',
            'Nama CP 1',
            'Jabatan CP 1',
            'No. HP CP 1',
            'Email CP 1',
            'Nama CP 2',
            'Jabatan CP 2',
            'No. HP CP 2',
            'Email CP 2',
            'Dibayar',
            'Lokasi',
            'TOP',
            'Payment',
            'Keterangan Top',
            'Telepon',
            'HP',
            'Website',
            'Email',
            'Nama AR',
            'Nama Sales',
            'Plafon',
            'Jenis Usaha',
            'Tanggal Registrasi',
            'Foto KTP',
            'Foto NPWP',
            'Form Customer'
        ];

        $columns_shown = [
            'KODE',
            'NAMA',
            'BADAN_HUKUM',
            'NAMA_GROUP',

            'NO_KTP',
            'NAMA_KTP',
            'ALAMAT_KTP',
            'RT_KTP',
            'RW_KTP',
            'KELURAHAN_KTP',
            'KECAMATAN_KTP',
            'NAMA_KOTA_KTP',
            'NAMA_PROVINSI_KTP',
            'NAMA_NEGARA_KTP',
            'JENIS',
            'NAMA_NPWP',
            'NO_NPWP',
            'ALAMAT_NPWP',
            'RT_NPWP',
            'RW_NPWP',
            'KELURAHAN_NPWP',
            'KECAMATAN_NPWP',
            'NAMA_KOTA_NPWP',
            'NAMA_PROVINSI_NPWP',
            'NAMA_NEGARA_NPWP',
            'CONTACT_PERSON_1',
            'JABATAN_1',
            'NO_HP_1',
            'EMAIL_1',
            'CONTACT_PERSON_2',
            'JABATAN_2',
            'NO_HP_2',
            'EMAIL_2',
            'DIBAYAR',
            'LOKASI',
            'TOP',
            'PAYMENT',
            'KETERANGAN_TOP',
            'TELP',
            'HP',
            'WEBSITE',
            'EMAIL',
            'NAMA_AR',
            'NAMA_SALES',
            'PLAFON',
            'NAMA_JENIS_USAHA',

            'TGL_REG',
            'FOTO_KTP',
            'FOTO_NPWP',
            'FORM_CUSTOMER'
        ];

        $url_all_dropdown = env('API_URL') . "/customer/dropdown";
        $response_all_dropdown = Http::withToken($providedToken)->get($url_all_dropdown);
        $data_all_dropdown = $response_all_dropdown->json();

        // $url_dropdown_customergroup = env('API_URL') . "/customer-group";
        // $response_dropdown_customergroup = Http::withToken($providedToken)->get($url_dropdown_customergroup);
        // $data_dropdown_customergroup = $response_dropdown_customergroup->json();
        $customergroups = $data_all_dropdown['data']['customerGroups'];
        $array_customergroup_dropdown = [];
        foreach ($customergroups as $customergroup) {
            $array_customergroup_dropdown[$customergroup['KODE']] = $customergroup['NAMA'];
        }

        // $url_dropdown_city = env('API_URL') . "/city/dropdown";
        // $response_dropdown_city = Http::withToken($providedToken)->get($url_dropdown_city);
        // $data_dropdown_city = $response_dropdown_city->json();
        $cities = $data_all_dropdown['data']['cities'];
        $array_cities_dropdown = [];
        foreach ($cities as $city) {
            $array_cities_dropdown[$city['KODE']] = $city['NAMA'];
        }

        // $url_dropdown_ar = env('API_URL') . "/staff/jabatan/JBT.7";
        // $response_dropdown_ar = Http::withToken($providedToken)->get($url_dropdown_ar);
        // $data_dropdown_ar = $response_dropdown_ar->json();
        $ars = $data_all_dropdown['data']['arStaffs'];
        $array_ars_dropdown = [];
        foreach ($ars as $ar) {
            $array_ars_dropdown[$ar['KODE']] = $ar['NAMA'];
        }

        // $url_dropdown_sales = env('API_URL') . "/staff/jabatan/JBT.6";
        // $response_dropdown_sales = Http::withToken($providedToken)->get($url_dropdown_sales);
        // $data_dropdown_sales = $response_dropdown_sales->json();
        $sales = $data_all_dropdown['data']['salesStaffs'];
        $array_sales_dropdown = [];
        foreach ($sales as $sale) {
            $array_sales_dropdown[$sale['KODE']] = $sale['NAMA'];
        }

        // $url_dropdown_businesstype = env('API_URL') . "/business-type";
        // $response_dropdown_businesstype = Http::withToken($providedToken)->get($url_dropdown_businesstype);
        // $data_dropdown_businesstype = $response_dropdown_businesstype->json();
        $business_types = $data_all_dropdown['data']['businessTypes'];
        $array_businesstype_dropdown = [];
        foreach ($business_types as $business_type) {
            $array_businesstype_dropdown[$business_type['KODE']] = $business_type['NAMA'];
        }


        // $url = env('API_URL') . '/customer';
        // //post with token
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();
        // $length = count($data['data']);
        $length = 0;
        $data = [];
        if ($length > 0) {
            return view('pages.1master.5customer.customer', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-customer', 'data' => $data['data'], 'keys' => $columns_shown, 'table_headers' => $table_headers, 'array_customergroup_dropdown' => $array_customergroup_dropdown, 'array_cities_dropdown' => $array_cities_dropdown, 'array_ars_dropdown' => $array_ars_dropdown, 'array_sales_dropdown' => $array_sales_dropdown, 'array_businesstype_dropdown' => $array_businesstype_dropdown]);
        } else {
            return view('pages.1master.5customer.customer', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-customer', 'data' => [], 'keys' => $columns_shown, 'table_headers' => $table_headers, 'array_customergroup_dropdown' => $array_customergroup_dropdown, 'array_cities_dropdown' => $array_cities_dropdown, 'array_ars_dropdown' => $array_ars_dropdown, 'array_sales_dropdown' => $array_sales_dropdown, 'array_businesstype_dropdown' => $array_businesstype_dropdown]);
        }
    }

    public function getFiles($filename, Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/files" . "/" . $filename;
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        //get file type from response header
        $filetype = $response->header('Content-Type');
        //return picture
        return response($response)->header('Content-Type', $filetype);
    }


    public function getNextId(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function delete(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }



    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/customer/trash";
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
        $url = env('API_URL') . "/customer/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
