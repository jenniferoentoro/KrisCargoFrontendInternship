{{-- <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.0.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script> --}}
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/fixedheader/3.2.3/js/dataTables.fixedHeader.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.colVis.min.js"></script>
<script>
    var table;
    var column;

    // Function to initialize the DataTable with initial configuration
    function initializeDataTable() {
        $('#clueList thead tr.filters').remove();
        var columnDefs = [];
        var columns = [{
            data: null,
            defaultContent: '',
            render: function(data, type, row) {
                var editButton = '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
                    (row.KODE ? row.KODE : row.NOMOR) +
                    '"><i class="fa-solid fa-pen-to-square"></i></button>';
                var deleteButton = '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
                    (row.KODE ? row.KODE : row.NOMOR) +
                    '"><i class="fa-solid fa-trash"></i></button>';
                var div = '<div class="d-flex">' + editButton + deleteButton + '</div>';
                return div;
            }
        }];
        var keys = {!! json_encode($keys) !!};


        // Assuming $keys is an array of your data keys and $table_headers is an array of header names
        for (var i = 0; i < keys.length; i++) {
            var columnDef = {
                data: keys[i],
                name: keys[i]
            };
            columnDefs.push(columnDef);

            var column = {
                data: keys[i],
                name: keys[i]
            };
            columns.push(column);
        }
        table = $('#clueList').DataTable({
            dom: 'lBfrtip',
            responsive: true,
            ordering: true,
            processing: true,

            serverSide: true,
            // ajax: "{{ route($data_route_name) }}",
            ajax: {
                url: "{{ route($data_route_name) }}",
                type: "POST",

                data: {
                    _token: "{{ csrf_token() }}",
                },
            },
            initComplete: function() {
                var api = this.api();
                var delayTimerA;
                var $overlay = $('.overlay'); // Select the overlay element

                // Show the overlay during loading or delay
                function showOverlay() {
                    $overlay.css('display', 'block');
                }

                // Hide the overlay
                function hideOverlay() {
                    $overlay.css('display', 'none');
                }
                // Show overlay before the search starts
                api.on('preXhr', showOverlay);

                // Hide overlay when the search is completed
                api.on('xhr', hideOverlay);
                // Show the general search input on click
                $('.dataTables_filter label').click(function() {
                    console.log("Label clicked");
                    $('.dataTables_filter input').css('display', 'inline-block').focus();
                });

                // Handle the general search input
                // $('.dataTables_filter input')
                //     .off('keyup change')
                //     .on('keyup', function(e) {
                //         e.stopPropagation();

                //         console.log("Input keyup event");

                //         var searchValue = this.value;

                //         // Clear the previous timeout (if any) and set a new one
                //         clearTimeout(delayTimerA);
                //         delayTimerA = setTimeout(function() {
                //             console.log("Delayed search");
                //             api.search(searchValue).draw();
                //         }, 2000); // Adjust the delay time here (300ms in this example)
                //     });

                //give delay to search after typing
                $('.dataTables_filter input')
                    .off('input keyup') // Remove previous event handlers
                    .on('input', function(e) {
                        e.stopPropagation();

                        console.log("Input input event");

                        var searchValue = this.value;

                        // Clear the previous timeout (if any) and set a new one
                        clearTimeout(delayTimerA);
                        delayTimerA = setTimeout(function() {
                            console.log("Delayed search");
                            api.search(searchValue).draw();
                        }, 750); // Adjust the delay time here (750ms in this example)
                    });
            },
            createdRow: function(row, data, dataIndex) {
                // Set a custom ID for each row
                var customId = (data.KODE ? data.KODE : data.NOMOR);
                $(row).attr('id', customId);

                //give border-bottom to each row
                $(row).addClass('border-bottom');

            },
            // columns: [{
            //         // This column is for the edit and delete buttons
            //         data: null, // We're not using data from the table rows
            //         defaultContent: '', // We're specifying an empty default content
            //         render: function(data, type, row) {
            //             // Create edit and delete buttons
            //             var editButton = '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
            //                 (row.KODE ? row.KODE : row.NOMOR) +
            //                 '"><i class="fa-solid fa-pen-to-square"></i></button>';
            //             var deleteButton =
            //                 '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
            //                 (row.KODE ? row.KODE : row.NOMOR) +
            //                 '"><i class="fa-solid fa-trash"></i></button>';

            //             // Put buttons in a div with class d-flex
            //             var div = '<div class="d-flex">' + editButton + deleteButton + '</div>';

            //             return div;
            //         }
            //     },

            //     {
            //         data: 'KODE',
            //         name: 'KODE'
            //     },
            //     {
            //         data: 'NAMA',
            //         name: 'NAMA'
            //     },
            //     {
            //         data: 'BADAN_HUKUM',
            //         name: 'BADAN_HUKUM'
            //     },
            //     {
            //         data: 'NAMA_GROUP',
            //         name: 'NAMA_GROUP'
            //     },
            //     {
            //         data: 'NO_KTP',
            //         name: 'NO_KTP'
            //     },
            //     {
            //         data: 'NAMA_KTP',
            //         name: 'NAMA_KTP'
            //     },
            //     {
            //         data: 'ALAMAT_KTP',
            //         name: 'ALAMAT_KTP'
            //     },
            //     {
            //         data: 'RT_KTP',
            //         name: 'RT_KTP'
            //     },
            //     {
            //         data: 'RW_KTP',
            //         name: 'RW_KTP'
            //     },
            //     {
            //         data: 'KELURAHAN_KTP',
            //         name: 'KELURAHAN_KTP'
            //     },
            //     {
            //         data: 'KECAMATAN_KTP',
            //         name: 'KECAMATAN_KTP'
            //     },
            //     {
            //         data: 'NAMA_KOTA_KTP',
            //         name: 'NAMA_KOTA_KTP'
            //     },
            //     {
            //         data: 'NAMA_PROVINSI_KTP',
            //         name: 'NAMA_PROVINSI_KTP'
            //     },
            //     {
            //         data: 'NAMA_NEGARA_KTP',
            //         name: 'NAMA_NEGARA_KTP'
            //     },
            //     {
            //         data: 'JENIS',
            //         name: 'JENIS'
            //     },
            //     {
            //         data: 'NAMA_NPWP',
            //         name: 'NAMA_NPWP'
            //     },
            //     {
            //         data: 'NO_NPWP',
            //         name: 'NO_NPWP'
            //     },
            //     {
            //         data: 'ALAMAT_NPWP',
            //         name: 'ALAMAT_NPWP'
            //     },
            //     {
            //         data: 'RT_NPWP',
            //         name: 'RT_NPWP'
            //     },
            //     {
            //         data: 'RW_NPWP',
            //         name: 'RW_NPWP'
            //     },
            //     {
            //         data: 'KELURAHAN_NPWP',
            //         name: 'KELURAHAN_NPWP'
            //     },
            //     {
            //         data: 'KECAMATAN_NPWP',
            //         name: 'KECAMATAN_NPWP'
            //     },
            //     {
            //         data: 'NAMA_KOTA_NPWP',
            //         name: 'NAMA_KOTA_NPWP'
            //     },
            //     {
            //         data: 'NAMA_PROVINSI_NPWP',
            //         name: 'NAMA_PROVINSI_NPWP'
            //     },
            //     {
            //         data: 'NAMA_NEGARA_NPWP',
            //         name: 'NAMA_NEGARA_NPWP'
            //     },
            //     {
            //         data: 'CONTACT_PERSON_1',
            //         name: 'CONTACT_PERSON_1'
            //     },
            //     {
            //         data: 'JABATAN_1',
            //         name: 'JABATAN_1'
            //     },
            //     {
            //         data: 'NO_HP_1',
            //         name: 'NO_HP_1'
            //     },
            //     {
            //         data: 'EMAIL_1',
            //         name: 'EMAIL_1'
            //     },
            //     {
            //         data: 'CONTACT_PERSON_2',
            //         name: 'CONTACT_PERSON_2'
            //     },
            //     {
            //         data: 'JABATAN_2',
            //         name: 'JABATAN_2'
            //     },
            //     {
            //         data: 'NO_HP_2',
            //         name: 'NO_HP_2'
            //     },
            //     {
            //         data: 'EMAIL_2',
            //         name: 'EMAIL_2'
            //     },
            //     {
            //         data: 'DIBAYAR',
            //         name: 'DIBAYAR'
            //     },
            //     {
            //         data: 'LOKASI',
            //         name: 'LOKASI'
            //     },
            //     {
            //         data: 'TOP',
            //         name: 'TOP'
            //     },
            //     {
            //         data: 'PAYMENT',
            //         name: 'PAYMENT'
            //     },
            //     {
            //         data: 'KETERANGAN_TOP',
            //         name: 'KETERANGAN_TOP'
            //     },
            //     {
            //         data: 'TELP',
            //         name: 'TELP'
            //     },
            //     {
            //         data: 'HP',
            //         name: 'HP'
            //     },
            //     {
            //         data: 'WEBSITE',
            //         name: 'WEBSITE'
            //     },
            //     {
            //         data: 'EMAIL',
            //         name: 'EMAIL'
            //     },
            //     {
            //         data: 'NAMA_AR',
            //         name: 'NAMA_AR'
            //     },
            //     {
            //         data: 'NAMA_SALES',
            //         name: 'NAMA_SALES'
            //     },
            //     {
            //         data: 'PLAFON',
            //         name: 'PLAFON'
            //     },
            //     {
            //         data: 'NAMA_JENIS_USAHA',
            //         name: 'NAMA_JENIS_USAHA'
            //     },
            //     {
            //         data: 'TGL_REG',
            //         name: 'TGL_REG'
            //     },
            //     {
            //         data: 'FOTO_KTP',
            //         name: 'FOTO_KTP'
            //     },
            //     {
            //         data: 'FOTO_NPWP',
            //         name: 'FOTO_NPWP'
            //     },
            //     {
            //         data: 'FORM_CUSTOMER',
            //         name: 'FORM_CUSTOMER'
            //     }
            // ],
            columnDefs: columnDefs,
            columns: columns,
            buttons: [

                {
                    text: 'Edit',
                    attr: {
                        id: 'editButton',
                        class: 'btn btn-primary'
                    }
                }
            ],
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ], // Use "All" instead of -1 // Configure the available options for number of rows
            pageLength: 10 // Set the initial number of rows to display
        });


        // if #editButton is clicked, hide the first column
        column = table.column(0);
        column.visible(false);
        $('#editButton').on('click', function() {
            column.visible(!column.visible());
        });
        $('.dataTables_filter input').unbind();


    }



    function initialize2() {
        $('#clueList thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#clueList thead');

        var columnDefs = [];
        var columns = [{
            data: null,
            defaultContent: '',
            render: function(data, type, row) {
                var editButton = '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
                    (row.KODE ? row.KODE : row.NOMOR) +
                    '"><i class="fa-solid fa-pen-to-square"></i></button>';
                var deleteButton = '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
                    (row.KODE ? row.KODE : row.NOMOR) +
                    '"><i class="fa-solid fa-trash"></i></button>';
                var div = '<div class="d-flex">' + editButton + deleteButton + '</div>';
                return div;
            }
        }];
        var keys = {!! json_encode($keys) !!};


        // Assuming $keys is an array of your data keys and $table_headers is an array of header names
        for (var i = 0; i < keys.length; i++) {
            var columnDef = {
                data: keys[i],
                name: keys[i]
            };
            columnDefs.push(columnDef);

            var column = {
                data: keys[i],
                name: keys[i]
            };
            columns.push(column);
        }

        table = $('#clueList').DataTable({
            dom: 'lBfrtip',
            processing: true,
            ordering: true,
            serverSide: true,

            // ajax: "{{ route($data_adv_route_name) }}",
            ajax: {
                url: "{{ route($data_adv_route_name) }}",
                type: "POST",

                data: {
                    _token: "{{ csrf_token() }}",
                },
            },
            createdRow: function(row, data, dataIndex) {
                // Set a custom ID for each row
                var customId = (data.KODE ? data.KODE : data.NOMOR);
                $(row).attr('id', customId);

                //give border-bottom to each row
                $(row).addClass('border-bottom');

            },
            columnDefs: columnDefs,
            columns: columns,
            // columns: [{
            //         // This column is for the edit and delete buttons
            //         data: null, // We're not using data from the table rows
            //         defaultContent: '', // We're specifying an empty default content
            //         render: function(data, type, row) {
            //             // Create edit and delete buttons
            //             var editButton = '<button class="btn btn-info btn-sm mr-1 btn-edit" id="edit-' +
            //                 (row.KODE ? row.KODE : row.NOMOR) +
            //                 '"><i class="fa-solid fa-pen-to-square"></i></button>';
            //             var deleteButton =
            //                 '<button class="btn btn-danger btn-sm btn-delete" id="delete-' +
            //                 (row.KODE ? row.KODE : row.NOMOR) +
            //                 '"><i class="fa-solid fa-trash"></i></button>';

            //             // Put buttons in a div with class d-flex
            //             var div = '<div class="d-flex">' + editButton + deleteButton + '</div>';

            //             return div;
            //         }
            //     },

            //     {
            //         data: 'KODE',
            //         name: 'KODE'
            //     },
            //     {
            //         data: 'NAMA',
            //         name: 'NAMA'
            //     },
            //     {
            //         data: 'BADAN_HUKUM',
            //         name: 'BADAN_HUKUM'
            //     },
            //     {
            //         data: 'NAMA_GROUP',
            //         name: 'NAMA_GROUP'
            //     },
            //     {
            //         data: 'NO_KTP',
            //         name: 'NO_KTP'
            //     },
            //     {
            //         data: 'NAMA_KTP',
            //         name: 'NAMA_KTP'
            //     },
            //     {
            //         data: 'ALAMAT_KTP',
            //         name: 'ALAMAT_KTP'
            //     },
            //     {
            //         data: 'RT_KTP',
            //         name: 'RT_KTP'
            //     },
            //     {
            //         data: 'RW_KTP',
            //         name: 'RW_KTP'
            //     },
            //     {
            //         data: 'KELURAHAN_KTP',
            //         name: 'KELURAHAN_KTP'
            //     },
            //     {
            //         data: 'KECAMATAN_KTP',
            //         name: 'KECAMATAN_KTP'
            //     },
            //     {
            //         data: 'NAMA_KOTA_KTP',
            //         name: 'NAMA_KOTA_KTP'
            //     },
            //     {
            //         data: 'NAMA_PROVINSI_KTP',
            //         name: 'NAMA_PROVINSI_KTP'
            //     },
            //     {
            //         data: 'NAMA_NEGARA_KTP',
            //         name: 'NAMA_NEGARA_KTP'
            //     },
            //     {
            //         data: 'JENIS',
            //         name: 'JENIS'
            //     },
            //     {
            //         data: 'NAMA_NPWP',
            //         name: 'NAMA_NPWP'
            //     },
            //     {
            //         data: 'NO_NPWP',
            //         name: 'NO_NPWP'
            //     },
            //     {
            //         data: 'ALAMAT_NPWP',
            //         name: 'ALAMAT_NPWP'
            //     },
            //     {
            //         data: 'RT_NPWP',
            //         name: 'RT_NPWP'
            //     },
            //     {
            //         data: 'RW_NPWP',
            //         name: 'RW_NPWP'
            //     },
            //     {
            //         data: 'KELURAHAN_NPWP',
            //         name: 'KELURAHAN_NPWP'
            //     },
            //     {
            //         data: 'KECAMATAN_NPWP',
            //         name: 'KECAMATAN_NPWP'
            //     },
            //     {
            //         data: 'NAMA_KOTA_NPWP',
            //         name: 'NAMA_KOTA_NPWP'
            //     },
            //     {
            //         data: 'NAMA_PROVINSI_NPWP',
            //         name: 'NAMA_PROVINSI_NPWP'
            //     },
            //     {
            //         data: 'NAMA_NEGARA_NPWP',
            //         name: 'NAMA_NEGARA_NPWP'
            //     },
            //     {
            //         data: 'CONTACT_PERSON_1',
            //         name: 'CONTACT_PERSON_1'
            //     },
            //     {
            //         data: 'JABATAN_1',
            //         name: 'JABATAN_1'
            //     },
            //     {
            //         data: 'NO_HP_1',
            //         name: 'NO_HP_1'
            //     },
            //     {
            //         data: 'EMAIL_1',
            //         name: 'EMAIL_1'
            //     },
            //     {
            //         data: 'CONTACT_PERSON_2',
            //         name: 'CONTACT_PERSON_2'
            //     },
            //     {
            //         data: 'JABATAN_2',
            //         name: 'JABATAN_2'
            //     },
            //     {
            //         data: 'NO_HP_2',
            //         name: 'NO_HP_2'
            //     },
            //     {
            //         data: 'EMAIL_2',
            //         name: 'EMAIL_2'
            //     },
            //     {
            //         data: 'DIBAYAR',
            //         name: 'DIBAYAR'
            //     },
            //     {
            //         data: 'LOKASI',
            //         name: 'LOKASI'
            //     },
            //     {
            //         data: 'TOP',
            //         name: 'TOP'
            //     },
            //     {
            //         data: 'PAYMENT',
            //         name: 'PAYMENT'
            //     },
            //     {
            //         data: 'KETERANGAN_TOP',
            //         name: 'KETERANGAN_TOP'
            //     },
            //     {
            //         data: 'TELP',
            //         name: 'TELP'
            //     },
            //     {
            //         data: 'HP',
            //         name: 'HP'
            //     },
            //     {
            //         data: 'WEBSITE',
            //         name: 'WEBSITE'
            //     },
            //     {
            //         data: 'EMAIL',
            //         name: 'EMAIL'
            //     },
            //     {
            //         data: 'NAMA_AR',
            //         name: 'NAMA_AR'
            //     },
            //     {
            //         data: 'NAMA_SALES',
            //         name: 'NAMA_SALES'
            //     },
            //     {
            //         data: 'PLAFON',
            //         name: 'PLAFON'
            //     },
            //     {
            //         data: 'NAMA_JENIS_USAHA',
            //         name: 'NAMA_JENIS_USAHA'
            //     },
            //     {
            //         data: 'TGL_REG',
            //         name: 'TGL_REG'
            //     },
            //     {
            //         data: 'FOTO_KTP',
            //         name: 'FOTO_KTP'
            //     },
            //     {
            //         data: 'FOTO_NPWP',
            //         name: 'FOTO_NPWP'
            //     },
            //     {
            //         data: 'FORM_CUSTOMER',
            //         name: 'FORM_CUSTOMER'
            //     }
            // ],
            buttons: [

                {
                    text: 'Edit',
                    attr: {
                        id: 'editButton',
                        class: 'btn btn-primary'
                    }
                }
            ],
            orderCellsTop: true,
            fixedHeader: true,
            scrollX: true,
            initComplete: function() {
                $('div.dataTables_filter').css('display', 'none');
                //click edit button twice
                $('#editButton').click();
                setTimeout(function() {
                    $('#editButton').click();
                }, 1);
                var api = this.api();
                var $overlay = $('#overlay'); // Select the overlay element

                // Show the overlay during loading or delay
                function showOverlay() {
                    $overlay.css('display', 'block');
                }

                // Hide the overlay
                function hideOverlay() {
                    $overlay.css('display', 'none');
                }
                // Show overlay before the search starts
                api.on('preXhr', showOverlay);

                // Hide overlay when the search is completed
                api.on('xhr', hideOverlay);
                var cursorPosition; // Declare cursorPosition in a higher scope
                var delayTimer;
                // api.columns().eq(0).each(function(colIdx) {
                //     var cell = $('.filters th').eq($(api.column(colIdx).header()).index());
                //     var title = $(cell).text().trim();
                //     $(cell).html('<input type="text" placeholder="' + title + '" />');

                //     $('input', $('.filters th').eq($(api.column(colIdx).header()).index()))
                //         .off('keyup change')
                //         .on('change', function(e) {
                //             $(this).attr('title', $(this).val());

                //             var searchValue = this.value;
                //             cursorPosition = this
                //                 .selectionStart; // Assign the value to cursorPosition

                //             // // Remove parentheses from search value
                //             // var cleanedSearchValue = searchValue.replace(/[()]/g, '');

                //             // // Construct regular expression pattern
                //             // var regexPattern = cleanedSearchValue ? `(${cleanedSearchValue})` :
                //             //     '';

                //             // api.column(colIdx)
                //             //     .search(regexPattern, true, false) // Apply exact search
                //             //     .draw();

                //             // Clear the previous timeout (if any) and set a new one
                //             clearTimeout(delayTimer);
                //             delayTimer = setTimeout(function() {
                //                 // Remove parentheses from search value
                //                 var cleanedSearchValue = searchValue.replace(/[()]/g,
                //                     '');

                //                 // Construct regular expression pattern
                //                 var regexPattern = cleanedSearchValue ?
                //                     `(${cleanedSearchValue})` : '';

                //                 api.column(colIdx)
                //                     .search(regexPattern, true,
                //                         false) // Apply exact search
                //                     .draw();
                //             }, 750); // Adjust the delay time here (300ms in this example)
                //         })
                //         .on('keyup', function(e) {
                //             e.stopPropagation();
                //             $(this).trigger('change');
                //             $(this).focus()[0].setSelectionRange(cursorPosition,
                //                 cursorPosition);
                //         });
                // });

                api.columns().eq(0).each(function(colIdx) {
                    var cell = $('.filters th').eq($(api.column(colIdx).header()).index());
                    var title = $(cell).text().trim();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');

                    var $input = $('input', $('.filters th').eq($(api.column(colIdx).header())
                        .index()));

                    $input
                        .off('input')
                        .on('input', function(e) {
                            e.stopPropagation();

                            var searchValue = this.value.trim();
                            cursorPosition = this.selectionStart;

                            // Clear the previous timeout (if any) and set a new one
                            clearTimeout(delayTimer);
                            delayTimer = setTimeout(function() {
                                // Remove parentheses from search value
                                var cleanedSearchValue = searchValue.replace(/[()]/g,
                                    '');

                                // Construct regular expression pattern
                                var regexPattern = cleanedSearchValue ?
                                    `(${cleanedSearchValue})` : '';

                                api.column(colIdx)
                                    .search(regexPattern, true,
                                        false) // Apply exact search
                                    .draw();
                            }, 750); // Adjust the delay time here (750ms in this example)
                        });

                    // Prevent data refresh when clicking outside the input field
                    $input.on('click', function(e) {
                        e.stopPropagation();
                    });
                });
            },



            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ], // Use "All" instead of -1 // Configure the available options for number of rows
            pageLength: 10 // Set the initial number of rows to display
        });
        column = table.column(0);
        column.visible(false);
        $('#editButton').on('click', function() {
            column.visible(!column.visible());
        });



    }

    // Initialize the DataTable initially
    initializeDataTable();


    $(document).ready(function() {



        const advanceButton = document.getElementById('advance');


        advanceButton.addEventListener('click', function() {

            if (advanceButton.innerHTML === 'Advanced') {
                advanceButton.innerHTML = 'Simple';
                table.destroy();
                initialize2();

                table.draw();

            } else {
                advanceButton.innerHTML = 'Advanced';
                table.destroy();
                initializeDataTable();
                //unbind the event
                table.draw();
            }
        });


    });
</script>
