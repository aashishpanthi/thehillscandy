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
    <title>All Products</title>
    <link rel='stylesheet' href='./css/dashboard.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <style>
        .table td, .table th {
            padding:10px 0px 5px 8px !important;
        }

        .table{
            min-width:100vw;
        }

        .table td{
            font-family:sans-serif;
        }

        button span{
            font-size:18px !important;
            transition:all .3s;
        }

        button:hover span{
            opacity:0.8;
        }

        input[type='image'] {
            width: 80px;
        }
    </style>
</head>
<body>
<div class="admin-panel clearfix">
    <?php include_once './comps/sidebar.html'; ?>
  <div class="main">
    <ul class="topbar">
      <li><a href="includes/logout.php">Logout</a></li>
      <input placeholder=' Filter' id='productFilter' />
    </ul>
    <div class="mainContent container">
        <h1>All Products:</h1>
        <div class='table-responsive'>
        <table class="table table-striped table-dark table-hover">
            <caption>List of products in database</caption>
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Action</th>
                <th scope="col">Name</th>
                <th scope="col">More Information</th>
                <th scope="col">Price</th>
                <th scope="col">Image</th>
                <th scope="col">Rating</th>
                <th scope="col">Category</th>
                <th scope="col">Subcategory</th>
                <th scope="col">Brand</th>
                <th scope="col">Uploaded at</th>
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
                            $subcategory_fk = $row['subcategory_fk'];
                            $sql_for_subcategory = "SELECT name FROM subcategory WHERE id='$subcategory_fk'";
                            $result_for_subcategory = $conn->query($sql_for_subcategory);

                            if ($result_for_subcategory->num_rows > 0) {
                                while($subcategory = $result_for_subcategory->fetch_assoc()) {
                                    $brand_fk = $row['brand_fk'];
                                    $sql_for_brand = "SELECT name FROM brand WHERE id='$brand_fk'";
                                    $result_for_brand = $conn->query($sql_for_brand);

                                    if ($result_for_brand->num_rows > 0) {
                                        while($brand = $result_for_brand->fetch_assoc()) {
                                            echo '
                                                <tr class="product">
                                                    <th scope="row">'.$row['pid'].'</th>
                                                    <td>
                                                        <button data-id='.$row['pid'].' class="btn btn-info btn-sm d-flex align-center edit-btn" data-toggle="tooltip" data-placement="left" title="Edit this product">
                                                            <span class="material-icons"> create </span>
                                                        </button>
                                                        <button data-id='.$row['pid'].' class="btn btn-danger btn-sm d-flex align-center mt-2 delete-btn" data-toggle="tooltip" data-placement="right" title="Delete this product">
                                                            <span class="material-icons">delete</span>
                                                        </button>
                                                    </td>
                                                    <td>'.$row['name'].'</td>
                                                    <td>'.$row['description'].'</td>
                                                    <td>$'.$row['price'].'</td>
                                                    <td><input type="image" alt="image" src="../images/products/'.$row['image'].'"></td>
                                                    <td>'.$row['rating'].'</td>
                                                    <td>'.$category['category'].'</td>
                                                    <td>'.$subcategory['name'].'</td>
                                                    <td>'.$brand['name'].'</td>
                                                    <td>'.$row['uploaded'].'</td>
                                                </tr>';
                                        }
                                    }
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
    </div>
    </div>
   </div>
</div>


<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>

    $(document).ready(function () {
    $("#productFilter").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $("table .product").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(".edit-btn").click(function () {
        console.log(this.dataset.id);
        window.location = `./includes/editProduct.php?pid=${this.dataset.id}`;
    })
    $(".delete-btn").on("click", function () { 
        swal({
            title: "Are you sure?",
            text: "Once deleted, you will not be able to recover this product!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                swal("Poof! product has been deleted!", {
                icon: "success",
                });
                window.location = `./includes/deleteProduct.php?pid=${this.dataset.id}`
            } else {
                swal("Product is safe!");
            }
            });
        })
        
    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
});

</script>
</body>
</html>
