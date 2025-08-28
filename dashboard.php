<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: login.html");
    exit();
}

echo "<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Uplonix</title>
</head>
<body>
    <h2>Welcome, " . $_SESSION['user'] . "!</h2>
    <p>This is your dashboard.</p>
    <a href='logout.php'>Logout</a>
</body>
</html>";
?>
