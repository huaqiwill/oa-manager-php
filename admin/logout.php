<?php
include '../utils/check.php';
check_login();
session_destroy();
echo '<script>window.location="../public/login.php";</script>';
?>