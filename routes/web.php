<?php

use App\Http\Controllers\AccCustomer;
use App\Http\Controllers\AccCustomerController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BusinessTypeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\CommodityController;
use App\Http\Controllers\ContainerTypeController;
use App\Http\Controllers\CostController;
use App\Http\Controllers\CostGroupController;
use App\Http\Controllers\CostRateController;
use App\Http\Controllers\CostTypeController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CustomerGroupController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FormulaController;
use App\Http\Controllers\GeneralPriceController;
use App\Http\Controllers\HarborController;
use App\Http\Controllers\HppTruckController;
use App\Http\Controllers\JOAController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\OrderTypeController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PraJOAController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\SpecialPriceController;
use App\Http\Controllers\ThcLoloPortLoadingController;
use App\Http\Controllers\ThcLoloPortDischargeController;
use App\Http\Controllers\TruckController;
use App\Http\Controllers\TruckPriceController;
use App\Http\Controllers\TruckRouteController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ThcLoloController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\VendorTypeController;
use App\Http\Controllers\WarehouseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/sidebar', function () {
    return view('sidebar');
});
function set_active($route)
{
    if (is_array($route)) {
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}


//redirect / to /login


// Dashboard


Route::get('/login', [AuthController::class, 'frontLogin'])->name('login-page')->middleware('guest');

Route::get('/', function () {
    return redirect()->route('login-page');
});

Route::post('/login/submit', [AuthController::class, 'frontLoginSubmit'])->name('auth.front.login');



Route::middleware(['check.token'])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('/home', function () {
        return view('pages.home', ['type_menu' => 'dashboard', 'type_submenu' => '']);
    })->name('home');

    Route::get('/master', function () {
        return view('pages.1master.master', ['type_menu' => 'layout-master', 'type_submenu' => '']);
    })->name('master');

    Route::get('/dash-joa', function () {
        return view('pages.2joa.joa', ['type_menu' => 'layout-joa', 'type_submenu' => '']);
    })->name('dash-joa');

    // Route::get('/prajoa', function () {
    //     return view('pages.2joa.1prajoa.prajoa', ['type_menu' => 'layout-joa', 'type_submenu' => '']);
    // })->name('prajoa');

    // Route::get('/aproval', function () {
    //     return view('pages.2joa.2aproval.aproval', ['type_menu' => 'layout-joa', 'type_submenu' => '']);
    // })->name('aproval');

    // Route::get('/penawaran', function () {
    //     return view('pages.2joa.3penawaran.penawaran', ['type_menu' => 'layout-joa', 'type_submenu' => '']);
    // })->name('penawaran');
    // Route::get('/acccustomer', function () {
    //     return view('pages.2joa.4acccustomer.acccustomer', ['type_menu' => 'layout-joa', 'type_submenu' => '']);
    // })->name('acccustomer');
    // Route::get('/joa', function () {
    //     return view('pages.2joa.5joa.joa', ['type_menu' => 'layout-joa', 'type_submenu' => '']);
    // })->name('joa');


    Route::get('/transaksi', function () {
        return view('pages.transaksi.transaksi', ['type_menu' => 'transaksimenu', 'type_submenu' => '']);
    })->name('transaksi');
    // Route::get('/negara', function () {
    //     return view('pages.1master.0negara.negara', ['type_menu' => 'layout-master', 'type_submenu' => '']);
    // })->name('negara');




    Route::get('/kota', function () {
        return view('pages.1master.2kota.kota', ['type_menu' => 'layout-master', 'type_submenu' => '']);
    })->name('kota');

    Route::get('/dash-truck', function () {
        return view('pages.1master.4truck.dash-truck', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-truck']);
    })->name('dash-truck');

    Route::get('/dash-karyawan', function () {
        return view('pages.1master.13karyawan.dash-karyawan', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-karyawan']);
    })->name('dash-karyawan');

    // Route::get('/rutetruck', function () {
    //     return view('pages.1master.4rute.rutetruck', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-rute']);
    // })->name('rutetruck');


    // Route::get('/pelabuhan', function () {
    //     return view('pages.1master.4rute.pelabuhan', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-rute']);
    // })->name('pelabuhan');
    // Route::get('/rutepengiriman', function () {
    //     return view('pages.1master.4rute.rutepengiriman', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-rute']);
    // })->name('rutepengiriman');

    Route::get('/dash-customer', function () {
        return view('pages.1master.5customer.dash-customer', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-customer']);
    })->name('dash-customer');
    // Route::get('/jenisusaha', function () {
    //     return view('pages.1master.5customer.jenisusaha', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-customer']);
    // })->name('jenisusaha');

    Route::get('/dash-vendor', function () {
        return view('pages.1master.6vendor.dash-vendor', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-vendor']);
    })->name('dash-vendor');


    // Route::get('/kapal', function () {
    //     return view('pages.1master.12kapal.kapal', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-vendor']);
    // })->name('kapal');

    Route::get('/jeniskiriman', function () {
        return view('pages.1master.7jeniskiriman.jeniskiriman', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-jeniskiriman']);
    })->name('jeniskiriman');
    Route::get('/lcl', function () {
        return view('pages.1master.7jeniskiriman.lcl', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-jeniskiriman']);
    })->name('lcl');
    Route::get('/fcl', function () {
        return view('pages.1master.7jeniskiriman.fcl', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-jeniskiriman']);
    })->name('fcl');
    // Route::get('/ukuran', function () {
    //     return view('pages.1master.7jeniskiriman.ukuran', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-jeniskiriman']);
    // })->name('ukuran');

    Route::get('/hargalclfix', function () {
        return view('pages.1master.8zhargalclfix.hargalcl', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-hargalclfix']);
    })->name('hargalclfix');

    Route::get('/hargalcl', function () {
        return view('pages.1master.8hargalcl.hargalcl', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-hargalcl']);
    })->name('hargalcl');

    // Route::get('/dash-hargalcl', function () {
    //     return view('pages.1master.8zhargalclfix.hargalcl', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-hargalclfix']);
    // })->name('dash-hargalcl');

    Route::get('/dash-hargalcl', function () {
        return view('pages.1master.8zhargalclfix.hargalcl', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-hargalclfix']);
    })->name('dash-hargalcl');

    Route::get('/umum', function () {
        return view('pages.1master.8hargalcl.umum', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-hargalcl']);
    })->name('umum');
    Route::get('/khusus', function () {
        return view('pages.1master.8hargalcl.khusus', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-hargalcl']);
    })->name('khusus');

    Route::get('/accounting', function () {
        return view('pages.1master.9accounting.accounting', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-accounting']);
    })->name('accounting');

    // management web
    Route::get('/managementweb', function () {
        return view('pages.1master.managementweb.managementweb', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-managementweb']);
    })->name('managementweb');

    Route::get('/slide', function () {
        return view('pages.1master.managementweb.slide', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-managementweb']);
    })->name('slide');
    Route::get('/profile', function () {
        return view('pages.1master.managementweb.profil', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-managementweb']);
    })->name('profile');
    Route::get('/promosi', function () {
        return view('pages.1master.managementweb.promosi', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-managementweb']);
    })->name('promosi');
    Route::get('/berita', function () {
        return view('pages.1master.managementweb.berita', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-managementweb']);
    })->name('berita');


    // management user
    Route::get('/managementuser', function () {
        return view('pages.1master.managementuser.managementuser', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-managementuser']);
    })->name('managementuser');
    Route::get('/group', function () {
        return view('pages.1master.managementuser.group', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-managementuser']);
    })->name('group');
    // Route::get('/user', function () {
    //     return view('pages.1master.managementuser.user', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-managementuser']);
    // })->name('user');
    Route::get('/password', function () {
        return view('pages.1master.managementuser.password', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-managementuser']);
    })->name('password');
    Route::get('/setting', function () {
        return view('pages.1master.managementuser.setting', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-managementuser']);
    })->name('setting');


    // mitra
    Route::get('/mitra', function () {
        return view('pages.1master.mitra.mitra', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-mitra']);
    })->name('mitra');









    Route::get('/posaccount', function () {
        return view('pages.1master.accounting.posaccount', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-accounting']);
    })->name('posaccount');
    Route::get('/exhibit', function () {
        return view('pages.1master.accounting.exhibit', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-accounting']);
    })->name('exhibit');
    Route::get('/settingaccount', function () {
        return view('pages.1master.accounting.settingaccount', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-accounting']);
    })->name('settingaccount');
    Route::get('/useracc', function () {
        return view('pages.1master.0auser.dash-user', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-useracc']);
    })->name('useracc');

    // Route::get('/kategori', function () {
    //     return view('pages.1master.produk.kategori', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-product']);
    // })->name('kategori');
    // Route::get('/hargafull', function () {
    //     return view('pages.1master.produk.hargafull', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-product']);
    // })->name('hargafull');
    // Route::get('/hargapercustomer', function () {
    //     return view('pages.1master.produk.hargapercustomer', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-product']);
    // })->name('hargapercustomer');
    Route::get('/jenisbarang', function () {
        return view('pages.1master.produk.jenisbarang', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-product']);
    })->name('jenisbarang');
    Route::get('/jeniscontainer', function () {
        return view('pages.1master.produk.jeniscontainer', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-product']);
    })->name('jeniscontainer');
    Route::get('/hargacurah', function () {
        return view('pages.1master.produk.hargacurah', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-product']);
    })->name('hargacurah');

    Route::get('/fixasset', function () {
        return view('pages.1master.fixasset.fixasset', ['type_menu' => 'layout-master', 'type_submenu' => '']);
    })->name('fixasset');


    // Route::get('/truck', function () {
    //     return view('pages.1master.4rute.truck', ['type_menu' => 'layout-master', 'type_submenu' => 'layout-rute']);
    // })->name('truck');


    Route::get('/barcode', function () {
        return view('pages.transaksi.barcode.barcode', ['type_menu' => 'barcode']);
    })->name('barcode');
    Route::get('/jadwalkapal', function () {
        return view('pages.transaksi.jadwalkapal.jadwalkapal', ['type_menu' => 'jadwalkapal']);
    })->name('jadwalkapal');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/negara/json-adv', [CountryController::class, 'dataTableAdvJson'])->name('negara.jsonadv');
    Route::post('/negara/json', [CountryController::class, 'dataTableJson'])->name('negara.json');
    Route::get('/negara/get-next-id', [CountryController::class, 'getNextId'])->name('negara.getNextId');
    Route::post("/negara", [CountryController::class, 'store'])->name('negara.store');
    Route::get("/negara", [CountryController::class, 'index'])->name('negara');
    Route::get("/negara-by-kode", [CountryController::class, 'findByKode'])->name('negara.findByKode');
    Route::put("/negara", [CountryController::class, 'update'])->name('negara.update');
    Route::delete("/negara", [CountryController::class, 'delete'])->name('negara.delete');
    Route::get('/negara/trash', [CountryController::class, 'trash'])->name('negara.trash');

    Route::post('/negara/restore', [CountryController::class, 'restore'])->name('negara.restore');

    Route::post('/customer-group/json-adv', [CustomerGroupController::class, 'dataTableAdvJson'])->name('customer-group.jsonadv');
    Route::post('/customer-group/json', [CustomerGroupController::class, 'dataTableJson'])->name('customer-group.json');
    Route::get('/customer-group/trash', [CustomerGroupController::class, 'trash'])->name('customer-group.trash');
    Route::post('/customer-group/restore', [CustomerGroupController::class, 'restore'])->name('customer-group.restore');
    // Route::post('/customer-group/continue', [CustomerGroupController::class, 'storeContinue'])->name('customer-group.storeContinue');
    Route::get('/customer-group/get-next-id', [CustomerGroupController::class, 'getNextId'])->name('customer-group.getNextId');
    Route::post("/customer-group", [CustomerGroupController::class, 'store'])->name('customer-group.store');
    Route::get("/customer-group", [CustomerGroupController::class, 'index'])->name('customer-group');
    Route::get("/customer-group-by-kode", [CustomerGroupController::class, 'findByKode'])->name('customer-group.findByKode');
    // Route::put("/customer-group/continue", [CustomerGroupController::class, 'updateContinue'])->name('customer-group.updateContinue');
    Route::PUT("/customer-group", [CustomerGroupController::class, 'update'])->name('customer-group.update');
    Route::delete("/customer-group", [CustomerGroupController::class, 'delete'])->name('customer-group.delete');

    Route::post('/kota/json-adv', [CityController::class, 'dataTableAdvJson'])->name('kota.jsonadv');
    Route::post('/kota/json', [CityController::class, 'dataTableJson'])->name('kota.json');
    Route::get('/kota/trash', [CityController::class, 'trash'])->name('kota.trash');
    Route::post('/kota/restore', [CityController::class, 'restore'])->name('kota.restore');
    Route::get('/kota/get-next-id', [CityController::class, 'getNextId'])->name('kota.getNextId');
    Route::get("kota", [CityController::class, 'index'])->name('kota');
    Route::get("/kota-by-kode", [CityController::class, 'findByKode'])->name('kota.findByKode');
    Route::post("/kota", [CityController::class, 'store'])->name('kota.store');
    Route::put("/kota", [CityController::class, 'update'])->name('kota.update');
    Route::delete("/kota", [CityController::class, 'delete'])->name('kota.delete');

    Route::post('/provinsi/json-adv', [ProvinceController::class, 'dataTableAdvJson'])->name('provinsi.jsonadv');
    Route::post('/provinsi/json', [ProvinceController::class, 'dataTableJson'])->name('provinsi.json');
    Route::get('/provinsi/trash', [ProvinceController::class, 'trash'])->name('provinsi.trash');
    Route::post('/provinsi/restore', [ProvinceController::class, 'restore'])->name('provinsi.restore');
    Route::get('/provinsi/get-next-id', [ProvinceController::class, 'getNextId'])->name('provinsi.getNextId');
    Route::get("/provinsi", [ProvinceController::class, 'index'])->name('provinsi');
    Route::get("/provinsi-by-kode", [ProvinceController::class, 'findByKode'])->name('provinsi.findByKode');
    Route::put("/provinsi", [ProvinceController::class, 'update'])->name('provinsi.update');
    Route::delete("/provinsi", [ProvinceController::class, 'delete'])->name('provinsi.delete');
    Route::post("/provinsi", [ProvinceController::class, 'store'])->name('provinsi.store');
    // Route::get("/provinsi/{KODE_NEGARA}", [ProvinceController::class, 'findByKodeNegara'])->name('provinsi.findByKodeNegara');

    Route::get("/provinsi/{KODE_NEGARA}", [ProvinceController::class, 'findByKodeNegara'])->name('provinsi.findByKodeNegara');

    //customer
    Route::post('/customer/json-adv', [CustomerController::class, 'dataTableAdvJson'])->name('customer.jsonadv');

    Route::post('/customer/json', [CustomerController::class, 'dataTableJson'])->name('customer.json');
    Route::get('/customer/trash', [CustomerController::class, 'trash'])->name('customer.trash');
    Route::get('/customer', [CustomerController::class, 'index'])->name('customer');
    Route::post('/customer/restore', [CustomerController::class, 'restore'])->name('customer.restore');
    Route::get('/customer/get-next-id', [CustomerController::class, 'getNextId'])->name('customer.getNextId');
    Route::post("/customer", [CustomerController::class, 'store'])->name('customer.store');
    Route::get("/customer-by-kode", [CustomerController::class, 'findByKode'])->name('customer.findByKode');
    Route::put("/customer", [CustomerController::class, 'update'])->name('customer.update');
    Route::get("/customer/files/{filename}", [CustomerController::class, 'getFiles'])->name('customer.getFiles');
    Route::delete("/customer", [CustomerController::class, 'delete'])->name('customer.delete');

    Route::post('/pelabuhan/json-adv', [HarborController::class, 'dataTableAdvJson'])->name('pelabuhan.jsonadv');
    Route::post('/pelabuhan/json', [HarborController::class, 'dataTableJson'])->name('pelabuhan.json');
    Route::get('/pelabuhan/trash', [HarborController::class, 'trash'])->name('pelabuhan.trash');
    Route::post('/pelabuhan/restore', [HarborController::class, 'restore'])->name('pelabuhan.restore');
    Route::get('/pelabuhan/get-next-id', [HarborController::class, 'getNextId'])->name('pelabuhan.getNextId');
    Route::get("pelabuhan", [HarborController::class, 'index'])->name('pelabuhan');
    Route::get("/pelabuhan-by-kode", [HarborController::class, 'findByKode'])->name('pelabuhan.findByKode');
    Route::post("/pelabuhan", [HarborController::class, 'store'])->name('pelabuhan.store');
    Route::put("/pelabuhan", [HarborController::class, 'update'])->name('pelabuhan.update');
    Route::delete("/pelabuhan", [HarborController::class, 'delete'])->name('pelabuhan.delete');

    Route::post('/jenisvendor/json-adv', [VendorTypeController::class, 'dataTableAdvJson'])->name('jenisvendor.jsonadv');
    Route::post('/jenisvendor/json', [VendorTypeController::class, 'dataTableJson'])->name('jenisvendor.json');
    Route::get('/jenisvendor/get-next-id', [VendorTypeController::class, 'getNextId'])->name('jenisvendor.getNextId');
    Route::post("/jenisvendor", [VendorTypeController::class, 'store'])->name('jenisvendor.store');
    Route::get("/jenisvendor", [VendorTypeController::class, 'index'])->name('jenisvendor');
    Route::get("/jenisvendor-by-kode", [VendorTypeController::class, 'findByKode'])->name('jenisvendor.findByKode');
    Route::put("/jenisvendor", [VendorTypeController::class, 'update'])->name('jenisvendor.update');
    Route::delete("/jenisvendor", [VendorTypeController::class, 'delete'])->name('jenisvendor.delete');
    Route::get('/jenisvendor/trash', [VendorTypeController::class, 'trash'])->name('jenisvendor.trash');
    Route::post('/jenisvendor/restore', [VendorTypeController::class, 'restore'])->name('jenisvendor.restore');


    Route::post('/jenisusaha/json-adv', [BusinessTypeController::class, 'dataTableAdvJson'])->name('jenisusaha.jsonadv');
    Route::post('/jenisusaha/json', [BusinessTypeController::class, 'dataTableJson'])->name('jenisusaha.json');
    Route::get('/jenisusaha/get-next-id', [BusinessTypeController::class, 'getNextId'])->name('jenisusaha.getNextId');
    Route::post("/jenisusaha", [BusinessTypeController::class, 'store'])->name('jenisusaha.store');
    Route::get("/jenisusaha", [BusinessTypeController::class, 'index'])->name('jenisusaha');
    Route::get("/jenisusaha-by-kode", [BusinessTypeController::class, 'findByKode'])->name('jenisusaha.findByKode');
    Route::put("/jenisusaha", [BusinessTypeController::class, 'update'])->name('jenisusaha.update');
    Route::delete("/jenisusaha", [BusinessTypeController::class, 'delete'])->name('jenisusaha.delete');
    Route::get('/jenisusaha/trash', [BusinessTypeController::class, 'trash'])->name('jenisusaha.trash');
    Route::post('/jenisusaha/restore', [BusinessTypeController::class, 'restore'])->name('jenisusaha.restore');

    Route::post('/ukuran/json-adv', [SizeController::class, 'dataTableAdvJson'])->name('ukuran.jsonadv');
    Route::post('/ukuran/json', [SizeController::class, 'dataTableJson'])->name('ukuran.json');
    Route::get('/ukuran/get-next-id', [SizeController::class, 'getNextId'])->name('ukuran.getNextId');
    Route::post("/ukuran", [SizeController::class, 'store'])->name('ukuran.store');
    Route::get("/ukuran", [SizeController::class, 'index'])->name('ukuran');
    Route::get("/ukuran-by-kode", [SizeController::class, 'findByKode'])->name('ukuran.findByKode');
    Route::put("/ukuran", [SizeController::class, 'update'])->name('ukuran.update');
    Route::delete("/ukuran", [SizeController::class, 'delete'])->name('ukuran.delete');
    Route::get('/ukuran/trash', [SizeController::class, 'trash'])->name('ukuran.trash');
    Route::post('/ukuran/restore', [SizeController::class, 'restore'])->name('ukuran.restore');

    Route::post('/jeniskontainer/json-adv', [ContainerTypeController::class, 'dataTableAdvJson'])->name('jeniskontainer.jsonadv');
    Route::post('/jeniskontainer/json', [ContainerTypeController::class, 'dataTableJson'])->name('jeniskontainer.json');
    Route::get('/jeniskontainer/get-next-id', [ContainerTypeController::class, 'getNextId'])->name('jeniskontainer.getNextId');
    Route::post("/jeniskontainer", [ContainerTypeController::class, 'store'])->name('jeniskontainer.store');
    Route::get("/jeniskontainer", [ContainerTypeController::class, 'index'])->name('jeniskontainer');
    Route::get("/jeniskontainer-by-kode", [ContainerTypeController::class, 'findByKode'])->name('jeniskontainer.findByKode');
    Route::put("/jeniskontainer", [ContainerTypeController::class, 'update'])->name('jeniskontainer.update');
    Route::delete("/jeniskontainer", [ContainerTypeController::class, 'delete'])->name('jeniskontainer.delete');
    Route::get('/jeniskontainer/trash', [ContainerTypeController::class, 'trash'])->name('jeniskontainer.trash');
    Route::post('/jeniskontainer/restore', [ContainerTypeController::class, 'restore'])->name('jeniskontainer.restore');

    Route::post('/commodity/json-adv', [CommodityController::class, 'dataTableAdvJson'])->name('commodity.jsonadv');
    Route::post('/commodity/json', [CommodityController::class, 'dataTableJson'])->name('commodity.json');
    Route::get('/commodity/get-next-id', [CommodityController::class, 'getNextId'])->name('commodity.getNextId');
    Route::post("/commodity", [CommodityController::class, 'store'])->name('commodity.store');
    Route::get("/commodity", [CommodityController::class, 'index'])->name('commodity');
    Route::get("/commodity-by-kode", [CommodityController::class, 'findByKode'])->name('commodity.findByKode');
    Route::put("/commodity", [CommodityController::class, 'update'])->name('commodity.update');
    Route::delete("/commodity", [CommodityController::class, 'delete'])->name('commodity.delete');
    Route::get('/commodity/trash', [CommodityController::class, 'trash'])->name('commodity.trash');
    Route::post('/commodity/restore', [CommodityController::class, 'restore'])->name('commodity.restore');

    Route::post('/jenisorder/json-adv', [OrderTypeController::class, 'dataTableAdvJson'])->name('jenisorder.jsonadv');
    Route::post('/jenisorder/json', [OrderTypeController::class, 'dataTableJson'])->name('jenisorder.json');
    Route::get('/jenisorder/get-next-id', [OrderTypeController::class, 'getNextId'])->name('jenisorder.getNextId');
    Route::post("/jenisorder", [OrderTypeController::class, 'store'])->name('jenisorder.store');
    Route::get("/jenisorder", [OrderTypeController::class, 'index'])->name('jenisorder');
    Route::get("/jenisorder-by-kode", [OrderTypeController::class, 'findByKode'])->name('jenisorder.findByKode');
    Route::put("/jenisorder", [OrderTypeController::class, 'update'])->name('jenisorder.update');
    Route::delete("/jenisorder", [OrderTypeController::class, 'delete'])->name('jenisorder.delete');
    Route::get('/jenisorder/trash', [OrderTypeController::class, 'trash'])->name('jenisorder.trash');
    Route::post('/jenisorder/restore', [OrderTypeController::class, 'restore'])->name('jenisorder.restore');

    Route::post('/service/json-adv', [ServiceController::class, 'dataTableAdvJson'])->name('service.jsonadv');
    Route::post('/service/json', [ServiceController::class, 'dataTableJson'])->name('service.json');
    Route::get('/service/get-next-id', [ServiceController::class, 'getNextId'])->name('service.getNextId');
    Route::post("/service", [ServiceController::class, 'store'])->name('service.store');
    Route::get("/service", [ServiceController::class, 'index'])->name('service');
    Route::get("/service-by-kode", [ServiceController::class, 'findByKode'])->name('service.findByKode');
    Route::put("/service", [ServiceController::class, 'update'])->name('service.update');
    Route::delete("/service", [ServiceController::class, 'delete'])->name('service.delete');
    Route::get('/service/trash', [ServiceController::class, 'trash'])->name('service.trash');
    Route::post('/service/restore', [ServiceController::class, 'restore'])->name('service.restore');


    Route::post('/truck/json-adv', [TruckController::class, 'dataTableAdvJson'])->name('truck.jsonadv');
    Route::post('/truck/json', [TruckController::class, 'dataTableJson'])->name('truck.json');
    Route::get('/truck/get-next-id', [TruckController::class, 'getNextId'])->name('truck.getNextId');
    Route::post("/truck", [TruckController::class, 'store'])->name('truck.store');
    Route::get("/truck", [TruckController::class, 'index'])->name('truck');
    Route::get("/truck-by-kode", [TruckController::class, 'findByKode'])->name('truck.findByKode');
    Route::put("/truck", [TruckController::class, 'update'])->name('truck.update');
    Route::delete("/truck", [TruckController::class, 'delete'])->name('truck.delete');
    Route::get('/truck/trash', [TruckController::class, 'trash'])->name('truck.trash');
    Route::post('/truck/restore', [TruckController::class, 'restore'])->name('truck.restore');

    Route::post('/costtype/json-adv', [CostTypeController::class, 'dataTableAdvJson'])->name('costtype.jsonadv');
    Route::post('/costtype/json', [CostTypeController::class, 'dataTableJson'])->name('costtype.json');
    Route::get('/costtype/get-next-id', [CostTypeController::class, 'getNextId'])->name('costtype.getNextId');
    Route::post("/costtype", [CostTypeController::class, 'store'])->name('costtype.store');
    Route::get("/costtype", [CostTypeController::class, 'index'])->name('costtype');
    Route::get("/costtype-by-kode", [CostTypeController::class, 'findByKode'])->name('costtype.findByKode');
    Route::put("/costtype", [CostTypeController::class, 'update'])->name('costtype.update');
    Route::delete("/costtype", [CostTypeController::class, 'delete'])->name('costtype.delete');
    Route::get('/costtype/trash', [CostTypeController::class, 'trash'])->name('costtype.trash');
    Route::post('/costtype/restore', [CostTypeController::class, 'restore'])->name('costtype.restore');

    Route::post('/costgroup/json-adv', [CostGroupController::class, 'dataTableAdvJson'])->name('costgroup.jsonadv');
    Route::post('/costgroup/json', [CostGroupController::class, 'dataTableJson'])->name('costgroup.json');
    Route::get('/costgroup/get-next-id', [CostGroupController::class, 'getNextId'])->name('costgroup.getNextId');
    Route::post("/costgroup", [CostGroupController::class, 'store'])->name('costgroup.store');
    Route::get("/costgroup", [CostGroupController::class, 'index'])->name('costgroup');
    Route::get("/costgroup-by-kode", [CostGroupController::class, 'findByKode'])->name('costgroup.findByKode');
    Route::put("/costgroup", [CostGroupController::class, 'update'])->name('costgroup.update');
    Route::delete("/costgroup", [CostGroupController::class, 'delete'])->name('costgroup.delete');
    Route::get('/costgroup/trash', [CostGroupController::class, 'trash'])->name('costgroup.trash');
    Route::post('/costgroup/restore', [CostGroupController::class, 'restore'])->name('costgroup.restore');


    Route::post('/rutetruck/json-adv', [TruckRouteController::class, 'dataTableAdvJson'])->name('rutetruck.jsonadv');
    Route::post('/rutetruck/json', [TruckRouteController::class, 'dataTableJson'])->name('rutetruck.json');
    Route::get('/rutetruck/trash', [TruckRouteController::class, 'trash'])->name('rutetruck.trash');
    Route::post('/rutetruck/restore', [TruckRouteController::class, 'restore'])->name('rutetruck.restore');
    Route::get('/rutetruck/get-next-id', [TruckRouteController::class, 'getNextId'])->name('rutetruck.getNextId');
    Route::get("rutetruck", [TruckRouteController::class, 'index'])->name('rutetruck');
    Route::get("/rutetruck-by-kode", [TruckRouteController::class, 'findByKode'])->name('rutetruck.findByKode');
    Route::post("/rutetruck", [TruckRouteController::class, 'store'])->name('rutetruck.store');
    Route::put("/rutetruck", [TruckRouteController::class, 'update'])->name('rutetruck.update');
    Route::delete("/rutetruck", [TruckRouteController::class, 'delete'])->name('rutetruck.delete');

    Route::post('/cost/json-adv', [CostController::class, 'dataTableAdvJson'])->name('cost.jsonadv');
    Route::post('/cost/json', [CostController::class, 'dataTableJson'])->name('cost.json');
    Route::get('/cost/trash', [CostController::class, 'trash'])->name('cost.trash');
    Route::post('/cost/restore', [CostController::class, 'restore'])->name('cost.restore');
    Route::get('/cost/get-next-id', [CostController::class, 'getNextId'])->name('cost.getNextId');
    Route::get("cost", [CostController::class, 'index'])->name('cost');
    Route::get("/cost-by-kode", [CostController::class, 'findByKode'])->name('cost.findByKode');
    Route::post("/cost", [CostController::class, 'store'])->name('cost.store');
    Route::put("/cost", [CostController::class, 'update'])->name('cost.update');
    Route::delete("/cost", [CostController::class, 'delete'])->name('cost.delete');

    Route::post('/truckprice/json-adv', [TruckPriceController::class, 'dataTableAdvJson'])->name('truckprice.jsonadv');
    Route::post('/truckprice/json', [TruckPriceController::class, 'dataTableJson'])->name('truckprice.json');
    Route::get('/truckprice/trash', [TruckPriceController::class, 'trash'])->name('truckprice.trash');
    Route::post('/truckprice/restore', [TruckPriceController::class, 'restore'])->name('truckprice.restore');
    Route::get('/truckprice/get-next-id', [TruckPriceController::class, 'getNextId'])->name('truckprice.getNextId');
    Route::get("truckprice", [TruckPriceController::class, 'index'])->name('truckprice');
    Route::get("/truckprice-by-kode", [TruckPriceController::class, 'findByKode'])->name('truckprice.findByKode');
    Route::post("/truckprice", [TruckPriceController::class, 'store'])->name('truckprice.store');
    Route::put("/truckprice", [TruckPriceController::class, 'update'])->name('truckprice.update');
    Route::delete("/truckprice", [TruckPriceController::class, 'delete'])->name('truckprice.delete');

    Route::post('/hpptruck/find-one', [HppTruckController::class, 'findOne'])->name('hpptruck.findOne');
    Route::post('/hpptruck/json-adv', [HppTruckController::class, 'dataTableAdvJson'])->name('hpptruck.jsonadv');
    Route::post('/hpptruck/json', [HppTruckController::class, 'dataTableJson'])->name('hpptruck.json');
    Route::get('/hpptruck/trash', [HppTruckController::class, 'trash'])->name('hpptruck.trash');
    Route::post('/hpptruck/restore', [HppTruckController::class, 'restore'])->name('hpptruck.restore');
    Route::get('/hpptruck/get-next-id', [HppTruckController::class, 'getNextId'])->name('hpptruck.getNextId');
    Route::get("hpptruck", [HppTruckController::class, 'index'])->name('hpptruck');
    Route::get("/hpptruck-by-kode", [HppTruckController::class, 'findByKode'])->name('hpptruck.findByKode');
    Route::post("/hpptruck", [HppTruckController::class, 'store'])->name('hpptruck.store');
    Route::put("/hpptruck", [HppTruckController::class, 'update'])->name('hpptruck.update');
    Route::delete("/hpptruck", [HppTruckController::class, 'delete'])->name('hpptruck.delete');

    Route::get("/costrate/master", [CostRateController::class, 'indexMaster'])->name('costrate.master');
    Route::post('/costrate/find-ocean-freight', [CostRateController::class, 'findOceanFreight'])->name('costrate.findOceanFreight');
    Route::post('/costrate/find-freight-surcharge', [CostRateController::class, 'findFreightSurcharge'])->name('costrate.findFreightSurcharge');

    Route::post('/costrate/json-adv', [CostRateController::class, 'dataTableAdvJson'])->name('costrate.jsonadv');
    Route::post('/costrate/json', [CostRateController::class, 'dataTableJson'])->name('costrate.json');
    Route::get('/costrate/trash', [CostRateController::class, 'trash'])->name('costrate.trash');
    Route::post('/costrate/restore', [CostRateController::class, 'restore'])->name('costrate.restore');
    Route::get('/costrate/get-next-id', [CostRateController::class, 'getNextId'])->name('costrate.getNextId');
    Route::get("costrate", [CostRateController::class, 'index'])->name('costrate');
    Route::get("/costrate-by-kode", [CostRateController::class, 'findByKode'])->name('costrate.findByKode');
    Route::post("/costrate", [CostRateController::class, 'store'])->name('costrate.store');
    Route::put("/costrate", [CostRateController::class, 'update'])->name('costrate.update');
    Route::delete("/costrate", [CostRateController::class, 'delete'])->name('costrate.delete');

    Route::post('/vendorsup/json-adv', [VendorController::class, 'dataTableAdvJson'])->name('vendor.jsonadv');
    Route::post('/vendorsup/json', [VendorController::class, 'dataTableJson'])->name('vendor.json');
    Route::get('/vendorsup/trash', [VendorController::class, 'trash'])->name('vendor.trash');
    Route::post('/vendorsup/restore', [VendorController::class, 'restore'])->name('vendor.restore');
    // Route::post('/vendorsup/continue', [VendorController::class, 'storeContinue'])->name('vendor.storeContinue');
    Route::get('/vendorsup/get-next-id', [VendorController::class, 'getNextId'])->name('vendor.getNextId');
    Route::post("/vendorsup", [VendorController::class, 'store'])->name('vendor.store');
    Route::get("/vendorsup", [VendorController::class, 'index'])->name('vendor');
    Route::get("/vendorsup-by-kode", [VendorController::class, 'findByKode'])->name('vendor.findByKode');
    // Route::put("/vendorsup/continue", [VendorController::class, 'updateContinue'])->name('vendor.updateContinue');
    Route::put("/vendorsup", [VendorController::class, 'update'])->name('vendor.update');
    Route::get("/vendorsup/files/{filename}", [VendorController::class, 'getFiles'])->name('vendor.getFiles');
    Route::delete("/vendorsup", [VendorController::class, 'delete'])->name('vendor.delete');



    Route::post('/accounting/json-adv', [AccountController::class, 'dataTableAdvJson'])->name('accounting.jsonadv');
    Route::post('/accounting/json', [AccountController::class, 'dataTableJson'])->name('accounting.json');
    Route::get('/accounting/trash', [AccountController::class, 'trash'])->name('accounting.trash');
    Route::post('/accounting/restore', [AccountController::class, 'restore'])->name('accounting.restore');
    Route::get('/accounting/get-next-id', [AccountController::class, 'getNextId'])->name('accounting.getNextId');
    Route::get("accounting", [AccountController::class, 'index'])->name('accounting');
    Route::get("/accounting-by-kode", [AccountController::class, 'findByKode'])->name('accounting.findByKode');
    Route::post("/accounting", [AccountController::class, 'store'])->name('accounting.store');
    Route::put("/accounting", [AccountController::class, 'update'])->name('accounting.update');
    Route::delete("/accounting", [AccountController::class, 'delete'])->name('accounting.delete');

    Route::post('/formula/json-adv', [FormulaController::class, 'dataTableAdvJson'])->name('formula.jsonadv');
    Route::post('/formula/json', [FormulaController::class, 'dataTableJson'])->name('formula.json');
    Route::get('/formula/get-next-id', [FormulaController::class, 'getNextId'])->name('formula.getNextId');
    Route::post("/formula", [FormulaController::class, 'store'])->name('formula.store');
    Route::get("/formula", [FormulaController::class, 'index'])->name('formula');
    Route::get("/formula-by-kode", [FormulaController::class, 'findByKode'])->name('formula.findByKode');
    Route::put("/formula", [FormulaController::class, 'update'])->name('formula.update');
    Route::delete("/formula", [FormulaController::class, 'delete'])->name('formula.delete');
    Route::get('/formula/trash', [FormulaController::class, 'trash'])->name('formula.trash');
    Route::post('/formula/restore', [FormulaController::class, 'restore'])->name('formula.restore');

    Route::post('/category/json-adv', [CategoryController::class, 'dataTableAdvJson'])->name('category.jsonadv');
    Route::post('/category/json', [CategoryController::class, 'dataTableJson'])->name('category.json');
    Route::get('/category/get-next-id', [CategoryController::class, 'getNextId'])->name('category.getNextId');
    Route::post("/category", [CategoryController::class, 'store'])->name('category.store');
    Route::get("/category", [CategoryController::class, 'index'])->name('category');
    Route::get("/category-by-kode", [CategoryController::class, 'findByKode'])->name('category.findByKode');
    Route::put("/category", [CategoryController::class, 'update'])->name('category.update');
    Route::delete("/category", [CategoryController::class, 'delete'])->name('category.delete');
    Route::get('/category/trash', [CategoryController::class, 'trash'])->name('category.trash');
    Route::post('/category/restore', [CategoryController::class, 'restore'])->name('category.restore');

    Route::post('/unit/json-adv', [UnitController::class, 'dataTableAdvJson'])->name('unit.jsonadv');
    Route::post('/unit/json', [UnitController::class, 'dataTableJson'])->name('unit.json');
    Route::get('/unit/get-next-id', [UnitController::class, 'getNextId'])->name('unit.getNextId');
    Route::post("/unit", [UnitController::class, 'store'])->name('unit.store');
    Route::get("/unit", [UnitController::class, 'index'])->name('unit');
    Route::get("/unit-by-kode", [UnitController::class, 'findByKode'])->name('unit.findByKode');
    Route::put("/unit", [UnitController::class, 'update'])->name('unit.update');
    Route::delete("/unit", [UnitController::class, 'delete'])->name('unit.delete');
    Route::get('/unit/trash', [UnitController::class, 'trash'])->name('unit.trash');
    Route::post('/unit/restore', [UnitController::class, 'restore'])->name('unit.restore');

    Route::post('/product/json-adv', [ProductController::class, 'dataTableAdvJson'])->name('product.jsonadv');
    Route::post('/product/json', [ProductController::class, 'dataTableJson'])->name('product.json');
    Route::get('/product/get-next-id', [ProductController::class, 'getNextId'])->name('product.getNextId');
    Route::post("/product", [ProductController::class, 'store'])->name('product.store');
    Route::get("/product", [ProductController::class, 'index'])->name('product');
    Route::get("/product-by-kode", [ProductController::class, 'findByKode'])->name('product.findByKode');
    Route::put("/product", [ProductController::class, 'update'])->name('product.update');
    Route::delete("/product", [ProductController::class, 'delete'])->name('product.delete');
    Route::get('/product/trash', [ProductController::class, 'trash'])->name('product.trash');
    Route::post('/product/restore', [ProductController::class, 'restore'])->name('product.restore');


    Route::get('/generalprice/trash', [GeneralPriceController::class, 'trash'])->name('generalprice.trash');
    Route::post('/generalprice/restore', [GeneralPriceController::class, 'restore'])->name('generalprice.restore');
    Route::get('/generalprice/get-next-id', [GeneralPriceController::class, 'getNextId'])->name('generalprice.getNextId');
    Route::get("generalprice", [GeneralPriceController::class, 'index'])->name('generalprice');
    Route::get("/generalprice-by-kode", [GeneralPriceController::class, 'findByKode'])->name('generalprice.findByKode');
    Route::post("/generalprice", [GeneralPriceController::class, 'store'])->name('generalprice.store');
    Route::put("/generalprice", [GeneralPriceController::class, 'update'])->name('generalprice.update');
    Route::delete("/generalprice", [GeneralPriceController::class, 'delete'])->name('generalprice.delete');

    Route::post('/specialprice/json-adv', [SpecialPriceController::class, 'dataTableAdvJson'])->name('specialprice.jsonadv');
    Route::post('/specialprice/json', [SpecialPriceController::class, 'dataTableJson'])->name('specialprice.json');
    Route::get('/specialprice/trash', [SpecialPriceController::class, 'trash'])->name('specialprice.trash');
    Route::post('/specialprice/restore', [SpecialPriceController::class, 'restore'])->name('specialprice.restore');
    Route::get('/specialprice/get-next-id', [SpecialPriceController::class, 'getNextId'])->name('specialprice.getNextId');
    Route::get("specialprice", [SpecialPriceController::class, 'index'])->name('specialprice');
    Route::get("/specialprice-by-kode", [SpecialPriceController::class, 'findByKode'])->name('specialprice.findByKode');
    Route::post("/specialprice", [SpecialPriceController::class, 'store'])->name('specialprice.store');
    Route::put("/specialprice", [SpecialPriceController::class, 'update'])->name('specialprice.update');
    Route::delete("/specialprice", [SpecialPriceController::class, 'delete'])->name('specialprice.delete');

    Route::post('/kapal/json-adv', [ShipController::class, 'dataTableAdvJson'])->name('kapal.jsonadv');
    Route::post('/kapal/json', [ShipController::class, 'dataTableJson'])->name('kapal.json');
    Route::get('/kapal/get-next-id', [ShipController::class, 'getNextId'])->name('kapal.getNextId');
    Route::post("/kapal", [ShipController::class, 'store'])->name('kapal.store');
    Route::get("/kapal", [ShipController::class, 'index'])->name('kapal');
    Route::get("/kapal-by-kode", [ShipController::class, 'findByKode'])->name('kapal.findByKode');
    Route::put("/kapal", [ShipController::class, 'update'])->name('kapal.update');
    Route::delete("/kapal", [ShipController::class, 'delete'])->name('kapal.delete');
    Route::get('/kapal/trash', [ShipController::class, 'trash'])->name('kapal.trash');
    Route::post('/kapal/restore', [ShipController::class, 'restore'])->name('kapal.restore');

    //thclolopol
    // Route::post('/thclolopol/json-adv', [ThcLoloPortLoadingController::class, 'dataTableAdvJson'])->name('thclolopol.jsonadv');
    // Route::post('/thclolopol/json', [ThcLoloPortLoadingController::class, 'dataTableJson'])->name('thclolopol.json');
    // Route::get('/thclolopol/get-next-id', [ThcLoloPortLoadingController::class, 'getNextId'])->name('thclolopol.getNextId');
    // Route::post("/thclolopol", [ThcLoloPortLoadingController::class, 'store'])->name('thclolopol.store');
    // Route::get("/thclolopol", [ThcLoloPortLoadingController::class, 'index'])->name('thclolopol');
    // Route::get("/thclolopol-by-kode", [ThcLoloPortLoadingController::class, 'findByKode'])->name('thclolopol.findByKode');
    // Route::put("/thclolopol", [ThcLoloPortLoadingController::class, 'update'])->name('thclolopol.update');
    // Route::delete("/thclolopol", [ThcLoloPortLoadingController::class, 'delete'])->name('thclolopol.delete');
    // Route::get('/thclolopol/trash', [ThcLoloPortLoadingController::class, 'trash'])->name('thclolopol.trash');
    // Route::post('/thclolopol/restore', [ThcLoloPortLoadingController::class, 'restore'])->name('thclolopol.restore');

    //thclolopod
    // Route::post('/thclolopod/json-adv', [ThcLoloPortDischargeController::class, 'dataTableAdvJson'])->name('thclolopod.jsonadv');
    // Route::post('/thclolopod/json', [ThcLoloPortDischargeController::class, 'dataTableJson'])->name('thclolopod.json');
    // Route::get('/thclolopod/get-next-id', [ThcLoloPortDischargeController::class, 'getNextId'])->name('thclolopod.getNextId');
    // Route::post("/thclolopod", [ThcLoloPortDischargeController::class, 'store'])->name('thclolopod.store');
    // Route::get("/thclolopod", [ThcLoloPortDischargeController::class, 'index'])->name('thclolopod');
    // Route::get("/thclolopod-by-kode", [ThcLoloPortDischargeController::class, 'findByKode'])->name('thclolopod.findByKode');
    // Route::put("/thclolopod", [ThcLoloPortDischargeController::class, 'update'])->name('thclolopod.update');
    // Route::delete("/thclolopod", [ThcLoloPortDischargeController::class, 'delete'])->name('thclolopod.delete');
    // Route::get('/thclolopod/trash', [ThcLoloPortDischargeController::class, 'trash'])->name('thclolopod.trash');
    // Route::post('/thclolopod/restore', [ThcLoloPortDischargeController::class, 'restore'])->name('thclolopod.restore');

    //thclolo
    Route::get('/thclolo/master', [ThcLoloController::class, 'indexMaster'])->name('thclolo.master');

    Route::post('/thclolo/json-adv', [ThcLoloController::class, 'dataTableAdvJson'])->name('thclolo.jsonadv');
    Route::post('/thclolo/json', [ThcLoloController::class, 'dataTableJson'])->name('thclolo.json');
    Route::get('/thclolo/get-next-id', [ThcLoloController::class, 'getNextId'])->name('thclolo.getNextId');
    Route::post("/thclolo", [ThcLoloController::class, 'store'])->name('thclolo.store');
    Route::get("/thclolo", [ThcLoloController::class, 'index'])->name('thclolo');
    Route::get("/thclolo-by-kode", [ThcLoloController::class, 'findByKode'])->name('thclolo.findByKode');
    Route::put("/thclolo", [ThcLoloController::class, 'update'])->name('thclolo.update');
    Route::delete("/thclolo", [ThcLoloController::class, 'delete'])->name('thclolo.delete');
    Route::get('/thclolo/trash', [ThcLoloController::class, 'trash'])->name('thclolo.trash');
    Route::post('/thclolo/restore', [ThcLoloController::class, 'restore'])->name('thclolo.restore');

    //gudang
    Route::post('/gudang/json-adv', [WarehouseController::class, 'dataTableAdvJson'])->name('gudang.jsonadv');
    Route::post('/gudang/json', [WarehouseController::class, 'dataTableJson'])->name('gudang.json');
    Route::get('/gudang/get-next-id', [WarehouseController::class, 'getNextId'])->name('gudang.getNextId');
    Route::post("/gudang", [WarehouseController::class, 'store'])->name('gudang.store');
    Route::get("/gudang", [WarehouseController::class, 'index'])->name('gudang');
    Route::get("/gudang-by-kode", [WarehouseController::class, 'findByKode'])->name('gudang.findByKode');
    Route::put("/gudang", [WarehouseController::class, 'update'])->name('gudang.update');
    Route::delete("/gudang", [WarehouseController::class, 'delete'])->name('gudang.delete');
    Route::get('/gudang/trash', [WarehouseController::class, 'trash'])->name('gudang.trash');
    Route::post('/gudang/restore', [WarehouseController::class, 'restore'])->name('gudang.restore');


    //jabatan
    Route::post('/jabatan/json-adv', [PositionController::class, 'dataTableAdvJson'])->name('jabatan.jsonadv');
    Route::post('/jabatan/json', [PositionController::class, 'dataTableJson'])->name('jabatan.json');
    Route::get('/jabatan/get-next-id', [PositionController::class, 'getNextId'])->name('jabatan.getNextId');
    Route::post("/jabatan", [PositionController::class, 'store'])->name('jabatan.store');
    Route::get("/jabatan", [PositionController::class, 'index'])->name('jabatan');
    Route::get("/jabatan-by-kode", [PositionController::class, 'findByKode'])->name('jabatan.findByKode');
    Route::put("/jabatan", [PositionController::class, 'update'])->name('jabatan.update');
    Route::delete("/jabatan", [PositionController::class, 'delete'])->name('jabatan.delete');
    Route::get('/jabatan/trash', [PositionController::class, 'trash'])->name('jabatan.trash');
    Route::post('/jabatan/restore', [PositionController::class, 'restore'])->name('jabatan.restore');

    //karyawan
    Route::post('/karyawan/json-adv', [StaffController::class, 'dataTableAdvJson'])->name('karyawan.jsonadv');
    Route::post('/karyawan/json', [StaffController::class, 'dataTableJson'])->name('karyawan.json');
    Route::get('/karyawan/get-next-id', [StaffController::class, 'getNextId'])->name('karyawan.getNextId');
    Route::post("/karyawan", [StaffController::class, 'store'])->name('karyawan.store');
    Route::get("/karyawan", [StaffController::class, 'index'])->name('karyawan');
    Route::get("/karyawan-by-kode", [StaffController::class, 'findByKode'])->name('karyawan.findByKode');
    Route::put("/karyawan", [StaffController::class, 'update'])->name('karyawan.update');
    Route::delete("/karyawan", [StaffController::class, 'delete'])->name('karyawan.delete');
    Route::get('/karyawan/trash', [StaffController::class, 'trash'])->name('karyawan.trash');
    Route::get("/karyawan/files/{filename}", [StaffController::class, 'getFiles'])->name('karyawan.getFiles');

    Route::post('/karyawan/restore', [StaffController::class, 'restore'])->name('karyawan.restore');

    //user
    Route::post('/user/json-adv', [UserController::class, 'dataTableAdvJson'])->name('user.jsonadv');
    Route::post('/user/json', [UserController::class, 'dataTableJson'])->name('user.json');
    Route::post('/user/change-password', [UserController::class, 'changePassword'])->name('user.changePassword');
    Route::post('/user/reset-password', [UserController::class, 'resetPassword'])->name('user.resetPassword');
    Route::get('/user/get-next-id', [UserController::class, 'getNextId'])->name('user.getNextId');
    Route::post("/user", [UserController::class, 'store'])->name('user.store');
    Route::get("/user", [UserController::class, 'index'])->name('user');
    Route::get("/user-by-kode", [UserController::class, 'findByKode'])->name('user.findByKode');
    Route::put("/user", [UserController::class, 'update'])->name('user.update');
    Route::delete("/user", [UserController::class, 'delete'])->name('user.delete');
    Route::get('/user/trash', [UserController::class, 'trash'])->name('user.trash');
    Route::post('/user/restore', [UserController::class, 'restore'])->name('user.restore');



    // mitra
    Route::get('/changepassword', function () {
        return view('pages.setting.changepassword', ['type_menu' => '', 'type_submenu' => '']);
    })->name('changepassword');


    Route::post('/prajoa/json-adv', [PraJOAController::class, 'dataTableAdvJson'])->name('prajoa.jsonadv');
    Route::post('/prajoa/json', [PraJOAController::class, 'dataTableJson'])->name('prajoa.json');
    Route::get('/prajoa/get-next-id', [PraJOAController::class, 'getNextId'])->name('prajoa.getNextId');
    Route::post("/prajoa", [PraJOAController::class, 'store'])->name('prajoa.store');
    Route::get("/prajoa", [PraJOAController::class, 'index'])->name('prajoa');
    Route::get("/prajoa/master", [PraJOAController::class, 'indexMaster'])->name('prajoa.master');
    Route::get("/prajoa-by-kode", [PraJOAController::class, 'findByKode'])->name('prajoa.findByKode');
    Route::put("/prajoa", [PraJOAController::class, 'update'])->name('prajoa.update');
    Route::delete("/prajoa", [PraJOAController::class, 'delete'])->name('prajoa.delete');
    Route::get('/prajoa/trash', [PraJOAController::class, 'trash'])->name('prajoa.trash');

    Route::post('/prajoa/restore', [PraJOAController::class, 'restore'])->name('prajoa.restore');


    Route::get("/aproval", [ApprovalController::class, 'index'])->name('aproval');
    Route::get("/aproval/approved", [ApprovalController::class, 'approved'])->name('aproval.approved');
    Route::put("/aproval", [ApprovalController::class, 'update'])->name('aproval.update');
    Route::put("/aproval/unapprove", [ApprovalController::class, 'unapprove'])->name('aproval.unapprove');


    Route::get("/acccustomer", [AccCustomerController::class, 'index'])->name('acccustomer');
    Route::get("/acccustomer/approved", [AccCustomerController::class, 'approved'])->name('acccustomer.approved');
    Route::put("/acccustomer", [AccCustomerController::class, 'update'])->name('acccustomer.update');
    Route::put("/acccustomer/unapprove", [AccCustomerController::class, 'unapprove'])->name('acccustomer.unapprove');


    Route::get('/joa/get-next-id', [JOAController::class, 'getNextId'])->name('joa.getNextId');
    Route::get("/joa", [JOAController::class, 'index'])->name('joa');
    Route::get("/joa/master", [JOAController::class, 'indexMaster'])->name('joa.master');
    Route::put("/joa", [JOAController::class, 'update'])->name('joa.update');
    Route::delete("/joa", [JOAController::class, 'delete'])->name('joa.delete');
    Route::get('/joa/trash', [JOAController::class, 'trash'])->name('joa.trash');
    Route::post('/joa/restore', [JOAController::class, 'restore'])->name('joa.restore');
    Route::get("/joa-by-kode", [JOAController::class, 'findByKode'])->name('joa.findByKode');


    Route::get('penawaran/viewInvoice/{KODE}', [OfferController::class, 'viewInvoice'])->name('penawaran.viewInvoice');
    Route::get('penawaran/viewInvoice/{KODE}/generate', [OfferController::class, 'generateInvoice'])->name('penawaran.generateInvoice');
    Route::get('/penawaran/get-next-id', [OfferController::class, 'getNextId'])->name('penawaran.getNextId');
    Route::post("/penawaran", [OfferController::class, 'store'])->name('penawaran.store');
    Route::get("/penawaran", [OfferController::class, 'index'])->name('penawaran');
    Route::get("/penawaran/master", [OfferController::class, 'indexMaster'])->name('penawaran.master');
    Route::get("/penawaran/truckprice", [OfferController::class, 'indexTruckPrice'])->name('penawaran.truckprice');
    Route::get("/penawaran/hargalcl", [OfferController::class, 'indexHargaLCL'])->name('penawaran.hargalcl');
    Route::get("/penawaran-by-kode", [OfferController::class, 'findByKode'])->name('penawaran.findByKode');
    Route::put("/penawaran", [OfferController::class, 'update'])->name('penawaran.update');
    Route::delete("/penawaran", [OfferController::class, 'delete'])->name('penawaran.delete');
    Route::get('/penawaran/trash', [OfferController::class, 'trash'])->name('penawaran.trash');
    Route::post("/penawaran/detail", [OfferController::class, 'getOfferFormComponent'])->name('penawaran.detail');
    Route::post('/penawaran/restore', [OfferController::class, 'restore'])->name('penawaran.restore');
});
