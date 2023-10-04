<?php

session_start();

$cart = $_SESSION["cart"];
$product_code = $_POST["product_code"];
$value = $_POST["value"];

$cart[$product_code]["quantity"] = $value;

$_SESSION["cart"] = $cart;
