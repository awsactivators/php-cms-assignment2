<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:ital,wght@0,300;0,400;0,500;0,700;1,300;1,400;1,500;1,700&display=swap" rel="stylesheet">

    <!-- Custom Script -->
    <link rel="stylesheet" href="./styles/styles.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">Vintage Movie</a>
        <div class="d-flex">
          <a href="login.php" class="btn btn-primary">Login</a>
        </div>
      </div>
    </nav>

    <div class="container mt-4">
        <h1 class="text-center mb-4 title">Movie List</h1>
        <div class="row" id="movieContainer">
            <?php
            include './connection.php';

            $moviesPerPage = 9;
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $offset = ($page - 1) * $moviesPerPage;

            $query = "SELECT 
                        m.movie_id, m.title, m.original_language, m.release_date,
                        m.budget, m.revenue, m.rating, m.description, m.imgurl,
                        s.studio_name, s.studio_country, s.studio_year
                      FROM movies m
                      INNER JOIN studios s ON m.studio_id = s.studio_id
                      LIMIT $moviesPerPage OFFSET $offset";

            $movies = mysqli_query($connect, $query);

            foreach ($movies as $movie) {
                echo '
                <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                    <div class="card movie-card">
                        <div class="card-header text-center">
                            <h5>' . $movie['title'] . '</h5>
                        </div>
                        <div class="card-body movie-body">
                            <img src="' . $movie['imgurl'] . '" class="movie-img" alt="Movie Poster">
                            <div class="movie-description">
                                <p>' . substr($movie['description'], 0, 100) . '...</p>
                                <button class="btn btn-primary view-details" 
                                    data-title="' . $movie['title'] . '" 
                                    data-img="' . $movie['imgurl'] . '" 
                                    data-description="' . $movie['description'] . '" 
                                    data-release="' . $movie['release_date'] . '" 
                                    data-budget="' . $movie['budget'] . '" 
                                    data-revenue="' . $movie['revenue'] . '" 
                                    data-rating="' . $movie['rating'] . '" 
                                    data-studio="' . $movie['studio_name'] . '"
                                    data-country="' . $movie['studio_country'] . '"
                                    data-year="' . $movie['studio_year'] . '">
                                    View All
                                </button>
                            </div>
                        </div>
                    </div>
                </div>';
            }
            ?>

        </div>

        <!-- Pagination -->
        <nav>
            <ul class="pagination justify-content-center">
                <?php
                $result = mysqli_query($connect, "SELECT COUNT(*) AS total FROM movies");
                $totalMovies = mysqli_fetch_assoc($result)['total'];
                $totalPages = ceil($totalMovies / $moviesPerPage);

                if ($page > 1) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '">Previous</a></li>';
                }

                echo '<li class="page-item disabled"><span class="page-link"> ' . $page . '/' . $totalPages . ' </span></li>';

                if ($page < $totalPages) {
                    echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '">Next</a></li>';
                }
                ?>
            </ul>
        </nav>
    </div>

    <!-- Movie Details Modal -->
    <div class="modal fade" id="movieModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="movieTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body text-center">
                    <img id="movieImage" class="img-fluid mb-3">
                    <p id="movieDescription"></p>
                    <p><strong>Release Date:</strong> <span id="movieRelease"></span></p>
                    <p><strong>Budget:</strong> $<span id="movieBudget"></span></p>
                    <p><strong>Revenue:</strong> $<span id="movieRevenue"></span></p>
                    <p><strong>Rating:</strong> <span id="movieRating"></span>/10</p>
                    <div class="studioDetails">
                      <p class="studioTitle"><strong>Studio Details</strong></p>
                      <p><strong>Studio:</strong> <span id="movieStudio"></span></p>
                      <p><strong>Country:</strong> <span id="movieCountry"></span></p>
                      <p><strong>Established:</strong> <span id="movieYear"></span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/script.js"></script>

</body>
</html>
