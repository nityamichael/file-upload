<?php
session_start();
require_once "includes/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    $sql = "SELECT * FROM users WHERE email=?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($row = mysqli_fetch_assoc($result)) {
        if (password_verify($password, $row['password'])) {
            $_SESSION['user'] = $row['first_name'] . " " . $row['last_name'];

            // Redirect param handle
            if (!empty($_POST['redirect']) && $_POST['redirect'] === 'upload') {
                header("Location: index.php");
            } else {
                header("Location: index.php"); // 👈 dashboard.php ke bajay main page
            }
            exit;
        } else {
            header("Location: login.html?error=wrong"); // ❌ password
            exit;
        }
    } else {
        header("Location: login.html?error=notfound"); // ⚠️ user not found
        exit;
    }
}


?>