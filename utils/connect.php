<?php

$C = include('config.php');
$host = $C['DB_HOST'];
$db_user = $C['DB_USER'];
$db_pass = $C['DB_PASSWORD'];
$db_name = $C['DB_NAME'];
$timezone = "Asia/Shanghai";

$link = mysql_connect($host, $db_user, $db_pass);
mysql_select_db($db_name, $link);
mysql_query("set names UTF8");
