<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">


   
    <title>Product</title>
</head>

<body>
    <div class="container">

        <div class="p-4 mt-3 position-relative" style="border: 1px solid #ced4da;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
            <div class="row">
                <div class="col">
                    <a class="link_" href="index.php?controller=add_product"><button type="button" class="btn btn-secondary btn-sm btn_hover border-0">Add product</button></a>

                    <a href="index.php?controller=add_property"><button type="button" class="btn btn-secondary btn-sm btn_hover border-0">Add property</button></a>
                    <a href=""><button type="button" class="btn btn-secondary btn-sm btn_hover border-0">Sync from VillaTheme</button></a>


                </div>
                <div class="col">
                    <form action="" onsubmit="return false">
                        <div class="input-group mb-3" style="border: 1px solid #ced4da;">

                            <input id="search_input" name="search" type="text" class="form-control border-0" placeholder="Search product" value="<?php if(isset($_GET['search']))
                            {echo $name ;} ?>">
                            <button class="btn border-0 rounded-circle bg-secondary text-white" id="button-addon2">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>


                        </div>
                    
                </div>
            </div>
            <div class="row">
                

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
                        <button id="btn_filter" type="submit" name="filter_search" class="btn btn-secondary btn-sm btn_hover border-0">filter</button>
                    </div>
                </form>

                                <p class="filter_message"></p>
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
                    
                <p class="page-present" hidden><?php echo $page ?></p>

                    <?php if ($products != null) foreach ($products as $product) : ?>
                        <tr id="<?php echo $product->id ?>">
                            <td scope="col"><?php echo $product->date ?></td>
                            <td scope="col"><?php echo $product->product_name ?></td>
                            <td scope="col"><?php echo $product->sku ?></td>
                            <td scope="col"><?php echo $product->price ?></td>
                            <td scope="col">
                                <img style="max-width: 80px;" src="./assets/upload/<?php echo $product->image ?>" alt=" ">
                            </td>
                            <td scope="col">
                                <?php foreach (json_decode($product->gallery) as $gal) : ?>
                                    <img style="max-width: 40px;" src="./assets/upload/<?php echo $gal ?>" alt=" ">
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
                                        echo$tag . ", ";
                                    } else {
                                        echo $tag;
                                    };
                                }
                                ?>

                            </td>

                            <td style="">
                                <a href="index.php?controller=update_product&product_id=<?php echo $product->id ?>" style="color:black; margin-right:10px">
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
                    
                    <?php for ($i = 1; $i <= $take; $i++) {

                        echo '<li class="page-item"><a class="page-link page_';
                        echo ((int)$i);
                        echo ' page" href="">';
                        echo ((int)$i);
                        echo '</a></li>';
                    } ?>


                    
                </ul>
            </nav>
        </div>
    </div>
             
    
    
    <script> var file = "<?php echo $GLOBALS['root'] ?>"; </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    
    <script src="./JavaScript/ajax.js"></script>
    <script src="./JavaScript/validator.js"></script>
    <script src="./JavaScript/search.js"></script>
    <script src="./JavaScript/filterValidate.js"></script>
    <link rel="stylesheet" href="./CSS/product.css">
</body>

</html>