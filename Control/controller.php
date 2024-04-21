<?php
require_once ("Model/validator.php");



class ControlAction
{
    public $severName;
    public $database;
    public $connection;


    public function __construct()
    {
        $this->severName = "localhost";
        $this->database = "db_khanh";
        $this->connection = new PDO("mysql:host=$this->severName; dbname=$this->database;charset=utf8", 'root', '');

    }


    public function productView()
    {

        $tags = Tags::all($this->connection);
        $categories = Categories::all($this->connection);

        $productsTotal = Product::all($this->connection);
        $take = ceil(count($productsTotal) / 5);
        $page = 1;
        $products = Product::allLimit($this->connection, 5, 1);

        foreach ($products as $product) {
            $product->tags = [];
            $product->cat = [];
            $idcats = fk_Cat::get_all_id_cat($this->connection, $product->id);
            if ($idcats != null) {
                foreach ($idcats as $idcat) {
                    $cat = Categories::findID($this->connection, $idcat->id_cat);
                    array_push($product->cat, $cat->cat_name);
                }
            }
            $idtags = fk_Tags::get_all_id_tag($this->connection, $product->id);
            if ($idtags != null) {
                foreach ($idtags as $idtag) {
                    $tag = Tags::findID($this->connection, $idtag->id_tag);
                    array_push($product->tags, $tag->tag_name);
                }
            }
        }


        include 'View/product.php';
    }



    public function addProductView()
    {
        $categories = Categories::all($this->connection);
        $tagss = Tags::all($this->connection);

        include 'View/add_product.php';
    }

    public function updateProductView()
    {
        $id = $_GET['product_id'];
        if (!is_numeric($id)) {
            header('location:index.php');

        }

        $categories = Categories::all($this->connection);
        $tagss = Tags::all($this->connection);

        $product = Product::findID($this->connection, $id);

        $product->tags = [];
        $product->cat = [];
        $idcats = fk_Cat::get_all_id_cat($this->connection, $product->id);
        if ($idcats != null) {
            foreach ($idcats as $idcat) {

                array_push($product->cat, $idcat->id_cat);

            }
        }

        $idtags = fk_Tags::get_all_id_tag($this->connection, $product->id);
        if ($idtags != null) {
            foreach ($idtags as $idtag) {
                $tag = Tags::findID($this->connection, $idtag->id_tag);
                array_push($product->tags, $idtag->id_tag);
            }
        }



        include 'View/add_product.php';
    }

    public function pageLoad()
    {
        $tags = Tags::all($this->connection);
        $categories = Categories::all($this->connection);
        $productsTotal = Product::all($this->connection);

        $take = ceil(count($productsTotal) / 5);
        $page = $_GET['page'];
        if (!is_numeric($page)) {
            echo "<script> Lỗi </script>";
            return;
        }
        $products = Product::allLimit($this->connection, 5, $page);
        foreach ($products as $product) {
            $product->tags = [];
            $product->cat = [];
            $idcats = fk_Cat::get_all_id_cat($this->connection, $product->id);
            if ($idcats != null) {
                foreach ($idcats as $idcat) {
                    $cat = Categories::findID($this->connection, $idcat->id_cat);
                    array_push($product->cat, $cat->cat_name);
                }
            }
            $idtags = fk_Tags::get_all_id_tag($this->connection, $product->id);
            if ($idtags != null) {
                foreach ($idtags as $idtag) {
                    $tag = Tags::findID($this->connection, $idtag->id_tag);
                    array_push($product->tags, $tag->tag_name);
                }
            }
        }


        include 'View/product.php';

    }



    public function page()
    {

        $page = $_GET['page'];

        $products = Product::allLimit($this->connection, 5, $page);

        foreach ($products as $product) {
            $product->tags = [];
            $product->cat = [];
            $idcats = fk_Cat::get_all_id_cat($this->connection, $product->id);
            if ($idcats != null) {
                foreach ($idcats as $idcat) {
                    $cat = Categories::findID($this->connection, $idcat->id_cat);
                    array_push($product->cat, $cat->cat_name);
                }
            }
            $idtags = fk_Tags::get_all_id_tag($this->connection, $product->id);
            if ($idtags != null) {
                foreach ($idtags as $idtag) {
                    $tag = Tags::findID($this->connection, $idtag->id_tag);
                    array_push($product->tags, $tag->tag_name);
                }
            }
        }

        foreach ($products as $product) {
            echo "
        <tr id='$product->id'>
        <td scope='col'>$product->date</td>
        <td scope='col'>$product->product_name</td>
        <td scope='col'>$product->sku</td>
        <td scope='col'>";
            if ($product->price > 0) {
                echo $product->price;
            }
            echo "</td>
        <td scope='col'>
            <img style='max-width: 80px;' src='";

            echo "$product->image' alt=' '>
        </td>
        <td scope='col'>";
            if (
                is_array(json_decode($product->gallery))
                && $product->gallery != null
            ) {
                foreach (json_decode($product->gallery) as $gal) {
                    echo "<img style='max-width: 40px;' src=";

                    echo "$gal alt=' '>
                                
                           ";
                }
            }
            echo " </td> <td scope='col'>";
            foreach ($product->cat as $cat) {
                echo "<p>";
                echo $cat;
                echo "</p>";
            }

            echo "
        </td>

        <td scope='col'>";
            foreach ($product->tags as $tag) {
                echo "<p>";
                echo $tag;
                echo "</p>";
            }

            echo " </td>
        <td style=''>
        <a href='index.php?controller=update_product&product_id=";
            echo $product->id . "'style='color:black; margin-right:10px'>";
            echo " <i id='' class='fa-solid fa-pencil update_icon'></i></a>
        <i class='fa-solid fa-trash delete_icon'></i>
        </td>




    </tr>
    ";
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
        if (isset($_FILES['image'])) {
            $img = $_FILES['image'];
        }

        // if(isset($_POST['tags'])){

        //  $tags = $_POST['tags'];
        // }
        // if(isset($_POST['categories'])){

        //  $categories = $_POST['categories'];
        // }
        if (isset($_FILES['gallery'])) {

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

        $monthYear = '/^\d{4}-\d{2}$/';
        $dayMonthYear = '/^\d{4}-\d{2}-\d{2}$/';
        if (preg_match($dayMonthYear, $date) != 1 && $date != "") {
            echo "<script> alert('date không hợp lệ ')</script>";
            return;
        }
        if (preg_match($dayMonthYear, $date) == 1) {
            if ($date > date("Y-m-d")) {
                echo "<script> alert('date không hợp lệ ')</script>";
                return;
            }
        }

        if (preg_match($monthYear, $date) == 1) {
            if ($date > date("Y-m")) {
                echo "<script> alert('date không hợp lệ ')</script>";
                return;
            }
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
            $filePic = "./assets/upload/" . $img['name'];
            $product->image = $filePic;
            move_uploaded_file($img['tmp_name'], $filePic);
        } else {
            $product->image = null;
        }


        unset($val);

        if ($_FILES['gallery']['size'][0] > 0) {

            foreach ($_FILES['gallery']['type'] as $type) {

                $extensions = array('image/jpeg', 'image/png', 'image/gif');
                if (!in_array($type, $extensions)) {
                    echo "<script> alert('ảnh gallery không hợp lệ ')</script>";
                    return;
                }
            }


            $totalGal = [];

            $galleries = array_map(function ($gallery1, $gallery2) {
                $filePic = "";
                $filePic = "assets/upload/" . $gallery1;
                move_uploaded_file($gallery2, $filePic);


                return $filePic;
            }, $gallery['name'], $gallery['tmp_name']);

            foreach ($galleries as $gal) {
                array_push($totalGal, $gal);
            }
            $product->gallery = json_encode($totalGal);
        } else {
            $product->gallery = null;
        }




        $product->insert($this->connection);
        $productID = $product->getLastID($this->connection);

        if (isset($_POST['tags'])) {
            $tags = $_POST['tags'];
            foreach ($tags as $tag) {

                $tagfk = new fk_Tags();
                $tagfk->id_product = $productID;
                $tagfk->id_tag = $tag;
                $tagfk->id = null;
                $tagfk->insert($this->connection);
            }
        }


        if (isset($_POST['categories'])) {
            echo "hahaha";
            $categories = $_POST['categories'];
            foreach ($categories as $cat) {
                $catfk = new fk_Cat();
                $catfk->id_product = $productID;
                $catfk->id_cat = $cat;
                $catfk->id = null;
                $catfk->insert($this->connection);
            }


        }


        header('location:index.php?page=1');

    }

    public function updateProduct()
    {
        $val = new Validate();
        $name_product = $_POST['name_product'];
        $sku = $_POST['sku'];
        $price = $_POST['price'];
        $date = $_POST['date'];
        if (isset($_FILES['image'])) {
            $img = $_FILES['image'];
        }
        // if(isset($_POST['tags'])){
        //     $tags = $_POST['tags'];
        // }
        // if(isset($_POST['categories'])){
        //     $categories = $_POST['categories'];
        // }
        if (isset($_FILES['gallery'])) {
            $gallery = $_FILES['gallery'];
        }
        if (isset($_POST['gallery_old'])) {
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
        if (preg_match($pattern, $date) != 1) {
            echo "<script> alert('date không hợp lệ ')</script>";
            return;
        }
        $product->date = $date;

        if ($date == "") {
            $product->date = date("Y-m-d");
        }



        $productid = $_GET['product_id'];
        $product->id = $productid;


        if ($img['size'] > 0) {
            $type = $_FILES['image']['type'];
            $extensions = array('image/jpeg', 'image/png', 'image/gif');
            if (!in_array($type, $extensions)) {
                echo "<script> alert('ảnh không hợp lệ ')</script>";
                return;
            }
            $filePic = "";


            $filePic = $img['name'];
            $filePic = "./assets/upload/" . $img['name'];
            $product->image = $filePic;
            move_uploaded_file($img['tmp_name'], $filePic);
        } else {
            $product->image = null;
        }





        unset($val);
        if ($_FILES['gallery']['size'][0] != 0) {


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
            if ($gal != "") {
                array_push($totalGal, "./assets/upload/" . $gal);
            }
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




        $fk_cats = fk_Cat::get_all_id_cat($this->connection, $productid);
        $fk_tags = fk_Tags::get_all_id_tag($this->connection, $productid);

        if ($fk_cats != null && isset($_POST['categories'])) {
            foreach ($fk_cats as $fk_cat) {
                fk_Cat::delete_fk_cat($this->connection, $productid, $fk_cat->id_cat);

            }

            $categories = $_POST['categories'];
            foreach ($categories as $cat) {
                $catfk = new fk_Cat();
                $catfk->id_product = $productid;
                $catfk->id_cat = $cat;
                $catfk->id = null;
                $catfk->insert($this->connection);
            }

        } else {
            if (isset($_POST['categories'])) {
                $categories = $_POST['categories'];
                foreach ($categories as $cat) {
                    $catfk = new fk_Cat();
                    $catfk->id_product = $productid;
                    $catfk->id_cat = $cat;
                    $catfk->id = null;
                    $catfk->insert($this->connection);
                }


            }
        }

        if ($fk_tags != null && isset($_POST['tags'])) {
            foreach ($fk_tags as $fk_tag) {
                fk_Tags::delete_fk_tag($this->connection, $productid, $fk_tag->id_tag);

            }
            $tags = $_POST['tags'];
            foreach ($tags as $tag) {
                $tagfk = new fk_Tags();
                $tagfk->id_product = $productid;
                $tagfk->id_tag = $tag;
                $tagfk->id = null;
                $tagfk->insert($this->connection);

            }

        } else {
            if (isset($_POST['tags'])) {
                $tags = $_POST['tags'];
                foreach ($tags as $tag) {
                    $tagfk = new fk_Tags();
                    $tagfk->id_product = $productid;
                    $tagfk->id_tag = $tag;
                    $tagfk->id = null;
                    $tagfk->insert($this->connection);

                }
            }

        }

        $product->update($this->connection);

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

        $date1 = date($day_from);
        $date2 = date($day_to);


        if ($day_from != "" && $date1 > $date) {
            echo '<p class="err_message_filter">Sai trường thông tin</p>';
            return;
        }


        if (
            (preg_match($pattern, $day_from) != 1 && $day_from != "") ||
            (preg_match($pattern, $day_to) != 1 && $day_to != "")
        ) {

            echo '<p class="err_message_filter">Sai trường thông tin</p>';
            return;
        } else {
            if ($day_from != "" && $day_to != "" && $date1 > $date2) {

                echo '<p class="err_message_filter">Sai trường thông tin</p>';
                return;
            }
        }

        if (
            (is_numeric($price_from) != 1 && $price_from != "") ||
            (is_numeric($price_to) != 1 && $price_to != "")
        ) {

            echo '<p class="err_message_filter">Sai trường thông tin</p>';
            return;
        } else {
            if ($price_from != "" && (float) $price_from > $price_to != "" && (float) $price_to) {

                echo '<p class="err_message_filter">Sai trường thông tin</p>';
                return;
            }
            if ((float) $price_from < 0 || (float) $price_to < 0) {

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

        $products = Product::filter($this->connection, $filterjson, $page);





        foreach ($products as $product) {
            $product->tags = [];
            $product->cat = [];
            $idcats = fk_Cat::get_all_id_cat($this->connection, $product->id);
            if ($idcats != null) {
                foreach ($idcats as $idcat) {
                    $cat = Categories::findID($this->connection, $idcat->id_cat);
                    array_push($product->cat, $cat->cat_name);
                }
            }
            $idtags = fk_Tags::get_all_id_tag($this->connection, $product->id);
            if ($idtags != null) {
                foreach ($idtags as $idtag) {
                    $tag = Tags::findID($this->connection, $idtag->id_tag);
                    array_push($product->tags, $tag->tag_name);
                }
            }
        }


        echo '<p class="page-present" hidden>';
        echo $page;
        echo '</p>';
        foreach ($products as $product) {


            echo "
        <tr id='$product->id'>
        <td scope='col'> $product->date </td>
        <td scope='col'> $product->product_name </td>
        <td scope='col'> $product->sku </td>
        <td scope='col'>";
            if ($product->price > 0) {
                echo $product->price;
            }
            echo "</td>
        <td scope='col'>
            <img style='max-width: 80px;' src=\"";

            echo "$product->image\" alt=' '>
        </td>
        <td scope='col'>";
            if (
                is_array(json_decode($product->gallery))
                && $product->gallery != null
            ) {
                foreach (json_decode($product->gallery) as $gal) {
                    echo "<img style='max-width: 40px;' src='";
                    
                    echo "$gal'alt=' '>
                                
                           ";
                }
            }
            echo " </td> <td scope='col'>";
            foreach ($product->cat as $cat) {
                echo "<p>";
                echo $cat;
                echo "</p>";
            }

            echo "
        </td>

        <td scope='col'>";

            foreach ($product->tags as $tag) {
                echo "<p>";
                echo $tag;
                echo "</p>";
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
        echo "<input id='total_filter' type='hidden' value='";
        if ($products != null) {
            echo $page * 5 + 5;
        } else {
            echo $page * 5;
        }
        echo "'>";
    }

    public function delete()
    {
        $id = $_GET['delete'];

        if (is_numeric($id)) {
            if (Product::findID($this->connection, $id) != null) {
                Product::delete($this->connection, $id);
                echo 'success';
            } else {
                echo "<script> loi </script>";
            }
        }

        $fk_cats = fk_Cat::get_all_id_cat($this->connection, $id);
        if($fk_cats != null){
            foreach ($fk_cats as $fk_cat) {
                fk_Cat::delete_fk_cat($this->connection,$fk_cat->id_product, $fk_cat->id_cat);
            }
        }

        $fk_tags = fk_Tags::get_all_id_tag($this->connection, $id);
        if($fk_tags != null){
            foreach ($fk_tags as $fk_tag) {
                fk_Tags::delete_fk_tag($this->connection,$fk_tag->id_product, $fk_tag->id_tag);
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
        $tag->insert($this->connection);

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
        $cat->insert($this->connection);

        header('location:index.php?controller=add_property');
    }

    public function filterLoad()
    {
    }
}
