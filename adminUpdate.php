<!-- 按下更新處理 -->
<?php
require_once "config.php";

//會員更新
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["member_id"])) {
    $member_id = $_POST["member_id"];
    $username = $_POST["username"];
    $name = $_POST["name"];
    $sex = $_POST["sex"];
    $birthday = $_POST["birthday"];
    $tel_num = $_POST["tel_num"];
    $addr = $_POST["addr"];
    $email = $_POST["email"];

    $sql = "UPDATE member SET username='$username', member_name='$name', sex='$sex', birthday='$birthday', tel_num='$tel_num', addr='$addr', mail='$email' WHERE member_id=$member_id";
    if (mysqli_query($conn, $sql)) {
        // 更新成功
        $redirectURL = 'admin.php?update_success=1';
        header("Location:$redirectURL");
        exit;
    } else {
    }
}

//商品更新
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["product_name"])) {
    $product_id = $_POST["product_id"];
    $product_name = $_POST["product_name"];
    $price = $_POST["price"];
    $quality = $_POST["quality"];
    $category = $_POST["category"];
    $intro = $_POST["intro"];

    $sql = "UPDATE product SET product_name='$product_name', price='$price', intro='$intro', category='$category', quality='$quality' WHERE product_id=$product_id";
    if (mysqli_query($conn, $sql)) {
        //如果使用者有上傳圖片
        if (isset($_FILES['product_image']['name']) && !empty($_FILES['product_image']['name'])) {
            if ($_FILES['product_image']['error'] > 0) {
                echo '錯誤代碼：' . $_FILES['product_image']['error'] . '<br/>';
            } else {
                # 檢查檔案是否已經存在
                if (file_exists('img/' . $_FILES['product_image']['name'])) {
                    echo '檔案已存在。<br/>';
                } else {
                    if (file_exists($product_id . '.jpg')) {
                        unlink($product_id . '.jpg'); //將原本檔案刪除
                    }
                    $file = $_FILES['product_image']['tmp_name'];
                    $dest = 'img/' . $_FILES['product_image']['name'];
                    // 將檔案移至指定位置
                    move_uploaded_file($file, $dest);
                    $uploadDir = "img/";
                    $newFilename = $product_id . ".jpg"; // 新的文件名，使用商品ID
                    rename("img/" . $_FILES["product_image"]["name"], "img/" . $newFilename);
                    $redirectURL = 'admin.php?updateP_success=1';
                    header("Location:$redirectURL");
                    exit;
                }
            }
        } else {
            $redirectURL = 'admin.php?updateP_success=1';
            header("Location:$redirectURL");
            exit;
        }
    } else {
        // 更新失败
    }
}


//訂單狀態更新
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["order_id"])) {
    $order_id = $_POST["order_id"];
    $order_state = $_POST["order_state"];

    if ($order_state == '已完成') {
        $order_id = $_POST["order_id"];
        $query = "SELECT product_id, num FROM product_sales WHERE order_id = $order_id";
        $result_sales = mysqli_query($conn, $query);
        $update_successful = true; //確認是否該更新狀態
        while ($row_sales = mysqli_fetch_assoc($result_sales)) {
            $product_id = $row_sales['product_id'];
            $num = $row_sales['num'];

            $query_product = "SELECT quality FROM product WHERE product_id = $product_id";
            $result_product = mysqli_query($conn, $query_product);
            $row_product = mysqli_fetch_assoc($result_product);
            $current_quality = $row_product['quality'];

            $updated_quality = $current_quality - $num;

            if ($updated_quality >= 0) { //如果庫存足夠
                $query_update = "UPDATE product SET quality = $updated_quality WHERE product_id = $product_id";
                mysqli_query($conn, $query_update);
            } else {
                $update_successful = false;
                break;
            }
        }

        if ($update_successful) {
            $sql = "UPDATE order_manage SET order_state='$order_state' WHERE order_id=$order_id";
            if (mysqli_query($conn, $sql)) {
                // 更新成功
                $redirectURL = 'admin.php?update_success=3';
                header("Location:$redirectURL");
                exit;
            } else {
                // 更新失败
            }
        } else {
            //庫存不足
            $redirectURL = 'admin.php?update_success=-3';
            header("Location:$redirectURL");
            exit;
        }
    } else {
        //更新訂單狀態
        $sql = "UPDATE order_manage SET order_state='$order_state' WHERE order_id=$order_id";
        if (mysqli_query($conn, $sql)) {
            // 更新成功
            $redirectURL = 'admin.php?update_success=3';
            header("Location:$redirectURL");
            exit;
        } else {
            // 更新失败
        }
    }
}


//留言更新
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["msge_id"])) {
    $msge_id = $_POST["msge_id"];
    $msge = $_POST["msge"];

    $sql = "UPDATE message SET msge='$msge' WHERE msge_id=$msge_id";
    if (mysqli_query($conn, $sql)) {
        // 更新成功
        $redirectURL = 'admin.php?update_success=4';
        header("Location:$redirectURL");
        exit;
    } else {
    }
}
