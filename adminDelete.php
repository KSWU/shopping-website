<?php
require_once "config.php";
if (isset($_POST["action"])) {
    if ($_POST["action"] == "delete1") {
        deleteMem();
    }
    if ($_POST["action"] == "delete2") {
        deletePro();
    }
    if ($_POST["action"] == "delete3") {
        deleteOrd();
    }
    if ($_POST["action"] == "delete4") {
        deleteMsg();
    }
}

function deleteMem()
{
    global $conn;
    $member_id = $_POST["member_id"];

    $rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM member WHERE member_id = $member_id"));

    if ($rows) {
        mysqli_query($conn, "DELETE FROM member WHERE member_id = $member_id");
        echo 1;
    } else {
        echo 0;
    }
}

function deletePro()
{
    global $conn;
    $product_id = $_POST["product_id"];

    $rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM product WHERE product_id = $product_id"));

    if ($rows) {
        mysqli_query($conn, "DELETE FROM product WHERE product_id = $product_id");
        echo 2;
    } else {
        echo 0;
    }
}

function deleteOrd()
{
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
}

function deleteMsg()
{
    global $conn;
    $msge_id = $_POST["msge_id"];
    $rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM message WHERE msge_id = $msge_id"));
    if ($rows) {
        mysqli_query($conn, "DELETE FROM message WHERE msge_id = $msge_id");
        echo 4;
    } else {
        echo 0;
    }
}
