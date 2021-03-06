const addForm = $('#add-supply-form');
const addSubmitBtn = addForm.find('button[type="submit"]');
const addModal = $('#add-supply-modal');

const editForm = $('#edit-supply-form');
const editSubmitBtn = editForm.find('button[type="submit"]');
const editModal = $('#edit-supply-modal');

const criticalForm = $('#critical-form');
const criticalSubmitBtn = criticalForm.find('button[type="submit"]');
const criticalModal = $('#critical-modal');

const api = '/api/item/';
const table = $('#supplies-table');

$(function (){

    const suppliesDataTable = table.DataTable({
        'ajax': api + 'get-all/supply',
        'columns': [
            {
                'className':        'details-control',
                'orderable':        false,
                'data':             '',
                'defaultContent':   ''
            },
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
                'data': 'stock_editable'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'critical_editable'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'action'
            },
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
        order: [
            [1, "asc"]
        ],
        drawCallback: function() {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded"), $("#products-datatable_length label").addClass("form-label")
        }
    });

    $('#supplies-table tbody').on('click', 'td.details-control', function() {
        const tr = $(this).closest('tr');
        const row = suppliesDataTable.row( tr );

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child( more_details( row.data() ) ).show();
            tr.addClass('shown');
        }
    });

    addForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api,
            type: 'POST',
            data: addForm.serialize(),
            dataType: 'JSON',
            success: function (response) {
                resetForm(addForm);
                hideModal(addModal);
                reloadDataTable(table);
            },
            error: function (errorResponse) {
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.errors) {
                    const error = errorJSON.errors;
                    fieldValidation(formInput(addForm, 'input', 'name'), error.name);
                    fieldValidation(formInput(addForm, 'textarea', 'description'), error.description);
                }
            },
            beforeSend: function () {
                removeInputValidationErrors();
                submitBtnBeforeSend(addSubmitBtn, 'Adding');
            },
            complete: function () {
                submitBtnAfterSend(addSubmitBtn, 'Add');
            }
        });
    });

    editForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api,
            type: 'PUT',
            data: editForm.serialize(),
            dataType: 'JSON',
            success: function (response) {
                resetForm(addForm);
                hideModal(editModal);
                reloadDataTable(table);
            },
            error: function (errorResponse) {
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.errors) {
                    const error = errorJSON.errors;
                    fieldValidation(formInput(editForm, 'input', 'name'), error.name);
                    fieldValidation(formInput(editForm, 'textarea', 'description'), error.description);
                }
            },
            beforeSend: function () {
                removeInputValidationErrors();
                submitBtnBeforeSend(editSubmitBtn, 'Editing');
            },
            complete: function () {
                submitBtnAfterSend(editSubmitBtn, 'Edit');
            }
        });
    });

    criticalForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: api + 'set-critical',
            type: 'POST',
            data: criticalForm.serialize(),
            dataType: 'JSON',
            success: function (response) {
                resetForm(criticalForm);
                hideModal(criticalModal);
                reloadDataTable(table);
            },
            error: function (errorResponse) {
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.errors) {
                    const error = errorJSON.errors;
                    fieldValidation(formInput(criticalForm, 'input', 'critical'), error.critical);
                }
            },
            beforeSend: function () {
                removeInputValidationErrors();
                submitBtnBeforeSend(criticalSubmitBtn, 'Updating Value');
            },
            complete: function () {
                submitBtnAfterSend(criticalSubmitBtn, 'Update');
            }
        });
    });

    deleteForm.on('submit', function (e){
        e.preventDefault();
        deleteData(
            deleteForm,
            api,
            deleteForm.find('button[type="submit"]'),
            table
        );
    })

});

$(document).on('click', '#edit-btn', function () {
    const data = $(this).data();

    formInput(editForm, 'select', 'category_id').val(data.category_id);
    formInput(editForm, 'input', 'name').val(data.name);
    formInput(editForm, 'textarea', 'description').val(data.description);
    formInput(editForm, 'input', 'id').val(data.id);

    showModal(editModal);
});

$(document).on('click', '#delete-btn', function () {
    const data = $(this).data();

    showModal(deleteModal);
    formInput(deleteForm, 'input', 'id').val(data.id);
});

$(document).on('click', '#critical-btn', function () {
    const data = $(this).data();
    formInput(criticalForm, 'input', 'item_id').val(data.id);
    formInput(criticalForm, 'input', 'name').val(data.name);
    formInput(criticalForm, 'input', 'critical').val(data.critical);
    showModal(criticalModal);
});

function more_details(data) {
    return  '<div class="">'+
                '<p><strong>Description:</strong><br>'+
                    data.description+
                '</p>'+
            '</div>';

}
