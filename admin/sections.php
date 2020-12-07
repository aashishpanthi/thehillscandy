<?php

session_start();
if(!$_SESSION["role"] == 'admin'){
    header('Location: ../admin');
    exit();
}
include_once 'includes/connection.php';
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sections</title>
    <link rel='stylesheet' href='./css/dashboard.css'>
    <link rel='stylesheet' href='./css/sections.css'>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </head>
<body>
<div class="admin-panel">
    <?php include_once './comps/sidebar.html'; ?>
  <div class="main">
    <ul class="topbar">
      <li><a href="includes/logout.php">Logout</a></li>
      <input id='sectionFilter' placeholder=' Search' />
    </ul>
    <div class="mainContent container">
      <h1>Sections</h1>
      <div class="sections__table">
          <div class="sections__tableHeader">
            <div class="sections__tableCell">Id</div>
            <div class="sections__tableCell">Name</div>
            <div class="sections__tableCell">No. of items</div>
            <div class="sections__tableCell">Edit</div>
          </div>
          <?php
          $sql = "SELECT * FROM sections";
          $result = mysqli_query($conn,$sql);

          if ($result->num_rows > 0) {
              while($row = $result->fetch_assoc()) {
                $tableName = $row['name'];
                $rowName = str_replace('_', ' ', $tableName);
                $sql_for_rows = "SELECT COUNT(*) FROM $tableName";
                $result_for_rows = mysqli_query($conn,$sql_for_rows);

                if ($result_for_rows->num_rows > 0) {
                    while($data = $result_for_rows->fetch_assoc()) {
                      echo '
                        <div class="sections__tableRow draggable section">
                            <div class="sections__tableCell"><span class="dragHere" draggable="true"></span>'.$row['id'].'</div>
                              <div class="sections__tableCell">'.$rowName.'</div>
                              <div class="sections__tableCell">'.$data['COUNT(*)'].'</div>
                              <div class="sections__tableCell">
                                <button data-id='.$row['id'].' class="btn btn-info btn-sm d-flex align-center mt-2 edit-btn" data-toggle="tooltip" data-placement="right" title="Edit">
                                  <span class="material-icons">edit</span>
                                </button>
                              </div>
                        </div>';
                    }  
                  }
              }
          }
          ?>
        </div>
        <div class="d-flex">
          <button class="btn btn-danger d-flex align-center delete-all" data-toggle="tooltip" data-placement="right" title="Delete all">
            <span class="material-icons">delete</span>
            Delete all sections
          </button>
          <a href="./comps/addSection.php" class="btn btn-primary ml-auto d-flex align-center" data-toggle="tooltip" data-placement="right" title="New section">
            <span class="material-icons">add</span>
            Add Section
          </a>
        </div>
    </div>
   </div>
</div>

<script src="./js/sectionDragAndDrop.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
  $(document).ready(function () {
    $("#sectionFilter").on("keyup", function () {
        var value = $(this).val().toLowerCase();
        $(".section").filter(function () {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });

    $(".edit-btn").click(function () {
        console.log(this.dataset.id);
        window.location = `./comps/editSection.php?section=${this.dataset.id}`;
    })

    $(".delete-all").on("click", function () { 
        swal({
            title: "Are you sure?",
            text: "All sections will be deleted permanently",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                swal("All sections have been deleted!", {
                icon: "success",
                });
                window.location = `./includes/emptySections.php?coajsdhkajsnfirmed=1yepp1`
            } else {
                swal("All sections are safe");
            }
            });
        })

    $(function () {
    $('[data-toggle="tooltip"]').tooltip()
    })
  });
</script>
</body>
</html>
