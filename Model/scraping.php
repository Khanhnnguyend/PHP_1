<?php

require 'simple_html_dom.php';
require 'model.php';
require 'validator.php';
require 'product.php';
require 'category.php';
require 'tags.php';

$val = new Validate();
$firstPage = file_get_html('https://villatheme.com/extensions/');

// start here
$countProduct = 0;
$products = $firstPage->find('.product ');

for ($i = 5; $i < count($products) - 1; $i++) {

    $prod = new Product();
    $prod->id = null;
    $prod->date = date('Y-m-d');

    $link = $products[5]->find('a', 0)->href;

    $detailProduct = file_get_html($link);


    $img = $detailProduct->find('.woocommerce-product-gallery', 0)->find('img', 0)->src;
    $nameProduct = $detailProduct->find('.product_title', 0)->innertext;

    $categories = $detailProduct->find('.product_meta', 0)->find('.posted_in', 0)->find('a');

    $totalCat = [];
    if ($categories != null) {
        $findCat = "select * from category where cat_name =";
        foreach ($categories as $category) {
            $checkCat = Categories::condition($findCat . "'$category->innertext'");
            if ($checkCat == null) {
                $cat = new Categories();
                $cat->id = null;
                $cat->description = null;
                $cat->cat_name = $category->innertext;

                $cat->insert();
                $id = $cat->id;
            }
            else {
                var_dump($checkCat);
            }

            array_push($totalCat, $id);
        }
    }

    return;

    $tags = $detailProduct->find('.product_meta', 0)->find('.tagged_as', 0)->find('a');
    $totalTags = [];
    if ($tags != null) {
        foreach ($tags as $tag) {
            array_push($totalTags, $val->enCode($tag->innertext));
        }
    }


    $gallery_wrapper = $detailProduct->find(".woocommerce-product-gallery", 0)->find('.woocommerce-product-gallery__image');



    if (count($gallery_wrapper) > 1) {
        $totalGal = [];
        foreach ($gallery_wrapper as $gallery_block) {
            $gal = $gallery_block->find('a', 0)->href;

            array_push($totalGal, $gal);
        }
        $prod->gallery = json_encode($totalGal);
    } else {
        $prod->gallery = null;
    }

    $priceBlock = $detailProduct->find('.price', 0)->find('bdi');
    $priceNew;

    if ($priceBlock != null) {
        if (count($priceBlock) > 1) {
            $priceNew = $priceBlock[1];
        } else {
            $priceNew = $priceBlock[0];
        }
        $priceNew->find('span', 0)->remove();
        $price = $priceNew->innertext;
    } else {
        $price = 0;
    }

    $sku = explode("/", $detailProduct->find('input[name=_wp_http_referer]', 0)->value);
    $sku = $sku[count($sku) - 2];



    $prod->product_name = $nameProduct;
    $prod->sku = $sku;
    $prod->price = $price;
    $prod->image = $img;

    $prod->categories = json_encode($totalCat);
    $prod->tags = json_encode($totalTags);

    $prod->insert();







    echo $img, $nameProduct,  $price, $sku;
    echo "<br /> ";

    if ($i == 5) {
        echo $countProduct;
        break;
    }
}












// $page = $firstPage->find('.next',0)->href;

// while ($page != null) {
//     # code...
// }
