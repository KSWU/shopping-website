<?php
session_start(); // 啟用會話
$conn = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
  or die("無法開啟MySQL資料庫連結!<br>");

if (isset($_POST["action"])) {
  // Choose a function depends on value of $_POST["action"]
  if ($_POST["action"] == "append") {
    append();
  } else if ($_POST["action"] == "update") {
    update();
  } else if ($_POST["action"] == "display_money_total1_ajax") {
    display_money_total1_ajax();
  } else if ($_POST["action"] == "display_money_total2_ajax") {
    display_money_total2_ajax();
  } else if ($_POST["action"] == "sub") {
    sub();
  } else if ($_POST["action"] == "display_freight_ajax") {
    display_freight_ajax();
  }
}




function append()
{
  global $conn;

  $item_id = $_POST["id"];
  $item_quality = $_POST["quality"];
  $item_price = $_POST["price"];
  $item_name = $_POST["name"];
  $zero = 0;
  $rows = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM product WHERE product_id = $item_id"));
  if (isset($_SESSION["shopping_cart"])) {
    // 在此處處理 $_SESSION["shopping_cart"] 的相關邏輯
    foreach ($_SESSION["shopping_cart"] as $key => $value) {
      if ($value["item_id"] == $item_id) {
        //$_SESSION["shopping_cart"][$key];
        $item_array = array(
          'item_id' => $item_id,
          'item_name' => $item_name,
          'item_price' => $item_price,
          'item_quality' => ($item_quality + 1)
        );
        $_SESSION["shopping_cart"][$key] = $item_array;
        //$item_array['item_quality']+=1;
        $_SESSION["quality"][$item_id] += 1;
        $_SESSION["shopping_cart"][$key]['item_quality'] = $item_quality + 1;
        break;
      }
    }
    echo $item_id;
  } else {
    // 如果 $_SESSION["shopping_cart"] 不存在，執行相應的處理邏輯
    echo $zero;
  }
}

function update() //更新購物車session內的商品數量
{
  $zero = 0;
  if (isset($_SESSION["shopping_cart"]) && isset($_POST["id"]) && isset($_POST["quantity"])) {
    $item_id = $_POST["id"];
    $new_quantity = $_POST["quantity"]; //newQuantity是已經更新後的數量


    // 在此處進行購物車項目數量的更新
    foreach ($_SESSION["shopping_cart"] as &$cart_item) {
      if ($cart_item["item_id"] == $item_id) {
        $cart_item["item_quality"] = $_SESSION["quality"][$item_id];
        //echo '<script>alert("test");</script>';

        // // 将 $_SESSION["quality"][item_id] 转换为 JavaScript 变量
        // $jsQuality = json_encode($_SESSION["quality"][$item_id]);

        break;
      }
    }

    // 確定更新是否成功，這裡假設更新總是成功的
    echo $_SESSION["quality"][$item_id];
    // echo $_SESSION["quality"];
  } else {
    // 更新失敗
    echo $zero;
  }
}

function display_money_total1_ajax()
{
  $zero = 0;
  $item_id = $_POST["id"];
  $item_quality = $_POST["quality"]; // 修改为 quality
  $item_price = $_POST["price"]; // 修改为 price
  $mode = $_POST["mode"]; // +/-
  if (isset($_SESSION["total"]) && isset($_POST["id"]) && isset($_POST["quality"])) { // 修改为 quality
    if($mode==1) //加法
      $_SESSION["total"][0] = $_SESSION["total"][0] + 1 * $item_price;
    else if($mode==0) //減法
      $_SESSION["total"][0] = $_SESSION["total"][0] - 1 * $item_price;
    // 根據條件設定運費
    if (($_SESSION["total"][0] >= 1000) || ($_SESSION["total"][0] == 0)) {
      $shopping_fee_tem = 0; // 運費為 $0
    }
    else
    {
      $shopping_fee_tem = 60;
    }
    $_SESSION["total"][1] = $shopping_fee_tem + $_SESSION["total"][0];
    echo $_SESSION["total"][0]; //傳回商品金額
  } else {
    // 如果 $_SESSION["shopping_cart"] 不存在，执行相应的处理逻辑
    echo $zero;
  }

}

function display_money_total2_ajax() //顯示總金額 還有 計算有無運費
{
  if ($_SESSION["total"][0] >= 1000 || $_SESSION["total"][0] == 0)
    $_SESSION["total"][1] = $_SESSION["total"][1] + 0;
  else
    $_SESSION["total"][1] = $_SESSION["total"][1] + 60;
  echo $_SESSION["total"][1]; //回傳總金額
}

function display_freight_ajax() //更改運費 0 => 60 
{
  $freight =60;
  echo $freight; //回傳60
}
function sub()
{
  global $conn;

  $item_id = $_POST["id"];
  $item_quality = $_POST["quality"];
  $item_price = $_POST["price"];
  $item_name = $_POST["name"];
  $zero = 0;
  if (isset($_SESSION["shopping_cart"])) {
    // 在此處處理 $_SESSION["shopping_cart"] 的相關邏輯
    foreach ($_SESSION["shopping_cart"] as $key => $value) {
      if ($value["item_id"] == $item_id) {
        //$_SESSION["shopping_cart"][$key];
        $item_array = array(
          'item_id' => $item_id,
          'item_name' => $item_name,
          'item_price' => $item_price,
          'item_quality' => ($item_quality - 1)
        );
        $_SESSION["shopping_cart"][$key] = $item_array;
        //$item_array['item_quality']+=1;
        $_SESSION["quality"][$item_id] -= 1;
        $_SESSION["shopping_cart"][$key]['item_quality'] = $item_quality - 1;
        break;
      }
    }
    echo $item_id;
  } else {
    // 如果 $_SESSION["shopping_cart"] 不存在，執行相應的處理邏輯
    echo $zero;
  }
}
?>