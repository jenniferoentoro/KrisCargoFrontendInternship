<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
<script>
    // function createAdditionalInputs() {
    //     // Create the elements for Nominal Biaya Lain input field
    //     var nominalLabel = document.createElement("label");
    //     nominalLabel.setAttribute("for", "nominal_biaya_lain");
    //     nominalLabel.className = "form-label";
    //     nominalLabel.innerHTML = "<b>Nominal Biaya Lain</b>";

    //     var nominalInput = document.createElement("input");
    //     nominalInput.setAttribute("type", "text");
    //     nominalInput.className = "form-control";
    //     nominalInput.name = "NOMINAL_BIAYA_LAIN[]";
    //     nominalInput.placeholder = "Input Nominal Biaya Lain...";

    //     // Create the elements for Keterangan Biaya Lain input field
    //     var keteranganLabel = document.createElement("label");
    //     keteranganLabel.setAttribute("for", "keterangan_biaya_lain");
    //     keteranganLabel.className = "form-label";
    //     keteranganLabel.innerHTML = "<b>Keterangan Biaya Lain</b>";

    //     var keteranganInput = document.createElement("input");
    //     keteranganInput.setAttribute("type", "text");
    //     keteranganInput.className = "form-control";
    //     keteranganInput.name = "KETERANGAN_BIAYA_LAIN";
    //     keteranganInput.placeholder = "Input Keterangan Biaya Lain...";

    //     // Create a div to wrap both input fields
    //     var additionalInputDiv = document.createElement("div");
    //     additionalInputDiv.className = "biayaLain-input";
    //     additionalInputDiv.style.display = "none"; // Initially hide the div

    //     // Append the input fields to the div
    //     additionalInputDiv.appendChild(nominalLabel);
    //     additionalInputDiv.appendChild(nominalInput);
    //     additionalInputDiv.appendChild(keteranganLabel);
    //     additionalInputDiv.appendChild(keteranganInput);

    //     return additionalInputDiv;
    // }

    // var add_hpp_biaya_lain_counter = 0;

    // function createAdditionalInputs2() {
    //     // Your existing code ...
    //     var hppbiayalainLabel = document.createElement("label");
    //     hppbiayalainLabel.setAttribute("for", "KODE_BIAYA_LAIN[]");
    //     hppbiayalainLabel.className = "form-label mt-1";
    //     add_hpp_biaya_lain_counter++;
    //     hppbiayalainLabel.innerHTML = "<b>HPP Biaya Lain " + add_hpp_biaya_lain_counter +
    //         "</b>";
    //     // Create the select element
    //     var selectInput = document.createElement("select");
    //     selectInput.className = "form-control dropdownselect2fix";
    //     // selectInput.id = "KODE_BIAYA_LAIN[]";
    //     selectInput.name = "KODE_BIAYA_LAIN[]";

    //     // Create the default "Please Select" option
    //     var pleaseSelectOption = document.createElement("option");
    //     pleaseSelectOption.value = "";
    //     pleaseSelectOption.text = "";
    //     pleaseSelectOption.selected = true;
    //     selectInput.appendChild(pleaseSelectOption);

    //     // Create the remove button
    //     var removeButton = document.createElement("button");
    //     removeButton.innerHTML = "X";
    //     removeButton.classList.add("btn", "btn-danger", "mt-1", "float-right", "mb-1");
    //     removeButton.onclick = function() {
    //         // Get the parent element (div) and remove it from the DOM
    //         var parentDiv = removeButton.parentElement;
    //         parentDiv.remove();
    //     };



    //     // Loop through the options in object_costrate_dropdown and create <option> elements
    //     for (const [optionValue, optionLabel] of Object.entries(json_costrate_dropdown)) {
    //         var option = document.createElement("option");
    //         option.value = optionValue;
    //         option.text = optionLabel;
    //         selectInput.appendChild(option);
    //     }
    //     var additionalInputDiv = document.createElement("div");
    //     additionalInputDiv.className = "biayaLain-input";
    //     additionalInputDiv.style.display = "none"; // Initially hide the div
    //     // Append the select element to the div
    //     additionalInputDiv.appendChild(hppbiayalainLabel);
    //     additionalInputDiv.appendChild(selectInput);

    //     additionalInputDiv.appendChild(removeButton);

    //     // Your existing code ...

    //     return additionalInputDiv;
    // }

    function formatNumberInput(input) {
        var value = input.value;
        value = value.replace(/\D/g, ""); // Remove non-numeric characters
        value = value.replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."); // Add dot every three digits
        input.value = value;
        // var hiddenInput = document.getElementById(input.id + "_hidden");
        // hiddenInput.value = value.replace(/\./g, ""); // Set value without dots in hidden input
    }


    // Add an event listener for the biayaLain button
    // document.getElementById("biayaLain").addEventListener("click", function() {
    //     // Create the additional input fields
    //     var additionalInputs = createAdditionalInputs2();




    //     // Append the new inputs to the container
    //     document.getElementById("additionalInputsContainer").appendChild(additionalInputs);

    //     // Show the additional inputs
    //     additionalInputs.style.display = "block";

    //     //initial select2
    //     $('.dropdownselect2fix').select2({
    //         searchInputPlaceholder: 'Ketik disini untuk mencari...',
    //         dropdownParent: $('#addDataModal')
    //     });
    // });

    // function showAdditionalInput(dropdown) {
    //     var additionalInput = dropdown.closest('.mb-3').find('.additional-input');
    //     var additionalInputLama = dropdown.closest('.mb-3').find('.additional-input-lama');
    //     var inputFor = dropdown.data('input-for');
    //     var selectedValue = dropdown.val();

    //     if (selectedValue == inputFor) {
    //         additionalInput.show();
    //         additionalInputLama.hide();
    //     } else if (selectedValue == "LAMA") {
    //         additionalInput.hide();
    //         additionalInputLama.show();
    //     } else {
    //         additionalInput.hide();
    //         additionalInputLama.hide();
    //     }
    // }

    // $(document).ready(function() {
    //     // Attach the change event listener to the dropdowns with the class .additionalInputForm
    //     $(document).on('change', '.additionalInputForm', function() {
    //         showAdditionalInput($(this));
    //     });

    //     // Initial call to set initial visibility based on the current state
    //     // $('.additionalInputForm').each(function() {
    //     //     showAdditionalInput($(this));
    //     // });
    // });

    // function onChangeShowAdditionalInput() {

    $(document).on('change', '.additionalInputForm', function() {
        var dropdown = $(this);
        var additionalInput = dropdown.closest('.mb-3').find('.additional-input');
        var additionalInputLama = dropdown.closest('.mb-3').find('.additional-input-lama');
        var inputFor = dropdown.data('input-for');
        var selectedValue = dropdown.val();

        if (selectedValue == "LAMA") {
            additionalInput.hide();
            additionalInputLama.show();
        } else if (selectedValue == inputFor) {
            additionalInput.show();
            if (selectedValue == "BARU") {
                additionalInputLama.hide();
            }
        } else {
            var additionalInputsContainer = dropdown.closest('.mb-3').find('.additional-input')[
                0]; // Convert jQuery object to DOM element
            console.log(additionalInputsContainer);

            var allAdditionalInputs = additionalInputsContainer.querySelectorAll('input, select');

            for (let i = 0; i < allAdditionalInputs.length; i++) {

                console.log(allAdditionalInputs[i]);
                allAdditionalInputs[i].value = "";

                //if it is a select2 element, trigger change event
                if (allAdditionalInputs[i].classList.contains('select2-hidden-accessible')) {
                    $(allAdditionalInputs[i]).trigger('change');
                }
            }

            additionalInput.hide();
        }
    });
    // }

    function showAdditionalInput() {

        $('.additionalInputForm').each(function() {
            var dropdown = $(this);
            var additionalInput = dropdown.closest('.mb-3').find('.additional-input');
            var additionalInputLama = dropdown.closest('.mb-3').find('.additional-input-lama');
            var inputFor = dropdown.data('input-for');
            var selectedValue = dropdown.val();
            if (selectedValue == inputFor) {
                additionalInput.show();
                if (selectedValue == "BARU") {
                    additionalInputLama.hide();
                }
            } else if (selectedValue == "LAMA") {

                additionalInput.hide();
                additionalInputLama.show();

            } else {
                //get closest additionalInputsContainer
                var additionalInputsContainer = dropdown.closest('.additional-input');
                console.log(additionalInputsContainer)


                additionalInput.hide();
            }
        });
    }


    // function createAdditionalEdit3() {
    //     var div = $('<div>')
    //         .addClass(
    //             'additionalDetailQuotationEdit'
    //         );

    //     //add a hr
    //     var hr = $('<hr>')
    //         .addClass(
    //             'mt-0 mb-3'
    //         );
    //     div.append(hr);

    //     //h4 saying Additional Detail Quotation
    //     var h4 = $('<h4>')
    //         .html(
    //             'Additional Detail Quotation'
    //         );

    //     div.append(h4);
    //     // Append the delete button to the div
    //     var deleteButton =
    //         $('<button>')
    //         .attr({
    //             type: 'button',
    //             id: 'delete-' +
    //                 urutan
    //         })
    //         .addClass(
    //             'btn btn-danger mt-1 float-right mb-1'
    //         )
    //         .html('X');

    //     // Add click event handler to the delete button
    //     deleteButton.on(
    //         'click',
    //         function() {
    //             $(this)
    //                 .parent()
    //                 .parent()
    //                 .parent()
    //                 .remove();
    //         });

    //     var contentRow = $(
    //             '<div>')
    //         .addClass(
    //             'row');

    //     // Add a column for the delete button
    //     var deleteColumn =
    //         $('<div>')
    //         .addClass(
    //             'col');

    //     // Add the delete button to the column
    //     deleteColumn.append(
    //         deleteButton
    //     );

    //     // Add the column to the row
    //     contentRow.append(
    //         deleteColumn
    //     );



    //     div.append(
    //         contentRow);

    //     let row1 = $('<div>').addClass('row');
    //     let col1 = $('<div>').addClass('col-md-6');
    //     //create KODE_PRAJOA[] select with select2 and display none
    //     let selectKodePrajoa = $('<select>').addClass('form-control select2-hidden-accessible').attr({
    //         name: 'KODE_PRAJOA[]',
    //         id: 'KODE_PRAJOA[]',

    //     }).css({
    //         display: 'none'
    //     });

    //     //get options from the select named KODE_PRAJOA[]
    //     let optionsKodePrajoa = $('#KODE_PRAJOA[]').children('option');
    //     // append options to selectKodePrajoa
    //     selectKodePrajoa.append(optionsKodePrajoa);
    //     //select the first option
    //     selectKodePrajoa.val(optionsKodePrajoa[0].value).trigger('change');

    //     //append selectKodePrajoa to col1
    //     col1.append(selectKodePrajoa);


    //     return div;



    // }



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





    //

    // Call the function initially to set the initial state of the additional inputs


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
        var tableMaster;
        var whichdropdown = "";
        var child = "";

        // .btn-dropdown on click




        $(document).on('click', '.open-master-button', function() {

            // get closest input id
            whichdropdown = $(this).closest('.input-group').find('input').attr('id');
            if (whichdropdown == "HARGA" || whichdropdown.includes("HARGA-")) {
                // GET KODE_JENIS_ORDER VALUE
                var kode_jenis_order = $('#KODE_JENIS_ORDER').find("option:selected").val();
                if (kode_jenis_order == "LCL") {
                    var apiUrl = $(this).data('search-2');
                    var tableHeaders = $(this).data('theaders-2');
                    var columnsShown = $(this).data('colshown-2');
                } else {
                    var apiUrl = $(this).data('search');
                    var tableHeaders = $(this).data('theaders');
                    var columnsShown = $(this).data('colshown');

                }
            } else {
                var apiUrl = $(this).data('search');
                var tableHeaders = $(this).data('theaders');
                var columnsShown = $(this).data('colshown');
            }

            child = $(this).closest('.input-group').find('input').attr('data');



            // if (typeof tableMaster !== 'undefined' && $.fn.DataTable.isDataTable(
            //         '#masterList')) {
            //     tableMaster.destroy();
            // }
            // $('#bodyMaster').html("");
            // openLoadingModal();
            var modal = document.getElementById('masterModal');

            modal.style.display = 'block';

            $(modal.querySelector('.modal-content')).addClass(
                'animate__bounceInDown');


            initializeModalDataTable(apiUrl, tableHeaders, columnsShown);

            // $.ajax({
            //     url: apiUrl,
            //     type: "GET",
            //     dataType: "json",
            //     success(response) {
            //         closeLoadingModal();
            //         if (response.success) {
            //             console.log(response);
            //             var modal = document.getElementById('masterModal');
            //             modal.style.display = 'block';
            //             $(modal.querySelector('.modal-content')).addClass(
            //                 'animate__bounceInDown');
            //             // check if response.data is empty or not
            //             var headContent = '';
            //             for (var i = 0; i < tableHeaders.length; i++) {
            //                 headContent += '<th class="text-white">' +
            //                     tableHeaders[i] +
            //                     '</th>';
            //             }

            //             $('#headMaster').html('<tr>' + headContent + '</tr>');

            //             console.log('Response data is not empty');
            //             var isibody = '';
            //             response.data.forEach(function(item) {
            //                 var rowContent = '';

            //                 for (const key of columnsShown) {
            //                     if (key === 'AKTIF') {
            //                         rowContent += '<td>' + (item[key] === 0 ? 'T' :
            //                             'Y') + '</td>';
            //                     } else {
            //                         if (item[key] === null) {
            //                             item[key] = '';
            //                         }
            //                         rowContent += '<td>' + item[key] + '</td>';
            //                     }
            //                 }

            //                 var newRow = '<tr class="border-bottom" id="' + item.KODE +
            //                     '">' +
            //                     '<td>' +
            //                     '<button class="btn btn-success btn-dropdown" id="addToDropdown-' +
            //                     item
            //                     .KODE +
            //                     '">+</button>' +
            //                     '</td>' + rowContent +
            //                     '</tr>';

            //                 isibody += newRow;
            //             });
            //             $('#bodyMaster').html(isibody);
            //             initializeDataTableMaster();
            //         } else {
            //             alert(response.message);
            //             closeLoadingModal();
            //         }

            //     },
            //     error(error) {
            //         console.log(error);
            //         closeLoadingModal();
            //     },
            //     complete() {
            //         closeLoadingModal();
            //     }
            // });

        });

        $(document).on('click', '.btn-dropdown', function() {
            var tipe = $('#KODE_JENIS_ORDER').val();
            var tr = $(this).closest('tr');
            var tdChild = tr.find('td:eq(' + child + ')');





            var ColumnValue = tdChild.text();

            $('#' + whichdropdown).val(ColumnValue);

            var parts = whichdropdown.split('-');
            var inputFor = parts[0];
            var identifier = "";
            if (parts.length === 2) {
                identifier = "-" + parts[1];
            }


            // Close the modal (if required)
            var modal = document.getElementById('masterModal');
            modal.style.display = 'none';

            // // find the nearest class KODE_POD's id
            // var kodePodId = $(this).closest('.KODE_POD').find('input').attr('id');
            // alert(kodePodId);

            if (tipe == "FCL" && inputFor == "KODE_PRAJOA") {
                var textKodePOL = $(this).closest('tr').find('td:eq(4)').text().trim();
                var kodePolOption = null;
                $('#KODE_POL' + identifier + ' option').each(function() {
                    if ($(this).text().trim() === textKodePOL) {
                        kodePolOption = $(this).val();
                        
                    }
                });

                var textKodePOD = $(this).closest('tr').find('td:eq(5)').text().trim();
                var kodePoDOption = null;
                $('#KODE_POD' + identifier + ' option').each(function() {
                    if ($(this).text().trim() === textKodePOD) {
                        kodePoDOption = $(this).val();
                        
                    }
                });
                var sizeKode = $(this).closest('tr').find('td:eq(6)').text().trim();
                var kodesizeOption = null;
                $('#KODE_UK_KONTAINER' + identifier + ' option').each(function() {
                    if ($(this).text().trim() === sizeKode) {
                        kodesizeOption = $(this).val();
                        
                    }
                });

                var jenisKode = $(this).closest('tr').find('td:eq(7)').text().trim();
                var kodeJenisOption = null;
                $('#KODE_JENIS_CONTAINER' + identifier + ' option').each(function() {
                    if ($(this).text().trim() === jenisKode) {
                        kodeJenisOption = $(this).val();
                        
                    }
                });

                var commodityKode = $(this).closest('tr').find('td:eq(9)').text().trim();
                var kodeCommodityOption = null;
                $('#KODE_COMMODITY' + identifier + ' option').each(function() {
                    if ($(this).text().trim() === commodityKode) {
                        kodeCommodityOption = $(this).val();
                        
                    }
                });

                var buruhMuat = $(this).closest('tr').find('td:eq(30)').text().trim();
                var buruhMuatOption = null;
                if(buruhMuat == "true"){
                    buruhMuatOption = "INCL";
                }else{
                    buruhMuatOption = "EXCL";
                }

                var buruhBongkar = $(this).closest('tr').find('td:eq(37)').text().trim();
                var buruhBongkarOption = null;
                if(buruhBongkar == "true"){
                    buruhBongkarOption = "INCL";
                }else{
                    buruhBongkarOption = "EXCL";
                }

             

                var serviceKode = $(this).closest('tr').find('td:eq(10)').text().trim();
                var kodeserviceOption = null;
                $('#KODE_SERVICE' + identifier + ' option').each(function() {
                    if ($(this).text().trim() === serviceKode) {
                        kodeserviceOption = $(this).val();
                        
                    }
                });
                // 42 44

                var doorpool = $(this).closest('tr').find('td:eq(41)').text().trim();
                var doorpoolISI = $(this).closest('tr').find('td:eq(42)').text().trim();

                if (doorpool == "true") {
                    var kodedoorpoolOption = null;
                $('#KODE_DOOR_POL' + identifier + ' option').each(function() {
                    if ($(this).text().trim() === doorpoolISI) {
                        kodedoorpoolOption = $(this).val();
                        
                    }
                });
                }

                var doorpood = $(this).closest('tr').find('td:eq(43)').text().trim();
                var doorpoodISI = $(this).closest('tr').find('td:eq(44)').text().trim();

                if (doorpood == "true") {
                    var kodedoorpoodOption = null;
                $('#KODE_DOOR_POD' + identifier + ' option').each(function() {
                    if ($(this).text().trim() === doorpoodISI) {
                        kodedoorpoodOption = $(this).val();
                        
                    }
                });
                }
                

                var asuransiKode = $(this).closest('tr').find('td:eq(38)').text().trim();
                if (asuransiKode == "false") {
                    asuransiKode = "TIDAK";
                } else {
                    asuransiKode = "YA";
                    $('#TSI').val($(this).closest('tr').find('td:eq(40)').text().trim()).trigger(
                        'change');
                    $('#TSI_NOMINAL').val($(this).closest('tr').find('td:eq(39)').text().trim())
                        .trigger('change');
                }
                var kodeasuransiOption = null;
                $('#ASURANSI' + identifier + ' option').each(function() {
                    if ($(this).text().trim() == asuransiKode) {
                        kodeasuransiOption = $(this).val();
                        
                    }
                });

                $('#KODE_POL' + identifier).val(kodePolOption).trigger('change');
                $('#KODE_POD' + identifier).val(kodePoDOption).trigger('change');
                $('#KODE_UK_KONTAINER' + identifier).val(kodesizeOption).trigger('change');
                $('#KODE_JENIS_CONTAINER' + identifier).val(kodeJenisOption).trigger('change');
                $('#KODE_COMMODITY' + identifier).val(kodeCommodityOption).trigger('change');
                $('#KODE_SERVICE' + identifier).val(kodeserviceOption).trigger('change');
                $('#ASURANSI' + identifier).val(kodeasuransiOption).trigger('change');
                if (doorpool == "true") {
                    $('#KODE_DOOR_POL' + identifier).val(kodedoorpoolOption).trigger('change');
                }
                if (doorpood == "true") {
                    $('#KODE_DOOR_POD' + identifier).val(kodedoorpoodOption).trigger('change');
                }

                $('#BURUH_MUAT' + identifier).val(buruhMuatOption).trigger('change');
                $('#BURUH_BONGKAR' + identifier).val(buruhBongkarOption).trigger('change');

            }

        });


        function changeJenisOrder(option) {
            var selectedText = $('#KODE_JENIS_ORDER').find("option:selected").val();
            var div = "#divDetailQuotation";
            if (option == "edit") {
                selectedText = $('#KODE_JENIS_ORDER_EDIT').find("option:selected").val();
                div = "#divDetailQuotationedit";
            }


            if (selectedText != "FCL") {
                $(div).find('input[name="KODE_PRAJOA[]"]').parent().parent().hide();
            } else {
                $(div).find('input[name="KODE_PRAJOA[]"]').parent().parent().show();
            }

            if (selectedText != "LCL") {
                $('.SATUAN_HARGA').parent().hide();
            } else {
                $('.SATUAN_HARGA').parent().show();
            }
            if (selectedText != "FCL" && selectedText != "LCL") {
                $('.KODE_POL').parent().hide();
                $('.KODE_POD').parent().hide();
                $('.KODE_UK_KONTAINER').parent().hide();
                $('.KODE_JENIS_CONTAINER').parent().hide();
                $('.STUFFING').parent().hide();
                $('.STRIPPING').parent().hide();


            } else {
                $('.KODE_POL').parent().show();
                $('.KODE_POD').parent().show();
                $('.KODE_UK_KONTAINER').parent().show();
                $('.KODE_JENIS_CONTAINER').parent().show();
                $('.STUFFING').parent().show();
                $('.STRIPPING').parent().show();


            }
        }
        $("#KODE_JENIS_ORDER").change(function() {
            changeJenisOrder("add");

        });

        $("#KODE_JENIS_ORDER_EDIT").change(function() {
            changeJenisOrder("edit");

        });

        $("#STRIPPING").change(function() {
            var selectedValue = $(this).val();
            if (selectedValue !== "DALAM") {
                $('#BURUH_SALIN').parent().hide();

            } else {
                $('#BURUH_SALIN').parent().show();
            }
        });

        $('#addDataButton').on('click', function() {
            flatpickr("#TANGGAL", {
                defaultDate: "today", // Set the default date to today
                dateFormat: "d-m-Y", // Set the desired date format
                disableMobile: "true", // Disable mobile-friendly UI
            });
            var modal = document.getElementById('addDataModal');
            if (!modal.classList.contains('d-none')) {
                modal.classList.add('d-none');
                return;
            }

            $('#closeModalButton2').click();


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
                            $('#addKode').val(nextKode);
                            var modal = $('#addDataModal')[0];
                            modal.classList.remove('d-none');

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

        var values = "";



        $('#addDataModal').on('shown.bs.modal', function() {
            // Reinitialize Select2 for the dropdown inside the modal
            $('#addDataModal .dropdownselect2fix').select2();
        });

        $('#editDataModal').on('shown.bs.modal', function() {
            // Reinitialize Select2 for the dropdown inside the modal
            $('#editDataModal .dropdownselect2fix').select2();
        });


        $('.add-data-form').submit(function(event) {
            //get this form
            var form = $(this);
            convertDateToISO(form);

            $('.number-input').each(function() {
                var value = $(this).val();
                value = value.replace(/\./g, '');
                $(this).val(value);
            });

            values = $(this).attr('data');



            $('#saveData').html(
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...'
            );

            event.preventDefault();
            var formData = new FormData(this);
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
                    $('.add-data-form')[0].reset();
                    flatpickr("#TANGGAL", {
                        dateFormat: "d-m-Y",
                        disableMobile: "true",
                    });

                    $('.dropdownselect2fix').select2({
                        searchInputPlaceholder: 'Ketik disini untuk mencari...',
                        dropdownParent: $('#addDataModal')
                    });

                    //remove all biayaLain-input-more class
                    // $('.biayaLain-input-more').remove();

                    //click closeModalButton id
                    $('#closeModalButton').click();
                    let newData = response.data;
                    let message = response.message;
                    alert(message);
                    $('#saveData').html('Save');

                    //clear all add-data-form input
                    $('.add-data-form')[0].reset();



                    // Hide modal


                    var url = "{{ route('penawaran.viewInvoice', ['KODE' => ':kode']) }}";
                    let table = $('#clueList').DataTable();
                    var editButton =
                        '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
                        newData.KODE +
                        '"><i class="fa-solid fa-pen-to-square"></i></button>';

                    var view = '<a href="' + url.replace(':kode', newData.KODE) +
                        '" target="_blank" class="btn btn-warning btn-sm mr-1 btn-view" id="view-' +
                        newData.KODE + '"><i class="fa-solid fa-eye"></i></a>';
                    var deleteButton =
                        '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
                        newData.KODE + '"><i class="fa-solid fa-trash"></i></button>';


                    var newDataValues = [];
                    newDataValues.push(editButton + view + deleteButton);


                    // Iterate over the $keys variable to extract the corresponding values from newData object
                    @foreach ($keys as $key)
                        if (newData['{{ $key }}'] == null) {
                            newData['{{ $key }}'] = '';
                        }
                        newDataValues.push(newData['{{ $key }}']);
                    @endforeach

                    var rowNode = table.row.add(newDataValues).draw().node();
                    $(rowNode).attr('id', newData.KODE);
                    // Give border bottom
                    $(rowNode).addClass('border-bottom');



                    $('#saveData').html('Save');


                },
                error: function(xhr, status, error) {
                    // Handle error response
                    if (xhr.status === 422) {
                        alert('Some fields are missing or invalid.');
                        var errors = xhr.responseJSON;
                        console.log(errors);
                        // Clear previous error styling
                        $('.add-data-form input').removeClass('is-invalid');
                        $('.add-data-form .error-message').remove();

                        // Iterate over errors and display corresponding messages
                        $.each(errors.message, function(fieldName, fieldErrors) {
                            // Add error class to input
                            console.log(fieldName);
                            console.log(fieldErrors);
                            //apply is invalid only to add-data-form
                            $('.add-data-form [name="' + fieldName + '"]')
                                .addClass(
                                    'is-invalid');

                            // Display error message
                            $.each(fieldErrors, function(index, errorMessage) {
                                $('.add-data-form [name="' + fieldName +
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
                                        $('.add-data-form')[0].reset();
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
                                        $('.add-data-form input')
                                            .removeClass(
                                                'is-invalid');
                                        $('.add-data-form .error-message')
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

                                        let table = $('#clueList').DataTable();
                                        alert(table);
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
                                            newDataValues.push(newData[
                                                '{{ $key }}'
                                            ]);
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
                                            $('.add-data-form input')
                                                .removeClass(
                                                    'is-invalid');
                                            $('.add-data-form .error-message')
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
                                                $('.add-data-form [name="' +
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
                                                        $('.add-data-form [name="' +
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


                    if (values == "value") {
                        $('#saveDataValue').html('Save');
                    } else {
                        $('#saveData').html('Save');
                    }

                }
            });
        });
        var urutan = 1;

        // addNewDetail on click
        $('#addNewDetail').on('click', function() {
            openLoadingModal();
            $.ajax({
                type: 'POST', // Change the request type to POST
                url: "{{ route('penawaran.detail') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    urutan: urutan
                }, // Include the urutan value in the data sent to the server
                dataType: 'json',
                success: function(response) {
                    closeLoadingModal();
                    var div = $('<div>').addClass('additionalDetailQuotation');

                    //add a hr
                    var hr = $('<hr>').addClass('mt-0 mb-3');
                    div.append(hr);

                    //h4 saying Additional Detail Quotation
                    var h4 = $('<h4>').html(
                        'Additional Detail Quotation');

                    div.append(h4);
                    // Append the delete button to the div
                    var deleteButton = $('<button>')
                        .attr({
                            type: 'button',
                            id: 'delete-' + urutan
                        })
                        .addClass('btn btn-danger mt-1 float-right mb-1')
                        .html('X');

                    // Add click event handler to the delete button
                    deleteButton.on('click', function() {
                        $(this).parent().parent().parent().remove();
                    });

                    var contentRow = $('<div>').addClass('row');

                    // Add a column for the delete button
                    var deleteColumn = $('<div>').addClass('col');

                    // Add the delete button to the column
                    deleteColumn.append(deleteButton);

                    // Add the column to the row
                    contentRow.append(deleteColumn);



                    div.append(contentRow);

                    // Append response.html to the div
                    div.append(response.html);
                    //append the div to divDetailQuotationedit
                    $('#divDetailQuotation').append(div);
                    $('#divDetailQuotation').find('.dropdownselect2fix').select2({
                        searchInputPlaceholder: 'Ketik disini untuk mencari...',
                        dropdownParent: $(
                            '#addDataModal'
                        ) // Set the appropriate dropdownParent
                    });
                    urutan++;
                    var kode_jenis_order = $('#KODE_JENIS_ORDER').find("option:selected")
                        .val();

                    if (kode_jenis_order !== "FCL") {
                        // alert("Kode Jenis Order bukan FCL");
                        // Hide input with this name KODE_PRAJOA[]
                        $('#divDetailQuotation').find('input[name="KODE_PRAJOA[]"]')
                            .parent().parent().hide();
                    }
                    changeJenisOrder("add");
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });


        });

        $('#addNewDetailEdit').on('click', function() {
            // alert("addNewDetailEdit");
            openLoadingModal();
            $.ajax({
                type: 'POST', // Change the request type to POST
                url: "{{ route('penawaran.detail') }}",
                data: {
                    _token: "{{ csrf_token() }}",
                    urutan: urutan
                }, // Include the urutan value in the data sent to the server
                dataType: 'json',
                success: function(response) {
                    closeLoadingModal();
                    var div = $('<div>').addClass('additionalDetailQuotationEdit');

                    //add a hr
                    var hr = $('<hr>').addClass('mt-0 mb-3');
                    div.append(hr);

                    //h4 saying Additional Detail Quotation
                    var h4 = $('<h4>').html(
                        'Additional Detail Quotation');

                    div.append(h4);
                    // Append the delete button to the div
                    var deleteButton = $('<button>')
                        .attr({
                            type: 'button',
                            id: 'delete-' + urutan
                        })
                        .addClass('btn btn-danger mt-1 float-right mb-1')
                        .html('X');

                    // Add click event handler to the delete button
                    deleteButton.on('click', function() {
                        $(this).parent().parent().parent().remove();
                    });

                    var contentRow = $('<div>').addClass('row');

                    // Add a column for the delete button
                    var deleteColumn = $('<div>').addClass('col');

                    // Add the delete button to the column
                    deleteColumn.append(deleteButton);

                    // Add the column to the row
                    contentRow.append(deleteColumn);



                    div.append(contentRow);

                    // Append response.html to the div
                    div.append(response.html);
                    //append the div to divDetailQuotationedit
                    $('#divDetailQuotationedit').append(div);

                    $('#divDetailQuotationedit').find('.dropdownselect2fix').select2({
                        searchInputPlaceholder: 'Ketik disini untuk mencari...',
                        dropdownParent: $(
                            '#editDataModal'
                        ) // Set the appropriate dropdownParent
                    });
                    urutan++;
                    var kode_jenis_order = $('#KODE_JENIS_ORDER').find("option:selected")
                        .val();

                    if (kode_jenis_order !== "FCL") {
                        // alert("Kode Jenis Order bukan FCL");
                        // Hide input with this name KODE_PRAJOA[]
                        $('#divDetailQuotationedit').find('input[name="KODE_PRAJOA[]"]')
                            .parent().parent().hide();
                    }
                    changeJenisOrder("edit");
                },
                error: function(xhr, status, error) {
                    console.error(error);
                }
            });


        });


        $('#clueList tbody').on('click', 'button.btn-edit', function() {
            //remove all additionalDetailQuotationEdit
            $('.additionalDetailQuotationEdit').remove();

            var id = $(this).attr('id');
            //substring edit-
            var itemId = id.substring(5);
            editDataId = itemId;
            resetPasswordId = itemId;
            var modal = document.getElementById('editDataModal');

            var form = document.querySelector('#editDataModal form');
            if (!modal.classList.contains('d-none')) {
                modal.classList.add('d-none');
                return;
            }
            $('#closeModalButton').click();

            openLoadingModal();
            // alert("{{ $open_modal_edit_route_name }}");


            $.ajax({
                url: "{{ route($open_modal_edit_route_name) }}",
                data: {
                    KODE: itemId
                },
                type: "GET",
                success(response) {
                    closeLoadingModal();
                    if (response.success) {
                        console.log(response);



                        //reset form
                        form.reset();
                        // remove previous error message
                        $('#edit-data-form input').removeClass('is-invalid');
                        $('#edit-data-form .error-message').remove();

                        // modal.style.display = 'block';
                        // modal.querySelector('.modal-content').classList.add(
                        //     'animate__bounceInDown');

                        // Iterate over the keys of the response data
                        Object.keys(response.data).forEach(function(key) {
                            // Check if the form field with matching name exists
                            // console.log(key);
                            if (key == "KODE_CUSTOMER") {
                                if (response.data[
                                        key] != null && response.data[key] != "") {
                                    form.elements["CHOOSECUSTOMER"].value = "LAMA";
                                } else {
                                    form.elements["CHOOSECUSTOMER"].value = "BARU";
                                }

                            } else if (key == "KODE_JENIS_ORDER" && response.data[
                                    key] == "FCL") {
                                // KODE_PRAJOA
                            }
                            if (key == "OFFER_DETAIL") {
                                for (var i = 0; i < response.data[key].length; i++) {
                                    console.log(response.data[key][i]);
                                    if (i == 0) {
                                        Object.keys(response.data[key][i]).forEach(
                                            function(key2) {
                                                // form.elements[key2].value = response
                                                //     .data[key][i][key2];

                                                //get div with class divDetailQuotationedit and set the value of the input and select
                                                $('#divDetailQuotationedit').find(
                                                    'input[name="' + key2 +
                                                    '[]"]').val(response.data[
                                                    key][i][
                                                    key2
                                                ]);
                                                $('#divDetailQuotationedit').find(
                                                    'select[name="' + key2 +
                                                    '[]"]').val(response.data[
                                                    key][i][
                                                    key2
                                                ]);

                                            });
                                        // alert(response.data[key][1].kode);
                                    } else {
                                        (function(i) {
                                            $.ajax({
                                                type: 'POST',
                                                url: "{{ route('penawaran.detail') }}",
                                                data: {
                                                    _token: "{{ csrf_token() }}",
                                                    urutan: urutan
                                                },
                                                dataType: 'json',
                                                async: false, // Set async option to false
                                                success: function(
                                                    response2) {
                                                    var div = $('<div>')
                                                        .addClass(
                                                            'additionalDetailQuotationEdit'
                                                        );

                                                    //add a hr
                                                    var hr = $('<hr>')
                                                        .addClass(
                                                            'mt-0 mb-3'
                                                        );
                                                    div.append(hr);

                                                    //h4 saying Additional Detail Quotation
                                                    var h4 = $('<h4>')
                                                        .html(
                                                            'Additional Detail Quotation'
                                                        );

                                                    div.append(h4);
                                                    // Append the delete button to the div
                                                    var deleteButton =
                                                        $('<button>')
                                                        .attr({
                                                            type: 'button',
                                                            id: 'delete-' +
                                                                urutan
                                                        })
                                                        .addClass(
                                                            'btn btn-danger mt-1 float-right mb-1'
                                                        )
                                                        .html('X');

                                                    // Add click event handler to the delete button
                                                    deleteButton.on(
                                                        'click',
                                                        function() {
                                                            $(this)
                                                                .parent()
                                                                .parent()
                                                                .parent()
                                                                .remove();
                                                        });

                                                    var contentRow = $(
                                                            '<div>')
                                                        .addClass(
                                                            'row');

                                                    // Add a column for the delete button
                                                    var deleteColumn =
                                                        $('<div>')
                                                        .addClass(
                                                            'col');

                                                    // Add the delete button to the column
                                                    deleteColumn.append(
                                                        deleteButton
                                                    );

                                                    // Add the column to the row
                                                    contentRow.append(
                                                        deleteColumn
                                                    );



                                                    div.append(
                                                        contentRow);

                                                    // Append response.html to the div
                                                    div.append(response2
                                                        .html);


                                                    //append the div to divDetailQuotationedit
                                                    $('#divDetailQuotationedit')
                                                        .append(div);

                                                    $('#divDetailQuotationedit')
                                                        .find(
                                                            '.dropdownselect2fix'
                                                        ).select2({
                                                            searchInputPlaceholder: 'Ketik disini untuk mencari...',
                                                            dropdownParent: $(
                                                                '#editDataModal'
                                                            ) // Set the appropriate dropdownParent
                                                        });
                                                    $('#divDetailQuotationedit')
                                                        .find(
                                                            '.dropdownselect2fix'
                                                        ).select2({
                                                            searchInputPlaceholder: 'Ketik disini untuk mencari...',
                                                            dropdownParent: $(
                                                                '#editDataModal'
                                                            )
                                                        });

                                                    urutan++;
                                                    var kode_jenis_order =
                                                        $(
                                                            '#KODE_JENIS_ORDER'
                                                        )
                                                        .find(
                                                            "option:selected"
                                                        )
                                                        .val();

                                                    if (kode_jenis_order !==
                                                        "FCL") {
                                                        $('#divDetailQuotationedit')
                                                            .find(
                                                                'input[name="KODE_PRAJOA[]"]'
                                                            )
                                                            .parent()
                                                            .parent()
                                                            .hide();
                                                    }

                                                    changeJenisOrder(
                                                        "edit");
                                                    form = document
                                                        .querySelector(
                                                            '#editDataModal form'
                                                        );


                                                    // Object.keys(response
                                                    //         .data[key][
                                                    //             i
                                                    //         ])
                                                    //     .forEach(
                                                    //         function(
                                                    //             key2) {
                                                    //             var elementId =
                                                    //                 key2 +
                                                    //                 "-" +
                                                    //                 i;
                                                    //             var element =
                                                    //                 document
                                                    //                 .getElementById(
                                                    //                     elementId
                                                    //                 );

                                                    //             if (
                                                    //                 element
                                                    //             ) {
                                                    //                 element
                                                    //                     .value =
                                                    //                     response
                                                    //                     .data[
                                                    //                         key
                                                    //                     ]
                                                    //                     [
                                                    //                         i
                                                    //                     ]
                                                    //                     [
                                                    //                         key2
                                                    //                     ];
                                                    //                 $(element)
                                                    //                     .trigger(
                                                    //                         'change'
                                                    //                     );

                                                    //             }
                                                    //         });


                                                    Object.keys(response
                                                            .data[key][
                                                                i
                                                            ])
                                                        .forEach(
                                                            function(
                                                                key2) {


                                                                //get all additionalDetailQuotationEdit
                                                                var additionalDetailQuotationEdit =
                                                                    document
                                                                    .querySelectorAll(
                                                                        '.additionalDetailQuotationEdit'
                                                                    );

                                                                //loop through all additionalDetailQuotationEdit and set the value of the input and select
                                                                additionalDetailQuotationEdit
                                                                    .forEach(
                                                                        function(
                                                                            element
                                                                        ) {
                                                                            //get the input and select inside the additionalDetailQuotationEdit
                                                                            var input =
                                                                                element
                                                                                .querySelectorAll(
                                                                                    'input[name="' +
                                                                                    key2 +
                                                                                    '[]"]'
                                                                                );
                                                                            var select =
                                                                                element
                                                                                .querySelectorAll(
                                                                                    'select[name="' +
                                                                                    key2 +
                                                                                    '[]"]'
                                                                                );

                                                                            //set the value of the input and select
                                                                            input
                                                                                .forEach(
                                                                                    function(
                                                                                        element2
                                                                                    ) {
                                                                                        element2
                                                                                            .value =
                                                                                            response
                                                                                            .data[
                                                                                                key
                                                                                            ]
                                                                                            [
                                                                                                i
                                                                                            ]
                                                                                            [
                                                                                                key2
                                                                                            ];
                                                                                    }
                                                                                );
                                                                            select
                                                                                .forEach(
                                                                                    function(
                                                                                        element2
                                                                                    ) {
                                                                                        element2
                                                                                            .value =
                                                                                            response
                                                                                            .data[
                                                                                                key
                                                                                            ]
                                                                                            [
                                                                                                i
                                                                                            ]
                                                                                            [
                                                                                                key2
                                                                                            ];
                                                                                    }
                                                                                );

                                                                            //trigger change event
                                                                            $(input)
                                                                                .trigger(
                                                                                    'change'
                                                                                );
                                                                            $(select)
                                                                                .trigger(
                                                                                    'change'
                                                                                );

                                                                        }

                                                                    );

                                                            });



                                                },
                                                error: function(xhr, status,
                                                    error) {
                                                    console.error(
                                                        error);
                                                }
                                            });
                                        })(i);
                                    }
                                }
                            }


                            if (key == "KODE_BIAYA_LAIN" && response.data[
                                    key] != null && response.data[key] != "" && response
                                .data[key].length > 0) {
                                // Get the first KODE_BIAYA_LAIN[] SELECT
                                var firstSelectInput = document.querySelector(
                                    "#editDataModal select[name='KODE_BIAYA_LAIN[]']"
                                );

                                // Assuming kodeBiayaLainArray is a valid array containing data
                                let kodeBiayaLainArray = response.data[key];

                                // Check if the kodeBiayaLainArray is not empty
                                if (kodeBiayaLainArray.length > 0) {
                                    // Set the value for the first select input
                                    firstSelectInput.value = kodeBiayaLainArray[0]
                                        .KODE_HPP_BIAYA;

                                    // Trigger the "change" event on the Select2 dropdown to update its value
                                    $(firstSelectInput).trigger('change');
                                }

                                console.log(kodeBiayaLainArray);
                                //remove all addition input

                                let allAdditionalInputs = $(
                                    '#edit-data-form .biayaLain-input-more'
                                );
                                console.log(allAdditionalInputs)
                                for (let i = 0; i < allAdditionalInputs.length; i++) {
                                    console.log(allAdditionalInputs[i])
                                    allAdditionalInputs[i].remove();
                                }
                                //remove first item in array
                                kodeBiayaLainArray.shift();
                                // let array_counter = 0;
                                for (let kodeBiayaLain of
                                        kodeBiayaLainArray) {
                                    // array_counter++;
                                    console.log(kodeBiayaLain);
                                    // Create the label element
                                    var hppbiayalainLabel = document
                                        .createElement("label");
                                    hppbiayalainLabel.setAttribute("for",
                                        "KODE_BIAYA_LAIN[]");
                                    hppbiayalainLabel.className =
                                        "form-label mt-1";
                                    // add_hpp_biaya_lain_counter++;
                                    // hppbiayalainLabel.innerHTML =
                                    //     "<b>HPP Biaya Lain " +
                                    //     add_hpp_biaya_lain_counter + "</b>";

                                    hppbiayalainLabel.innerHTML =
                                        "<b>HPP Biaya Lain</b>";

                                    // Create the select element
                                    var selectInput = document.createElement(
                                        "select");
                                    selectInput.className =
                                        "form-control dropdownselect2fix";
                                    selectInput.name = "KODE_BIAYA_LAIN[]";

                                    // Create the default "Please Select" option
                                    var pleaseSelectOption = document
                                        .createElement("option");
                                    pleaseSelectOption.value = "";
                                    pleaseSelectOption.text = "";
                                    pleaseSelectOption.selected = true;
                                    selectInput.appendChild(pleaseSelectOption);

                                    // Set the value for select input
                                    // selectInput.value = kodeBiayaLain
                                    //     .KODE_HPP_BIAYA;

                                    // Create the remove button
                                    var removeButton = document.createElement(
                                        "button");
                                    removeButton.innerHTML = "X";
                                    removeButton.classList.add("btn",
                                        "btn-danger", "mt-1", "float-right",
                                        "mb-1");
                                    removeButton.onclick = function() {
                                        // Get the parent element (div) and remove it from the DOM
                                        var parentDiv = removeButton
                                            .parentElement;
                                        //get the parent of the parent
                                        var grandParentDiv = parentDiv
                                            .parentElement;
                                        //get the parent of the grandparent
                                        var greatGrandParentDiv =
                                            grandParentDiv.parentElement;
                                        greatGrandParentDiv.remove();
                                    };

                                    //create row
                                    var row = document.createElement("div");
                                    row.className = "row";

                                    //create col-9 for select2
                                    var col9 = document.createElement("div");
                                    col9.className = "col-sm-10 col-12";

                                    //create col-3 for button
                                    var col3 = document.createElement("div");
                                    col3.className =
                                        "col-sm-2 col-12 pl-lg-0 pl-sm-2 pl-0";

                                    //append select to col-9
                                    col9.appendChild(selectInput);

                                    //append remove button to col-3
                                    col3.appendChild(removeButton);

                                    //append col-9 to row
                                    row.appendChild(col9);

                                    //append col-3 to row
                                    row.appendChild(col3);

                                    // Now, append the label, select, and removeButton to some parent container element
                                    // For example, if you have a parentContainer element in the DOM, you can do the following:

                                    for (const [optionValue, optionLabel] of Object
                                        .entries(json_costrate_dropdown)) {
                                        var option = document.createElement("option");
                                        option.value = optionValue;
                                        option.text = optionLabel;
                                        selectInput.appendChild(option);
                                    }
                                    //set value
                                    selectInput.value = kodeBiayaLain
                                        .KODE_HPP_BIAYA;

                                    var additionalInputDiv = document.createElement(
                                        "div");
                                    additionalInputDiv.className =
                                        "biayaLain-input border mt-2 p-3 rounded biayaLain-input-more";
                                    // Initially hide the div
                                    // Append the select element to the div
                                    additionalInputDiv.appendChild(hppbiayalainLabel);
                                    additionalInputDiv.appendChild(row);
                                    document.querySelector(
                                            "#editDataModal #additionalInputsContainer")
                                        .appendChild(additionalInputDiv);
                                }


                            } else if (form.elements[key]) {
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
                                        // alert(key);
                                        // if(key == "KODE_JENIS_ORDER_EDIT"){
                                        //     alert(response.data[key]);
                                        //     key = "KODE_JENIS_ORDER";
                                        //     form.elements[key].value = response.data[key];
                                        // }else{
                                        form.elements[key].value = response.data[key];
                                        // }


                                    }

                                }



                            }
                        });

                        modal.classList.remove('d-none');

                        showAdditionalInput();


                    } else {
                        alert(response.message)
                    }

                    $('#editDataModal .dropdownselect2fix').select2({
                            searchInputPlaceholder: 'Ketik disini untuk mencari...',
                            dropdownParent: $('#editDataModal')
                        }

                    );

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
            var inputs = document.querySelectorAll(
                '#edit-data-form input[name], #edit-data-form select[name], #edit-data-form textarea[name]'
            );

            //loop through all input, select and put it in formData
            var formData = new FormData();
            for (var i = 0; i < inputs.length; i++) {
                var input = inputs[i];
                if (input.type === 'file') {
                    // console.log(input.files[0]);
                    if (input.files[0]) {
                        formData.append(input.name, input.files[0]);
                    }
                } else {
                    formData.append(input.name, input.value);
                }
            }

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
                    // var modal = document.getElementById('editDataModal');
                    // modal.querySelector('.modal-content').classList.remove(
                    //     'animate__bounceInDown');
                    // modal.querySelector('.modal-content').classList.add(
                    //     'animate__fadeOutUp');
                    //clear form input error
                    $('#edit-data-form input').removeClass('is-invalid');
                    $('#edit-data-form .error-message').remove();
                    $('#edit-data-form .image-preview img').attr('src', '');
                    $('#edit-data-form .link-preview a').attr('href', '');
                    $('#edit-data-form .link-preview a').text('');

                    // setTimeout(function() {
                    //     modal.style.display = 'none';
                    //     modal.querySelector('.modal-content').classList
                    //         .remove(
                    //             'animate__fadeOutUp');
                    // }, 1000);
                    // click closeModalButton2

                    $('#closeModalButton2').click();
                    var url = "{{ route('penawaran.viewInvoice', ['KODE' => ':kode']) }}";



                    let table = $('#clueList').DataTable();
                    var editButton =
                        '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
                        newData.KODE +
                        '"><i class="fa-solid fa-pen-to-square"></i></button>';

                    var view = '<a href="' + url.replace(':kode', newData.KODE) +
                        '" target="_blank" class="btn btn-warning btn-sm mr-1 btn-view" id="view-' +
                        newData.KODE + '"><i class="fa-solid fa-eye"></i></a>';
                    var deleteButton =
                        '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
                        newData.KODE +
                        '"><i class="fa-solid fa-trash"></i></button>';

                    // Get an array of property values from newData object
                    // var newDataValues = Object.values(newData);

                    // // Add edit and delete buttons to the beginning of the array
                    // newDataValues.unshift(editButton + deleteButton);

                    // console.log(newDataValues)

                    // table.row('#' + newData.KODE).data(newDataValues).draw();
                    // console.log(response);

                    var newDataValues = [];

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

                    // Add edit and delete buttons to the beginning of the array
                    newDataValues.unshift(editButton + view + deleteButton);

                    console.log(newDataValues);

                    table.row('#' + escapedKODE).data(newDataValues).draw();
                    //edit the row id
                    table.row('#' + escapedKODE).node().id = newData.KODE;

                    $('#editData').html('Save');
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
                    $('#editData').html('Save');
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

        // $('#resetButton').click(function() {
        //     // Store the value of KODE field
        //     var kodeValue = $('#addKode').val();

        //     var form = $(this).closest('form');


        //     // Reset the form (this will clear all inputs)
        //     $('.add-data-form')[0].reset();

        //     $('.add-data-form input').removeClass('is-invalid');
        //     $('.add-data-form .error-message').remove();

        //     // Set the value of KODE field back to its original value
        //     $('#addKode').val(kodeValue);

        //     //get closest form

        //     // clear image preview
        //     $('.add-data-form .image-preview img').attr('src', '');
        //     $('.add-data-form .link-preview a').attr('href', '');
        //     $('.add-data-form .link-preview a').text('');

        //     $('.add-data-form .dropdownselect2fix').select2({
        //         searchInputPlaceholder: 'Ketik disini untuk mencari...',
        //         dropdownParent: $('#addDataModal')
        //     });
        // });

        $('#resetButton').click(function() {
            // Store the value of KODE field
            var kodeValue = $('#addKode').val();

            // Get the closest form element to the clicked button
            var form = $(this).closest('form');

            // Reset the form (this will clear all inputs)
            form[0].reset();

            // Remove the 'is-invalid' class from all input elements within the form
            form.find('input').removeClass('is-invalid');

            // Remove any error messages within the form
            form.find('.error-message').remove();

            // Set the value of KODE field back to its original value
            $('#addKode').val(kodeValue);

            // Clear image preview
            form.find('.image-preview img').attr('src', '');
            form.find('.link-preview a').attr('href', '');
            form.find('.link-preview a').text('');

            // Reinitialize the select2 dropdown within the form
            form.find('.dropdownselect2fix').select2({
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
            let modal = $('#editDataModal')[0];
            $('#edit-data-form')[0].reset();

            //remove error message
            $('#edit-data-form input').removeClass('is-invalid');
            $('#edit-data-form .error-message').remove();

            $('#edit-data-form .image-preview img').attr('src', '');
            $('#edit-data-form .link-preview a').attr('href', '');
            $('#edit-data-form .link-preview a').text('');
            $('#addDataModal .dropdownselect2fix').select2({
                    searchInputPlaceholder: 'Ketik disini untuk mencari...',
                    dropdownParent: $('#addDataModal')
                }

            );

            if (!modal.classList.contains('d-none')) {
                modal.classList.add('d-none');

                return;
            }
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



            $('#addDataModal .dropdownselect2fix').select2({
                    searchInputPlaceholder: 'Ketik disini untuk mencari...',
                    dropdownParent: $('#addDataModal')
                }

            );
        })
    })

    document.getElementById('closemodalButtonMaster').addEventListener('click', function() {
        var modal = document.getElementById('masterModal');
        modal.querySelector('.modal-content').classList.remove(
            'animate__bounceInDown');
        modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
        setTimeout(function() {
            modal.style.display = 'none';
            modal.querySelector('.modal-content').classList.remove(
                'animate__fadeOutUp');
        }, 1000);
        tableMaster.destroy();
    });

    document.getElementById('closemodalButtonMaster2').addEventListener('click', function() {
        var modal = document.getElementById('masterModal');
        modal.querySelector('.modal-content').classList.remove(
            'animate__bounceInDown');
        modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
        setTimeout(function() {
            modal.style.display = 'none';
            modal.querySelector('.modal-content').classList.remove(
                'animate__fadeOutUp');
        }, 1000);
    });

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
        // modal.querySelector('.modal-content').classList.remove(
        //     'animate__bounceInDown');
        // modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
        if (!modal.classList.contains('d-none')) {
            modal.classList.add('d-none');
            return;
        }
        // setTimeout(function() {
        //     modal.style.display = 'none';
        //     modal.querySelector('.modal-content').classList.remove(
        //         'animate__fadeOutUp');
        // }, 1000);
    });
    // document.getElementById('closemodalButton').addEventListener('click',
    //     function() {
    //         var modal = document.getElementById('addDataModal');
    //         modal.querySelector('.modal-content').classList.remove(
    //             'animate__bounceInDown');
    //         modal.querySelector('.modal-content').classList.add('animate__fadeOutUp');
    //         setTimeout(function() {
    //             modal.style.display = 'none';
    //             modal.querySelector('.modal-content').classList.remove(
    //                 'animate__fadeOutUp');
    //         }, 1000);
    //     });

    //when class closemodalValues is clicked, get this modal and close it
    $('closemodalValues').click(function() {
        //get modal using this
        var modal = $(this).closest('.modal');
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
                    var newRow = [];
                    var url = "{{ route('penawaran.viewInvoice', ['KODE' => ':kode']) }}";
                    newRow.push(
                        '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
                        rowData[0] +
                        '"><i class="fa-solid fa-pen-to-square"></i></button>' +
                        '<a href="' + url.replace(':kode', rowData[0]) +
                        '" target="_blank" class="btn btn-warning btn-sm mr-1 btn-view" id="view-' +
                        rowData[0] + '"><i class="fa-solid fa-eye"></i></a>' +
                        '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
                        rowData[0] + '"><i class="fa-solid fa-trash"></i></button>'
                    );

                    rowData.forEach(function(item, index) {
                        newRow.push(item);
                    });




                    console.log(newRow);

                    let table2 = $('#clueList').DataTable();
                    var rowNode = table2.row.add(newRow).draw().node();
                    $(rowNode).attr('id', rowData[0]);
                    $(rowNode).addClass('border-bottom');



                } else {
                    alert(response.message);
                }
            }
        });
    });



    function initializeDataTableMaster() {
        tableMaster = $('#masterList').DataTable({
            dom: 'lBfrtip',
            "bDestroy": true,
            responsive: true,
            buttons: [],
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ], // Use "All" instead of -1 // Configure the available options for the number of rows
            pageLength: 10 // Set the initial number of rows to display

        });

        // Now that the DataTables initialization is complete, you can remove the table header row safely.
        $('#masterList thead tr.filters').remove();

        // Redraw the table after removing the header row
        tableMaster.draw();

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
