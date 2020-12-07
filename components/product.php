<?php

function product($products){
  $pdt = "";
  foreach($products as $product){
    $random = array('pid','c2i','mnv','lsc','a11dp');
    $randomDigit = rand(0,1);
    $randomDigit1 = rand(1,2);
    $randomDigit2 = rand(2,3);
    $randomDigit3 = rand(3,4);
    $pdt .= "
    <a class=\"products__product\" href=\"product.php?i=".$random[$randomDigit].$random[$randomDigit1].$product['id'].$random[$randomDigit2].$random[$randomDigit3]."&name=".$product['title']."\">
      <div class=\"products__imageContainer\">
        <img
          src=\"./images/products/".$product['image']."\"
          alt=\"".$product['title']."\"
        />
      </div>
      <div class=\"products__productTitle\">
      ".$product['title']."
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