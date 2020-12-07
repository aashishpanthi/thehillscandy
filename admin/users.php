<?php

session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../admin');
    exit();
}
include_once '../hidden/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel='stylesheet' href='./css/dashboard.css'>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
<div class="admin-panel clearfix">
    <?php include_once './comps/sidebar.html'; ?>
  <div class="main">
    <ul class="topbar">
      <li><a href="includes/logout.php">Logout</a></li>
      <input id='Filter' placeholder=' Filter' />
    </ul>
    <div class="mainContent container">
    <div class="table-responsive">
        <table class="table table-striped table-dark table-hover">
            <caption>List of users in database</caption>
            <thead>
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Email</th>
                <th scope="col">Regsitered Date</th>
                <th scope="col">Password</th>
                </tr>
            </thead>
            <tbody>

            <?php
            $sql = 'SELECT * FROM user';
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '
                    <tr class="searchable">
                        <th scope="row">'.$row['id'].'</th>
                        <td>'.$row['email'].'</td>
                        <td>'.$row['registered_date'].'</td>
                        <td>'.$row['password'].'</td>
                    </tr>';
            }
            } else {
            echo "0 results";
            }
            $conn->close();
            ?>
            </tbody>
        </table>
        </div>
     </div>
   </div>
</div>

<script>
$(document).ready(function () {
    $("#Filter").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".table .searchable").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
});
</script>
</body>
</html>
