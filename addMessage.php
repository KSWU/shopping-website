<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_message"])) {
    $member_id = $_POST['memberID'];
    $msg = $_POST['message'];
    $id = $_POST['productID'];
    $now = date('Y-m-d H:i:s');

    // 留言
    $sql = "INSERT INTO message(member_id, product_id, msge, msge_date) VALUES ('$member_id', '$id', '$msg', '$now')";
    if (mysqli_query($conn, $sql)) {
        // 留言成功
        echo "<script>alert('留言成功 ! ');</script>";
        header("Location:detail.php?product_id=$id");
        exit;
    } else {
        // 留言失败
        echo "<script>alert('留言失敗 ! ');</script>";
    }
}
?>