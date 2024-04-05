<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
  <link rel="stylesheet" href="../CSS/add.css">
  <title>Add product</title>
</head>

<body>
  <form action="" method="POST" enctype="multipart/form-data">
    <div class="container">
      <div class="row">
        <div class="col">
          <div class="mb-3">
            <label for="" class="form-label">Product name</label>
            <input type="text" class="form-control" id="" name="name_product">

          </div>
          <div class="mb-3">
            <label for="" class="form-label">SKU</label>
            <input type="text" class="form-control" id="" name="sku">
          </div>

          <div class="mb-3">
            <label for="" class="form-label">Price</label>
            <input type="number" class="form-control" id="" name="price">

          </div>
          <div class="mb-3">
            <label for="" class="form-label">Date</label>
            <input type="date" class="form-control" id="" name="date">
          </div>
         
        </div>
        <div class="col">
          <div class="mb-3">
            <label for="" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" id="file" onchange="previewImage()">
            <div class="image"></div>

          </div>
          <div class="mb-3">
            <label for="" class="form-label">Tags</label>
            <select multiple  class="form-control" name="tags[]">
              <?php foreach($tags as $tag): ?>
              <option value ="<?php echo $tag->id ?>"> <?php echo $tag->tag_name ?></option>
              <?php endforeach ?>
              
            </select>
          </div>

          <div class="mb-3">
            <label for="" class="form-label">Categories</label>
            <select multiple  class="form-control" name="categories[]">
            <?php foreach($categories as $cat): ?>
              <option value ="<?php echo $cat->id ?>"> <?php echo $cat->cat_name ?></option>
              <?php endforeach ?>
              
            </select>

          </div>
          <div class="mb-3">
            <label for="" class="form-label">Gallery</label>
            <input type="file" class="form-control" id="" name="gallery[]" multiple>
          </div>
        </div>
      </div>

      <button type="submit" name="insert_product" class="btn btn-primary btn-sm">ADD</button>
  </form>

  <a href="index.php"> <button type="button"class="btn btn-primary btn-sm">Product</button></a>
  
  <script src="../JavaScript/imgInput.js"></script>
  <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <!-- <script src="../JavaScript/multiTag.js"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
    
</body>

</html>