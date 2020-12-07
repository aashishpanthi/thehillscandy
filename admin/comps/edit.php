<?php

session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../product.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel='stylesheet' href='../css/dashboard.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="admin-panel clearfix">
  <div class="main">
    <div class="mainContent container">
        <h1>Edit product</h1>
        <form class='mt-5'>
            
        </form>
    </div>
   </div>
</div>
</body>
</html>
