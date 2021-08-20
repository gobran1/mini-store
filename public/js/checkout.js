Stripe.setPuplishableKey('pk_test_cQDXSfwfqRd49F4ha9FPoqxB00MBGLb4Lm');

var $form = $('#checkout-form');
console.log('$form.html()');

$form.submit(function (event) {
    $('#charge-error').addClass('hidden');
    $form.find('#submit-form').prop('disabled',true);

    Stripe.card.createToken({
        number : $('#card-number').val(),
        cvc : $('#card-cvc').val(),
        exp_month : $('#card-expiry-month').val(),
        exp_year : $('#card-expiry-year').val(),
        name : $('#card-name').val(),

    },stripeResponseHandler);

    return false;
});

function stripeResponseHandler(status , response){
    if(response.error){
        $('#charge-error').removeClass('hidden').text(response.error);

        $form.find('#submit-form').prop('disabled',false);
    }
    else {

        var token = response.id;

        $form.append($('<input type="hidden" name="stripeToken" >').val(token));
        $form.get(0).submit();
    }
}