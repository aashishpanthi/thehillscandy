<?php

session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../');
    exit();
}

include_once '../includes/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Section</title>
    <link rel='stylesheet' href='../css/dashboard.css'>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <style>
        .table td, .table th {
            padding:5px 0px 5px 5px !important;
        }

        input[type='image'] {
            width: 100px;
            object-fit:contain;
            max-height:100px;
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
        <h1>Add Section</h1>
        <form class='mt-5' action='../includes/addsection.inc.php' method='post'>
            <div class="form-group">
                <label for="sectionName">Section name</label>
                <input type="text" class="form-control" name='name' aria-describedby="sectionNameHelp" id="sectionName" placeholder="Section name" required>
                <small id="sectionNameHelp" class="form-text text-muted">Title of the section that will show as heading in home page and other places.</small>
            </div>
            <table class="table table-striped table-dark table-hover">
            <caption>List of products in database</caption>
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
            $sql = 'SELECT * FROM product';
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
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
                                    echo '
                                        <tr class="product">
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" name="product[]" type="checkbox" id="item'.$row["pid"].'" value='.$row["pid"].'>
                                                    <label class="form-check-label" for="item'.$row["pid"].'">'.$row["pid"].'</label>
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
        }else {
            echo "0 results";
            }
            $conn->close();
            ?>
            </tbody>
        </table>
            <button type="submit" name='addSection' class="btn btn-primary my-2 ml-auto d-block">Add Section</button>
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
