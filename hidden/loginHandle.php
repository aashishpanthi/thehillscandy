<?php

if(isset($_POST["loginSubmit"])){
    include 'connection.php';
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $pass = mysqli_real_escape_string($conn,$_POST['pass']);

    if(empty($email) || empty($pass)){
        echo 'Empty fields';
    }

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    }

    else{
        $user_check_query = "SELECT * FROM user WHERE email = ?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt,$user_check_query )){
            echo 'Checking user failed';
            exit();
        }
        mysqli_stmt_bind_param($stmt, 's', $email);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($user = mysqli_fetch_assoc($result)) {            
            $checkPass = password_verify($pass, $user['password']);
            if($checkPass){
                echo 'signed up successfully!';
            }
            else if(!$checkPass){
                echo 'wrong password!';
                exit();
            }
        }

        else{
            echo "user doesn't exits";
            exit();
        }
    }
}

else{
    echo "You don't have any permission to access this page";
}