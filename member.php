<?php
session_start();
if (!isset($_SESSION["member_id"])) {
  $msg = "請先登入！";
  echo "<script>if(confirm('$msg')){window.location.href='login.php';}</script>";
  exit;
} else if ($_SESSION["admin"] == 'yes') {
  $msg = "您是管理員，若要進入會員中心，請先登出再重新以會員帳號登入 !";
  echo "<script>if(confirm('$msg')){window.location.href='index.php';}</script>";
  exit;
}
?>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>會員中心</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="Free HTML Templates" name="keywords">
  <meta content="Free HTML Templates" name="description">

  <!-- Favicon -->
  <link href="img/favicon.ico" rel="icon">

  <!-- Google Web Fonts -->
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

  <!-- Font Awesome -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

  <!-- Libraries Stylesheet -->
  <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

  <!-- Customized Bootstrap Stylesheet -->
  <link href="css/style.css" rel="stylesheet">
  <style>
    .button-container {
      display: flex;
      align-items: center;
      justify-content: center;

    }
    .button-spacing {
      width: 10px;
    }
    .notes {
      text-align: center;
    }
    table {
      text-align: center;
      border-radius: 10px;
    }
    th,
    td {
      text-align: center;
    }
    thead {
      background-color: #D19C97;
      color: #FFFFFF;
    }
  </style>
</head>

<body>
  <!-- header -->
  <div class="header"></div>
  <!-- header end -->

  <div class="text-center mb-4">
    <h2 class="section-title px-5"><span class="px-2">會員中心</span></h2>
  </div>

  <div class="row px-xl-5">
    <div class="col">
      <div class="nav nav-tabs justify-content-center border-secondary mb-4">
        <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">會員資料</a>
        <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">訂單管理</a>

        <?php
        require_once "config.php";

        // 查詢資料庫中的會員資料並計算總筆數
        $query = "SELECT COUNT(*) AS total FROM member";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        // 查詢資料庫中的會員資料，根據分頁顯示的起始位置和每頁顯示的資料筆數
        $memberID = $_SESSION["member_id"];
        $query = "SELECT * FROM member WHERE member_id = $memberID";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);

        $username = $row['username'];
        $member_name = $row['member_name'];
        $sex = $row['sex'];
        $birthday = $row['birthday'];
        $tel_num = $row['tel_num'];
        $addr = $row['addr'];
        $mail = $row['mail'];

        ?>
        <script>
          $(document).ready(function() {
            <?php
            echo "var username = '$username';";
            echo "var name = '$member_name';";
            echo "var sex = '$sex';";
            echo "var birthday = '$birthday';";
            echo "var telNum = '$tel_num';";
            echo "var addr = '$addr';";
            echo "var email = '$mail';";
            ?>

            $("#username").val(username);
            $("#name").val(name);
            $("#sex").val(sex);
            $("#birthday").val(birthday);
            $("#tel_num").val(telNum);
            $("#addr").val(addr);
            $("#email").val(email);
          });

          function deleteOrd(order_id) {
            $(document).ready(function() {
              if (confirm("確定要取消該訂單嗎？")) {
                $.ajax({
                  url: 'orderDelete.php',
                  type: 'POST',
                  data: {
                    order_id: order_id,
                    action: "delete3"
                  },

                  success: function(response) {
                    console.log(response);
                    if (response = 3) {
                      $('.alert').html('訂單取消成功 ! ').addClass('alert-success')
                        .show().delay(1500).fadeOut();
                      document.getElementById(order_id).style.display =
                        "none";
                    } else {
                      alert("訂單取消失敗 !");
                    }
                  }
                });
              }
            });
          }
        </script>
      </div>
      <div class="tab-content">
        <!-- 會員資料 -->
        <div class="tab-pane fade show active" id="tab-pane-1">

          <h5 class="modal-title">編輯個人資料</h5>
          <div class="modal-body">
            <form action="member/memberUpdate.php" method="post">
              <div class="form-group">
                <label for="username">帳號：</label>
                <input type="text" class="form-control" name="username" id="username">
              </div>

              <div class="form-group">
                <label for="userpwd">密碼：</label>
                <input type="password" class="form-control" name="userpwd" id="userpwd" value="00000000">
              </div>

              <div class="form-group">
                <label for="name">名稱：</label>
                <input type="text" class="form-control" name="name" id="name">
              </div>

              <div class="form-group">
                <label for="sex">性別：</label>
                <select class="form-control" name="sex" id="sex">
                  <option value="男">男</option>
                  <option value="女">女</option>
                  <option value="不透漏">不透漏</option>
                </select>
              </div>

              <div class="form-group">
                <label for="birthday">生日：</label>
                <input type="date" class="form-control" name="birthday" id="birthday">
              </div>

              <div class="form-group">
                <label for="tel_num">電話：</label>
                <input type="text" class="form-control" name="tel_num" id="tel_num">
              </div>
              <div class="form-group">
                <label for="addr">地址：</label>
                <input type="text" class="form-control" name="addr" id="addr">
              </div>

              <div class="form-group">
                <label for="email">郵件：</label>
                <input type="email" class="form-control" name="email" id="email">
              </div>

              <?php
              echo "<input type=\"hidden\" name=\"member_id\" id=\"member_id\" value=$memberID>";
              ?>

              <div align="center">
                <button type="submit" class="btn btn-primary" id="update-btn" name="update_member">更新</button>
              </div>
            </form>
          </div>
          <!-- 會員資料end -->
        </div>
        <!--  訂單管理 -->
        <div class="tab-pane fade" id="tab-pane-3">
          <table class="table">
            <thead>
              <tr>
                <th>下訂日期</th>
                <th>訂單內容</th>
                <th>總金額</th>
                <th>付款方式</th>
                <th>收件人姓名</th>
                <th>收件人電話</th>
                <th>收件地址</th>
                <th>訂單狀態</th>
                <th>取消訂單</th>
              </tr>
            </thead>
            <tbody>
              <?php
              require_once "config.php";

              $limit = 10; // 每頁顯示的資料筆數
              $page = isset($_GET['page']) ? $_GET['page'] : 1; // 目前所在的頁數
              $start = ($page - 1) * $limit; // 資料庫查詢的起始位置
              $memberID = $_SESSION["member_id"];

              // 查詢資料庫中的會員資料並計算總筆數
              $query = "SELECT COUNT(*) AS total FROM order_manage WHERE member_id = $memberID";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);
              $totalPages = ceil($row['total'] / $limit); // 總頁數
              $totalRecords1 = $row['total']; // 總筆數

              // 查詢資料庫中的會員資料，根據分頁顯示的起始位置和每頁顯示的資料筆數
              $query = "SELECT * FROM order_manage LIMIT $start, $limit";
              $result = mysqli_query($conn, $query);

              function getSalesPro($order_id)
              {
                global $conn;

                $query = "SELECT ps.product_id, p.product_name, ps.num FROM product_sales AS ps INNER JOIN product AS p ON ps.product_id = p.product_id WHERE ps.order_id = $order_id";
                $result = mysqli_query($conn, $query);

                $salesPro = "";

                if (mysqli_num_rows($result) > 0) {
                  $salesPro .= "<ul class='product-list'>";
                  while ($row = mysqli_fetch_assoc($result)) {
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $num = $row['num'];

                    $salesPro .= "<li>$product_name - $num 件\n</li>";
                  }
                  $salesPro .= "</ul>";
                } else {
                  $salesPro = "無";
                }

                return $salesPro;
              }

              if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  echo "<tr id='" . $row['order_id'] . "'>";
                  echo "<td>" . $row['order_date'] . "</td>";
                  echo "<td>" . getSalesPro($row['order_id']) . "</td>";
                  echo "<td>" . $row['total_consumption'] . "</td>";
                  echo "<td>" . $row['payment_methon'] . "</td>";
                  echo "<td>" . $row['recipient'] . "</td>";
                  echo "<td>" . $row['recipient_phone'] . "</td>";
                  echo "<td>" . $row['shipping_addr'] . "</td>";
                  echo "<td>" . $row['order_state'] . "</td>";
                  echo "<td class='button-container'>";
                  echo "<span class='button-spacing'></span>";
                  echo "<button class='btn btn-primary delete-btn' onclick=\"deleteOrd(" . $row['order_id'] . ")\">刪除</button>";
                  echo "</td>";
                  echo "</tr>";
                }
              } else {
                echo "<tr><td colspan='10'>暫無數據</td></tr>";
              }
              ?>
            </tbody>
          </table>
        </div>
        <!--  訂單管理end -->
      </div>
    </div>
  </div>

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