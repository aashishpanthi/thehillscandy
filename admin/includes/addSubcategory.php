<?php
session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../../admin');
    exit();
}

if(isset($_POST['add-subcategory'])){
    include_once 'connection.php';
    $name = mysqli_real_escape_string($conn,$_POST['name']);

    $sql = "INSERT INTO subcategory (`name`) VALUES ('$name')";
    if (mysqli_query($conn, $sql)) {
        echo "New sub category created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        exit();
    }
    mysqli_close($conn);

    header('Location: ../category.php');
    exit();
}

else{
    header('Location: ../');
    exit();
}