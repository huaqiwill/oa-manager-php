<?php
include("../connect.php");
session_start();

$sql_insert = "insert into goods(name,price,vprice,num) values('" . $_POST['name'] . "','" . $_POST['price'] . "','" . $_POST['vprice'] . "','" . $_POST['num'] . "')";
$result = mysql_query($sql_insert);    //执行SQL语句

echo "<script>window.location='goods.php';</script>";
?>
