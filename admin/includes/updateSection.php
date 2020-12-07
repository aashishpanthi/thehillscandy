<?php
session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../');
    exit();
}

if(isset($_POST['updateSection'])){
    include_once 'connection.php';
    $id = mysqli_real_escape_string($conn,$_POST['id']);
    $name = mysqli_real_escape_string($conn,$_POST['name']);
    
    if(!isset($_POST['product'])){
        echo 'Select at least one item';
        exit();
    }
    
    $products = $_POST['product'];

    $finalName = str_replace(' ', '_', $name);

    $sql = "SELECT name FROM sections WHERE id = $id";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $tableName = $row['name'];
        if($finalName != $tableName){
            $sql = "DROP TABLE $tableName";
            if(!mysqli_query($conn,$sql)){
                echo 'Failed to update!';
                exit();
            }

            $sql = "CREATE TABLE $finalName ( id INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL, product_id int NOT NULL);";
            if(!mysqli_query($conn,$sql)){
                echo 'Section already exists, try another one!';
                exit();
            }

            $sql = "UPDATE sections SET name='$finalName' WHERE id = $id";
            if(!mysqli_query($conn,$sql)){
                echo 'UPDATING section name failed';
                exit();
            }
        }
    }


    $sql = "TRUNCATE TABLE $finalName";
    if(mysqli_query($conn, $sql)){
        echo 'All data is deleted from table';
    }
    else{
        echo 'Error while deleting data from database';
        exit();
    }

    foreach ($products as $product) {
        $sql = "INSERT INTO $finalName(`product_id`) VALUES('$product')";
        if(mysqli_query($conn,$sql)){
            echo 'Successfully updated';
        }
        else{
            echo 'Failed to update section';
            exit();
        }
    }

    mysqli_close($conn);
    header('Location: ../sections.php');
    exit();
}

else if(isset($_POST['deleteSection'])){
    include_once 'connection.php';
    $id = mysqli_real_escape_string($conn,$_POST['id']);

    $sql = "SELECT name FROM sections WHERE id = $id";
    $result = mysqli_query($conn,$sql);

    while($row = mysqli_fetch_assoc($result)){
        $tableName = $row['name'];
        $sql = "DROP TABLE $tableName";
        if(!mysqli_query($conn,$sql)){
            echo 'Failed to update!';
            exit();
        }
    }

    $sql = "DELETE FROM sections WHERE id = $id";
    if(!mysqli_query($conn,$sql)){
        echo 'DELETING section name failed';
        exit();
    }

    mysqli_close($conn);
    header('Location: ../sections.php');
    exit();
}

else{
    header('Location: ../');
    exit();
}
