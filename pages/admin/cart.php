<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wings Group</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../../assets/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <?php
    include_once("../../koneksi.php");
    include_once("../../function/helper.php");
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location:../../index.php?pesan=belum_login");
    }
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $totalBarang = count($cart);

    ?>
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="../../dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
        </div>

        <nav class="main-header navbar navbar-expand navbar-dark">

            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>

            <ul class="navbar-nav ml-auto">
            </ul>
        </nav>


        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <a href="index3.html" class="brand-link">
                <img src="../../assets/img/Wings_(Indonesian_company)_logo.svg" alt="wings logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Wings Group</span>
            </a>

            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="index.php" class="nav-link">
                                <i class="nav-icon fas fa-box"></i>
                                <p>
                                    Products
                                </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="cart.php" class="nav-link">
                                <i class="nav-icon fas fa-shopping-cart"></i>
                                <p>
                                    Cart
                                </p>
                                <?php

                                if ($totalBarang != 0) {
                                    echo "<span class='total-barang'>$totalBarang</span>";
                                }
                                ?>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="reportPenjualan.php" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                <p>
                                    Report Penjualan
                                </p>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="logout.php" class="nav-link">
                                <i class="nav-icon fas fa-sign-out-alt"></i>
                                <p>
                                    Logout
                                </p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>

        </aside>

        <div class="content-wrapper">

            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Cart</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <section class="content">
                <div class="container-fluid">
                    <?php
                    if ($totalBarang == 0) {
                        echo "<h3>Saat ini belum ada data di dalam keranjang belanja anda</h3>";
                    } else {

                        $no = 1;

                        echo "<table class='table-list'>
				<tr class='baris-title'>
					<th class='tengah'>No</th>
					<th class='kiri'>Image</th>
					<th class='kiri'>Nama Barang</th>
					<th class='tengah'>Qty</th>
					<th class='kanan'>Harga Satuan</th>
					<th class='kanan'>Total</th>
				</tr>";

                        $subtotal = 0;
                        foreach ($cart as $key => $value) {
                            $product_code = $key;

                            $product_name = $value["product_name"];
                            $quantity = $value["quantity"];
                            $url = $value["url"];
                            $price = $value["price"];

                            $total = $quantity * $price;
                            $subtotal = $subtotal + $total;

                            echo "<tr>
					<td class='tengah'>$no</td>
					<td class='kiri'><img src='" . $url . "' height='100px' /></td>
					<td class='kiri'>$product_name</td>
					<td class='tengah'><input required type='number' name='$product_code' value='$quantity' class='update-quantity' /></td>
					<td class='kanan'>" . rupiah($price) . "</td>
					<td class='kanan hapus_item'>" . rupiah($total) . " <a href='" . BASE_URL . "hapusItem.php?product_code=$product_code'>X</a></td>
				</tr>";

                            $no++;
                        }

                        echo "<tr>
				<td colspan='5' class='kanan'><b>Sub Total</b></td>
				<td class='kanan'><b>" . rupiah($subtotal) . "</b></td>
			  </tr>";

                        echo "</table>";

                        echo "<div id='frame-button-keranjang'>
				<a class='btn btn-primary'  href='" . BASE_URL . "index.php?page=data_pemesan'>Checkout</a>
			  </div>";
                    }

                    ?>
                </div>
            </section>

        </div>


        <aside class="control-sidebar control-sidebar-dark">

        </aside>


        <footer class="main-footer">
            <strong>Copyright &copy; 2022-2023 <a href="#">Ibnu Ashar Ramadhan</a>.</strong>
            All rights reserved.
            <div class="float-right d-none d-sm-inline-block">
                <b>Version</b> 3.2.0
            </div>
        </footer>
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Product Detail</h4>
                </div>
                <div class="modal-body">
                    <div class="card" style="max-width: 400px;">
                        <div class="row no-gutters">
                            <div class="col-md-4">
                                <img id="myImg" src="" class="img-fluid" alt="...">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <h5 id="title" class="card-title"></h5>
                                    <p id="hrgDiskon" class="card-text"><del>Rp.15.000</del></p>
                                    <p id="hrgAsli" class="card-text"></p>
                                    <p id="dimensi" class="card-text"></p>
                                    <p id="price" class="card-text"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Buy</button>
                </div>
            </div>
        </div>
    </div>



    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="../../dist/js/adminlte.js?v=3.2.0"></script>
    <script src="../../assets/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="../../assets/plugins/raphael/raphael.min.js"></script>
    <script src="../../assets/plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="../../assets/plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <script src="../../assets/plugins/chart.js/Chart.min.js"></script>
    <script src="../../dist/js/demo.js"></script>
    <script src="../../dist/js/pages/dashboard2.js"></script>
    <script src="../../assets/plugins/toastr/toastr.min.js"></script>

    <script>
        $(".update-quantity").on("input", function(e) {
            var product_code = $(this).attr("name");
            var value = $(this).val();
            if (value === '') {
                $(document).ready(function() {
                    toastr.warning('Quantity tidak boleh kosong !!');
                });
            } else {
                $.ajax({
                        method: "POST",
                        url: "updateCart.php",
                        data: "product_code=" + product_code + "&value=" + value
                    })
                    .done(function(data) {
                        location.reload();
                    });
            }
        });
    </script>
</body>



</html>