function  validator (options) {
    
    var formElement = document.querySelector(options.form);

    if (formElement) {
        options.rules.forEach(function (rules) {
            var inputElement = formElement.querySelector(rules.selector);
            var errorElement = inputElement.parentElement.querySelector('.form-mess')

            if (inputElement) {
                inputElement.onBlur = function() {
                    var errorMessage = rules.test(inputElement.value)
                    
                }
            }
        });
    }
}

validator.isRequired = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            return value.trim() ? undefined : 'Vui long nhap vao day';
        }
    };
}

validator.isEmail = function (selector) {
    return {
        selector: selector,
        test: function () {
            
        }
    };
}