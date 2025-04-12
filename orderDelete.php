<?php
require_once "config.php";


  global $conn;
  $order_id = $_POST["order_id"];
  $rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM product_sales WHERE order_id = $order_id"));
  if ($rows) {
    mysqli_query($conn, "DELETE FROM product_sales WHERE order_id = $order_id");
  } else {
    echo 0;
  }

  $rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM order_manage WHERE order_id = $order_id"));
  if ($rows) {
    mysqli_query($conn, "DELETE FROM order_manage WHERE order_id = $order_id");
    echo 3;
  } else {
    echo 0;
  }

?>