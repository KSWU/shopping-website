<!-- 搜尋結果 -->
<html lang="en">
<?php
session_start();
// 在這裡繼續處理添加商品到購物車的程式碼

$link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
<<<<<<< HEAD
  or die("無法開啟MySQL資料庫連結!<br>");
=======
    or die("無法開啟MySQL資料庫連結!<br>");
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");


$search = "";
if (isset($_POST['search'])) {
<<<<<<< HEAD
  // 獲取 category 參數的值
  $search = $_POST['search'];

  // 在此處根據 category 的值進行相應的處理
  // 例如，顯示相關商品、執行相應的查詢、根據 category 加載不同的內容等等

  // 這裡僅簡單地輸出 category 的值作為示例
  // echo "您選擇的商品類別是：" . $category;
} else {
  // 如果未傳遞 category 參數，顯示相應的預設內容
  // echo "請選擇一個商品類別";
=======
    // 獲取 category 參數的值
    $search = $_POST['search'];

    // 在此處根據 category 的值進行相應的處理
    // 例如，顯示相關商品、執行相應的查詢、根據 category 加載不同的內容等等

    // 這裡僅簡單地輸出 category 的值作為示例
    // echo "您選擇的商品類別是：" . $category;
} else {
    // 如果未傳遞 category 參數，顯示相應的預設內容
    // echo "請選擇一個商品類別";
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26
}


//加入購物車 => 先驗證登入 => 有登入再加到購物車 /  沒登入就先導到登入葉面
if (isset($_POST["add_to_cart"])) { //如果按了"加入購物車"按鈕
<<<<<<< HEAD
  if (!isset($_SESSION["member_id"])) { //沒登入就先導到登入頁面
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
=======
    if (!isset($_SESSION["member_id"])) { //沒登入就先導到登入頁面
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
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26
}
//------------------------------------------------------------------------------------------
//分頁

// 取得總商品數量的查詢
<<<<<<< HEAD
if ($search != "") {
  $count_query = "SELECT COUNT(*) AS total FROM product WHERE product_name LIKE '%" . $search . "%'";
} else {
  header('Location: all.php');
=======
if($search!="")
{
    $count_query = "SELECT COUNT(*) AS total FROM product WHERE product_name LIKE '%".$search."%'";
}
else{
    header('Location: all.php');
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26
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
?>

<head>
<<<<<<< HEAD
  <meta charset="utf-8">
  <title>搜尋結果</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

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
  <div class="container-fluid pt-5">
    <div class="row px-xl-5">

      <!--//////////////////////////////////// Shop Product Start /////////////////////////////-->
      <div class="col-lg-12 col-md-12">
        <div class="row pb-3">
          <!-- <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Search by name">
=======
    <meta charset="utf-8">
    <title>搜尋結果</title>
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
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <!-- Shop Sidebar Start -->
            <div class="col-lg-3 col-md-12">
                <!-- //////////////////////// Price Start ////////////////////////////////////////-->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">依價格搜尋</h5>
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked="" id="price-all">
                            <label class="custom-control-label" for="price-all">All Price</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-1">
                            <label class="custom-control-label" for="price-1">$0 - $100</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-2">
                            <label class="custom-control-label" for="price-2">$100 - $200</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-3">
                            <label class="custom-control-label" for="price-3">$200 - $300</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="price-4">
                            <label class="custom-control-label" for="price-4">$300 - $400</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="price-5">
                            <label class="custom-control-label" for="price-5">$400 - $500</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!--////////////////////////////// Price End ////////////////////////////////////////////-->

                <!-- ///////////////////////////// Color Start //////////////////////////////////////////-->
                <div class="border-bottom mb-4 pb-4">
                    <h5 class="font-weight-semi-bold mb-4">Filter by color</h5>
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked="" id="color-all">
                            <label class="custom-control-label" for="price-all">All Color</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-1">
                            <label class="custom-control-label" for="color-1">Black</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-2">
                            <label class="custom-control-label" for="color-2">White</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-3">
                            <label class="custom-control-label" for="color-3">Red</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="color-4">
                            <label class="custom-control-label" for="color-4">Blue</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="color-5">
                            <label class="custom-control-label" for="color-5">Green</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!--//////////////////////////////////// Color End ////////////////////////////////////-->

                <!--/////////////////////////////////// Size Start ////////////////////////////////////-->
                <div class="mb-5">
                    <h5 class="font-weight-semi-bold mb-4">Filter by size</h5>
                    <form>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" checked="" id="size-all">
                            <label class="custom-control-label" for="size-all">All Size</label>
                            <span class="badge border font-weight-normal">1000</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-1">
                            <label class="custom-control-label" for="size-1">XS</label>
                            <span class="badge border font-weight-normal">150</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-2">
                            <label class="custom-control-label" for="size-2">S</label>
                            <span class="badge border font-weight-normal">295</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-3">
                            <label class="custom-control-label" for="size-3">M</label>
                            <span class="badge border font-weight-normal">246</span>
                        </div>
                        <div
                            class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                            <input type="checkbox" class="custom-control-input" id="size-4">
                            <label class="custom-control-label" for="size-4">L</label>
                            <span class="badge border font-weight-normal">145</span>
                        </div>
                        <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                            <input type="checkbox" class="custom-control-input" id="size-5">
                            <label class="custom-control-label" for="size-5">XL</label>
                            <span class="badge border font-weight-normal">168</span>
                        </div>
                    </form>
                </div>
                <!--////////////////////////////////// Size End ////////////////////////////////-->
            </div>
            <!--///////////////////////////////////// Shop Sidebar End /////////////////////////////-->


            <!--//////////////////////////////////// Shop Product Start /////////////////////////////-->
            <div class="col-lg-9 col-md-12">
                <div class="row pb-3">
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="">
                                <div class="input-group">
                                    <!-- <input type="text" class="form-control" placeholder="Search by name">
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26
                                    <div class="input-group-append">
                                        <span class="input-group-text bg-transparent text-primary">
                                            <i class="fa fa-search"></i>
                                        </span>
<<<<<<< HEAD
                                    </div>
=======
                                    </div> -->
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26
                                </div>
                            </form>
                            <div class="dropdown ml-4">
                                <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Sort by
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                    <a class="dropdown-item" href="#">Latest</a>
                                    <a class="dropdown-item" href="#">Popularity</a>
                                    <a class="dropdown-item" href="#">Best Rating</a>
                                </div>
                            </div>
                        </div>
<<<<<<< HEAD
                    </div> -->
          <!-- /////////////////////////////////////////////////////////////////// -->
          <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 單個商品排版 !!!!!!!!!!!!!!!!!!!!!!!!!!!-->
          <?php
          //用來設定單個商品的”查看細節”&”加入購物車” 要顯示甚麼文字
          //這樣比較好全部一起做更動
          $View_Detail = "細節"; //查看細節
          $Add_To_Cart = "加入"; //加入購物車


          // 查詢要顯示的商品類別($search)
          // 编写查询语句
          // $sql = "SELECT photo_path, price,product_name,product_id FROM product where category='.$search.'";
          // 分頁顯示商品的查詢
          // $sql = "SELECT * FROM product WHERE category = '" . $search . "' LIMIT " . $products_per_page . " OFFSET " . $offset;

          // $sql = "SELECT  * FROM product WHERE category = '" . $search . "'";
          $sql = "SELECT * FROM product WHERE product_name LIKE '%" . $search . "%' LIMIT " . $products_per_page . " OFFSET " . $offset;

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

          if ($search != "全部") {
            // 顯示上一頁連結
            if ($current_page > 1) {
              echo '<li class="page-item">';
              echo '<a class="page-link" href="all.php?category=' . urlencode($search) . '&page=1" aria-label="Previous">';
              echo '<span aria-hidden="true">«</span>';
              echo '<span class="sr-only">Previous</span>';
              echo '</a>';
              echo '</li>';
            }

            // 顯示分頁連結
            for ($page = 1; $page <= $total_pages; $page++) {
              echo '<li class="page-item' . ($page == $current_page ? ' active' : '') . '">';
              echo '<a class="page-link" href="all.php?category=' . urlencode($search) . '&page=' . $page . '">' . $page . '</a>';
              echo '</li>';
            }

            // 顯示下一頁連結
            if ($current_page < $total_pages) {
              echo '<li class="page-item">';
              echo '<a class="page-link" href="all.php?category=' . urlencode($search) . '&page=' . $total_pages . '" aria-label="Next">';
              echo '<span aria-hidden="true">»</span>';
              echo '<span class="sr-only">Next</span>';
              echo '</a>';
              echo '</li>';
            }
          } else {
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
=======
                    </div>
                    <!-- /////////////////////////////////////////////////////////////////// -->
                    <!-- !!!!!!!!!!!!!!!!!!!!!!!!!!!!!! 單個商品排版 !!!!!!!!!!!!!!!!!!!!!!!!!!!-->
                    <?php
                    //用來設定單個商品的”查看細節”&”加入購物車” 要顯示甚麼文字
                    //這樣比較好全部一起做更動
                    $View_Detail = "細節"; //查看細節
                    $Add_To_Cart = "加入"; //加入購物車
                    

                    // 查詢要顯示的商品類別($search)
                    // 编写查询语句
                    // $sql = "SELECT photo_path, price,product_name,product_id FROM product where category='.$search.'";
                    // 分頁顯示商品的查詢
                    // $sql = "SELECT * FROM product WHERE category = '" . $search . "' LIMIT " . $products_per_page . " OFFSET " . $offset;
                    
                    // $sql = "SELECT  * FROM product WHERE category = '" . $search . "'";
                    $sql = "SELECT * FROM product WHERE product_name LIKE '%" . $search . "%' LIMIT " . $products_per_page . " OFFSET " . $offset;

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
                            echo '<h6>$' . $price . '</h6><h6 class="text-muted ml-2"><del>$' . $price . '</del></h6>';
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

                    if ($search != "全部") {
                        // 顯示上一頁連結
                        if ($current_page > 1) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="all.php?category=' . urlencode($search) . '&page=1" aria-label="Previous">';
                            echo '<span aria-hidden="true">«</span>';
                            echo '<span class="sr-only">Previous</span>';
                            echo '</a>';
                            echo '</li>';
                        }

                        // 顯示分頁連結
                        for ($page = 1; $page <= $total_pages; $page++) {
                            echo '<li class="page-item' . ($page == $current_page ? ' active' : '') . '">';
                            echo '<a class="page-link" href="all.php?category=' . urlencode($search) . '&page=' . $page . '">' . $page . '</a>';
                            echo '</li>';
                        }

                        // 顯示下一頁連結
                        if ($current_page < $total_pages) {
                            echo '<li class="page-item">';
                            echo '<a class="page-link" href="all.php?category=' . urlencode($search) . '&page=' . $total_pages . '" aria-label="Next">';
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
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26


</body>

</html>