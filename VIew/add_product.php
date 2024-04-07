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
  <form action="" method="POST" enctype="multipart/form-data" id="form_add_product" >
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="mb-4">
            <label for="" class="form-label">Product name</label>
            <input type="text" class="form-control invalid" id="" name="name_product">
            <p class="form-message" style="font-size:10px; color:red;"></p>
          </div>
          <div class="mb-4">
            <label for="" class="form-label">SKU</label>
            <input type="text" class="form-control invalid" id="" name="sku">
            <p class="form-message" style="font-size:10px; color:red;"></p>
          </div>

          <div class="mb-4">
            <label for="" class="form-label">Price</label>
            <input type="number" class="form-control invalid" id="" name="price">
            <p class="form-message" style="font-size:10px; color:red;"></p>

          </div>
          <div class="mb-4">
            <label for="" class="form-label">Date</label>
            <input type="date" class="form-control" id="" name="date">
            <p class="form-message" style="font-size:10px; color:red;"></p>
          </div>

        </div>
        <div class="col">
          <div class="mb-4">
            <label for="" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" id="file" >
            <p class="form-message" style="font-size:10px; color:red;"></p>
            <div class="image"></div>

          </div>
          <div class="mb-4">
            <label for="" class="form-label">Tags</label>
            <select multiple name="tags[]" class="form-select" id="multiple-select-field-tag" data-placeholder="Tags">
              <?php foreach ($tags as $tag): ?>
                <option value="<?php echo $tag->id ?>">
                  <?php echo $tag->tag_name ?>
                </option>
              <?php endforeach ?>

            </select>
            <p class="form-message" style="font-size:10px; color:red;"></p>
          </div>



          <div class="mb-4">
            <label for="" class="form-label">Categories</label>
            <select class="form-control" name="categories[]" id="multiple-select-field-cat" data-placeholder="category"
              multiple>
              <?php foreach ($categories as $cat): ?>
                <option value="<?php echo $cat->id ?>">
                  <?php echo $cat->cat_name ?>
                </option>
              <?php endforeach ?>


            </select>
            <p class="form-message" style="font-size:10px; color:red;"></p>

          </div>
          <div class="mb-4">
            <label for="" class="form-label">Gallery</label>
            <div class="upload__box">
              <div class="upload__btn-box">
                <label class="upload__btn">
                  <p>Upload images</p>
                  <input type="file" multiple="" data-max_length="20" class="upload__inputfile" name="gallery[]">
                </label>
              </div>
              <div class="upload__img-wrap"></div>
            </div>
            <p class="form-message" style="font-size:10px; color:red;"></p>
          </div>

        </div>
      </div>

      <button type="submit" name="insert_product" class="btn btn-primary btn-sm">ADD</button>
  </form>
  <p class="form_add_message" style=" color:red;"></p>

  <a href="index.php?page=1"> <button type="button" class="btn btn-primary btn-sm mt-5">Back to product</button></a>



  <script src="http://localhost/PHP_1/JavaScript/validator.js"></script>

  <script>
    validator({
      form: '#form_add_product',
      rules: [
        validator.isRequired("input[name=name_product]"),
        validator.isRequired("input[name=price]"),
        validator.isRequired("input[name=sku]")

      ]
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
  <script src="http://localhost/PHP_1/JavaScript/multiTag.js">
  </script>
  <link rel="stylesheet" href="http://localhost/PHP_1/CSS/fileUpload.css">
  <script src="http://localhost/PHP_1/JavaScript/addProduct.js"></script>
 
</body>

</html>