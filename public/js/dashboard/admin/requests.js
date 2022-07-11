const acceptForm = $('#accept-form');
const declineForm = $('#decline-form');

const acceptSubmitBtn = acceptForm.find('button[type="submit"]');
const declineSubmitBtn = declineForm.find('button[type="submit"]');

const acceptModal = $('#accept-modal');
const declineModal = $('#decline-modal');

const requestsTable = $('#requests-table');
const api = '/api/request/';

$(function (){
    const requestsDataTable = requestsTable.DataTable({
        'ajax': api+'all',
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
                'data': 'actions'
            }
        ],
        language: {
            paginate: {
                previous: "<i class='mdi mdi-chevron-left'>",
                next: "<i class='mdi mdi-chevron-right'>"
            },
            info: "Showing requests _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> requests'
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

    acceptForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api+'accept',
            type: 'POST',
            data: acceptForm.serialize(),
            dataType: 'JSON',
            success: function (response){
                hideModal(acceptModal);
                reloadDataTable(requestsTable);
                Swal.fire('Accepted', response.message, 'success');
            },
            error: function (errorResponse){
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.errors) {
                    const error = errorJSON.errors;
                }
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(acceptSubmitBtn, 'Accepting');
            },
            complete: function (){
                submitBtnAfterSend(addSubmitBtn, 'Accept');
            }
        });
    });

    declineForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api+'decline',
            type: 'POST',
            data: declineForm.serialize(),
            dataType: 'JSON',
            success: function (response){
                hideModal(declineModal);
                reloadDataTable(requestsTable);
                Swal.fire('Declined', response.message, 'success');
            },
            error: function (errorResponse){
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.errors) {
                    const error = errorJSON.errors;
                    fieldValidation(formInput(declineForm, 'textarea', 'message'), error.message);
                }
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(declineSubmitBtn, 'Declining');
            },
            complete: function (){
                submitBtnAfterSend(declineSubmitBtn, 'Decline');
            }
        });
    });
});

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
   `;
}

$(document).on('click', '#accept-btn', function (){
    const data = $(this).data();
    acceptForm.find('#transaction-id-text').text(data.transaction_id);
    acceptForm.find('#requestor-text').text(data.requestor);
    formInput(acceptForm, 'input', 'id').val(data.id);
    showModal(acceptModal);
});

$(document).on('click', '#decline-btn', function (){
    const data = $(this).data();
    declineForm.find('#transaction-id-text').text(data.transaction_id);
    declineForm.find('#requestor-text').text(data.requestor);
    formInput(declineForm, 'input', 'id').val(data.id);
    showModal(declineModal);
});
