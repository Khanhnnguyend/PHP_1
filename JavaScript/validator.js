
function validator(options) {
    let formValidate = document.querySelector(options.form)
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

validator.isChooseOne = function (selector) {

    return {
        selector: selector,
        test: function (value) {
            let anySelect = document.querySelector(selector).querySelector('.select2-selection__choice')
            console.log(anySelect)
            return anySelect ? "Vui lòng chọn một!" : undefined
        }
    }
}

validator.onlyText = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            let regex = /^[a-z0-9A-ZàáạảãâầấậẩẫăắặằẳẵèéẹẻẽêềếệểễìíịỉĩòóọỏõôồốộổỗơớợởỡùúụủũưứựửữỳýỵỷỹđÀÁẠẢÃÂẦẤẬẨẪĂẮẶẰẲẴÈÉẸẺẼÊỀẾỆỂỄÌÍỊỈĨÒÓỌỎÕÔỒỐỘỔỖƠỚỢỞỠÙÚỤỦŨƯỨỰỬỮỲÝỴỶỸĐ\s]+$/
            return !regex.test(value.trim()) ? "Chỉ nhập chữ và số" : undefined
        }
    }
}

validator.isImage = function (selector) {
    return {
        selector: selector,
        test: function (value) {

            document.querySelector(selector).onchange = function () {
                let inputFile = document.querySelector(selector).value
                var file = inputFile.split(`\\`);
                let fileStr = file[file.length - 1]

                console.log(inputFile);
                let regex = /[^\s]+(.*?).(jpg|jpeg|png|gif|JPG|JPEG|PNG|GIF)$/
                console.log(regex.test(fileStr));
                return !regex.test(fileStr) ? "Vui lòng chọn file ảnh!" : undefined
            }


        }
    }
}
validator.isPositiveNumber = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            return value < 0 ? "Không được nhỏ hơn 0!" : undefined
        }
    }
}

validator.isDatePositive = function (selector) {
    return {
        selector: selector,
        test: function (value) {
            const date = new Date();

            const year = date.getFullYear();
            const month = date.getMonth() + 1;
            const day = date.getDate() ;

            const formattedDate = `${year}-${month}-${day+1}`;
            const dateCurent = Date.parse(formattedDate)
            const dateValue = Date.parse(value)
           
            return dateValue > dateCurent ? "Không được lớn hơn ngày hiện tại" : undefined
        }
    }
}