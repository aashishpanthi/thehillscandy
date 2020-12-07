<?php 

if(isset($_GET['query'])){
    $query = mysqli_real_escape_string($conn, $_GET['query']);
    
    $sql = "SELECT pid as id,name,image,rating,subcategory_fk,category_fk,price FROM product WHERE name LIKE '%$query%' OR description LIKE '%$query%'";
    
    $result = mysqli_query($conn, $sql);
    while($product = mysqli_fetch_assoc($result)){
        $random = array('pid','c2i','mnv','lsc','a11dp');
        $randomDigit = rand(0,1);
        $randomDigit1 = rand(1,2);
        $randomDigit2 = rand(2,3);
        $randomDigit3 = rand(3,4);
        if(isset($_GET['category'])){
            $category = mysqli_real_escape_string($conn, $_GET['category']);
            if($category != 'all'){
                if($product['category_fk'] == $category){
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
                                <?php 
                                    $subcategory_id = $product['subcategory_fk'];
                                    $sql_for_subcategory = "SELECT name FROM subcategory WHERE id = '$subcategory_id'";

                                    $result_for_subcategory = mysqli_query($conn, $sql_for_subcategory);
                                    while($sc = mysqli_fetch_assoc($result_for_subcategory)){
                                        echo $sc['name'];
                                    }
                                ?>
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
            else if($category == 'all'){
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
                            <?php 
                                $subcategory_id = $product['subcategory_fk'];
                                $sql_for_subcategory = "SELECT name FROM subcategory WHERE id = '$subcategory_id'";

                                $result_for_subcategory = mysqli_query($conn, $sql_for_subcategory);
                                while($sc = mysqli_fetch_assoc($result_for_subcategory)){
                                    echo $sc['name'];
                                }
                            ?>
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
        else{
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
                    <?php 
                        $subcategory_id = $product['subcategory_fk'];
                        $sql_for_subcategory = "SELECT name FROM subcategory WHERE id = '$subcategory_id'";

                        $result_for_subcategory = mysqli_query($conn, $sql_for_subcategory);
                        while($sc = mysqli_fetch_assoc($result_for_subcategory)){
                            echo $sc['name'];
                        }
                    ?>
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

else if(isset($_GET['b'])){
    if(!isset($_GET['bid'])){
      echo 'Something went wrong';
      exit();  
    }
    $id = mysqli_real_escape_string($conn, $_GET['bid']);

    $newId = str_replace('c2i',' ',$id);
    $newId = str_replace('mnv',' ',$newId);
    $newId = str_replace('lsc',' ',$newId);
    $newId = str_replace('a11dp',' ',$newId);
    $bid = str_replace('pid',' ',$newId);
    
    $sql = "SELECT pid as id,name,image,rating,subcategory_fk,category_fk,price FROM product WHERE brand_fk = ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql )){
        echo 'Try again next time';
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'i', $bid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if(mysqli_num_rows($result) > 0){
        while($product = mysqli_fetch_assoc($result)){
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
                        <?php 
                            $subcategory_id = $product['subcategory_fk'];
                            $sql_for_subcategory = "SELECT name FROM subcategory WHERE id = '$subcategory_id'";

                            $result_for_subcategory = mysqli_query($conn, $sql_for_subcategory);
                            while($sc = mysqli_fetch_assoc($result_for_subcategory)){
                                echo $sc['name'];
                            }
                        ?>
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
    else{
        echo 'Sorry, nothing found';
    }
}

else{
    echo 'Nothing to search';
}


?>