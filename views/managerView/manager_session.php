<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'manager') {
    header("Location: ../../login-register-interview2/login.php");
    exit();
}
?>
