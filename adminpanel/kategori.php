<?php
require "session.php";
require "../koneksi.php";

$queryKategori = mysqli_query($con, "SELECT * FROM kategori");
$jumlahKategori = mysqli_num_rows($queryKategori);
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
    <link rel="stylesheet" href="../css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="../css/style.css" />
    <title>DASHBOARD ADMIN</title>
  </head>
  <body>

  <!-- <?php require "navbar.php" ?> -->



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
    <main class="mt-5 pt-3">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 mb-2">
            <h4>Dashboard</h4>
          </div>

          <form action="" method="post">
                <div>
                    <label for="kategori" class="mb-2">Kategori</label>
                    <input type="text" id="kategori" name="kategori" placeholder="input nama kategori" class="form-control">
                </div>

                <div class="my-4">
                    <button class="btn btn-primary" type="submit" name="simpan_kategori">Simpan</button>
                </div>
            </form>
            <?php
            if (isset($_POST['simpan_kategori'])) {
                $kategori =  htmlspecialchars($_POST['kategori']);

                $hasilquery =  mysqli_query($con, "SELECT nama FROM kategori WHERE nama ='$kategori'");
                $jumlahdatakategori = mysqli_num_rows($hasilquery);

                if ($jumlahdatakategori > 0) {
            ?>
                    <div class="alert alert-warning mt-3" role="alert">
                        Data Sudah Ada
                    </div>
                    <?php
                } else {
                    $querySimpan = mysqli_query($con, "INSERT INTO kategori (nama) VALUES ('$kategori') ");
                    if ($querySimpan) {
                    ?>
                        <div class="alert alert-success mt-3" role="alert">
                            Kategori Berhasil Tersimpan
                        </div>
                        <meta http-equiv="refresh" content="2; url=kategori.php" />
            <?php
                    } else {
                        echo mysqli_error($con);
                    }
                }
            }
            ?>
        </div>
        
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <span><i class="bi bi-table me-2"></i></span> Data Table
              </div>
              <div class="card-body">
                <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($jumlahKategori == 0) {
                        ?>
                            <tr>
                                <td colspan="3" class="text-center">Data Tidak Tersedia</td>
                            </tr>
                            <?php
                        } else {
                            $jumlah = 1;
                            while ($data = mysqli_fetch_array($queryKategori)) {
                            ?>
                                <tr>
                                    <td><?php echo $jumlah; ?></td>
                                    <td><?php echo $data['nama']; ?></td>
                                    <td>

                                        <a href="kategori-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-warning">
                                            <i class="bi bi-pen"></i>
                                        </a>
                                        <!-- <a href="kategori-detail.php?p=<?php echo $data['id']; ?>" class="btn btn-danger">
                                            <i class="fas fa-trash"></i>
                                        </a> -->
                                    </td>
                                </tr>
                        <?php
                                $jumlah++;
                            }
                        }
                        ?>
                        
            </div>
            </tbody>
            </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>

  </body>
</html>


<!-- <div class="alert alert-primary mt-3" role="alert">
    This is a primary alert—check it out!
</div> -->