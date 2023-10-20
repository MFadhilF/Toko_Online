<?php 
session_start();
require "koneksi.php";

?>

<nav class="navbar navbar-expand-lg navbar-dark warna1 ">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav container">
                <li class="nav-item active ">
                    <a class="nav-link me-4 " href="index.php">Home </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link me-4"" href=" produk.php">Produk</a>
                </li>
                <?php
                if (!isset($_SESSION['user'])) {
                ?>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="user_login.php">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="register.php">Register</a>
                    </li>
                <?php
                } else {
                ?>
                    <li class="nav-item">
                        <a class="nav-link me-4" href="proses/logout.php">Log Out</a>
                    </li>
                <?php
                }
                ?>

                <li class="nav-item">
                <a href="keranjang.php" class="btn btn-link text-dark">
                          <i class="fa-solid fa-bag-shopping fa-lg">

                    <sup>
                              <?php
                               echo cart_item();
                              ?>
                            </sup>
                </i>
                </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php
cart();
?>