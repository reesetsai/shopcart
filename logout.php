<?php
session_start();
session_destroy();
header('Location: http://192.168.86.128/ss/index.php');
?>