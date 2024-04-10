let countPage = 0
        let pages = document.querySelectorAll('.page')


        for (let i = 0; i < pages.length; i++) {

            pages[i].addEventListener('click', function(event) {
                event.preventDefault();
                var newState = {
                    page: "index.php"
                };
                var newTitle = "Page 1";
                
                var newUrl = `${file}/index.php?page=${i+1}`;
              
                history.pushState(newState, newTitle, newUrl);
                document.title = newTitle;

                pagePag(i + 1)



            })
        }
 


        function pagePag(page) {

            var xmlhttp = new XMLHttpRequest();

            xmlhttp.open("GET", `index.php?page=${page}&noneload`, true);
            xmlhttp.send();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    document.querySelector("tbody").innerHTML = this.responseText;

                    deleBtn()
                }
            };


        }
        // document.querySelector('.page_1').addEventListener('click',pagePag)

        function deleBtn() {
            var deleteIcon = document.querySelectorAll('.delete_icon')

            deleteIcon.forEach(del => {

                del.addEventListener('click', function() {
                    
                    var idParent = del.closest('tr').id

                    var xmlhttp = new XMLHttpRequest();

                    xmlhttp.open("GET",'index.php?delete='+idParent, true);
                    xmlhttp.send();

                    xmlhttp.onreadystatechange = function() {
                        if (this.readyState == 4 && this.status == 200) {
                            document.querySelector('tbody').removeChild(
                                del.closest('tr')
                            )
                            
                        }
                    };
                })
            })
        }

        function searchProduct() {
            let str = document.querySelector("#search_input").value.trim()
            let search = str


            event.preventDefault();
                var newState = {
                    page: "index.php"
                };
                var newTitle = "Search";

                var newUrl = file+"/" +"index.php?search=" + search+"&page_search=1"
               
                history.pushState(newState, newTitle, newUrl);
                document.title = newTitle;

            
            if (search == "") {
                document.querySelector("tbody").innerHTML = "";
                let pageSearchBtn = document.querySelector('.pagination')
      
                let liPage = pageSearchBtn.querySelectorAll('li')
                
                for(let i =0; i< liPage.length; i++){
                    pageSearchBtn.removeChild(liPage[i])
                  
                }
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.open("GET", "index.php?search=" + search+"&page_search=1"+"&notloadpage", true);
                xmlhttp.send();

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        document.querySelector("tbody").innerHTML = this.responseText;
                       pageSearch()
                        deleBtn()
                    }
                };

            }

        }

      


            function pageSearch(){
                
                let pageSearchBtn = document.querySelector('.pagination')
      
            let liPage = pageSearchBtn.querySelectorAll('li')
            
            for(let i =0; i< liPage.length; i++){
                pageSearchBtn.removeChild(liPage[i])
              
            }

            let totalPage =document.querySelector('#total_search').value

            totalPage =Math.ceil(totalPage / 5)
           let totalLi =`<li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>` 

                    for(let j = 1; j<= totalPage; j++){
                        totalLi += `<li class="page-item"><a class="page-link page_search${j} page_search" href="">${j}</a></li>`
                    }
                    totalLi += `<li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>`
                   pageSearchBtn.innerHTML= totalLi

        
        


       
            let pageSearchBtnNew = document.querySelectorAll('.page_search')
       
            var sortby = document.querySelector('#search_input')
            
      
        
        for(let i =0; i<pageSearchBtnNew.length; i++){
            pageSearchBtnNew[i].addEventListener('click', function(event){
                let str = document.querySelector("#search_input").value.trim()
                
            

            event.preventDefault();
            
                var newState = {
                    page: "index.php"
                };
                var newTitle = "Search";

                var newUrl = file +"/index.php?"  + "&search=" +search+ "&page_search="+(i+1)
                history.pushState(newState, newTitle, newUrl);
                document.title = newTitle;


                var xmlhttp = new XMLHttpRequest();

            xmlhttp.open("GET", "index.php?"  + "&search=" +search+ "&page_search="+(i+1)+"&notloadpage",true)   
             xmlhttp.send();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    document.querySelector("tbody").innerHTML = this.responseText;
                    pageSearch()
                    deleBtn()
                    
                }
            };


            })
        }
            }





        deleBtn()

//filter ajax
        document.querySelector('#btn_filter').addEventListener('click', function (event) {

            var sortby = document.querySelector('#sort_by')
            var sort = document.querySelector('#sort')
            var category_filter = document.querySelector('#category_filter')
            var tag_filter = document.querySelector('#tag_filter')
            var day_from = document.querySelector('#day_from')
            var day_to = document.querySelector('#day_to')
            var price_from = document.querySelector('#price_from')
            var price_to = document.querySelector('#price_to')


            event.preventDefault();
                var newState = {
                    page: "index.php"
                };
                var newTitle = "Filter";

                var newUrl = file +"/index.php?"  + "&filter_search=" + "&page_filter=1"
               
                history.pushState(newState, newTitle, newUrl);
                document.title = newTitle;


            var xmlhttp = new XMLHttpRequest();

            xmlhttp.open("GET", "index.php?" + "sort_by=" + sortby.value 
            + "&page_filter=1"+ "&sort=" + sort.value + "&category=" + category_filter.value + "&tag=" 
            + tag_filter.value + "&day_from=" + day_from.value + "&day_to=" + day_to.value + "&price_from=" 
            + price_from.value + "&price_to=" + price_to.value + "&filter_search="+"&notload", true);
            xmlhttp.send();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    document.querySelector("tbody").innerHTML = this.responseText;
                    filterPage()
                    deleBtn()
                    
                }
            };



        })
       


        function filterPage(){
            let pageFilerBtn = document.querySelector('.pagination')
      
            let liPage = pageFilerBtn.querySelectorAll('li')
            
            for(let i =0; i< liPage.length; i++){
                pageFilerBtn.removeChild(liPage[i])
                
            }

            let totalPage =document.querySelector('#total_filter').value

            totalPage =Math.ceil(totalPage / 5)
           let totalLi =`<li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>` 

                    for(let j = 1; j<= totalPage; j++){
                        totalLi += `<li class="page-item"><a class="page-link page_filter${j} page_filter" href="">${j}</a></li>`
                    }
                    totalLi += `<li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>`
                    pageFilerBtn.innerHTML= totalLi

        
        


       
            let pageBtnNew = document.querySelectorAll('.page_filter')
       
        var sortby = document.querySelector('#sort_by')
            var sort = document.querySelector('#sort')
            var category_filter = document.querySelector('#category_filter')
            var tag_filter = document.querySelector('#tag_filter')
            var day_from = document.querySelector('#day_from')
            var day_to = document.querySelector('#day_to')
            var price_from = document.querySelector('#price_from')
            var price_to = document.querySelector('#price_to')
      
        
        for(let i =0; i<pageBtnNew.length; i++){
            pageBtnNew[i].addEventListener('click', function(event){


            event.preventDefault();
                var newState = {
                    page: "index.php"
                };
                var newTitle = "Filter";

                var newUrl = file +"/index.php?"  + "&filter_search=" + "&page_filter="+(i+1)
                history.pushState(newState, newTitle, newUrl);
                document.title = newTitle;


                var xmlhttp = new XMLHttpRequest();

            xmlhttp.open("GET", "index.php?" + "sort_by=" + sortby.value + "&page_filter="+(i+1)+ "&sort=" + sort.value + "&category=" + category_filter.value + "&tag=" + tag_filter.value + "&day_from=" + day_from.value + "&day_to=" + day_to.value + "&price_from=" + price_from.value + "&price_to=" + price_to.value + "&filter_search="+"&notload", true);
            xmlhttp.send();

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {

                    document.querySelector("tbody").innerHTML = this.responseText;
                    filterPage()
                    deleBtn()
                    
                }
            };


            })
        }
    }

    document.querySelector('#button-addon2').addEventListener('click', searchProduct)