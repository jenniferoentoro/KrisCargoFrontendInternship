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
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script> --}}

<script>
    var tableModal;
    var columnModal;

    // Function to initialize the DataTable with initial configuration
    function initializeModalDataTable(apiUrl, tableHeaders, columnsShown) {
        //remove headMaster content
        //destroy existing table
        // $('#masterList thead th').each(function() {
        //     console.log("th: ", $(this).text());
        //     $(this).remove();
        // });

        console.log("tableHeaders: ", columnsShown);

        if ($.fn.DataTable.isDataTable('#masterList')) {
            //remove all th of masterList


            $('#masterList').DataTable().clear().destroy();


            $('#headMaster tr').empty();




        }

        let columnDefs = [];
        let columns = [{
            data: null,
            defaultContent: '',
            render: function(data, type, row) {


                let plusButton = '<button class="btn btn-success btn-dropdown" id="addToDropdown-' +
                    (row.KODE ? row.KODE : row.NOMOR) + '">+</button>'
                let div = '<div class="d-flex">' + plusButton + '</div>';
                return div;
            }
        }];




        // Assuming $keys is an array of your data keys and $table_headers is an array of header names
        for (let i = 0; i < columnsShown.length; i++) {
            let columnDef = {
                data: columnsShown[i],
                name: columnsShown[i]
            };
            columnDefs.push(columnDef);

            let column = {
                data: columnsShown[i],
                name: columnsShown[i],
                title: tableHeaders[i],
                id: columnsShown[i]
            };
            columns.push(column);
        }



        tableModal = $('#masterList').DataTable({
            dom: 'lBfrtip',
            responsive: true,
            ordering: true,
            processing: true,

            serverSide: true,
            ajax: {
                url: apiUrl,
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
            columnDefs: [{
                targets: '_all', // Apply to all columns
                render: function(data, type, row, meta) {
                    // Add the data-title attribute with the column title
                    if (meta.col == 0) {
                        return data;
                    } else {
                        return '<div data-title="' + columnsShown[meta.col - 1] + '">' + data +
                            '</div>';

                    }
                },
            }, ],
            columns: columns,
            buttons: [{
                    extend: 'colvis',
                    collectionLayout: 'fixed columns',
                    collectionTitle: 'Column visibility control'
                }

            ],
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ], // Use "All" instead of -1 // Configure the available options for number of rows
            pageLength: 10 // Set the initial number of rows to display
        });
        // columnModal = tableModal.column(0);
        // columnModal.visible(false);
        // $('#editButton').on('click', function() {

        //     columnModal.visible(!columnModal.visible());
        // });
        $('.dataTables_filter input').unbind();
        // tableModal.draw();
        $('#masterList thead th').addClass('text-white');

    }



    function initializeModal2() {
        $('#masterList thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#masterList thead');

        var columnDefs = [];
        var columns = [{
            data: null,
            defaultContent: '',
            render: function(data, type, row) {


                var plusButton = '<button class="btn btn-success btn-dropdown" id="addToDropdown-' +
                    (row.KODE ? row.KODE : row.NOMOR) + '">+</button>'
                var div = '<div class="d-flex">' + plusButton + '</div>';
                return div;
            }
        }];
        // var keys = {!! json_encode($keys) !!};

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


        // columnModal = tableModal.column(0);
        // columnModal.visible(false);
        // $('#editButton').on('click', function() {

        //     columnModal.visible(!columnModal.visible());
        // });
    }

    // Initialize the DataTable initially
    // initializeModalDataTable();


    $(document).ready(function() {



        // const advanceButton = document.getElementById('advance');


        // advanceButton.addEventListener('click', function() {

        //     if (advanceButton.innerHTML === 'Advanced') {
        //         advanceButton.innerHTML = 'Simple';
        //         tableModal.destroy();
        //         initializeModal2();
        //         tableModal.draw();

        //     } else {
        //         advanceButton.innerHTML = 'Advanced';
        //         tableModal.destroy();
        //         initializeModalDataTable();
        //         tableModal.draw();
        //     }
        // });


    });
</script>
