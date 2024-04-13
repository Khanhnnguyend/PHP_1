<?php
require_once("Model/validator.php");

class ControlAction
{

    public function productView()
    {
        $tags = Tags::all();
        $categories = Categories::all();

        $productsTotal = Product::all();
        $take = ceil(count($productsTotal) / 5);
        $page =1;
        $products = Product::allLimit(5, 1);
        foreach ($products as $product) {
            $arrNewTags = [];
            $arrNewCats = [];
            if($product->tags !=""){
                foreach (json_decode($product->tags) as $tag) {

                    $nameTag = Tags::findID($tag);
    
                    if ($nameTag) {
                        array_push($arrNewTags, $nameTag->tag_name);
                    }
                }
            }
            
            if($product->categories !=""){
            foreach (json_decode($product->categories) as $cat) {

                $nameCat = Categories::findID($cat);

                if ($nameCat) {
                    array_push($arrNewCats, $nameCat->cat_name);
                }
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
        $id = $_GET['product_id'];
       if(!is_numeric($id)){
        return;
       }
        
        $categories = Categories::all();
        $tags = Tags::all();
        $product = Product::findID($id);

        include 'View/add_product.php';
    }

    public function pageLoad()
    {
        $tags = Tags::all();
        $categories = Categories::all();
        $productsTotal = Product::all();

        $take = ceil(count($productsTotal) / 5);
        $page = $_GET['page'];
        if(!is_numeric($page)){
            echo"<script> Lỗi </script>";
            return;
        }
        $products = Product::allLimit(5, $page);
        foreach ($products as $product) {
            $arrNewTags = [];
            $arrNewCats = [];
            if($product->tags !=""){
                foreach (json_decode($product->tags) as $tag) {

                    $nameTag = Tags::findID($tag);
    
                    if ($nameTag) {
                        array_push($arrNewTags, $nameTag->tag_name);
                    }
                }
            }
            
            if($product->categories !=""){
            foreach (json_decode($product->categories) as $cat) {

                $nameCat = Categories::findID($cat);

                if ($nameCat) {
                    array_push($arrNewCats, $nameCat->cat_name);
                }
            }
        }
            $product->categories = $arrNewCats;
            $product->tags = $arrNewTags;
        }

        
        include 'View/product.php';
        
    }

   

    public function page()
    {

        $page = $_GET['page'];

        $products = Product::allLimit(5, $page);

        foreach ($products as $product) {
            $arrNewTags = [];
            $arrNewCats = [];
            if($product->tags !=""){
                foreach (json_decode($product->tags) as $tag) {

                    $nameTag = Tags::findID($tag);
    
                    if ($nameTag) {
                        array_push($arrNewTags, $nameTag->tag_name);
                    }
                }
            }
            
            if($product->categories !=""){
            foreach (json_decode($product->categories) as $cat) {

                $nameCat = Categories::findID($cat);

                if ($nameCat) {
                    array_push($arrNewCats, $nameCat->cat_name);
                }
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
            <img style='max-width: 80px;' src=";
            echo $GLOBALS['linkpath'];
            echo "/assets/upload/$product->image alt=' '>
        </td>
        <td scope='col'>";
            foreach (json_decode($product->gallery) as $gal) {
                echo "<img style='max-width: 40px;' src=";
                echo $GLOBALS['linkpath'];
                echo "/assets/upload/$gal alt=' '>
                                
                           ";
            }
            echo " </td> <td scope='col'>";
            foreach ($product->categories as $key => $cat) {

                if ($key !== count($product->categories) - 1) {
                    echo $cat . ",";
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

            echo " </td>
        <td style=''>
        <a href='index.php?controller=update_product&product_id=";
            echo $product->id . "'style='color:black; margin-right:10px'>";
            echo " <i id='' class='fa-solid fa-pencil update_icon'></i></a>
        <i class='fa-solid fa-trash delete_icon'></i>
        </td>




    </tr>
    ";;
        }
    }

    public function addProperty()
    {
        include 'View/add_property.php';
    }

    public function addProduct()
    {
        $val = new Validate();


        $name_product = $_POST['name_product'];
        $sku = $_POST['sku'];
        $price = $_POST['price'];
        $date = $_POST['date'];
        if(isset($_FILES['image'])){
         $img = $_FILES['image'];
        }

        if(isset($_POST['tags'])){

         $tags = $_POST['tags'];
        }
        if(isset($_POST['categories'])){

         $categories = $_POST['categories'];
        }
        if(isset($_FILES['gallery'])){

         $gallery = $_FILES['gallery'];
        }


        
        $product = new Product();

        $product->product_name = $val->enCode($name_product);
        $product->sku = $val->enCode($sku);
        if (is_numeric($price)) {
            if ($price < 0) {
                echo "<script> alert(' price không hợp lệ') </script>";
                return;
            }
        } else {
            echo "<script> alert('price không phải số ')</script>";
            return;
        }
        $product->price = $price;

        $pattern = '/^\d{4}-\d{2}-\d{2}$/';
        if(preg_match($pattern, $date) !=1 && $date !=""){
            echo "<script> alert('date không hợp lệ ')</script>";
            return;
        }
        if ($date > date("Y-m-d")) {
            echo "<script> alert('date không hợp lệ ')</script>";
            return;
        }
        $product->date = $date;

        if ($date == "") {
            $product->date = date("Y-m-d");
        }

        



        $product->id = null;

        if ($img['size'] > 0) {
        $filePic = "";

        $type = $_FILES['image']['type'];
        $extensions = array('image/jpeg', 'image/png', 'image/gif');
        if (!in_array($type, $extensions)) {
            echo "<script> alert('ảnh không hợp lệ ')</script>";
            return;
        }

            $filePic = $img['name'];
            $product->image = $filePic;
            $filePic = "assets/upload/" . $img['name'];
            move_uploaded_file($img['tmp_name'], $filePic);
        }else{
            $product->image = null;
        }

        if(isset($_POST['tags'])){
            $totalTag = [];
        foreach ($tags as $tag) {

            array_push($totalTag, $val->enCode($tag));
        }
        $product->tags = json_encode($totalTag);
        }
        else {
            $product->tags = null;
        }


        if(isset($_POST['categories'])){
        $totalCat = [];
        foreach ($categories as $cat) {
            array_push($totalCat, $val->enCode($cat));
        }
        $product->categories = json_encode($totalCat);

    }
    else {
        $product->categories = null;
    }

    unset($val);

    if($_FILES['gallery']['size'][0] != 0){

        foreach ($_FILES['gallery']['type'] as $type) {

            $extensions = array('image/jpeg', 'image/png', 'image/gif');
            if (!in_array($type, $extensions)) {
                echo "<script> alert('ảnh gallery không hợp lệ ')</script>";
                return;
            }
        }

    }
        $totalGal = [];

        $galleries = array_map(function ($gallery1, $gallery2) {
            $filePic = "";
            $filePic = "assets/upload/" . $gallery1;
            move_uploaded_file($gallery2, $filePic);


            return $gallery1;
        }, $gallery['name'], $gallery['tmp_name']);

        foreach ($galleries as $gal) {
            array_push($totalGal, $gal);
        }

        $product->gallery = json_encode($totalGal);


        $product->insert();



        header('location:index.php?page=1');
        
    }

    public function updateProduct()
    {
        $val = new Validate();
        $name_product = $_POST['name_product'];
        $sku = $_POST['sku'];
        $price = $_POST['price'];
        $date = $_POST['date'];
        if(isset($_FILES['image'])){
            $img = $_FILES['image'];
        }
        if(isset($_POST['tags'])){
            $tags = $_POST['tags'];
        }
        if(isset($_POST['categories'])){
            $categories = $_POST['categories'];
        }
        if(isset($_FILES['gallery'])){
            $gallery = $_FILES['gallery'];
        }
        if(isset($_POST['gallery_old'])){
            $gallery_old = $_POST['gallery_old'];
        }



        
        $product = new Product();

        $product->product_name = $val->enCode($name_product);
        $product->sku = $val->enCode($sku);
        if (is_numeric($price)) {
            if ($price < 0) {
                echo "<script> alert(' price không hợp lệ') </script>";
                return;
            }
        } else {
            echo "<script> alert('price không phải số ')</script>";
            return;
        }
        $product->price = $price;

        if ($date > date("Y-m-d")) {
            echo "<script> alert('date không hợp lệ ')</script>";
            return;
        }

        $pattern = '/^\d{4}-\d{2}-\d{2}$/';
        if(preg_match($pattern, $date) !=1){
            echo "<script> alert('date không hợp lệ ')</script>";
            return;
        }
        $product->date = $date;

        if ($date == "") {
            $product->date = date("Y-m-d");
        }

        
        
        
        $product->id = $_GET['product_id'];
        
        
        if ($img['size'] > 0) {
        $type = $_FILES['image']['type'];
        $extensions = array('image/jpeg', 'image/png', 'image/gif');
        if (!in_array($type, $extensions)) {
            echo "<script> alert('ảnh không hợp lệ ')</script>";
            return;
        }
        $filePic = "";
        
        
        $filePic = $img['name'];
        $product->image = $filePic;
        $filePic = "assets/upload/" . $img['name'];
        move_uploaded_file($img['tmp_name'], $filePic);
    } else {
        $product->image = null;
    }

        

    if(isset($tags)) {
        $totalTag = [];
        foreach ($tags as $tag) {
            
            array_push($totalTag, $val->enCode($tag));
        }
        $product->tags = json_encode($totalTag);
        
    }
    else{
        $totalTag = [];
        $product->tags = json_encode($totalTag);
    }
    
    
    if(isset($_POST['categories'])){
        $totalCat = [];
        foreach ($categories as $cat) {
            array_push($totalCat, $val->enCode($cat));
        }
        $product->categories = json_encode($totalCat);
        
    }
    else{
        $totalCat = [];
        $product->categories = json_encode($totalCat);
    }
    
    unset($val);
    if($_FILES['gallery']['size'][0] != 0){
        
    
        foreach ($_FILES['gallery']['type'] as $type) {

            $extensions = array('image/jpeg', 'image/png', 'image/gif');
            if (!in_array($type, $extensions)) {
                echo "<script> alert('ảnh gallery không hợp lệ ')</script>";
                return;
            }
        }
    }
   
        $totalGal = [];

        $galleries = array_map(function ($gallery1, $gallery2) {
            $filePic = "";
            $filePic = "assets/upload/" . $gallery1;
            move_uploaded_file($gallery2, $filePic);


            return $gallery1;
        }, $gallery['name'], $gallery['tmp_name']);



        foreach ($galleries as $gal) {
            array_push($totalGal, $gal);
        }





        if (count($galleries) == 1 & $galleries[0] == "") {
            if (!isset($_POST['gallery_old'])) {
                $product->gallery = null;
            } else {
                $totalGal = [];
            }
        }

        if (isset($_POST['gallery_old'])) {
            foreach ($gallery_old as $gal_old) {
                array_push($totalGal, $gal_old);
            }
        }

        $product->gallery = json_encode($totalGal);





        $product->update();

        header('location:index.php?page=1');
        
    }

    
    //filter
    public function filterSearch()
    {
        $val = new Validate();
        
        $search = $_GET['search'];
        $page = $_GET['page_filter'];
        $sort = $_GET['sort'];
        $sortBy = $_GET['sort_by'];
        $category = $_GET['category'];
        $tagFind = $_GET['tag'];
        $day_from = $_GET['day_from'];
        $day_to = $_GET['day_to'];
        $price_from = $_GET['price_from'];
        $price_to = $_GET['price_to'];


        $pattern = '/^\d{4}-\d{2}-\d{2}$/';
        $search = $val->enCode($search);
        $sort = $val->enCode($sort);

        $sortBy = $val->enCode($sortBy);
        $category = $val->enCode($category);
        $tagFind = $val->enCode($tagFind);

        $date = date("Y-m-d");
       
        $date1 =  date($day_from);
        $date2 = date($day_to);
        

        if ( $day_from!="" && $date1 > $date ) {
            echo  '<p class="err_message_filter">Sai trường thông tin</p>';
            return;
        }

        
        if ((preg_match($pattern, $day_from) !=1&&$day_from!="" )||
        ( preg_match($pattern, $day_to)!=1 && $day_to != "")) {
            
            echo '<p class="err_message_filter">Sai trường thông tin</p>';
            return;
        } else {
            if (  $day_from!=""  && $day_to != "" && $date1 > $date2) {
           
                echo  '<p class="err_message_filter">Sai trường thông tin</p>';
                return;
            }
        }

        if ((is_numeric($price_from)!=1 && $price_from!="" )||
        ( is_numeric($price_to)!=1 && $price_to!= "")) {
            
            echo '<p class="err_message_filter">Sai trường thông tin</p>';
            return;
        } else {
            if ( $price_from != "" &&  (float)$price_from  > $price_to != ""&& (float)$price_to) {
                
                echo '<p class="err_message_filter">Sai trường thông tin</p>';
                return;
            } 
            if( (float)$price_from < 0 || (float)$price_to < 0 ){
           
                echo '<p class="err_message_filter">Sai trường thông tin</p>';
                return;
            }
        }

        $filterArr = [
            'search' => $search,
            'sort' => $sort,
            'sortBy' => $sortBy,
            'category' => $category,
            'tagFind' => $tagFind,
            'day_from' => $day_from,
            'day_to' => $day_to,
            'price_from' => $price_from,
            'price_to' => $price_to
        ];

        $filterjson = json_encode($filterArr);

        $products = Product::filter($filterjson);
      

        $tags = Tags::all();
        $categories = Categories::all();


        foreach ($products as $product) {
            $arrNewTags = [];
            $arrNewCats = [];
            if($product->tags !="" && is_array(json_decode($product->tags))){
                foreach (json_decode($product->tags) as $tag) {

                    $nameTag = Tags::findID($tag);
    
                    if ($nameTag) {
                        array_push($arrNewTags, $nameTag->tag_name);
                    }
                }
            }
            
            if($product->categories !="" && is_array(json_decode($product->categories))){
            foreach (json_decode($product->categories) as $cat) {

                $nameCat = Categories::findID($cat);

                if ($nameCat) {
                    array_push($arrNewCats, $nameCat->cat_name);
                }
            }
        }
            $product->categories = $arrNewCats;
            $product->tags = $arrNewTags;
        }
        $start = ($page - 1) * 5;
        $countLoop = 0;
       
        echo '<p class="page-present" hidden>'; echo $page; echo '</p>';
        foreach ($products as $product) {

            if ($countLoop >= $start && $countLoop < $page * 5) {
                echo "
        <tr id='$product->id'>
        <td scope='col'> $product->date </td>
        <td scope='col'> $product->product_name </td>
        <td scope='col'> $product->sku </td>
        <td scope='col'> $product->price </td>
        <td scope='col'>
            <img style='max-width: 80px;' src=";
                echo $GLOBALS['linkpath'];
                echo "/assets/upload/$product->image alt=' '>
        </td>
        <td scope='col'>";
                foreach (json_decode($product->gallery) as $gal) {
                    echo "<img style='max-width: 40px;' src=";
                    echo $GLOBALS['linkpath'];
                    echo "/assets/upload/$gal alt=' '>
                                
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
        <a href='index.php?controller=update_product&product_id=";

                echo $product->id . "'style='color:black; margin-right:10px'>";

                echo " <i id='' class='fa-solid fa-pencil update_icon'></i></a>
        <i class='fa-solid fa-trash delete_icon'></i>
        </td>
    </tr>
    
    ";
            }
            $countLoop++;
        }
        echo "<input id='total_filter' type='hidden' value='";
        echo count($products);
        echo "'>";
    }

    public function delete()
    {
        $id = $_GET['delete'];
     
        if(is_numeric($id)){
            if (Product::findID($id) != null) {
                Product::delete($id);
                echo 'success';
            }
            else{
                echo "<script> loi </script>"; 
            }
        }
        
       
       
        
    }

    public function addTag()
    {
        $val = new Validate();

        $name_tag = $_POST['name_tag'];
        $des_tag = $_POST['tag_description'];

        $name_tag = $val->enCode($name_tag);
        $des_tag = $val->enCode($des_tag);
        unset($val);
        $tag = new Tags();

        $tag->tag_name = $name_tag;
        $tag->description = $des_tag;
        $tag->id = null;
        $tag->insert();

        header('location:index.php?controller=add_property');
    }

    public function addCat()
    {
        $val = new Validate();

        $name_cat = $_POST['name_cat'];
        $des_cat = $_POST['cat_description'];
        $name_cat = $val->enCode($name_cat);
        $des_cat = $val->enCode($des_cat);
        unset($val);

        $cat = new Categories();

        $cat->cat_name = $name_cat;
        $cat->description = $des_cat;
        $cat->id = null;
        $cat->insert();

        header('location:index.php?controller=add_property');
    }

    public function filterLoad()
    {
    }
}
