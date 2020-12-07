<?php
include_once './components/products.php';
include_once './admin/includes/connection.php';

//<firstSection>
$sql = "SELECT name,id FROM sections";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    while($section = mysqli_fetch_assoc($result)) {
        $sectionName = $section['name'];
        $sql_for_product = "SELECT product.pid as id,product.name as title,product.image as image, brand.name as company, product.price as price FROM $sectionName,product,brand WHERE $sectionName.product_id = product.pid AND product.brand_fk = brand.id";
        $result_of_product = mysqli_query($conn, $sql_for_product);
        if (mysqli_num_rows($result_of_product) > 0) {
            $productsArray = array();
            while($row = mysqli_fetch_assoc($result_of_product)) {
                array_push($productsArray, $row);
            }
            productRow($sectionName,$section['id'],$productsArray);
        }
    }
}

else{
    echo 'The website is under construction :) ';
}

mysqli_close($conn);