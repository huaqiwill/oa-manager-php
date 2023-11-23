<?php
include "../utils/check.php";
check_login();
header_html();

include_once("../connect.php");

$a = substr($_SERVER["QUERY_STRING"], 3);

$sql_query = "delete from goods where id='" . $a . "'";
$result = mysql_query($sql_query);
if ($result) {
    echo "<script>window.location='goods.php';</script>";
} else {
    echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
}


?>