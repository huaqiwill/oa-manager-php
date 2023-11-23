<?php
include './utils/check.php';
check_login();
header_html();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include './utils/db_customer.php';
    include './utils/result.php';
    $a = substr($_SERVER["QUERY_STRING"], 3);
    if (customer_delete($a)) {
        exit(ret_ok("删除成功"));
    } else {
        exit(ret_err("系统繁忙，请稍候！"));
    }
} else {
    exit();
}