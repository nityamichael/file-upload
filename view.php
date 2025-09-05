<?php
require_once "includes/db_connect.php"; 

$sql = "SELECT id, file_name FROM files ORDER BY uploaded_at DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>View Uploaded Files</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Uploaded Files</h2>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>#</th>
                <th>File Name</th>
                <th>Download</th>
            </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($result) > 0){
            $count = 1;
            while($row = mysqli_fetch_assoc($result)){
                $file = "uploads/" . $row['file_name']; // path
                echo "<tr>";
                echo "<td>{$count}</td>";
                echo "<td>{$row['file_name']}</td>";
                echo "<td><a href='{$file}' download class='btn btn-success btn-sm'>Download</a></td>";
                echo "</tr>";
                $count++;
            }
        } else {
            echo "<tr><td colspan='3'>No files uploaded yet.</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>
</body>
</html>
