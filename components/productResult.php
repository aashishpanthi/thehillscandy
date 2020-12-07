<?php 

if(isset($_GET['i'])){
    $id = mysqli_real_escape_string($conn, $_GET['i']);
    $newId = str_replace('c2i',' ',$id);
    $newId = str_replace('mnv',' ',$newId);
    $newId = str_replace('lsc',' ',$newId);
    $newId = str_replace('a11dp',' ',$newId);
    $pid = str_replace('pid',' ',$newId);
    if(!isset($_GET['name'])){
        echo 'Sorry product not found';
        exit();
    }
    
    $sql = "SELECT * FROM product WHERE pid= ?";
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt,$sql)){
        echo 'Failed to load try again later';
        exit();
    }
    mysqli_stmt_bind_param($stmt, 'i', $pid);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {   
        $category_fk = $row['category_fk'];
        $sql_for_category = "SELECT category FROM category WHERE id='$category_fk'";
        $result_for_category = $conn->query($sql_for_category);

        if ($result_for_category->num_rows > 0) {
            while($category = $result_for_category->fetch_assoc()) {
                $subcategory_fk = $row['subcategory_fk'];
                $sql_for_subcategory = "SELECT name FROM subcategory WHERE id='$subcategory_fk'";
                $result_for_subcategory = $conn->query($sql_for_subcategory);

                if ($result_for_subcategory->num_rows > 0) {
                    while($subcategory = $result_for_subcategory->fetch_assoc()) {
                        $brand_fk = $row['brand_fk'];
                        $sql_for_brand = "SELECT name FROM brand WHERE id='$brand_fk'";
                        $result_for_brand = $conn->query($sql_for_brand);

                        if ($result_for_brand->num_rows > 0) {
                            while($brand = $result_for_brand->fetch_assoc()) {
                                $random = array('pid','c2i','mnv','lsc','a11dp');
                                $randomDigit = rand(0,1);
                                $randomDigit1 = rand(1,2);
                                $randomDigit2 = rand(2,3);
                                $randomDigit3 = rand(3,4);

                                ?>
                            <div class="product__mainSection">
                                <div class="product_imageContainer">
                                    <div class="zoomImage">
                                        <img alt="<?php echo $row['name']; ?>" id="productImage" src="./images/products/<?php echo $row['image']; ?>">
                                    </div>
                                </div>
                                <div class="product_detailsSection">
                                    <div class="product__imageZoomShow" id="productImageShow"></div>
                                    <div class="product_productInfo">
                                        <div class="product__title">
                                            <?php echo $row['name']; ?>
                                        </div>
                                        <div class="product__productInfoMore">
                                           <span>
                                            <?php 
                                                    if($row['rating'] == 0){
                                                        echo 'No ratings yet';
                                                    }
                                                    else{
                                                        echo $row['rating']; 
                                                    }
                                                ?>
                                            </span>
                                            <span>
                                                <strong>Brand:</strong>
                                                <?php echo $brand['name'];?>

                                                <a href="search.php?b=<?php echo $brand['name']."&bid=".$random[$randomDigit].$random[$randomDigit1].$brand_fk.$random[$randomDigit2].$random[$randomDigit3]; ?>">
                                                    <strong>More From: </strong>
                                                    <?php echo $brand['name'];?>
                                                </a>
                                            </span>
                                        </div>
                                        <div class="product__productPrice">
                                            $ <?php echo $row['price']; ?>
                                        </div>
                                        <div class="product__productQuantity">
                                            Quantity: 
                                            <div class="plus"></div>
                                            <input type="number" name="quantity" min='1' max='5' value='1' id="quantity">
                                            <div class="minus"></div>
                                        </div>
                                        <div class="product__productActionButtons">
                                            <button class="product__cartBtn">Add to Cart</button>
                                            <button class="product__buyNowBtn">Buy Now</button>
                                        </div>
                                    </div>
                                    <div class="product_deliveryOptions">
                                        <div class="product__delivery-HeaderTitle">Delivery Options</div>
                                        <div class="product__delivery-location">
                                            <img src='./images/icons/placeholder.svg' alt='location icon' class="delivery__locationIcon" />
                                            <div class="delivery__locationAddress">
                                                United States, New York
                                            </div>
                                            <button class="delivery__locationChange" onclick='showFilter()'>
                                                Choose address
                                            </button>
                                            <div class="search__container">
                                                <div class="search__dir"></div>

                                                <input
                                                    type="text"
                                                    class="search__input"
                                                    onkeyup="filterOut(this)"
                                                    placeholder="Select your country"
                                                />
                                                <div class="search__options"></div>
                                            </div>
                                        </div>
                                        <div class="product__delivery-locationPrice">
                                            <div class="product__delivery-topRow">
                                                <img src='./images/icons/home-delivery.svg' alt='location icon' class="delivery__locationIcon" />
                                                <div class="product__delivery">
                                                    <span class="product__deliveryTitle">
                                                        Home Delivery
                                                    </span> 
                                                    <span class="product__deliveryDays">
                                                        3 - 4 days
                                                    </span> 
                                                </div>
                                                <div class="product__deliveryRate">$2.00</div>
                                            </div>
                                            <div class="delivery__locationAddress">
                                                Enjoy free shipping promotion with minimum spend of $ 500
                                            </div>
                                        </div>
                                        <div class="product__delivery-location">
                                            <img src='./images/icons/money.svg' alt='cash icon' class="delivery__locationIcon" />
                                            <div class="delivery__locationAddress">
                                                Cash on Delivery Available
                                            </div>
                                        </div>
                                        <div class="product__delivery-HeaderTitle">Return and Warranty</div>
                                        <div class="product__delivery-locationPrice none">
                                            <div class="product__delivery-topRow">
                                                <img src='./images/icons/return.svg' alt='location icon' class="delivery__locationIcon" />
                                                <div class="product__delivery">
                                                    <span class="product__deliveryTitle">
                                                        15 Days Returns
                                                    </span> 
                                                    <span class="product__deliveryDays">
                                                        Change of mind is not applicable
                                                    </span> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="product__delivery-location none">
                                            <img src='./images/icons/term.svg' alt='location icon' class="delivery__locationIcon" />
                                            <div class="delivery__locationAddress">
                                                1 year Warranty
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product__descriptionSection">
                                <div class="product__descriptionSectionTitle">
                                    Product details of <?php echo $row['name']; ?>
                                </div>
                                <div class="product__descriptionSectionDesc">
                                    <?php echo $row['description']; ?>
                                </div>
                            </div>

                            
                            <div class="product__alsoViewedSection">
                                <div class="product__alsoViewedSectionTitle">
                                    People Who Viewed This Item Also Viewed
                                </div>
                                <div class="product__alsoViewedSectionProducts">
                                    <?php
                                        $currentPid = $row['pid'];
                                        $sql_for_product = "SELECT pid as id,name as title, image, price FROM product WHERE brand_fk = $brand_fk AND pid<>$currentPid LIMIT 5";
                                        $result_of_product = mysqli_query($conn, $sql_for_product);
                                        if (mysqli_num_rows($result_of_product) > 0) {
                                            while($product = mysqli_fetch_assoc($result_of_product)) {
                                                $random = array('pid','c2i','mnv','lsc','a11dp');
                                                $randomDigit = rand(0,1);
                                                $randomDigit1 = rand(1,2);
                                                $randomDigit2 = rand(2,3);
                                                $randomDigit3 = rand(3,4);
                                                
                                                echo "
                                                    <a class=\"products__product\" href=\"product.php?i=".$random[$randomDigit].$random[$randomDigit1].$product['id'].$random[$randomDigit2].$random[$randomDigit3]."&name=".$product['title']."\">
                                                        <img
                                                        src=\"./images/products/".$product['image']."\"
                                                        alt=\"".$product['title']."\"
                                                        />
                                                        <div class=\"products__productTitle\">
                                                            ".$product['title']."
                                                        </div>
                                                        <div class=\"products__details\">
                                                            <strong>$".$product['price']."</strong>
                                                        </div>
                                                    </a>";
                                            }
                                        }
                                    ?>
                                </div>
                            </div>

                                <?php
                                }
                            }
                        }
                    }
                }
            }
        }
}
else {
    echo "0 results";
}
$conn->close();
    
?>
