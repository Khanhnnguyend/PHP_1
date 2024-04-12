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
      <form method="POST" id="add_tag_form">
        <div class="mb-4">
          <label for="" class="form-label">Tag</label>
          <input type="text" class="form-control invalid" id="" name="name_tag">
          <p class="form-message" style="font-size:10px; color:red;"></p>
        </div>
        <div class="mb-4">
          <label for="" class="form-label">Description</label>
          <input type="text" class="form-control invalid" id="" name="tag_description">
          <p class="form-message" style="font-size:10px; color:red;"></p>
        </div>
   
        <button type="submit" name="add_tag" class="btn btn-primary">Add tag</button>
      </form>
      <p class="form_add_tag mt-2" style=" color:red;"></p>
      <a href="index.php?page=1"> <button type="button" class="btn btn-primary btn-sm mt-5">Back to product</button></a>
    </div>
    <div class="col">
      <form method="post" id="add_cat_form">
        <div class="mb-4">
          <label for="name_cat" class="form-label">Categories</label>
          <input type="text" class="form-control invalid" id=""  name="name_cat">
          <p class="form-message" style="font-size:10px; color:red;"></p>
        </div>
        <div class="mb-4">
          <label for="" class="form-label">Description</label>
          <input type="text" class="form-control invalid" id="" name="cat_description">
          <p class="form-message" style="font-size:10px; color:red;"></p>
        </div>
   
        <button type="submit" name="add_cat" class="btn btn-primary">Add cat</button>
      </form>
      <p class="form_add_cat mt-2" style=" color:red;"></p>

    </div>
  </div>
</div>
    

    

    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

  <script src="./JavaScript/validator.js"></script>
  <script>
    validator({
      form: '#add_tag_form',
      rules: [
        validator.isRequired("input[name=name_tag]"),
   
        validator.isRequired("input[name=tag_description]"),
       


      ]
    })

    validator({
      form: '#add_cat_form',
      rules: [
        validator.isRequired("input[name=name_cat]"),
        validator.isRequired("input[name=cat_description]"),
   


      ]
    })
  </script>

<script src="./JavaScript/addProperty.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
 
</body>
</html>


<!-- throw header vi js viet trong script -->