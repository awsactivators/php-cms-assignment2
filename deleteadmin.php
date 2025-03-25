<?php
include 'connection.php';

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: users.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $query = "DELETE FROM users WHERE id = ?";

    if ($stmt = mysqli_prepare($connect, $query)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header("Location: users.php");
        exit();
    } else {
        die("Failed to delete: " . mysqli_error($connect));
    }
} else {
    header("Location: users.php?error=Invalid request.");
    exit();
}
?>
