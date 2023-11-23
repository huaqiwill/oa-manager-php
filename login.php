<?php
require './utils/common.php';
session_on();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require './utils/db_user.php';
    require './utils/result.php';

    $username = $_POST['username'];
    $password = $_POST['password'];
    if ($data = user_login($username, $password)) {
        $_SESSION["username"] = $username;
        $_SESSION["password"] = $password;
        ret_ok("登录成功", $data);
    } else {
        ret_err("用户名或密码错误");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //进行登录校验
    if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
        $data = array(
            "username" => $_SESSION['username'],
            "password" => $_SESSION['password']
        );
        $response = request_post("http://www.cms.com/login.php", $data);
        if ($response['code'] == 200) {
            //校验成功
            if ($response['data']['role_id'] == 1) {
                echo "<script>location.href='admin/index.php'</script>";
            } else {
                echo "<script>location.href='index.php'</script>";
            }
        } else {
            session_destroy();
        }
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
                                <label class="form-control-label" for="username">用户名</label>
                                <input id="username" type="text" name="username" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="password" class="form-control-label">密码</label>
                                <div class="pass-group">
                                    <input id="password" type="password" name="password"
                                           class="form-control pass-input">
                                    <span class="fas fa-eye toggle-password"></span>
                                </div>
                            </div>
                            <button onclick="login()" class="btn btn-lg btn-block btn-primary" type="button">登录</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Main Wrapper -->

<?php include 'com_script.php' ?>

<script>
    $(document).ready(function () {

    })

    function login() {
        let username = $("input[name='username']").val();
        let password = $("input[name='password']").val();
        if (username === "") {
            return alert("请输入用户名");
        }
        if (password === "") {
            return alert("请输入密码");
        }
        $.ajax({
            url: "login.php",
            type: "POST",
            data: {
                username, password
            },
            success: function (data) {
                if (data.code === 200) {
                    if (parseInt(data.data.role_id) === 1) {
                        window.location.href = 'admin/index.php';
                    } else {
                        window.location.href = 'index.php';
                    }
                } else {
                    alert(data.message);
                }
            }
        })
    }
</script>

</body>
</html>