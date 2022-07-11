const archivedTable = $('#archived-table');
const api = '/api/employee/';

$(function (){
    const archivedDataTable = archivedTable.DataTable({
        'ajax': api+'archive',
        'columns': [
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'name'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'email'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'designation'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'office'
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
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded"), $("#products-datatable_length label").addClass("form-label")
        }
    });
});
