<?php
session_start();
if (!isset($_SESSION["member_id"])) {
    $msg = "權限不足，請先登入！";
    echo "<script>if(confirm('$msg')){window.location.href='login.php';}</script>";
    exit;
} else if ($_SESSION["admin"] != 'yes') {
    $msg = "權限不足！";
    echo "<script>if(confirm('$msg')){window.location.href='index.php';}</script>";
    exit;
}
?>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>管理中心</title>
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

    .alert {
        display: none;
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        border-radius: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
        font-size: 18px;
    }

    .hide {
        display: none;
    }
    </style>
</head>

<body>
    <!-- header -->
    <div class="header"></div>
    <!-- header end -->

    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">管理中心</span></h2>
    </div>

    <div class="row px-xl-5">
        <div class="col">
            <!-- 選項卡 -->
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">會員資料</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">商品管理</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">訂單管理</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-4">留言管理</a>
                <!-- 動態更改選項卡active -->
                <script>
                $(document).ready(function() {
                    // 獲取上次選項卡資料
                    var lastTab = localStorage.getItem("lastTab");
                    // 如果存在上在選項卡index，則將它設為active
                    if (lastTab) {
                        $('.nav-tabs a[data-toggle="tab"]').eq(lastTab).tab('show');
                    }
                    // 選項卡切換時保留當時index
                    $('.nav-tabs a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
                        var tab = $(e.target).index();
                        localStorage.setItem("lastTab", tab);
                    });
                });
                </script>
            </div>

            <!-- 提示訊息 -->
            <div class="alert"></div>

            <div class="tab-content">
                <!-- 會員資料 -->
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <!-- 搜尋/sort by -->
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="admin.php" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="memSrch" id="memSrch"
                                        placeholder="搜尋會員">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text bg-transparent text-primary"
                                            id="searchButton">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="d-flex justify-content-end align-items-center">
                                <button class="btn btn-primary mr-3" type="button" id="addAdminBtn">
                                    + 新增管理員
                                </button>
                                <div class="dropdown">
                                    <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        排序
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="?sort=newest">最新</a>
                                        <a class="dropdown-item" href="?sort=oldest">最舊</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 搜尋/sort by end -->
                    <!-- 新增管理員modal -->
                    <div class="modal" id="addAdminModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">新增管理員</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="adminAdd.php" method="post" onsubmit="return validateAddAdm()">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="usernam" id="usernam"
                                                placeholder="請輸入帳號名稱 (3~12字)">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="password" id="password"
                                                placeholder="請輸入密碼 (3~12字)">
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control" name="repeat_password"
                                                id="repeat_password" placeholder="請再輸入一次密碼">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="nam" id="nam"
                                                placeholder="請輸入姓名或暱稱">
                                        </div>
                                        <div class="form-group">
                                            &nbsp;性 別&nbsp;&nbsp;&nbsp;
                                            <input class="" type="radio" name="se" value="男" id="male">&nbsp;&nbsp;男
                                            生&nbsp;&nbsp;
                                            <input class="" type="radio" name="se" value="女" id="male">&nbsp;&nbsp;女
                                            生&nbsp;&nbsp;
                                            <input class="" type="radio" name="se" value="不透漏" id="male"
                                                checked>&nbsp;&nbsp;不 透 漏
                                        </div>
                                        <div class="form-group">
                                            &nbsp;生 日&nbsp;&nbsp;&nbsp;
                                            <input type="date" id="birthda" name="birthda"
                                                value="<?php echo isset($_POST['birthday']) ? $_POST['birthday'] : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="tel_nu" id="tel_nu"
                                                placeholder="請輸入電話號碼(非必填)"
                                                value="<?php echo isset($_POST['tel_num']) ? $_POST['tel_num'] : ''; ?>">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="add" id="add"
                                                placeholder="請輸入地址(非必填)">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="emai" id="emai"
                                                placeholder="請輸入電子郵件">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary add-btn1"
                                                name="add_adm">新增</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">關閉</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 表單驗證 -->
                        <script>
                        function validateAddAdm() {
                            var usernam = document.getElementById('usernam').value.trim();
                            var nam = document.getElementById('nam').value.trim();
                            var password = document.getElementById('password').value.trim();
                            var repeat_password = document.getElementById('repeat_password').value.trim();
                            var telNu = document.getElementById('tel_nu').value.trim();
                            var birthda = document.getElementById('birthda').value.trim();
                            var add = document.getElementById('add').value.trim();
                            var emai = document.getElementById('emai').value.trim();

                            var msg = '';
                            if (usernam === '') {
                                msg += '帳號 為必填 !\n';
                            } else if (usernam.length < 3 || usernam.length > 13) {
                                msg += '帳號 請介於3~12字 !\n';
                            }
                            if (nam === '') {
                                msg += '名稱 為必填 !\n';
                            }
                            if (password === '') {
                                msg += '密碼 為必填 !\n';
                            } else if (password.length < 3 || password.length > 13) {
                                msg += '密碼 請介於3~12個字 !\n';
                            } else if (password !== repeat_password) {
                                msg += '密碼 不一致 !\n';
                            }
                            if (birthda === '') {
                                msg += '生日 為必填 !\n'
                            }
                            if (emai === '') {
                                msg += 'mail 為必填 !\n'
                            }
                            if (!(telNu.length == 0 || telNu.length == 9 || telNu.length == 10)) {
                                msg += '電話號碼輸入有誤 !\n';
                            }

                            if (msg !== '') {
                                alert(msg);
                                return false;
                            } else {
                                return true;
                            }
                        }
                        //成功訊息
                        $(document).ready(function() {
                            // 檢查是否更新成功
                            const urlParams = new URLSearchParams(window.location.search);
                            const addAdmSuccess = urlParams.get('addAdm_success');

                            if (addAdmSuccess === '1') {
                                $('.alert').html('管理員新增成功 !').addClass('alert-success').show().delay(1500)
                                    .fadeOut();
                                //恢復網址
                                const newURL = window.location.href.replace('?addAdm_success=1', '');
                                history.replaceState({}, document.title, newURL);
                            } else if (addAdmSuccess === '0') {
                                $('.alert').html('管理員新增失敗 !\n已有重複帳號 !').addClass('alert-danger').show().delay(
                                        1500)
                                    .fadeOut();
                                //恢復網址
                                const newURL = window.location.href.replace('?addAdm_success=1', '');
                                history.replaceState({}, document.title, newURL);
                            }
                        });
                        </script>
                        <!-- 表單驗證end -->
                    </div>
                    <script>
                    document.getElementById('addAdminBtn').addEventListener('click', function() {
                        $('#addAdminModal').modal('show');
                    });
                    </script>
                    <!-- 新增管理員modal end -->

                    <!-- 會員表格 -->
                    <table id="memberTable" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>帳號</th>
                                <th>名稱</th>
                                <th>註冊日期</th>
                                <th>消費總額</th>
                                <th>查看 & 編輯 & 刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 產生會員表格 -->
                            <?php
                            require_once "config.php";
                            $sort = isset($_GET['sort']) ? $_GET['sort'] : ''; //取得排序情況
                            $limit = 10; // 每頁顯示的資料筆數
                            $page = isset($_GET['page']) ? $_GET['page'] : 1; // 目前所在的頁數
                            $start = ($page - 1) * $limit; // 資料庫查詢的起始位置
                            if (isset($_POST["memSrch"]) != '') {
                                $memSrch = $_POST['memSrch'];
                                // 查询匹配的记录
                                $query = "SELECT COUNT(*) AS total FROM member WHERE member_id LIKE '%$memSrch%' OR username LIKE '%$memSrch%' OR member_name LIKE '%$memSrch%'";
                                $result = mysqli_query($conn, $query);
                            } else {
                                $query = "SELECT COUNT(*) AS total FROM member";
                                $result = mysqli_query($conn, $query);
                            }

                            // 查詢資料庫中的會員資料並計算總筆數
                            $row = mysqli_fetch_assoc($result);
                            $totalPages = ceil($row['total'] / $limit); // 總頁數
                            $totalRecords1 = $row['total']; // 總筆數

                            if (isset($_POST["memSrch"]) != '') {
                                $query = "SELECT * FROM member WHERE member_id LIKE '%$memSrch%' OR username LIKE '%$memSrch%' OR member_name LIKE '%$memSrch%' LIMIT $start, $limit";
                                $result = mysqli_query($conn, $query);
                            } else {
                                $query = "SELECT * FROM member";
                                if ($sort == 'oldest') {
                                    $query .= " ORDER BY member_date DESC";
                                } else if ($sort == 'newest') {
                                    $query .= " ORDER BY member_date ASC";
                                }
                                $query .= " LIMIT $start, $limit";
                                $result = mysqli_query($conn, $query);
                            }
                            // 查詢資料庫中的會員資料，根據分頁顯示的起始位置和每頁顯示的資料筆數
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr id = '" . $row['member_id'] . "'>";
                                    echo "<td>" . $row['member_id'];
                                    if ($row['admin'] != null) {
                                        echo "*";
                                    }
                                    echo "</td>";
                                    echo "<td>" . $row['username'] . "</td>";
                                    echo "<td>" . $row['member_name'] . "</td>";
                                    echo "<td class='hide'>" . $row['sex'] . "</td>";
                                    echo "<td class='hide'>" . $row['birthday'] . "</td>";
                                    echo "<td class='hide'>" . $row['tel_num'] . "</td>";
                                    echo "<td class='hide'>" . $row['addr'] . "</td>";
                                    echo "<td class='hide'>" . $row['mail'] . "</td>";
                                    echo "<td>" . $row['member_date'] . "</td>";
                                    echo "<td>";
                                    //消費總額計算
                                    $query2 = "SELECT SUM(total_consumption) AS total FROM `order_manage` WHERE member_id = " . $row['member_id'];
                                    $result2 = mysqli_query($conn, $query2);
                                    $total = mysqli_fetch_assoc($result2)['total'];
                                    if ($total > 0) echo $total . " $";
                                    else echo "0 $";
                                    echo "</td>";
                                    echo "<td class='button-container'>";
                                    if (($_SESSION["member_id"] == '7') || ($_SESSION["member_id"] != '7' && $row['username'] != 'admin')) {
                                        echo "<button class='btn btn-primary edit-btn1' data-member-id='" . $row['member_id'] . "' onclick=\"openEditModal1(this);\">查看 & 編輯</button>";
                                        echo "<span class='button-spacing'></span>";
                                        echo "<button class='btn btn-primary delete-btn1' data-member-id='" . $row['member_id'] . "' onclick=\"deletemem(" . $row['member_id'] . ");\">刪除</button>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>暫無數據</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <td colspan="6" class="notes">ID*表示管理員 , 共 <?php echo $totalRecords1 ?> 筆使用者資料</td>
                        </tfoot>
                    </table>

                    <!-- 會員表格end -->
                    <!-- 刪除處理 -->
                    <script>
                    function deletemem(member_id) {
                        $(document).ready(function() {
                            if (confirm("確定要刪除該會員嗎？")) {
                                $.ajax({
                                    url: 'adminDelete.php',
                                    type: 'POST',
                                    data: {
                                        member_id: member_id,
                                        action: "delete1"
                                    },
                                    success: function(response) {
                                        if (response = 1) {
                                            //alert("會員資料刪除成功 !");
                                            $('.alert').html('會員刪除成功 ! ').addClass(
                                                    'alert-success')
                                                .show().delay(1500).fadeOut();
                                            document.getElementById(member_id).style.display =
                                                "none";
                                        } else if (response = 0) {
                                            alert("會員資料刪除失敗 !");
                                        }
                                    }
                                });
                            }
                        });
                    }
                    </script>
                    <!-- 刪除處理end -->

                    <!-- 編輯框框 -->
                    <div class="modal" id="editModal1" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">編輯會員資料</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- 编辑内容 -->
                                    <form action="adminUpdate.php" method="post" onsubmit="return validateFormMem()">
                                        <div class="form-group">
                                            <label for="username">ID：</label>
                                            <input type="text" class="form-control" name="member_id" id="member_id"
                                                readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="username">帳號：</label>
                                            <input type="text" class="form-control" name="username" id="username"
                                                readonly>
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
                                            <label for="tel_num">地址：</label>
                                            <input type="text" class="form-control" name="addr" id="addr">
                                        </div>

                                        <div class="form-group">
                                            <label for="mail">郵件：</label>
                                            <input type="email" class="form-control" name="email" id="email">
                                        </div>
                                        <div class=" form-group">
                                            <label for="product_date">註冊日期：</label>
                                            <input type="text" class="form-control" name="member_date" id="member_date"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="mail">消費總額：</label>
                                            <input type="email" class="form-control" name="mem_total" id="mem_total"
                                                readonly>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary update-btn1"
                                                name="update_member">更新</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">關閉</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 表單驗證 -->
                        <script>
                        function validateFormMem() {
                            var name = document.getElementById('name').value.trim();
                            var telNum = document.getElementById('tel_num').value.trim();
                            var addr = document.getElementById('addr').value.trim();
                            var email = document.getElementById('email').value.trim();

                            var msg = ''; // Variable to store the validation messages

                            if (name === '') {
                                msg += '名稱 為必填 !\n';
                            }
                            if (email === '') {
                                msg += 'mail 為必填 !\n'
                            }
                            if (!(telNum.length == 0 || telNum.length == 9 || telNum.length == 10)) {
                                msg += '電話號碼輸入有誤 !\n';
                            }

                            if (msg !== '') {
                                alert(msg);
                                return false;
                            } else {
                                return true;
                            }
                        }
                        </script>
                        <!-- 表單驗證end -->
                        <script>
                        // modal顯示
                        $(document).ready(function() {
                            $(".edit-btn1").click(function() {
                                var memberId = $(this).data("member-id");
                                var row = $(this).closest("tr");
                                var username = row.find("td:eq(1)").text();
                                var name = row.find("td:eq(2)").text();
                                var sex = row.find("td:eq(3)").text();
                                var birthday = row.find("td:eq(4)").text();
                                var telNum = row.find("td:eq(5)").text();
                                var addr = row.find("td:eq(6)").text();
                                var email = row.find("td:eq(7)").text();
                                var member_date = row.find("td:eq(8)").text();
                                var total = row.find("td:eq(9)").text();

                                $("#member_id").val(memberId);
                                $("#username").val(username);
                                $("#name").val(name);
                                $("#sex").val(sex);
                                $("#birthday").val(birthday);
                                $("#tel_num").val(telNum);
                                $("#addr").val(addr);
                                $("#email").val(email);
                                $("#member_date").val(member_date);
                                $("#mem_total").val(total);

                                $("#editModal1").modal("show");
                            });
                        });
                        //成功訊息
                        $(document).ready(function() {
                            // 檢查是否更新成功
                            const urlParams = new URLSearchParams(window.location.search);
                            const updateSuccess = urlParams.get('update_success');

                            if (updateSuccess === '1') {
                                $('.alert').html('會員編輯成功 !').addClass('alert-success').show().delay(1500)
                                    .fadeOut();
                                //恢復網址
                                const newURL = window.location.href.replace('?update_success=1', '');
                                history.replaceState({}, document.title, newURL);
                            }
                        });
                        </script>
                    </div>
                    <!-- 編輯框框end -->
                    <!-- 分頁按鈕 -->
                    <div class="pagination-container">
                        <ul class="pagination justify-content-center">
                            <?php
                            $previousPage = $page - 1;
                            $nextPage = $page + 1;

                            echo "<li class='page-item " . ($page == 1 ? 'disabled' : '') . "'>";
                            echo "<a class='page-link' href='?page=$previousPage#tab-pane-2' aria-label='Previous'>";
                            echo "<span aria-hidden='true'>«</span>";
                            echo "<span class='sr-only'>Previous</span>";
                            echo "</a>";
                            echo "</li>";

                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=$i#tab-pane-2'>$i</a></li>";
                            }

                            echo "<li class='page-item " . ($page == $totalPages ? 'disabled' : '') . "'>";
                            echo "<a class='page-link' href='?page=$nextPage#tab-pane-2' aria-label='Next'>";
                            echo "<span aria-hidden='true'>»</span>";
                            echo "<span class='sr-only'>Next</span>";
                            echo "</a>";
                            echo "</li>";
                            ?>
                        </ul>
                    </div>
                    <!-- 分頁按鈕結束 -->

                </div>
                <!-- 會員資料end -->

                <!-- 商品管理 -->
                <div class="tab-pane fade" id="tab-pane-2">
                    <!-- 搜尋/sort by -->
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="admin.php" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="proSrch" id="proSrch"
                                        placeholder="搜尋商品">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text bg-transparent text-primary"
                                            id="searchButton">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="d-flex justify-content-end align-items-center">
                                <button class="btn btn-primary mr-3" type="button" id="addProBtn">
                                    + 新增商品
                                </button>
                                <div class="dropdown">
                                    <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        排序
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="?sort=newestP">最新</a>
                                        <a class="dropdown-item" href="?sort=oldestP">最舊</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 搜尋/sort by end -->

                    <!-- 新增商品modal -->
                    <div class="modal" id="addProModal" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">新增商品</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="adminAdd.php" method="post" onsubmit="return alidateAddPro()"
                                        enctype="multipart/form-data">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="product_nam" id="product_nam"
                                                placeholder="名稱 (1~20字)">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="pric" id="pric"
                                                placeholder="價格">
                                        </div>
                                        <div class="form-group">
                                            <label for="category">分類：</label>
                                            <select class="form-control" name="categor" id="categor">
                                                <option value="上衣">上衣</option>
                                                <option value="長褲">長褲</option>
                                                <option value="短褲">短褲</option>
                                                <option value="裙裝">裙裝</option>
                                                <option value="連身">連身</option>
                                                <option value="外套">外套</option>
                                                <option value="配飾">配飾</option>
                                                <option value="鞋子">鞋子</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="qualit" id="qualit"
                                                placeholder="庫存">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="intr" id="intr" rows="5"
                                                placeholder="介紹"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="product_imag" style="vertical-align: top;">商品圖片：</label>
                                            <div style="display: inline-block;">
                                                <input type="file" class="form-control-file" name="product_imag"
                                                    id="product_imag">
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary add-btn1"
                                                name="add_pro">新增</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">關閉</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 表單驗證 -->
                        <script>
                        function alidateAddPro() {
                            var product_nam = document.getElementById('product_nam').value.trim();
                            var pric = document.getElementById('pric').value.trim();
                            var qualit = document.getElementById('qualit').value.trim();
                            var categor = document.getElementById('categor').value.trim();
                            var product_imag = document.getElementById('product_imag').value;

                            var msg = '';
                            if (product_nam === '') {
                                msg += '商品名稱 為必填 !\n';
                            } else if (usernam.length < 1 || usernam.length > 20) {
                                msg += '商品名稱 請介於1~20字 !\n';
                            }
                            if (pric === '') {
                                msg += '價格 為必填 !\n';
                            }
                            if (qualit === '') {
                                msg += '庫存 為必填 !\n';
                            }
                            if (categor === '') {
                                msg += '需選擇 類別 !\n';
                            }
                            if (product_imag === '') {
                                msg += '商品圖片 為必選 !\n';
                            }

                            if (msg !== '') {
                                alert(msg);
                                return false;
                            } else {
                                return true;
                            }
                        }
                        //成功訊息
                        $(document).ready(function() {
                            // 檢查是否更新成功
                            const urlParams = new URLSearchParams(window.location.search);
                            const addPro_success = urlParams.get('addPro_success');

                            if (addPro_success === '1') {
                                $('.alert').html('商品新增成功 !').addClass('alert-success').show().delay(1500)
                                    .fadeOut();
                                //恢復網址
                                const newURL = window.location.href.replace('?addPro_success=1', '');
                                history.replaceState({}, document.title, newURL);
                            }
                        });
                        </script>
                        <!-- 表單驗證end -->
                    </div>
                    <script>
                    document.getElementById('addProBtn').addEventListener('click', function() {
                        $('#addProModal').modal('show');
                    });
                    </script>
                    <!-- 新增管理員modal end -->

                    <!-- 商品表格 -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名稱</th>
                                <th>價格</th>
                                <th>分類</th>
                                <th>庫存</th>
                                <th>銷量</th>
                                <th>上架日期</th>
                                <th>編輯 & 刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once "config.php";
                            $sort = isset($_GET['sort']) ? $_GET['sort'] : ''; //取得排序情況
                            $limit = 10; // 每頁顯示的資料筆數
                            $page = isset($_GET['page']) ? $_GET['page'] : 1; // 目前所在的頁數
                            $start = ($page - 1) * $limit; // 資料庫查詢的起始位置

                            // 查詢資料庫中的商品資料並計算總筆數
                            if (isset($_POST["proSrch"]) != '') {
                                $proSrch = $_POST['proSrch'];
                                // 查询匹配的记录
                                $query = "SELECT COUNT(*) AS total FROM product WHERE product_id LIKE '%$proSrch%' OR product_name LIKE '%$proSrch%' OR intro LIKE '%$proSrch%' OR category LIKE '%$proSrch%'";
                                $result1 = mysqli_query($conn, $query);
                            } else {
                                $query = "SELECT COUNT(*) AS total FROM product";
                                $result1 = mysqli_query($conn, $query);
                            }

                            $row = mysqli_fetch_assoc($result1);
                            $totalPages = ceil($row['total'] / $limit); // 總頁數
                            $totalRecords = $row['total']; // 總筆數

                            if (isset($_POST["proSrch"]) != '') {
                                $query = "SELECT * FROM product WHERE product_id LIKE '%$proSrch%' OR product_name LIKE '%$proSrch%' OR intro LIKE '%$proSrch%' OR category LIKE '%$proSrch%' LIMIT $start, $limit";
                                $result1 = mysqli_query($conn, $query);
                            } else {
                                $query = "SELECT * FROM product";
                                if ($sort == 'oldestP') {
                                    $query .= " ORDER BY product_date DESC";
                                } else if ($sort == 'newestP') {
                                    $query .= " ORDER BY product_date ASC";
                                }
                                $query .= " LIMIT $start, $limit";
                                $result1 = mysqli_query($conn, $query);
                            }

                            function getSalesCount($productId)
                            {
                                global $conn;

                                $query = "SELECT SUM(ps.num) AS totalSales FROM order_manage AS om LEFT JOIN product_sales AS ps ON om.order_id = ps.order_id WHERE om.order_state = '已完成' AND ps.product_id = $productId";
                                $result = mysqli_query($conn, $query);
                                $row = mysqli_fetch_assoc($result);
                                $salesCount = $row['totalSales'];

                                return $salesCount ? $salesCount : 0;
                            }

                            if (mysqli_num_rows($result1) > 0) {
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    echo "<tr id = '" . $row['product_id'] . "'>";
                                    echo "<td>" . $row['product_id'] . "</td>";
                                    echo "<td>" . $row['product_name'] . "</td>";
                                    echo "<td>" . $row['price'] . "</td>";
                                    echo "<td>" . $row['category'] . "</td>";
                                    echo "<td>" . $row['quality'] . "</td>";
                                    echo "<td>" . getSalesCount($row['product_id']) . "</td>";
                                    echo "<td style='display: none;'>" . nl2br($row['intro']) . "</td>";
                                    echo "<td>" . $row['product_date'] . "</td>";
                                    echo "<td class='button-container'>";
                                    echo "<button class='btn btn-primary edit-btn2' data-product-id='" . $row['product_id'] . "' onclick=\"openEditModal2(this);\">編輯</button>";
                                    echo "<span class='button-spacing'></span>";
                                    echo "<button class='btn btn-primary delete-btn2' data-product-id='" . $row['product_id'] . "' onclick=\"deletePro(" . $row['product_id'] . ");\">刪除</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='8'>暫無數據</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <td colspan="8" class="notes">全部共 <?php echo $totalRecords; ?> 筆商品資料</td>
                        </tfoot>
                    </table>
                    <!-- 商品表格end -->
                    <!-- 商品刪除處理 -->
                    <script>
                    function deletePro(product_id) {
                        $(document).ready(function() {
                            if (confirm("確定要刪除該商品嗎？")) {
                                $.ajax({
                                    url: 'adminDelete.php',
                                    type: 'POST',
                                    data: {
                                        product_id: product_id,
                                        action: "delete2"
                                    },
                                    success: function(response) {
                                        if (response = 2) {
                                            $('.alert').html('商品刪除成功 ! ').addClass(
                                                    'alert-success')
                                                .show().delay(1500).fadeOut();
                                            document.getElementById(product_id).style.display =
                                                "none";
                                        } else if (response == 0) {
                                            alert("商品刪除失敗 !");
                                        }
                                    }
                                });
                            }
                        });
                    }
                    </script>
                    <!-- 刪除處理end -->

                    <!-- 編輯框框 -->
                    <div class="modal" id="editModal2" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">編輯商品資料</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- 編輯內容 -->
                                    <form action="adminUpdate.php" method="post" onsubmit="return validateFormPro()"
                                        enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="product_name">名稱：</label>
                                            <input type="text" class="form-control" name="product_name"
                                                id="product_name">
                                        </div>
                                        <div class="form-group">
                                            <label for="price">價格：</label>
                                            <input type="text" class="form-control" name="price" id="price">
                                        </div>
                                        <div class="form-group">
                                            <label for="category">分類：</label>
                                            <select class="form-control" name="category" id="category">
                                                <option value="上衣">上衣</option>
                                                <option value="長褲">長褲</option>
                                                <option value="短褲">短褲</option>
                                                <option value="裙裝">裙裝</option>
                                                <option value="連身">連身</option>
                                                <option value="外套">外套</option>
                                                <option value="配飾">配飾</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="quality">庫存：</label>
                                            <input type="text" class="form-control" name="quality" id="quality">
                                        </div>
                                        <div class="form-group">
                                            <label for="quality">銷量：</label>
                                            <input type="text" class="form-control" name="salesNum" id="salesNum"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="intro">介紹：</label>
                                            <textarea class="form-control" name="intro" id="intro" rows="5"></textarea>
                                        </div>
                                        <div class=" form-group">
                                            <label for="product_date">上架日期：</label>
                                            <input type="text" class="form-control" name="product_date"
                                                id="product_date" readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="product_image" style="vertical-align: top;">商品圖片：</label>
                                            <div style="display: inline-block;">
                                                <img src="" id="product_image_preview"
                                                    style="max-width: 200px; max-height: 200px;">
                                                <input type="file" class="form-control-file" name="product_image"
                                                    id="product_image">
                                            </div>
                                        </div>
                                        <input type="hidden" name="product_id" id="product_id">
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" id="update-btn"
                                                name="update_product">更新</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">關閉</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 表單驗證 -->
                        <script>
                        function validateFormPro() {
                            var product_name = document.getElementById('product_name').value.trim();
                            var price = document.getElementById('price').value.trim();
                            var quality = document.getElementById('quality').value.trim();

                            var msg = '';
                            if (product_name === '') {
                                msg += '商品名稱 為必填 !\n';
                            } else if (usernam.length < 1 || usernam.length > 20) {
                                msg += '商品名稱 請介於1~20字 !\n';
                            }
                            if (price === '') {
                                msg += '價格 為必填 !\n';
                            }
                            if (quality === '') {
                                msg += '庫存 為必填 !\n';
                            }

                            if (msg !== '') {
                                alert(msg);
                                return false;
                            } else {
                                return true;
                            }
                        }
                        //成功訊息
                        $(document).ready(function() {
                            // 檢查是否更新成功
                            const urlParams = new URLSearchParams(window.location.search);
                            const updateP_success = urlParams.get('updateP_success');

                            if (updateP_success === '1') {
                                $('.alert').html('商品新增成功 !').addClass('alert-success').show().delay(1500)
                                    .fadeOut();
                                //恢復網址
                                const newURL = window.location.href.replace('?updateP_success=1', '');
                                history.replaceState({}, document.title, newURL);
                            }
                        });
                        </script>
                        <!-- 表單驗證end -->
                        <!-- modal2顯示 -->
                        <script>
                        $(document).ready(function() {
                            $(".edit-btn2").click(function() {
                                var productId = $(this).data("product-id");
                                var row = $(this).closest("tr");
                                var productName = row.find("td:eq(1)").text();
                                var price = row.find("td:eq(2)").text();
                                var category = row.find("td:eq(3)").text();
                                var quantity = row.find("td:eq(4)").text();
                                var salesNum = row.find("td:eq(5)").text();
                                var intro = row.find("td:eq(6)").text();
                                var productDate = row.find("td:eq(7)").text();
                                var productImage = "img/" + productId + ".jpg";

                                $("#product_id").val(productId);
                                $("#product_name").val(productName);
                                $("#price").val(price);
                                $("#category").val(category);
                                $("#quality").val(quantity);
                                $("#salesNum").val(salesNum);
                                $("#intro").val(intro);
                                $("#product_date").val(productDate);
                                $("#product_image_preview").attr("src", productImage);

                                $("#editModal2").modal("show");
                            });
                        });
                        </script>
                        <!-- modal2顯示end -->
                    </div>
                    <!-- 編輯框框end -->

                    <!-- 分頁按鈕 -->
                    <div class="pagination-container">
                        <ul class="pagination justify-content-center">
                            <?php
                            $previousPage = $page - 1;
                            $nextPage = $page + 1;

                            echo "<li class='page-item " . ($page == 1 ? 'disabled' : '') . "'>";
                            echo "<a class='page-link' href='?page=$previousPage#tab-pane-2' aria-label='Previous'>";
                            echo "<span aria-hidden='true'>«</span>";
                            echo "<span class='sr-only'>Previous</span>";
                            echo "</a>";
                            echo "</li>";
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=$i#tab-pane-2'>$i</a></li>";
                            }

                            echo "<li class='page-item " . ($page == $totalPages ? 'disabled' : '') . "'>";
                            echo "<a class='page-link' href='?page=$nextPage#tab-pane-2' aria-label='Next'>";
                            echo "<span aria-hidden='true'>»</span>";
                            echo "<span class='sr-only'>Next</span>";
                            echo "</a>";
                            echo "</li>";
                            ?>
                        </ul>
                    </div>
                    <!-- 分頁按鈕end -->
                </div>
                <!-- 商品管理end -->

                <!--  訂單管理 -->
                <div class="tab-pane fade" id="tab-pane-3">
                    <!-- 搜尋/sort by -->
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="admin.php" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="ordSrch" id="ordSrch"
                                        placeholder="搜尋訂單">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text bg-transparent text-primary"
                                            id="searchButton">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="dropdown">
                                    <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        排序
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="?sort=newestO">最新</a>
                                        <a class="dropdown-item" href="?sort=oldestO">最舊</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 搜尋/sort by end -->

                    <!-- 訂單表格 -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>購買人帳號</th>
                                <th>總金額</th>
                                <th>訂單日期</th>
                                <th>訂單狀態</th>
                                <th>查看 & 編輯 &取消</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 產生訂單表格 -->
                            <?php
                            require_once "config.php";
                            $sort = isset($_GET['sort']) ? $_GET['sort'] : ''; //取得排序情況
                            $limit = 10; // 每頁顯示的資料筆數
                            $page = isset($_GET['page']) ? $_GET['page'] : 1; // 目前所在的頁數
                            $start = ($page - 1) * $limit; // 資料庫查詢的起始位置


                            if (isset($_POST["ordSrch"]) != '') {
                                $ordSrch = $_POST['ordSrch'];
                                $query = "SELECT COUNT(*) AS total FROM order_manage WHERE order_id LIKE '%$ordSrch%' OR member_id LIKE '%$ordSrch%'";
                                $result1 = mysqli_query($conn, $query);
                            } else {
                                $query = "SELECT COUNT(*) AS total FROM order_manage";
                                $result1 = mysqli_query($conn, $query);
                            }

                            // 查詢資料庫中的會員資料並計算總筆數
                            $row = mysqli_fetch_assoc($result1);
                            $totalPages = ceil($row['total'] / $limit); // 總頁數
                            $totalRecords1 = $row['total']; // 總筆數



                            if (isset($_POST["ordSrch"]) != '') {
                                $query = "SELECT * FROM order_manage WHERE order_id LIKE '%$ordSrch%' OR member_id LIKE '%$ordSrch%' LIMIT $start, $limit";
                                $result1 = mysqli_query($conn, $query);
                            } else {
                                $query = "SELECT * FROM order_manage";
                                if ($sort == 'oldestO') {
                                    $query .= " ORDER BY order_date DESC";
                                } else if ($sort == 'newestO') {
                                    $query .= " ORDER BY order_date ASC";
                                }
                                $query .= " LIMIT $start, $limit";
                                $result1 = mysqli_query($conn, $query);
                            }

                            //找到會員帳號
                            function getMemberName($member_id)
                            {
                                global $conn;

                                $query = "SELECT username FROM member WHERE member_id = '$member_id'";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    return $row['username'];
                                } else {
                                    return "未知";
                                }
                            }

                            //找到該訂單所有商品
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

                                        $salesPro .= "<li>【 $product_id 】 $product_name - $num 件\n</li>";
                                    }
                                    $salesPro .= "</ul>";
                                } else {
                                    $salesPro = "無";
                                }

                                return $salesPro;
                            }

                            // 查詢資料庫中的會員資料，根據分頁顯示的起始位置和每頁顯示的資料筆數
                            if (mysqli_num_rows($result1) > 0) {
                                while ($row = mysqli_fetch_assoc($result1)) {
                                    echo "<tr id = '" . $row['order_id'] . "'>"; //id
                                    echo "<td>" . $row['order_id'] . "</td>";
                                    echo "<td>" . getMemberName($row['member_id']) . "</td>";
                                    echo "</td>";
                                    echo "<td>" . $row['total_consumption'] . " $</td>";
                                    echo "<td>" . $row['order_date'] . "</td>";
                                    echo "<td class='hide'>" . $row['payment_methon'] . "</td>";
                                    echo "<td class='hide'>" . $row['recipient'] . "</td>";
                                    echo "<td class='hide'>" . $row['recipient_phone'] . "</td>";
                                    echo "<td class='hide'>" . $row['shipping_addr'] . "</td>";
                                    echo "<td class='hide'>" . getSalesPro($row['order_id']) . "</td>";
                                    echo "<td>" . $row['order_state'] . "</td>";
                                    echo "<td class='button-container'>";
                                    echo "<button class='btn btn-primary edit-btn3' data-order-id='" . $row['order_id'] . "' onclick=\"openEditModal3#(this);\">查看 & 編輯</button>";
                                    if ($row['order_state'] != '已完成') {
                                        echo "<span class='button-spacing'></span>";
                                        echo "<button class='btn btn-primary delete-btn1' data-order-id='" . $row['order_id'] . "' onclick=\"deleteOrd(" . $row['order_id'] . ");\">取消</button>";
                                    }
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>暫無數據</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <td colspan="6" class="notes">共 <?php echo $totalRecords1 ?> 筆訂單資料</td>
                        </tfoot>
                    </table>
                    <!-- 訂單表格end -->

                    <!-- 刪除處理 -->
                    <script>
                    function deleteOrd(order_id) {
                        $(document).ready(function() {
                            if (confirm("確定要刪除該訂單嗎？")) {
                                $.ajax({
                                    url: 'adminDelete.php',
                                    type: 'POST',
                                    data: {
                                        order_id: order_id,
                                        action: "delete3"
                                    },
                                    success: function(response) {
                                        if (response == 3) {
                                            document.getElementById(order_id).style.display =
                                                "none";
                                            $('.alert').html('訂單刪除成功 ! ').addClass('alert-success')
                                                .show().delay(1500).fadeOut();
                                        } else if (response == 0) {
                                            alert("訂單取消失敗 !");
                                        }
                                    }
                                });
                            }
                        });
                    }
                    </script>
                    <!-- 刪除處理end -->
                    <!-- 編輯框框 -->
                    <div class="modal" id="editModal3" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">查看 & 更新訂單狀態</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- 編輯內容 -->
                                    <form action="adminUpdate.php" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="product_name">訂單ID：</label>
                                            <input type="text" class="form-control" name="order_id" id="order_id"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">購買人帳號：</label>
                                            <input type="text" class="form-control" name="order_user" id="order_user"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">總金額：</label>
                                            <input type="text" class="form-control" name="order_price" id="order_price"
                                                readonly>
                                        </div>
                                        <div class=" form-group">
                                            <label for="product_date">訂單時間：</label>
                                            <input type="text" class="form-control" name="order_date" id="order_date"
                                                readonly>
                                        </div>
                                        <div class=" form-group">
                                            <label for="order_stat">訂單狀態：</label>
                                            <select class="form-control" name="order_state" id="order_state" disable>
                                                <option value="待確認">待確認</option>
                                                <option value="已確認">已確認</option>
                                                <option value="已完成">已完成</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="intro">購買商品：</label>
                                            <textarea class="form-control" name="order_product" id="order_product"
                                                rows="5" readonly></textarea>
                                        </div>

                                        <div class=" form-group">
                                            <label for="product_date">收件人：</label>
                                            <input type="text" class="form-control" name="order_recipient"
                                                id="order_recipient" readonly>
                                        </div>
                                        <div class=" form-group">
                                            <label for="product_date">收件人電話：</label>
                                            <input type="text" class="form-control" name="recipient_phone"
                                                id="recipient_phone" readonly>
                                        </div>

                                        <div class=" form-group">
                                            <label for="product_date">收件地址：</label>
                                            <input type="text" class="form-control" name="shipping_addr"
                                                id="shipping_addr" readonly>
                                        </div>
                                        <div class=" form-group">
                                            <label for="product_date">付款方式：</label>
                                            <input type="text" class="form-control" name="payment_methon"
                                                id="payment_methon" readonly>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary" id="state_update"
                                                name="state_update">更新</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">關閉</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script>
                        //成功訊息
                        $(document).ready(function() {
                            // 檢查是否更新成功
                            const urlParams = new URLSearchParams(window.location.search);
                            const update_success = urlParams.get('update_success');

                            if (update_success === '3') {
                                $('.alert').html('狀態修改成功 !').addClass('alert-success').show().delay(1500)
                                    .fadeOut();
                                //恢復網址
                                const newURL = window.location.href.replace('?update_success=3', '');
                                history.replaceState({}, document.title, newURL);
                            } else if (update_success === '-3') {
                                $('.alert').html('庫存不足 ! 請補貨 或 取消訂單!').addClass('alert-danger').show().delay(
                                        1500)
                                    .fadeOut();
                                //恢復網址
                                const newURL = window.location.href.replace('?update_success=-3', '');
                                history.replaceState({}, document.title, newURL);
                            }
                        });
                        </script>
                        <!-- modal3顯示 -->
                        <script>
                        $(document).ready(function() {
                            $(".edit-btn3").click(function() {
                                var order_id = $(this).data("order-id");
                                var row = $(this).closest("tr");
                                var order_id = row.find("td:eq(0)").text();
                                var order_user = row.find("td:eq(1)").text();
                                var order_price = row.find("td:eq(2)").text();
                                var order_date = row.find("td:eq(3)").text();
                                var order_state = row.find("td:eq(9)").text();
                                var order_product = row.find("td:eq(8)").text();
                                var order_recipient = row.find("td:eq(5)").text();
                                var recipient_phone = row.find("td:eq(6)").text();
                                var shipping_addr = row.find("td:eq(7)").text();
                                var payment_methon = row.find("td:eq(4)").text();

                                $("#order_id").val(order_id);
                                $("#order_user").val(order_user);
                                $("#order_price").val(order_price);
                                $("#order_date").val(order_date);
                                $("#order_state").val(order_state);
                                $("#order_product").val(order_product);
                                $("#order_recipient").val(order_recipient);
                                $("#recipient_phone").val(recipient_phone);
                                $("#shipping_addr").val(shipping_addr);
                                $("#payment_methon").val(payment_methon);

                                $("#editModal3").modal("show");
                            });
                        });
                        </script>
                        <!-- modal3顯示end -->
                    </div>
                    <!-- 編輯框框end -->

                    <!-- 分頁按鈕 -->
                    <div class="pagination-container">
                        <ul class="pagination justify-content-center">
                            <?php
                            $previousPage = $page - 1;
                            $nextPage = $page + 1;

                            echo "<li class='page-item " . ($page == 1 ? 'disabled' : '') . "'>";
                            echo "<a class='page-link' href='?page=$previousPage#tab-pane-2' aria-label='Previous'>";
                            echo "<span aria-hidden='true'>«</span>";
                            echo "<span class='sr-only'>Previous</span>";
                            echo "</a>";
                            echo "</li>";
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=$i#tab-pane-2'>$i</a></li>";
                            }

                            echo "<li class='page-item " . ($page == $totalPages ? 'disabled' : '') . "'>";
                            echo "<a class='page-link' href='?page=$nextPage#tab-pane-2' aria-label='Next'>";
                            echo "<span aria-hidden='true'>»</span>";
                            echo "<span class='sr-only'>Next</span>";
                            echo "</a>";
                            echo "</li>";
                            ?>
                        </ul>
                    </div>
                    <!-- 分頁按鈕end -->
                </div>
                <!--  訂單管理end -->


                <!-- 留言管理-->
                <div class="tab-pane fade" id="tab-pane-4">
                    <!-- 搜尋/sort by -->
                    <div class="col-12 pb-1">
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <form action="admin.php" method="post">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="msgSrch" id="msgSrch"
                                        placeholder="搜尋留言">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text bg-transparent text-primary"
                                            id="searchButton">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="dropdown">
                                    <button class="btn border dropdown-toggle" type="button" id="triggerId"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        排序
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="triggerId">
                                        <a class="dropdown-item" href="?sort=newestM">最新</a>
                                        <a class="dropdown-item" href="?sort=oldestM">最舊</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- 搜尋/sort by end -->
                    <!-- 留言表格 -->
                    <table id="msgTable" class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>留言者</th>
                                <th>商品</th>
                                <th>訊息</th>
                                <th>留言時間</th>
                                <th>回覆 & 編輯 & 刪除</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- 產生留言表格 -->
                            <?php
                            require_once "config.php";
                            $sort = isset($_GET['sort']) ? $_GET['sort'] : ''; //取得排序情況
                            $limit = 10; // 每頁顯示的資料筆數
                            $page = isset($_GET['page']) ? $_GET['page'] : 1; // 目前所在的頁數
                            $start = ($page - 1) * $limit; // 資料庫查詢的起始位置
                            if (isset($_POST["msgSrch"]) != '') {
                                $memSrch = $_POST['msgSrch'];
                                $query = "SELECT COUNT(*) AS total FROM `message` WHERE member_id LIKE '%$msgSrch%' OR product_id LIKE '%$msgSrch%' OR msge LIKE '%$msgSrch%'";
                                $result = mysqli_query($conn, $query);
                            } else {
                                $query = "SELECT COUNT(*) AS total FROM `message`";
                                $result = mysqli_query($conn, $query);
                            }

                            //找到會員帳號
                            function getMemberNameM($member_id)
                            {
                                global $conn;

                                $query = "SELECT username FROM member WHERE member_id = '$member_id'";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    return $row['username'];
                                } else {
                                    return "未知";
                                }
                            }
                            //找到商品名稱
                            function getProNameM($product_id)
                            {
                                global $conn;

                                $query = "SELECT product_name FROM product WHERE product_id = '$product_id'";
                                $result = mysqli_query($conn, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    return $row['product_name'];
                                } else {
                                    return "未知";
                                }
                            }

                            // 查詢資料庫中的會員資料並計算總筆數
                            $row = mysqli_fetch_assoc($result);
                            $totalPages = ceil($row['total'] / $limit); // 總頁數
                            $totalRecords1 = $row['total']; // 總筆數

                            if (isset($_POST["msgSrch"]) != '') {
                                $query = "SELECT * FROM `message` WHERE product_id LIKE '%$msgSrch%' OR msge LIKE '%$msgSrch%' LIMIT $start, $limit";
                                $result = mysqli_query($conn, $query);
                            } else {
                                $query = "SELECT * FROM `message`";
                                if ($sort == 'oldestM') {
                                    $query .= " ORDER BY msge_date DESC";
                                } else if ($sort == 'newestM') {
                                    $query .= " ORDER BY msge_date ASC";
                                }
                                $query .= " LIMIT $start, $limit";
                                $result = mysqli_query($conn, $query);
                            }
                            // 查詢資料庫中的會員資料，根據分頁顯示的起始位置和每頁顯示的資料筆數
                            if (mysqli_num_rows($result) > 0) {
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr id = '" . $row['msge_id'] . "'>";
                                    echo "<td>" . $row['msge_id'] . "</td>";
                                    echo "<td>" . getMemberNameM($row['member_id']) . "</td>";
                                    echo "<td>" . getProNameM($row['product_id']) . "</td>";
                                    echo "<td>" . $row['msge'] . "</td>";
                                    echo "<td>" . $row['msge_date'] . "</td>";
                                    echo "<td class='hide'>" . $row['product_id'] . "</td>";

                                    echo "<td class='button-container'>";
                                    echo "<button class='btn btn-primary re-btn4' data-msg-id='" . $row['msge_id'] . "' onclick=\"openEditModal4(this);\">回覆</button>";
                                    echo "<span class='button-spacing'></span>";
                                    if ($row['member_id'] == $_SESSION["member_id"]) {
                                        echo "<button class='btn btn-primary edit-btn4' data-msg-id='" . $row['msge_id'] . "' onclick=\"openEditModal5(this);\">編輯</button>";
                                        echo "<span class='button-spacing'></span>";
                                    }
                                    echo "<button class='btn btn-primary delete-btn4' data-msg-id='" . $row['msge_id'] . "' onclick=\"deleteMsg(" . $row['msge_id'] . ");\">刪除</button>";
                                    echo "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='6'>暫無數據</td></tr>";
                            }
                            ?>
                        </tbody>
                        <tfoot>
                            <td colspan="6" class="notes">ID*表示管理員 , 共 <?php echo $totalRecords1 ?> 筆使用者資料</td>
                        </tfoot>
                    </table>
                    <!-- 留言表格end -->
                    <!-- 刪除處理 -->
                    <script>
                    function deleteMsg(msge_id) {
                        $(document).ready(function() {
                            if (confirm("確定要刪除留言嗎？")) {
                                $.ajax({
                                    url: 'adminDelete.php',
                                    type: 'POST',
                                    data: {
                                        msge_id: msge_id,
                                        action: "delete4"
                                    },
                                    success: function(response) {
                                        if (response = 4) {

                                            $('.alert').html('留言刪除成功 ! ').addClass('alert-success')
                                                .show().delay(1500).fadeOut();

                                            document.getElementById(msge_id).style.display =
                                                "none";
                                        } else if (response = 0) {
                                            alert("留言刪除失敗 !");
                                        }
                                    }
                                });
                            }
                        });
                    }
                    </script>
                    <!-- 刪除處理end -->

                    <!-- 回覆框框 -->
                    <div class="modal" id="editModal5" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">回覆留言</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- 编辑内容 -->
                                    <form action="adminAdd.php" method="post" onsubmit="return validateFormM2()">
                                        <input type="text" class="form-control hide" name="pro_id" id="pro_id" readonly>
                                        <div class="form-group">
                                            <label for="mail">商品：</label>
                                            <input type="text" class="form-control" name="msge_pro" id="msge_pro"
                                                readonly>
                                        </div>
                                        <div class="form-group">
                                            <label for="mail">會員留言：</label>
                                            <textarea class="form-control" name="msgee" id="msgee" rows="5"
                                                placeholder="" readonly></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="mail">回覆：</label>
                                            <textarea class="form-control" name="re" id="re" rows="5"
                                                placeholder="請回覆"></textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary update-btn5"
                                                name="re_msg">回覆</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">關閉</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 表單驗證 -->
                        <script>
                        function validateFormM2() {
                            var msge = document.getElementById('re').value.trim();

                            var msg = '';

                            if (msge === '') {
                                msg += '不可為空 !\n';
                            }

                            if (msg !== '') {
                                alert(msg);
                                return false;
                            } else {
                                return true;
                            }
                        }
                        //成功訊息
                        $(document).ready(function() {
                            // 檢查是否更新成功
                            const urlParams = new URLSearchParams(window.location.search);
                            const reMsg_success = urlParams.get('reMsg_success');

                            if (reMsg_success === '1') {
                                $('.alert').html('回覆成功 !').addClass('alert-success').show().delay(1500)
                                    .fadeOut();
                                //恢復網址
                                const newURL = window.location.href.replace('?reMsg_success=1', '');
                                history.replaceState({}, document.title, newURL);
                            } else if (reMsg_success === '0') {
                                $('.alert').html('回覆失敗 !').addClass('alert-danger').show().delay(
                                        1500)
                                    .fadeOut();
                                //恢復網址
                                const newURL = window.location.href.replace('?reMsg_success=1', '');
                                history.replaceState({}, document.title, newURL);
                            }
                        });
                        </script>
                        <!-- 表單驗證end -->
                        <script>
                        // modal顯示
                        $(document).ready(function() {
                            $(".re-btn4").click(function() {
                                var msge = $(this).data("msge-id");
                                var row = $(this).closest("tr");
                                var pro_neme = row.find("td:eq(2)").text();
                                var msgee = row.find("td:eq(3)").text();
                                var pro_id = row.find("td:eq(5)").text();

                                $("#msgee").val(msgee);
                                $("#msge_pro").val(pro_neme);
                                $("#pro_id ").val(pro_id);

                                $("#editModal5").modal("show");
                            });
                        });
                        //成功訊息
                        $(document).ready(function() {
                            // 檢查是否更新成功
                            const urlParams = new URLSearchParams(window.location.search);
                            const updateSuccess = urlParams.get('update_success');

                            if (updateSuccess === '5') {
                                $('.alert').html('留言回覆成功 !').addClass('alert-success').show().delay(1500)
                                    .fadeOut();
                                //恢復網址
                                const newURL = window.location.href.replace('?update_success=5', '');
                                history.replaceState({}, document.title, newURL);
                            }
                        });
                        </script>
                    </div>
                    <!-- 回覆框框end -->

                    <!-- 編輯框框 -->
                    <div class="modal" id="editModal4" tabindex="-1" role="dialog">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">編輯留言</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- 编辑内容 -->
                                    <form action="adminUpdate.php" method="post" onsubmit="return validateFormM()">
                                        <div class="form-group">
                                            <label for="username">ID：</label>
                                            <input type="text" class="form-control" name="msge_id" id="msge_id"
                                                readonly>
                                        </div>

                                        <div class="form-group">
                                            <label for="mail">留言：</label>
                                            <textarea class="form-control" name="msge" id="msge" rows="5"
                                                placeholder="請留言"></textarea>
                                        </div>

                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary update-btn4"
                                                name="update_member">更新</button>
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">關閉</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- 表單驗證 -->
                        <script>
                        function validateFormM() {
                            var msge = document.getElementById('msge').value.trim();

                            var msg = '';

                            if (msge === '') {
                                msg += '不可為空 !\n';
                            }

                            if (msg !== '') {
                                alert(msg);
                                return false;
                            } else {
                                return true;
                            }
                        }
                        </script>
                        <!-- 表單驗證end -->
                        <script>
                        // modal顯示
                        $(document).ready(function() {
                            $(".edit-btn4").click(function() {
                                var msge = $(this).data("msge-id");
                                var row = $(this).closest("tr");
                                var msge_id = row.find("td:eq(0)").text();
                                var msgee = row.find("td:eq(3)").text();

                                $("#msge_id").val(msge_id);
                                $("#msge").val(msgee);

                                $("#editModal4").modal("show");
                            });
                        });
                        //成功訊息
                        $(document).ready(function() {
                            // 檢查是否更新成功
                            const urlParams = new URLSearchParams(window.location.search);
                            const updateSuccess = urlParams.get('update_success');

                            if (updateSuccess === '4') {
                                $('.alert').html('留言編輯成功 !').addClass('alert-success').show().delay(1500)
                                    .fadeOut();
                                //恢復網址
                                const newURL = window.location.href.replace('?update_success=4', '');
                                history.replaceState({}, document.title, newURL);
                            }
                        });
                        </script>
                    </div>
                    <!-- 編輯框框end -->

                    <!-- 分頁按鈕 -->
                    <div class="pagination-container">
                        <ul class="pagination justify-content-center">
                            <?php
                            $previousPage = $page - 1;
                            $nextPage = $page + 1;

                            echo "<li class='page-item " . ($page == 1 ? 'disabled' : '') . "'>";
                            echo "<a class='page-link' href='?page=$previousPage#tab-pane-2' aria-label='Previous'>";
                            echo "<span aria-hidden='true'>«</span>";
                            echo "<span class='sr-only'>Previous</span>";
                            echo "</a>";
                            echo "</li>";
                            for ($i = 1; $i <= $totalPages; $i++) {
                                echo "<li class='page-item " . ($page == $i ? 'active' : '') . "'><a class='page-link' href='?page=$i#tab-pane-2'>$i</a></li>";
                            }

                            echo "<li class='page-item " . ($page == $totalPages ? 'disabled' : '') . "'>";
                            echo "<a class='page-link' href='?page=$nextPage#tab-pane-2' aria-label='Next'>";
                            echo "<span aria-hidden='true'>»</span>";
                            echo "<span class='sr-only'>Next</span>";
                            echo "</a>";
                            echo "</li>";
                            ?>
                        </ul>
                    </div>
                    <!-- 分頁按鈕end -->
                </div>
                <!-- 留言管理end -->
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