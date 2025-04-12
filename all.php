<!-- 開始購物 -->
<html lang="en">
<!-- 哈哈 -->
<!-- 哈哈哈 -->
<!-- 哈哈哈哈 -->
<?php
session_start();
// 在這裡繼續處理添加商品到購物車的程式碼

$link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

//------------------------------------------------------------------------------------------

// $category_choice用來決定顯示甚麼類別的商品(例如：上衣)
//預設是顯示全部商品
$category_choice = "全部";
// 檢查是否傳遞了 category_choice 參數
if (isset($_GET['category_choice'])) {
    // 獲取 category 參數的值
    $category_choice = $_GET['category_choice'];

    // 在此處根據 category 的值進行相應的處理
    // 例如，顯示相關商品、執行相應的查詢、根據 category 加載不同的內容等等

    // 這裡僅簡單地輸出 category 的值作為示例
    // echo "您選擇的商品類別是：" . $category;
} else {
    // 如果未傳遞 category 參數，顯示相應的預設內容
    // echo "請選擇一個商品類別";
}

//------------------------------------------------------------------------------------------

//加入購物車 => 先驗證登入 => 有登入再加到購物車 /  沒登入就先導到登入葉面
if (isset($_POST["add_to_cart"])) { //如果按了"加入購物車"按鈕
    if (!isset($_SESSION["member_id"])) { //沒登入就先導到登入葉面
        $msg = "請先登入！";
        echo "<script>if(confirm('$msg')){window.location.href='login.php';}</script>";
    } else { //有登入 => 加入購物車
        if (isset($_SESSION["shopping_cart"])) {
            $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");
            if (!in_array($_GET["id"], $item_array_id)) {
                $count = count($_SESSION["shopping_cart"]);
                $item_array = array(
                    'item_id' => $_GET["id"],
                    'item_name' => $_POST["hidden_name"],
                    'item_price' => $_POST["hidden_price"],
                    'item_quality' => $_POST["hidden_quality"]

                );
                $_SESSION["shopping_cart"][$count] = $item_array;
            } else {
                // 商品已存在於購物車中，增加其 quality 數量
                foreach ($_SESSION["shopping_cart"] as $key => $value) {
                    if ($value["item_id"] == $_GET["id"]) {
                        $_SESSION["shopping_cart"][$key]["item_quality"] += 1;
                        break;
                    }
                }
                echo '<script>alert("已經新增了")</script>';
                echo '<script>window.location="all.php"</script>';
            }
        } else {
            $item_array = array(
                'item_id' => $_GET["id"],
                'item_name' => $_POST["hidden_name"],
                'item_price' => $_POST["hidden_price"],
                'item_quality' => $_POST["hidden_quality"]
            );
            $_SESSION["shopping_cart"][0] = $item_array;
        }
        header('Location: all.php');
        exit;
    }
}
//------------------------------------------------------------------------------------------
//分頁

// 取得總商品數量的查詢
if($category_choice!="全部")
{
    $count_query = "SELECT COUNT(*) AS total FROM product WHERE category = '" . $category_choice . "'";
}
else{
    $count_query = "SELECT COUNT(*) AS total FROM product ";
}

$count_result = mysqli_query($link, $count_query);
$total_products = mysqli_fetch_assoc($count_result)['total'];

// 設定每頁顯示的商品數量
$products_per_page = 9;

// 計算總頁數
$total_pages = ceil($total_products / $products_per_page);

// 取得目前所在的頁數
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// 計算偏移量
$offset = ($current_page - 1) * $products_per_page;

// // 分頁顯示商品的查詢
// $sql = "SELECT * FROM product WHERE category = '" . $category_choice . "' LIMIT " . $products_per_page . " OFFSET " . $offset;


//------------------------------------------------------------------------------------------

// if (isset($_GET["action"])) //刪除商品
// {
//     if ($_GET["action"] == "delete") {
//         foreach ($_SESSION["shopping_cart"] as $keys => $values) {
//             if ($values["item_id"] == $_GET["id"]) {
//                 unset($_SESSION["shopping_cart"][$keys]);
//                 echo '<script>alert("Item Removed")</script>';
//                 echo '<script>window.location="all.php"</script>';
//             }
//         }
//     }
//     header('Location: cart.php');
//     exit;
// }



// 如果使用者在產品頁面點擊了「加入購物車」按鈕，我們可以檢查表單資料
// if (isset($_POST['product_id'], $_POST['quantity']) && is_numeric($_POST['product_id']) && is_numeric($_POST['quantity'])) {
//     $msg = "成功！";
//     echo "<script>if(confirm('$msg')){window.location.href='';}</script>";
//     // 設置 post 變數以便我們可以輕鬆地識別它們，同時確保它們是整數
//     $product_id = (int)$_POST['product_id'];
//     $quantity = (int)$_POST['quantity'];
//     // 準備 SQL 語句，我們基本上是在檢查產品是否存在於我們的資料庫中
//     $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
//     $stmt->execute([$_POST['product_id']]);
//     // 從資料庫中檢索產品，並將結果作為陣列返回
//     $product = $stmt->fetch(PDO::FETCH_ASSOC);
//     // 檢查產品是否存在（陣列不為空）
//     if ($product && $quantity > 0) {
//         // 產品存在於資料庫中，現在我們可以創建/更新購物車的會話變數
//         if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
//             if (array_key_exists($product_id, $_SESSION['cart'])) {
//                 // 產品已存在於購物車中，所以只需更新數量
//                 $_SESSION['cart'][$product_id] += $quantity;
//             } else {
//                 // 產品不在購物車中，所以將其添加到購物車中
//                 $_SESSION['cart'][$product_id] = $quantity;
//             }
//         } else {
//             // 購物車中沒有產品，這將添加第一個產品到購物車中
//             $_SESSION['cart'] = array($product_id => $quantity);
//         }
//     }
//     // 防止表單重複提交...
//     header('location: index.php?page=cart');
//     exit;
// }
?>

<head>
    <meta charset="utf-8">
    <title>開始購物 Shop now</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- header -->
    <div class="header"></div>
    <!-- header end -->

    <!--//////////////////////////////// Shop Start ////////////////////////////////////////-->
    <div class="container-fluid">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- //////////////////////// Price Start ////////////////////////////////////////-->
                
                <!--////////////////////////////// Price End ////////////////////////////////////////////-->

                <!-- ///////////////////////////// Color Start //////////////////////////////////////////-->
                
                <!--//////////////////////////////////// Color End ////////////////////////////////////-->

                <!--/////////////////////////////////// Size Start ////////////////////////////////////-->
                
                <!--////////////////////////////////// Size End ////////////////////////////////-->
            </div>
            <!--///////////////////////////////////// Shop Sidebar End /////////////////////////////-->


            <!--//////////////////////////////////// Shop Product Start /////////////////////////////-->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    
                    <!-- /////////////////////////////////////////////////////////////////// -->
                    <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 單個商品排版 !!!!!!!!!!!!!!!!!!!!!!!!!!!-->
                    <?php
                    //用來設定單個商品的”查看細節”&”加入購物車” 要顯示甚麼文字
                    //這樣比較好全部一起做更動
                    $View_Detail = "細節"; //查看細節
                    $Add_To_Cart = "加入"; //加入購物車
                    

                    // 查詢要顯示的商品類別($category_choice)
                    // 编写查询语句
                    // $sql = "SELECT photo_path, price,product_name,product_id FROM product where category='.$category_choice.'";
                    // 分頁顯示商品的查詢
                    // $sql = "SELECT * FROM product WHERE category = '" . $category_choice . "' LIMIT " . $products_per_page . " OFFSET " . $offset;
                    if ($category_choice == "全部") {
                        //  $sql = "SELECT  * FROM product ";
                        $sql = "SELECT * FROM product LIMIT " . $products_per_page . " OFFSET " . $offset;
                    } else {
                        // $sql = "SELECT  * FROM product WHERE category = '" . $category_choice . "'";
                        $sql = "SELECT * FROM product WHERE category = '" . $category_choice . "' LIMIT " . $products_per_page . " OFFSET " . $offset;
                    }


                    // 执行查询//
                    $result = mysqli_query($link, $sql);
                    // if (!$result) {
                    //     die('MySQL Error: ' . mysqli_error($connection));
                    // }
                    
                    //利用迴圈歷遍來顯示商品
                    // 处理结果集
                    if (mysqli_num_rows($result) > 0) {
                        // 遍历结果集
                        while ($row = mysqli_fetch_assoc($result)) {
                            // $imagePath = $row['photo_path'];
                            $price = $row['price'];
                            $name = $row['product_name'];
                            $productID = $row['product_id'];
                            $quality = $row['quality'];

                            // 在网站上显示商品信息
                            echo '<div class="col-lg-4 col-md-6 col-sm-12 pb-1">';
                            echo '<div class="card product-item border-0 mb-4">';
                            echo '<div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">';
                            echo '<img class="img-fluid w-100" src="img/' . $productID . '.jpg" alt="">';
                            echo '</div>';
                            echo '<div class="card-body border-left border-right text-center p-0 pt-4 pb-3">';
                            echo '<h6 class="text-truncate mb-3">' . $name . '</h6>';
                            echo '<div class="d-flex justify-content-center">';
                            echo '<h6>$' . $price . '</h6>';
                            echo '</div>';
                            echo '</div>';
                            echo '<div class="card-footer d-flex justify-content-between bg-light border">';
                            // echo '<a href="detail.php" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>  '.$View_Detail.'</a>';
                            // echo '<a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>'.$Add_To_Cart.'</a>';
                            // 如果點擊了"查看細節"，就把 product_id 傳送到 detail.php 頁面，用以決定單個商品頁面要顯示哪個商品
                            echo '<a href="detail.php?product_id=' . $productID . '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>' . $View_Detail . '</a>';



                            //加入購物車
                            echo '<form method="post" action="all.php?action=add&id=' . $row['product_id'] . '" >';
                            // echo '<a href="cart.php?product_id=' . $productID . '" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>' . $Add_To_Cart . '</a>';
                            echo '<input type="hidden" name="hidden_price" value="' . $price . '"> ';
                            echo '<input type="hidden" name="hidden_quality" value="1"> ';
                            echo '<input type="hidden" name="hidden_name" value="' . $name . '"> ';
                            echo '<i class="fas fa-shopping-cart text-primary mr-1"></i><input type="submit" name="add_to_cart" class="btn btn-sm text-dark p-0" value="' . $Add_To_Cart . '">'; // 顯示 "Add To Cart" 按鈕，用於提交表單
                            echo '</form>';




                            echo '</div>';
                            echo '</div>';
                            echo '</div>';
                            echo '';

                        }
                    } else {
                        echo "沒有找到商品信息";
                    }

                    // 关闭数据库连接
                    mysqli_close($link);
                    ?>

                    <!--!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 單個商品排版 End !!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->

                    <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 顯示分頁 !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->
                    <?php

                    echo '<div class="col-12 pb-1">';
                    echo '<nav aria-label="Page navigation">';
                    echo '<ul class="pagination justify-content-center mb-3">';

                    if ($category_choice != "全部") {
                        // 顯示上一頁連結
                        if ($current_page > 1) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="all.php?category=' . urlencode($category_choice) . '&page=1" aria-label="Previous">';
                            echo '<span aria-hidden="true">«</span>';
                            echo '<span class="sr-only">Previous</span>';
                            echo '</a>';
                            echo '</li>';
                        }

                        // 顯示分頁連結
                        for ($page = 1; $page <= $total_pages; $page++) {
                            echo '<li class="page-item' . ($page == $current_page ? ' active' : '') . '">';
                            echo '<a class="page-link" href="all.php?category=' . urlencode($category_choice) . '&page=' . $page . '">' . $page . '</a>';
                            echo '</li>';
                        }

                        // 顯示下一頁連結
                        if ($current_page < $total_pages) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="all.php?category=' . urlencode($category_choice) . '&page=' . $total_pages . '" aria-label="Next">';
                            echo '<span aria-hidden="true">»</span>';
                            echo '<span class="sr-only">Next</span>';
                            echo '</a>';
                            echo '</li>';
                        }
                    }
                    else
                    {
                        // 顯示上一頁連結
                        if ($current_page > 1) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="all.php?page=1" aria-label="Previous">';
                            echo '<span aria-hidden="true">«</span>';
                            echo '<span class="sr-only">Previous</span>';
                            echo '</a>';
                            echo '</li>';
                        }

                        // 顯示分頁連結
                        for ($page = 1; $page <= $total_pages; $page++) {
                            echo '<li class="page-item' . ($page == $current_page ? ' active' : '') . '">';
                            echo '<a class="page-link" href="all.php?page=' . $page . '">' . $page . '</a>';
                            echo '</li>';
                        }

                        // 顯示下一頁連結
                        if ($current_page < $total_pages) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="all.php?page=' . $total_pages . '" aria-label="Next">';
                            echo '<span aria-hidden="true">»</span>';
                            echo '<span class="sr-only">Next</span>';
                            echo '</a>';
                            echo '</li>';
                        }
                    }


                    echo '</ul>';
                    echo '</nav>';
                    echo '</div>';



                    ?>
                    <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 顯示分頁 End !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! -->



                    <!-- <div class="col-12 pb-1">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center mb-3">
                                <li class="page-item disabled">
                                    <a class="page-link" href="#" aria-label="Previous">
                                        <span aria-hidden="true">«</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                <li class="page-item"><a class="page-link" href="#">2</a></li>
                                <li class="page-item"><a class="page-link" href="#">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="#" aria-label="Next">
                                        <span aria-hidden="true">»</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                            </ul>
                        </nav>
                    </div> -->





                </div>
            </div>
            <!-- Shop Product End -->
        </div>
    </div>
    <!-- Shop End -->

    <!-- Footer Start -->
    <div class="footer"></div>
    <!-- Footer End -->

    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top" style="display: none;"><i class="fa fa-angle-double-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Contact Javascript File -->
    <script src="mail/jqBootstrapValidation.min.js"></script>
    <script src="mail/contact.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>

    <!-- header, footer import -->
    <script src="js/header_footer_import.js"></script>


</body>

</html>