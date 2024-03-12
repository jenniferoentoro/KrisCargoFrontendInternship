@extends('layouts.app')

@section('title', 'Approval')

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
                    <h1 style="text-align: center;">Approval</h1>
                    <div style="margin-top: 15px;">{{ Breadcrumbs::render('aproval') }}</div>
                </div>
            </div>
            <div>
                <div>
                    <div class="row">
                        <div class="col-4">
                            {{-- <div id="addDataButtonContainer">
                                <button id="addDataButton" class="btn btn-primary mb-3">+ Add data</button>
                            </div> --}}
                        </div>
                        <div class="col-4">
                        </div>
                        <div class="col-4" align="right">
                            <div id="AdvanceMode">
                                <button id="lol" class="trashbin btn btn-success mb-3">Approved</button>
                                <button id="advance" class="btn btn-primary mb-3">Advanced</button>
                            </div>
                        </div>
                    </div>

                </div>

            </div>


            @include('components.approval-data-table', [
                'columns' => $table_headers,
                'keys' => $keys,
            ])



            <br><br>


        </div>
    </div>


    @include('components.modal-data-table')

    @include('components.modal-trashbin')



@endsection

@push('scripts')
    @include('components.data-table-scripts')
    @include('components.data-table-advance-script')
    @include('components.modal-data-table-scripts')
    @include('components.approval-front-form-scripts', [
        'open_modal_edit_route_name' => 'prajoa.findByKode',
        'delete_route_name' => 'aproval.update',
        'next_id_route_name' => 'prajoa.getNextId',
        'continue_submit_route_name' => null,
        'continue_edit_submit_route_name' => null,
        'restore_route_name' => 'aproval.unapprove',
        'trash_route_name' => 'aproval.approved',
        'columns' => $table_headers,
        'keys' => $keys,
        'array_costrate_dropdown' => $array_costrate_dropdown,
    ])


    <!-- Page Specific JS File -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <script src="{{ asset('js/page/index-0.js') }}"></script>
    <script>
        $('.thclolopod').on('shown.bs.modal', function() {
            // Reinitialize Select2 for the dropdown inside the modal
            $('.thclolopod .dropdownselect2fix').select2();
        });
        $('.thclolopol').on('shown.bs.modal', function() {
            // Reinitialize Select2 for the dropdown inside the modal
            $('.thclolopol .dropdownselect2fix').select2();
        });

        $('.addValueTHCPOD').on('click', function() {


            // ajax to get next kode

            openLoadingModal();

            $.ajax({
                url: "{{ route('thclolo.getNextId') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log(response);

                        var nextKode = response.data;
                        var form = $('.addnewValueModal form')[0];
                        // Iterate over the keys of the response data
                        // set next kode in form
                        $('.addKodeValuethclolopod').val(nextKode);
                        var modal = $('.thclolopod')[0];
                        modal.style.display = 'block';
                        $(modal.querySelector('.modal-content')).addClass(
                            'animate__bounceInDown');

                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                },
                complete: function() {
                    closeLoadingModal();



                }
            });

            $('.thclolopod .dropdownselect2fix').select2({
                    searchInputPlaceholder: 'Ketik disini untuk mencari...',
                    dropdownParent: $('.thclolopod')
                }

            );

        });

        $('.addValueTHCPOL').on('click', function() {


            // ajax to get next kode

            openLoadingModal();

            $.ajax({
                url: "{{ route('thclolo') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log(response);

                        var nextKode = response.data;
                        var form = $('.addnewValueModal form')[0];
                        // Iterate over the keys of the response data
                        // set next kode in form
                        $('.addKodeValuethclolopol').val(nextKode);
                        var modal = $('.thclolopol')[0];
                        modal.style.display = 'block';
                        $(modal.querySelector('.modal-content')).addClass(
                            'animate__bounceInDown');

                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                },
                complete: function() {
                    closeLoadingModal();



                }
            });

            $('.thclolopol .dropdownselect2fix').select2({
                    searchInputPlaceholder: 'Ketik disini untuk mencari...',
                    dropdownParent: $('.thclolopol')
                }

            );

        });

        $('.addValueCostRate').on('click', function() {

            // ajax to get next kode

            openLoadingModal();

            $.ajax({
                url: "{{ route('costrate.getNextId') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log("sss")
                        console.log(response);

                        var nextKode = response.data;
                        var form = $('.addnewValueModal form')[0];
                        // Iterate over the keys of the response data
                        // set next kode in form
                        $('.addKodeValuecostrate').val(nextKode);
                        var modal = $('.costrate')[0];
                        modal.style.display = 'block';
                        $(modal.querySelector('.modal-content')).addClass(
                            'animate__bounceInDown');

                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                },
                complete: function() {
                    closeLoadingModal();



                }
            });

            $('.costrate .dropdownselect2fix').select2({
                    searchInputPlaceholder: 'Ketik disini untuk mencari...',
                    dropdownParent: $('.costrate')
                }

            );

        });


        $('.addValueTruckRoute').on('click', function() {

            // ajax to get next kode

            openLoadingModal();

            $.ajax({
                url: "{{ route('rutetruck.getNextId') }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log(response);

                        var nextKode = response.data;
                        var form = $('.addnewValueModal form')[0];
                        // Iterate over the keys of the response data
                        // set next kode in form
                        $('.addKodeValuerutetruck').val(nextKode);
                        var modal = $('.rutetruck')[0];
                        modal.style.display = 'block';
                        $(modal.querySelector('.modal-content')).addClass(
                            'animate__bounceInDown');

                    } else {
                        alert(response.message);
                    }
                },
                error: function(error) {
                    console.log(error);
                },
                complete: function() {
                    closeLoadingModal();



                }
            });

            $('.rutetruck .dropdownselect2fix').select2({
                    searchInputPlaceholder: 'Ketik disini untuk mencari...',
                    dropdownParent: $('.rutetruck')
                }

            );

        });

        // document.ready


        $('.closethclolopol').on('click', function() {

            var modal = $('.thclolopol')[0];
            modal.querySelector('.modal-content').classList.remove(
                'animate__bounceInDown');
            modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
            setTimeout(function() {
                modal.style.display = 'none';
                modal.querySelector('.modal-content').classList.remove(
                    'animate__fadeOutUp');
            }, 1000);
        });

        $('.closethclolopod').on('click', function() {

            var modal = $('.thclolopod')[0];
            modal.querySelector('.modal-content').classList.remove(
                'animate__bounceInDown');
            modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
            setTimeout(function() {
                modal.style.display = 'none';
                modal.querySelector('.modal-content').classList.remove(
                    'animate__fadeOutUp');
            }, 1000);
        });

        $('.closerutetruck').on('click', function() {

            var modal = $('.rutetruck')[0];
            modal.querySelector('.modal-content').classList.remove(
                'animate__bounceInDown');
            modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
            setTimeout(function() {
                modal.style.display = 'none';
                modal.querySelector('.modal-content').classList.remove(
                    'animate__fadeOutUp');
            }, 1000);
        });

        $('.closecostrate').on('click', function() {

            var modal = $('.costrate')[0];
            modal.querySelector('.modal-content').classList.remove(
                'animate__bounceInDown');
            modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
            setTimeout(function() {
                modal.style.display = 'none';
                modal.querySelector('.modal-content').classList.remove(
                    'animate__fadeOutUp');
            }, 1000);
        });

        $('#resetthclolopol').click(function() {
            // Store the value of KODE field
            var kodeValue = $('.addKodeValuethclolopol').val();

            // Reset the form (this will clear all inputs)
            $('.addDatathclolopol')[0].reset();

            $('.addDatathclolopol input').removeClass('is-invalid');
            $('.addDatathclolopol .error-message').remove();

            // Set the value of KODE field back to its original value
            $('.addKodeValuethclolopol').val(kodeValue);

            // clear image preview
            $('.addDatathclolopol .image-preview img').attr('src', '');
            $('.addDatathclolopol .link-preview a').attr('href', '');
            $('.addDatathclolopol .link-preview a').text('');

            $('.thclolopol .dropdownselect2fix').select2({
                searchInputPlaceholder: 'Ketik disini untuk mencari...',
                dropdownParent: $('.thclolopol')
            });

        });

        $('#resetthclolopod').click(function() {
            // Store the value of KODE field
            var kodeValue = $('.addKodeValuethclolopod').val();

            // Reset the form (this will clear all inputs)
            $('.addDatathclolopod')[0].reset();

            $('.addDatathclolopod input').removeClass('is-invalid');
            $('.addDatathclolopod .error-message').remove();

            // Set the value of KODE field back to its original value
            $('.addKodeValuethclolopod').val(kodeValue);

            // clear image preview
            $('.addDatathclolopod .image-preview img').attr('src', '');
            $('.addDatathclolopod .link-preview a').attr('href', '');
            $('.addDatathclolopod .link-preview a').text('');

            $('.thclolopod .dropdownselect2fix').select2({
                searchInputPlaceholder: 'Ketik disini untuk mencari...',
                dropdownParent: $('.thclolopod')
            });

        });

        $('#resetcostrate').click(function() {
            // Store the value of KODE field
            var kodeValue = $('.addKodeValuecostrate').val();

            // Reset the form (this will clear all inputs)
            $('.addDatacostrate')[0].reset();

            $('.addDatacostrate input').removeClass('is-invalid');
            $('.addDatacostrate .error-message').remove();

            // Set the value of KODE field back to its original value
            $('.addKodeValuecostrate').val(kodeValue);

            // clear image preview
            $('.addDatacostrate .image-preview img').attr('src', '');
            $('.addDatacostrate .link-preview a').attr('href', '');
            $('.addDatacostrate .link-preview a').text('');

            $('.costrate .dropdownselect2fix').select2({
                searchInputPlaceholder: 'Ketik disini untuk mencari...',
                dropdownParent: $('.costrate')
            });


        });

        $('#resetrutetruck').click(function() {
            // Store the value of KODE field
            var kodeValue = $('.addKodeValuerutetruck').val();

            // Reset the form (this will clear all inputs)
            $('.addDatarutetruck')[0].reset();

            $('.addDatarutetruck input').removeClass('is-invalid');
            $('.addDatarutetruck .error-message').remove();

            // Set the value of KODE field back to its original value
            $('.addKodeValuerutetruck').val(kodeValue);

            // clear image preview
            $('.addDatarutetruck .image-preview img').attr('src', '');
            $('.addDatarutetruck .link-preview a').attr('href', '');
            $('.addDatarutetruck .link-preview a').text('');
            $('.rutetruck .dropdownselect2fix').select2({
                searchInputPlaceholder: 'Ketik disini untuk mencari...',
                dropdownParent: $('.rutetruck')
            });

        });
    </script>
@endpush
