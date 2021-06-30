{{-- Formファサードの email()メソッド --}}
{{Form::email(
    'inputEmail', null,
    [
        'class' => 'form-control',
        'id' => 'inputEmail',
        'placeholder' => 'Eメール'
    ]
    )
}}

{{-- Formファサードの password()メソッド --}}
{{Form::password(
    'inputPassword',
    [
        'class' => 'form-control',
        'id' => 'inputPassword',
        'placeholder' => 'パスワード'
    ]
)
}}

{{-- Formファサードの radio()メソッド --}}
{{Form::radio(
    'raidoGender', '女性', true,
    [
         'class'=>'custom-control-input',
         'id'=>'radioGender1'
    ]
)
}}