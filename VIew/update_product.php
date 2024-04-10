<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
  <link rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />

  <title>Add product</title>
</head>

<body>
  <form action="" method="POST" enctype="multipart/form-data" id="form_update_product">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="mb-4">
            <label for="" class="form-label">Product name</label>
            <input type="text" value="<?php echo $product->product_name ?>" class="form-control" id=""
              name="name_product">
            <p class="form-message" style="font-size:10px; color:red;"></p>

          </div>
          <div class="mb-4">
            <label for="" class="form-label">SKU</label>
            <input type="text" value="<?php echo $product->sku ?>" class="form-control" id="" name="sku">
            <p class="form-message" style="font-size:10px; color:red;"></p>
          </div>

          <div class="mb-4">
            <label for="" class="form-label">Price</label>
            <input type="number" value="<?php echo $product->price ?>" class="form-control" id="" name="price">
            <p class="form-message" style="font-size:10px; color:red;"></p>

          </div>
          <div class="mb-4">
            <label for="" class="form-label">Date</label>
            <input type="date" value="<?php echo $product->date ?>" class="form-control" id="" name="date">
            <p class="form-message" style="font-size:10px; color:red;"></p>
          </div>

        </div>
        <div class="col">
          <div class="mb-4">
            <label for="" class="form-label">Image</label>
            <input type="file" class="form-control" value="<?php echo $product->image ?>" name="image" id="file"
              file="123.png">
            <p class="form-message" style="font-size:10px; color:red;"></p>
            <div class="image"></div>

          </div>
          <div class="mb-4 tag-select">
            <label for="" class="form-label">Tags</label>
            <select multiple name="tags[]" class="form-select" id="multiple-select-field-tag" data-placeholder="Tags">

              <?php foreach ($tags as $tag): ?>
                <option <?php foreach (json_decode($product->tags) as $id_tag) {
                  if ($id_tag == $tag->id) {
                    echo "selected";
                  }
                } ?> value="<?php echo $tag->id ?>">
                  <?php echo $tag->tag_name ?>
                </option>
              <?php endforeach ?>

            </select>
            <p class="form-message" style="font-size:10px; color:red;"></p>
          </div>

          <div class="mb-4 cat-select">
            <label for="" class="form-label">Categories</label>
            <select class="form-control" name="categories[]" id="multiple-select-field-cat" data-placeholder="category"
              multiple>
              <?php foreach ($categories as $cat): ?>
                <option <?php foreach (json_decode($product->categories) as $id_cat) {
                  if ($id_cat == $cat->id) {
                    echo "selected";
                  }
                } ?> value="<?php echo $cat->id ?>">
                  <?php echo $cat->cat_name; ?>
                </option>
              <?php endforeach ?>

            </select>
            <p class="form-message" style="font-size:10px; color:red;"></p>

          </div>
          <div class="mb-4 border rounded">
            <label for="" class="form-label">Gallery</label>
            <div class="upload__box">
              <div class="upload__btn-box">
                <label class="upload__btn">
                  <p>Upload images</p>
                  <input type="file" multiple="" data-max_length="20" class="upload__inputfile" name="gallery[]">
                </label>
              </div>
              <div class="upload__img-wrap">
                <?php $count =0;?>
              <?php foreach (json_decode($product->gallery) as $gal):?>
                
                <div class="upload__img-box">
                  <input type="hidden" value="<?php echo $gal ?>" name="gallery_old[]">
                  <div style='background-image: url("./assets/upload/<?php echo $gal ?>")' data-number="<?php echo $count?>" data-file="<?php echo $gal?>" class="img-bg">
                    <div class="upload__img-close"></div>
                  </div>
                </div>
                <?php $count++;?>
<?php endforeach?>



              </div>
            </div>
            <p class="form-message" style="font-size:10px; color:red;"></p>
          </div>
        </div>
      </div>

      <button type="submit" name="update_product" class="btn btn-primary btn-sm">Update</button>
  </form>

  <a href="index.php?page=1"> <button type="button" class="btn btn-primary btn-sm">Product</button></a>



  <script src="./JavaScript/validator.js">

  </script>
  <script>

    validator({
      form: '#form_update_product',
      rules: [
        validator.isRequired("input[name=name_product]"),
        validator.onlyText("input[name=name_product]"),
        validator.isRequired("input[name=price]"),
        validator.isRequired("input[name=sku]"),
        validator.onlyText("input[name=sku]"),

      ]
    }) 
    
    let tagBlock  =document.querySelector('.tag-select')
    let selectTag =document.querySelector('#multiple-select-field-tag')
    let spanSelect =tagBlock.querySelector('input')
    let messageTag=tagBlock.querySelector('.form-message')
console.log(tagBlock)
console.log(spanSelect)
    spanSelect.addEventListener("blur", function(){
      
      let tagSelect =tagBlock.querySelector('.select2-selection__choice')
      if(tagSelect){
        messageTag.innerText = ""
        selectTag.classList.remove('invalid')
      }
      else 
      {
        messageTag.innerText = "Vui lòng chọn Tags"
        selectTag.classList.add('invalid')
      }
    })


    let catBlock  =document.querySelector('.cat-select')
    let selectCat =document.querySelector('#multiple-select-field-cat')
    let spanCatSelect =catBlock.querySelector('input')
    let messageCat=catBlock.querySelector('.form-message')

    spanCatSelect.addEventListener("blur", function(){
      
      let catSelect =catBlock.querySelector('.select2-selection__choice')
      if(catSelect){
        messageCat.innerText = ""
        selectCat.classList.remove('invalid')
      }
      else 
      {
        messageCat.innerText = "Vui lòng chọn Categories"
        selectCat.classList.add('invalid')
      }
    })
    </script>





  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
    crossorigin="anonymous"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.0/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
  <script src="./JavaScript/multiTag.js">
  </script>
  <link rel="stylesheet" href="./CSS/fileUpload.css">

</body>

</html>