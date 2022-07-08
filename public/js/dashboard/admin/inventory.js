const supplyTable = $('#supply-table');
const equipmentTable = $('#equipment-table');

const api = '/api/item/';

$(function (){
    const supplyDataTable = supplyTable.DataTable({
        'ajax': api + 'get-all/supply',
        'columns': [
            {
                'className': 'details-control',
                'orderable': false,
                'data': '',
                'defaultContent': ''
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'name'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'description'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'stock'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'stock_status'
            }
        ],
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing supplies _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> supplies'
        },
        pageLength: 5,
        select: {
            style: "multi"
        },
        order: [
            [1, "asc"]
        ],
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded"), $("#products-datatable_length label").addClass("form-label")
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    const equipmentDataTable = equipmentTable.DataTable({
        'ajax': api + 'get-all/equipment',
        'columns': [
            {
                'className': 'details-control',
                'orderable': false,
                'data': '',
                'defaultContent': ''
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'name'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'description'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'stock'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'stock_status'
            }
        ],
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing equipments _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> equipments'
        },
        pageLength: 5,
        select: {
            style: "multi"
        },
        order: [
            [1, "asc"]
        ],
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded"), $("#products-datatable_length label").addClass("form-label")
        },
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    supplyDataTable.buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)");

    $('#supply-table tbody').on('click', 'td.details-control', function() {
        const tr = $(this).closest('tr');
        const row = supplyDataTable.row( tr );

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child( more_details( row.data() ) ).show();
            tr.addClass('shown');
        }
    });

    $('#equipment-table tbody').on('click', 'td.details-control', function() {
        const tr = $(this).closest('tr');
        const row = equipmentDataTable.row( tr );

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child( more_details( row.data() ) ).show();
            tr.addClass('shown');
        }
    });
});

function more_details(data) {
    let more = '';

    more += '<div class="card">';
        more += '<div class="card-header bg-light">';
            more += '<h5 class="text-center"><strong>Stock History</strong></h5>';
        more += '</div>';
        more += '<div class="card-body">';
            more += '<table class="table" style="width: 100%">';
                more += '<thead>';
                    more += '<tr>';
                        more += '<th class="text-center">Date</th>';
                        more += '<th class="text-center">Quantity</th>';
                        more += '<th class="text-center">Cost</th>';
                        more += '<th class="text-center">Supplier</th>';
                    more += '</tr>';
                more += '</thead>';
                more += '<tbody>';
                    data.stocks.map((stock) => {
                        more += '<tr>';
                            more += `<td class="text-center">${stock.created_at}</td>`;
                            more += `<td class="text-center">${stock.quantity}</td>`;
                            more += `<td class="text-center">${stock.cost}</td>`;
                            more += `<td class="text-center">${stock.supplier}</td>`;
                        more += '</tr>';
                    });
                more += '</tbody>';
            more += '</table>';
        more += '</div>';
    more += '</div>';

    return more;
}
