<?php
  include('connection.php');

  $studios = $connect->query("SELECT * FROM studios");

  function uploadImage($file) {
    $targetDir = "uploads/";
    if (!is_dir($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    $targetFile = $targetDir . basename($file["name"]);
    move_uploaded_file($file["tmp_name"], $targetFile);
    return $targetFile;
    }
  
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $language = $_POST['language'];
    $description = $_POST['description']; 
    $rel_date = $_POST['rel_date'];  
    $budget = $_POST['budget'];  
    $revenue = $_POST['revenue'];  
    $rating = $_POST['rating'];   
    $studio_id = $_POST['studio_id'];

    $imagePath = "";
    if (!empty($_FILES['image']['name'])) {
        $imagePath = uploadImage($_FILES['image']);
    }

    $query = "INSERT INTO movies (title, original_language, description , release_date, budget, revenue, rating, imgurl,  studio_id) 
            VALUES ('$title', '$language',  '$description','$rel_date', '$budget', '$revenue', '$rating', '$imagePath' ,'$studio_id')";
    $result = mysqli_query($connect, $query);
    if ($result) {
        header("Location:admin.php?success=Movie added successfully!");
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
    <title>Add Movie</title>

    <!-- Bootstrap CDN CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">
</head>

<body>

    <?php
    include 'adminnav.php';
    ?>
  
    <?php 
        include 'connection.php';
        $query = 'SELECT * FROM movies';
        $movies = mysqli_query($connect, $query);
    ?>

    <div class="container d-flex justify-content-center align-items-center my-5">
        <div class="card p-4 shadow-lg border-0 rounded-3" style="max-width: 400px; width: 100%;">
            <h2 class="text-center mb-4">Add Movie</h2>

            <?php if (isset($_GET['error'])): ?>
                <div class="alert alert-danger text-center">
                    <?= htmlspecialchars($_GET['error']) ?>
                </div>
            <?php endif; ?>

            <form action="addmovie.php" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="language" class="form-label">Original Language:</label>
                    <input type="text" name="language" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <input type="text" name="description" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="rel_date" class="form-label">Released Date:</label>
                    <input type="date" name="rel_date" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="budget" class="form-label">Budget:</label>
                    <input type="number" name="budget" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="revenue" class="form-label">Revenue:</label>
                    <input type="number" name="revenue" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="rating" class="form-label">Rating:</label>
                    <input type="number" name="rating" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="studio_id" class="form-label">Select Studio</label>
                    <select name="studio_id" required class="form-control">
                        <?php while ($studio = $studios->fetch_assoc()) : ?>
                            <option value="<?= $studio['studio_id'] ?>"><?= $studio['studio_name'] ?></option>
                        <?php endwhile; ?>
                    </select>
               </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image:</label>
                    <input type="file" id="image"  name="image" class="form-control">
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50">Add</button>
                    <a href="admin.php" class="btn btn-secondary w-45">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap CDN JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYBBdMx3m8bzzp3f5f5rhzT9g8FF93zX2Q3EzI3BeFf4hK51/ZzJvB3J9" crossorigin="anonymous"></script>
</body>
</html>
