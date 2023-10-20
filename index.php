<?php
require "koneksi.php";
require "./proses/add.php";

$queryProduk = mysqli_query($con, "SELECT id,nama,harga,foto,detail From produk Limit 6");



 


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Home</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/Style.css">
</head>

<body>
    <?php require "navbar.php"; ?>
    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>E-Fashion </h1>
            <h6>(Everything You Need Is Here)</h6>
            <h3> Mau Cari Apa?</h3>
            <div class="col-md-8 offset-md-2">
                <form method="get" action="produk.php">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn warna2 text-white">Telusuri </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php 
    $ip = getIPAddress();
    $ip = 'User Real IP Address - '.$ip;
    ?>

    <!-- highlighted kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Kategori Terlaris</h3>
            <div class="row mt-5 mb-4  ">
                <div class="col-md-4 mb-3 shadow p-3 mb-5 bg-white rounded">
                    <div class="highlighted-kategori kategori-Kemeja d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a href="produk.php?kategori=Baju Kemeja" class="no-deco-text ">Baju Kemeja</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3 shadow p-3 mb-5  bg-white rounded">
                    <div class="highlighted-kategori kategori-jaket d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a href="produk.php?kategori=Jaket" class="no-deco-text">Jaket</a></h4>
                    </div>
                </div>
                <div class="col-md-4 mb-3 shadow p-3 mb-5  bg-white rounded">
                    <div class="highlighted-kategori kategori-sepatu d-flex justify-content-center align-items-center">
                        <h4 class="text-white"><a href="produk.php?kategori=Sepatu" class="no-deco-text">Sepatu</a></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- tentang kami -->
    <div class="container-fluid warna1 py-5">
        <div class="container text-center text-white">
            <h3>Tentang kami</h3>
            <p class="fs-10 mt-3 text-white"> Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis repellat quaerat in maiores dolore eveniet, laboriosam hic dignissimos facere maxime deleniti corporis earum porro. Laborum aliquam magnam dignissimos enim ab tempora dolore, excepturi quis ipsa ipsam magni facere, explicabo eveniet accusantium, architecto distinctio! Necessitatibus eligendi illum, soluta totam eaque dolores. Temporibus, eaque omnis rerum odit iusto cupiditate quo nostrum soluta, perspiciatis inventore vero rem, nobis deleniti eligendi recusandae! Exercitationem animi itaque ab nam,
                natus officiis vitae amet adipisci eum! Optio!</p>
        </div>
    </div>

    <!-- produk -->

    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>
            <!-- card produk-->
            <div class="row mt-5">
                <?php
                while ($data = mysqli_fetch_array($queryProduk)) {
                ?>
                    <div class="col-sm-6 col-md-4 mb-3">
                        <div class="card h-100 image-box shadow bg-white rounded">
                                <img class="card-img-top" src="image/<?php echo $data['foto'] ?>" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $data['nama'] ?></h4>
                                <p class="card-text text-truncate"><?php echo $data['detail'] ?>.</p>
                                <p class="card-text text-harga">Rp.<?php echo $data['harga'] ?></p>
                                <a href="produk-detail.php?nama=<?php echo $data['nama'] ?>" class="btn warna2 text-white"> Lihat Detail</a>
                                <a href="beli.php?id=<?php $produk['id'];?>" class="btn warna2 text-white"> Tambahkan Barang</a>
                                
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <a class="btn btn-outline-success mt-3" href="produk.php">See More</a>
        </div>
    </div>
    <!-- footer -->
    <?php require "footer.php"; ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>