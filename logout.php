<?php
include './utils/check.php';
session_destroy();
echo '<script>window.location="login.php";</script>';
