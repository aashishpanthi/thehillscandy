<?php
session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../../admin');
    exit();
}

if(isset($_POST['admin-add-image'])){
    include_once '../../hidden/connection.php';
    $imagesSize = mysqli_real_escape_string($conn,$_POST['imagesSize']);

    $sql = "SELECT name FROM slider";
    $result = mysqli_query($conn, $sql);
    
    while($row = mysqli_fetch_assoc($result)) {
        $image = $row['name'];
        unlink("../../images/slider/".$image);
        echo 'Image deleted successfully';
    }

    $sql = "TRUNCATE TABLE slider";
    if(mysqli_query($conn, $sql)){
        echo 'All data is deleted from table';
    }
    else{
        echo 'Error while deleting data from database';
    }

    for($i = 1; $i <= $imagesSize; $i++){
        $image = $_FILES['image'.$i];
        $imageTmpName = $image['tmp_name'];
        $imageName = $image['name'];
        $imageError = $image['error'];

        if($imageError > 0){
            echo 'There was an error uploading the file';
            exit();
        } 
    
        else{
            $imageFullName = uniqid('',true).$imageName;   
            $imageDestination = '../../images/slider/'.$imageFullName;
            
            //Insert name of image
            $sql = "INSERT INTO slider(name) VALUES('$imageFullName')";
            if (mysqli_query($conn, $sql)) {
                echo "Image inserted successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                exit();
            }
            
            //Upload image or move to image folder
            move_uploaded_file($imageTmpName,$imageDestination);
            echo 'uploaded successfully';
        }
    }
    mysqli_close($conn);
    echo 'all tasks done';

    header('Location: ../slider.php');
    exit();
}

else{
    header('Location: ../');
    exit();
}