<?php
include('./components/product.php');

function productRow($title,$products){

  echo "
  <div class=\"products\">
    <div class=\"products__topRow\">
      <div class=\"products__title\">$title</div>
      <a href=\"#\">View all</a>
    </div>
    <div class=\"products__bottomRow\">
      <svg
        class=\"MuiSvgIcon-root products__prevBtn jss79\"
        focusable=\"false\"
        viewBox=\"0 0 24 24\"
        aria-hidden=\"true\"
      >
        <path
          d=\"M9.31 6.71c-.39.39-.39 1.02 0 1.41L13.19 12l-3.88 3.88c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0l4.59-4.59c.39-.39.39-1.02 0-1.41L10.72 6.7c-.38-.38-1.02-.38-1.41.01z\"
        ></path>
      </svg>
      <div class=\"products__container\">
      ".product($products)."
      </div>
      <svg
        class=\"MuiSvgIcon-root products__nextBtn jss79\"
        focusable=\"false\"
        viewBox=\"0 0 24 24\"
        aria-hidden=\"true\"
      >
        <path
          d=\"M9.31 6.71c-.39.39-.39 1.02 0 1.41L13.19 12l-3.88 3.88c-.39.39-.39 1.02 0 1.41.39.39 1.02.39 1.41 0l4.59-4.59c.39-.39.39-1.02 0-1.41L10.72 6.7c-.38-.38-1.02-.38-1.41.01z\"
        ></path>
      </svg>
    </div>
  </div>
  ";
}

?>