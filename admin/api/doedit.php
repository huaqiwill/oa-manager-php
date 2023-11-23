<?php
header("Content-type: text/html; charset=utf8");


// 如果 upload 目录不存在该文件则将文件上传到 upload 目录下

$a = substr($_SERVER["QUERY_STRING"], 3);

include_once("../connect.php");

$sql_insert = "update user set username='" . $_POST['username'] . "',password='" . $_POST['password'] . "' ,tel='" . $_POST['tel'] . "' ,email='" . $_POST['email'] . "' ,number='" . $_POST['number'] . "' ,oname='" . $_POST['oname'] . "' ,otel='" . $_POST['otel'] . "' where  id='" . $a . "'";

$res_insert = mysql_query($sql_insert);


if ($res_insert) {
    echo '<script>window.location="db_user.php";</script>';
} else {
    echo '<script>window.location="db_user.php";</script>';
}


?>