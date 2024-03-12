<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class StaffController extends Controller
{
    public function dataTableAdvJson(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/staff/json-adv";

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
        $url = env('API_URL') . "/staff/json";

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
        $url = env('API_URL') . "/staff" . "/" . $request->KODE;

        // GET request to fetch cities by KODE_PROVINCE from the API
        $response = Http::withToken($providedToken)->get($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }

    public function store(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/staff";

        // Get pictures
        $file_ktp = $request->file('FOTO_KTP');
        $file_sim = $request->file('FOTO_SIM');
        $file_kk = $request->file('FOTO_KK');
        $file_bpjs_kesehatan = $request->file('FOTO_BPJS_KESEHATAN');
        $file_bpjs_ketenagakerjaan = $request->file('FOTO_BPJS_KETENAGAKERJAAN');
        $file_foto_karyawan = $request->file('FOTO_KARYAWAN');
        $file_foto_kontrak_kerja = $request->file('FOTO_KONTRAK_KERJA');


        $httpRequest = Http::withToken($providedToken);

        // Attach the file if it exists
        if ($file_ktp) {
            $httpRequest->attach('FOTO_KTP', file_get_contents($file_ktp), $file_ktp->getClientOriginalName());
        }
        if ($file_sim) {
            $httpRequest->attach('FOTO_SIM', file_get_contents($file_sim), $file_sim->getClientOriginalName());
        }
        if ($file_kk) {
            $httpRequest->attach('FOTO_KK', file_get_contents($file_kk), $file_kk->getClientOriginalName());
        }
        if ($file_bpjs_kesehatan) {
            $httpRequest->attach('FOTO_BPJS_KESEHATAN', file_get_contents($file_bpjs_kesehatan), $file_bpjs_kesehatan->getClientOriginalName());
        }
        if ($file_bpjs_ketenagakerjaan) {
            $httpRequest->attach('FOTO_BPJS_KETENAGAKERJAAN', file_get_contents($file_bpjs_ketenagakerjaan), $file_bpjs_ketenagakerjaan->getClientOriginalName());
        }
        if ($file_foto_karyawan) {
            $httpRequest->attach('FOTO_KARYAWAN', file_get_contents($file_foto_karyawan), $file_foto_karyawan->getClientOriginalName());
        }
        if ($file_foto_kontrak_kerja) {
            $httpRequest->attach('FOTO_KONTRAK_KERJA', file_get_contents($file_foto_kontrak_kerja), $file_foto_kontrak_kerja->getClientOriginalName());
        }




        // Make the HTTP request with the attached files
        $response = $httpRequest->post($url, $request->all());

        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }


    public function update(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/staff" . "/" . $request->KODE;

        $httpRequest = Http::withToken($providedToken);

        // Attach the files if they exist
        if ($request->hasFile('FOTO_KTP')) {
            $file_ktp = $request->file('FOTO_KTP');
            $httpRequest->attach('FOTO_KTP', file_get_contents($file_ktp), $file_ktp->getClientOriginalName());
        }
        if ($request->hasFile('FOTO_SIM')) {
            $file_sim = $request->file('FOTO_SIM');
            $httpRequest->attach('FOTO_SIM', file_get_contents($file_sim), $file_sim->getClientOriginalName());
        }
        if ($request->hasFile('FOTO_KK')) {
            $file_foto_kk = $request->file('FOTO_KK');
            $httpRequest->attach('FOTO_KK', file_get_contents($file_foto_kk), $file_foto_kk->getClientOriginalName());
        }
        if ($request->hasFile('FOTO_BPJS_KESEHATAN')) {
            $file_bpjs_kesehatan = $request->file('FOTO_BPJS_KESEHATAN');
            $httpRequest->attach('FOTO_BPJS_KESEHATAN', file_get_contents($file_bpjs_kesehatan), $file_bpjs_kesehatan->getClientOriginalName());
        }
        if ($request->hasFile('FOTO_BPJS_KETENAGAKERJAAN')) {
            $file_bpjs_ketenagakerjaan = $request->file('FOTO_BPJS_KETENAGAKERJAAN');
            $httpRequest->attach('FOTO_BPJS_KETENAGAKERJAAN', file_get_contents($file_bpjs_ketenagakerjaan), $file_bpjs_ketenagakerjaan->getClientOriginalName());
        }
        if ($request->hasFile('FOTO_KARYAWAN')) {
            $file_foto_karyawan = $request->file('FOTO_KARYAWAN');
            $httpRequest->attach('FOTO_KARYAWAN', file_get_contents($file_foto_karyawan), $file_foto_karyawan->getClientOriginalName());
        }
        if ($request->hasFile('FOTO_KONTRAK_KERJA')) {
            $file_foto_kontrak_kerja = $request->file('FOTO_KONTRAK_KERJA');
            $httpRequest->attach('FOTO_KONTRAK_KERJA', file_get_contents($file_foto_kontrak_kerja), $file_foto_kontrak_kerja->getClientOriginalName());
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
            'Email',
            'Nickname',
            'Jabatan',
            'Lokasi',
            'No. HP',
            'No. HP Kantor',
            'No. HP Keluarga',
            'Keterangan Keluarga',
            'NIK',
            'SIM',
            'Alamat KTP',
            'Alamat Domisili',
            'TTL',
            'Jenis Kelamin',
            'Agama',
            'Status Pernikahan',
            'Jumlah Anak',
            'Tgl Mulai Kerja',
            'Tgl Selesai Kontrak',
            'Status Karyawan',
            'Jam Masuk',
            'Jam Keluar',
            'Account Number',
            'Bank',
            'Atas Nama',
            'Gaji Pokok',
            'Nominal Gaji Pokok',
            'BPJS Kesehatan',
            'Nominal BPJS Kesehatan',
            'BPJS Ketenagakerjaan',
            'Nominal BPJS Ketenagakerjaan',
            'Uang Makan',
            'Nominal Uang Makan',
            'Uang Transport',
            'Nominal Uang Transport',
            'Uang Lembur',
            'Nominal Uang Lembur',
            'Pulsa',
            'Nominal Pulsa',
            'Tunjangan Kendaraan',
            'Nominal Tunjangan Kendaraan',
            'Tunjangan Lain',
            'Nominal Tunjangan Lain',
            'Keterangan Tunjangan Lain',
            'Insentif',
            'THR',
            'Foto KTP',
            'Foto SIM',
            'Foto KK',
            'Foto BPJS Kesehatan',
            'FOTO BPJS Ketenagakerjaan',
            'Foto Karyawan',
            'Foto Kontrak Kerja',
        ];

        $columns_shown = [
            'KODE',
            'NAMA',
            'EMAIL',
            'NICKNAME',
            'NAMA_JABATAN',
            'NAMA_LOKASI',
            'NO_HP',
            'NO_HP_KANTOR',
            'NO_HP_KELUARGA',
            'KETERANGAN_KELUARGA',
            'NIK',
            'NO_SIM',
            'ALAMAT_KTP',
            'ALAMAT_DOMISILI',
            'TTL',
            'JENIS_KELAMIN',
            'AGAMA',
            'STATUS_PERNIKAHAN',
            'JUMLAH_ANAK',
            'TGL_MULAI_KERJA',
            'TGL_SELESAI_KONTRAK',
            'STATUS_KARYAWAN',
            'JAM_MASUK',
            'JAM_KELUAR',
            'ACCOUNT_NUMBER',
            'BANK',
            'ATAS_NAMA',
            'GAJI_POKOK',
            'DET_GAJI_POKOK',
            'BPJS_KESEHATAN',
            'DET_BPJS_KESEHATAN',
            'BPJS_KETENAGAKERJAAN',
            'DET_BPJS_KETENAGAKERJAAN',
            'UANG_MAKAN',
            'DET_UANG_MAKAN',
            'UANG_TRANSPORT',
            'DET_UANG_TRANSPORT',
            'UANG_LEMBUR',
            'DET_UANG_LEMBUR',
            'PULSA',
            'DET_PULSA',
            'TUNJANGAN_KENDARAAN',
            'DET_TUNJANGAN_KENDARAAN',
            'TUNJANGAN_LAIN',
            'DET_TUNJANGAN_LAIN',
            'KETERANGAN_TUNJANGAN_LAIN',

            'INSENTIF',
            'THR',
            'FOTO_KTP',
            'FOTO_SIM',
            'FOTO_KK',
            'FOTO_BPJS_KESEHATAN',
            'FOTO_BPJS_KETENAGAKERJAAN',
            'FOTO_KARYAWAN',
            'FOTO_KONTRAK_KERJA',

        ];

        $url_dropdown_position = env('API_URL') . "/position";
        $response_dropdown_position = Http::withToken($providedToken)->get($url_dropdown_position);
        $data_dropdown_position = $response_dropdown_position->json();
        $positions = $data_dropdown_position['data'];
        $array_position_dropdown = [];
        foreach ($positions as $position) {
            $array_position_dropdown[$position['KODE']] = $position['NAMA'];
        }

        // dropdown from API /warehouse
        $url_dropdown_warehouse = env('API_URL') . "/warehouse";
        $response_dropdown_warehouse = Http::withToken($providedToken)->get($url_dropdown_warehouse);
        $data_dropdown_warehouse = $response_dropdown_warehouse->json();
        $warehouses = $data_dropdown_warehouse['data'];
        $array_warehouse_dropdown = [];
        foreach ($warehouses as $warehouse) {
            $array_warehouse_dropdown[$warehouse['KODE']] = $warehouse['NAMA'];
        }



        // $url = env('API_URL') . '/staff';
        // //post with token
        // $response = Http::withToken($providedToken)->get($url);
        // $data = $response->json();
        // $length = count($data['data']);
        $data = [];
        $length = 0;
        if ($length > 0) {
            return view('pages.1master.13karyawan.karyawan', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-karyawan', 'data' => $data['data'], 'keys' => $columns_shown, 'table_headers' => $table_headers, 'array_position_dropdown' => $array_position_dropdown, 'array_warehouse_dropdown' => $array_warehouse_dropdown]);
        } else {
            return view('pages.1master.13karyawan.karyawan', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-karyawan', 'data' => [], 'keys' => $columns_shown, 'table_headers' => $table_headers, 'array_position_dropdown' => $array_position_dropdown, 'array_warehouse_dropdown' => $array_warehouse_dropdown]);
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
        $url = env('API_URL') . "/staff/get-next-id";
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
        $url = env('API_URL') . "/staff" . "/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->delete($url);
        $statusCode = $response->status();

        return response()->json($response->json(), $statusCode);
    }



    public function trash(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/staff/trash";
        //post with token
        $response = Http::withToken($providedToken)->get($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
    // function to restore trash data from Route::post('/staff-group/restore', [customer-groupController::class, 'restore'])->name('customer-group.restore');
    public function restore(Request $request)
    {
        $providedToken = $request->cookie('token');
        $url = env('API_URL') . "/staff/restore/" . $request->KODE;
        //post with token
        $response = Http::withToken($providedToken)->post($url);
        $data = $response->json();
        // dd($data);
        return response()->json($data);
    }
}
