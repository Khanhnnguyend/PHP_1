let submitBtn =document.querySelector('button[name=insert_product]')
  submitBtn.addEventListener('click', function(event){
    let invalid = document.querySelector('.invalid')
    if(invalid){
      event.preventDefault()
      document.querySelector('.form_add_message').innerText = 'Vui lòng đúng thông tin'
    }
  })


  const today = new Date();
const yyyy = today.getFullYear();
const mm = today.getMonth() + 1; 
const dd = today.getDate();

const formattedDate = `${yyyy}-${mm.toString().padStart(2, '0')}-${dd.toString().padStart(2, '0')}`;

document.querySelector('input[name=date]').value = formattedDate;