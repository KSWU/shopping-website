<?php
require_once "config.php";

$username = $_POST["username"];

// 执行帐号验证查询
$sql = "SELECT COUNT(*) FROM member WHERE username = '$username'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if ($row[0] > 0) {
    echo 1;
} else {
    echo 0;
}

mysqli_close($conn);
