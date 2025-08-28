<?php
require_once "includes/db_connect.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = $_POST['firstName'];
    $lastName  = $_POST['lastName'];
    $email     = $_POST['email'];
    $password  = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Password confirm check
    if($password !== $confirmPassword){
        echo "❌ Passwords do not match!";
        exit();
    }

    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Check if email already exists
    $check = mysqli_prepare($conn, "SELECT id FROM users WHERE email=?");
    mysqli_stmt_bind_param($check, "s", $email);
    mysqli_stmt_execute($check);
    mysqli_stmt_store_result($check);

    if (mysqli_stmt_num_rows($check) > 0) {
        echo "⚠️ Email already registered!";
        exit();
    }

    $sql = "INSERT INTO users (first_name, last_name, email, password) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $firstName, $lastName, $email, $passwordHash);

    if (mysqli_stmt_execute($stmt)) {
        echo "✅ Registration successful. <a href='login.html'>Login here</a>";
    } else {
        echo "❌ Error: " . mysqli_error($conn);
    }
}
?>
