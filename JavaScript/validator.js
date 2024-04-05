
function validator(options) {
    var selectorRules = {}
    function validate(inputElement, rule) {
        let errorElement = inputElement.parentElement.querySelector('.form-message')
        var errorMessage

        var rules = selectorRules[rule.selector]



        for (var i = 0; i < rules.length; i++) {



            errorMessage = rules[i](inputElement.value)
            if (errorMessage) {
                break
            }
        }
        if (errorMessage) {

            errorElement.innerText = errorMessage

            inputElement.classList.add('invalid')
        } else {
            errorElement.innerText = ''
            inputElement.classList.remove('invalid')
        }
    }
    let formValidate = document.querySelector(options.form)

    if (formValidate) {
        options.rules.forEach(rule => {



            if (Array.isArray(selectorRules[rule.selector])) {
                selectorRules[rule.selector].push(rule.test)
            } else {
                selectorRules[rule.selector] = [rule.test];
            }
            let inputElement = formValidate.querySelector(rule.selector)


            if (inputElement) {
                inputElement.onblur = function () {
                    validate(inputElement, rule)


                }

                inputElement.oninput = function () {

                    let errorElement = formValidate.parentElement.querySelector('.form-message')

                    errorElement.innerText = ''
                    inputElement.classList.remove('invalid')
                }
            }
        });
    }

}

validator.isRequired = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            return value.trim() == "" ? "Vui lòng nhập trường này!" : undefined
        }
    }
}

validator.isNumber = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            return regex.test(value.trim()) == "" ? "Vui lòng nhập trường này!" : undefined
        }
    }
}