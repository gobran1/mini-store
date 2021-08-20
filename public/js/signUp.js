var checkedPassword = function(event)
{
    var password = $('#register-form input[name="password"]').val(),
        $confirmedPassword = $('#register-form input[name="confirmedPassword"]'),
        confirmedPassword = $confirmedPassword.val();

    if(password !== confirmedPassword){
        event.preventDefault();
        $confirmedPassword.parent().addClass('has-error').removeClass('has-success');
    }
    else{
        $confirmedPassword.parent().addClass('has-success').removeClass('has-error');
    }
    event.stopPropagation();

};

$('#submit').on('click',checkedPassword);

$('#register-form input[name="confirmedPassword"]').on('keyup', checkedPassword);

$('#register-form input[name="password"]').on('focusout', function(event) {
    checkedPassword(event);
    $('#register-form input[name="confirmedPassword"]').trigger('focus');
});