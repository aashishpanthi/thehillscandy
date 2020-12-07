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
    <title>Add Product</title>
    <link rel='stylesheet' href='./css/dashboard.css'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="admin-panel clearfix">
    <?php include_once './comps/sidebar.html'; ?>
  <div class="main">
    <ul class="topbar">
      <li><a href="includes/logout.php">Logout</a></li>
      <input placeholder=' Search' />
    </ul>
    <div class="mainContent container">
        <h1>Send update to users</h1>
        <form class='mt-5' action='includes/sendemail.php' method='post'>
            <div class="form-group">
                <label for="emailSubject">Subject</label>
                <input type="text" class="form-control" name='subject' id="emailSubject" aria-describedby="subjectHelp" placeholder="Enter subject for email">
                <small id="subjectHelp" class="form-text text-muted">This is the text shown in the inbox (title).</small>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="categorySelect">Send to</label>
                    <select class="form-control" id="categorySelect" name='category'>
                        <option value='subscribed'>Subscribed</option>
                        <option value='all'>All</option>
                        <option value='allowed'>Allowed for notifications</option>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="specificPerson">OR send to one user</label>
                    <input type="email" name='oneUser' class="form-control" id="specificPerson" placeholder="Enter an email">
                </div>
            </div>
            <div class="form-group">
                <label for="productDescription">Email message</label>
                <textarea class="form-control" name='message' id="productDescription" aria-describedby="descHelp" rows="5"></textarea>
                <small id="descHelp" class="form-text text-muted">Tell the reason for the email.</small>
            </div>
            <button type="submit" name='send-email' class="btn btn-primary my-2 ml-auto d-block">Send Email</button>
        </form>
    </div>
   </div>
</div>
</body>
</html>
