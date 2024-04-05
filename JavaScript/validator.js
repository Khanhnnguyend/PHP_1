function validator(option){
    let formValidate = document.querySelector(option.form)


}

validator.isRequired =  function(selector){
    return {
        selector : selector,
        test: function (value) {
            return value.trim() == "" ? "Vui lòng nhập trường này!" : undefined
        }
    }
}

validator.isNumber =  function(selector){
    return {
        selector : selector,
        test: function (value) {
            return regex.test(value.trim())  == "" ? "Vui lòng nhập trường này!" : undefined
        }
    }
}