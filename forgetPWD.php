<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>忘記密碼 Forget Password</title>
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
    <style>
        .container{
            max-width: 600px;
            margin:0 auto;
            padding:50px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }
        .form-group{
            margin-bottom:30px;
        }
    </style>
</head>

<body>
    <!-- header -->
    <div class="header"></div>
    <!-- header end -->

    <!-- Forget password Start -->
    <!-- <div class="container-fluid pt-5"> -->
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">忘記密碼 Forget Password</span></h2>
    </div>
    <div class="container">
        <?php
        if (isset($_POST["submit"])) {
            $username = $_POST["username"]; //獲取帳號
            $useremail = $_POST["email"]; //獲取Email
            $check = 0;
            
            $link = mysqli_connect("localhost", "root", "root123456", "group_03") // 建立MySQL的資料庫連結
            or die("無法開啟MySQL資料庫連結!<br>");

            // 送出編碼的MySQL指令
            mysqli_query($link, 'SET CHARACTER SET utf8');
            mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");

            // 資料庫查詢(送出查詢的SQL指令)
            if ($result = mysqli_query($link, "SELECT * FROM member")) {
                while ($row = mysqli_fetch_assoc($result)) {
                    if ($row["username"] == $username && $row["mail"] == $useremail) {
                        $check = 1;
                    }
                }
                $Strings = '0123456789abcdefghijklmnopqrstuvwxyz~!@#$%^&*(),./';
                $newPWD = substr(str_shuffle($Strings), 0, 10);
                $hashPWD = password_hash($newPWD, PASSWORD_DEFAULT);
                
                $sql = 'UPDATE member SET password = "'.$hashPWD.'" WHERE username = "'.$username.'"';
                mysqli_select_db($link, 'group_03');
                mysqli_query($link, $sql);
                
                
                mysqli_free_result($result); // 釋放佔用的記憶體
            }

            mysqli_close($link); // 關閉資料庫連結
            
            if (empty($username) OR empty($useremail)) {
                echo "<div class='alert alert-danger'>請填入帳號和Email !</div>";
            }
            else if ($check == 1) {
                $to = $username."<".$useremail.">"; //收件者
                $subject = "GM Clothing 密碼重設"; //信件標題
                $msg = "您的密碼已經重設，請用新密碼登入並盡速修改密碼 \n您的新密碼為: $newPWD"; //信件內容
                $headers = "From: GM Clothing<s1154039@mail.ncue.edu.tw>"; //寄件者
                if(mail("$to", "$subject", "$msg", "$headers")) {
                    echo "<div class='alert alert-success'>Email已寄出 !</div>"; //寄信成功就會顯示的提示訊息
                }
                else {
                    die("郵件傳送失敗！"); //寄信失敗顯示的錯誤訊息
                }
            }
            else {
                echo "<div class='alert alert-danger'>帳號或Email不正確 !</div>";
            }
        }
        ?>
      <form action="forgetPWD.php" method="post">
        <div class="form-group">
            <input type="text" placeholder="請輸入帳號" name="username" class="form-control">
        </div>
        <div class="form-group">
            <input type="text" placeholder="請輸入Email" name="email" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="送出" name="submit" class="btn btn-primary" style="width:100%;">
        </div>
      </form><br><br>
     
    </div>
        
    <!-- Forget password End -->


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