function alertMessage(message, type) {
    var alert = '';
    alert += '<div class="alert alert-'+ type +' alert-dismissible fade show" role="alert">';
        alert += '<i class="uil-info-circle"></i> ';
        alert += message;
    alert += '</div>';

    return alert;
}

function inputFeedback(message, type) {
    var feedback = '';
    feedback += '<div class="'+ type +'-feedback d-block">';
    feedback += message;
    feedback += '</div>';

    return feedback;
}

function fieldValidation(fieldElement, message) {
    if(message) {
        fieldElement.addClass('is-invalid');
        fieldElement.after(inputFeedback(message, 'invalid'));
    } else {
        fieldElement.removeClass('is-invalid');
    }
}
