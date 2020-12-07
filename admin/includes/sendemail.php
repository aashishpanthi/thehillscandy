<?php

if(isset($_POST['send-email'])){
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $sendto = '';
    if($_POST['oneUser']){
        $sendto = $_POST['oneUser'];
    }
    // else{
    //     $sendto = $_POST['category'];
    // }
    
    $message = "<p>".$message."</p>";
    $header = "From:thehillscany@gmail.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";
    
    $retval = mail ($sendto,$subject,$message,$header);
    
    if( $retval == true ) {
       echo "Message sent successfully...";
    }else {
       echo "Message could not be sent...";
    }
}

else{
    header('Location: ../email.php');
    exit();
}