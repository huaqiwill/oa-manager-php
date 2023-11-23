<?php
include './utils/check.php';
check_login();
header_html();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include './utils/db_order.php';
    include './utils/result.php';

    $id = substr($_SERVER["QUERY_STRING"], 3);
    $result = order_delete($id);
    if ($result) {
        exit(ret_ok("删除成功"));
    } else {
        exit(ret_err("系统繁忙，请稍候！"));
    }
} else {
    exit();
}
