<?php
require_once '../include/config.php';

unset($_SESSION['login']);
notify_alert('Logout Successfully','success','3000','Close');
header("Location:../login.php");
exit();
