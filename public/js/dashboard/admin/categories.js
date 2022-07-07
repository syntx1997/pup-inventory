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
        "lengthChange": false,
        "orderable": false,
        "info": false
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

});

$(document).on('click', '#edit-category-btn', function () {
    const data = $(this).data();

    formInput(editForm, 'input', 'name').val(data.name);
    formInput(editForm, 'input', 'id').val(data.id);

    showModal(editModal);
});

$(document).on('click', '#delete-category-btn', function () {
    const data = $(this).data();
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: api,
                type: 'DELETE',
                data: {id: data.id},
                dataType: 'JSON',
                success: function (response) {
                    reloadDataTable(table);
                }
            });
        }
    })
});
