<!-- 首頁 -->
<!-- 哈哈 -->
<!-- 哈哈哈 -->
<?php
session_start();

$link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

//-----------------------------------------------------------------------------------------------

// 查詢商品各個類別的數量總和
// 執行查詢，獲取相同類別的數量總和
$sql = "SELECT category, quality FROM product";
$result = mysqli_query($link, $sql);

$categoryStocks = array();
if (!$result) {
    die('查詢錯誤: ' . mysqli_error($link));
}
while ($row = mysqli_fetch_assoc($result)) {
    $category_db = $row['category'];
    $quality = $row['quality'];

    if (!isset($category_quality[$category_db])) {
        // 如果類別尚未在陣列中，則初始化為 0
        $category_quality[$category_db] = 0;
    }

    // 將庫存加總到相應的類別
    $category_quality[$category_db] += 1;
}

//儲存各個商品類別的數量
$tops = 0;
$pants = 0;
$shorts = 0;
$skirt = 0;
$jumpsuits = 0;
$jackets = 0;
foreach ($category_quality as $category_db => $total_quality) {
    if ($category_db === '上衣')
        $tops = $total_quality;
    if ($category_db === '長褲')
        $pants = $total_quality;
    if ($category_db === '短褲')
        $shorts = $total_quality;
    if ($category_db === '裙裝')
        $skirt = $total_quality;
    if ($category_db === '連身')
        $jumpsuits = $total_quality;
    if ($category_db === '外套')
        $jackets = $total_quality;
}

//------------------------------------------------------------------------------------------

//計算購物車中總共有多少商品
$totalQuality = 0;
if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
    foreach ($_SESSION["shopping_cart"] as $item) {
        $totalQuality += $item["item_quality"];
    }
    // echo "購物車中商品的 quality 總和為: " . $totalQuality;
} else {
    // echo "購物車是空的";
}

//-----------------------------------------------------------------------------------------

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Gummy Monkey Clothing</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <!-- index情況特殊，故獨立header -->
    <!-- header --> <!-- 購物車技術功能待新增 -->
    <div class="container-fluid">
        <div class="row bg-secondary py-2 px-xl-5">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark" href="">FAQs</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Help</a>
                    <span class="text-muted px-2">|</span>
                    <a class="text-dark" href="">Support</a>
                </div>
            </div>
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a class="text-dark pl-2" href="">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center py-3 px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
<<<<<<< HEAD
                <a href="index.php" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">G</span>Monkey</h1>
=======
                <a href="" class="text-decoration-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">G</span>Monkey</h1>
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26
                </a>
            </div>
            <!-- <div class="col-lg-6 col-6 text-left">
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="搜尋商品 Search for products">
                        <div class="input-group-append">
                            <span class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </span>
                        </div>
                    </div>
                </form>
            </div> -->
            <!--搜尋商品 -->
            <div class="col-lg-6 col-6 text-left">
                <form name="search" action="searchResult.php" method="POST">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="搜尋商品 Search for products">
                        <div class="input-group-append">
                            <button class="input-group-text bg-transparent text-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <!--搜尋商品 END-->
            <div class="col-lg-3 col-6 text-right">
                <!-- 購物車 -->
                <!-- <a href="" class="btn border"> 
                    <i class="fas fa-heart text-primary"></i>
                    <span class="badge">0</span>
                </a> -->
                <a href="cart.php" class="btn border"> <!-- 購物車 -->
                    <i class="fas fa-shopping-cart text-primary"></i>
<<<<<<< HEAD
                    <span class="badge">
                        <?php echo '' . $totalQuality . ''; ?>
                    </span>
=======
                    <span class="badge"><?php echo '' . $totalQuality . ''; ?></span>
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26
                </a>
                <!-- 購物車end -->
            </div>
        </div>
    </div>
    <!-- header End -->

    <!-- Navbar Start --> <!-- 登入註冊頁面、功能待新增 -->
    <div class="container-fluid mb-5">
        <div class="row border-top px-xl-5">
            <div class="col-lg-3 d-none d-lg-block">
                <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                    <h6 class="m-0">商品分類</h6>
                    <i class="fa fa-angle-down text-dark"></i>
                </a>
                <nav class="collapse show navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                    <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                        <?php

                        // 傳送顧客選擇的類別到 all.php (以category_choice這個變數來傳遞)
                        // 用來決定要顯示甚麼類別的商品
                        echo '
                        <a href="all.php?category_choice=' . urlencode("全部") . '" class="nav-item nav-link">全部 ALL </a>
                        <a href="all.php?category_choice=' . urlencode("上衣") . '" class="nav-item nav-link">上衣 TOPS</a>
                        <a href="all.php?category_choice=' . urlencode("長褲") . '" class="nav-item nav-link">長褲 PANTS </a>
                        <a href="all.php?category_choice=' . urlencode("短褲") . '" class="nav-item nav-link">短褲 SHORTS </a>
                        <a href="all.php?category_choice=' . urlencode("裙裝") . '" class="nav-item nav-link">裙裝 SKIRTS </a>
                        <a href="all.php?category_choice=' . urlencode("連身") . '" class="nav-item nav-link">連身 JUMPSUITS </a>
                        <a href="all.php?category_choice=' . urlencode("外套") . '" class="nav-item nav-link">外套 JACKETS </a>
                        <a href="all.php?category_choice=' . urlencode("配飾") . '" class="nav-item nav-link">配飾 ACCESSORIES </a>
                        <a href="all.php?category_choice=' . urlencode("鞋子") . '" class="nav-item nav-link">鞋子 SHOES </a>';

                        ?>

                        <!-- 原作者程式碼 -->
                        <!-- <a href="" class="nav-item nav-link">全部 ALL </a>
                        <a href="" class="nav-item nav-link">上衣 TOPS </a>
                        <a href="" class="nav-item nav-link">長褲 PANTS </a>
                        <a href="" class="nav-item nav-link">短褲 SHORTS </a>
                        <a href="" class="nav-item nav-link">裙裝 SKIRTS </a>
                        <a href="" class="nav-item nav-link">連身 JUMPSUITS </a>
                        <a href="" class="nav-item nav-link">外套 JACKETS </a>
                        <a href="" class="nav-item nav-link">配飾 ACCESSORIES </a>
                        <a href="" class="nav-item nav-link">鞋子 SHOES </a> -->

                    </div>
                </nav>
            </div>
            <div class="col-lg-9">
                <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">首頁</a>
                            <a href="all.php" class="nav-item nav-link">開始購物</a>
                            <a href="cart.php" class="nav-item nav-link">購物車</a>
                            <a href="contact.php" class="nav-item nav-link">聯絡我們</a>
                        </div>
                        <!-- 決定顯示 登入/註冊 or 使用者名稱/登出 -->
                        <div class="navbar-nav ml-auto py-0">
                            <?php
                            if (!isset($_SESSION["member_id"])) {
                                echo "<a href='login.php' class='nav-item nav-link'>登入</a>";
                                echo "<a href='register.php' class='nav-item nav-link'>註冊</a>";
                            } else if (isset($_SESSION["member_id"])) {
                                if ($_SESSION["admin"] == 'yes')
                                    $url = 'admin.php';
                                else
                                    $url = 'member.php';

                                if ($_SESSION["admin"] == NULL)
                                    echo "<a href='$url' class='nav-item nav-link'>{$_SESSION['member_name']}の會員中心</a>";
                                else
                                    echo "<a href='$url' class='nav-item nav-link'>{$_SESSION['member_name']}の管理中心</a>";
                                echo "<a href='logout.php' class='nav-item nav-link'>登出</a>";
                            }
                            ?>
                        </div>
                    </div>
                </nav>
                <!-- 資訊輪播 -->
                <div id="header-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active" style="height: 410px;">
                            <img class="img-fluid" src="img/carousel-1.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">6 / 15 ~ 7 / 20 瘋狂購物節
                                        !</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">全館 1000 NTD 免運</h3>
                                    <a href="all.php" class="btn btn-light py-2 px-3">開始購物</a>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item" style="height: 410px;">
                            <img class="img-fluid" src="img/carousel-2.jpg" alt="Image">
                            <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                                <div class="p-3" style="max-width: 700px;">
                                    <h4 class="text-light text-uppercase font-weight-medium mb-3">6 / 15 ~ 7 / 20 瘋狂購物節
                                        !</h4>
                                    <h3 class="display-4 text-white font-weight-semi-bold mb-4">全館 1000 NTD 免運</h3>
                                    <a href="all.php" class="btn btn-light py-2 px-3">開始購物</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#header-carousel" data-slide="prev">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-prev-icon mb-n2"></span>
                        </div>
                    </a>
                    <a class="carousel-control-next" href="#header-carousel" data-slide="next">
                        <div class="btn btn-dark" style="width: 45px; height: 45px;">
                            <span class="carousel-control-next-icon mb-n2"></span>
                        </div>
                    </a>
                </div>
                <!-- 資訊輪播 end -->
            </div>
        </div>
    </div>
    <!-- Navbar Start end-->

    <!-- Featured Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-check text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;品 質 保 證</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-shipping-fast text-primary m-0 mr-2"></h1>
                    <h5 class="font-weight-semi-bold m-0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;快 速 到 貨</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fas fa-exchange-alt text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">&nbsp;&nbsp;&nbsp;七 天 鑑 賞 期</h5>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                <div class="d-flex align-items-center border mb-4" style="padding: 30px;">
                    <h1 class="fa fa-phone-volume text-primary m-0 mr-3"></h1>
                    <h5 class="font-weight-semi-bold m-0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;在 線 客 服</h5>
                </div>
            </div>
        </div>
    </div>
    <!-- Featured End -->


    <!-- Categories Start --> <!-- 各商品種類之數量功能已新增 -->

    <div class="container-fluid pt-5">
        <div class="row px-xl-5 pb-3">
            <!-- 上衣 -->
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <?php
                    echo '<p class="text-right">' . $tops . ' Products</p>';

                    echo '<a href="all.php?category_choice=' . urlencode("上衣") . '" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/category-1.jpg" alt="">
                    </a>';
                    // <a href="all.php?category_choice=' . urlencode("上衣") . '" class="nav-item nav-link">上衣 TOPS</a> 
                    // <h5 class="font-weight-semi-bold m-0">上衣 TOPS</h5> 
                    echo '<a href="all.php?category_choice=' . urlencode("上衣") . '" class="nav-item nav-link">
                    <h5 class="font-weight-semi-bold m-0">上衣 TOPS</h5></a>';
                    ?>

                </div>
            </div>
            <!-- /////////////////////////////////////////////////////////////////////////// -->
            <!-- 長褲 -->
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <?php
                    echo '<p class="text-right">' . $pants . ' Products</p>';

                    echo '<a href="all.php?category_choice=' . urlencode("長褲") . '" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/category-2.jpg" alt="">
                    </a>';
                    echo '<a href="all.php?category_choice=' . urlencode("長褲") . '" class="nav-item nav-link">
                    <h5 class="font-weight-semi-bold m-0">長褲 PANTS</h5></a>';
                    ?>

                    <!-- <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/cat-2.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">長褲 PANTS</h5> -->
                </div>
            </div>
            <!-- /////////////////////////////////////////////////////////////////////////// -->
            <!-- 短褲 -->
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <?php
                    echo '<p class="text-right">' . $shorts . ' Products</p>';

                    echo '<a href="all.php?category_choice=' . urlencode("短褲") . '" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/category-3.jpg" alt="">
                    </a>';
                    echo '<a href="all.php?category_choice=' . urlencode("短褲") . '" class="nav-item nav-link">
                    <h5 class="font-weight-semi-bold m-0">短褲 SHORTS</h5></a>';
                    ?>
                    <!-- <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/cat-3.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">短褲 SHORTS</h5> -->
                </div>
            </div>
            <!-- /////////////////////////////////////////////////////////////////////////// -->
            <!-- 裙裝 -->
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <?php
                    echo '<p class="text-right">' . $skirt . ' Products</p>';

                    echo '<a href="all.php?category_choice=' . urlencode("裙裝") . '" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/category-4.jpg" alt="">
                    </a>';
                    echo '<a href="all.php?category_choice=' . urlencode("裙裝") . '" class="nav-item nav-link">
                    <h5 class="font-weight-semi-bold m-0">裙裝 SKIRTS</h5></a>';
                    ?>
                    <!-- <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/cat-4.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">裙裝 SKIRTS</h5> -->
                </div>
            </div>
            <!-- /////////////////////////////////////////////////////////////////////////// -->
            <!-- 連身 -->
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <?php
                    echo '<p class="text-right">' . $jumpsuits . ' Products</p>';

                    echo '<a href="all.php?category_choice=' . urlencode("連身") . '" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/category-5.jpg" alt="">
                    </a>';
                    echo '<a href="all.php?category_choice=' . urlencode("連身") . '" class="nav-item nav-link">
                    <h5 class="font-weight-semi-bold m-0">連身 JUMPSUITS</h5></a>';
                    ?>
                    <!-- <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/cat-5.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">連身 JUMPSUITS</h5> -->
                </div>
            </div>
            <!-- /////////////////////////////////////////////////////////////////////////// -->
            <!-- 外套 -->
            <div class="col-lg-4 col-md-6 pb-1">
                <div class="cat-item d-flex flex-column border mb-4" style="padding: 30px;">
                    <?php
                    echo '<p class="text-right">' . $jackets . ' Products</p>';

                    echo '<a href="all.php?category_choice=' . urlencode("外套") . '" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/category-6.jpg" alt="">
                    </a>';
                    echo '<a href="all.php?category_choice=' . urlencode("外套") . '" class="nav-item nav-link">
                    <h5 class="font-weight-semi-bold m-0">外套 Jackets</h5></a>';
                    ?>
                    <!-- <a href="" class="cat-img position-relative overflow-hidden mb-3">
                        <img class="img-fluid" src="img/cat-6.jpg" alt="">
                    </a>
                    <h5 class="font-weight-semi-bold m-0">鞋子 Shoes</h5> -->
                </div>
            </div>
        </div>
    </div>
    <!-- Categories End -->

    <!-- 熱銷商品 -->
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">熱銷商品</span></h2>
    </div>
    <?php
    //用來設定單個商品的”查看細節”&”加入購物車” 要顯示甚麼文字
    //這樣比較好全部一起做更動
    $View_Detail = "細節"; //查看細節
    $Add_To_Cart = "加入"; //加入購物車
    // 执行查询//
    $sql = "SELECT * FROM product_sales JOIN product ON product_sales.product_id = product.product_id
    GROUP BY product.product_id
    ORDER BY SUM(product_sales.num) DESC LIMIT 4";
    $result = mysqli_query($link, $sql);

    //利用迴圈歷遍來顯示商品
    // 处理结果集
    
    echo '<div class="row">';
    if (mysqli_num_rows($result) > 0) {
        // 遍历结果集
        while ($row = mysqli_fetch_assoc($result)) {
            // $imagePath = $row['photo_path'];
            $price = $row['price'];
            $name = $row['product_name'];
            $productID = $row['product_id'];
            $quality = $row['quality'];

            // 在网站上显示商品信息
            echo '<div class="col-lg-3 col-md-6 col-sm-12 pb-1">';
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
        }
    } else {
        echo "沒有找到商品信息";
    }
    echo '</div>';
    ?>
    <!-- 熱銷商品 End -->

    <!-- 最新上架 -->
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">最新上架</span></h2>
    </div>
    <?php
    //用來設定單個商品的”查看細節”&”加入購物車” 要顯示甚麼文字
    //這樣比較好全部一起做更動
    $View_Detail = "細節"; //查看細節
    $Add_To_Cart = "加入"; //加入購物車
    // 执行查询//
    $sql = "SELECT * FROM product ORDER BY product_date DESC LIMIT 4";
    $result = mysqli_query($link, $sql);

    //利用迴圈歷遍來顯示商品
    // 处理结果集
    
    echo '<div class="row">';
    if (mysqli_num_rows($result) > 0) {
        // 遍历结果集
        while ($row = mysqli_fetch_assoc($result)) {
            // $imagePath = $row['photo_path'];
            $price = $row['price'];
            $name = $row['product_name'];
            $productID = $row['product_id'];
            $quality = $row['quality'];

            // 在网站上显示商品信息
            echo '<div class="col-lg-3 col-md-6 col-sm-12 pb-1">';
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
        }
    } else {
        echo "沒有找到商品信息";
    }
    echo '</div>';
    ?>
    <!-- 最新上架 end-->


    <!-- Subscribe Start -->
    <!-- <div class="container-fluid bg-secondary my-5">
        <div class="row justify-content-md-center py-5 px-xl-5">
            <div class="col-md-6 col-12 py-5">
                <div class="text-center mb-2 pb-2">
                    <h2 class="section-title px-5 mb-3"><span class="bg-secondary px-2">Stay Updated</span></h2>
                    <p>Amet lorem at rebum amet dolores. Elitr lorem dolor sed amet diam labore at justo ipsum eirmod duo labore labore.</p>
                </div>
                <form action="">
                    <div class="input-group">
                        <input type="text" class="form-control border-white p-4" placeholder="Email Goes Here">
                        <div class="input-group-append">
                            <button class="btn btn-primary px-4">Subscribe</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> -->
    <!-- Subscribe End -->

    <!-- Vendor Start -->
    <div class="container-fluid py-5">
        <div class="row px-xl-5">
            <div class="col">
                <div class="owl-carousel vendor-carousel">
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-1.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-2.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-3.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-4.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-5.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-6.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-7.jpg" alt="">
                    </div>
                    <div class="vendor-item border p-4">
                        <img src="img/vendor-8.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Vendor End -->


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