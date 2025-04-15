<?php 
    include 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM users WHERE id=$id";
        $result = mysqli_query($connect, $query);
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
        } else {
            die("Admin not found.");
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $email = mysqli_real_escape_string($connect, $_POST['email']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);       


        $query = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id='$id'";

        $result = mysqli_query($connect, $query);

        if ($result) {
            header("Location:users.php");
            exit();
        } else {
            echo "Failed: " . mysqli_error($connect);
        }
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin</title>

    <!-- Bootstrap CDN CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">

     <!-- FontAwesome -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include 'adminnav.php'; ?>

    <div class="container my-5 d-flex justify-content-center">
        <div class="card p-4 edit-card login-card">
            <h2 class="text-center mb-4">Edit Admin</h2>

            <form action="editadmin.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($user['username']); ?>">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email Id:</label>
                    <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" name="password" class="form-control" value="<?php echo htmlspecialchars($user['password']); ?>">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50">Update</button>
                    <a href="users.php" class="btn btn-secondary w-45">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYBBdMx3m8bzzp3f5f5rhzT9g8FF93zX2Q3EzI3BeFf4hK51/ZzJvB3J9" crossorigin="anonymous"></script>
</body>
</html>
