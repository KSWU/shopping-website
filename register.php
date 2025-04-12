<?php
session_start();
if (isset($_SESSION["member_id"])) {
    header("Location: index.php");
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>註冊 Register</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 50px;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;
        }

        .form-group {
            margin-bottom: 30px;
        }

        #username-validation {
            color: red;
            font-weight: bold;
        }
    </style>

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
    <!-- header -->
    <div class="header"></div>
    <!-- header end -->

    <!-- 註冊 -->
    <div class="container">
        <?php
        if (isset($_POST["register"])) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            $repeat_password = $_POST["repeat_password"];
            $member_name = $_POST["name"];
            $sex = $_POST["sex"];
            $birthday = $_POST["birthday"];
            $tel_num = $_POST["tel_num"];
            $addr = $_POST["addr"];
            $email = $_POST["email"];
            $admin = null;
            $member_date = date('Y-m-d');
            //對密碼加密
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            require_once "config.php";
            $sql = "SELECT * FROM member WHERE username = '$username'";
            $result = mysqli_query($conn, $sql);
            $rowCount = mysqli_num_rows($result);

            if (empty($email) or empty($member_name) or empty($birthday) or empty($repeat_password) or empty($password) or empty($username)) {
            } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            } else if (!(strlen($tel_num) == 0 or strlen($tel_num) == 9 or strlen($tel_num) ==  10)) {
            } else if ($repeat_password !== $password) {
            } else if (strlen($password) < 2 or strlen($password) > 13) {
            } else if (strlen($username) < 2 or strlen($username) > 13) {
            } else if ($rowCount > 0) {
            } else {
                $sql = "INSERT INTO member (username, password, member_name, sex, birthday, tel_num, addr, mail, admin, member_date) VALUES (?,?,?,?,?,?,?,?,?,?)";
                $stmt = mysqli_stmt_init($conn);
                $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                if ($prepareStmt) {
                    mysqli_stmt_bind_param($stmt, "ssssssssss", $username, $passwordHash, $member_name, $sex, $birthday, $tel_num, $addr, $email, $admin, $member_date);
                    mysqli_stmt_execute($stmt);
                    header("Location: registerok.php");
                    exit();
                } else {
                    die("Something went wrong: " . mysqli_error($conn));;
                }
            }
        }
        ?>

        <div class="text-center mb-4">
            <h2 class="section-title px-5"><span class="px-2">註冊 Register</span></h2>
        </div>
        <form action="register.php" method="post">
            <div class="form-group">
                <input type="text" class="form-control" id="username" name="username" placeholder="請輸入帳號名稱" value="<?php echo isset($_POST['username']) ? $_POST['username'] : ''; ?>" onkeyup="checkUsername()" />
                <span id="username-validation"></span>
            </div>
            <!-- ajax帳號驗證 -->
            <script>
                function checkUsername() {
                    var username = document.getElementById("username").value;
                    $.ajax({
                        type: "POST",
                        url: "check_username.php",
                        data: {
                            username: username
                        },
                        success: function(response) {
                            if (response = 1) {
                                document.getElementById("username-validation").innerText = " 帳號已存在 !";
                            } else {
                                document.getElementById("username-validation").innerText = "";
                            }
                        }
                    });
                }
            </script>
            <?php
            if (isset($_POST["register"])) {
                $username = $_POST["username"];
                require_once "config.php";
                $sql = "SELECT * FROM member WHERE username = '$username'";
                $result = mysqli_query($conn, $sql);
                $rowCount = mysqli_num_rows($result);
                if (empty($username)) {
                    echo "<div class='alert alert-danger'>請輸入帳號名稱</div>";
                } else if (strlen($username) < 2 or strlen($username) > 13) {
                    echo "<div class='alert alert-danger'>帳號名稱請介於3~12個字</div>";
                } else if ($rowCount > 0) {
                    echo "<div class='alert alert-danger'>帳號已存在</div>";
                }
            }
            ?>

            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="請輸入密碼">
            </div>
            <?php
            if (isset($_POST["register"])) {
                $password = $_POST["password"];
                if (empty($password)) {
                    echo "<div class='alert alert-danger'>請輸入密碼</div>";
                } else if (strlen($password) < 3 or strlen($password) > 12) {
                    echo "<div class='alert alert-danger'>密碼請介於3~12個字</div>";
                }
            }
            ?>

            <div class="form-group">
                <input type="password" class="form-control" name="repeat_password" placeholder="請再輸入一次密碼">
            </div>
            <?php
            if (isset($_POST["register"])) {
                $repeat_password = $_POST["repeat_password"];
                $password = $_POST["password"];
                if (empty($repeat_password)) {
                    echo "<div class='alert alert-danger'>請再輸入一次密碼</div>";
                } else if ($repeat_password !== $password) {
                    echo "<div class='alert alert-danger'>密碼不一致</div>";
                }
            }
            ?>

            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="請輸入姓名或暱稱" value="<?php echo isset($_POST['name']) ? $_POST['name'] : ''; ?>">
            </div>
            <?php
            if (isset($_POST["register"])) {
                $name = $_POST["name"];
                if (empty($member_name)) {
                    echo "<div class='alert alert-danger'>請輸入姓名或暱稱</div>";
                }
            }
            ?>

            <div class="form-group">
                &nbsp;性 別&nbsp;&nbsp;&nbsp;
                <input class="" type="radio" name="sex" value="男" id="male">&nbsp;&nbsp;男 生&nbsp;&nbsp;
                <input class="" type="radio" name="sex" value="女" id="male">&nbsp;&nbsp;女 生&nbsp;&nbsp;
                <input class="" type="radio" name="sex" value="不透漏" id="male" checked>&nbsp;&nbsp;不 透 漏
            </div>

            <div class="form-group">
                &nbsp;生 日&nbsp;&nbsp;&nbsp;
                <input type="date" id="birthday" name="birthday" value="<?php echo isset($_POST['birthday']) ? $_POST['birthday'] : ''; ?>">
            </div>
            <?php
            if (isset($_POST["register"])) {
                $birthday = $_POST["birthday"];
                if (empty($birthday)) {
                    echo "<div class='alert alert-danger'>請選擇生日</div>";
                }
            }
            ?>

            <div class="form-group">
                <input type="text" class="form-control" name="tel_num" placeholder="請輸入電話號碼(非必填)" value="<?php echo isset($_POST['tel_num']) ? $_POST['tel_num'] : ''; ?>">
            </div>
            <?php
            if (isset($_POST["register"])) {
                $tel_num = $_POST["tel_num"];
                if ((strlen($tel_num) == 0 or strlen($tel_num) == 9 or strlen($tel_num) ==  10)) {
                } else {
                    echo "<div class='alert alert-danger'>電話號碼輸入有誤</div>";
                }
            }
            ?>

            <div class="form-group">
                <input type="text" class="form-control" name="addr" placeholder="請輸入地址(非必填)" value="<?php echo isset($_POST['addr']) ? $_POST['addr'] : ''; ?>">
            </div>
            <div class="form-group">
                <input type="email" class="form-control" name="email" placeholder="請輸入電子郵件" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
            </div>
            <?php
            if (isset($_POST["register"])) {
                $email = $_POST["email"];
                if (empty($email)) {
                    echo "<div class='alert alert-danger'>請輸入電子郵件</div>";
                } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    echo "<div class='alert alert-danger'>電子郵件輸入有誤</div>";
                }
            }
            ?>

            <div class="form-btn">
                <input type="submit" class="btn btn-primary" value="Register" name="register" style="width:100%;">
            </div>
        </form>
        <div><br>
            <div align="center">
                <p>已經註冊了嗎 ? <a href="login.php">點此登入</a></p>
            </div>
        </div>
    </div>

    <!-- 註冊end -->



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