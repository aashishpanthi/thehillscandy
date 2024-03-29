<div class="slider">
  <svg
    class="MuiSvgIcon-root jss79 slider__prevBtn"
    focusable="false"
    viewBox="0 0 24 24"
    aria-hidden="true"
  >
    <path
      d="M9.31 6.71c-.39.39-.39 1.02 0 1.41L13.19 12l-3.88 3.88c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0l4.59-4.59c.39-.39.39-1.02 0-1.41L10.72 6.7c-.38-.38-1.02-.38-1.41.01z"
    ></path>
  </svg>



  <div class="slider__imgContainer">
  <?php 
  include_once './hidden/connection.php';
  
  $sql = "SELECT name FROM slider";
  $result = mysqli_query($conn, $sql);
  
  $id = 1;
  while($row = mysqli_fetch_assoc($result)) {
    $image = $row['name']; 
    echo "
        <img
        class=\"slider__slideImg\"
        id=\"slider__img$id\"
        src=\"images/slider/$image\"
        alt=\"$image\"
      />
    ";
    $id++;
  }
  mysqli_close($conn);

  ?>

    <!-- <img
      class="slider__slideImg"
      id="slider__img1"
      src="https://images-na.ssl-images-amazon.com/images/G/01/AmazonExports/Fuji/2020/May/Hero/Fuji_TallHero_Sports_en_US_1x._CB431860448_.jpg"
      alt="photo"
    />
    <img
      class="slider__slideImg"
      id="slider__img2"
      src="https://images-na.ssl-images-amazon.com/images/G/01/AmazonExports/Fuji/2020/October/Fuji_Tallhero_Dash_en_US_1x._CB418727898_.jpg"
      alt="photo"
    />
    <img
      class="slider__slideImg"
      id="slider__img3"
      src="https://images-na.ssl-images-amazon.com/images/G/01/AmazonExports/Events/2020/Holiday/GiftGuide/Fuji_TallHero_GG2_en_US_1x._CB418256337_.jpg"
      alt="photo"
    />
    <img
      class="slider__slideImg"
      id="slider__img4"
      src="https://images-na.ssl-images-amazon.com/images/G/01/AmazonExports/Events/2020/PrimeDay/Fuji_TallHero_NonPrime_v2_en_US_1x._CB403670067_.jpg"
      alt="photo"
    />
    <img
      class="slider__slideImg"
      id="slider__img5"
      src="https://images-na.ssl-images-amazon.com/images/G/01/AmazonExports/Fuji/2020/May/Hero/Fuji_TallHero_Computers_1x._CB432469755_.jpg"
      alt="photo"
    /> -->
  </div>

  <svg
    class="MuiSvgIcon-root slider__nextBtn jss79"
    focusable="false"
    viewBox="0 0 24 24"
    aria-hidden="true"
  >
    <path
      d="M9.31 6.71c-.39.39-.39 1.02 0 1.41L13.19 12l-3.88 3.88c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0l4.59-4.59c.39-.39.39-1.02 0-1.41L10.72 6.7c-.38-.38-1.02-.38-1.41.01z"
    ></path>
  </svg>
</div>
