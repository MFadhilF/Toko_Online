<?php
function cart() {
    if (isset($_GET['add_to_cart'])) {
        global $con;
        $get_ip_add = getIPAddress();
        $get_id = $_GET['add_to_cart'];
        $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add' AND id='$get_id' ";
        $result_query = mysqli_query($con, $select_query);
        $num_of_rows = mysqli_num_rows($result_query);
          if($num_of_rows>0){
            echo "
            <script>
            alert ('Barang Ditambahkan')
            </script>";
            echo "
            <script>
            window.open('index.php','_self')
            </script>";
        }else {
          $insert_query = "INSERT INTO cart_details (id, ip_address, qty) 
          VALUES ($get_id, '$get_ip_add', 1)";
          $result_query = mysqli_query($con, $insert_query);
            echo"
            <script>
            alert ('Barang Ditambahkan')
            </script>";
            echo"
            <script>
            window.open('index.php','_self')
            </script>";

        } 
      }
    }


  function cart_item(){
    if (isset($_GET['add_to_cart'])) {
      global $con;
        $get_ip_add = getIPAddress();
        $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
        $result_query = mysqli_query($con, $select_query);
        $count_cart_items = mysqli_num_rows($result_query);
    }else{
        global $con;
          $get_ip_add = getIPAddress();
          $select_query = "SELECT * FROM cart_details WHERE ip_address='$get_ip_add'";
          $result_query = mysqli_query($con, $select_query);
          $count_cart_items = mysqli_num_rows($result_query);
      }
    echo $count_cart_items;
  }
function getIPAddress() {  
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {  
      $ip = $_SERVER['HTTP_CLIENT_IP'];  
    } elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
      $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
      $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
  }

  function getproducts(){
    global $con;
    if(!isset($_GET['kategori'])){
      $select_query = "SELECT * FROM produk order by rand() limit 0,9";
      $result_select = mysqli_query($con, $select_query);
      while($row = mysqli_fetch_assoc($result_select)){
        $product_id=$row['id'];
        $product_title=$row['nama'];
        $product_description=$row['detail'];
        $product_image1=$row['foto'];
        $product_price=$row['harga'];
        // $category_id=$row['kategori_id'];
        echo "
          <div class='col-md-4 mb-2 mt-5'>
            <img src='./image/$product_image1' class='card-img-top' alt='$product_title'>
            <div class='card-body'>
              <h5 class='card-title text-center'>$product_title</h5>
              <p class='card-text text-center'>$product_description</p>
              <p class='card-text text-center text-body-tertiary'>Rp $product_price</p>
              <div class='text-center'>
                <a href='index.php?add_to_cart=$product_id' class='btn btn-primary'><i class='fa-solid fa-plus'></i> Keranjang</a>
              </div>
            </div>
          </div>";
      }
    }
}



?>