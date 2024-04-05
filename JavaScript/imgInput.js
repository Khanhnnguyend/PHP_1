const file = document.getElementById('file').files[0];
// if (!file.type.match('image.*')) {
//     return;
//   }

const inputImg = document.querySelector("#file")
const previewImage =  function(){
    console.log(2);
    const reader = new FileReader();
reader.onload = function(event) {
    var img = new Image();
    img.src = event.target.result;
    document.getElementById('image').innerHTML = '';
        console.log("anh");
        document.getElementById('image').appendChild(img);

};

// reader.readAsDataURL(file);
}
  
