<?php
session_start();

if(isset($_POST["loginAdmin"])){
    include_once '../../hidden/connection.php';  
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $pass = mysqli_real_escape_string($conn,$_POST['pass']);

    if(empty($username) || empty($pass)){
        $_SESSION["adminLoginError"]= 'Empty field! All fields are required';
        header("Location: ../");
        exit();
    }

    else{
        $data_check_query = "SELECT password FROM admin";
        $result = mysqli_query($conn, $data_check_query);

        if (mysqli_num_rows($result) > 0){
            while ($data = mysqli_fetch_assoc($result)) {            
                $checkPass = password_verify($pass, $data['password']);
                if($checkPass){
                    $admin_update_query = "UPDATE admin SET last_logged_in=NOW()";
                    $result = mysqli_query($conn, $admin_update_query);
                    $_SESSION["username"]=$username;
                    $_SESSION["role"]='admin';
                    mysqli_close($conn);
                    header('Location: ../dashboard.php');
                    exit();
                }
                else if(!$checkPass){
                    $_SESSION["adminLoginError"]= 'Wrong password';
                    header("Location: ../");
                    exit();
                }
            }
        }
        else{
            $_SESSION["adminLoginError"]= "Username and password didn't matched";
            header("Location: ../");
            exit();
        }
    }
}

else{
    echo "You don't have any permission to access this page";
    header("Location: ../");
    exit();
}