<nav class="navbar">
  <div class="navbar__topRow">
    <a href="/" class="navbar__navbarBrand">The HillsCandy</a>
    <form method="GET" class="navbar__searchArea" action="./search.php">
    <select name="category" id="category" class="select-css">
        <option value="all">all</option>
        <?php 
        
        $sql = "SELECT * FROM category";
        $result = mysqli_query($conn,$sql);

        while($row = mysqli_fetch_assoc($result)){
          if(isset($_GET['category'])){
            $category = mysqli_real_escape_string($conn, $_GET['category']);
            if($category == $row['id']){
              echo '<option value="'.$row['id'].'" selected>'.$row['category'].'</option>';
            }
            else{
              echo '<option value="'.$row['id'].'">'.$row['category'].'</option>';
            }
          }
          else{
            echo '<option value="'.$row['id'].'">'.$row['category'].'</option>';
          }
        }
        
        ?>
    </select>
      <input
        type="text"
        name="query"
        id="searchItem"
        placeholder="Search items"
        <?php 
          $value = '';
          $value = isset($_GET['query']) ? $_GET['query'] : '';
          echo "value=$value";
        ?>
      />
      <button type="submit" name='search'></button>
    </form>
    <div class="navbar__rightArea">
      <a href="login" class="navbar__userLinks">Login</a>
      <a href="register" class="navbar__userLinks">Register</a>
      <img class="navbar__cartIcon" src="./images/shopping-cart-solid.svg" />
    </div>
  </div>
</nav>