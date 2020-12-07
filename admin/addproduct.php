<?php

session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../admin');
    exit();
}

include_once 'includes/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel='stylesheet' href='./css/dashboard.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        select,
        select option{
            text-transform:capitalize;
        }
    </style>
</head>
<body>
<div class="admin-panel clearfix">
    <?php include_once './comps/sidebar.html'; ?>
  <div class="main">
    <ul class="topbar">
      <li><a href="includes/logout.php">Logout</a></li>
      <input placeholder=' Search' />
    </ul>
    <div class="mainContent container">
        <h1>New product</h1>
        <form class='mt-5' method='post' enctype="multipart/form-data" action='includes/addproduct.inc.php'>
            <div class="form-group">
                <label for="productTitle">Product name</label>
                <input type="text" required name='name' class="form-control" id="productTitle" aria-describedby="titleHelp" placeholder="Enter product name">
                <small id="titleHelp" class="form-text text-muted">This is the name shown all over the website (main text).</small>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="categorySelect">Select category</label>
                    <select class="form-control" name='category' id="categorySelect">
                        <?php
                            //fetching data from database and showing the options
                            $sql = 'SELECT * FROM category';
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value=".$row['id'].">".$row['category']."</option>";
                                }
                              } else {
                                echo '<option>Failed</option>';
                                exit();
                              }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="subCategorySelect">Select Sub Category</label>
                    <select class="form-control" name='subcategory' id="subCategorySelect">
                    <?php
                            //fetching data from database and showing the options
                            $sql = 'SELECT * FROM subcategory';
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value=".$row['id'].">".$row['name']."</option>";
                                }
                              } else {
                                echo '<option>Failed</option>';
                                exit();
                              }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="productDescription">Product Description</label>
                <textarea required class="form-control" name='moreInfo' id="productDescription" aria-describedby="descHelp" rows="5"></textarea>
                <small id="descHelp" class="form-text text-muted">Give more information about this product.</small>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="productPrice">Price</label>
                    <input type="number" required class="form-control" name='price' id="productPrice" placeholder="Enter price of this product">
                </div>
                <div class="form-group col-md-6">
                    <label for="choosebrand">Choose Brand</label>
                    <select class="form-control" name='brand' id="choosebrand">
                    <?php
                            //fetching data from database and showing the options
                            $sql = 'SELECT * FROM brand';
                            $result = mysqli_query($conn, $sql);

                            if (mysqli_num_rows($result) > 0) {
                                while($row = mysqli_fetch_assoc($result)) {
                                  echo "<option value=".$row['id'].">".$row['name']."</option>";
                                }
                              } else {
                                echo '<option>Failed</option>';
                                exit();
                              }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group my-3">
                <label for="customFile">Select image</label>
                <div class="custom-file">
                    <input type="file" name='image' class="custom-file-input" id="customFile" accept="image/*" required />
                    <label class="custom-file-label" for="customFile">Choose image</label>
                </div>
            </div>
            <button type="submit" name='admin-add-product' class="btn btn-primary mb-2 mx-auto d-block">Add product</button>
        </form>
    </div>
   </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
// To show the name of the file appear on select
$(".custom-file-input").on("change", function() {
  var fileName = $(this).val().split("\\").pop();
  $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
});
</script>
</body>
</html>
