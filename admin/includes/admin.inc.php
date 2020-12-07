<?php

session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../');
    exit();
}

if(isset($_POST["updateInfo"])){
    include_once '../../hidden/connection.php';  
    $username = mysqli_real_escape_string($conn,$_POST['username']);
    $prevPass = mysqli_real_escape_string($conn,$_POST['prevPassword']);
    $pass = mysqli_real_escape_string($conn,$_POST['password']);
    $confirmPass = mysqli_real_escape_string($conn,$_POST['confirmPassword']);

    if(empty($prevPass) || empty($pass) || empty($confirmPass)){
        echo 'Please fill up all password fields';
    }

    else if ($pass !== $confirmPass) {
        echo "Password din't matched";
    }

    else{
        $data_check_query = "SELECT password FROM admin";
        $result = mysqli_query($conn, $data_check_query);

        if (mysqli_num_rows($result) > 0){
            while ($data = mysqli_fetch_assoc($result)) {            
                $checkPass = password_verify($prevPass, $data['password']);
                if($checkPass){
                    $password = password_hash($pass, PASSWORD_DEFAULT);
                    
                    if(empty($username)){
                        $admin_update_query = "UPDATE admin SET password=?";
                        $stmt_PushData = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt_PushData,$admin_update_query )){
                            echo 'Updating admin failed';
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt_PushData, 's', $password);
                    }

                    else{
                        $admin_update_query = "UPDATE admin SET username=? , password=?";
                        $stmt_PushData = mysqli_stmt_init($conn);
                        if(!mysqli_stmt_prepare($stmt_PushData,$admin_update_query )){
                            echo 'Updating admin failed';
                            exit();
                        }
                        mysqli_stmt_bind_param($stmt_PushData, 'ss', $username, $password);
                    }

                    mysqli_stmt_execute($stmt_PushData);
                    mysqli_stmt_close($stmt_PushData);
                    echo 'successfully updated';
                    header('Location: ../settings.php');
                    exit();
                }
                else if(!$checkPass){
                    echo 'Enter your previous password right!';
                    exit();
                }
            }
        }
        else{
            echo "Admin doesn't exits";
            exit();
        }
    }
}

else{
    echo "You don't have any permission to access this page";
}