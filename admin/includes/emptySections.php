<?php
session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../');
    exit();
}

if(isset($_GET['coajsdhkajsnfirmed'])){
    include_once 'connection.php';
    $confirmed = mysqli_real_escape_string($conn,$_GET['coajsdhkajsnfirmed']);
    
    if($confirmed === '1yepp1'){
        $sql = "SELECT name FROM sections";
        $result = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_assoc($result)){
            $tableName = $row['name'];
            $sql = "DROP TABLE $tableName";
            if(!mysqli_query($conn,$sql)){
                echo 'Failed to delete!';
                exit();
            }
        }

        $sql = "TRUNCATE TABLE sections";
        if(mysqli_query($conn, $sql)){
            echo 'All data is deleted from table';
            mysqli_close($conn);
            header('Location: ../sections.php');
            exit();
        }
        else{
            echo 'Error while deleting data from database';
            exit();
        }
        mysqli_close($conn);
    }
    else{
        header('Location: ../');
        exit();
    }


    header('Location: ../sections.php');
    exit();
}

else{
    header('Location: ../');
    exit();
}