<?php
$mysqli = new mysqli("localhost", "root", "", "bsit");

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

if (isset($_GET['id'])) {
    $movie_id = $_GET['id'];
    $query = "SELECT * FROM movie1 WHERE id = $movie_id";
    $result = $mysqli->query($query);

    if ($result) {
        $movie = $result->fetch_assoc();
    } else {
        echo "Movie not found.";
        exit();
    }
} else {
    echo "Invalid movie ID.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $movie['title']; ?></title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            text-align: center;
        }
        .movie-poster {
            max-width: 50%;
            height: auto;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .movie-details {
            text-align: left;
        }
        .movie-details h2 {
            margin: 10px 0;
            color: #333;
        }
        .movie-details p {
            margin: 5px 0;
            color: #666;
        }
        .movie-screenshot {
            margin-top: 20px;
            max-width: 100%;
            height: auto;
            border-radius: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="<?php echo $movie['poster']; ?>" alt="<?php echo $movie['title']; ?>" class="movie-poster">
        <div class="movie-details">
            <h2><?php echo $movie['title']; ?></h2>
            <p><strong>Genre:</strong> <?php echo $movie['genre']; ?></p>
            <p><strong>Release Year:</strong> <?php echo $movie['release_year']; ?></p>
            <p><strong>Director:</strong> <?php echo $movie['director']; ?></p>
            <p><strong>Note:</strong> <?php echo $movie['note']; ?></p>
        </div>
        <div class="movie-screenshot">
            <img src="path_to_screenshot.jpg" alt="Movie Screenshot" class="movie-screenshot">
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
