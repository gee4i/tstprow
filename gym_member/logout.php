<?php
session_start();
session_destroy();
header("Location: http://172.20.10.3/gym_system/login.php");
exit();
?>
