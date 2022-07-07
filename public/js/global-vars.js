const spinner = '<div class="spinner-border spinner-border-sm" role="status">'+
    '<span class="visually-hidden">Loading...</span>'+
    '</div>';

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

