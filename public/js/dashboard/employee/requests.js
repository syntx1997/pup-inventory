const requestForm = $('#request-form');
const requestSubmitBtn = requestForm.find('button[type="submit"]');
const requestModal = $('#request-modal');

const itemTypeSelect = $('select[name="type"]');

const itemsTable = $('#items-table');
const requestsTable = $('#requests-table');

const api = '/api/item/';
const reqAPI = '/api/request/';

$(function (){
    const requestsDataTable = requestsTable.DataTable({
        'ajax': reqAPI+'get-all/'+user_id,
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
                'data': 'request_date'
            },
            {
                'className': 'text-center fw-bold',
                'orderable': false,
                'data': 'transaction_id'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'name'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'office'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'status_html'
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

    $('#requests-table tbody').on('click', 'td.details-control', function() {
        const tr = $(this).closest('tr');
        const row = requestsDataTable.row( tr );

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child( more_details( row.data() ) ).show();
            tr.addClass('shown');
        }
    });

    const itemsDataTable = itemsTable.DataTable({
        'ajax': api+'get-all/supply',
        'columns': [
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'category'
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
            }
        ],
        "lengthChange": false,
        "orderable": false,
        "info": false,
        select: {
            style: 'multi'
        },
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing categories _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> categories'
        },
        pageLength: 5,
        order: [
            [1, "asc"]
        ],
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded"), $("#products-datatable_length label").addClass("form-label")
        }
    });

    $('#move-requests-btn').on('click', function (){
        const selectedRows = itemsDataTable.rows('.selected').data();
        if(selectedRows.length > 0) {
            let total_no_stock = 0;
            selectedRows.map((row) => {
                itemsDataTable.ajax.reload(null);
                if(row.stock > 0) {
                    if($('#toRequest-table').find('#row-'+row.id).length < 1) {
                        $('#toRequest-table > tbody:last-child').append(
                            `
                                <tr id="row-${row.id}">
                                    <td class="text-center">${row.category}</td>
                                    <td class="text-center">${row.name}</td>
                                    <td class="text-center">${row.description}</td>
                                    <td class="text-center">${row.stock}</td>
                                    <td class="text-center">
                                        <div class="input-group input-group-sm flex-nowrap">
                                            <button type="button" class="input-group-text sub border-dark" id="addon-wrapping">-</button>
                                            <input id="quantity" name="item[${row.id}][quantity]" type="text" class="form-control text-center border-dark bg-white" min="1" max="'+ row.stock +'" value="1" style="width: 20px !important" required readonly>
                                            <button type="button" class="input-group-text add border-dark" id="addon-wrapping">+</button>
                                            <input name="item[${row.id}][item_id]" type="hidden" value="${row.id}">
                                        </div>
                                    </td>
                                    <td class="text-center"><button id="delete-req-item-btn" type="button" class="btn btn-link"><i class="uil-trash text-danger"></i></button></td>
                                </tr>
                            `
                        );
                    }
                } else {
                    total_no_stock += 1;
                }
            });
            if(total_no_stock > 0) {
                Swal.fire('Error', 'There was an item(s) that you selected that has zero(0) or no stock and can\'t be added on your request.', 'error');
            }
        } else {
            Swal.fire(
                'Error',
                'Please select item on the table',
                'error'
            );
        }
    });

    $('#reset-btn').on('click', function (){
       resetRequest();
    });

    itemTypeSelect.on('change', function () {
        const val = $(this).val();
        itemsDataTable.ajax.url(api+'get-all/'+val).load();
    });

    requestForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: reqAPI,
            type: 'POST',
            data: requestForm.serialize(),
            dataType: 'JSON',
            success: function (response) {
                resetRequest();
                hideModal(requestModal);
                reloadDataTable(requestsTable);
            },
            error: function (errorResponse){
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.message) {
                    Swal.fire('Error', errorJSON.message, 'error');
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(requestSubmitBtn, 'Sending Request');
            },
            complete: function () {
                submitBtnAfterSend(requestSubmitBtn, 'Request');
            }
        });
    });

});

$(document).on('keypress', '#quantity', function (event){
    let key = event.key;
    let value = event.target.value;
    let new_value = Number(value + key);
    let max = Number(event.target.max);
    if(new_value > max){ event.preventDefault(); }
});

$(document).on('click', '#delete-req-item-btn', function (){
    $(this).parents('tr').remove();
});

$(document).on('click', '.add', function (){
    if($(this).prev().val() < 3) {
        $(this).prev().val(+$(this).prev().val() + 1);
    }
});

$(document).on('click', '.sub', function (){
    if($(this).next().val() > 1) {
        if ($(this).next().val() > 1) $(this).next().val(+$(this).next().val() - 1);
    }
});

function resetRequest() {
    itemsTable.DataTable().ajax.reload();
    $('#toRequest-table > tbody').empty();
}

function more_details(data) {
    let items = '';

    data.items.map((item) => {
        items += `
            <tr>
                <td class="text-center">${item.name}</td>
                <td class="text-center">${item.description}</td>
                <td class="text-center">${item.quantity}</td>
            </tr>
        `;
    });

    let message = '';

    if(data.message != null) {
        message = `
            <p>
                <strong>Message:</strong> <br>
                ${data.message}
            </p>
        `;
    }

   return `
        <h5 class="text-center"><strong>Items Request/s (${data.items.length})</strong></h5>
        <table class="table border" style="width: 100%">
            <thead class="bg-light">
                <tr>
                    <th class="text-center">Name</th>
                    <th class="text-center">Description</th>
                    <th class="text-center">Quantity</th>
                </tr>
            </thead>
            <tbody>
                ${items}
            </tbody>
        </table>
        ${message}
   `;
}
