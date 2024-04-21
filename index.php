<?php 
    require 'Model/model.php';
    require 'Model/product.php';
    require 'Model/category.php';
    require 'Model/tags.php';
    require 'Model/fk_cat.php';
    require 'Model/fk_tag.php';
    require 'Control/controller.php';

    $controlAction = new ControlAction();

    

    $root = $_SERVER['PHP_SELF'];
    $root= str_replace('/index.php', '', $root);
    $GLOBALS['root'] =$root;
    $GLOBALS['linkpath'] = "http://".basename($_SERVER['HTTP_HOST']).$root;
    
  
    if(isset($_POST['insert_product']) ) {
        $controlAction->addProduct();
    }

    if(isset($_POST['update_product']) ) {
        $controlAction->updateProduct();
    }


    if(isset($_GET['delete']) ) {
        
        $controlAction->delete();
        
        }

    if(isset($_POST['add_tag']) ) {
        $controlAction->addTag();
        
    }

    if(isset($_POST['add_cat']) ) {
        $controlAction->addCat();
        
    }

    if(isset($_GET['filter_search']) )
    {

        $controlAction->filterSearch();
     
    }

    if(isset($_GET['page'])&& !isset($_GET['noneload'])) {
       
        $controlAction->pageLoad();
       
        
    }

    if(isset($_GET['page']) && isset($_GET['noneload'])) {
      
        $controlAction->page();
       
        
    }

    



    $controller = isset($_GET['controller']) == true ? $_GET['controller'] : "index.php";
	switch($controller){
		case 'index.php':{
   
            if(!isset($_GET['search'])
            && !isset($_GET['filter_search'])
            &&!isset($_GET['page'])
            &&!isset($_GET['delete'])){
              
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
    
?>