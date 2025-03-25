<?php 
    include 'connection.php';

    if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
        $id = $_GET['id'];
        $query = "SELECT * FROM movies WHERE movie_id=$id";
        $result = mysqli_query($connect, $query);
        
        if ($result->num_rows > 0) {
            $movie = $result->fetch_assoc();
        } else {
            die("Movie not found.");
        }
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $id = $_POST['id'];
        $title = mysqli_real_escape_string($connect, $_POST['title']);
        $language = mysqli_real_escape_string($connect, $_POST['language']);
        $description = mysqli_real_escape_string($connect, $_POST['description']);
        $rel_date = mysqli_real_escape_string($connect, $_POST['rel_date']);
        $budget = mysqli_real_escape_string($connect, $_POST['budget']);
        $revenue = mysqli_real_escape_string($connect, $_POST['revenue']);
        $rating = mysqli_real_escape_string($connect, $_POST['rating']);
        $studio_id = mysqli_real_escape_string($connect, $_POST['studio_id']);
        


        $query = "UPDATE movies SET 
            title='$title', 
            original_language='$language', 
            description='$description', 
            release_date='$rel_date', 
            revenue='$revenue', 
            budget='$budget', 
            rating='$rating', 
            studio_id='$studio_id' 
            WHERE movie_id=$id";

        $result = mysqli_query($connect, $query);

        if ($result) {
            header("Location: admin.php");
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
    <title>Edit Movie</title>

    <!-- Bootstrap CDN CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/styles.css">
</head>

<body>
    <?php include 'adminnav.php'; ?>

    <div class="container my-5 d-flex justify-content-center">
        <div class="card p-4 edit-card">
            <h2 class="text-center mb-4">Edit Movie</h2>

            <form action="editmovie.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $movie['movie_id']; ?>">

                <div class="mb-3">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" name="title" class="form-control" value="<?php echo htmlspecialchars($movie['title']); ?>">
                </div>

                <div class="mb-3">
                    <label for="language" class="form-label">Original Language:</label>
                    <input type="text" name="language" class="form-control" value="<?php echo htmlspecialchars($movie['original_language']); ?>">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <input type="text" name="description" class="form-control" value="<?php echo htmlspecialchars($movie['description']); ?>">
                </div>

                <div class="mb-3">
                    <label for="rel_date" class="form-label">Released Date:</label>
                    <input type="date" name="rel_date" class="form-control" value="<?php echo $movie['release_date']; ?>">
                </div>

                <div class="mb-3">
                    <label for="budget" class="form-label">Budget:</label>
                    <input type="number" name="budget" class="form-control" value="<?php echo $movie['budget']; ?>">
                </div>

                <div class="mb-3">
                    <label for="revenue" class="form-label">Revenue:</label>
                    <input type="number" name="revenue" class="form-control" value="<?php echo $movie['revenue']; ?>">
                </div>

                <div class="mb-3">
                    <label for="rating" class="form-label">Rating:</label>
                    <input type="number" step="0.1" name="rating" class="form-control" value="<?php echo $movie['rating']; ?>">
                </div>

                <div class="mb-3">
                    <label for="studio_id" class="form-label">Select Studio</label>
                    <select name="studio_id" required class="form-control">
                        <?php 
                        $studios = $connect->query("SELECT * FROM studios");
                        while ($studio = $studios->fetch_assoc()) : 
                        ?>
                            <option value="<?= $studio['studio_id']; ?>" <?= $studio['studio_id'] == $movie['studio_id'] ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($studio['studio_name']); ?>
                            </option>
                        <?php endwhile; ?>
                    </select>
               </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image:</label>
                    <input type="file" id="image" name="image" class="form-control">
                    <?php if (!empty($movie['imgurl'])): ?>
                        <img src="<?php echo $movie['imgurl']; ?>" class="mt-2 img-thumbnail" width="100">
                    <?php endif; ?>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary w-50">Update</button>
                    <a href="admin.php" class="btn btn-secondary w-45">Cancel</a>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYBBdMx3m8bzzp3f5f5rhzT9g8FF93zX2Q3EzI3BeFf4hK51/ZzJvB3J9" crossorigin="anonymous"></script>
</body>
</html>
