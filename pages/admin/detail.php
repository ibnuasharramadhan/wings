<?php
session_start();
include '../../koneksi.php';

$trx = $_POST['trx'];
$query = mysqli_query($koneksi, "select td.*, p.product_name, p.dimension, p.url, p.discount  from trx_detail td 
left join product p 
on td.product_code  = p.product_code 
WHERE td.product_code='$trx'");
$row = mysqli_fetch_assoc($query);
echo json_encode($row);
