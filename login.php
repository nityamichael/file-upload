<?php
session_start();
require_once "includes/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['first_name'] . " " . $row['last_name'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "❌ Wrong password!";
        }
    } else {
        echo "⚠️ User not found!";
    }
}
?>
