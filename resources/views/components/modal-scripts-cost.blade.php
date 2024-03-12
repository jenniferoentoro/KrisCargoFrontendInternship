<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    // document ready
    $('#addDataButton').on('click', function() {


        @if (!isset($kode_enabled))
            openLoadingModal();

            $.ajax({
                url: "{{ route($next_id_route_name) }}",
                type: "GET",
                success: function(response) {
                    if (response.success) {
                        console.log(response);

                        var nextKode = response.data;
                        var form = $('#addDataModal form')[0];
                        // Iterate over the keys of the response data
                        // set next kode in form
                        $('#addKode').val(nextKode);
                        var modal = $('#addDataModal')[0];
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
        @else
            //just open modal
            var modal = $('#addDataModal')[0];
            modal.style.display = 'block';
            $(modal.querySelector('.modal-content')).addClass('animate__bounceInDown');
        @endif
        $('#addDataModal .dropdownselect2fix').select2({
                searchInputPlaceholder: 'Ketik disini untuk mencari...',
                dropdownParent: $('#addDataModal')
            }

        );

    });


    $('#addDataModal').on('shown.bs.modal', function() {
        // Reinitialize Select2 for the dropdown inside the modal
        $('#addDataModal .dropdownselect2fix').select2();
    });

    $('#editDataModal').on('shown.bs.modal', function() {
        // Reinitialize Select2 for the dropdown inside the modal
        $('#editDataModal .dropdownselect2fix').select2();
    });

    $('#add-data-form').submit(function(event) {
        convertDateToISO();
        // remove all . separator from number input
        $('.number-input').each(function() {
            var value = $(this).val();
            value = value.replace(/\./g, '');
            $(this).val(value);
        });

        $('#saveData').html(
            '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
        );

        // Prevent the default form submission behavior
        event.preventDefault();

        // if there is a field with id PASSWORD and CONFIRM_PASSWORD
        if ($('#add-data-form #PASSWORD').length && $('#add-data-form #CONFIRM_PASSWORD')
            .length) {
            // check if the password and confirm password field match
            if ($('#add-data-form #PASSWORD').val() !== $('#add-data-form #CONFIRM_PASSWORD')
                .val()) {
                //clear alerts
                $('#add-data-form input').removeClass('is-invalid');
                $('#add-data-form .error-message').remove();
                // if not, show error message
                $('#add-data-form #CONFIRM_PASSWORD').addClass('is-invalid');
                $('#add-data-form #CONFIRM_PASSWORD').after(
                    '<div class="error-message invalid-feedback" style="font-size: 100%">Password dan konfirmasi password tidak sama</div>'
                );

                // prevent form submission
                alert('Password dan Konfirmasi Password tidak sama')
                return false;
            }
        }

        // Collect form data using FormData
        var formData = new FormData(this);

        //get the disabled input value too
        // formData.append('KODE', $('#addKode').val());

        // Iterate over file inputs and append them to the FormData object
        $(this).find(':file').each(function() {
            var fieldName = $(this).attr('name');
            var files = $(this)[0].files;

            // Append each file to the FormData object
            for (var i = 0; i < files.length; i++) {
                console.log(files)
                // formData.append(fieldName, files[i]);
            }
        });

        console.log(formData);
        // Send form data asynchronously using AJAX
        $.ajax({
            url: $(this).attr('action'),
            type: $(this).attr('method'),
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                let newData = response.data;
                let message = response.message;
                alert(message);
                $('#add-data-form')[0].reset();
                // Hide modal
                var modal = document.getElementById('addDataModal');
                modal.querySelector('.modal-content').classList.remove(
                    'animate__bounceInDown');
                modal.querySelector('.modal-content').classList.add(
                    'animate__fadeOutUp');
                // Clear form input error
                $('#add-data-form input').removeClass('is-invalid');
                $('#add-data-form .error-message').remove();

                // Clear image preview
                $('#add-data-form .image-preview img').attr('src', '');

                setTimeout(function() {
                    modal.style.display = 'none';
                    modal.querySelector('.modal-content').classList.remove(
                        'animate__fadeOutUp');
                }, 1000);

                let table = $('#clueList').DataTable();
                var editButton =
                    '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
                    newData.KODE +
                    '"><i class="fa-solid fa-pen-to-square"></i></button>';
                var deleteButton =
                    '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
                    newData.KODE + '"><i class="fa-solid fa-trash"></i></button>';

                var newDataValues = [];
                newDataValues.push(editButton + deleteButton);

                // Iterate over the $keys variable to extract the corresponding values from newData object
                @foreach ($keys as $key)
                    @if ($key === 'AKTIF')
                        newDataValues.push((newData['{{ $key }}'] == 0 ?
                            'T' :
                            'Y'));
                    @else
                        if (newData['{{ $key }}'] == null) {
                            newData['{{ $key }}'] = '';
                        }
                        newDataValues.push(newData['{{ $key }}']);
                    @endif
                @endforeach

                var rowNode = table.row.add(newDataValues).draw().node();
                $(rowNode).attr('id', newData.KODE);
                // Give border bottom
                $(rowNode).addClass('border-bottom');
                console.log(response);

                $('#saveData').html('Save');
            },
            error: function(xhr, status, error) {
                // Handle error response
                if (xhr.status === 422) {
                    alert('Some fields are missing or invalid.');
                    var errors = xhr.responseJSON;
                    console.log(errors);
                    // Clear previous error styling
                    $('#add-data-form input').removeClass('is-invalid');
                    $('#add-data-form .error-message').remove();

                    // Iterate over errors and display corresponding messages
                    $.each(errors.message, function(fieldName, fieldErrors) {
                        // Add error class to input
                        console.log(fieldName);
                        console.log(fieldErrors);
                        //apply is invalid only to add-data-form
                        $('#add-data-form [name="' + fieldName + '"]')
                            .addClass(
                                'is-invalid');

                        // Display error message
                        $.each(fieldErrors, function(index, errorMessage) {
                            $('#add-data-form [name="' + fieldName +
                                '"]').after(
                                '<span class="error-message invalid-feedback" style="font-size: 100%">' +
                                errorMessage + '</span>');
                        });
                    });
                }
                @if (isset($continue_submit_route_name))
                    else if (xhr.status === 409 && typeof $keys !== 'undefined') {
                        let err = JSON.parse(xhr.responseText);
                        let confirmContinue = confirm(err.message);
                        if (confirmContinue) {
                            $.ajax({
                                url: "{{ route($continue_submit_route_name) }}",
                                type: 'POST',
                                data: formData,
                                contentType: false,
                                processData: false,
                                success: function(response) {
                                    let newData = response.data;
                                    let message = response.message;
                                    alert(message);
                                    $('#add-data-form')[0].reset();
                                    // Hide modal
                                    var modal = document.getElementById(
                                        'addDataModal');
                                    modal.querySelector(
                                            '.modal-content')
                                        .classList.remove(
                                            'animate__bounceInDown');
                                    modal.querySelector(
                                            '.modal-content')
                                        .classList.add(
                                            'animate__fadeOutUp');
                                    // Clear form input error
                                    $('#add-data-form input')
                                        .removeClass(
                                            'is-invalid');
                                    $('#add-data-form .error-message')
                                        .remove();

                                    setTimeout(function() {
                                        modal.style.display =
                                            'none';
                                        modal.querySelector(
                                                '.modal-content'
                                            )
                                            .classList.remove(
                                                'animate__fadeOutUp'
                                            );
                                    }, 1000);

                                    let table = $('#clueList')
                                        .DataTable();
                                    var editButton =
                                        '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
                                        newData.KODE +
                                        '"><i class="fa-solid fa-pen-to-square"></i></button>';
                                    var deleteButton =
                                        '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
                                        newData.KODE +
                                        '"><i class="fa-solid fa-trash"></i></button>';

                                    var newDataValues = [];
                                    newDataValues.push(editButton +
                                        deleteButton);

                                    // Iterate over the $keys variable to extract the corresponding values from newData object
                                    @foreach ($keys as $key)
                                        @if ($key === 'AKTIF')
                                            newDataValues.push((newData[
                                                    '{{ $key }}'
                                                ] == 0 ? 'T' :
                                                'Y'));
                                        @else
                                            newDataValues.push(newData[
                                                '{{ $key }}'
                                            ]);
                                        @endif
                                    @endforeach

                                    var rowNode = table.row.add(
                                            newDataValues)
                                        .draw().node();
                                    $(rowNode).attr('id', newData.KODE);
                                    // Give border bottom
                                    $(rowNode).addClass(
                                        'border-bottom');
                                    console.log(response);
                                },
                                error: function(xhr, status, error) {
                                    // Handle error response
                                    if (xhr.status === 422) {
                                        alert(
                                            'Some fields are missing or invalid.'
                                        );
                                        var errors = xhr.responseJSON;
                                        console.log(errors);
                                        // Clear previous error styling
                                        $('#add-data-form input')
                                            .removeClass(
                                                'is-invalid');
                                        $('#add-data-form .error-message')
                                            .remove();

                                        // Iterate over errors and display corresponding messages
                                        $.each(errors.message, function(
                                            fieldName,
                                            fieldErrors
                                        ) {
                                            // Add error class to input
                                            console.log(
                                                fieldName);
                                            console.log(
                                                fieldErrors);
                                            $('#add-data-form [name="' +
                                                    fieldName +
                                                    '"]')
                                                .addClass(
                                                    'is-invalid'
                                                );

                                            // Display error message
                                            $.each(fieldErrors,
                                                function(
                                                    index,
                                                    errorMessage
                                                ) {
                                                    $('#add-data-form [name="' +
                                                            fieldName +
                                                            '"]'
                                                        )
                                                        .after(
                                                            '<span class="error-message invalid-feedback" style="font-size: 100%">' +
                                                            errorMessage +
                                                            '</span>'
                                                        );
                                                });
                                        });
                                    } else {
                                        let err = JSON.parse(xhr
                                            .responseText);
                                        alert(err.message);
                                        console.log(xhr.responseText);
                                        // Handle other error cases
                                        console.log(error);
                                    }
                                }
                            });
                        }
                    }
                @endif
                else {
                    let err = JSON.parse(xhr.responseText);
                    alert(err.message);
                    console.log(xhr.responseText);
                    // Handle other error cases
                    console.log(error);
                }
                $('#saveData').html('Save');
            }
        });
    });
</script>
