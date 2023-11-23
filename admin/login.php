<?php
if (!session_id()) session_start();
require_once("./utils/connect.php");
header("Content-type: text/html; charset=utf8");

if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    $sql = "select username,password,role_id from user where username='$username' and password='$password' and status!='2'";
    $result = mysql_query($sql);
    if (mysql_num_rows($result) > 0) {
        if ($row = mysql_fetch_assoc($result)) {
            if ($row["role_id"] == 1) {
                header('Location:admin/db_customer.php');
            }
            if ($row["role_id"] == 2) {
                header('Location:db_customer.php');
            }
        }
    } else {
        $_SESSION['username'] = "";
        $_SESSION['password'] = "";
    }
}


?>
<!DOCTYPE html>
<html lang="zh">
<?php include 'com_head.php' ?>
<body>

<!-- Main Wrapper -->
<div class="main-wrapper login-body">
    <div class="login-wrapper">
        <div class="container">
            <img class="img-fluid logo-dark mb-2" src="assets/img/logo.png" alt="Logo">
            <div class="loginbox">
                <div class="login-right">
                    <div class="login-right-wrap">
                        <h1>登录</h1>
                        <form>
                            <div class="form-group">
                                <label class="form-control-label">用户名</label>
                                <input type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-control-label">密码</label>
                                <div class="pass-group">
                                    <input type="password" name="password" class="form-control pass-input">
                                    <span class="fas fa-eye toggle-password"></span>
                                </div>
                            </div>
                            <button id="submit" class="btn btn-lg btn-block btn-primary" type="button">登录</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Main Wrapper -->


<!-- jQuery -->
<script src="assets/js/jquery-3.5.1.min.js"></script>
<!-- Bootstrap Core JS -->
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
<!-- Feather Icon JS -->
<script src="assets/js/feather.min.js"></script>
<!-- Custom JS -->
<script src="assets/js/script.js"></script>

<script>
    $("#submit").on("click", function () {
        let username = $("input[name='username']").val();
        let password = $("input[name='password']").val();
        if (username === "") {
            alert("请输入用户名");
            return;
        }
        if (password === "") {
            alert("请输入密码");
            return;
        }

        $.post("api/dologin.php", {username, password}, function (data) {
            if (data.code === 200) {
                window.location.href = "db_customer.php";
            } else {
                alert(data.message);
            }
        })
    })
</script>

</body>
</html>