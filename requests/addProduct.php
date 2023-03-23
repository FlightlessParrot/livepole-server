<?php
require_once('../product.php');
require_once('../user.php');

$user= new User();
$user->authenticate();
$product=new Product();
$product->addProduct();




?>