<nav class="navbar">
  <div class="navbar__topRow">
    <div class="navbar__toggleBtn">
      <span></span>
      <span></span>
      <span></span>
    </div>
    <a href="/" class="navbar__navbarBrand">The HillsCandy</a>
    <form method="GET" class="navbar__searchArea" action="./search.php">
      <input
        type="text"
        name="query"
        id="searchItem"
        placeholder="Search items"
      />
      <button type="submit" name='search'></button>
    </form>
    <div class="navbar__rightArea">
      <a href="./pages/login.php" class="navbar__userLinks">Login</a>
      <a href="./pages/register.php" class="navbar__userLinks">Register</a>
      <img class="navbar__cartIcon" src="./images/shopping-cart-solid.svg" />
    </div>
  </div>

  <div class="navbar__bottomRow">
    <a href="/">Home</a>
    <a href="#">Products</a>
    <a href="#">Shop</a>
    <a href="#">Everyday</a>
    <a href="#">Help</a>
  </div>
</nav>
