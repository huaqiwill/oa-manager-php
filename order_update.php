<?php
include './utils/check.php';
check_login();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include("./utils/db_order.php");

    if (isset($_POST['id']) && isset($_POST['num'])) {
        $cid = $_POST['id'];
        $num = $_POST['num'];
        $username = $_SESSION['username'];
        $result = cart_update($num, $cid, $username);
        if ($result) {
            ret_ok("修改成功");
        } else {
            ret_err("修改失败");
        }
    }
} else {
    exit();
}


