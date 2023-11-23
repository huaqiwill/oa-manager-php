<?php
include("../connect.php");
session_start();

$sql_insert = "insert into user(username,password,email,tel,status,number,oname,otel) values('" . $_POST['username'] . "','" . $_POST['password'] . "','" . $_POST['email'] . "','" . $_POST['tel'] . "','0','" . $_POST['number'] . "','" . $_POST['oname'] . "','" . $_POST['otel'] . "')";
$result = mysql_query($sql_insert);    //执行SQL语句

echo "<script>window.location='db_user.php';</script>";
?>
