<?php
session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../');
    exit();
}

if(isset($_POST['addSection'])){
    include_once 'connection.php';
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    
    if(!isset($_POST['product'])){
        echo 'Select at least one item';
        exit();
    }
    
    $products = $_POST['product'];

    $finalName = str_replace(' ', '_', $name);

    $sql = "CREATE TABLE $finalName ( id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, product_id int NOT NULL);";
    if(!mysqli_query($conn,$sql)){
        echo 'Section already exists, try another one!';
        exit();
    }

    $sql = "INSERT INTO sections(`name`) VALUES('$finalName')";
    if(!mysqli_query($conn,$sql)){
        echo 'insertion failed';
        exit();
    }


    foreach ($products as $product) {
        $sql = "INSERT INTO $finalName (product_id) VALUES('$product')";
        if(mysqli_query($conn,$sql)){
            echo 'successfully created';
        }
        else{
            echo 'Failed to create section';
            exit();
        }
    }

    mysqli_close($conn);
    header('Location: ../sections.php');
    exit();
}

else{
    header('Location: ../');
    exit();
}
