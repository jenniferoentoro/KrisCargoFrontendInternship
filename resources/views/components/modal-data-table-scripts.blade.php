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
    function initializeModalDataTable() {
        $('#data-table-modal thead tr.filters').remove();

        tableModal = $('#data-table-modal').DataTable({
            dom: 'lBfrtip',
            responsive: true,
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
        columnModal = tableModal.column(0);
        columnModal.visible(false);
        $('#editButton').on('click', function() {

            columnModal.visible(!columnModal.visible());
        });

    }



    function initializeModal2() {
        $('#data-table-modal thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#data-table-modal thead');

        tableModal = $('#data-table-modal').DataTable({
            dom: 'lBfrtip',
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
                var api = this.api();

                api.columns().eq(0).each(function(colIdx) {
                    var cell = $('.filters th').eq($(api.column(colIdx).header()).index());
                    var title = $(cell).text().trim();
                    $(cell).html('<input type="text" placeholder="' + title + '" />');

                    $('input', $('.filters th').eq($(api.column(colIdx).header()).index()))
                        .off('keyup change')
                        .on('change', function(e) {
                            $(this).attr('title', $(this).val());
                            var regexr = '({search})';
                            var cursorPosition = this.selectionStart;

                            api.column(colIdx)
                                .search(this.value != '' ? regexr.replace('{search}', '(((' +
                                        this.value + ')))') : '', this.value != '', this
                                    .value == '')
                                .draw();
                        })
                        .on('keyup', function(e) {
                            e.stopPropagation();
                            $(this).trigger('change');
                            $(this).focus()[0].setSelectionRange(cursorPosition,
                                cursorPosition);
                        });
                });
            },
            lengthMenu: [
                [5, 10, 25, 50, 100, -1],
                [5, 10, 25, 50, 100, "All"]
            ], // Use "All" instead of -1 // Configure the available options for number of rows
            pageLength: 10 // Set the initial number of rows to display
        });
        columnModal = tableModal.column(0);
        columnModal.visible(false);
        $('#editButton').on('click', function() {

            columnModal.visible(!columnModal.visible());
        });
    }

    // Initialize the DataTable initially
    initializeModalDataTable();


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
