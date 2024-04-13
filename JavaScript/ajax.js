const regex = /^[0-9]+$/;
let countPage = 0
let pages = document.querySelectorAll('.page')


for (let i = 0; i < pages.length; i++) {

    pages[i].addEventListener('click', function (event) {
        event.preventDefault();
        var newState = {
            page: "index.php"
        };
        var newTitle = "Page 1";

        var newUrl = `${file}/index.php?page=${i + 1}`;

        history.pushState(newState, newTitle, newUrl);
        document.title = newTitle;
        document.querySelector('.page-present').innerText = i + 1;

        pagePag(i + 1)



    })
}



function pagePag(page) {

    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", `index.php?page=${page}&noneload`, true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            document.querySelector("tbody").innerHTML = this.responseText;

            deleBtn()
        }
    };


}


function deleBtn() {
    var deleteIcon = document.querySelectorAll('.delete_icon')

    deleteIcon.forEach(del => {

        del.addEventListener('click', function (event) {


            var idParent = del.closest('tr').id
            if (!regex.test(idParent)) {

                return
            }

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.open("GET", 'index.php?delete=' + idParent, true);
            xmlhttp.send();

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText = 'success') {

                        pagePag(document.querySelector('.page-present').innerText)
                    }



                }
            };
        })
    })
}



function deleBtnFilter() {
    var deleteIcon = document.querySelectorAll('.delete_icon')

    deleteIcon.forEach(del => {

        del.addEventListener('click', function (event) {

          
            var idParent = del.closest('tr').id
            if (!regex.test(idParent)) {

                return
            }

            var xmlhttp = new XMLHttpRequest();

          

            xmlhttp.open("GET", 'index.php?delete=' + idParent, true);
            xmlhttp.send();

            var sortby = document.querySelector('#sort_by')
            var sort = document.querySelector('#sort')
            var category_filter = document.querySelector('#category_filter')
            var tag_filter = document.querySelector('#tag_filter')
            var day_from = document.querySelector('#day_from')
            var day_to = document.querySelector('#day_to')
            var price_from = document.querySelector('#price_from')
            var price_to = document.querySelector('#price_to')
            let str = document.querySelector("#search_input").value.trim()
    let search = str

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText = 'success') {
                        xmlhttp.open("GET", "index.php?" + "sort_by=" + sortby.value
                            + "&page_filter=" + document.querySelector('.page-present').innerText
                            + "&search=" + search
                            + "&sort=" + sort.value
                            + "&category=" + category_filter.value
                            + "&tag=" + tag_filter.value
                            + "&day_from=" + day_from.value
                            + "&day_to=" + day_to.value
                            + "&price_from=" + price_from.value
                            + "&price_to=" + price_to.value
                            + "&filter_search=" + "&notload", true);
                        xmlhttp.send();

                        xmlhttp.onreadystatechange = function () {
                            if (this.readyState == 4 && this.status == 200) {

                                document.querySelector("tbody").innerHTML = this.responseText;

                                filterPage()
                                deleBtnFilter()
                            }
                        };



                    }
                };
            }


        })
    })
}


deleBtn()

//filter ajax
var filterSearch = function () {

    var sortby = document.querySelector('#sort_by')
    var sort = document.querySelector('#sort')
    var category_filter = document.querySelector('#category_filter')
    var tag_filter = document.querySelector('#tag_filter')
    var day_from = document.querySelector('#day_from')
    var day_to = document.querySelector('#day_to')
    var price_from = document.querySelector('#price_from')
    var price_to = document.querySelector('#price_to')
    let str = document.querySelector("#search_input").value.trim()
    let search = str





    var xmlhttp = new XMLHttpRequest();

    xmlhttp.open("GET", "index.php?"
        + "sort_by=" + sortby.value
        + "&page_filter=1"
        + "&search=" + search
        + "&sort=" + sort.value
        + "&category=" + category_filter.value
        + "&tag=" + tag_filter.value
        + "&day_from=" + day_from.value
        + "&day_to=" + day_to.value
        + "&price_from=" + price_from.value
        + "&price_to=" + price_to.value
        + "&filter_search="
        + "&notload", true);
    xmlhttp.send();

    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {

            document.querySelector("tbody").innerHTML = this.responseText;
            filterPage()
            deleBtnFilter()

        }
    };



}


function filterPage() {
    let pageFilerBtn = document.querySelector('.pagination')

    let liPage = pageFilerBtn.querySelectorAll('li')

    for (let i = 0; i < liPage.length; i++) {
        pageFilerBtn.removeChild(liPage[i])

    }

    let totalPage = document.querySelector('#total_filter').value

    totalPage = Math.ceil(totalPage / 5)
    
     var totalLi =""
    for (let j = 1; j <= totalPage; j++) {
        totalLi += `<li class="page-item"><a class="page-link page_filter${j} page_filter" href="#">${j}</a></li>`
    }
    if(totalLi != "")
    pageFilerBtn.innerHTML = totalLi

    let pageBtnNew = document.querySelectorAll('.page_filter')
    var sortby = document.querySelector('#sort_by')
    var sort = document.querySelector('#sort')
    var category_filter = document.querySelector('#category_filter')
    var tag_filter = document.querySelector('#tag_filter')
    var day_from = document.querySelector('#day_from')
    var day_to = document.querySelector('#day_to')
    var price_from = document.querySelector('#price_from')
    var price_to = document.querySelector('#price_to')
    let str = document.querySelector("#search_input").value.trim()
    let search = str


    for (let i = 0; i < pageBtnNew.length; i++) {
        pageBtnNew[i].addEventListener('click', function (event) {
           
            document.querySelector('.page-present').innerText = i + 1;

            console.log("chạy btn" +document.querySelector('.page-present').innerText);

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.open("GET", "index.php?"
                + "sort_by=" + sortby.value
                + "&page_filter=" + (i + 1)
                + "&search=" + search
                + "&sort=" + sort.value
                + "&category=" + category_filter.value
                + "&tag=" + tag_filter.value
                + "&day_from=" + day_from.value
                + "&day_to=" + day_to.value
                + "&price_from=" + price_from.value
                + "&price_to=" + price_to.value
                + "&filter_search", true);
            xmlhttp.send();

            xmlhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                 
                    document.querySelector("tbody").innerHTML = this.responseText;
                 
                    filterPage()
                    deleBtnFilter()

                }
            };


        })
    }
}

document.querySelector('#btn_filter').addEventListener('click', filterSearch)
document.querySelector('#button-addon2').addEventListener('click', filterSearch)