<?php
session_start();
require_once "config.php";

// 新增管理者
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["usernam"]) != '') {
    $username = $_POST["usernam"];
    $password = $_POST["password"];
    $repeat_password = $_POST["repeat_password"];
    $member_name = $_POST["nam"];
    $sex = $_POST["se"];
    $birthday = $_POST["birthda"];
    $tel_num = $_POST["tel_nu"];
    $addr = $_POST["add"];
    $email = $_POST["emai"];
    $admin = 'yes';
    $member_date = date('Y-m-d');
    //對密碼加密
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT * FROM member WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);
    $rowCount = mysqli_num_rows($result);


    if ($rowCount > 0) {
        $redirectURL = 'admin.php?addAdm_success=0';
        header("Location:$redirectURL");
        exit;
    } else {
        $sql = "INSERT INTO member (username, password, member_name, sex, birthday, tel_num, addr, mail, admin, member_date) VALUES (?,?,?,?,?,?,?,?,?,?)";
        $stmt = mysqli_stmt_init($conn);
        $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
        if ($prepareStmt) {
            mysqli_stmt_bind_param($stmt, "ssssssssss", $username, $passwordHash, $member_name, $sex, $birthday, $tel_num, $addr, $email, $admin, $member_date);
            mysqli_stmt_execute($stmt);
            $redirectURL = 'admin.php?addAdm_success=1';
            header("Location:$redirectURL");
            exit;
        } else {
            die("Something went wrong: " . mysqli_error($conn));
        }
    }
}

// 新增商品
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_nam"]) != '') {
    $product_nam = $_POST["product_nam"];
    $pric = $_POST["pric"];
    $qualit = $_POST["qualit"];
    $categor = $_POST["categor"];
    $intr = $_POST["intr"];
    $product_date = date('Y-m-d');

    $sql = "INSERT INTO product (product_name, 	price, intro, category, quality, product_date) VALUES (?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
    if ($prepareStmt) {
        mysqli_stmt_bind_param($stmt, "ssssss", $product_nam, $pric, $intr, $categor, $qualit, $product_date);
        mysqli_stmt_execute($stmt);
        // 獲取商品id
        $product_id = mysqli_insert_id($conn);

        if ($_FILES['product_imag']['error'] > 0) {
            echo '錯誤代碼：' . $_FILES['product_imag']['error'] . '<br/>';
        } else {
            # 檢查檔案是否已經存在
            if (file_exists('img/' . $_FILES['product_imag']['name'])) {
                echo '檔案已存在。<br/>';
            } else {
                $file = $_FILES['product_imag']['tmp_name'];
                $dest = 'img/' . $_FILES['product_imag']['name'];

                # 將檔案移至指定位置
                move_uploaded_file($file, $dest);
                $uploadDir = "img/";
                $newFilename = $product_id . ".jpg"; // 新的文件名，使用商品ID
                rename("img/" . $_FILES["product_imag"]["name"], "img/" . $newFilename);
                $redirectURL = 'admin.php?addPro_success=1';
                header("Location:$redirectURL");
                exit;
            }
        }
    }
}

//新增留言
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["msge_pro"])) {
    $msge_pro = $_POST["pro_id"];
    $re = $_POST["re"];
    $adm = $_SESSION["member_id"];
    $today = date("Y-m-d H:i:s");

    $sql = "INSERT INTO message (member_id, product_id, msge, msge_date) VALUES (?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
    if ($prepareStmt) {
        mysqli_stmt_bind_param($stmt, "ssss", $adm, $msge_pro, $re, $today);
        mysqli_stmt_execute($stmt);
        $redirectURL = 'admin.php?reMsg_success=1';
        header("Location:$redirectURL");
        exit;
    } else {
        die("Something went wrong: " . mysqli_error($conn));
        $redirectURL = 'admin.php?reMsg_success=0';
        header("Location:$redirectURL");
        exit;
    }
}
