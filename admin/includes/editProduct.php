<?php
session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../../admin');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel='stylesheet' href='../css/dashboard.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        select,
        select option{
            text-transform:capitalize;
        }
    </style>
</head>
<body>

<?php
if(isset($_GET['pid'])){
    include_once 'connection.php';
    $pid = $_GET['pid'];
    $sql = "SELECT * FROM product WHERE pid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql )){
        echo 'Editing product failed';
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'i', $pid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    while($product = mysqli_fetch_assoc($result)) {            
        ?>
        <div class="admin-panel">
        <div class="main">
            <div class="mainContent container">
                <h1>Edit product</h1>
                <form class='mt-5' method='post' enctype="multipart/form-data" action='./updateProduct.php'>
                    <div class="form-group">
                        <label for="productTitle">Product name</label>
                        <input type="text" value="<?php echo $product['name']; ?>" name='name' class="form-control" id="productTitle" aria-describedby="titleHelp" placeholder="Enter product name">
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
                                            if($row['id'] == $product['category_fk']){
                                                echo "<option value=".$row['id']." selected>".$row['category']."</option>";
                                            }
                                            else{
                                                echo "<option value=".$row['id'].">".$row['category']."</option>";
                                            }
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
                                            if($row['id'] == $product['subcategory_fk']){
                                                echo "<option value=".$row['id']." selected>".$row['name']."</option>";
                                            }
                                            else{
                                                echo "<option value=".$row['id'].">".$row['name']."</option>";
                                            }
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
                        <textarea class="form-control" name='moreInfo' id="productDescription" aria-describedby="descHelp" rows="5"><?php echo $product['description']; ?></textarea>
                        <small id="descHelp" class="form-text text-muted">Give more information about this product.</small>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="productPrice">Price</label>
                            <input value="<?php echo $product['price']; ?>" type="number" class="form-control" name='price' id="productPrice" placeholder="Enter price of this product">
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
                                            if($row['id'] == $product['brand_fk']){
                                                echo "<option value=".$row['id']." selected>".$row['name']."</option>";
                                            }
                                            else{
                                                echo "<option value=".$row['id'].">".$row['name']."</option>";
                                            }
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
                            <input type="file" name='image' class="custom-file-input" id="customFile" accept="image/*" />
                            <label class="custom-file-label" for="customFile">Choose image</label>
                        </div>
                    </div>
                    <div class="form-group my-3 d-flex align-center">
                        <a href="../products.php" class="btn btn-secondary">Cancel</a>
                        <button type="submit" name='admin-edit-product' class="btn px-5 btn-primary ml-auto">Update</button>
                    </div>
                    <input type="hidden" value="<?php echo $product['pid']; ?>" name='pid'>
                </form>
            </div>
        </div>
    <?php
    }
}

else{
    header('Location: ../');
    exit();
}

?>
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