<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']); 
    $query = "DELETE FROM movies WHERE movie_id = ?";
    
    if ($stmt = mysqli_prepare($connect, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("Location: admin.php");
        exit();
    } else {
        die("Failed to delete: " . mysqli_error($connect));
    }
}
?>
