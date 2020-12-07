<?php
session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../../admin');
    exit();
}

if(isset($_GET['pid'])){
    include_once 'connection.php';
    $pid = $_GET['pid'];
    $sql = "DELETE FROM product WHERE pid = ?;";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql )){
        echo 'Deleting product failed';
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'i', $pid);
    
    $sql = "SELECT image FROM product WHERE pid = ?;";
    $stmt_for_image = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt_for_image,$sql )){
        echo 'Quering image of product failed';
        exit();
    }
    mysqli_stmt_bind_param($stmt_for_image, 'i', $pid);
    mysqli_stmt_execute($stmt_for_image);
    $result = mysqli_stmt_get_result($stmt_for_image);
    
    while($product = mysqli_fetch_assoc($result)) {
        $image = $product['image'];
        unlink("../../images/products/".$image);
        echo 'Image deleted successfully';
    }

    mysqli_stmt_execute($stmt);
    echo 'Record(product) Deleted successfully';
    mysqli_stmt_close($stmt);
    mysqli_stmt_close($stmt_for_image);
    header('Location: ../products.php');
    exit();
}

else{
    header('Location: ../products.php');
    exit();
}