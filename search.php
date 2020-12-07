<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>
      <?php 

      if(isset($_GET['query'])){
        echo 'The HillsCandy: '.$_GET['query'] ;
      } 
      else if(isset($_GET['b'])){
        echo "More from ".$_GET['b'] ;
      }
    else{
      echo "Nothing found" ;
    }
    ?>
    </title>
    <link rel="stylesheet" href="css/searchNav.css" />
    <link rel="stylesheet" href="css/searchPage.css" />
    <link rel="stylesheet" href="css/footer.css" />
  </head>
<body>
    <?php
    include './admin/includes/connection.php';
// include('components/loader.html');
include 'components/searchNav.php';
?>

<div class="search_results">
  <?php
    include 'components/searchResults.php';
  ?>
</div>

<?php
include 'components/searchFooter.html';
?>
</body>
</html>