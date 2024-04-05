<?php 
    require'Model/model.php';
    require'Model/product.php';
    require'Model/category.php';
    require 'Model/tags.php';
    require 'Control/controller.php';

    $controlAction = new ControlAction();

   

    $controller = isset($_GET['controller']) == true ? $_GET['controller'] : "index.php";
	switch($controller){
		case 'index.php':{
   
            if(!isset($_GET['search'])
            && !isset($_GET['filter_search'])){
                $controlAction->productView();
            }
			break;
		}

        case 'add_product':{
            $controlAction->addProductView();
			break;
        }

        case 'add_property':{
            $controlAction->addProperty();
			break;
        }

        case 'update_product':{
            $controlAction->updateProductView();
			break;
        }
    }


    if(isset($_POST['insert_product']) ) {
        $controlAction->addProduct();
    }

    if(isset($_POST['update_product']) ) {
        $controlAction->updateProduct();
    }

    if(isset($_GET['search']) ) {
        $controlAction->search();
        
    }

    if(isset($_GET['delete']) ) {
        $controlAction->delete();
        
    }

    if(isset($_POST['add_tag']) ) {
        $controlAction->addTag();
        echo "add tag";
    }

    if(isset($_POST['add_cat']) ) {
        $controlAction->addCat();
        
    }

    if(isset($_GET['filter_search']) ) {
        $controlAction->filterSearch();
        
    }



    
?>