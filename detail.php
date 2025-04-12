<!DOCTYPE html>
<html lang="en">
<!-- 哈哈 -->
<!-- 哈哈哈 -->
<!-- 哈哈哈哈 -->
<?php
session_start();
$link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

// 清空 $products 陣列
//$products = array();

// 利用傳送進來的 product_id 來決定顯示哪個商品
// 確保傳遞進來的 product_id 是一個整數值
$productID = intval($_GET['product_id']);

// 編寫查詢語句，使用 WHERE 條件限定 product_id
$sql = "SELECT * FROM product WHERE product_id = $productID";


// 执行查询 一般的
$result = mysqli_query($link, $sql);
if (mysqli_num_rows($result) > 0) {
    // 獲取第一行結果的資料
    $mainProduct = mysqli_fetch_assoc($result);
    $name = $mainProduct['product_name'];
    // $imagePath = $mainProduct['photo_path'];
    $price = $mainProduct['price'];
    $intro = $mainProduct['intro'];
    $category = $mainProduct['category'];
    $quality = $mainProduct['quality'];
    // $row = mysqli_fetch_assoc($result);
//$products[] = $row;
// 獲取商品詳細資訊
// $name = $row['product_name'];
// $imagePath = $row['photo_path'];
// $price = $row['price'];
// $intro = $row['intro'];
// $category = $row['category'];
// $quality = $row['quality'];



    // 遍歷結果集，將每個商品資訊添加到陣列中
    // while ($tem = mysqli_fetch_assoc($result)) {
    //     $products[] = $tem;
    // }
    // 隨機抽取兩個推薦商品
    // $randomIndexes = array_rand($products, 2);
    // $randomProduct1 = $products[$randomIndexes[0]];
    // $randomProduct2 = $products[$randomIndexes[1]];

} else {
    echo "沒有找到該商品的資訊.";
}

//加入購物車
if (isset($_POST["add_to_cart"])) {
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
    header('Location: detail.php?' . $productID . '=' . $productID . '');
    exit;

}

?>

<head>
    <meta charset="utf-8">
    <!-- 設定網頁名稱為【商品名稱】- GM clothing -->
    <title>
        <?php echo '【' . $name . '】- GM clothing'; ?>
    </title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <?php


    $View_Detail = "細節";//查看細節
    $Add_To_Cart = "加入";//加入購物車
    // 處理結果集
    

    // 獲取第一個商品作為主要商品
    // $mainProduct = $products[0];
    
    // 從 $products 陣列中移除第一個商品
    // array_shift($products);
    

    // 遍歷結果集，將每個商品資訊添加到陣列中 => 為了抽取推薦商品
    // while ($tem = mysqli_fetch_assoc($result)) {
    //     $products[] = $tem;
    // }
    
    // 顯示商品詳細資訊
    
    //header
    echo '<div class="header"></div>';
    //header end
    //Shop Detail Start
    echo '<div class="container-fluid py-5">';
    echo '<div class="row px-xl-5">';
    echo '<div class="col-lg-5 pb-5">';
    echo '<div id="product-carousel" class="carousel slide" data-ride="carousel">';
    echo '<div class="carousel-inner border">';
    echo '<div class="carousel-item active">';
    // 要輪播的4張商品圖片
    echo '<img class="w-100 h-100" src="img/' . $productID . '.jpg" alt="Image">';
    echo '</div>';
    echo '<div class="carousel-item">';
    echo '<img class="w-100 h-100" src="img/' . $productID . '.jpg" alt="Image">';
    echo '</div>';
    echo '<div class="carousel-item">';
    echo '<img class="w-100 h-100" src="img/' . $productID . '.jpg" alt="Image">';
    echo '</div>';
    echo ' <div class="carousel-item">';
    echo '<img class="w-100 h-100" src="img/' . $productID . '.jpg" alt="Image">';
    echo '</div></div>';
    echo '<a class="carousel-control-prev" href="#product-carousel" data-slide="prev">';
    echo '<i class="fa fa-2x fa-angle-left text-dark"></i></a>';
    echo '<a class="carousel-control-next" href="#product-carousel" data-slide="next">';
    echo '<i class="fa fa-2x fa-angle-right text-dark"></i></a></div></div>';
    echo '<div class="col-lg-7 pb-5">';
    echo '<h3 class="font-weight-semi-bold">' . $name . ' </h3>';
    echo '<div class="d-flex mb-3">';
    echo '<div class="text-primary mr-2">';
    echo '<small class="fas fa-star"></small>';
    echo '<small class="fas fa-star"></small>';
    echo '<small class="fas fa-star"></small>';
    echo '<small class="fas fa-star-half-alt"></small>';
    echo '<small class="far fa-star"></small>';
    echo '</div>';
    echo '<small class="pt-1">(50 Reviews)</small>';
    echo '</div>';
    echo '<h3 class="font-weight-semi-bold mb-4">$' . $price . '</h3>';
    echo '<p class="mb-4">' .nl2br($intro)  . '';
    //////////////////////////////////////////////////////////////////
    
    /////////////////////////////////////////////////////////
   
    /////////////////////////////////////////////////////////////////////
    // 增加/減少 商品數量  &  加入購物車
    echo '<div class="d-flex align-items-center mb-4 pt-2">';
    echo '<div class="input-group quantity mr-3" style="width: 130px;">';
    echo '<div class="input-group-btn">';
    // echo '<button class="btn btn-primary btn-minus">';
    // echo '<i class="fa fa-minus"></i>';
    // echo '</button>';
    echo '</div>';
    // echo '<input type="text" class="form-control bg-secondary text-center" value="1">';
    echo '<div class="input-group-btn">';
    // echo '<button class="btn btn-primary btn-plus">';
    // echo '<i class="fa fa-plus"></i>';
    // echo '</button>';
    echo '</div>';
    echo '</div>';
    
    //加入購物車
    echo '<form method="post" action="all.php?action=add&id=' . $productID . '" >';
    // echo '<a href="cart.php?product_id=' . $productID . '" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>' . $Add_To_Cart . '</a>';
    echo '<input type="hidden" name="hidden_price" value="' . $price . '"> ';
    echo '<input type="hidden" name="hidden_quality" value="1"> ';
    echo '<input type="hidden" name="hidden_name" value="' . $name . '"> ';
    echo '<i class="fa fa-shopping-cart mr-1"></i><input type="submit" name="add_to_cart" class="btn btn-primary px-3" value="' . $Add_To_Cart . '">'; // 顯示 "Add To Cart" 按鈕，用於提交表單
    echo '</form>';

    // echo '<button class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> ' . $Add_To_Cart . '</button>';
    echo '</div>';
    //////////////////////////////////////////////////////////////////////
    // 分享至fb,twitter,ig
    echo '<div class="d-flex pt-2">';
    echo '<p class="text-dark font-weight-medium mb-0 mr-2">分享至:</p>';
    echo '<div class="d-inline-flex">';
    echo '<a class="text-dark px-2" target="_blank" href="https://zh-tw.facebook.com/">'; //fb
    echo '<i class="fab fa-facebook-f"></i>';
    echo '</a>';
    echo '<a class="text-dark px-2" target="_blank" href="https://twitter.com/?lang=zh-Hant">'; //twitter
    echo '<i class="fab fa-twitter"></i>';
    echo '</a>';
    echo '<a class="text-dark px-2" target="_blank" href="https://www.instagram.com/">'; //instagram
    echo '<i class="fab fa-linkedin-in"></i>';
    echo '</a>';
    // echo '<a class="text-dark px-2" target="_blank" href="">'; //這啥啊??????????????????
    // echo '<i class="fab fa-pinterest"></i>';
    // echo '</a>';
    echo '</div>';
    echo '</div>';
    ////////////////////////////////////////////////////////////////////
    // 商品詳情，商品資訊，留言板 的標題按鈕
    echo '</div>';
    echo '</div>';
    echo '<div class="row px-xl-5">';
    echo '<div class="col">';
    echo '<div class="nav nav-tabs justify-content-center border-secondary mb-4">';
    echo '<a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">商品詳情</a>';
    echo '<a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">商品資訊</a>';
    echo '<a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">留言板</a>';
    echo '</div>';
    //////////////////////////////////////////////////////////////////
    // 商品詳情
    echo '<div class="tab-content">';
    echo '<div class="tab-pane fade show active" id="tab-pane-1">';
    echo '<h4 class="mb-3">商品詳情</h4>';
    echo '<p>' .nl2br($intro) . '</p>';
    // echo '<p>' . $intro . '</p>';
    echo '</div>';
    //////////////////////////////////////////////////////////////////
    // 商品資訊
    echo '<div class="tab-pane fade" id="tab-pane-2">';
    echo '<h4 class="mb-3">額外的資訊</h4>';
    echo '<p>類別：' . $category . '  <br>庫存：' . $quality . '件 </p>';
    echo '<div class="row">';
    echo '<div class="col-md-6">';
    // echo '<ul class="list-group list-group-flush">';
    // echo '<li class="list-group-item px-0">';
    // echo '' . $category . '';
    // echo '</li>';
    // echo '<li class="list-group-item px-0">';
    // echo '' . $category . '';
    // echo '</li>';
    // echo '<li class="list-group-item px-0">';
    // echo '' . $category . '';
    // echo '</li>';
    // echo '<li class="list-group-item px-0">';
    // echo '' . $category . '';
    // echo '</li>';
    // echo '</ul>';
    echo '</div>';
    ///////////////////////////////////////////////////////////////////////////
    echo '<div class="col-md-6">';
    // echo '<ul class="list-group list-group-flush">';
    // echo '<li class="list-group-item px-0">';
    // echo '' . $category . '';
    // echo '</li>';
    // echo '<li class="list-group-item px-0">';
    // echo '' . $category . '';
    // echo '</li>';
    // echo '<li class="list-group-item px-0">';
    // echo '' . $category . '';
    // echo '</li>';
    // echo '<li class="list-group-item px-0">';
    // echo '' . $category . '';
    // echo '</li>';
    // echo '</ul>';
    echo '</div>';
    echo '</div>';
    echo '</div>';
    //////////////////////////////////////////////////////////////////////////////////////////
    // 留言板
    echo '<div class="tab-pane fade" id="tab-pane-3">';
    echo '<div class="row">';
    echo '<div class="col-md-6">';
    echo '<h4 class="mb-4">關於【' . $name . '】的評價</h4>';
    $query = "SELECT * FROM message WHERE product_id = $productID";
    $result = mysqli_query($link, $query);
    for ($i=0; $i<mysqli_num_rows($result); $i++) {
        $mainMessage = mysqli_fetch_assoc($result);
        $memID = $mainMessage['member_id'];
        $querymem = "SELECT * FROM member WHERE member_id = $memID";
        $resultmem = mysqli_query($link, $querymem);
        $mainMem = mysqli_fetch_assoc($resultmem);
        $memname = $mainMem['member_name'];
        $msge = $mainMessage['msge'];
        $msge_date = $mainMessage['msge_date'];
        echo '<div class="media mb-4">';
        echo '<img src="img/user.jpg" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">'; //顧客的頭貼
        echo '<div class="media-body">';
        echo '<h6>'.$memname.'<small> - <i>'.$msge_date.'</i></small></h6>'; //留言時間&顧客的名子
        echo '<p>'.$msge.'</p>'; //顧客的評價
        echo '</div></div>';
    }
    echo '</div>';
    /////////////////////////////////////////////////////////////////////////////////////////
    //留下評價
    echo '<div class="col-md-6">';
    echo '<h4 class="mb-4">留下評價</h4>';
    echo '<form action="addMessage.php" method="post">';
    echo    '<div class="form-group">';
    echo       '<label for="message">您的評論</label>';
    echo       '<textarea id="message" name="message" cols="30" rows="5" class="form-control"></textarea>';
    echo       '<input type="hidden" name="productID" value="'.$productID.'">';
<<<<<<< HEAD
    echo       '<input type="hidden" name="memberID" value="'.$_SESSION['member_id'].'">';
=======
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26
    echo    '</div>';
    echo    '<div class="form-group mb-0">';
    echo       '<input type="submit" value="送出評價" name="add_message" class="btn btn-primary px-3">'; //送出評價
    echo    '</div>';
    echo '</form>';
    echo '</div>';
    echo '</div></div></div></div></div></div>';
    
    //Shop Detail End
    ///////////////////////////////////////////////////////////////////////////////////////
    //推薦商品
    //Products Start
    //以下是推薦的商品，因為目前資料庫只有3筆資料，所以我先用從資料庫中隨機抽取2個商品出來推薦
    //等之後資料庫內容較多時，再來修改
    $recommend = "SELECT * FROM product ORDER BY RAND() LIMIT 5"; // 搜尋亂數抽籤的商品 => 抽2個
    // 执行查询 => 亂數抽籤商品
    $result_recommend = mysqli_query($link, $recommend);
    echo '<div class="container-fluid py-5">';
    echo '<div class="text-center mb-4">';
    echo '<h2 class="section-title px-5"><span class="px-2">您可能會喜歡</span></h2>';
    echo '</div>';
    echo '<div class="row px-xl-5">';
    echo '<div class="col">';
    echo '<div class="owl-carousel related-carousel">';
    // 處理結果集
    if (mysqli_num_rows($result_recommend) > 0) {
        // 顯示隨機抽取的商品
        while ($row = mysqli_fetch_assoc($result_recommend)) {
            $name_rec = $row['product_name'];
            // $imagePath_rec = $row['photo_path'];
            $price_rec = $row['price'];
            $intro_rec = $row['intro'];
            $category_rec = $row['category'];
            $quality_rec = $row['quality'];
            $productID_rec = $row['product_id'];


            // 在這裡顯示商品資訊，可以使用相應的HTML標籤
            /////////////////////////////////////////////////////////////////////////////////////////
            //推薦商品
            echo '<div class="card product-item border-0">'; 
            echo '<div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">';
            echo '<img class="img-fluid w-100" src="img/' . $productID_rec . '.jpg" alt="">'; //推薦商品圖片
            echo '</div>';
            echo '<div class="card-body border-left border-right text-center p-0 pt-4 pb-3">';
            echo '<h6 class="text-truncate mb-3">' . $name_rec . '</h6>'; //推薦商品名稱
            echo '<div class="d-flex justify-content-center">';
            echo '<h6>$' . $price_rec . '</h6>'; //推薦商品的價格
            echo '</div>';
            echo '</div>';
            echo '<div class="card-footer d-flex justify-content-between bg-light border">';
            echo '<a href="detail.php?product_id=' . $productID_rec . '" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>' . $View_Detail . '</a>';


            // echo '<a href="add_to_cart.php?product_id=' . $productID_rec . '" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>' . $Add_To_Cart . '</a>';
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
            //////////////////////////////////////////////////////////////////////////////////////
            //echo '</div>';




            // 或者將商品資訊存儲在陣列中，以供後續使用
            //$randomProducts[] = $row;
        }
        
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    else {
        echo "沒有找到該商品的資訊.";
    }

    // 釋放結果集資源
    mysqli_free_result($result_recommend);


    // -----------
    // echo '<h2>' . $productName . '</h2>';
    // echo '<img src="' . $imagePath . '" alt="' . $productName . '">';
    // echo '<p>價格：$' . $price . '</p>';
    

    // 關閉資料庫連接
    mysqli_close($link);
    ?>

    <!-- Products End -->
    <!-- ////////////////////////////////////////////////////////////////////////////////////////// -->

    <!-- Footer Start -->
    <div class="footer"></div>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-primary back-to-top"><i class="fa fa-angle-double-up"></i></a>


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