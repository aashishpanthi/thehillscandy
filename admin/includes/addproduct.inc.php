<?php
session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../../admin');
    exit();
}

if(isset($_POST['admin-add-product'])){
    include_once 'connection.php';
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    $category = mysqli_real_escape_string($conn,$_POST['category']);
    $subcategory = mysqli_real_escape_string($conn,$_POST['subcategory']);
    $moreInfo = mysqli_real_escape_string($conn,$_POST['moreInfo']);
    $price = mysqli_real_escape_string($conn,$_POST['price']);
    $brand = mysqli_real_escape_string($conn,$_POST['brand']);

    if(!isset($_FILES['image'])){
        header('Location: ../addproduct.php');
    }
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

        $sql = "INSERT INTO product (`name`, `description`, `price`, `image`, `rating`, `category_fk`, `subcategory_fk`, `brand_fk`) VALUES ('$name','$moreInfo', '$price', '$imageFullName', '0', '$category', '$subcategory', '$brand' )";
        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            exit();
        }
        mysqli_close($conn);

        //Upload stuffs to database
        move_uploaded_file($imageTmpName,$imageDestination);
        header('Location: ../addproduct.php');
        exit();
    }
}

else{
    header('Location: ../');
    exit();
}