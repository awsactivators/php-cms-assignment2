<?php

include 'connection.php';
session_start();

if (!isset($_SESSION['id'])) {
    header("Location: users.php");
    exit();
} 

$query = "SELECT `id`, `username`, `email`, `password` FROM users";
$result = mysqli_query($connect, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

     <!-- FontAwesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

    <!-- Custom Styles -->
    <link rel="stylesheet" href="./styles/styles.css">
</head>
<body>

    <?php include 'adminnav.php'; ?>

    <div class="container mt-4">
        <h1 class="text-center title">Admin Management</h1>

        <div class="row" id="userContainer">
            <?php while ($user = mysqli_fetch_assoc($result)): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card user-card">
                        <div class="card-header text-center">
                            <h5><?php echo htmlspecialchars($user['username']); ?></h5>
                        </div>
                        <div class="card-body user-body">
                            <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
                            <div class="users-btns">
                                <a href="editadmin.php?id=<?php echo $user['id']; ?>" class="btn edit-btn">Edit</a>
                                <button type="button" class="btn dlt-btn" 
                                    data-id="<?php echo $user['id']; ?>" 
                                    data-username="<?php echo htmlspecialchars($user['username']); ?>" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#deleteModal">
                                    Delete
                                </button>

                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete "<strong id="usernameToDelete"></strong>"?</p>
                </div>
                <div class="modal-footer">
                    <form id="deleteForm" method="POST" action="deleteadmin.php">
                        <input type="hidden" name="id" id="deleteUserId">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/script.js"></script>
</body>
</html>