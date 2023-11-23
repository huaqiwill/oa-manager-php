<?php
include "../utils/check.php";
check_login();
header_html();

include_once("../utils/connect.php");
$id = substr($_SERVER["QUERY_STRING"], 3);
$sql_query = "update user set status='2' where id='$id'";
$result = mysql_query($sql_query);
if ($result) {
    echo "<script>window.location='db_user.php';</script>";
} else {
    echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
}
