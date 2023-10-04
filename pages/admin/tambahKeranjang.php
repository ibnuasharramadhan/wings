<?php
include_once("../../koneksi.php");
include_once("../../function/helper.php");
session_start();

$productCode = $_GET['product_code'];
$tambahCart = isset($_SESSION['cart']) ? $_SESSION['cart'] : false;

$query = mysqli_query($koneksi, "SELECT product_name, url, price FROM product WHERE product_code='$productCode'");
$row = mysqli_fetch_assoc($query);

$tambahCart[$productCode] = array(
    "product_name" => $row["product_name"],
    "url" => $row["url"],
    "price" => $row["price"],
    "quantity" => 1
);


$_SESSION["cart"] = $tambahCart;

header('location:' . BASE_URL);
