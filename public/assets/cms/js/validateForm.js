// Đối tượng `Validator`
function Validator(options) {
    function getParent(element, selector) {
        while (element.parentElement) {
            if (element.parentElement.matches(selector)) {
                return element.parentElement;
            }
            element = element.parentElement;
        }
    }

    let selectorRules = {};

    // Hàm thực hiện validate
    function validate(inputElement, rule) {
        let errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
        let errorMessage;

        // Lấy ra các rules của selector
        let rules = selectorRules[rule.selector];

        // Lặp qua từng rule & kiểm tra
        // Nếu có lỗi thì dừng việc kiểm
        for (let i = 0; i < rules.length; ++i) {
            switch (inputElement.type) {
                case 'radio':
                case 'checkbox':
                    errorMessage = rules[i](
                        formElement.querySelector(rule.selector + ':checked')
                    );
                    break;
                default:
                    errorMessage = rules[i](inputElement.value);
            }
            if (errorMessage) break;
        }

        if (errorMessage) {
            errorElement.innerText = errorMessage;
            getParent(inputElement, options.formGroupSelector).classList.add('invalid');
        } else {
            errorElement.innerText = '';
            getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
        }

        return !errorMessage;
    }

    // Lấy element của form cần validate
    let formElement = document.querySelector(options.form);
    if (formElement) {
        // Khi submit form
        formElement.onsubmit = function (e) {
            e.preventDefault();

            let isFormValid = true;
            // Lặp qua từng rules và validate
            options.rules.forEach(function (rule) {
                let inputElement = formElement.querySelector(rule.selector);
                let isValid = validate(inputElement, rule);
                if (!isValid) {
                    isFormValid = false;
                }
            });

            if (isFormValid) {
                // Trường hợp submit với javascript
                formElement.submit();
            }
        }

        // Lặp qua mỗi rule và xử lý (lắng nghe sự kiện blur, input, ...)
        options.rules.forEach(function (rule) {
            // Lưu lại các rules cho mỗi input
            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test);
            } else {
                selectorRules[rule.selector] = [rule.test];
            }
            let inputElements = formElement.querySelectorAll(rule.selector);
            Array.from(inputElements).forEach(function (inputElement) {
                // Xử lý trường hợp blur khỏi input
                inputElement.onblur = function () {
                    validate(inputElement, rule);
                }
                // Xử lý mỗi khi người dùng nhập vào input
                inputElement.oninput = function () {
                    let errorElement = getParent(inputElement, options.formGroupSelector).querySelector(options.errorSelector);
                    errorElement.innerText = '';
                    getParent(inputElement, options.formGroupSelector).classList.remove('invalid');
                }
            });
        });
    }
}



// Định nghĩa rules
// Nguyên tắc của các rules:
// 1. Khi có lỗi => Trả ra message lỗi
// 2. Khi hợp lệ => Không trả ra cái gì cả (undefined)
Validator.isRequired = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            return value.trim() ? undefined : message || 'Vui lòng không để trống trường này'
        }
    };
}
Validator.minLength = function (selector, min, message) {
    return {
        selector: selector,
        test: function (value) {
            if (value) {
                return value.length >= min ? undefined : message || `Vui lòng nhập tối thiểu ${min} ký tự`;
            } else {
                // Không thực hiện kiểm tra nếu giá trị không tồn tại
                return undefined;
            }
        }
    };
}

Validator.maxLength = function (selector, max, message) {
    return {
        selector: selector,
        test: function (value) {
            if (value) {
                return value.length <= max ? undefined : message || `Giá trị nhập vào phải nhở hơn ${max} ký tự`;
            } else {
                return undefined;
            }
        }
    };
}

Validator.isNotNullPassword = function (selector, min, max) {
    return {
        selector: selector,
        test: function (value) {
            if (value !== null && value !== undefined && value !== '') {
               if (value.length < min) {
                   return `Vui lòng nhập tối thiểu ${min} ký tự`;
               } else if (value.length > max) {
                   return `Giá trị nhập vào phải nhở hơn ${max} ký tự`;
               }
            }
        }
    };
}

Validator.isQuantity = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            if (value < 0) {
                return message || 'valor no válido'
            }
        }
    };
}

Validator.isEmail = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            let regex = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
            return regex.test(value) ? undefined : message || 'Địa chỉ email không hợp lệ';
        }
    };
}

Validator.isConfirmed = function (selector, getConfirmValue, message) {
    return {
        selector: selector,
        test: function (value) {
            return value === getConfirmValue() ? undefined : message || 'El valor ingresado es incorrecto';
        }
    }
}

Validator.isNumberPositive = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            const isPositiveInteger = /^[0-9]\d*$/.test(value);

            if (!isPositiveInteger) {
                return message || 'Valor no válido';
            }
        }
    };
}

Validator.isTimeValid = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            const currentForm = $(selector).parents('form');
            const startTime = currentForm.find('input[name=time_start]').val();

            const timeStart = Date.parse(startTime);
            const timeEnd = Date.parse(value);

            return timeStart <= timeEnd ? undefined : message || `End time must be greater than or equal to start time.`;
        }
    };
};

Validator.isTimeEditValid = function (selector, message) {
    return {
        selector: selector,
        test: function (value) {
            const currentForm = $(selector).parents('form');
            const startTime = currentForm.find('#startEdit').val();

            const timeStart = Date.parse(startTime);
            const timeEnd = Date.parse(value);

            return timeStart <= timeEnd ? undefined : message || `End time must be greater than or equal to start time.`;
        }
    };
};
