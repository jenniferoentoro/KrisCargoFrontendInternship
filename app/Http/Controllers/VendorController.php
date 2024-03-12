<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VendorController extends Controller
{

    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/vendor/json-adv";

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
        $url = env('API_URL') . "/vendor/json";

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
        $url = env('API_URL') . "/vendor" . "/" . $request->KODE;

        // GET request to fetch cities by KODE_PROVINCE from the API
        $response = Http::withToken($providedToken)->get($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    public function store(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/vendor";

        // Get pictures
        $file_ktp = $request->file('FOTO_KTP');
        $file_npwp = $request->file('FOTO_NPWP');
        $file_form = $request->file('FORM_VENDOR');

        $httpRequest = Http::withToken($providedToken);

        // Attach the file if it exists
        if ($file_ktp) {
            $httpRequest->attach('FOTO_KTP', file_get_contents($file_ktp), $file_ktp->getClientOriginalName());
        }
        if ($file_npwp) {
            $httpRequest->attach('FOTO_NPWP', file_get_contents($file_npwp), $file_npwp->getClientOriginalName());
        }
        if ($file_form) {
            $httpRequest->attach('FORM_VENDOR', file_get_contents($file_form), $file_form->getClientOriginalName());
        }


        // Make the HTTP request with the attached files
        $response = $httpRequest->post($url, $request->all());

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    // public function storeContinue(Request $request)
    // {
    //     $providedToken = $request->cookie('token');
    //     $url = env('API_URL') . "/vendor/continue";

    //     // Get pictures
    //     $file_ktp = $request->file('FOTO_KTP');
    //     $file_npwp = $request->file('FOTO_NPWP');
    //     $file_form = $request->file('FORM_VENDOR');

    //     $httpRequest = Http::withToken($providedToken);

    //     // Attach the file if it exists
    //     if ($file_ktp) {
    //         $httpRequest->attach('FOTO_KTP', file_get_contents($file_ktp), $file_ktp->getClientOriginalName());
    //     }
    //     if ($file_npwp) {
    //         $httpRequest->attach('FOTO_NPWP', file_get_contents($file_npwp), $file_npwp->getClientOriginalName());
    //     }
    //     if ($file_form) {
    //         $httpRequest->attach('FORM_VENDOR', file_get_contents($file_form), $file_form->getClientOriginalName());
    //     }


    //     // Make the HTTP request with the attached files
    //     $response = $httpRequest->post($url, $request->all());

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
            'Jenis Vendor',
            'Badan Hukum',
            'Status',
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
            'Foto KTP',
            'Telepon Kantor',
            'HP Kantor',
            'Website',
            'Email',
            'Plafon',
            'No. NPWP',
            'Nama NPWP',
            'Alamat NPWP',
            'RT NPWP',
            'RW NPWP',
            'Kelurahan NPWP',
            'Kecamatan NPWP',
            'Kota NPWP',
            'Provinsi NPWP',
            'Negara NPWP',
            'Foto NPWP',
            'Contact Person',
            'Jabatan CP',
            'HP CP',
            'Email CP',
            'Nama Rekening',
            'No. Rekening',
            'Nama Bank',
            'Alamat Bank',
            'TOP',
            'Payment',

            'Keterangan TOP',
            'Tgl. Awal Jadi Vendor',
            'Form Vendor'
        ];
        $columns_shown = [
            'KODE',
            'NAMA',
            'NAMA_JENIS_VENDOR',
            'BADAN_HUKUM',
            'STATUS',
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
            'FOTO_KTP',
            'TELP_KANTOR',
            'HP_KANTOR',
            'WEBSITE',
            'EMAIL',
            'PLAFON',
            'NO_NPWP',
            'NAMA_NPWP',
            'ALAMAT_NPWP',
            'RT_NPWP',
            'RW_NPWP',
            'KELURAHAN_NPWP',
            'KECAMATAN_NPWP',
            'NAMA_KOTA_NPWP',
            'NAMA_PROVINSI_NPWP',
            'NAMA_NEGARA_NPWP',
            'FOTO_NPWP',
            'CP',
            'JABATAN_CP',
            'NO_HP_CP',
            'EMAIL_CP',
            'NAMA_REKENING',
            'NO_REKENING',
            'NAMA_BANK',
            'ALAMAT_BANK',
            'TOP',
            'PAYMENT',
            'KETERANGAN_TOP',
            'TGL_AWAL_JADI_VENDOR',
            'FORM_VENDOR'
        ];

        $url_dropdown_city = env('API_URL') . "/city/dropdown";
        $response_dropdown_city = Http::withToken($providedToken)->get($url_dropdown_city);
        $data_dropdown_city = $response_dropdown_city->json();
        $cities = $data_dropdown_city['data'];
        $array_cities_dropdown = [];
        foreach ($cities as $city) {
            $array_cities_dropdown[$city['KODE']] = $city['NAMA'];
        }

        $url_dropdown_vendor_type = env('API_URL') . "/vendor-type";
        $response_dropdown_vendor_type = Http::withToken($providedToken)->get($url_dropdown_vendor_type);
        $data_dropdown_vendor_type = $response_dropdown_vendor_type->json();
        $vendors = $data_dropdown_vendor_type['data'];
        $array_vendor_types_dropdown = [];
        foreach ($vendors as $vendor) {
            $array_vendor_types_dropdown[$vendor['KODE']] = $vendor['NAMA'];
        }




        // $url = env('API_URL') . "/vendor";
        // //post with token
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();
        // //get $data['data']['customer_group'] length
        // $length = count($data['data']);
        $data = [];
        $length = 0;
        if ($length > 0) {
            // $keys = array_keys($data['data']['customer_group'][0]);

            return view('pages.1master.6vendor.pelayaranvendor', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-vendor', 'data' => $data['data'], 'keys' => $columns_shown, 'table_headers' => $table_headers,  'array_cities_dropdown' => $array_cities_dropdown, 'array_vendor_types_dropdown' => $array_vendor_types_dropdown]);
        } else {
            return view('pages.1master.6vendor.pelayaranvendor', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-vendor', 'data' => [], 'keys' => $columns_shown, 'table_headers' => $table_headers,  'array_cities_dropdown' => $array_cities_dropdown, 'array_vendor_types_dropdown' => $array_vendor_types_dropdown]);
        }
        // return view('pages.1master.5customer.potensialcustomer', ['type_menu' => 'layout-master', 'type_submenu' => '',]);
    }
    // make an update function
    public function update(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/vendor" . "/" . $request->KODE;

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
        if ($request->hasFile('FORM_VENDOR')) {
            $file_form = $request->file('FORM_VENDOR');
            $httpRequest->attach('FORM_VENDOR', file_get_contents($file_form), $file_form->getClientOriginalName());
        }
        //send request to API with x-www-form-urlencoded
        //remove _method from request
        $request->request->remove('_method');
        $response = $httpRequest->post($url, $request->all());
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    // public function updateContinue(Request $request)
    // {
    //     $providedToken = $request->cookie('token');
    //     $url = env('API_URL') . "/vendor" . "/continue" . "/" . $request->KODE;
    //     //post with token
    //     $httpRequest = Http::withToken($providedToken);

    //     // Attach the files if they exist
    //     if ($request->hasFile('FOTO_KTP')) {
    //         $file_ktp = $request->file('FOTO_KTP');
    //         $httpRequest->attach('FOTO_KTP', file_get_contents($file_ktp), $file_ktp->getClientOriginalName());
    //     }
    //     if ($request->hasFile('FOTO_NPWP')) {
    //         $file_npwp = $request->file('FOTO_NPWP');
    //         $httpRequest->attach('FOTO_NPWP', file_get_contents($file_npwp), $file_npwp->getClientOriginalName());
    //     }
    //     if ($request->hasFile('FORM_VENDOR')) {
    //         $file_form = $request->file('FORM_VENDOR');
    //         $httpRequest->attach('FORM_VENDOR', file_get_contents($file_form), $file_form->getClientOriginalName());
    //     }
    //     //send request to API with x-www-form-urlencoded
    //     //remove _method from request
    //     $request->request->remove('_method');
    //     $response = $httpRequest->post($url, $request->all());
    //     $statusCode = $response->status();

    //     return response()->json($response->json(), $statusCode);
    // }
    // make a delete function
    public function delete(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/vendor" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
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
        $url = env('API_URL') . "/vendor/get-next-id";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }

    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/vendor/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
    // function to restore trash data from Route::post('/vendor/restore', [vendorController::class, 'restore'])->name('vendor.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/vendor/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }
}
