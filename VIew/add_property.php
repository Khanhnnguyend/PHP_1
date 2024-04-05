<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>add property</title>
</head>
<body>

<div class="container">
  <div class="row">
    <div class="col">
      <form method="POST">
        <div class="mb-3">
          <label for="name_tag" class="form-label">Tag</label>
          <input type="text" class="form-control" id="" name="name_tag">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Description</label>
          <input type="text" class="form-control" id="" name="tag_description">
        </div>
   
        <button type="submit" name="add_tag" class="btn btn-primary">Add tag</button>
      </form>
    </div>
    <div class="col">
      <form method="post">
        <div class="mb-3">
          <label for="name_cat" class="form-label">Categories</label>
          <input type="text" class="form-control" id=""  name="name_cat">
        </div>
        <div class="mb-3">
          <label for="" class="form-label">Description</label>
          <input type="text" class="form-control" id="" name="cat_description">
        </div>
   
        <button type="submit" name="add_cat" class="btn btn-primary">Add cat</button>
      </form>
    </div>
  </div>
</div>
    
    

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  <!-- <script src="../JavaScript/multiTag.js"></script> -->
  <script src="http://localhost/PHP_1/JavaScript/validator.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
</body>
</html>