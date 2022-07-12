const addForm = $('#add-category-form');
const addModal = $('#add-category-modal');
const addSubmitBtn = addForm.find('button[type="submit"]');

const editForm = $('#edit-category-form');
const editModal = $('#edit-category-modal');
const editSubmitBtn = editForm.find('button[type="submit"]');

const api = '/api/category/';
const table = $('#categories-table');

$(function (){

    const categoriesDataTable = table.DataTable({
        'ajax': api,
        'columns': [
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'id'
            },
            {
                'className': 'text-center',
                'orderable': false,
                'data': 'name'
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

    addForm.on('submit', function (e) {
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

    editForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: api,
            type: 'PUT',
            data: editForm.serialize(),
            dataType: 'JSON',
            success: function (response) {
                resetForm(editForm);
                hideModal(editModal);
                reloadDataTable(table);
            },
            error: function (errorResponse) {
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.errors) {
                    const error = errorJSON.errors;
                    fieldValidation(formInput(editForm, 'input', 'name'), error.name);
                }
                if(errorJSON.error) {
                    editForm.find('#notification').html(alertMessage(errorJSON.error, 'danger'));
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

$(document).on('click', '#edit-category-btn', function () {
    const data = $(this).data();

    formInput(editForm, 'input', 'name').val(data.name);
    formInput(editForm, 'input', 'id').val(data.id);

    showModal(editModal);
});

$(document).on('click', '#delete-category-btn', function () {
    const data = $(this).data();

    showModal(deleteModal);
    formInput(deleteForm, 'input', 'id').val(data.id);
});
