const addForm = $('#add-employee-form');
const addSubmitBtn = addForm.find('button[type="submit"]');
const addModal = $('#add-employee-modal');

const editForm = $('#edit-employee-form');
const editSubmitBtn = editForm.find('button[type="submit"]');
const editModal = $('#edit-employee-modal');

const table =  $('#employees-table');
const api = '/api/employee/';

$(function (){

    const employeesDataTable = table.DataTable({
        'ajax': api,
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
            info: "Showing employees _START_ to _END_ of _TOTAL_",
            lengthMenu: 'Display <select class=\'form-select form-select-sm ms-1 me-1\'><option value="5">5</option><option value="10">10</option><option value="20">20</option><option value="-1">All</option></select> employees'
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
                    fieldValidation(formInput(addForm, 'input', 'designation'), error.designation);
                    fieldValidation(formInput(addForm, 'input', 'office'), error.office);
                    fieldValidation(formInput(addForm, 'input', 'email'), error.email);
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
                resetForm(editForm);
                hideModal(editModal);
                reloadDataTable(table);
            },
            error: function (errorResponse) {
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.errors) {
                    const error = errorJSON.errors;
                    fieldValidation(formInput(editForm, 'input', 'name'), error.name);
                    fieldValidation(formInput(editForm, 'input', 'designation'), error.designation);
                    fieldValidation(formInput(editForm, 'input', 'office'), error.office);
                    fieldValidation(formInput(editForm, 'input', 'email'), error.email);
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

});

$(document).on('click', '#edit-btn', function (){
    const data = $(this).data();

    formInput(editForm, 'input', 'name').val(data.name);
    formInput(editForm, 'input', 'designation').val(data.designation);
    formInput(editForm, 'input', 'office').val(data.office);
    formInput(editForm, 'input', 'email').val(data.email);
    formInput(editForm, 'input', 'id').val(data.id);

    showModal(editModal);
});

$(document).on('click', '#archive-btn', function (){
    const data = $(this).data();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, archive it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: api + 'archive',
                type: 'POST',
                data: {id: data.id},
                dataType: 'JSON',
                success: function (response) {
                    reloadDataTable(table);
                }
            });
        }
    })
});
