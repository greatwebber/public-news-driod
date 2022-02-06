<?php
require_once '../include/config.php';

error_reporting(0);

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1100)) {
    // last request was more than 30 minutes ago
    session_unset();     // unset $_SESSION variable for the run-time
    session_destroy();

    notify_alert('Session Timeout','danger','3000','close');
    header("Location:../login.php");
    exit();
}
$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp