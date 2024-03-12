<div class="main-sidebar sidebar-style-2" style="overflow: scroll !important;">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('home') }}"><img style="height: 32px;" src="{{ URL('images/logo3.png') }}" alt="My image"></a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('home') }}"><img style="height: 32px;" src="{{ URL('images/logo.png') }}"
                    alt="My image"></a>
        </div>

        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>

            <li class="nav-item {{ $type_menu === 'dashboard' ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="nav-link"><i class="fas fa-desktop"></i><span>Dashboard</span></a>

            </li>

            <li class="menu-header">Master</li>
            <li class="sidee nav-item dropdown {{ $type_menu === 'layout-master' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-home"></i><span>Master</span></a>
                <ul class="dropdown-menu">
                    <li class="dropdown-submenu {{ $type_submenu === 'layout-useracc' ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#rute-collapse2" role="button" data-toggle="collapse"
                            aria-expanded="false" aria-controls="rute-collapse2">
                            <i class="fas fa-user"></i><span>Management User</span>

                        </a>
                        <ul class="dropdown-menu collapse" id="rute-collapse2">
                            <li class="{{ Request::is('user') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('user') }}">User Account</a>
                            </li>
                        </ul>
                    </li>
                    <li class="dropdown-submenu {{ $type_submenu === 'layout-karyawan' ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#rute-collapse1" role="button" data-toggle="collapse"
                            aria-expanded="false" aria-controls="rute-collapse1">
                            <i class="fas fa-user"></i><span>Karyawan</span>

                        </a>
                        <ul class="dropdown-menu collapse" id="rute-collapse1">
                            <li class="{{ Request::is('jabatan') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('jabatan') }}">Jabatan</a>
                            </li>


                            <li class="{{ Request::is('karyawan') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('karyawan') }}">Karyawan</a>
                            </li>



                        </ul>
                    </li>
                    <li class="{{ Request::is('negara') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('negara') }}"><i class="fas fa-globe"></i>
                            <span>Negara</span></a>
                    </li>
                    <li class="{{ Request::is('provinsi') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('provinsi') }}"><i class="fas fa-map-location-dot"></i>
                            <span>Provinsi</span></a>
                    </li>
                    <li class="{{ Request::is('kota') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('kota') }}"><i class="fas fa-building"></i>
                            <span>Kota</span></a>
                    </li>
                    <li class="{{ Request::is('gudang') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('gudang') }}"><i class="fas fa-warehouse"></i>
                            <span>Lokasi</span></a>
                    </li>
                    <li class="{{ Request::is('pelabuhan') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('pelabuhan') }}"><i class="fas fa-anchor"></i>
                            <span>Pelabuhan</span></a>
                    </li>

                    <li class="{{ Request::is('kapal') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('kapal') }}"><i class="fas fa-ship"></i>
                            <span>Kapal</span></a>
                    </li>

                    <li class="dropdown-submenu {{ $type_submenu === 'layout-truck' ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#rute-collapse" role="button" data-toggle="collapse"
                            aria-expanded="false" aria-controls="rute-collapse">
                            <i class="fas fa-truck"></i><span>Truck</span>

                        </a>
                        <ul class="dropdown-menu collapse" id="rute-collapse">
                            <li class="{{ Request::is('truck') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('truck') }}">Jenis Truck</a>
                            </li>


                            <li class="{{ Request::is('rutetruck') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('rutetruck') }}">Rute Truck</a>
                            </li>

                            <li class="{{ Request::is('truckprice') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('truckprice') }}">Tarif Truck</a>
                            </li>

                        </ul>
                    </li>

                    <li class="dropdown-submenu {{ $type_submenu === 'layout-customer' ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#customer-collapse" role="button"
                            data-toggle="collapse" aria-expanded="false" aria-controls="customer-collapse">
                            <i class="fas fa-people-roof"></i><span>Customer</span>
                        </a>
                        <ul class="dropdown-menu collapse" id="customer-collapse">
                            <li class="{{ Request::is('jenisusaha') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('jenisusaha') }}">Jenis Usaha</a>
                            </li>
                            <li class="{{ Request::is('customer-group') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('customer-group') }}">Group Mitra</a>
                            </li>
                            <li class="{{ Request::is('customer') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('customer') }}">Customer</a>
                            </li>

                        </ul>
                    </li>
                    <li class="dropdown-submenu {{ $type_submenu === 'layout-vendor' ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#managementcustomer-collapse" role="button"
                            data-toggle="collapse" aria-expanded="false" aria-controls="managementcustomer-collapse">
                            <i class="fas fa-user-plus"></i><span>Vendor</span>
                        </a>
                        <ul class="dropdown-menu collapse" id="managementcustomer-collapse">
                            <li class="{{ Request::is('jenisvendor') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('jenisvendor') }}">Jenis Vendor</a>
                            </li>
                            <li class="{{ Request::is('vendorsup') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('vendorsup') }}">Vendor</a>
                            </li>
                            {{-- <li class="{{ Request::is('kapal') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('kapal') }}">Kapal</a>
                            </li> --}}
                        </ul>
                    </li>
                    <li
                        class="dropdown-submenu {{ $type_submenu === 'layout-jeniskiriman' ? 'active' : '' }} {{ $type_submenu === 'layout-jeniskiriman' ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#jeniskiriman-collapse" role="button"
                            data-toggle="collapse" aria-expanded="false" aria-controls="jeniskiriman-collapse">
                            <i class="fas fa-toolbox"></i><span>Jenis Kiriman</span>
                        </a>
                        <ul class="dropdown-menu collapse" id="jeniskiriman-collapse">
                            <li class="{{ Request::is('ukuran') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('ukuran') }}">Size Container</a>
                            </li>
                            <li class="{{ Request::is('jeniskontainer') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('jeniskontainer') }}">Jenis Container</a>
                            </li>
                            <li class="{{ Request::is('commodity') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('commodity') }}">Commodity</a>
                            </li>
                            <li class="{{ Request::is('jenisorder') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('jenisorder') }}">Jenis Order</a>
                            </li>
                            <li class="{{ Request::is('service') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('service') }}">Service</a>
                            </li>

                        </ul>
                    </li>
                    <li
                        class="dropdown-submenu {{ $type_submenu === 'layout-hargalcl' ? 'active' : '' }} {{ $type_submenu === 'layout-hargalcl' ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#hargalcl-collapse" role="button"
                            data-toggle="collapse" aria-expanded="false" aria-controls="hargalcl-collapse">
                            <i class="fas fa-money-bill"></i><span>HPP</span>
                        </a>
                        <ul class="dropdown-menu collapse" id="hargalcl-collapse">
                            <li class="{{ Request::is('costgroup') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('costgroup') }}">Kelompok Biaya</a>
                            </li>
                            <li class="{{ Request::is('costtype') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('costtype') }}">Jenis Biaya</a>
                            </li>
                            <li class="{{ Request::is('cost') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('cost') }}">Nama Biaya</a>
                            </li>
                            <li class="{{ Request::is('hpptruck') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('hpptruck') }}">HPP Truk</a>
                            </li>

                            <li class="{{ Request::is('costrate') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('costrate') }}">HPP Biaya</a>
                            </li>
                            {{-- <li class="{{ Request::is('thclolopol') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('thclolopol') }}">THC LOLO POL</a>
                            </li>
                            <li class="{{ Request::is('thclolopod') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('thclolopod') }}">THC LOLO POD</a>
                            </li> --}}
                            <li class="{{ Request::is('thclolo') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('thclolo') }}">THC LOLO</a>
                            </li>

                        </ul>
                    </li>


                    <li
                        class="dropdown-submenu {{ $type_submenu === 'layout-hargalclfix' ? 'active' : '' }} {{ $type_submenu === 'layout-hargalclfix' ? 'active' : '' }}">
                        <a class="nav-link dropdown-toggle" href="#hargalclfix-collapse" role="button"
                            data-toggle="collapse" aria-expanded="false" aria-controls="hargalclfix-collapse">
                            <i class="fas fa-money-bill"></i><span>Harga LCL</span>
                        </a>
                        <ul class="dropdown-menu collapse" id="hargalclfix-collapse">
                            <li class="{{ Request::is('formula') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('formula') }}">Rumus</a>
                            </li>
                            <li class="{{ Request::is('category') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('category') }}">Kategori</a>
                            </li>
                            <li class="{{ Request::is('unit') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('unit') }}">Satuan</a>
                            </li>
                            <li class="{{ Request::is('product') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('product') }}">Produk</a>
                            </li>
                            <li class="{{ Request::is('specialprice') ? 'active' : '' }}">
                                <a class="nav-link" href="{{ url('specialprice') }}">Harga LCL</a>
                            </li>



                        </ul>
                    </li>


                    <li class="{{ Request::is('accounting') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('accounting') }}"><i class="fas fa-book-bookmark"></i>
                            <span>Accounting</span></a>
                    </li>














                </ul>
            </li>

            <li class="menu-header">JOA</li>

            <li class="sidee nav-item dropdown {{ $type_menu === 'layout-joa' ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-tags"></i><span>JOA</span></a>
                <ul class="dropdown-menu">
                    <li class="{{ Request::is('prajoa') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('prajoa') }}"><i class="fas fa-money-check-dollar"></i>
                            <span>Pra JOA</span></a>
                    </li>
                    <li class="{{ Request::is('aproval') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('aproval') }}"><i class="fas fa-file"></i>
                            <span>Approval</span></a>
                    </li>

                    <li class="{{ Request::is('penawaran') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('penawaran') }}"><i class="fas fa-rectangle-list"></i>
                            <span>Penawaran</span></a>
                    </li>

                    <li class="{{ Request::is('acccustomer') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('acccustomer') }}"><i class="fas fa-clipboard-check"></i>
                            <span>Acc Customer</span></a>
                    </li>
                    <li class="{{ Request::is('joa') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ url('joa') }}"><i class="fas fa-money-check-dollar"></i>
                            <span>JOA</span></a>
                    </li>




                </ul>
            </li>



            <li class="menu-header">Transaksi</li>





        </ul>


    </aside>
</div>
