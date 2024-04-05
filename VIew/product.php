<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://localhost/PHP_1/CSS/product.css">


    </script>
    <title>Product</title>
</head>

<body>
    <div class="container">

        <div class="p-4 mt-3" style="border: 1px solid #ced4da;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
            <div class="row">
                <div class="col">
                    <a class="link_" href="index.php?controller=add_product"><button type="button" class="btn btn-primary btn-sm">Add product</button></a>

                    <a href="index.php?controller=add_property"><button type="button" class="btn btn-primary btn-sm">Add property</button></a>
                    <a href=""><button type="button" class="btn btn-primary btn-sm">Sync from VillaTheme</button></a>


                </div>
                <div class="col">
                    <form action="" onsubmit="return false">
                        <div class="input-group mb-3" style="border: 1px solid #ced4da;">

                            <input id="search_input" name="search" type="text" class="form-control border-0" placeholder="Search product">
                            <button class="btn border-0 rounded-circle bg-secondary text-white" id="button-addon2">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>


                        </div>
                    </form>
                </div>
            </div>
            <div class="row">
                <form class="row" action="" onsubmit="return false">

                    <div class="col">

                        <select class="form-select" id="sort_by" name="sort_by">
                            <option value="date" selected>Date</option>
                            <option value="price">Price</option>
                            <option value="product_name">Name</option>

                        </select>

                    </div>

                    <div class="col">

                        <select class="form-select" id="sort" name="sort">
                            <option selected>ASC</option>
                            <option>DESC</option>

                        </select>

                    </div>

                    <div class="col">

                        <select class="form-select" id="category_filter" name="category">
                            <option value="">Category</option>
                            <?php foreach ($categories as $cat_) : ?>
                                <option value="<?php echo $cat_->id ?>"><?php echo $cat_->cat_name ?></option>
                            <?php endforeach ?>

                        </select>

                    </div>

                    <div class="col">

                        <select class="form-select" id="tag_filter" name="tag">
                        <option value="">Tag</option>
                            <?php foreach ($tags as $tag_) : ?>
                                <option value="<?php echo $tag_->id ?>"><?php echo $tag_->tag_name ?></option>
                            <?php endforeach ?>

                        </select>

                              
                    </div>
                    <div class="col">

                        <input type="date" id="day_from" class="form-control" name="day_from">

                    </div>

                    <div class="col">
                        <input type="date" id="day_to" class="form-control" name="day_to">
                    </div>
                    <div class="col">
                        <input type="number" id="price_from" class="form-control" placeholder="price from" name="price_from">
                    </div>
                    <div class="col">
                        <input type="number" id="price_to" class="form-control" placeholder="price to" name="price_to">
                    </div>
                    <div class="col">
                        <button id="btn_filter" type="submit" name="filter_search" class="btn btn-primary btn-sm">filter</button>
                    </div>
                </form>


            </div>
        </div>

        <div class="mt-4">
            <table class="table table-bordered">
                <thead>

                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Product name</th>
                        <th scope="col">SKU</th>
                        <th scope="col">Price</th>
                        <th scope="col">Feature Image</th>
                        <th scope="col">Gallery</th>
                        <th scope="col">Categories</th>
                        <th scope="col">Tags</th>
                        <th scope="col">Action</th>

                    </tr>

                </thead>
                <tbody>

                    <?php foreach ($products as $product) : ?>
                        <tr id="<?php echo $product->id ?>">
                            <td scope="col"><?php echo $product->date ?></td>
                            <td scope="col"><?php echo $product->product_name ?></td>
                            <td scope="col"><?php echo $product->sku ?></td>
                            <td scope="col"><?php echo $product->price ?></td>
                            <td scope="col">
                                <img style="max-width: 80px;" src="https://localhost/PHP_1/assets/upload/<?php echo $product->image ?>" alt=" ">
                            </td>
                            <td scope="col">
                                <?php foreach (json_decode($product->gallery) as $gal) : ?>
                                    <img style="max-width: 40px;" src="https://localhost/PHP_1/assets/upload/<?php echo $gal ?>" alt=" ">
                                <?php endforeach ?>
                            </td>

                            <td scope="col"><?php foreach ($product->categories as $key => $cat) {

                                                if ($key !== count($product->categories) - 1) {
                                                    echo $cat . ", ";
                                                } else {
                                                    echo $cat;
                                                };
                                            }
                                            ?></td>

                            <td scope="col">
                                <?php foreach ($product->tags as $key => $tag) {

                                    if ($key !== count($product->tags) - 1) {
                                        echo $tag . ", ";
                                    } else {
                                        echo $tag;
                                    };
                                }
                                ?>

                            </td>

                            <td style="">
                                <a href="index.php?controller=update_product&product_id=<?php echo $product->id?>" style="color:black; margin-right:10px">
                                <i id="" class="fa-solid fa-pencil update_icon"></i></a>
                                <i id="" class="fa-solid fa-trash delete_icon"></i>
                                
                            </td>




                        </tr>
                    <?php endforeach ?>


                </tbody>
            </table>
        </div>

        <div>
            <nav aria-label="Page navigation example">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link page_1" href="">1</a></li>
                    <li class="page-item"><a class="page-link" href="">2</a></li>
                    <li class="page-item"><a class="page-link" href="">3</a></li>

                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <script>

document.querySelector('.page_1').addEventListener('click', function(event){
        event.preventDefault(); 
        var newState = { page: "index.php" };
        var newTitle = "Page 1";
        var newUrl = "/PHP_1/index.php?page=1";

        history.pushState(newState, newTitle, newUrl);

        document.title = newTitle;
})

function pagePag(){
    
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.open("GET", "index.php?page", true);
                xmlhttp.send();
                
                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log("chay")
                        document.querySelector("tbody").innerHTML = this.responseText;
                        deleBtn()
                    }
                };

            
}
document.querySelector('.page_1').addEventListener('click',pagePag)

        function deleBtn() {
            var deleteIcon = document.querySelectorAll('.delete_icon')

            deleteIcon.forEach(del => {

                del.addEventListener('click', function() {
                    console.log("clik");
                    var idParent = del.closest('tr').id

                    var xmlhttp = new XMLHttpRequest();

                    xmlhttp.open("GET", "index.php?delete=" + idParent, true);
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
            if (str == "") {
                document.querySelector("tbody").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.open("GET", "index.php?search="+str, true);
                xmlhttp.send();

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {

                        document.querySelector("tbody").innerHTML = this.responseText;
                        deleBtn()
                    }
                };

            }

        }

        function filterProduct() {

                var sortby = document.querySelector('#sort_by')
                var sort = document.querySelector('#sort')
                var category_filter = document.querySelector('#category_filter')
                var tag_filter = document.querySelector('#tag_filter')
                var day_from = document.querySelector('#day_from')
                var day_to = document.querySelector('#day_to')
                var price_from = document.querySelector('#price_from')
                var price_to = document.querySelector('#price_to')


            
                var xmlhttp = new XMLHttpRequest();

                xmlhttp.open("GET", "index.php?"+"sort_by="+sortby.value+"&sort="+sort.value+"&category="+category_filter.value+ "&tag="+tag_filter.value+"&day_from="+day_from.value+"&day_to="+day_to.value+"&price_from="+price_from.value+"&price_to="+price_to.value+"&filter_search=", true);
                xmlhttp.send();

                xmlhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        
                        document.querySelector("tbody").innerHTML = this.responseText;
                    
                        deleBtn()
                    }
                };

            

        }








        deleBtn()
        document.querySelector('#btn_filter').addEventListener('click', filterProduct)
        document.querySelector('#button-addon2').addEventListener('click', searchProduct)
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="http://localhost/PHP_1/JavaScript/validator.js"></script>
    <script src="http://localhost/PHP_1/JavaScript/search.js"></script>
</body>

</html>