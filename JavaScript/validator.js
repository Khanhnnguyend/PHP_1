
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
            let regex = /^[a-z0-9A-ZÃ€ÃÃ‚ÃƒÃˆÃ‰ÃŠÃŒÃÃ’Ã“Ã”Ã•Ã™ÃšÄ‚ÄÄ¨Å¨Æ Ã Ã¡Ã¢Ã£Ã¨Ã©ÃªÃ¬Ã­Ã²Ã³Ã´ÃµÃ¹ÃºÄƒÄ‘Ä©Å©Æ¡Æ¯Ä‚áº áº¢áº¤áº¦áº¨áºªáº¬áº®áº°áº²áº´áº¶áº¸áººáº¼á»€á»€á»‚áº¾Æ°Äƒáº¡áº£áº¥áº§áº©áº«áº­áº¯áº±áº³áºµáº·áº¹áº»áº½á»á»á»ƒáº¿á»„á»†á»ˆá»Šá»Œá»Žá»á»’á»”á»–á»˜á»šá»œá»žá» á»¢á»¤á»¦á»¨á»ªá»…á»‡á»‰á»‹á»á»á»‘á»“á»•á»—á»™á»›á»á»Ÿá»¡á»£á»¥á»§á»©á»«á»¬á»®á»°á»²á»´Ãá»¶á»¸á»­á»¯á»±á»³á»µá»·á»¹\s\W|_]+$/;
            return regex.test(value.trim()) ? "Chỉ nhập chữ" : undefined
        }
    }
}

validator.isImage = function (selector){
    return {
        selector: selector,
        test: function (value) {
            let inputFile = document.querySelector(selector).value
            console.log(inputFile)
            let regex = /[\/.](gif|jpg|jpeg|tiff|png)$/i;
            return regex.test(inputFile) ? "Vui chọn ảnh!" : undefined
        }
    }
}