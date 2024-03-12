@extends('layouts.app')

@section('title', 'Home')

@push('style')
    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('library/jqvmap/dist/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('library/summernote/dist/summernote-bs4.min.css') }}">
@endpush

@section('main')

    <div class="main-content">
        <br />
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 style="text-align: center;">Change Password</h1>

                </div>
            </div>
            <div class="row">

                <div class="col-md-6 offset-md-3">
                    {{-- <form > --}}
                    <form id="change-password-form" action="{{ route('user.changePassword') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <br>
                            <label for="OLD_PASSWORD" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="OLD_PASSWORD" name="OLD_PASSWORD" required>
                        </div>
                        <div class="mb-3">
                            <label for="NEW_PASSWORD" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="NEW_PASSWORD" name="NEW_PASSWORD" required>
                        </div>
                        <div class="mb-3">
                            <label for="CONFIRM_PASSWORD" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="CONFIRM_PASSWORD" name="CONFIRM_PASSWORD"
                                required>
                        </div>
                        <div align="center">
                            <button type="submit" class="btn btn-primary" id="change-password-button">Change
                                Password</button>
                        </div>

                    </form>
                </div>



            </div>
        </div>
    </div>




@endsection



@push('scripts')
    <!-- JS Libraies -->
    <script src="{{ asset('library/simpleweather/jquery.simpleWeather.min.js') }}"></script>
    <script src="{{ asset('library/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/jquery.vmap.min.js') }}"></script>
    <script src="{{ asset('library/jqvmap/dist/maps/jquery.vmap.world.js') }}"></script>
    <script src="{{ asset('library/summernote/dist/summernote-bs4.min.js') }}"></script>
    <script src="{{ asset('library/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>

    <!-- Page Specific JS File -->
    <script src="{{ asset('js/page/index-0.js') }}"></script>
@endpush
@section('script')
    <script src="{{ asset('assets/js/login.js') }}"></script>

    <script>
        //when submitted
        $('#change-password-form').submit(function(e) {
            //check if password and confirm password is same
            if ($('#change-password-form #NEW_PASSWORD').val() !== $('#change-password-form #CONFIRM_PASSWORD')
                .val()) {
                //clear alerts
                $('#change-password-form input').removeClass('is-invalid');
                $('#change-password-form .error-message').remove();
                // if not, show error message
                $('#change-password-form #CONFIRM_PASSWORD').addClass('is-invalid');
                $('#change-password-form #CONFIRM_PASSWORD').after(
                    '<div class="error-message invalid-feedback" style="font-size: 100%">Password dan konfirmasi password tidak sama</div>'
                );

                // prevent form submission
                alert('Password dan Konfirmasi Password tidak sama')
                return false;
            }
            e.preventDefault();
            //get form
            var form = $('#change-password-form')[0];
            //create form data
            var formData = new FormData(form);
            //get url
            var url = $('#change-password-form').attr('action');
            //ajax
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    //if success
                    if (data.success) {
                        alert(data.message);

                    }
                    //reset form
                    $('#change-password-form')[0].reset();
                    //clear alerts
                    $('#change-password-form input').removeClass('is-invalid');
                    $('#change-password-form .error-message').remove();


                },
                error: function(xhr, status, error) {
                    if (xhr.status === 422) {
                        alert('Some fields are missing or invalid.');
                        var errors = xhr.responseJSON;
                        console.log(errors);
                        // Clear previous error styling
                        $('#change-password-form input').removeClass('is-invalid');
                        $('#change-password-form .error-message').remove();

                        // Iterate over errors and display corresponding messages
                        $.each(errors.message, function(fieldName, fieldErrors) {
                            // Add error class to input
                            console.log(fieldName);
                            console.log(fieldErrors);
                            //apply is invalid only to change-password-form
                            $('#change-password-form [name="' + fieldName + '"]').addClass(
                                'is-invalid');

                            // Display error message
                            $.each(fieldErrors, function(index, errorMessage) {
                                $('#change-password-form [name="' + fieldName +
                                    '"]').after(
                                    '<span class="error-message invalid-feedback" style="font-size: 100%">' +
                                    errorMessage + '</span>');
                            });
                        });
                    }
                }
            });
        });
    </script>
    {{-- toastr notification if there is error --}}
    {{-- @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif --}}
@endsection
