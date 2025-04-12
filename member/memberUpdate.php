<!-- 按下更新處理 -->
<?php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_member"])) {
    $username = $_POST["username"];
    $userpwd = $_POST["userpwd"];
    $name = $_POST["name"];
    $sex = $_POST["sex"];
    $birthday = $_POST["birthday"];
    $tel_num = $_POST["tel_num"];
    $addr = $_POST["addr"];
    $email = $_POST["email"];
    $member_id = $_POST["member_id"];
    $userpwdHash = password_hash($userpwd, PASSWORD_DEFAULT);

    // 更新
<<<<<<< HEAD
    if($userpwd == "00000000")
=======
    if($userpwd = "00000000")
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26
    {
        $sql = "UPDATE member SET username='$username', member_name='$name', sex='$sex', birthday='$birthday', tel_num='$tel_num', addr='$addr', mail='$email' WHERE member_id=$member_id";
    }
    else
    {
<<<<<<< HEAD
        $sql = 'UPDATE member SET username="'.$username.'", password="'.$userpwdHash.'", member_name="'.$name.'", sex="'.$sex.'", birthday="'.$birthday.'", tel_num="'.$tel_num.'", addr="'.$addr.'", mail="'.$email.'" WHERE member_id="'.$member_id.'"';
=======
        $sql = "UPDATE member SET username='$username', password='$userpwdHash', member_name='$name', sex='$sex', birthday='$birthday', tel_num='$tel_num', addr='$addr', mail='$email' WHERE member_id=$member_id";
>>>>>>> ee5dd2b08f67d3f9b417178e0b49084fccd42e26
    }
    
    if (mysqli_query($conn, $sql)) {
        // 更新成功
        echo "<script>alert('更新成功 !');</script>";
        header("Location:../member.php");
        exit;
    } else {
        // 更新失败
        echo "<script>alert('更新失敗 ! ');</script>";
    }
}
?>
<!-- 按下更新處理 -->