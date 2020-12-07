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
    <title>Categories || Admin ~ The HillsCandy</title>
    <link rel='stylesheet' href='./css/dashboard.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
</head>
<body>
<div class="admin-panel clearfix">
    <?php include_once './comps/sidebar.html'; ?>
  <div class="main">
    <ul class="topbar">
      <li><a href="includes/logout.php">Logout</a></li>
      <input id='Filter' placeholder=' Filter' />
    </ul>
    <div class="mainContent container mb-5">
        <div class="row">
            <div class="col-sm-4 col-4">
                <h2>Categories</h2>
                <table class="table table-striped table-dark table-hover">
                    <caption>Categories stored in database</caption>
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Categories</th>
                        </tr>
                    </thead>
                    <tbody>
        
                    <?php
                    $sql = 'SELECT * FROM category';
                    $result = $conn->query($sql);
        
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '
                            <tr class="searchable">
                                <th scope="row">'.$row['id'].'</th>
                                <td>'.$row['category'].'</td>
                            </tr>';
                    }
                    } else {
                    echo "0 results";
                    }
                    ?>
                    </tbody>
                </table>
                <form class="form-inline px-2" action="./includes/addCategory.php" method="post">
                    <div class="form-group mr-2 flex-fill">
                        <label class="sr-only" for="NewCategory">Category</label>
                        <input type="text" name="name" class="form-control w-100" id="NewCategory" placeholder="Category Name" required>
                    </div>
                    <button type="submit" name="add-category" class="btn btn-primary">Add</button>
                </form>
            </div>

            <div class="col-sm-4 col-4">
                <h2>Sub Categories</h2>
                <table class="table table-striped table-dark table-hover">
                    <caption>Subcategories stored in database</caption>
                    <thead>
                        <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Subcategories</th>
                        </tr>
                    </thead>
                    <tbody>
        
                    <?php
                    $sql = 'SELECT * FROM subcategory';
                    $result = $conn->query($sql);
        
                    if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo '
                            <tr class="searchable">
                                <th scope="row">'.$row['id'].'</th>
                                <td>'.$row['name'].'</td>
                            </tr>';
                    }
                    } else {
                    echo "0 results";
                    }
                    ?>
                    </tbody>
                </table>
                <form class="form-inline" action="./includes/addSubcategory.php" method="post">
                    <div class="form-group mr-2 flex-fill">
                        <label class="sr-only" for="NewSubcategory">Sub Category</label>
                        <input type="text" name="name" class="form-control w-100" id="NewSubcategory" placeholder="Subcategory Name" required>
                    </div>
                    <button type="submit" name="add-subcategory" class="btn btn-primary">Add</button>
                </form>
            </div>
            <div class="col-sm-4 col-4">
                <h2>Brands</h2>
                <div class="table-responsive">
                    <table class="table table-striped table-dark table-hover">
                        <caption>Brands stored in database</caption>
                        <thead>
                            <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Brands</th>
                            <th scope="col">Created At</th>
                            </tr>
                        </thead>
                        <tbody>
            
                        <?php
                        $sql = 'SELECT * FROM brand';
                        $result = $conn->query($sql);
            
                        if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo '
                                <tr class="searchable">
                                    <th scope="row">'.$row['id'].'</th>
                                    <td>'.$row['name'].'</td>
                                    <td>'.$row['created_at'].'</td>
                                </tr>';
                        }
                        } else {
                        echo "0 results";
                        }
                        $conn->close();
                        ?>
                        </tbody>
                    </table>
                </div>
                <form class="form-inline" action="./includes/addBrand.php" method="post">
                    <div class="form-group mr-2 flex-fill">
                        <label class="sr-only" for="NewBrand">Brand</label>
                        <input type="text" name="name" class="form-control w-100" id="NewBrand" placeholder="Brand Name" required>
                    </div>
                    <button type="submit" name="add-brand" class="btn btn-primary">Add</button>
                </form>
            </div>
        </div>
     </div>
   </div>
</div>

<script>

$(document).ready(function () {
    $("#Filter").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".table .searchable").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
</body>
</html>
