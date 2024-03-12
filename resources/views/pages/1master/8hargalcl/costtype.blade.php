@extends('layouts.app')

@section('title', 'Jenis Biaya')

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
                    <h1 style="text-align: center;">Jenis Biaya</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('costtype') }}</div>
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
    @include('components.modal-input', [
        'input_fields' => [
            'Jenis Biaya' => [['text', 'Nama', [], 'NAMA', 'required']],
        ],
        'submit_route_name' => 'costtype.store',
    ])


    @include('components.modal-trashbin')





    @include('components.modal-edit', [
        'input_fields' => [
            'Jenis Biaya' => [['text', 'Nama', [], 'NAMA', 'required']],
        ],
        'submit_route_name' => 'costtype.update',
    ])

@endsection

@push('scripts')
    {{-- @include('components.data-table-scripts') --}}
    @include('components.data-table-ajax-scripts', [
        'keys' => $keys,
        'data_route_name' => 'costtype.json',
        'data_adv_route_name' => 'costtype.jsonadv',
    ])
    @include('components.data-table-advance-script')
    @include('components.modal-scripts', [
        'open_modal_edit_route_name' => 'costtype.findByKode',
        'delete_route_name' => 'costtype.delete',
        'next_id_route_name' => 'costtype.getNextId',
        'continue_submit_route_name' => null,
        'continue_edit_submit_route_name' => null,
        'restore_route_name' => 'costtype.restore',
        'trash_route_name' => 'costtype.trash',
        'columns' => $table_headers,
        'keys' => $keys,
    ])
    <script>
        var itemId = 0;
        var deletedItemIds = [];


        // trashbin clicked




        // $('#clueList tbody').on('click', 'button.btn-edit', function() {
        //     var id = $(this).attr('id').split("-");
        //     itemId = id[1];



        //     $.ajax({
        //         url: "{{ route('negara.findByKode') }}",
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
        //                 alert(response.message);
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
        //         url: "{{ route('negara.update') }}",
        //         method: 'PUT',
        //         data: requestData,
        //         success: function(response) {
        //             // Handle success response
        //             console.log(response);
        //             if (response.success) {


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
        //                         rowData[2] = data.NAMA;
        //                         this.data(rowData).draw;
        //                         return false; // Exit the loop
        //                     }
        //                 });
        //             } else {
        //                 alert(response.message);
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
        //             url: "{{ route('negara.delete') }}",
        //             method: 'DELETE',
        //             data: {
        //                 _token: '{{ csrf_token() }}',
        //                 KODE: itemId,
        //             },
        //             success: function(response) {
        //                 // Handle success response
        //                 if (response.success) {
        //                     console.log(response);
        //                     $('#clueList').DataTable().row($('#clueList tbody').find(
        //                             'button.btn-delete[id$="-' + itemId + '"]').closest('tr')).remove()
        //                         .draw();

        //                     deletedItemIds.push(itemId);
        //                 } else {
        //                     alert(response.message);
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
