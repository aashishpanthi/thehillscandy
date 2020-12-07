<?php

session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../');
    exit();
}

include_once '../includes/connection.php';

if(!isset($_GET['section'])){
    header('Location: ../');
    exit();
}

$id = mysqli_real_escape_string($conn,$_GET['section']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Section</title>
    <link rel='stylesheet' href='../css/dashboard.css'>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        .table td, .table th {
            padding:5px 0px 5px 5px !important;
            max-width:300px;
        }

        input[type='image'] {
            width: 80px;
            object-fit:contain;
            max-height:80px;
        }
    </style>
</head>
<body>
<div class="admin-panel">
    <?php include_once './sidebar.html'; ?>
  <div class="main">
    <ul class="topbar">
      <li><a href="includes/logout.php">Logout</a></li>
      <input id='productFilter' placeholder=' Search' />
    </ul>
    <div class="mainContent container">
        <h1>Edit Section</h1>
        <form class='mt-5' action='../includes/updateSection.php' method='post'>

        <?php
        $sql = "SELECT name FROM sections WHERE id = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$sql )){
            echo 'Checking category failed';
            exit();
        }
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        while($section = mysqli_fetch_assoc($result)) {
            $sectionName = $section['name'];
            $sectionRealName = str_replace(' ', '_', $sectionName);
?>

            <input type="hidden" name="id" value='<?php echo $id; ?>'>
            <div class="form-group">
                <label for="sectionName">Section name</label>
                <input type="text" class="form-control" value='<?php echo $sectionRealName; ?>' name='name' aria-describedby="sectionNameHelp" id="sectionName" placeholder="Section name" required>
                <small id="sectionNameHelp" class="form-text text-muted">Title of the section that will show as heading in home page and other places.</small>
            </div>

            <table class="table table-striped table-dark table-hover">
                <thead>
                    <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Image</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Brand</th>
                    </tr>
                </thead>
                <tbody>

<?php

            
            $sql_for_product = 'SELECT * FROM product';
            $result_of_product = $conn->query($sql_for_product);

            if ($result_of_product->num_rows > 0) {
                while($row = $result_of_product->fetch_assoc()) {
                    $category_fk = $row['category_fk'];
                    $sql_for_category = "SELECT category FROM category WHERE id='$category_fk'";
                    $result_for_category = $conn->query($sql_for_category);

                    if ($result_for_category->num_rows > 0) {
                        while($category = $result_for_category->fetch_assoc()) {
                            $brand_fk = $row['brand_fk'];
                            $sql_for_brand = "SELECT name FROM brand WHERE id='$brand_fk'";
                            $result_for_brand = $conn->query($sql_for_brand);

                            if ($result_for_brand->num_rows > 0) {
                                while($brand = $result_for_brand->fetch_assoc()) {
                                    $productId = $row["pid"];
                                    $sql_for_product_id = "SELECT product_id FROM $sectionName WHERE product_id = $productId";
                                    $result_of_product_id = mysqli_query($conn, $sql_for_product_id);
                                    if (mysqli_num_rows($result_of_product_id) > 0) {
                                        while($sectionRow = mysqli_fetch_assoc($result_of_product_id)) {
                                            if($sectionRow['product_id'] == $row['pid']){
                                                echo '
                                                    <tr class="product">
                                                        <th scope="row">
                                                            <div class="form-check">
                                                                <input class="form-check-input" name="product[]" type="checkbox" id="item'.$productId.'" value='.$productId.' checked>
                                                                <label class="form-check-label" for="item'.$productId.'">'.$productId.'</label>
                                                            </div>
                                                        </th>
                                                        <td><input type="image" alt="image" src="../../images/products/'.$row['image'].'"></td>
                                                        <td>'.$row['name'].'</td>
                                                        <td>$'.$row['price'].'</td>
                                                        <td>'.$category['category'].'</td>
                                                        <td>'.$brand['name'].'</td>
                                                    </tr>';
                                            }
                                        }
                                    }
                                    else{
                                        echo '
                                            <tr class="product">
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" name="product[]" type="checkbox" id="item'.$productId.'" value='.$productId.'>
                                                        <label class="form-check-label" for="item'.$productId.'">'.$productId.'</label>
                                                    </div>
                                                </th>
                                                <td><input type="image" alt="image" src="../../images/products/'.$row['image'].'"></td>
                                                <td>'.$row['name'].'</td>
                                                <td>$'.$row['price'].'</td>
                                                <td>'.$category['category'].'</td>
                                                <td>'.$brand['name'].'</td>
                                            </tr>';
                                    }
                                }
                            }
                        }
                    }
                }
            }else {
            echo "0 results";
            }
        }
        $conn->close();

        ?>
            </tbody>
        </table>
        <div class="d-flex">
            <button type="submit" name='deleteSection' class="btn btn-danger my-2">Delete Category</button>
            <button type="submit" name='updateSection' class="btn btn-primary my-2 ml-auto">Save Changes</button>
        </div>
        </form>
    </div>
   </div>
</div>

<script>
$(document).ready(function () {
    $("#productFilter").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("table .product").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
</body>
</html>
