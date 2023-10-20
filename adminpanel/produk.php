<?php

require "session.php";
require "../koneksi.php";

$queryProduk = mysqli_query($con, "SELECT a.*,b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id =b.id");
$jumlahProduk = mysqli_num_rows($queryProduk);

$queryKategori =  mysqli_query($con, "SELECT * FROM kategori ");
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
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="../css/bootstrap.min.css" />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css"
    />
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>DASHBOARD ADMIN</title>
  </head>
  <body>

    <!-- top navigation bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container-fluid">
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="offcanvas"
          data-bs-target="#sidebar"
          aria-controls="offcanvasExample"
        >
          <span class="navbar-toggler-icon" data-bs-target="#sidebar"></span>
        </button>
        <a
          class="navbar-brand me-auto ms-lg-0 ms-3 text-uppercase fw-bold"
          href="#"
          >ADMIN</a
        >
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#topNavBar"
          aria-controls="topNavBar"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="topNavBar">
          <form class="d-flex ms-auto my-3 my-lg-0">
            <div class="input-group">
              <input
                class="form-control"
                type="search"
                placeholder="Search"
                aria-label="Search"
              />
              <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </form>
          <ul class="navbar-nav">
            <li class="nav-item ">
              <a
              class="nav-link"
              href="#"
              role="button"
              data-bs-toggle=""
              aria-expanded="false"
              >
              <i class="bi bi-person-fill"></i>
            </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- top navigation bar -->


    <!-- sidebar -->
    <div
      class="offcanvas offcanvas-start sidebar-nav bg-dark"
      tabindex="-1"
      id="sidebar"
    >
      <div class="offcanvas-body p-0">
        <nav class="navbar-dark">
          <ul class="navbar-nav">
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3">
                CORE
              </div>
            </li>
            <li>
              <a href="index.php" class="nav-link px-3 active">
                <span class="me-2"><i class="bi bi-speedometer2"></i></span>
                <span>Dashboard</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                KATALOG
              </div>
            </li>
            <li>
              <a href="kategori.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-layout-split"></i></span>
                <span>Kategori</span>
              </a>
            </li>
            <li>
              <a href="produk.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-shop"></i></span>
                <span>Produk</span>
              </a>
            </li>
            <li class="my-4"><hr class="dropdown-divider bg-light" /></li>
            <li>
              <div class="text-muted small fw-bold text-uppercase px-3 mb-3">
                ACCOUNT
              </div>
            </li>
            <li>
              <a href="#" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-pen"></i></span>
                <span>Edit</span>
              </a>
            </li>
            <li>
              <a href="login.php" class="nav-link px-3">
                <span class="me-2"><i class="bi bi-arrow-bar-right"></i></span>
                <span>Logout</span>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </div>
    <!-- sidebar -->


    <!-- main content -->
    <main class="">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 mb-5">
            <h4></h4>
          </div>
        </div>

        <div class="d-flex justify-content-between align-items-center my-4">

        
        <h2>List Produk</h2>

        <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Input Data Produk
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Produk</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="">
                <form action="" method="post" enctype="multipart/form-data">
                    <div>
                        <label for="nama">Nama Produk</label>
                        <input type="text" id="nama" name="nama" placeholder="" class="form-control" autocomplete="off" required>
                    </div>
                    <div>
                        <label for="kategori">Kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option value="">Pilih Satu</option>
                            <?php
                            while ($data = mysqli_fetch_array($queryKategori)) {
                            ?>
                                <option value="<?php echo $data['id'] ?>"><?php echo $data['nama']; ?> </option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="harga">Harga</label>
                        <input type="number" class="form-control"  name="harga" required>
                    </div>
                    <div>
                        <label for="foto">Foto</label>
                        <input type="file" name="foto" id="foto" class="form-control">
                    </div>
                    <div>
                        <label for="detail">Detail</label>
                        <textarea name="detail" id="detail" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    <div>
                        <label for="ketersediaan_stok">Ketersediaan Stok</label>
                        <select name="ketersediaan_stok" id="ketersediaan_stok" class="form-control">
                            <option value="tersedia">Tersedia</option>
                            <option value="habis">Habis</option>
                        </select>
                    </div>
                    <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="simpan">Simpan</button>
        </div>
                </form>
                <div>
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
                                Nama,Kategori . dan Harga Wajib di isi
                            </div>
                            <?php
                        } else {
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
                                    }
                                }
                            }
                            //    query insert to produk table
                            $queryTambah =  mysqli_query($con, "INSERT INTO produk (kategori_id,nama,harga,foto,detail, ketersediaan_stok) VALUES ('$kategori', '$nama', '$harga','$new_name', '$detail', '$ketersediaan_stok' ) ");

                            if ($queryTambah) {
                                ?>
                                <div class="alert alert-success mt-3" role="alert">
                                    Produk Berhasil Ditambahkan
                                </div>
                                <meta http-equiv="refresh" content="2; url=produk.php" />
                    <?php
                            } else {
                                echo mysqli_error($con);
                            }
                        }
                    }
                    ?>
                </div>
            </div>
      </div>
      
    </div>
  </div>
</div>
</div>

       
        
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Table
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  
                <!-- INI MASUKIN TABEL DATA  -->
                <div class=" mt-3 ">
            <div class="table-responsive ">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Kategori</th>
                            <th>Harga</th>
                            <th>Ketesediaan Stok</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahProduk == 0) {
                        ?>
                            <tr>
                                <td colspan="6" class="text-center">Produk Tidak Tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryProduk)) {
                            ?>
                                <tr>
                                    <td><?php echo $jumlah; ?> </td>
                                    <td><?php echo $data['nama']; ?> </td>
                                    <td><?php echo $data['nama_kategori']; ?> </td>
                                    <td><?php echo $data['harga']; ?> </td>
                                    <td><?php echo $data['ketersediaan_stok']; ?></td>
                                    <td><a href="produk-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-warning">
                                            <i class="bi bi-pen"></i>
                                        </a>
                                        <a href="produk-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-danger">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                        <?php

                                $jumlah++;
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  </body>
</html>
