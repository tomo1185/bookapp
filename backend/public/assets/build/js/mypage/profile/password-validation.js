// password-inputの値とpattern属性を連動させる
$('#password-input').on('input', function(){
    $('#password-confirmation-input').prop('pattern', $(this).val())
});