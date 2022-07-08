const restockForm = $('#restock-form');
const restockSubmitBtn = restockForm.find('button[type="submit"]');
const restockModal = $('#restock-modal');

$(function () {
    restockForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: api + 'restock',
            type: 'POST',
            data: restockForm.serialize(),
            dataType: 'JSON',
            success: function (response) {
                resetForm(restockForm);
                hideModal(restockModal);
                reloadDataTable(table);
            },
            error: function (errorResponse) {
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.errors) {
                    const error = errorJSON.errors;
                    fieldValidation(formInput(restockForm, 'input', 'quantity'), error.quantity);
                    fieldValidation(formInput(restockForm, 'input', 'cost'), error.cost);
                    fieldValidation(formInput(restockForm, 'input', 'supplier'), error.supplier);
                }
            },
            beforeSend: function () {
                removeInputValidationErrors();
                submitBtnBeforeSend(restockSubmitBtn, 'Adding Stock');
            },
            complete: function () {
                submitBtnAfterSend(restockSubmitBtn, 'Add Stock');
            }
        });
    });
});

$(document).on('click', '#restock-btn', function () {
    const data = $(this).data();
    formInput(restockForm, 'input', 'item_id').val(data.id);
    formInput(restockForm, 'input', 'name').val(data.name);
    formInput(restockForm, 'input', 'stock').val(data.stock);
    showModal(restockModal);
});
