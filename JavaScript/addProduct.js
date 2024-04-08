let submitBtn =document.querySelector('button[name=insert_product]')
  submitBtn.addEventListener('click', function(event){
    let invalid = document.querySelector('.invalid')
    if(invalid){
      event.preventDefault()
      document.querySelector('.form_add_message').innerText = 'Vui lòng nhập đầy đủ thông tin'
    }
  })

  let tagBlock  =document.querySelector('.tag-select')
  let selectTag =document.querySelector('#multiple-select-field-tag')
  let spanSelect =tagBlock.querySelector('input')
  let messageTag=tagBlock.querySelector('.form-message')

  
  spanSelect.addEventListener("blur", function(){
    
    let tagSelect =tagBlock.querySelector('.select2-selection__choice')
    if(tagSelect){
      messageTag.innerText = ""
      selectTag.classList.remove('invalid')
    }
    else 
    {
      messageTag.innerText = "Vui lòng chọn Tags"
      selectTag.classList.add('invalid')
    }
  })


  let catBlock  =document.querySelector('.cat-select')
  let selectCat =document.querySelector('#multiple-select-field-cat')
  let spanCatSelect =catBlock.querySelector('input')
  let messageCat=catBlock.querySelector('.form-message')

  spanCatSelect.addEventListener("blur", function(){
    
    let catSelect =catBlock.querySelector('.select2-selection__choice')
    if(catSelect){
      messageCat.innerText = ""
      selectCat.classList.remove('invalid')
    }
    else 
    {
      messageCat.innerText = "Vui lòng chọn Categories"
      selectCat.classList.add('invalid')
    }
  })