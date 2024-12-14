<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'staff') {
    header("Location: login.php");
    exit();
}
echo "<h1>Welcome, Staff " . htmlspecialchars($_SESSION['username']) . "!</h1>";
?>
<p>This is the staff dashboard.</p>
<a href='logout.php'>Logout</a>
