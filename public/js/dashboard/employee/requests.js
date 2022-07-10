const requestForm = $('#request-form');
const requestSubmitBtn = requestForm.find('button[type="submit"]');

const itemTypeSelect = $('select[name="type"]');
const itemsTable = $('#items-table');
const api = '/api/item/';
const reqAPI = '/api/request/';

$(function (){
    const itemsDataTable = itemsTable.DataTable({
        'ajax': api + 'get-all/supply',
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
                            '<tr id="row-'+row.id+'">' +
                            '<td class="text-center">'+ row.category +' <input type="hidden" name="item['+row.id+'][category]" value="'+row.category+'"></td>'+
                            '<td class="text-center">'+ row.name +' <input type="hidden" name="item['+row.id+'][name]" value="'+row.name+'"</td>'+
                            '<td class="text-center">'+ row.description +'</td>'+
                            '<td class="text-center">'+ row.stock +'</td>'+
                            '<td class="text-center">'+
                            '<div class="input-group input-group-sm flex-nowrap">'+
                            '<span class="input-group-text sub border-dark" id="addon-wrapping">-</span>'+
                            '<input id="quantity" name="item['+row.id+'][quantity]" type="number" class="form-control text-center border-dark bg-white" min="1" max="'+ row.stock +'" value="1" style="width: 20px !important" required readonly>'+
                            '<span class="input-group-text add border-dark" id="addon-wrapping">+</span>'+
                            '</div>'+
                            '</td>'+
                            '<td class="text-center"><button id="delete-req-item-btn" type="button" class="btn btn-link"><i class="uil-trash text-danger"></i></button></td>'+
                            '</tr>>'
                        );
                        console.log(1);
                    } else {
                        console.log(0);
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
        itemsTable.DataTable().ajax.reload();
        $('#toRequest-table > tbody').empty();
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
                console.log(response);
            },
            error: function (errorResponse){
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.message) {
                    Swal.fire('Error', errorJSON.message, 'error');
                }
            },
            beforeSend: function () {

            },
            complete: function () {

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
    console.log(1);
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
