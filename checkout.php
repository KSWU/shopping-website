<!DOCTYPE html>
<html lang="en">
<!-- 哈哈 -->
<!-- 哈哈哈 --> <!-- 訂單細節ok，要來送出資料了 -->
<!-- 哈哈哈哈 -->
<!-- 哈哈哈哈哈 -->
<!-- 哈哈哈哈哈哈 -->
<?php
session_start();
// 確認購物車是否已經存在，如果不存在則建立一個新的空陣列
if (!isset($_SESSION['shopping_cart'])) {
    $_SESSION['shopping_cart'] = array();
}
// 確認購物車的quality是否已經存在，如果不存在則建立一個新的空陣列
if (!isset($_SESSION['quality'])) {
    $_SESSION['quality'] = array();
}
// 確認購物車的total是否已經存在，如果不存在則建立一個新的空陣列
if (!isset($_SESSION['total'])) {
    // $_SESSION['total'] = array();
    // $_SESSION['total'][0] = 0;
    // $_SESSION['total'][1] = 0;
    $_SESSION['total'] = array(); // 使用简洁的数组初始化语法
    $_SESSION['total'][0] = 0;
    $_SESSION['total'][1] = 0;
    //[0]为商品金额
    //[1]为总金额(=商品金额+运费)

    //[0]為商品金額
    //[1]為總金額(=商品金額+運費)
}

//送出訂單
if (isset($_POST["action"])) {
    if ($_POST["action"] == "pay") {
        $recipientName = $_POST['recipient_name']; //收件人名字
        $recipientAddr = $_POST['recipient_addr']; //收件人地址
        $recipientPhone = $_POST['recipient_phone']; //收件人手機
        $payment = $_POST['payment']; //付款方式
        $total_consumption = $_SESSION["total"][1]; //總金額
        $order_date = date("Y-m-d H:i:s"); //下單時間
        $member_id = $_SESSION["member_id"]; //member_id
        $order_state = "待確認";

        $link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
            or die("無法開啟MySQL資料庫連結!<br>");

        // 送出編碼的MySQL指令
        mysqli_query($link, 'SET CHARACTER SET utf8');
        mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

        // 新增資料到order_manage
        // 構建 SQL 插入語句
        $sql = "INSERT INTO order_manage (member_id, order_date, payment_methon, total_consumption, recipient, recipient_phone, shipping_addr, order_state) VALUES ('$member_id', '$order_date', '$payment','$total_consumption','$recipientName','$recipientPhone','$recipientAddr','$order_state')";

        // 執行 SQL 查詢
        if (mysqli_query($link, $sql)) {
            // 取得最後插入的記錄的主鍵值
            $order_id = mysqli_insert_id($link);
            echo "成功新增一筆資料到資料庫";
        } else {
            echo "新增資料失敗：" . mysqli_error($link);
        }

        // 假設資料庫連線已經建立，並存在 $link 變數中

        // 新增資料到 product_sales
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            // 取得商品相關資料
            $item_id = $value["item_id"];
            //$item_price = $value["item_price"];
            $item_quality = $value["item_quality"];

            // 構建 SQL 插入語句
            $sql = "INSERT INTO product_sales (order_id,product_id,num) VALUES ('$order_id','$item_id','$item_quality')";

            // 執行 SQL 查詢
            if (mysqli_query($link, $sql)) {
                echo "成功新增一筆資料到資料庫";
            } else {
                echo "新增資料失敗：" . mysqli_error($link);
            }
        }





        unset($_SESSION["shopping_cart"]);
        unset($_SESSION["total"]);
        unset($_SESSION["quality"]);



        // 重新導向回購物車頁面
        header('Location: cart.php');
        exit();
    }
}

?>

<head>
    <meta charset="utf-8">
    <title>結帳 Check out</title>
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
    <!-- header -->
    <div class="header"></div>
    <!-- header end -->

    <!-- Checkout Start -->
    <?php
    echo '
    <form method="post" action="checkout.php?action=pay">
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8">
                <div class="mb-4">
                    <h4 class="font-weight-semi-bold mb-4">填寫資料</h4>
                    <div class="row">
                        <div class="col-md-6 form-group">
                            <label>收件人姓名</label>
                            <input class="form-control" name="recipient_name" type="text" placeholder="陳○○">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>收件地址</label>
                            <input class="form-control" name="recipient_addr" type="text" placeholder="彰化市寶山路1號">
                        </div>
                        <div class="col-md-6 form-group">
                            <label>收件人手機</label>
                            <input class="form-control" name="recipient_phone" type="text" placeholder="09 456 789">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">訂單細節</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">商品</h5>
                        ';
    if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            echo '
                        <div class="d-flex justify-content-between">
                            <p>' . $value["item_name"] . '</p>
                            <p>$' . $value["item_price"] * $value["item_quality"] . '</p>
                        </div>';
        }
        echo '
                                            </tbody>';
    } else {
        echo '
                        <tr><td colspan="5">購物車是空的</td></tr>';
    }
    echo '
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">商品金額</h6>
                            <h6 class="font-weight-medium">$' . $_SESSION["total"][0] . '</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">運費</h6>';
    if ($_SESSION["total"][0] >= 1000 || $_SESSION["total"][0] == 0) {
        echo '
                                        <h6 class="font-weight-medium">$0</h6>';
    } else {
        echo '
                                        <h6 class="font-weight-medium">$60</h6>';
    }
    echo '</div>';



    echo '

                    </div>
                </div>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">付款方式</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" id="paypal"
                                    value="ATM轉帳" checked>
                                <label class="custom-control-label" for="paypal">ATM轉帳</label>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" value="線上刷卡"
                                    id="directcheck">
                                <label class="custom-control-label" for="directcheck">線上刷卡</label>
                            </div>
                        </div>
                        <div class="">
                            <div class="custom-control custom-radio">
                                <input type="radio" class="custom-control-input" name="payment" value="貨到付款"
                                    id="banktransfer">
                                <label class="custom-control-label" for="banktransfer">貨到付款</label>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                            <input type="hidden" name="action" value="pay">
                            <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">送出訂單</button>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
    </form>
    ';
    ?>

    <!-- Checkout End -->


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