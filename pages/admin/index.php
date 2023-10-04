<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Wings Group</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="../../assets/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="../../dist/css/adminlte.min.css?v=3.2.0">
</head>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <?php
    session_start();
    if ($_SESSION['status'] != "login") {
        header("location:../../index.php?pesan=belum_login");
    }
    $cart = isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
    $totalBarang = count($cart);
    ?>
    <div class="wrapper">

        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__wobble" src="../../assets/img/Wings_(Indonesian_company)_logo.svg" alt="AdminLTELogo" height="60" width="60">
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
                            <h1 class="m-0">Products</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Products</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>


            <?php

            include '../../koneksi.php';
            $datas = mysqli_query($koneksi, "select * from product");
            ?>
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <?php
                        $no = 1;
                        while ($data = mysqli_fetch_assoc($datas)) {
                        ?>
                            <div class="col-md-4">
                                <div class="card" style="max-width: 400px;">
                                    <div class="row no-gutters">
                                        <div class="col-md-4">
                                            <a href="javascript:void(0)" onclick="detailProd('<?= $data['product_code'] ?>')">
                                                <img src="<?= $data['url'] ?>" class="img-fluid" alt="...">
                                            </a>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body">
                                                <h5 class="card-title"><a href="javascript:void(0)" onclick="detailProd('<?= $data['product_code'] ?>')"><?= $data['product_name'] ?></a></h5>
                                                <p class=" card-text"><?= $data['price'] ?></p>
                                                <a href="./tambahKeranjang.php?product_code=<?= $data['product_code']; ?>" class="btn btn-primary">Buy</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php $no++;
                        } ?>
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
                                    <p class="card-text"><del id="hrgDiskon"></del></p>
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
                    <button type="button" class="btn btn-primary" data-dismiss="modal">buy</button>
                </div>
            </div>
        </div>
    </div>



    <script src=" ../../assets/plugins/jquery/jquery.min.js"></script>
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

    <script>
        function detailProd(id) {
            $('#modal-default').modal('show')
            $.ajax({
                type: "POST",
                url: 'detail.php',
                data: {
                    trx: id
                },
                dataType: "json",
                success: function(data) {
                    let beforeDiskon = data.discount / 100
                    let perhitunganDiskon = beforeDiskon * data.price
                    let afterDiskon = data.price - perhitunganDiskon
                    $('#title').text(data.product_name)
                    $('#myImg').attr('src', data.url)
                    if (data.discount == 0) {
                        $('#hrgDiskon').text(`Rp. ${data.discount}`)
                        $('#hrgAsli').text(`Rp. ${afterDiskon}`)
                    } else {
                        $('#hrgDiskon').text(`Rp. ${data.price}`)
                        $('#hrgAsli').text(`Rp. ${afterDiskon}`)
                    }
                    $('#dimensi').text(`Dimension : ${data.dimension}`)
                    $('#price').text(`Price Unit : ${data.unit}`)
                },
                error: function(err) {
                    console.error(err);
                }
            });
        }
    </script>
</body>



</html>