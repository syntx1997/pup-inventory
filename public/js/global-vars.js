const spinner = '<div class="spinner-border spinner-border-sm" role="status">'+
    '<span class="visually-hidden">Loading...</span>'+
    '</div>';

const deleteModal = $('#delete-modal');
const deleteForm = $('#delete-form');

function removeInputValidationErrors() {
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    $('#notification').html('');
}

function submitBtnBeforeSend(button, text) {
    button.attr('disabled', 'disabled');
    button.html(spinner + ' ' + text);
}

function submitBtnAfterSend(button, text) {
    button.attr('disabled', false);
    button.html(text);
}

function formInput(form, type, name) {
    return form.find(type + '[name="'+ name +'"]');
}

function resetForm(form) {
    form[0].reset();
}

function hideModal(modal) {
    modal.modal('hide');
}

function showModal(modal) {
    modal.modal('show');
}

function reloadDataTable(table) {
    table.DataTable().ajax.reload(null);
}

function deleteData(form,api, submitBtn, table) {
    $.ajax({
        url: api,
        type: 'DELETE',
        data: form.serialize(),
        dataType: 'JSON',
        success: function (response) {
            reloadDataTable(table);
            hideModal(deleteModal);
        },
        error: function (errorResponse) {
            const errorJSON = errorResponse.responseJSON;
            if(errorJSON.errors) {
                const error = errorJSON.errors;
                fieldValidation(formInput(form, 'input', 'password'), error.password);
            }
        },
        beforeSend: function () {
            removeInputValidationErrors();
            submitBtnBeforeSend(submitBtn, 'Deleting');
        },
        complete: function () {
            submitBtnAfterSend(submitBtn, 'Delete');
        }
    });
}

