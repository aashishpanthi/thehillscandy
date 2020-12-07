<?php
session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../../admin');
    exit();
}

if(isset($_POST['admin-edit-product'])){
    include_once 'connection.php';
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $subcategory = mysqli_real_escape_string($conn,$_POST['subcategory']);
    $moreInfo = mysqli_real_escape_string($conn,$_POST['moreInfo']);
    $price = mysqli_real_escape_string($conn,$_POST['price']);
    $brand = mysqli_real_escape_string($conn,$_POST['brand']);
    $pid = mysqli_real_escape_string($conn,$_POST['pid']);

    if(!file_exists($_FILES['image']['tmp_name']) || !is_uploaded_file($_FILES['image']['tmp_name'])) {
        $sql = "UPDATE product SET name='$name', description='$moreInfo', price='$price', category_fk='$category', subcategory_fk='$subcategory', brand_fk='$brand' WHERE pid='$pid'";
        if (mysqli_query($conn, $sql)) {
            echo "Updated product successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            exit();
        }
        mysqli_close($conn);
    }
    else{
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
        mysqli_stmt_close($stmt_for_image);

        $image = $_FILES['image'];
        $imageTmpName = $image['tmp_name'];
        $imageName = $image['name'];
        $imageError = $image['error'];

        if($imageError > 0){
            echo 'There was an error uploading the file';
            exit();
        } 
        else{
            $imageFullName = uniqid('',true).$imageName;   
            $imageDestination = '../../images/products/'.$imageFullName;
            //Update product details
            $sql = "UPDATE product SET name='$name', description='$moreInfo', price='$price', image='$imageFullName', category_fk='$category', subcategory_fk='$subcategory', brand_fk='$brand' WHERE pid='$pid'";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                exit();
            }
            mysqli_close($conn);
        
            //Upload image or move to image folder
            move_uploaded_file($imageTmpName,$imageDestination);
        }
    }

    header('Location: ../products.php');
    exit();
}

else{
    header('Location: ../');
    exit();
}