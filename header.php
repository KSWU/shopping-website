<?php
session_start();

// $cartItemCount 是目前購物車有多少個品項
// if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
//     $cartItemCount = count($_SESSION["shopping_cart"]);
//     // echo "購物車中有 " . $cartItemCount . " 筆資料";
// } else {
//     echo "購物車是空的";
// }


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


?>
<!-- Topbar Start -->
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
            <a href="index.php" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span
                        class="text-primary font-weight-bold border px-3 mr-1">G</span>Monkey</h1>
            </a>
        </div>
<<<<<<< HEAD
        <!-- <div class="col-lg-6 col-6 text-left">
=======
        <div class="col-lg-6 col-6 text-left">
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26
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
<<<<<<< HEAD
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
=======
        </div>
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26
        <div class="col-lg-3 col-6 text-right">
            <!-- 購物車 -->
            <!-- <a href="" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge">0</span>
            </a> -->
            <a href="cart.php" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge">
                    <?php echo '' . $totalQuality . ''; ?>
                </span>
            </a>
        </div>
    </div>
</div>
<!-- Topbar End -->


<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100"
                data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">商品分類</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0"
                id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden" style="height: 410px">
                    <?php
                    // echo '<a href="detail.php?product_id=' . $productID . '" > $View_Detail </a>';
                    // 傳送顧客選擇的類別到 all.php 用來決定要顯示甚麼類別的商品
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
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span
                            class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
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
                    <div class="navbar-nav ml-auto py-0">
                        <!-- 登入/註冊 使用者名/登出 -->
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
        </div>
    </div>
</div>
<!-- Navbar Start end-->