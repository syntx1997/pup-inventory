const loginForm = $('#login-form');
const loginSubmitBtn = loginForm.find('button[type="submit"]');

$(function (){
    loginForm.on('submit', function (e){
        e.preventDefault();
        $.ajax({
            url: '/auth/login',
            type: 'POST',
            data: loginForm.serialize(),
            dataType: 'JSON',
            success: function (response) {
                $(alertMessage(response.message, 'success')).insertBefore(loginForm);
                setInterval(function () {
                    window.location.href = response.link;
                }, 2000);
            },
            error: function (errorResponse) {
                const errorJSON = errorResponse.responseJSON;
                $(alertMessage(errorJSON.message, 'danger')).insertBefore(loginForm);
            },
            beforeSend: function () {
                $('.alert').remove();
                loginSubmitBtn.attr('disabled', 'disabled');
                loginSubmitBtn.html(spinner + ' Loggin In');
            },
            complete: function () {
                loginSubmitBtn.attr('disabled', false);
                loginSubmitBtn.html('Login');
            }
        });
    });
});

function password_show_hide() {
    const x = document.getElementById("password");
    const show_eye = document.getElementById("show_eye");
    const hide_eye = document.getElementById("hide_eye");
    hide_eye.classList.remove("d-none");
    if (x.type === "password") {
        x.type = "text";
        show_eye.style.display = "none";
        hide_eye.style.display = "block";
    } else {
        x.type = "password";
        show_eye.style.display = "block";
        hide_eye.style.display = "none";
    }
}
