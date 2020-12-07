<?php 

if(isset($_GET['name'])){
    $name = mysqli_real_escape_string($conn, $_GET['name']);
    if(!isset($_GET['sid'])){
        echo '404 page not found';
        exit();
    }
    $id = mysqli_real_escape_string($conn, $_GET['sid']);
    $newId = str_replace('c2i',' ',$id);
    $newId = str_replace('mnv',' ',$newId);
    $newId = str_replace('lsc',' ',$newId);
    
    $sql = "SELECT id,name FROM sections WHERE name = ? AND id= ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo 'Failed to load try again later';
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'si', $name, $newId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($section = mysqli_fetch_assoc($result)) {            
        $sectionName = $section['name'];
        $sql_for_product = "SELECT product.pid as id,product.name as name,product.image as image,product.rating as rating, brand.name as company, product.price as price FROM $sectionName,product,brand WHERE $sectionName.product_id = product.pid AND product.brand_fk = brand.id";
        $result_of_product = mysqli_query($conn, $sql_for_product);
        if (mysqli_num_rows($result_of_product) > 0) {
            $sectionName = str_replace('_', ' ', $sectionName);
            echo '<h1 class="section__tilte">'.$sectionName.'</h1>';
            while($product = mysqli_fetch_assoc($result_of_product)) {
                $random = array('pid','c2i','mnv','lsc','a11dp');
                $randomDigit = rand(0,1);
                $randomDigit1 = rand(1,2);
                $randomDigit2 = rand(2,3);
                $randomDigit3 = rand(3,4);
                ?>
                    <div class="search__product">
                        <a href="product.php?i=<?php echo $random[$randomDigit].$random[$randomDigit1].$product['id'].$random[$randomDigit2].$random[$randomDigit3]."&name=".$product['name']; ?>" class="search__productImage">
                            <img src="./images/products/<?php echo $product['image']; ?>" alt="<?php echo $product['name']; ?>">
                        </a>
                        <div class="search__productDetails">
                            <a href="product.php?i=<?php echo $random[$randomDigit].$random[$randomDigit1].$product['id'].$random[$randomDigit2].$random[$randomDigit3]."&name=".$product['name']; ?>" class="search__productTitle">
                                <?php echo $product['name']; ?>
                            </a>
                            <div class="search__productRating">
                                <?php 
                                    if($product['rating'] == 0){
                                        echo 'No ratings yet';
                                    }
                                    else{
                                        echo $product['rating']; 
                                    }
                                ?>
                            </div>
                            <div class="search__productSubcategory">
                                By - <?php echo $product['company']; ?>
                            </div>
                            <div class="search__productPrice">
                                <strong>
                                    <small>$</small>
                                    <?php echo $product['price']; ?>
                                </strong>
                            </div>
                        </div>
                    </div>

                    <?php
            }
        }
    }

    else{
        echo "No result found uphere.";
        exit();
    }

}

else{
    echo 'This page is not available right now.';
}


?>