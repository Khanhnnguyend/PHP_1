<?php
class ControlAction
{
    public function productView()
    {
        $tags = Tags::all();
        $categories = Categories::all();

        $products = Product::all();

        foreach($products as $product){
            $arrNewTags = [];
            $arrNewCats= [];
            foreach(json_decode($product->tags) as $tag){
                
                $nameTag = Tags::findID($tag);
                
                if($nameTag){
                    array_push($arrNewTags, $nameTag ->tag_name);
                }
            }

            foreach(json_decode($product->categories) as $cat){
                
                $nameCat = Categories::findID($cat);
                
                if($nameCat){
                    array_push($arrNewCats, $nameCat->cat_name);
                }
            }
            $product->categories = $arrNewCats;
            $product->tags = $arrNewTags;
            
        }


        include 'View/product.php';
    }



    public function addProductView()
    {
        $categories = Categories::all();
        $tags = Tags::all();
        include 'View/add_product.php';
    }

    public function updateProductView()
    {
        $id= $_GET['product_id'];
        $categories = Categories::all();
        $tags = Tags::all();
        $product = Product::findID($id);

        include 'View/update_product.php';
    }

    public function page(){
        echo "hahaha";
    }

    public function addProperty(){
        include 'View/add_property.php';
    }

    public function addProduct()
    {
        $name_product = $_POST['name_product'];
        $sku = $_POST['sku'];
        $price = $_POST['price'];
        $date = $_POST['date'];
        $img = $_FILES['image'];
        $tags = $_POST['tags'];
        $categories = $_POST['categories'];
        $gallery = $_FILES['gallery'];




        $product = new Product();

        $product->product_name = $name_product;
        $product->sku = $sku;
        $product->price = $price;
        $product->date = $date;
        $product->id = null;

        $filePic = "";

        if ($img['size'] > 0) {
            $filePic =$img['name'];
            $product->image =$filePic;
            $filePic ="assets/upload/".$img['name'];
            move_uploaded_file($img['tmp_name'], $filePic);
        }
        

        $totalTag = [];
        foreach ($tags as $tag) {

            array_push($totalTag, $tag);
        }
        $product->tags = json_encode($totalTag);



        $totalCat = [];
        foreach ($categories as $cat) {
            array_push($totalCat, $cat);
        }



        $totalGal = [];

        $galleries = array_map(function ($gallery1, $gallery2) {
            $filePic = "";
            $filePic = "assets/upload/".$gallery1;
            move_uploaded_file($gallery2, $filePic);

            
            return $gallery1;
        }, $gallery['name'], $gallery['tmp_name']);

        foreach ($galleries as $gal) {
            array_push($totalGal, $gal);
        }

        $product->gallery = json_encode($totalGal);
        $product->categories = json_encode($totalCat);

        $product->insert();
        header('location:index.php?controller=add_product');
    }

    public function updateProduct()
    {
       
        $name_product = $_POST['name_product'];
        $sku = $_POST['sku'];
        $price = $_POST['price'];
        $date = $_POST['date'];
        $img = $_FILES['image'];
        $tags = $_POST['tags'];
        $categories = $_POST['categories'];
        $gallery = $_FILES['gallery'];




        $product = new Product();

        $product->product_name = $name_product;
        $product->sku = $sku;
        $product->price = $price;
        $product->date = $date;
        $product->id = $_GET['product_id'];;

        $filePic = "";

        if ($img['size'] > 0) {
            $filePic = $img['name'];
            $product->image = $filePic;
            $filePic ="assets/upload/". $img['name'];
            move_uploaded_file($img['tmp_name'], $filePic);
        }
        else{
            $product->image=null;
        }
        

        $totalTag = [];
        foreach ($tags as $tag) {

            array_push($totalTag, $tag);
        }
        $product->tags = json_encode($totalTag);



        $totalCat = [];
        foreach ($categories as $cat) {
            array_push($totalCat, $cat);
        }



        $totalGal = [];

        $galleries = array_map(function ($gallery1, $gallery2) {
            $filePic = "";
            $filePic = "assets/upload/".$gallery1;
            move_uploaded_file($gallery2, $filePic);

            
            return $gallery1;
        }, $gallery['name'], $gallery['tmp_name']);

        

        foreach ($galleries as $gal) {
            array_push($totalGal, $gal);
        }
        
        $product->gallery = json_encode($totalGal);
       
        if(count($galleries)==1 & $galleries[0]==""){
            $product->gallery = null;
        }
       

        $product->categories = json_encode($totalCat);

       

        $product->update();
       header('location:index.php');
    }

    public function search()
    {
        $findSymbol = $_GET['search'];

        $products = Product::findAny($findSymbol);

        $tags = Tags::all();
        $categories = Categories::all();

    
        foreach($products as $product){
            $arrNewTags = [];
            $arrNewCats= [];
            foreach(json_decode($product->tags) as $tag){
                
                $nameTag = Tags::findID($tag);
                
                if($nameTag){
                    array_push($arrNewTags, $nameTag ->tag_name);
                }
            }

            foreach(json_decode($product->categories) as $cat){
                
                $nameCat = Categories::findID($cat);
                
                if($nameCat){
                    array_push($arrNewCats, $nameCat->cat_name);
                }
            }
            $product->categories = $arrNewCats;
            $product->tags = $arrNewTags;
            
        }

        foreach ($products as $product) {
            echo "
        <tr id='$product->id'>
        <td scope='col'> $product->date </td>
        <td scope='col'> $product->product_name </td>
        <td scope='col'> $product->sku </td>
        <td scope='col'> $product->price </td>
        <td scope='col'>
            <img style='max-width: 80px;' src=https://localhost/PHP_1/assets/upload/$product->image alt=' '>
        </td>
        <td scope='col'>";
            foreach (json_decode($product->gallery) as $gal) {
                echo "<img style='max-width: 40px;' src=https://localhost/PHP_1/assets/upload/$gal alt=' '>
                                
                           ";
            }
            echo " </td> <td scope='col'>";
            foreach ($product->categories as $key => $cat) {

                if ($key !== count($product->categories) - 1) {
                    echo $cat . ", ";
                } else {
                    echo $cat;
                };
            }

            echo "
        </td>

        <td scope='col'>";

        foreach ($product->tags as $key => $tag) {

            if ($key !== count($product->tags) - 1) {
                echo $tag . ", ";
            } else {
                echo $tag;
            };
        }

            echo "
        </td>

        <td style=''>
        <i class='fa-solid fa-pencil update_icon'></i>
        <i class='fa-solid fa-trash delete_icon'></i>
        </td>




    </tr>
    ";
        }
    }
//filter
    public function filterSearch(){
       
        
        $sort = $_GET['sort'];
        $sortBy = $_GET['sort_by'];
        $category = $_GET['category'];
        $tagFind = $_GET['tag'];
        $day_from = $_GET['day_from'];
        $day_to = $_GET['day_to'];
        $price_from = $_GET['price_from'];
        $price_to = $_GET['price_to'];
        
        $filterArr =[
            'sort'=> $sort,
            'sortBy'=> $sortBy,
            'category'=> $category,
            'tagFind'=> $tagFind,
            'day_from'=> $day_from,
            'day_to'=> $day_to,
            'price_from'=> $price_from,
            'price_to'=> $price_to
        ];

        $filterjson = json_encode( $filterArr );
        

        $products = Product::filter($filterjson);
        
        $tags = Tags::all();
        $categories = Categories::all();

    
        foreach($products as $product){
            $arrNewTags = [];
            $arrNewCats= [];
            foreach(json_decode($product->tags) as $tag){
                
                $nameTag = Tags::findID($tag);
                
                if($nameTag){
                    array_push($arrNewTags, $nameTag ->tag_name);
                }
            }

            foreach(json_decode($product->categories) as $cat){
                
                $nameCat = Categories::findID($cat);
                
                if($nameCat){
                    array_push($arrNewCats, $nameCat->cat_name);
                }
            }
            $product->categories = $arrNewCats;
            $product->tags = $arrNewTags;
            
        }

        
        echo "hahaha";
        foreach ($products as $product) {
            echo "
        <tr id='$product->id'>
        <td scope='col'> $product->date </td>
        <td scope='col'> $product->product_name </td>
        <td scope='col'> $product->sku </td>
        <td scope='col'> $product->price </td>
        <td scope='col'>
            <img style='max-width: 80px;' src=https://localhost/PHP_1/assets/upload/$product->image alt=' '>
        </td>
        <td scope='col'>";
            foreach (json_decode($product->gallery) as $gal) {
                echo "<img style='max-width: 40px;' src=https://localhost/PHP_1/assets/upload/$gal alt=' '>
                                
                           ";
            }
            echo " </td> <td scope='col'>";
            foreach ($product->categories as $key => $cat) {

                if ($key !== count($product->categories) - 1) {
                    echo $cat . ", ";
                } else {
                    echo $cat;
                };
            }

            echo "
        </td>

        <td scope='col'>";

        foreach ($product->tags as $key => $tag) {

            if ($key !== count($product->tags) - 1) {
                echo $tag . ", ";
            } else {
                echo $tag;
            };
        }

            echo "
        </td>

        <td style=''>
            <i class='fa-solid fa-pencil'></i>
            <i class='fa-solid fa-trash'></i>
        </td>




    </tr>
    ";
        
    }
    }

    public function delete()
    {
        $id = $_GET['delete'];
        Product::delete($id);
    }

    public function addTag(){
        $name_tag = $_POST['name_tag'];
        $des_tag = $_POST['tag_description'];

        $tag = new Tags();

        $tag->tag_name = $name_tag;
        $tag->description = $des_tag;
        $tag->id = null;
        $tag->insert();
        
       header('location:index.php?controller=add_property');

    }

    public function addCat(){
        $name_cat = $_POST['name_cat'];
        $des_cat = $_POST['cat_description'];

        $cat = new Categories();

        $cat->cat_name = $name_cat;
        $cat->description = $des_cat;
        $cat->id = null;
        $cat->insert();
        
       header('location:index.php?controller=add_property');
    }
}
