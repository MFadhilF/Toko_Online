<?php 
require "koneksi.php";
require "./proses/add.php";

$queryKategori = mysqli_query($con,"SELECT * From kategori");

// get produk by nama / produk
if (isset($_GET['keyword'])) {
    $queryProduk = mysqli_query($con, "SELECT * from produk where nama like '%$_GET[keyword]%'");
}
// get produk by kategori
else if (isset($_GET['kategori'])){
    $queryGetKategoriId = mysqli_query($con, "SELECT id from kategori where nama='$_GET[kategori]'");
    $kategoriId = mysqli_fetch_array ($queryGetKategoriId);

    $queryProduk = mysqli_query($con, "SELECT * FROM produk where kategori_id='$kategoriId[id]' ");
}
// get produk default
else {
    $queryProduk = mysqli_query($con, "SELECT * from produk");
    
}

$countData = mysqli_num_rows($queryProduk);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Produk</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/Style.css">
</head>

<body>

    <?php require "navbar.php"; ?>

    <!-- banner -->
    <div class="container-fluid banner-produk d-flex align-items-center">
        <div class="container">
            <h1 class="text-white text-center"> Produk</h1>
        </div>
    </div>

    <!-- body  -->
    <div class="container py-5">
        <div class="row">
            <!-- kategori -->
            <div class="col-lg-3 col-md-4 mb-5">
                <h3>Kategori</h3>
                <ul class="list-group">
                    <?php while($kategori = mysqli_fetch_array($queryKategori)){ ?>
                        <a class="no-deco-text" href="produk.php?kategori=<?php echo $kategori ['nama'];?>">
                    <li class="list-group-item"><?php echo $kategori['nama'] ?></li>
                    </a>
        <?php } ?>        
                </ul>
            </div>
            <!-- Produk -->
            <div class="col-lg-9 col-md-4">
                    <h3 class="text-center mb-3">Produk</h3>
                    <div class="row mt-5">
                        <!-- looping untuk mengambil data dari database -->
                        <?php if ($countData<1) {
                            ?>
                            <h4 class="text-center my-5"> Produk Tidak Tersedia</h4>
                            <?php 
                        } 
                        ?>

                        <?php while ($produk =  mysqli_fetch_array($queryProduk)) { 
                            ?>
                        <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow bg-white rounded">
                                <img class="card-img-top" src="image/<?php echo $produk['foto'];  ?>" alt="Card image cap">
                            <div class="card-body">
                                <h4 class="card-title"><?php echo $produk['nama'];  ?></h4>
                                <p class="card-text text-truncate"><?php echo $produk['detail'];  ?></p>
                                <p class="card-text text-harga">Rp <?php echo $produk['harga'];  ?></p>
                                <a href="produk-detail.php?nama=<?php echo $produk['nama'];  ?>" class="btn warna2 text-white mb-3"> Lihat Detail</a>
                                <a href="keranjang.php?id=<?php echo $produk['id'];?>" class="btn warna2 text-white"> Tambahkan Barang</a>
                            </div>
                        </div>
                        </div>
                        <?php } ?>
                    </div>
            </div>
        </div>
    </div>

    <!-- footer -->
    <?php require "footer.php"; ?>

    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>