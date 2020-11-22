<?php

function product($products){
    $pdt = '';
    foreach($products as $index => $product) {
        $pdt .= "
        <a class=\"products__product\" href=\"#\">
          <div class=\"products__imageContainer\">
            <img
              src=\"https://reddoko.com/uploads/45581/300x3001584687085.Peak031.jpg\"
              alt=\"".$product['title']."\"
            />
          </div>
          <div class=\"products__productTitle\">
          ".$product['title']."
            Goldstae Grey Sports Shoes For Men - Made in Nepal
          </div>
          <div class=\"products__details\">
            <span>By - ".$product['company']."</span>
            <strong>$".$product['price']."</strong>
          </div>
        </a>";
}

return $pdt;

}

?>