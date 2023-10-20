<?php
require "session.php";
require "../koneksi.php";

$id = $_GET['p'];
// query untuk mengambil data
$query = mysqli_query($con, "SELECT a.*, b.nama AS nama_kategori from produk a join kategori b on a.kategori_id=b.id WHERE a.id='$id'");
$data = mysqli_fetch_array($query);

// agar data tidak sama ketika memilih kategori
$queryKategori = mysqli_query($con, "SELECT * FROM kategori where id!='$data[kategori_id]'");
function generateRandomString($length = 10)
{
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Produk Detail</title>
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">

</head>

<body>
    <div class="container mt-5">
        <h2>Detail Produk</h2>

        <div class="col-12 col-md-6 mb-5 ">
            <form action="" method="post" enctype="multipart/form-data">
                <div>
                    <label for="nama">Nama Produk</label>
                    <input type="text" id="nama" name="nama" value="<?php echo $data['nama']  ?>" placeholder="" class="form-control" autocomplete="off" required>
                </div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value="<?php echo $data['kategori_id'] ?>"><?php echo $data['nama_kategori'] ?></option>
                    <?php
                    while ($dataKategori = mysqli_fetch_array($queryKategori)) {
                    ?>
                        <option value="<?php echo $dataKategori['id'] ?>"><?php echo $dataKategori['nama']; ?> </option>
                    <?php
                    }
                    ?>
                </select>
      
                <div>
                </div>
                <label for="kategori">Kategori</label>
                <select name="kategori" id="kategori" class="form-control" required>
                    <option value= "Biru">Biru</option>
                    <option value= "Biru">Merah</option>
                    <option value= "Biru">Kuning</option>

                </select>
      
                <div>
                    <label for="harga">Harga</label>
                    <input type="number" class="form-control" value="<?php echo $data['harga'] ?>" name="harga" required>
                </div>
                <div>
                    <label for="currentfoto">Foto Produk Sekarang</label>
                    <img src="../image/<?Php echo $data['foto'] ?>" class="rounded mx-4 d-block mt-2" alt="" width="200 px">
                </div>
                <div>
                    <label for="foto">Foto</label>
                    <input type="file" name="foto" id="foto" class="form-control">
                </div>
                <div>
                    <label for="detail">Detail</label>
                    <textarea name="detail" id="detail" cols="30" rows="10" class="form-control">
                        <?php
                        echo $data['detail'];
                        ?>
                        </textarea>
                </div>
                <div>
                    <label for="ketersediaan_stok">Ketersediaan Stok</label>
                    <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                        <option value="<?php echo $data['ketersediaan_stok'] ?>"><?php echo $data['ketersediaan_stok'] ?></option>
                        <?php
                        if ($data['ketersediaan_stok'] == 'tersedia') {
                        ?>
                            <option value="habis">Habis</option>
                        <?php
                        } else {
                        ?>
                            <option value="tersedia">tersedia</option>
                        <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary mt-3" name="simpan">Simpan</button>
                        <button type="submit" class="btn btn-danger mt-3" name="hapus">Hapus</button>
                    </div>
                </div>
            </form>
            <?php
            if (isset($_POST['simpan'])) {
                $nama = htmlspecialchars($_POST['nama']);
                $kategori = htmlspecialchars($_POST['kategori']);
                $harga = htmlspecialchars($_POST['harga']);
                $detail = htmlspecialchars($_POST['detail']);
                $ketersediaan_stok = htmlspecialchars($_POST['ketersediaan_stok']);

                $target_dir = "../image/";
                $nama_file = basename($_FILES["foto"]["name"]);
                $target_file = $target_dir . $nama_file;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                $image_size = $_FILES["foto"]["size"];
                $random_name = generateRandomString(20);
                $new_name =  $random_name . "." . $imageFileType;

                if ($nama == '' || $kategori == '' || $harga == '') {
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Nama,Kategori dan Harga Wajib di isi
                    </div>
                <?php
                } else {
                    $queryUpdate = mysqli_query($con, "UPDATE produk SET kategori_id='$kategori', nama='$nama', harga='$harga', detail='$detail', ketersediaan_stok='$ketersediaan_stok' WHERE id=$id");
                    ?>
                                    <div class="alert alert-success mt-3" role="alert">
                                        Produk Berhasil Update
                                    </div>
                                    <meta http-equiv="refresh" content="2; url=produk.php" />
                    <?php
                    if ($nama_file != '') {
                        if ($image_size > 50000000) {
                    ?>
                            <div class="alert alert-warning mt-3" role="alert">
                                File Tidak boleh lebih dari 500 kb <kbd></kbd>
                            </div>
                            <?php
                        } else {
                            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                            ?>
                                <div class="alert alert-warning mt-3" role="alert">
                                    File Wajib Bertipe jpg atau png atau gif <kbd></kbd>
                                </div>
                                <?php
                            } else {
                                move_uploaded_file($_FILES["foto"]["tmp_name"], $target_dir . $new_name);

                                $queryUpdate = mysqli_query($con, "UPDATE produk set foto='$new_name' where id='$id'");
                                if ($queryUpdate) {
                                ?>
                                    <div class="alert alert-success mt-3" role="alert">
                                        Produk Berhasil Update
                                    </div>
                                    <meta http-equiv="refresh" content="2; url=produk.php" />
                    <?php
                                } else {
                                    echo mysqli_error($con);
                                }
                            }
                        }
                    } 
                }
            }
            if (isset($_POST['hapus'])) {
                // sintaks untuk menghapus produk dari database
                $queryHapus =  mysqli_query($con, "DELETE from produk where id='$id'");
                if ($queryHapus) {
                    // melakukan pengecekan pada produk yang di hapus
                    ?>
                    <div class="alert alert-primary mt-3" role="alert">
                        Produk Berhasil Di Hapus
                    </div>
                    <meta http-equiv="refresh" content="2; url=produk.php" />
            <?php
                }
            }
            ?>
        </div>
    </div>
    <script src=" ../bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>