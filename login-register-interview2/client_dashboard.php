<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] != 'client') {
    header("Location: login.php");
    exit();
}
echo "<h1>Welcome, Client " . htmlspecialchars($_SESSION['username']) . "!</h1>";
?>
<p>This is the client dashboard.</p>
<a href='logout.php'>Logout</a>
