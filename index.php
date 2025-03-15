<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movies</title>

    <!-- Bootstrap CDN CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
</head>

<body>
    <div class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col">
                    <!-- Page Title -->
                    <h1 class="display-5 text-center mt-2">Movie with Studio Details</h1>
                </div>
            </div>
            <div class="row">

                <?php
                
                include './connection.php';
                
                // Query to fetch movie details along with the associated studio details
                $query =    'SELECT 
                                m.movie_id,
                                m.title,
                                m.original_language,
                                m.release_date,
                                m.budget,
                                m.revenue,
                                m.rating,
                                m.description,
                                m.imgurl,
                                s.studio_name,
                                s.studio_country,
                                s.studio_year
                            FROM movies m
                            INNER JOIN studios s ON m.studio_id = s.studio_id';
                
                // Execute the query
                $movies = mysqli_query($connect, $query);
                
                // Language mapping array to convert language codes to full names 
                $languages = [
                    'af' => 'Afrikaans',
                    'ar' => 'Arabic',
                    'cn' => 'Chinese (Mandarin)',
                    'cs' => 'Czech',
                    'da' => 'Danish',
                    'de' => 'German',
                    'el' => 'Greek',
                    'en' => 'English',
                    'es' => 'Spanish',
                    'fa' => 'Persian (Farsi)',
                    'fr' => 'French',
                    'he' => 'Hebrew',
                    'hi' => 'Hindi',
                    'hu' => 'Hungarian',
                    'id' => 'Indonesian',
                    'is' => 'Icelandic',
                    'it' => 'Italian',
                    'ja' => 'Japanese',
                    'ko' => 'Korean',
                    'ky' => 'Kyrgyz',
                    'nb' => 'Norwegian Bokmål',
                    'nl' => 'Dutch',
                    'no' => 'Norwegian',
                    'pl' => 'Polish',
                    'ps' => 'Pashto',
                    'pt' => 'Portuguese',
                    'ro' => 'Romanian',
                    'ru' => 'Russian',
                    'sl' => 'Slovenian',
                    'sv' => 'Swedish',
                    'ta' => 'Tamil',
                    'te' => 'Telugu',
                    'th' => 'Thai',
                    'tr' => 'Turkish',
                    'vi' => 'Vietnamese',
                    'xx' => 'English',
                    'zh' => 'Chinese'
                ];
                
                // Loop through the retrieved movies from DB and display them
                foreach ($movies as $movie) {
                    // Convert language code to full language name
                    $language = "";
                    if (array_key_exists($movie['original_language'], $languages)) {
                        $language = $languages[$movie['original_language']];
                    } else {
                        // Default to English if language code is not found
                        $language = "English";
                    }
                   
                    
                    echo '<div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card shadow-lg border-0 rounded-3 mb-4 mt-2 h-100">
                                <img src="'.$movie['imgurl'].'" />
                                <div class="card-header text-white text-center py-3" style="background: linear-gradient(135deg, #007bff, #0056b3); border-top-left-radius: 10px; border-top-right-radius: 10px;">
                                    <h5 class="mb-0 fw-bold"><i class="bi bi-film"></i> ' . $movie['title'] . '</h5>
                                </div>

                                <div class="card-body d-flex flex-column p-4">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item py-3"><i class="bi bi-calendar-event-fill"></i> <strong> Release Date:</strong> ' . $movie['release_date'] . '</li>
                                        <li class="list-group-item py-3"><i class="bi bi-cash-stack"></i> <strong> Budget:</strong> $' . (round($movie['budget'] / 1000000) + 1) . ' Million</li>
                                        <li class="list-group-item py-3"><i class="bi bi-graph-up-arrow"></i> <strong> Revenue:</strong> $' . (round($movie['revenue'] / 1000000) + 1) . ' Million</li>
                                        <li class="list-group-item py-3"><i class="bi bi-star-fill text-warning"></i> <strong> Rating:</strong> ' . $movie['rating'] . ' / 10</li>
                                        <li class="list-group-item py-3"><i class="bi bi-translate"></i> <strong> Language:</strong> ' . $language . '</li>
                                        <li class="list-group-item py-3"><i class="bi bi-card-text"></i> <strong> Overview:</strong> ' . $movie['description'] . '</li>
                                    </ul>

                                    <div class="mt-4 p-3 bg-light rounded-3">
                                        <h6 class="text-muted fw-bold text-center p-3"><i class="bi bi-building"></i> Studio Details</h6>
                                        <p class="mb-2"><i class="bi bi-house-fill"></i> <strong> Name:</strong> ' . $movie['studio_name'] . '</p>
                                        <p class="mb-2"><i class="bi bi-geo-alt-fill"></i> <strong> Country:</strong> ' . $movie['studio_country'] . '</p>
                                        <p class="mb-0"><i class="bi bi-clock-history"></i> <strong> Established:</strong> ' . $movie['studio_year'] . '</p>
                                    </div>
                                </div>
                            </div>
                        </div>';

                }
                ?>
            </div>
        </div>
    </div>




</body>

</html>