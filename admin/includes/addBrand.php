<?php
session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../../admin');
    exit();
}

if(isset($_POST['add-brand'])){
    include_once 'connection.php';
    $name = mysqli_real_escape_string($conn,$_POST['name']);

    $sql = "INSERT INTO brand (`name`) VALUES ('$name')";
    if (mysqli_query($conn, $sql)) {
        echo "New brand created successfully";
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