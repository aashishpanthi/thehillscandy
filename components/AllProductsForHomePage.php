<?php
include('./components/products.php');
$age = array(array("title"=>"Goldstar Shoes", "company"=>"Goldstar", "price"=>"100"),array("title"=>"Nike Shoes", "company"=>"Nike", "price"=>"1000"),array("title"=>"Addidas Shoes", "company"=>"Addidas", "price"=>"1500"));
productRow('Big sales',$age);
$new = array(array("title"=>"Goldstar Shoes", "company"=>"Goldstar", "price"=>"100"),array("title"=>"Nike Shoes", "company"=>"Nike", "price"=>"1000"),array("title"=>"Addidas Shoes", "company"=>"Addidas", "price"=>"1500"));
productRow('New sales',$new);
?>