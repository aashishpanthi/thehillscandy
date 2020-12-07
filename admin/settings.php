<?php

session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../admin');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings</title>
    <link rel='stylesheet' href='./css/dashboard.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="admin-panel">
    <?php include_once './comps/sidebar.html'; ?>
  <div class="main">
    <ul class="topbar">
      <li><a href="includes/logout.php">Logout</a></li>
      <input placeholder=' Search' />
    </ul>
    <div class="mainContent container">
        <h1>Settings</h1>
        <form class='mt-5' action='includes/admin.inc.php' method='post'>
            <div class="form-group">
                <label for="username">New username</label>
                <input type="text" class="form-control" name='username' aria-describedby="usernameHelp" id="username" placeholder="Username">
                <small id="usernameHelp" class="form-text text-muted">If you leave this empty then you username will not change.</small>
            </div>
            <div class="form-group">
                <label for="prevPass">Previous Password*</label>
                <input type="text" class="form-control" name='prevPassword' id="prevPass" aria-describedby="prevPassHelp" placeholder="Enter existing password" required>
                <small id="prevPassHelp" class="form-text text-muted">Fill the password with you have logged in last time.</small>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="newPass">New Password*</label>
                    <input type="text" class="form-control" name='password' id="newPass" aria-describedby="newPassHelp" placeholder="Enter new password" required>
                    <small id="newPassHelp" class="form-text text-muted">Enter the new password that you want to update.</small>
                </div>
                <div class="form-group col-md-6">
                    <label for="confirmPass">Confirm new pasword*</label>
                    <input type="text" class="form-control" name='confirmPassword' id="confirmPass" aria-describedby="confirmPassHelp" placeholder="Comfirm new password" required>
                    <small id="confirmPassHelp" class="form-text text-muted">Fill the password that you have entered in new password field.</small>
                </div>
            </div>
            <button type="submit" name='updateInfo' class="btn btn-primary my-2 ml-auto d-block">Update Info</button>
        </form>
    </div>
   </div>
</div>
</body>
</html>
