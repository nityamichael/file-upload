<?php



require_once "includes/db_connect.php"; // DB connection

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['fileInput'])) {

    $targetDir = "uploads/";
    if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

    $fileName = basename($_FILES["fileInput"]["name"]);
    $fileTmp  = $_FILES["fileInput"]["tmp_name"];
    $fileSize = $_FILES["fileInput"]["size"];
    $fileType = $_FILES["fileInput"]["type"];
    $targetFile = $targetDir . $fileName;

    if (move_uploaded_file($fileTmp, $targetFile)) {

        // ✅ Folder me save ho gaya
        // DB me save karna
        $sql = "INSERT INTO files (file_name, file_type, file_size) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "ssi", $fileName, $fileType, $fileSize);

        if (mysqli_stmt_execute($stmt)) {
            echo "✅ File uploaded successfully and DB updated!";
        } else {
            echo "❌ File uploaded but DB error: " . mysqli_error($conn);
        }

    } else {
        echo "❌ Error uploading file to folder!";
    }

} else {
    echo "⚠️ No file selected.";
}
?>
