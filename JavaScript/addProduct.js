let submitBtn =document.querySelector('button[name=insert_product]')
  submitBtn.addEventListener('click', function(event){
    let invalid = document.querySelector('.invalid')
    if(invalid){
      event.preventDefault()
      document.querySelector('.form_add_message').innerText = 'Vui lòng nhập đầy đủ thông tin'
    }
  })