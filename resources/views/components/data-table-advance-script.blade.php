<script>
    $(document).ready(function() {
        $('#advanceList thead tr')
            .clone(true)
            .addClass('filters')
            .appendTo('#advanceList thead');

        var table = $('#advanceList').DataTable({
            dom: 'Bfrtip',
            buttons: [{
                    extend: 'copy',
                    attr: {
                        class: 'btn btn-primary'
                    }, //
                },
                {
                    extend: 'csv',
                    attr: {
                        class: 'btn btn-primary'
                    }, //
                },
                {
                    extend: 'excel',
                    attr: {
                        class: 'btn btn-primary'
                    }, //
                },
                {
                    extend: 'pdf',
                    attr: {
                        class: 'btn btn-primary'
                    }, //
                },
                {
                    extend: 'print',
                    attr: {
                        class: 'btn btn-primary'
                    }, //
                },
                {
                    text: 'Edit',
                    attr: {
                        id: 'editButton2',
                        class: 'btn btn-primary'
                    },
                }
            ],
            orderCellsTop: true,
            fixedHeader: true,
            scrollX: true,


            initComplete: function() {
                var api = this.api();

                // For each column
                api
                    .columns()
                    .eq(0)
                    .each(function(colIdx) {
                        // Set the header cell to contain the input element
                        var cell = $('.filters th').eq(
                            $(api.column(colIdx).header()).index()
                        );
                      
                        var title = $(cell).text().trim();
                        $(cell).html('<input type="text" placeholder="' + title + '" />');

                        // On every keypress in this input
                        $(
                                'input',
                                $('.filters th').eq($(api.column(colIdx).header()).index())
                            )
                            .off('keyup change')
                            .on('change', function(e) {
                                // Get the search value
                                $(this).attr('title', $(this).val());
                                var regexr =
                                    '({search})'; //$(this).parents('th').find('select').val();

                                var cursorPosition = this.selectionStart;
                                // Search the column for that value
                                api
                                    .column(colIdx)
                                    .search(
                                        this.value != '' ?
                                        regexr.replace('{search}', '(((' + this.value + ')))') :
                                        '',
                                        this.value != '',
                                        this.value == ''
                                    )
                                    .draw();
                            })
                            .on('keyup', function(e) {
                                e.stopPropagation();

                                $(this).trigger('change');
                                $(this)
                                    .focus()[0]
                                    .setSelectionRange(cursorPosition, cursorPosition);
                            });
                    });
            },
        });
        var columnLength = table.columns().header().length;
        table.column(0).visible(false);


        var column = table.column(0);
        $('#editButton2').on('click', function() {
            //get value of
            column.visible(!column.visible());

        });

       
    });
</script>
