<?php

function decideAction($path){
    
    if($path == '/login'){
        $echo  "
      <div class=\"login__login-page\">
            ".include('./pages/login.php')."
        </div>";   
    }
    else if($path == '/register'){
        $echo "
      <div class=\"login__login-page\">
            ".include('./pages/register.php')."
        </div>";  
    }
    
}