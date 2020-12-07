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
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
        <h1>Slider Image</h1>
        <form class='mt-5' method='post' enctype="multipart/form-data" action='includes/slider.inc.php'>
            <div class="form-group my-3">
                <label for="image1">Select image 1</label>
                <div class="custom-file">
                    <input type="file" name='image1' class="custom-file-input" id="image1" accept="image/*" required />
                    <label class="custom-file-label" for="image1">Choose image</label>
                </div>
            </div>
            <div class="form-group my-3">
                <label for="image2">Select image 2</label>
                <div class="custom-file">
                    <input type="file" name='image2' class="custom-file-input" id="image2" accept="image/*" required />
                    <label class="custom-file-label" for="image2">Choose image</label>
                </div>
            </div>
            <div class="form-group my-3">
                <label for="image3">Select image 3</label>
                <div class="custom-file">
                    <input type="file" name='image3' class="custom-file-input" id="image3" accept="image/*" required />
                    <label class="custom-file-label" for="image3">Choose image</label>
                </div>
            </div>
            <div class="form-group my-4 d-flex justify-content-between px-3">
                <button type="button" id="add" class="btn btn-secondary d-flex align-center"><span class="material-icons">add</span> Add more</button>
                <button type="submit" name='admin-add-image' class="btn btn-primary">Save changes</button>
            </div>
            <input name='imagesSize' id='imagesSize' value=3 type="hidden" />
        </form>
    </div>
   </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script>
// To show the name of the file appear on select
function fileName(){
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
}

fileName();

let imgNo = 3;
const imageSizeElement = document.querySelector('#imagesSize');

$("#add").on("click", function() {
    if(imgNo === 10){
        alert(`That's enough`);
    }
    else{
        imgNo++;
        imageSizeElement.value = imgNo;
        const div = `
            <div class="form-group my-3">
                <label for="image${imgNo}">Select image ${imgNo}</label>
                <div class="custom-file">
                    <input type="file" name='image${imgNo}' class="custom-file-input" id="image${imgNo}" accept="image/*" required />
                    <label class="custom-file-label" for="image${imgNo}">Choose image</label>
                </div>
            </div>
        `;
        const lastElement = `#image${imgNo - 1}`;
        $(lastElement).after(div);

        fileName();
    }
});
</script>
</body>
</html>
