<?php
session_start();
if (isset($_SESSION["member_id"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>登入 Sign in</title>
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

    <!-- login Start -->
    <!-- <div class="container-fluid pt-5"> -->
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">登入 Sign In</span></h2>
    </div>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
            $username = $_POST["username"]; //獲取帳號
            $password = $_POST["password"]; //獲取密碼

            require_once "config.php"; //連進資料庫
            $sql = "SELECT * FROM member WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if (empty($username) OR empty($password)) {
                echo "<div class='alert alert-danger'>請填入帳號或密碼 !</div>";
            }
            else if ($user) {
                if (password_verify($password, $user["password"])){
                    session_start();
                    $_SESSION["member_name"] = $user["member_name"]; //將username存到session
                    $_SESSION["member_id"] = $user["member_id"];
                    $_SESSION["admin"] = $user["admin"];
                    header("Location: index.php");
                    die();
                }else{
                echo "<div class='alert alert-danger'>密碼不正確 !</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>帳號不正確 !</div>";
            }
        }
        ?>
      <form action="login.php" method="post">
        <div class="form-group">
            <input type="text" placeholder="請輸入帳號" name="username" class="form-control">
        </div>
        <div class="form-group">
            <input type="password" placeholder="請輸入密碼" name="password" class="form-control">
        </div>
        <div class="form-btn">
            <input type="submit" value="Login" name="login" class="btn btn-primary" style="width:100%;">
        </div>
      </form><br><br>
      <div align="center"><p>忘記密碼嗎 ? <a href="forgetPWD.php">忘記密碼</a></p></div>
      <div align="center"><p>還沒註冊嗎 ? <a href="register.php">點此註冊</a></p></div>
    </div>
        
    <!-- login End -->


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