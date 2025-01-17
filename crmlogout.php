<?php
session_start();
session_destroy();
header("Location: crmlogin.php");
exit();
?>