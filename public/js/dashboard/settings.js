const updateInfoForm = $('#update-info-form');
const updatePasswordForm = $('#update-password-form');

const updateInfoSubmitBtn = updateInfoForm.find('button[type="submit"]');
const updatePasswordSubmitBtn = updatePasswordForm.find('button[type="submit"]');

const api = '/api/setting/';

$(function (){
    updateInfoForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: api + 'information',
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
                    fieldValidation(formInput(updateInfoForm, 'input', 'name'), error.name);
                    fieldValidation(formInput(updateInfoForm, 'input', 'designation'), error.designation);
                    fieldValidation(formInput(updateInfoForm, 'input', 'office'), error.office);
                    fieldValidation(formInput(updateInfoForm, 'input', 'email'), error.email);
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
            url: api+'password',
            type: 'POST',
            data: updatePasswordForm.serialize(),
            dataType: 'JSON',
            success: function (response){
                resetForm(updatePasswordForm);
                Swal.fire('Success', response.message, 'success');
            },
            error: function (errorResponse){
                const errorJSON = errorResponse.responseJSON;
                if(errorJSON.errors) {
                    const error = errorJSON.errors;
                    fieldValidation(formInput(updatePasswordForm, 'input', 'current_password'), error.current_password);
                    fieldValidation(formInput(updatePasswordForm, 'input', 'new_password'), error.new_password);
                    fieldValidation(formInput(updatePasswordForm, 'input', 'confirm_password'), error.confirm_password);
                }

                if(errorJSON.error) {
                    updatePasswordForm.find('#notification').html(alertMessage(errorJSON.error, 'danger'));
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
