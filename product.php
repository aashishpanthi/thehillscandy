<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php echo isset($_GET['name']) ? str_replace('_', ' ', $_GET['name']): 'Nothing found';?></title>
    <link rel="stylesheet" href="css/nav.css" />
    <link rel="stylesheet" href="css/footer.css" />
    <link rel="stylesheet" href="css/productPage.css" />
  </head>
<body>
    <?php
    include './admin/includes/connection.php';
    include('components/loader.html');
    include('components/nav.php');
    ?>

    <div class="product_results">
    <?php
        include 'components/productResult.php';
        include 'components/productAlsoViewed.php';
    ?>
    </div>

    <?php
    include 'components/searchFooter.html';
    ?>
    <script src="./js/nav.js"></script>
    <script src="./js/main.js"></script>
    <script src="./js/productPage.js"></script>
    <script src="./js/places.js"></script>
</body>
</html>