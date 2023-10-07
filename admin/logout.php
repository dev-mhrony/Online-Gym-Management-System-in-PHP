<?php
session_start();
require_once('include/config.php');
session_destroy();
header("location: login.php");
exit();
?>