const updateInfoForm = $('#update-info-form');
const updatePasswordForm = $('#update-password-form');

const updateInfoSubmitBtn = updateInfoForm.find('button[type="submit"]');
const updatePasswordSubmitBtn = updatePasswordForm.find('button[type="submit"]');

const api = '/api/';

$(function (){
    updateInfoForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api,
            type: 'POST',
            data: updateInfoForm.serialize(),
            dataType: 'JSON',
            success: function (response){
                Swal.fire('Success', response.message, 'success');
            },
            error: function (errorResponse){
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.errors) {
                    const error = errorJSON.errors;
                }
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(updateInfoSubmitBtn, 'Updating Information');
            },
            complete: function (){
                submitBtnAfterSend(updateInfoSubmitBtn, 'Update Information');
            }
        });
    });

    updatePasswordForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api,
            type: 'POST',
            data: updatePasswordForm.serialize(),
            dataType: 'JSON',
            success: function (response){
                Swal.fire('Success', response.message, 'success');
            },
            error: function (errorResponse){
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.errors) {
                    const error = errorJSON.errors;
                }
            },
            beforeSend: function (){
                removeInputValidationErrors();
                submitBtnBeforeSend(updatePasswordSubmitBtn, 'Updating Password');
            },
            complete: function (){
                submitBtnAfterSend(updatePasswordSubmitBtn, 'Update Password');
            }
        });
    });
});
