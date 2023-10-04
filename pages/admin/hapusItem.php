<?php

include_once("../../function/helper.php");

session_start();

$productCode = $_GET['product_code'];
$keranjang = $_SESSION['cart'];

unset($keranjang[$productCode]);

$_SESSION["cart"] = $keranjang;

header("location:" . BASE_URL . "cart.php");
