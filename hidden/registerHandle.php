<?php

if(isset($_GET["registerSubmit"])){
    include 'connection.php';    
    $email = mysqli_real_escape_string($conn,$_GET['email']);
    $pass = mysqli_real_escape_string($conn,$_GET['pass']);
    $confirmPass = mysqli_real_escape_string($conn,$_GET['confirmPass']);

    if(empty($email) || empty($pass) || empty($confirmPass)){
        echo 'Empty fields';
    }

    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format";
    }

    else if ($pass !== $confirmPass) {
        echo "Password din't matched";
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

        if (mysqli_fetch_assoc($result)) {
            echo 'User already exists';
        }
        else{
            $password = password_hash($pass, PASSWORD_DEFAULT);

            $user_insert_query = "INSERT INTO user (email , password) VALUES  (?,?)";
            $stmt_PushData = mysqli_stmt_init($conn);
            if(!mysqli_stmt_prepare($stmt_PushData,$user_insert_query )){
                echo 'Creating user failed';
                exit();
            }
            mysqli_stmt_bind_param($stmt_PushData, 'ss', $email, $password);
            mysqli_stmt_execute($stmt_PushData);
            mysqli_stmt_close($stmt_PushData);
            echo 'signup success';
        }
        mysqli_stmt_close($stmt);
    }
}

else{
    echo "You don't have any permission to access this page";
}