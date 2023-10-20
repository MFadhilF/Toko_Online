<?php 
session_start();
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

<div class="container">
    <div class="row">
        <form action="" method="post">
            <table class="table table-bordered text-center mt-5">
                <?php
                $get_ip_add = getIPAddress();
                $total_price = 0;
                $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
                $result = mysqli_query($con, $cart_query);
                $result_count = mysqli_num_rows($result);
                if ($result_count > 0) {
                    while ($row = mysqli_fetch_array($result)) {
                        $id = $row['id'];
                        $select_products = "SELECT * FROM produk WHERE id='$id'";
                        $result_products = mysqli_query($con, $select_products);
                        while ($row_product_price = mysqli_fetch_array($result_products)) {
                            $product_price = array($row_product_price['harga']);
                            $price_table = $row_product_price['harga'];
                            $product_title = $row_product_price['nama'];
                            $product_image1 = $row_product_price['foto'];
                            $product_values = array_sum($product_price);
                            $total_price += $product_values;
                ?>
                            <thead>
                                <tr>
                                    <th>Nama Produk</th>
                                    <th>Gambar Produk</th>
                                    <th>Kuantitas</th>
                                    <th>Total Harga</th>
                                    <th>Hapus</th>
                                    <th>Operasi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td><?php echo $product_title ?></td>
                                    <td><img src="./image <?php echo $product_image1 ?>" alt="" class="cart_img" style="width: 20%;"></td>
                                    <td><input type="text" name="qty" class="form-input w-75 "></td>

                                    <?php
                                    $get_ip_add = getIPAddress();
                                    if (isset($_POST['update_cart'])) {
                                        $quantities = $_POST['qty'];
                                        $update_cart = "UPDATE cart_details SET qty=$quantities WHERE ip_address='$get_ip_add'";
                                        $result_products_quantity = mysqli_query($con, $update_cart);
                                        $total_price = $total_price * $quantities;
                                    }
                                    ?>

                                    <td>Rp <?php echo $price_table ?></td>
                                    <td>
                                        <input type="checkbox" name="removeitem[]" value="<?php echo $id ?>">
                                    </td>
                                    <td class="d-flex align-items-center justify-content-between">
                                        <input type="submit" value="Perbarui Keranjang" class="bg-info text-light px-3 py-2 border-0 mx-3" name="update_cart">
                                        <input type="submit" value="Hapus Keranjang" class="bg-info text-light px-3 py-2 border-0 mx-3" name="remove_cart">
                                    </td>
                                </tr>
                    <?php
                        }
                    }
                } else {
                    echo "<h2 class='text-center mt-5'>Keranjang kosong</h2>";
                }
                    ?>

                            </tbody>
            </table>
            <div class="d-flex mb-5">
                <?php
                $get_ip_add = getIPAddress();
                $total_price = 0;
                $cart_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
                $result = mysqli_query($con, $cart_query);
                $result_count = mysqli_num_rows($result);
                if ($result_count > 0) {
                    echo "
              <h4 class='px-3'>Total: <strong class='text-dark'>Rp <?php echo $total_price ?></strong></h4>
              <button class='bg-success px-3 py-2 border-0'>
                <a href='./user/checkout.php' class='text-light text-decoration-none'>Pembayaran
                </a>
              </button>   
              <input type='submit' value='Lanjutkan Belanja' class='bg-info text-light px-3 py-2 border-0 mx-3' name='continue_shopping'>
            ";
                } else {
                    echo "
              <input type='submit' value='Lanjutkan Belanja' class='bg-info text-light px-3 py-2 border-0 mx-3' name='continue_shopping'>
            ";
                }

                if (isset($_POST['continue_shopping'])) {
                    echo "
            <script>window.open('index.php', '_self')</script>
            ";
                }
                ?>

            </div>
    </div>
</div>
</form>
<?php
function remove_cart_item()
{
    global $con;
    if (isset($_POST['remove_cart'])) {
        foreach ($_POST['removeitem'] as $remove_id) {
            echo $remove_id;
            $delete_query = "DELETE FROM cart_details where id=$remove_id";
            $run_delete = mysqli_query($con, $delete_query);
            if ($run_delete) {
                echo "<script>window.open('keranjang.php', '_self')</script>";
            }
        }
    }
    // echo $remove_item = remove_cart_item();
}


?>
