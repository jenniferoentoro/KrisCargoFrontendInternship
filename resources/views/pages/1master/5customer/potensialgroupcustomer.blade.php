@extends('layouts.app')

@section('title', 'Group Mitra')

@push('style')
    <!-- CSS Libraries -->

    @include('components.dashboard-styles')
@endpush

@section('main')
    <div class="main-content">
        <br />
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <h1 style="text-align: center;">Group Mitra</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('customer-group') }}</div>

                </div>
            </div>
            <div>
                <div>
                    <div class="row">
                        <div class="col-4">
                            <div id="addDataButtonContainer">
                                <button id="addDataButton" class="btn btn-primary mb-3">+ Add data</button>
                            </div>
                        </div>
                        <div class="col-4">
                        </div>
                        <div class="col-4" align="right">
                            <div id="AdvanceMode">
                                <button id="" class="trashbin btn btn-danger mb-3">Trash Bin</button>
                                <button id="advance" class="btn btn-primary mb-3">Advanced</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            @include('components.data-table', [
                'columns' => $table_headers,
                'keys' => $keys,
            ])



            <br><br>


        </div>
    </div>
    @include('components.modal-trashbin')

    @include('components.modal-input', [
        'input_fields' => [
            'Customer Group' => [
                ['text', 'Nama', [], 'NAMA', 'required'],
                [
                    'dropdown',
                    'Badan Hukum',
                    ['PT' => 'PT', 'CV' => 'CV', 'UD' => 'UD', 'LL' => 'LL'],
                    'BADAN_HUKUM',
                    'required',
                ],
    
                ['text', 'Alamat', [], 'ALAMAT', 'required'],
                ['dropdown', 'Nama Kota', $array_cities_dropdown, 'KODE_KOTA', 'required'],
    
                ['text', 'Telepon', [], 'TELP', 'required'],
                ['text', 'HP', [], 'HP', 'required'],
                ['text', 'Website', [], 'WEBSITE', 'required'],
                ['text', 'Email', [], 'EMAIL', 'required'],
                ['text', 'Fax', [], 'FAX', 'required'],
            ],
            'Contact Person' => [
                ['text', 'Nama Contact Person', [], 'CONTACT_PERSON', 'required'],
                ['text', 'No HP CP', [], 'NO_HP_CP', 'required'],
                ['text', 'No WA CP', [], 'NO_SMS_CP', 'required'],
                ['text', 'Email CP', [], 'EMAIL1', 'required'],
                ['dropdown', 'Aktif', $array_active_dropdown, 'AKTIF', 'required'],
                ['text', 'Keterangan', [], 'KETERANGAN', 'required'],
            ],
        ],
        'submit_route_name' => 'customer-group.store',
    ])


    @include('components.modal-edit', [
        'input_fields' => [
            'Customer Group' => [
                ['text', 'Nama', [], 'NAMA', 'required'],
                [
                    'dropdown',
                    'Badan Hukum',
                    ['PT' => 'PT', 'CV' => 'CV', 'UD' => 'UD', 'LL' => 'LL'],
                    'BADAN_HUKUM',
                    'required',
                ],
    
                ['text', 'Alamat', [], 'ALAMAT', 'required'],
                ['dropdown', 'Nama Kota', $array_cities_dropdown, 'KODE_KOTA', 'required'],
    
                ['text', 'Telepon', [], 'TELP', 'required'],
                ['text', 'HP', [], 'HP', 'required'],
                ['text', 'Website', [], 'WEBSITE', 'required'],
                ['text', 'Email', [], 'EMAIL', 'required'],
                ['text', 'Fax', [], 'FAX', 'required'],
            ],
            'Contact Person' => [
                ['text', 'Nama Contact Person', [], 'CONTACT_PERSON', 'required'],
                ['text', 'No HP CP', [], 'NO_HP_CP', 'required'],
                ['text', 'No WA CP', [], 'NO_SMS_CP', 'required'],
                ['text', 'Email CP', [], 'EMAIL1', 'required'],
                ['dropdown', 'Aktif', $array_active_dropdown, 'AKTIF', 'required'],
                ['text', 'Keterangan', [], 'KETERANGAN', 'required'],
            ],
        ],
        'submit_route_name' => 'customer-group.update',
    ])


@endsection


@push('scripts')
    {{-- @include('components.data-table-scripts') --}}
    @include('components.data-table-ajax-scripts', [
        'keys' => $keys,
        'data_route_name' => 'customer-group.json',
        'data_adv_route_name' => 'customer-group.jsonadv',
    ])
    @include('components.data-table-advance-script')
    @include('components.modal-scripts', [
        'open_modal_edit_route_name' => 'customer-group.findByKode',
        'delete_route_name' => 'customer-group.delete',
        'next_id_route_name' => 'customer-group.getNextId',
        'continue_submit_route_name' => null,
        'continue_edit_submit_route_name' => null,
        'restore_route_name' => 'customer-group.restore',
        'trash_route_name' => 'customer-group.trash',
        'columns' => $table_headers,
        'keys' => $keys,
    ])
    <script>
        var itemId = 0;
        var deletedItemIds = [];

        // $('#clueList tbody').on('click', 'button.btn-edit', function() {
        //     var id = $(this).attr('id').split("-");
        //     itemId = id[1];



        //     $.ajax({
        //         url: "{{ route('customer-group.findByKode') }}",
        //         data: {
        //             KODE: itemId
        //         },
        //         type: "GET",
        //         success(response) {
        //             if (response.success) {
        //                 console.log(response);
        //                 var modal = document.getElementById('editDataModal');
        //                 var form = document.querySelector('#editDataModal form');

        //                 modal.style.display = 'block';
        //                 modal.querySelector('.modal-content').classList.add('animate__bounceInDown');

        //                 // Iterate over the keys of the response data
        //                 Object.keys(response.data).forEach(function(key) {
        //                     // Check if the form field with matching name exists
        //                     if (form.elements[key]) {
        //                         // Update the value of the form field
        //                         form.elements[key].value = response.data[key];
        //                     }
        //                 });
        //             } else {
        //                 alert(response.message)
        //             }

        //         },
        //         error(error) {
        //             console.log(error);
        //         }
        //     });

        // });
        // $('#saveData').on('click', function(e) {

        //     var form = document.querySelector('#addDataModal form');
        //     var data = Object.fromEntries(new FormData(form).entries());
        //     console.log(data);


        //     var requestData = {
        //         _token: '{{ csrf_token() }}',
        //         data: data
        //     };

        //     for (var key in data) {
        //         if (data.hasOwnProperty(key)) {
        //             requestData[key] = data[key];
        //         }
        //     }

        //     $.ajax({
        //         url: "{{ route('customer-group.store') }}",
        //         method: 'POST',
        //         data: requestData,
        //         success: function(response) {
        //             console.log(response.data.ALAMAT);

        //             if (response.success) {
        //                 // Handle success response
        //                 var newData = response.data;
        //                 var modal = document.getElementById('addDataModal');
        //                 modal.querySelector('.modal-content').classList.remove('animate__bounceInDown');
        //                 modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
        //                 setTimeout(function() {
        //                     modal.style.display = 'none';
        //                     modal.querySelector('.modal-content').classList.remove(
        //                         'animate__fadeOutUp');
        //                 }, 1000);



        //                 var table = $('#clueList').DataTable();
        //                 var editButton = '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
        //                     newData.KODE + '"><i class="fa-solid fa-pen-to-square"></i></button>';
        //                 var deleteButton =
        //                     '<button class="btn btn-danger btn-sm btn-delete" id="delete-' + newData
        //                     .KODE + '"><i class="fa-solid fa-trash"></i></button>';

        //                 table.row.add([
        //                     editButton + deleteButton,
        //                     newData.KODE,
        //                     newData.NAMA,
        //                     newData.BADAN_HUKUM,
        //                     newData.ALAMAT,
        //                     newData.NAMA_KOTA,
        //                     newData.NAMA_PROVINSI,
        //                     newData.NAMA_NEGARA,
        //                     newData.TELP,

        //                     newData.HP,
        //                     newData.EMAIL,
        //                     newData.FAX,
        //                     newData.CONTACT_PERSON,
        //                     newData.NO_HP_CP,
        //                     newData.NO_SMS_CP,
        //                     newData.AKTIF,
        //                     newData.KETERANGAN,
        //                     newData.WEBSITE,
        //                     newData.EMAIL1
        //                     // Add more columns as needed
        //                 ]).draw();



        //                 // how to add new row to table with data from response.data
        //                 // table.row.add([
        //                 //     '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
        //                 //     itemId +
        //                 //     '"><i class="fa-solid fa-pen-to-square"></i></button>' +
        //                 //     '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
        //                 //     itemId +
        //                 //     '"><i class="fa-solid fa-trash"></i></button>',
        //                 //     itemId,
        //                 //     data.NAMA,
        //                 //     selectedOptionBadanHukum,
        //                 //     data.ALAMAT,
        //                 //     selectedOptionKota,
        //                 //     selectedOptionProvinsi,
        //                 //     selectedOptionNegara,
        //                 //     data.TELP,
        //                 //     data.HP,
        //                 //     data.WEBSITE,
        //                 //     data.EMAIL,
        //                 //     data.FAX,
        //                 //     data.CONTACT_PERSON,
        //                 //     data.NO_HP_CP,
        //                 //     data.NO_SMS_CP,
        //                 //     data.EMAIL1,
        //                 //     selectedOptionAktif,
        //                 //     data.KETERANGAN,
        //                 // ]).draw(false);


        //                 // table.rows().every(function() {
        //                 //     var rowData = this.data();
        //                 //     if (rowData[1] == itemId) {
        //                 //         rowData[0] =
        //                 //             '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
        //                 //             itemId +
        //                 //             '"><i class="fa-solid fa-pen-to-square"></i></button>' +
        //                 //             '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
        //                 //             itemId +
        //                 //             '"><i class="fa-solid fa-trash"></i></button>';

        //                 //         console.log(data)
        //                 //         rowData[2] = data.NAMA;
        //                 //         rowData[3] = selectedOptionBadanHukum;
        //                 //         rowData[4] = data.ALAMAT;
        //                 //         rowData[5] = selectedOptionKota;
        //                 //         rowData[6] = selectedOptionProvinsi;
        //                 //         rowData[7] = selectedOptionNegara;
        //                 //         rowData[8] = data.TELP;
        //                 //         rowData[9] = data.HP;
        //                 //         rowData[10] = data.EMAIL;
        //                 //         rowData[11] = data.FAX;
        //                 //         rowData[12] = data.CONTACT_PERSON;
        //                 //         rowData[13] = data.NO_HP_CP;
        //                 //         rowData[14] = data.NO_SMS_CP;
        //                 //         rowData[15] = selectedOptionAktif;
        //                 //         rowData[16] = data.KETERANGAN;
        //                 //         rowData[17] = data.WEBSITE;
        //                 //         rowData[18] = data.EMAIL1;


        //                 //         this.data(rowData).draw;
        //                 //         return false; // Exit the loop
        //                 //     }
        //                 // });
        //             } else {
        //                 alert(response.message);
        //                 console.log(response.message);
        //             }

        //         },
        //         error: function(xhr, status, error) {
        //             console.error(error);
        //             console.log(xhr.responseText);

        //         }
        //     });


        // });

        // $('#editData').on('click', function(e) {
        //     console.log(itemId);

        //     e.preventDefault();
        //     var form = document.querySelector('#editDataModal form');
        //     var data = Object.fromEntries(new FormData(form).entries());
        //     console.log(data);

        //     //get select element (dropdown) to update data tables without refresh
        //     var selectElementBadanHukum = form.querySelector('select[name="BADAN_HUKUM"]');
        //     var optionsBadanHukum = selectElementBadanHukum.options;
        //     var selectedOptionBadanHukum = optionsBadanHukum[optionsBadanHukum.selectedIndex].text;

        //     var selectElementKota = form.querySelector('select[name="KODE_KOTA"]');
        //     var optionsKota = selectElementKota.options;
        //     var selectedOptionKota = optionsKota[optionsKota.selectedIndex].text;

        //     var selectElementProvinsi = form.querySelector('select[name="KODE_PROVINSI"]');
        //     var optionsProvinsi = selectElementProvinsi.options;
        //     var selectedOptionProvinsi = optionsProvinsi[optionsProvinsi.selectedIndex].text;

        //     var selectElementNegara = form.querySelector('select[name="KODE_NEGARA"]');
        //     var optionsNegara = selectElementNegara.options;
        //     var selectedOptionNegara = optionsNegara[optionsNegara.selectedIndex].text;

        //     var selectElementAktif = form.querySelector('select[name="AKTIF"]');
        //     var optionsAktif = selectElementAktif.options;
        //     var selectedOptionAktif = optionsAktif[optionsAktif.selectedIndex].text;


        //     var requestData = {
        //         _token: '{{ csrf_token() }}',
        //         KODE: itemId
        //     };

        //     // Iterate over the keys in the data object
        //     for (var key in data) {
        //         if (data.hasOwnProperty(key)) {
        //             requestData[key] = data[key];
        //         }
        //     }

        //     $.ajax({
        //         url: "{{ route('customer-group.update') }}",
        //         method: 'PUT',
        //         data: requestData,
        //         success: function(response) {
        //             if (response.success) {
        //                 // Handle success response
        //                 console.log(response);
        //                 var modal = document.getElementById('editDataModal');
        //                 modal.querySelector('.modal-content').classList.remove('animate__bounceInDown');
        //                 modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
        //                 setTimeout(function() {
        //                     modal.style.display = 'none';
        //                     modal.querySelector('.modal-content').classList.remove(
        //                         'animate__fadeOutUp');
        //                 }, 1000);

        //                 // how to set the data to the table with the new value
        //                 console.log(itemId);
        //                 var table = $('#clueList').DataTable();
        //                 table.rows().every(function() {
        //                     var rowData = this.data();
        //                     if (rowData[1] == itemId) {
        //                         rowData[0] =
        //                             '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
        //                             itemId +
        //                             '"><i class="fa-solid fa-pen-to-square"></i></button>' +
        //                             '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
        //                             itemId +
        //                             '"><i class="fa-solid fa-trash"></i></button>';

        //                         console.log(data)
        //                         rowData[2] = data.NAMA;
        //                         rowData[3] = selectedOptionBadanHukum;
        //                         rowData[4] = data.ALAMAT;
        //                         rowData[5] = selectedOptionKota;
        //                         rowData[6] = selectedOptionProvinsi;
        //                         rowData[7] = selectedOptionNegara;
        //                         rowData[8] = data.TELP;
        //                         rowData[9] = data.HP;
        //                         rowData[10] = data.EMAIL;
        //                         rowData[11] = data.FAX;
        //                         rowData[12] = data.CONTACT_PERSON;
        //                         rowData[13] = data.NO_HP_CP;
        //                         rowData[14] = data.NO_SMS_CP;
        //                         rowData[15] = selectedOptionAktif;
        //                         rowData[16] = data.KETERANGAN;
        //                         rowData[17] = data.WEBSITE;
        //                         rowData[18] = data.EMAIL1;


        //                         this.data(rowData).draw;
        //                         return false; // Exit the loop
        //                     }
        //                 });
        //             } else {
        //                 alert(response.message)
        //             }

        //         },
        //         error: function(xhr, status, error) {
        //             console.error(error);
        //         }
        //     });
        // });


        // $('#clueList tbody').on('click', 'button.btn-delete', function() {
        //     var id = $(this).attr('id').split("-");
        //     var itemId = id[1];
        //     console.log(itemId);

        //     var confirmation = confirm("Are you sure you want to delete this item?");
        //     if (confirmation) {
        //         $.ajax({
        //             url: "{{ route('customer-group.delete') }}",
        //             method: 'DELETE',
        //             data: {
        //                 _token: '{{ csrf_token() }}',
        //                 KODE: itemId,
        //             },
        //             success: function(response) {
        //                 if (response.success) {
        //                     // Handle success response
        //                     console.log(response);
        //                     $('#clueList').DataTable().row($('#clueList tbody').find(
        //                             'button.btn-delete[id$="-' + itemId + '"]').closest('tr')).remove()
        //                         .draw();

        //                     deletedItemIds.push(itemId);
        //                 } else {
        //                     alert(response.message)
        //                 }


        //             },
        //             error: function(xhr, status, error) {
        //                 console.error(error);
        //             }
        //         });

        //     }
        // });
    </script>


    <!-- Page Specific JS File -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>


    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
