<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('home'));
});

// joa
Breadcrumbs::for('dash-joa', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('JOA', route('dash-joa'));
});

Breadcrumbs::for('prajoa', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-joa');
    $trail->push('Pra JOA', route('prajoa'));
});
Breadcrumbs::for('aproval', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-joa');
    $trail->push('Aproval', route('aproval'));
});

Breadcrumbs::for('penawaran', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-joa');
    $trail->push('Penawaran', route('penawaran'));
});
Breadcrumbs::for('acccustomer', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-joa');
    $trail->push('Acc Customer', route('acccustomer'));
});
Breadcrumbs::for('joa', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-joa');
    $trail->push('JOA', route('joa'));
});




// Home > Blog
Breadcrumbs::for('master', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Master', route('master'));
});

Breadcrumbs::for('transaksi', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Transaksi', route('transaksi'));
});

// 0.Negara
Breadcrumbs::for('negara', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Negara', route('negara'));
});
// 1.Provinsi
Breadcrumbs::for('provinsi', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Provinsi', route('provinsi'));
});

// 2.Provinsi
Breadcrumbs::for('kota', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Kota', route('kota'));
});
// 3.Gudang
Breadcrumbs::for('gudang', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Lokasi', route('gudang'));
});

Breadcrumbs::for('pelabuhan', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Pelabuhan', route('pelabuhan'));
});
// 4.Truck
Breadcrumbs::for('dash-truck', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Truck', route('dash-truck'));
});

Breadcrumbs::for('truck', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-truck');
    $trail->push('Jenis Truck', route('dash-truck'));
});
Breadcrumbs::for('rutetruck', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-truck');
    $trail->push('Rute Truck', route('rutetruck'));
});


Breadcrumbs::for('truckprice', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-truck');
    $trail->push('Tarif Truck', route('truckprice'));
});

// Breadcrumbs::for('rutepengiriman', function (BreadcrumbTrail $trail) {
//     $trail->parent('dash-truck');
//     $trail->push('Rute Pengiriman', route('rutepengiriman'));
// });
Breadcrumbs::for('dash-customer', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Customer', route('dash-customer'));
});

Breadcrumbs::for('jenisusaha', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-customer');
    $trail->push('Jenis Usaha', route('jenisusaha'));
});
Breadcrumbs::for('customer', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-customer');
    $trail->push('Customer', route('customer'));
});
Breadcrumbs::for('customer-group', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-customer');
    $trail->push('Group Mitra', route('customer-group'));
});

Breadcrumbs::for('dash-vendor', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Vendor', route('dash-vendor'));
});
Breadcrumbs::for('jenisvendor', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-vendor');
    $trail->push('Jenis Vendor', route('jenisvendor'));
});

Breadcrumbs::for('vendor', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-vendor');
    $trail->push('Vendor', route('vendor'));
});
Breadcrumbs::for('kapal', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Kapal', route('kapal'));
});
Breadcrumbs::for('jeniskiriman', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Jenis Kiriman', route('jeniskiriman'));
});
Breadcrumbs::for('lcl', function (BreadcrumbTrail $trail) {
    $trail->parent('jeniskiriman');
    $trail->push('LCL', route('lcl'));
});
Breadcrumbs::for('ukuran', function (BreadcrumbTrail $trail) {
    $trail->parent('jeniskiriman');
    $trail->push('Size Container', route('ukuran'));
});
Breadcrumbs::for('jenisorder', function (BreadcrumbTrail $trail) {
    $trail->parent('jeniskiriman');
    $trail->push('Jenis Order', route('jenisorder'));
});
Breadcrumbs::for('jeniskontainer', function (BreadcrumbTrail $trail) {
    $trail->parent('jeniskiriman');
    $trail->push('Jenis Container', route('jeniskontainer'));
});
Breadcrumbs::for('commodity', function (BreadcrumbTrail $trail) {
    $trail->parent('jeniskiriman');
    $trail->push('Commodity', route('commodity'));
});
Breadcrumbs::for('service', function (BreadcrumbTrail $trail) {
    $trail->parent('jeniskiriman');
    $trail->push('Service', route('service'));
});
Breadcrumbs::for('fcl', function (BreadcrumbTrail $trail) {
    $trail->parent('jeniskiriman');
    $trail->push('FCL', route('fcl'));
});
Breadcrumbs::for('hargalcl', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('HPP', route('hargalcl'));
});

Breadcrumbs::for('dash-karyawan', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Karyawan', route('dash-karyawan'));
});

Breadcrumbs::for('jabatan', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-karyawan');
    $trail->push('Jabatan', route('jabatan'));
});

Breadcrumbs::for('karyawan', function (BreadcrumbTrail $trail) {
    $trail->parent('dash-karyawan');
    $trail->push('Karyawan', route('karyawan'));
});

Breadcrumbs::for('costgroup', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalcl');
    $trail->push('Kelompok Biaya', route('costgroup'));
});
Breadcrumbs::for('cost', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalcl');
    $trail->push('Nama Biaya', route('cost'));
});
Breadcrumbs::for('costrate', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalcl');
    $trail->push('HPP Biaya', route('costrate'));
});
Breadcrumbs::for('hpptruck', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalcl');
    $trail->push('HPP Truk', route('hpptruck'));
});
Breadcrumbs::for('costtype', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalcl');
    $trail->push('Jenis Biaya', route('costtype'));
});

Breadcrumbs::for('thclolopol', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalcl');
    $trail->push('THC LOLO POL', route('thclolopol'));
});
Breadcrumbs::for('thclolopod', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalcl');
    $trail->push('THC LOLO POD', route('thclolopod'));
});
Breadcrumbs::for('thclolo', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalcl');
    $trail->push('THC LOLO', route('thclolo'));
});

// Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('master');
//     $trail->push($category->title, route('category', $category));
// });



//
Breadcrumbs::for('hargalclfix', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Harga LCL', route('hargalclfix'));
});
Breadcrumbs::for('formula', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalclfix');
    $trail->push('Formula', route('formula'));
});
Breadcrumbs::for('category', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalclfix');
    $trail->push('Kategori', route('category'));
});
Breadcrumbs::for('product', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalclfix');
    $trail->push('Produk', route('product'));
});
Breadcrumbs::for('unit', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalclfix');
    $trail->push('Satuan', route('unit'));
});
Breadcrumbs::for('generalprice', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalclfix');
    $trail->push('Umum', route('generalprice'));
});
Breadcrumbs::for('specialprice', function (BreadcrumbTrail $trail) {
    $trail->parent('hargalclfix');
    $trail->push('Harga LCL', route('specialprice'));
});

Breadcrumbs::for('useracc', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Management User', route('useracc'));
});

Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
    $trail->parent('useracc');
    $trail->push('User', route('user'));
});


// management web
Breadcrumbs::for('managementweb', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Management Web', route('managementweb'));
});

Breadcrumbs::for('slide', function (BreadcrumbTrail $trail) {
    $trail->parent('managementweb');
    $trail->push('Slide', route('slide'));
});
Breadcrumbs::for('profile', function (BreadcrumbTrail $trail) {
    $trail->parent('managementweb');
    $trail->push('Profile', route('profile'));
});
Breadcrumbs::for('berita', function (BreadcrumbTrail $trail) {
    $trail->parent('managementweb');
    $trail->push('Berita', route('berita'));
});
Breadcrumbs::for('promosi', function (BreadcrumbTrail $trail) {
    $trail->parent('managementweb');
    $trail->push('Promosi', route('promosi'));
});


// management user
Breadcrumbs::for('managementuser', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Management User', route('managementuser'));
});
Breadcrumbs::for('group', function (BreadcrumbTrail $trail) {
    $trail->parent('managementuser');
    $trail->push('Group', route('group'));
});
// Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
//     $trail->parent('managementuser');
//     $trail->push('User', route('user'));
// });
Breadcrumbs::for('password', function (BreadcrumbTrail $trail) {
    $trail->parent('managementuser');
    $trail->push('Password', route('password'));
});
Breadcrumbs::for('setting', function (BreadcrumbTrail $trail) {
    $trail->parent('managementuser');
    $trail->push('Setting', route('setting'));
});

// mitra
Breadcrumbs::for('mitra', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Mitra', route('mitra'));
});
Breadcrumbs::for('mitraisi', function (BreadcrumbTrail $trail) {
    $trail->parent('mitra');
    $trail->push('Mitra', route('mitraisi'));
});




Breadcrumbs::for('pelayaran', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Pelayaran', route('pelayaran'));
});






Breadcrumbs::for('accounting', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Accounting', route('accounting'));
});
Breadcrumbs::for('posaccount', function (BreadcrumbTrail $trail) {
    $trail->parent('accounting');
    $trail->push('Post Account', route('posaccount'));
});
Breadcrumbs::for('exhibit', function (BreadcrumbTrail $trail) {
    $trail->parent('accounting');
    $trail->push('Exhibit', route('exhibit'));
});
Breadcrumbs::for('settingaccount', function (BreadcrumbTrail $trail) {
    $trail->parent('accounting');
    $trail->push('Setting Account', route('settingaccount'));
});

// Breadcrumbs::for('product', function (BreadcrumbTrail $trail) {
//     $trail->parent('master');
//     $trail->push('Product', route('product'));
// });
// Breadcrumbs::for('kategori', function (BreadcrumbTrail $trail) {
//     $trail->parent('product');
//     $trail->push('Kategori', route('kategori'));
// });
// Breadcrumbs::for('hargacurah', function (BreadcrumbTrail $trail) {
//     $trail->parent('product');
//     $trail->push('Harga Curah', route('hargacurah'));
// });
// Breadcrumbs::for('hargapercustomer', function (BreadcrumbTrail $trail) {
//     $trail->parent('product');
//     $trail->push('Harga Per Customer', route('hargapercustomer'));
// });
// Breadcrumbs::for('hargafull', function (BreadcrumbTrail $trail) {
//     $trail->parent('product');
//     $trail->push('Harga Full', route('hargafull'));
// });
// Breadcrumbs::for('jenisbarang', function (BreadcrumbTrail $trail) {
//     $trail->parent('product');
//     $trail->push('Jenis Barang', route('jenisbarang'));
// });
// Breadcrumbs::for('jeniscontainer', function (BreadcrumbTrail $trail) {
//     $trail->parent('product');
//     $trail->push('Jenis Container', route('jeniscontainer'));
// });


Breadcrumbs::for('fixasset', function (BreadcrumbTrail $trail) {
    $trail->parent('master');
    $trail->push('Fix Asset', route('fixasset'));
});
// Breadcrumbs::for('hpp', function (BreadcrumbTrail $trail) {
//     $trail->parent('master');
//     $trail->push('H P P', route('hpp'));
// });
Breadcrumbs::for('container', function (BreadcrumbTrail $trail) {
    $trail->parent('hpp');
    $trail->push('Container', route('container'));
});

// Breadcrumbs::for('truck', function (BreadcrumbTrail $trail) {
//     $trail->parent('hpp');
//     $trail->push('Truck', route('truck'));
// });


Breadcrumbs::for('barcode', function (BreadcrumbTrail $trail) {
    $trail->parent('transaksi');
    $trail->push('Barcode', route('barcode'));
});

Breadcrumbs::for('jadwalkapal', function (BreadcrumbTrail $trail) {
    $trail->parent('transaksi');
    $trail->push('Jadwal Kapal', route('jadwalkapal'));
});
