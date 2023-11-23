<?php
include "../utils/check.php";
check_login();
header_html();

include_once("../utils/connect.php");
$a = substr($_SERVER["QUERY_STRING"], 3);
$ti = date('Y-m-d');
$sql_query = "update ding set date03='" . $ti . "' where id='" . $a . "'";
$result = mysql_query($sql_query);
if ($result) {
    echo "<script>window.location='db_customer.php';</script>";
} else {
    echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
}
