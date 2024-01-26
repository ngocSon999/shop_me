Validator({
    form: '#form-add',
    nextStep: '#submit-add',
    formGroupSelector: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('input[name=first_name]', 'Vui lòng không để trống trường này'),
        Validator.isRequired('input[name=email]', 'Vui lòng không để trống trường này'),
        Validator.isEmail('input[name=email]'),
        Validator.isRequired('input[name=phone]', 'Vui lòng không để trống trường này'),
        Validator.isRequired('select[name=role]', 'Vui lòng không để trống trường này'),
        Validator.isRequired('input[name=password]', 'Vui lòng không để trống trường này'),
        Validator.minLength('input[name=password]', 6),
        Validator.maxLength('input[name=password]', 32),
    ],
});
Validator({
    form: '#form-edit',
    nextStep: '#submit-edit',
    formGroupSelector: '.form-group',
    errorSelector: '.form-message',
    rules: [
        Validator.isRequired('input[name=first_name]', 'Vui lòng không để trống trường này'),
        Validator.isRequired('input[name=email]', 'Vui lòng không để trống trường này'),
        Validator.isEmail('input[name=email]'),
        Validator.isRequired('input[name=phone]', 'Vui lòng không để trống trường này'),
        Validator.isRequired('select[name=role]', 'Vui lòng không để trống trường này'),
        Validator.isNotNullPassword('input[name=password]', 6, 32),
    ],
});
