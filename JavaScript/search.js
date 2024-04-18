function showProduct() {


  let str = document.querySelector("#search_input").value.trim()
  if (str == "") {
      document.querySelector("tbody").innerHTML = "";
      return;
  } else {
      var xmlhttp = new XMLHttpRequest();

      xmlhttp.open("GET", "index.php?search=" + str, true);
      xmlhttp.send();

      xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {

              document.querySelector("tbody").innerHTML = this.responseText;
          }
      };

  }
}
