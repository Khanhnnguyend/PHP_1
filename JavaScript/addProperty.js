

  let submitTagBtn =document.querySelector('button[name=add_tag]')
  submitTagBtn.addEventListener('click', function(event){
    let formTag = document.querySelector('#add_tag_form')
    let invalidTag = formTag.querySelector('.invalid')
    if(invalidTag){
      
      event.preventDefault()
      document.querySelector('.form_add_tag').innerText = 'Vui lòng nhập đầy đủ thông tin'
    }
  })

  let submitCatBtn =document.querySelector('button[name=add_cat]')
  submitCatBtn.addEventListener('click', function(event){
    let formCat = document.querySelector('#add_cat_form')
    let invalidCat = formCat.querySelector('.invalid')
    
    if(invalidCat){
      console.log(invalidCat)
      event.preventDefault()
      document.querySelector('.form_add_cat').innerText = 'Vui lòng nhập đầy đủ thông tin'
    }
  })

