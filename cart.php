<!DOCTYPE html>
<html lang="en">
<!-- 哈哈 -->
<!-- 哈哈哈 -->
<!-- 哈哈哈 -->
<!-- 哈哈哈哈 -->
<!-- 哈哈哈哈哈 -->
<!-- 哈哈哈哈哈哈 -->
<!-- 哈哈哈哈哈哈哈 -->
<!-- 哈哈哈哈哈哈哈哈 -->
<!-- 哈哈哈哈哈哈哈哈哈 -->
<!-- 哈哈哈哈哈哈哈哈哈哈 --> <!-- total也用sessiob來存 -->
<!-- 哈哈哈哈哈哈哈哈哈哈哈 --> <!-- total2 -->
<!-- 哈哈哈哈哈哈哈哈哈哈哈哈 --> <!-- "-"的按鍵 -->
<!-- 哈哈哈哈哈哈哈哈哈哈哈哈哈 --> <!-- 移除商品的按鍵 -->
<?php
session_start();
//------------------------------------------------------------------------------------------

//登入驗證
if (!isset($_SESSION['member_id'])) {
    $msg = "請先登入！";
    echo "<script>if(confirm('$msg')){window.location.href='login.php';}</script>";
    exit;
}

//------------------------------------------------------------------------------------------

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

//------------------------------------------------------------------------------------------

$link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
    or die("無法開啟MySQL資料庫連結!<br>");

// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

//------------------------------------------------------------------------------------------

//移除商品
if (isset($_GET["action"])) {
    if ($_GET["action"] == "delete" && isset($_GET["id"])) {
        $item_id = $_GET["id"];
        //$item_price = $_GET["price"];
        $sql = "SELECT * FROM product WHERE product_id = $item_id";
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
            
        } else {
            echo "沒有找到該商品的資訊.";
        }
        foreach ($_SESSION["shopping_cart"] as $key => $value) {
            if ($value["item_id"] == $item_id) {
                $_SESSION['total'][0] = $_SESSION['total'][0] - $_SESSION["quality"][$item_id] * $price; // 商品金額減少

                if($_SESSION['total'][0]>=1000 || $_SESSION['total'][0]==0) //判斷需不需要有運費
                    $_SESSION['total'][1] = $_SESSION['total'][1]+0;
                else
                    $_SESSION['total'][1] = $_SESSION['total'][1]+60;

                $_SESSION["quality"][$item_id] = 0; //把儲存商品數量的那格清0
                unset($_SESSION["shopping_cart"][$key]); //刪除購物車的內容
                break;
            }
        }

        // 重新導向回購物車頁面
        header('Location: cart.php');
        exit();
    }
}

//------------------------------------------------------------------------------------------

?>

<head>
    <meta charset="utf-8">
    <title>購物車 Cart</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

    <script src="//code.jquery.com/jquery-3.3.1.js"></script>

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

    <script type="text/javascript">
        // Function
        // Function
        var num_array = [];

        //新增商品數量的function
        function modify_add(item_id, item_quality, item_price, item_name, mode) {
            $.ajax({
                // Action
                url: 'function.php',
                // Method
                type: 'POST',
                data: {
                    // Get value
                    id: item_id,
                    quality: item_quality,
                    price: item_price,
                    name: item_name,
                    mode: mode,
                    action: "append"
                },
                success: function (response) { //傳回商品id
                    // Response is the output of action file
                    if (response != 0) {
                        // 修改購物車中該項目的數量
                        var newQuantity = parseInt(item_quality) + 1;
                        // alert("更新成功 item_quality=" + item_quality);
                        updateCartItemQuantity(item_id, newQuantity, item_price, mode); //傳送進去的newQuantity是已經更新後的數量
                        // add1(item_id, item_quality);
                    } else if (response == 0) {
                        // alert("修改失敗");
                    }
                }
            });
        }
        // 更新購物車項目數量的金額
        function updateCartItemQuantity(item_id, newQuantity, item_price, mode) {
            $.ajax({
                // Action
                url: 'function.php',
                // Method
                type: 'POST',
                data: {
                    // Get value
                    id: item_id,
                    quantity: newQuantity, //傳送進來的newQuantity是已經更新後的數量
                    mode: mode,
                    action: "update"
                },
                success: function (response) { //傳回更新後的商品數量($_SESSION["quality"][$item_id])
                    if (response != 0) {
                        // 更新成功，執行相應的處理
                        var quality = response; //更新後的商品數量($_SESSION["quality"][$item_id])
                        var totalPrice = item_price * quality;
                        document.getElementById("money_single[" + item_id + "]").textContent = totalPrice;
                        display_money_toal1(item_id, quality, item_price, mode);
                        // alert("更新成功 newQuantity=" + quality);
                    } else {
                        // alert("更新失敗");
                    }
                }
            });
        }
        //顯示右手邊商品金額
        function display_money_toal1(item_id, item_quality, item_price, mode) {
            $.ajax({
                // Action
                url: 'function.php',
                // Method
                type: 'POST',
                data: {
                    // Get value
                    id: item_id,
                    quality: item_quality,
                    price: item_price,
                    mode: mode,
                    action: "display_money_total1_ajax"
                },
                success: function (response) { //傳回商品金額
                    // Response is the output of update_cart_item_quantity.php file
                    // 更新成功，執行相應的處理

                    var add_price = parseInt(response);
                    document.getElementById("total1").textContent = "$" + add_price;
                    display_money_toal2();
                    if(response<1000 && response>0)
                        display_freight();
                    // alert("$_SESSION['total'][0]=" + response);
                    // if (response != 0) {

                    //     var quality = response;
                    //     var totalPrice = item_price * quality;
                    //     document.getElementById("money_single[" + item_id + "]").textContent = totalPrice;
                    //     alert("更新成功 newQuantity=" + quality);
                    // } else {
                    //     alert("更新失敗");
                    // }
                }
            });
        }
        //顯示右手邊總金額
        function display_money_toal2() {
            $.ajax({
                // Action
                url: 'function.php',
                // Method
                type: 'POST',
                data: {
                    // Get value
                    action: "display_money_total2_ajax"
                },
                success: function (response) { //回傳總金額
                    var add_price = parseInt(response);
                    document.getElementById("total2").textContent = "$" + add_price;
                    alert("已更改購物車內容!");
                }
            });
        }

        //更改運費 0 => 60
        function display_freight(){
            $.ajax({
                // Action
                url: 'function.php',
                // Method
                type: 'POST',
                data: {
                    // Get value
                    action: "display_freight_ajax"
                },
                success: function (response) { //回傳60
                    var freight = parseInt(response);
                    document.getElementById("freight").textContent = "$" + freight;
                    // alert("運費=" + response);
                }
            });
        }

        function modify_sub(item_id, item_quality, item_price, item_name, mode) {
            $.ajax({
                // Action
                url: 'function.php',
                // Method
                type: 'POST',
                data: {
                    // Get value
                    id: item_id,
                    quality: item_quality,
                    price: item_price,
                    name: item_name,
                    mode: mode,
                    action: "sub"
                },
                success: function (response) {
                    // Response is the output of action file
                    if (response != 0) {
                        // 修改購物車中該項目的數量
                        var newQuantity = parseInt(item_quality) - 1;
                        // alert("更新成功 item_quality=" + item_quality);
                        updateCartItemQuantity(item_id, newQuantity, item_price, mode);
                        // add1(item_id, item_quality);
                    } else if (response == 0) {
                        // alert("修改失敗");
                    }
                }
            });
        }
    </script>
    <!-- header -->
    <div class="header"></div>
    <!-- header end -->

    <!-- Cart Start -->
    <div class="container-fluid pt-5">
        <div class="row px-xl-5">
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered text-center mb-0">
                    <thead class="bg-secondary text-dark">
                        <tr>
                            <th>商品</th>
                            <th>單價</th>
                            <th>數量</th>
                            <th>金額</th>
                            <th>刪除</th>
                        </tr>
                    </thead>
                    <?php

                    // 檢查是否存在購物車的會話變數
                    echo '<tbody class="align-middle">';
                    $total = 0;
                    if (isset($_SESSION["shopping_cart"]) && !empty($_SESSION["shopping_cart"])) {
                        foreach ($_SESSION["shopping_cart"] as $key => $value) {
                            echo '<tr>';
                            echo '<td class="align-middle"><img src="img/' . $value["item_id"] . '.jpg" alt="" style="width: 50px;"> ' . $value["item_name"] . '</td>';
                            echo '<td class="align-middle">' . $value["item_price"] . '</td>';
                            echo '<td class="align-middle">';
                            echo '<div class="input-group quantity mx-auto" style="width: 100px;">';
                            echo '<div class="input-group-btn">';
                            $mode = 0; //-
                            echo '<button class="btn btn-sm btn-primary btn-minus" onclick="modify_sub(' . $value["item_id"] . ', ' . $value["item_quality"] . ', ' . $value["item_price"] . ', \'' . $value["item_name"] . '\', \'' . $mode . '\')";>';
                            echo '<i class="fa fa-minus"></i>';
                            echo '</button>';
                            echo '</div>';
                            echo '<input type="text" class="form-control form-control-sm bg-secondary text-center" value="' . $value["item_quality"] . '">';
                            echo '<div class="input-group-btn">';
                            // echo '<button class="btn btn-sm btn-primary btn-plus" onclick = "modify(' . $value["item_id"] . ','.$value["item_quality"].','.$value["item_price"].','.$value["item_name"].');">';
                            $mode = 1; //+
                            echo '<button class="btn btn-sm btn-primary btn-plus" onclick="modify_add(' . $value["item_id"] . ', ' . $value["item_quality"] . ', ' . $value["item_price"] . ', \'' . $value["item_name"] . '\', \'' . $mode . '\');"
                            >';
                            echo '<i class="fa fa-plus"></i>';
                            echo '</button>';
                            echo '</div>';
                            echo '</div>';
                            echo '</td>';
                            echo '<td class="align-middle" id=money_single[' . $value["item_id"] . ']>' . $value["item_price"] * $value["item_quality"] . '</td>';

                            //移除按鈕
                            echo '<td class="align-middle">
                                <form method="post" action="cart.php?action=delete&id=' . $value["item_id"] . '">
                                    <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-times"></i></button>
                                </form>
                            </td>';

                            // echo '<td class="align-middle"><button class="btn btn-sm btn-primary"><i class="fa fa-times"></i></button></td>';
                            echo '</tr>';
                            $_SESSION['quality'][$value["item_id"]] = $value["item_quality"];
                            // $total 是商品總金額
                            // $total = $total + ($value["item_quality"] * $value["item_price"]);
                            //$_SESSION['total'][0] += ($value["item_quality"] * $value["item_price"]);
                    
                        }
                        $tem=0;
                        foreach ($_SESSION["shopping_cart"] as $key => $value) {
                            // $_SESSION['total'][0] += ($value["item_quality"] * $value["item_price"]);
                            $tem += ($value["item_quality"] * $value["item_price"]);
                        } 
                        $_SESSION['total'][0] = $tem;

                        // if ($_SESSION['total'][0] == 0) {
                        //     foreach ($_SESSION["shopping_cart"] as $key => $value) {
                        //         $_SESSION['total'][0] += ($value["item_quality"] * $value["item_price"]);
                        //     }
                        // }

                        echo '</tbody>';
                    } else {

                        echo '<tr><td colspan="5">購物車是空的</td></tr>';
                    }

                    ?>
                    <tbody class="align-middle">

                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="優惠卷代碼">
                        <div class="input-group-append">
                            <button class="btn btn-primary">使用優惠卷</button>
                        </div>
                    </div>
                </form>
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">購物車內容</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">商品金額</h6>
                            <h6 class="font-weight-medium" id="total1">$
                                <?php echo number_format($_SESSION['total'][0], 0); ?>
                            </h6>
                            <!-- <td align="right">$ <?php echo number_format($total, 2); ?></td>   -->
                        </div>


                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">運費</h6>
                            <?php
                            $shipping_fee = 60; // 預設運費為 $60
                            


                            // 檢查購物車總金額是否大於等於 $1000
                            

                            // 根據條件設定運費
                            if (($_SESSION['total'][0] >= 1000) || ($_SESSION['total'][0] == 0)) {
                                $shipping_fee = 0; // 運費為 $0
                            }

                            echo '<h6 class="font-weight-medium" id=freight >$' . $shipping_fee . '</h6>';
                            ?>
                        </div>

                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">總金額</h5>
                            <?php // $total_fee 是總金額 = 商品金額 + 運費
                            // $total_fee = $total + $shipping_fee;
                            $_SESSION['total'][1] = $_SESSION['total'][0] + $shipping_fee;
                            echo '<h5 class="font-weight-bold" id=total2 >$' . $_SESSION['total'][1] . '</h5>';
                            ?>

                        </div>
                        <!-- <button class="btn btn-block btn-primary my-3 py-3"> 結帳</button> -->
                        <input type="button" class="btn btn-block btn-primary my-3 py-3"
                            onclick="location.href='checkout.php';" value="結帳" />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Cart End -->

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