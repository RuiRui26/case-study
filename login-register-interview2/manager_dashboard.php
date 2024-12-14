<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'manager') {
    header("Location: login.php");
    exit();
}
echo "<h1>Welcome, Manager " . htmlspecialchars($_SESSION['username']) . "!</h1>";
?>
<p>This is the manager dashboard.</p>
<a href='logout.php'>Logout</a>
