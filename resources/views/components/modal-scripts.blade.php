<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    function createAdditionalInputs() {
        // Create the elements for Nominal Biaya Lain input field
        var nominalLabel = document.createElement("label");
        nominalLabel.setAttribute("for", "nominal_biaya_lain");
        nominalLabel.className = "form-label";
        nominalLabel.innerHTML = "<b>Nominal Biaya Lain</b>";

        var nominalInput = document.createElement("input");
        nominalInput.setAttribute("type", "text");
        nominalInput.className = "form-control";
        nominalInput.name = "NOMINAL_BIAYA_LAIN[]";
        nominalInput.placeholder = "Input Nominal Biaya Lain...";

        // Create the elements for Keterangan Biaya Lain input field
        var keteranganLabel = document.createElement("label");
        keteranganLabel.setAttribute("for", "keterangan_biaya_lain");
        keteranganLabel.className = "form-label";
        keteranganLabel.innerHTML = "<b>Keterangan Biaya Lain</b>";

        var keteranganInput = document.createElement("input");
        keteranganInput.setAttribute("type", "text");
        keteranganInput.className = "form-control";
        keteranganInput.name = "KETERANGAN_BIAYA_LAIN";
        keteranganInput.placeholder = "Input Keterangan Biaya Lain...";

        // Create a div to wrap both input fields
        var additionalInputDiv = document.createElement("div");
        additionalInputDiv.className = "biayaLain-input";
        additionalInputDiv.style.display = "none"; // Initially hide the div

        // Append the input fields to the div
        additionalInputDiv.appendChild(nominalLabel);
        additionalInputDiv.appendChild(nominalInput);
        additionalInputDiv.appendChild(keteranganLabel);
        additionalInputDiv.appendChild(keteranganInput);

        return additionalInputDiv;
    }

    // Add an event listener for the biayaLain button
    // document.getElementById("biayaLain").addEventListener("click", function () {
    //     // Create the additional input fields
    //     var additionalInputs = createAdditionalInputs();

    //     // Append the new inputs to the container
    //     document.getElementById("additionalInputsContainer").appendChild(additionalInputs);

    //     // Show the additional inputs
    //     additionalInputs.style.display = "block";
    // });

    function formatNumberInput(input) {
        var value = input.value;
        value = value.replace(/\D/g, ""); // Remove non-numeric characters
        value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."); // Add dot every three digits
        input.value = value;
        // var hiddenInput = document.getElementById(input.id + "_hidden");
        // hiddenInput.value = value.replace(/\./g, ""); // Set value without dots in hidden input
    }




    function showAdditionalInput() {
        $('.additionalInputForm').each(function() {
            var dropdown = $(this);
            var additionalInput = dropdown.closest('.mb-3').find('.additional-input');
            var inputFor = dropdown.data('input-for');
            var selectedValue = dropdown.val();
            if (selectedValue == inputFor) {
                additionalInput.show();
            } else {
                additionalInput.hide();
            }
        });
    }




    function convertDateToISO(form) {
        var dateInputs = form.find(".datepicker-input");

        // Loop through all date input fields
        dateInputs.each(function() {
            // Get the selected date from the input
            var selectedDate = $(this).val();

            // Check if the date is empty or invalid
            if (selectedDate) {
                var dateParts = selectedDate.split('-');
                var day = parseInt(dateParts[0]) + 1;
                var month = parseInt(dateParts[1]);
                var year = parseInt(dateParts[2]);

                // Create a new Date object with the parsed values in yyyy-mm-dd format
                var parsedDate = new Date(year, month - 1, day);

                // Get the date in yyyy-mm-dd format
                var formattedDate = parsedDate.toISOString().slice(0, 10);

                // Set the formatted date back to the input's value using jQuery
                $(this).val(formattedDate);
            }
        });
    }

    // Attach an event listener to the dropdown to call the function whenever the selection changes
    $('.additionalInputForm').on('change', showAdditionalInput);



    //

    // Call the function initially to set the initial state of the additional inputs
    showAdditionalInput();


    var loadingModal = document.getElementById('loadingModal');

    function openLoadingModal() {
        loadingModal.style.display = 'block';

    }

    function closeLoadingModal() {
        loadingModal.style.display = 'none';
    }



    (function($) {

        var Defaults = $.fn.select2.amd.require('select2/defaults');

        $.extend(Defaults.defaults, {
            searchInputPlaceholder: ''
        });

        var SearchDropdown = $.fn.select2.amd.require('select2/dropdown/search');

        var _renderSearchDropdown = SearchDropdown.prototype.render;

        SearchDropdown.prototype.render = function(decorated) {

            // invoke parent method
            var $rendered = _renderSearchDropdown.apply(this, Array.prototype.slice.apply(arguments));

            this.$search.attr('placeholder', this.options.get('searchInputPlaceholder'));

            return $rendered;
        };

    })(window.jQuery);
    $(document).ready(function() {
        var editDataId;
        var tableTrash;
        $('#addDataButton').on('click', function() {

            // convertDateToDDMMYY();
            // ajax to get next kode
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
            // get this form
            var form = $(this);
            convertDateToISO(form);
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

                    $('#clueList').DataTable().ajax.reload();


                    // let table = $('#clueList').DataTable();
                    // var editButton =
                    //     '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
                    //     newData.KODE +
                    //     '"><i class="fa-solid fa-pen-to-square"></i></button>';
                    // var deleteButton =
                    //     '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
                    //     newData.KODE + '"><i class="fa-solid fa-trash"></i></button>';

                    // var newDataValues = [];
                    // newDataValues.push(editButton + deleteButton);

                    // // Iterate over the $keys variable to extract the corresponding values from newData object
                    // @foreach ($keys as $key)
                    //     @if ($key === 'AKTIF')
                    //         newDataValues.push((newData['{{ $key }}'] == 0 ?
                    //             'T' :
                    //             'Y'));
                    //     @else
                    //         if (newData['{{ $key }}'] == null) {
                    //             newData['{{ $key }}'] = '';
                    //         }
                    //         newDataValues.push(newData['{{ $key }}']);
                    //     @endif
                    // @endforeach

                    // var rowNode = table.row.add(newDataValues).draw().node();
                    // $(rowNode).attr('id', newData.KODE);
                    // // Give border bottom
                    // $(rowNode).addClass('border-bottom');
                    // console.log(response);

                    $('#saveData').html('Save<i class="pl-1 fa-solid fa-plus"></i>');
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
                    $('#saveData').html('Save<i class="pl-1 fa-solid fa-plus"></i>');
                }
            });
        });


        $('#clueList tbody').on('click', 'button.btn-edit', function() {
            openLoadingModal();
            var id = $(this).attr('id');
            //substring edit-
            var itemId = id.substring(5);
            editDataId = itemId;
            resetPasswordId = itemId;


            $.ajax({
                url: "{{ route($open_modal_edit_route_name) }}",
                data: {
                    KODE: itemId
                },
                type: "GET",
                success(response) {
                    if (response.success) {
                        console.log(response);

                        var modal = document.getElementById('editDataModal');
                        var form = document.querySelector('#editDataModal form');

                        //reset form
                        form.reset();
                        // remove previous error message
                        $('#edit-data-form input').removeClass('is-invalid');
                        $('#edit-data-form .error-message').remove();

                        modal.style.display = 'block';
                        modal.querySelector('.modal-content').classList.add(
                            'animate__bounceInDown');

                        // Iterate over the keys of the response data
                        Object.keys(response.data).forEach(function(key) {
                            // Check if the form field with matching name exists

                            if (form.elements[key]) {
                                if (form.elements[key].type === 'file') {

                                    let cur_data = response.data[key];
                                    if (cur_data) {
                                        let fileType = cur_data.split('.').pop()
                                            .toLowerCase();

                                        let imagePreviewId = "image-preview-" + key;
                                        let linkPreviewId = "link-preview-" + key;

                                        let imageElement = $(
                                            "#edit-data-form img[id='" +
                                            imagePreviewId +
                                            "']");

                                        let aHrefElement = $(
                                            "#edit-data-form a[id='" +
                                            linkPreviewId +
                                            "']");


                                        if (fileType == 'doc' || fileType ==
                                            'docx' ||
                                            fileType == 'pdf') {
                                            @if (isset($files_route_name))
                                                let fileUrl =
                                                    "{{ route($files_route_name, ['filename' => ':cur_data']) }}";
                                                fileUrl = fileUrl.replace(
                                                    ':cur_data',
                                                    cur_data);

                                                aHrefElement.attr('href', fileUrl);
                                                aHrefElement.text(cur_data);

                                                // Set the src attribute of the image element
                                                imageElement.attr('src',
                                                    "{{ asset('images/file_logo.jpg') }}"
                                                );
                                            @endif


                                        } else {
                                            // Attempt to set the src attribute
                                            @if (isset($files_route_name))
                                                let imageUrl =
                                                    "{{ route($files_route_name, ['filename' => ':cur_data']) }}";
                                                imageUrl = imageUrl.replace(
                                                    ':cur_data',
                                                    cur_data);

                                                //set href attribute
                                                aHrefElement.attr('href', imageUrl);
                                                aHrefElement.text(cur_data);

                                                // Set the src attribute of the image element
                                                imageElement.attr('src', imageUrl);
                                            @endif
                                        }
                                    }




                                } else {
                                    if (typeof response.data[key] === 'boolean') {
                                        // Convert boolean value to 1 or 0
                                        form.elements[key].value = response.data[key] ?
                                            '1' : '0';
                                    } else {
                                        form.elements[key].value = response.data[key];
                                    }

                                }



                            }
                        });




                    } else {
                        alert(response.message)
                    }

                    $('#editDataModal .dropdownselect2fix').select2({
                        searchInputPlaceholder: 'Ketik disini untuk mencari...',
                        dropdownParent: $('#editDataModal')
                    });


                },
                error(error) {
                    console.log(error);
                },
                complete: () => {
                    closeLoadingModal();
                }
            });


        })

        $('#edit-data-form').submit(function(event) {
            //get this form
            var form = $(this);
            convertDateToISO(form);

            // remove all . separator from number input
            $('.number-input').each(function() {
                var value = $(this).val();
                value = value.replace(/\./g, '');
                $(this).val(value);
            });
            // alert('submitting edit data');

            $('#editData').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
            );

            // Prevent the default form submission behavior
            event.preventDefault();
            var formData = new FormData(this);

            //get the KODE from the form
            var KODE = editDataId;
            let escapedKODE = KODE.replace(/\./g, "\\.");



            @if (!isset($kode_enabled))
                let kodeKey = 'KODE';
            @else
                let kodeKey = 'KODE_OLD';
            @endif
            var kodeField = {
                name: kodeKey,
                value: KODE
            };
            formData.append(kodeField.name, kodeField.value);


            // Collect form data

            // console log files

            // Append the KODE field to the FormData object
            // var formData = $.param(formData);
            //console log all form data inpuuts


            // Send form data asynchronously using AJAX
            $.ajax({
                url: $(this).attr('action'),
                type: $(this).attr('method'),
                data: formData,
                contentType: false,
                processData: false,
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('X-CSRF-TOKEN', $('meta[name="csrf-token"]')
                        .attr(
                            'content'));
                    xhr.setRequestHeader('X-HTTP-Method-Override', 'PUT');
                },
                success: function(response) {
                    let newData = response.data
                    console.log(newData)
                    let message = response.message
                    alert(message)
                    $('#edit-data-form')[0].reset();
                    //hide modal
                    var modal = document.getElementById('editDataModal');
                    modal.querySelector('.modal-content').classList.remove(
                        'animate__bounceInDown');
                    modal.querySelector('.modal-content').classList.add(
                        'animate__fadeOutUp');
                    //clear form input error
                    $('#edit-data-form input').removeClass('is-invalid');
                    $('#edit-data-form .error-message').remove();
                    $('#edit-data-form .image-preview img').attr('src', '');
                    $('#edit-data-form .link-preview a').attr('href', '');
                    $('#edit-data-form .link-preview a').text('');

                    setTimeout(function() {
                        modal.style.display = 'none';
                        modal.querySelector('.modal-content').classList
                            .remove(
                                'animate__fadeOutUp');
                    }, 1000);

                    let table = $('#clueList').DataTable();
                    table.ajax.reload();
                    // var editButton =
                    //     '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
                    //     newData.KODE +
                    //     '"><i class="fa-solid fa-pen-to-square"></i></button>';
                    // var deleteButton =
                    //     '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
                    //     newData.KODE +
                    //     '"><i class="fa-solid fa-trash"></i></button>';

                    // Get an array of property values from newData object
                    // var newDataValues = Object.values(newData);

                    // // Add edit and delete buttons to the beginning of the array
                    // newDataValues.unshift(editButton + deleteButton);

                    // console.log(newDataValues)

                    // table.row('#' + newData.KODE).data(newDataValues).draw();
                    // console.log(response);

                    // var newDataValues = [];

                    // // Iterate over the $keys variable to extract the corresponding values from newData object
                    // @foreach ($keys as $key)
                    //     @if ($key === 'AKTIF')
                    //         newDataValues.push((newData['{{ $key }}'] == 0 ?
                    //             'T' :
                    //             'Y'));
                    //     @else
                    //         if (newData['{{ $key }}'] == null) {
                    //             newData['{{ $key }}'] = '';
                    //         }
                    //         newDataValues.push(newData['{{ $key }}']);
                    //     @endif
                    // @endforeach

                    // // Add edit and delete buttons to the beginning of the array
                    // newDataValues.unshift(editButton + deleteButton);

                    // console.log(newDataValues);

                    // table.row('#' + escapedKODE).data(newDataValues).draw();
                    // //edit the row id
                    // table.row('#' + escapedKODE).node().id = newData.KODE;

                    $('#editData').html('Save<i class="pl-1 fa-solid fa-pencil"></i>');
                },
                error: function(xhr, status, error) {

                    if (xhr.status === 422) {
                        alert('Some fields are missing or invalid.');
                        var errors = xhr.responseJSON;
                        console.log(errors)
                        // Clear previous error styling
                        $('#edit-data-form input').removeClass('is-invalid');
                        $('#edit-data-form .error-message').remove();

                        // Iterate over errors and display corresponding messages
                        $.each(errors.message, function(fieldName,
                            fieldErrors) {
                            // Add error class to input
                            console.log(fieldName)
                            console.log(fieldErrors)
                            $('#edit-data-form [name="' + fieldName + '"]')
                                .addClass(
                                    'is-invalid');

                            // Display error message
                            $.each(fieldErrors, function(index,
                                errorMessage) {
                                $('#edit-data-form [name="' +
                                        fieldName +
                                        '"]')
                                    .after(
                                        '<span class="error-message invalid-feedback" style="font-size: 100%">' +
                                        errorMessage + '</span>'
                                    );
                            });
                        });
                    }
                    @if (isset($continue_edit_submit_route_name))
                        else if (xhr.status === 409) {
                            let err = JSON.parse(xhr.responseText)
                            let confirmContinue = confirm(err.message)
                            if (confirmContinue) {
                                $.ajax({
                                    url: "{{ route($continue_edit_submit_route_name) }}",
                                    type: 'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    beforeSend: function(xhr) {
                                        xhr.setRequestHeader('X-CSRF-TOKEN',
                                            $(
                                                'meta[name="csrf-token"]'
                                            )
                                            .attr('content'));
                                        xhr.setRequestHeader(
                                            'X-HTTP-Method-Override',
                                            'PUT');
                                    },
                                    success: function(response) {
                                        let newData = response.data
                                        let message = response.message
                                        alert(message)
                                        $('#edit-data-form')[0].reset();
                                        //hide modal
                                        var modal = document.getElementById(
                                            'editDataModal');
                                        modal.querySelector(
                                                '.modal-content')
                                            .classList
                                            .remove(
                                                'animate__bounceInDown');
                                        modal.querySelector(
                                                '.modal-content')
                                            .classList
                                            .add(
                                                'animate__fadeOutUp');
                                        //clear form input error
                                        $('#edit-data-form input')
                                            .removeClass(
                                                'is-invalid');
                                        $('#edit-data-form .error-message')
                                            .remove();

                                        setTimeout(function() {
                                            modal.style.display =
                                                'none';
                                            modal.querySelector(
                                                    '.modal-content'
                                                )
                                                .classList
                                                .remove(
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

                                        // Get an array of property values from newData object
                                        // var newDataValues = Object.values(
                                        //     newData);

                                        // // Add edit and delete buttons to the beginning of the array
                                        // newDataValues.unshift(editButton +
                                        //     deleteButton);

                                        // console.log(newDataValues)

                                        // table.row('#' + newData.KODE).data(
                                        //     newDataValues).draw();
                                        // console.log(response);

                                        var newDataValues = [];

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

                                        // Add edit and delete buttons to the beginning of the array
                                        newDataValues.unshift(editButton +
                                            deleteButton);

                                        console.log(newDataValues);

                                        table.row('#' + newData.KODE).data(
                                            newDataValues).draw();
                                    },
                                    error: function(xhr, status, error) {

                                        if (xhr.status === 422) {
                                            alert(
                                                'Some fields are missing or invalid.'
                                            );
                                            var errors = xhr.responseJSON;
                                            console.log(errors)
                                            // Clear previous error styling
                                            $('#edit-data-form input')
                                                .removeClass(
                                                    'is-invalid');
                                            $('#edit-data-form .error-message')
                                                .remove();
                                            $('#edit-data-form .image-preview img')
                                                .attr('src',
                                                    '');
                                            $('#edit-data-form .link-preview a')
                                                .attr('href',
                                                    '');
                                            $('#edit-data-form .link-preview a')
                                                .text('');

                                            // Iterate over errors and display corresponding messages
                                            $.each(errors.message, function(
                                                fieldName,
                                                fieldErrors) {
                                                // Add error class to input
                                                console.log(
                                                    fieldName)
                                                console.log(
                                                    fieldErrors)
                                                $('#edit-data-form [name="' +
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
                                                        $('#edit-data-form [name="' +
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
                                                .responseText)
                                            alert(err.message)
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
                        let err = JSON.parse(xhr.responseText)
                        alert(err.message)
                        console.log(xhr.responseText);
                        // Handle other error cases
                        console.log(error);
                    }
                    $('#editData').html('Save<i class="pl-1 fa-solid fa-pencil"></i>');
                }
            });
        });

        $('#btn-reset').on('click', function() {
            //get table row id column 1 and 2
            let rtable = $('#clueList').DataTable();
            let kode = rtable.cell('#' + editDataId, 1).data();
            let email = rtable.cell('#' + editDataId, 2).data();
            //confirm
            let confirm = window.confirm(
                'Apakah anda yakin ingin mereset password user dengan KODE: ' + kode +
                ' dan EMAIL: ' + email + '?'
            );

            if (!confirm) {
                return;
            }
            $.ajax({
                url: "{{ route('user.resetPassword') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    KODE: resetPasswordId,
                },
                success: function(data) {
                    if (data.success) {
                        alert('Password berhasil direset');
                    } else {
                        alert('Password gagal direset');
                    }
                },
                error: function(data) {
                    console.log(data);
                    alert('Password gagal direset');
                },
            });
        })




        $('#clueList tbody').on('click', 'button.btn-delete', function() {
            var id = $(this).attr('id');
            // substring delete-
            var itemId = id.substring(7);


            //get KODE and NAMA from datatable
            let table = $('#clueList').DataTable();
            let escapedItemId = itemId.replace(/\./g, "\\.");
            let clue = table.row('#' + escapedItemId).data();
            let clueKODE = itemId;
            let clueArray = Object.values(clue);
            let clueNAMA = clueArray[1];

            //confirm delete
            var confirmation = confirm(
                "Are you sure you want to delete data with KODE: " +
                clueKODE + " and NAMA: " + clueNAMA + "?"
            );

            if (confirmation) {
                $.ajax({
                    url: "{{ route($delete_route_name) }}",
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                        KODE: itemId,
                    },
                    success: function(response) {
                        // Handle success response
                        if (response.success) {
                            console.log(response);
                            // $('#clueList').DataTable().row($('#clueList tbody').find(
                            //         'button.btn-delete[id$="-' + itemId + '"]').closest(
                            //         'tr')).remove()
                            //     .draw();
                            let table = $('#clueList').DataTable();
                            table.row('#' + escapedItemId).remove().draw();
                            alert(response.message);

                            // deletedItemIds.push(itemId);
                        } else {
                            alert(response.message);
                        }


                    },
                    error: function(xhr, status, error) {
                        console.error(error);
                        let err = JSON.parse(xhr.responseText)
                        alert(err.message)
                    }
                });

            }
        });

        $('#resetButton').click(function() {
            // Store the value of KODE field
            var kodeValue = $('#addKode').val();

            // Reset the form (this will clear all inputs)
            $('#add-data-form')[0].reset();

            $('#add-data-form input').removeClass('is-invalid');
            $('#add-data-form .error-message').remove();

            // Set the value of KODE field back to its original value
            $('#addKode').val(kodeValue);

            // clear image preview
            $('#add-data-form .image-preview img').attr('src', '');
            $('#add-data-form .link-preview a').attr('href', '');
            $('#add-data-form .link-preview a').text('');

            $('#add-data-form .dropdownselect2fix').select2({
                searchInputPlaceholder: 'Ketik disini untuk mencari...',
                dropdownParent: $('#addDataModal')
            });

        });

        // $('#closeModalButton').click(function() {

        //     //remove error message
        //     $('input').removeClass('is-invalid');
        //     $('.error-message').remove();

        // })

        $('#closeModalButton2').click(function() {
            //reset edit form
            $('#edit-data-form')[0].reset();

            //remove error message
            $('#edit-data-form input').removeClass('is-invalid');
            $('#edit-data-form .error-message').remove();

            $('#edit-data-form .image-preview img').attr('src', '');
            $('#edit-data-form .link-preview a').attr('href', '');
            $('#edit-data-form .link-preview a').text('');
        })

        $('#closemodalButton2').click(function() {
            //reset edit form
            $('#edit-data-form')[0].reset();

            //remove error message
            $('#edit-data-form input').removeClass('is-invalid');
            $('#edit-data-form .error-message').remove();

            $('#edit-data-form .image-preview img').attr('src', '');
            $('#edit-data-form .link-preview a').attr('href', '');
            $('#edit-data-form .link-preview a').text('');
        })
    })

    document.getElementById('closemodalButtonTrash').addEventListener('click', function() {
        var modal = document.getElementById('trashbinModal');
        modal.querySelector('.modal-content').classList.remove(
            'animate__bounceInDown');
        modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
        setTimeout(function() {
            modal.style.display = 'none';
            modal.querySelector('.modal-content').classList.remove(
                'animate__fadeOutUp');
        }, 1000);
    });


    document.getElementById('closeModalButton').addEventListener('click', function() {
        var modal = document.getElementById('addDataModal');
        modal.querySelector('.modal-content').classList.remove(
            'animate__bounceInDown');
        modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
        setTimeout(function() {
            modal.style.display = 'none';
            modal.querySelector('.modal-content').classList.remove(
                'animate__fadeOutUp');
        }, 1000);
    });
    document.getElementById('closemodalButton').addEventListener('click',
        function() {
            var modal = document.getElementById('addDataModal');
            modal.querySelector('.modal-content').classList.remove(
                'animate__bounceInDown');
            modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
            setTimeout(function() {
                modal.style.display = 'none';
                modal.querySelector('.modal-content').classList.remove(
                    'animate__fadeOutUp');
            }, 1000);
        });
    var closeModalButtons = document.querySelectorAll('.closemodal');
    closeModalButtons
        .forEach(function(button) {
            button.addEventListener('click', function() {
                var modal = document.getElementById('editDataModal');
                modal.querySelector('.modal-content').classList.remove(
                    'animate__bounceInDown');
                modal.querySelector('.modal-content').classList.add(
                    'animate__fadeOutUp');
                setTimeout(function() {
                    modal.style.display = 'none';
                    modal.querySelector('.modal-content').classList
                        .remove('animate__fadeOutUp');
                }, 1000);
            });
        });



    $('.trashbin').on('click', function() {
        openLoadingModal();
        $.ajax({
            url: "{{ route($trash_route_name) }}",
            type: "GET",
            success(response) {
                if (response.success) {
                    console.log(response);
                    var modal = document.getElementById('trashbinModal');
                    modal.style.display = 'block';
                    $(modal.querySelector('.modal-content')).addClass('animate__bounceInDown');
                    // check if response.data is empty or not
                    var headContent = '';
                    @foreach ($columns as $column)
                        headContent += '<th class="text-white">' +
                            '{{ $column }}' +
                            '</th>';
                    @endforeach

                    $('#headTrashbin').html('<tr>' + headContent + '</tr>');




                    console.log('Response data is not empty');
                    var isibody = '';


                    response.data.forEach(function(item) {
                        var rowContent = '';

                        @foreach ($keys as $key)
                            @if ($key === 'AKTIF')
                                rowContent += '<td>' +
                                    (item['{{ $key }}'] == 0 ? 'T' : 'Y') +
                                    '</td>';
                            @else
                                if (item['{{ $key }}'] == null) {
                                    item['{{ $key }}'] = '';
                                }
                                rowContent += '<td>' +
                                    item['{{ $key }}'] +
                                    '</td>';
                            @endif
                        @endforeach

                        var newRow = '<tr class="border-bottom" id="' + item.KODE + '">' +
                            '<td>' +
                            '<button class="btn btn-primary btn-restore" id="restore-' +
                            item
                            .KODE +
                            '">Restore</button>' +
                            '</td>' + rowContent +
                            '</tr>';

                        isibody += newRow;
                    });

                    if (typeof tableTrash !== 'undefined' && $.fn.DataTable.isDataTable(
                            '#trashList')) {
                        tableTrash.destroy(); // Destroy the existing DataTable instance
                    }


                    $('#bodyTrashbin').html(isibody);


                    initializeDataTableTrash();




                } else {
                    alert(response.message);
                }

            },
            error(error) {
                console.log(error);
            },
            complete() {
                closeLoadingModal();
            }
        });


    });

    $('#bodyTrashbin').on('click', 'button.btn-restore', function() {
        // Store reference to the button
        var restoreButton = $(this);

        // ajax negara.restore
        var id = $(this).attr('id');
        //substring restore-
        var itemId = id.substring(8);

        let table = $('#trashList').DataTable();
        let escapedItemId = itemId.replace(/\./g, "\\.");
        let clue = table.row('#' + escapedItemId).data();
        let clueKODE = itemId;
        let clueArray = Object.values(clue);
        let clueNAMA = clueArray[2];
        //confirm
        var confirmation = confirm(
            "Are you sure you want to restore data with KODE: " +
            clueKODE + " and NAMA: " + clueNAMA + "?"
        );

        if (!confirmation) {
            return;
        }
        $.ajax({
            url: "{{ route($restore_route_name) }}",
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                KODE: itemId
            },
            success: function(response) {
                // Handle success response
                if (response.success) {
                    console.log(response);

                    var row = restoreButton.closest('tr');
                    var itemId2 = row.attr('id');

                    // Get the row data
                    var rowData = [];
                    row.find('td:not(:first-child)').each(function(index) {
                        rowData.push($(this).text());
                    });
                    console.log(rowData);

                    // row.remove();
                    tableTrash.row(row).remove().draw();

                    alert(response.message);
                    // var newRow = [];
                    // newRow.push('<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
                    //     rowData[0] +
                    //     '"><i class="fa-solid fa-pen-to-square"></i></button>' +
                    //     '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
                    //     rowData[0] + '"><i class="fa-solid fa-trash"></i></button>');
                    // rowData.forEach(function(item, index) {
                    //     newRow.push(item);
                    // });



                    // console.log(newRow);

                    // let table2 = $('#clueList').DataTable();
                    // var rowNode = table2.row.add(newRow).draw().node();
                    // $(rowNode).attr('id', rowData[0]);
                    // $(rowNode).addClass('border-bottom');

                    //ajax reload
                    $('#clueList').DataTable().ajax.reload();



                } else {
                    alert(response.message);
                }
            }
        });
    });






    function initializeDataTableTrash() {
        $('#trashList thead tr.filters').remove();


        tableTrash = $('#trashList').DataTable({
            dom: 'lBfrtip',
            responsive: true,
            buttons: [],
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ], // Use "All" instead of -1 // Configure the available options for number of rows
            pageLength: 10 // Set the initial number of rows to display
        });

        tableTrash.draw();
    }



    function previewImage(event) {
        var input = event.target;
        // get the closest form element
        var form = input.closest('form');

        var previewId = input.getAttribute('data-preview');
        // get the form id element
        var preview = form.querySelector('#' + previewId);

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            var file = input.files[0];

            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(file);

            reader.onloadend = function() {
                var extension = file.name.split('.').pop().toLowerCase();

                if (extension === 'doc' || extension === 'docx' || extension === 'pdf') {
                    preview.src = 'images/file_logo.jpg';
                }
            };
        } else {
            preview.src = "#";
        }
    }

    $('form').on('focus', 'input[type=number]', function(e) {
        $(this).on('wheel.disableScroll', function(e) {
            e.preventDefault()
        })
    })
    $('form').on('blur', 'input[type=number]', function(e) {
        $(this).off('wheel.disableScroll')
    })
</script>
