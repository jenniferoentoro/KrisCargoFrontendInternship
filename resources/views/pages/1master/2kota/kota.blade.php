@extends('layouts.app')

@section('title', 'Kota')

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
                    <h1 style="text-align: center;">Kota</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('kota') }}</div>

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
            'Kota' => [
                ['text', 'Nama', [], 'NAMA', 'required'],
                ['dropdown', 'Nama Provinsi', $array_provinces_dropdown, 'KODE_PROVINSI', 'required'],
            ],
        ],
        'submit_route_name' => 'kota.store',
    ])
    @include('components.modal-edit', [
        'input_fields' => [
            'Kota' => [
                ['text', 'Nama', [], 'NAMA', 'required'],
                ['dropdown', 'Nama Provinsi', $array_provinces_dropdown, 'KODE_PROVINSI', 'required'],
            ],
        ],
        'submit_route_name' => 'kota.update',
    ])


@endsection


@push('scripts')
    {{-- @include('components.data-table-scripts') --}}
    @include('components.data-table-ajax-scripts', [
        'keys' => $keys,
        'data_route_name' => 'kota.json',
        'data_adv_route_name' => 'kota.jsonadv',
    ])

    @include('components.data-table-advance-script')
    @include('components.modal-scripts', [
        'open_modal_edit_route_name' => 'kota.findByKode',
        'delete_route_name' => 'kota.delete',
        'next_id_route_name' => 'kota.getNextId',
        'continue_submit_route_name' => null,
        'continue_edit_submit_route_name' => null,
        'restore_route_name' => 'kota.restore',
        'trash_route_name' => 'kota.trash',
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
        //         url: "{{ route('kota.findByKode') }}",
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

        // $('#editData').on('click', function(e) {
        //     console.log(itemId);

        //     e.preventDefault();
        //     var form = document.querySelector('#editDataModal form');
        //     var data = Object.fromEntries(new FormData(form).entries());
        //     console.log(data);
        //     //get select element (dropdown) to update data tables without refresh
        //     var selectElement = form.querySelector('select[name="KODE_PROVINSI"]');
        //     var options = selectElement.options;
        //     var selectedOption = options[options.selectedIndex].text;

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
        //         url: "{{ route('kota.update') }}",
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
        //                         rowData[2] = selectedOption;
        //                         rowData[3] = data.NAMA;
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
        //             url: "{{ route('kota.delete') }}",
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
