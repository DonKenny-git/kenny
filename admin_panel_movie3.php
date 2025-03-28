<?php
$mysqli = new mysqli("localhost", "root", "", "bsit");

if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Check if form is submitted for adding new movie
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['add_movie'])) {
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $release_year = $_POST['release_year'];
        $director = $_POST['director'];
        $note = $_POST['note'];

        // Upload poster
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["poster"]["name"]);
        move_uploaded_file($_FILES["poster"]["tmp_name"], $target_file);

        $sql = "INSERT INTO movie3 (title, genre, release_year, director, note, poster) VALUES ('$title', '$genre', '$release_year', '$director', '$note', '$target_file')";
        $mysqli->query($sql);
    } elseif (isset($_POST['edit_movie'])) {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $genre = $_POST['genre'];
        $release_year = $_POST['release_year'];
        $director = $_POST['director'];
        $note = $_POST['note'];

        $sql = "UPDATE movie3 SET title='$title', genre='$genre', release_year='$release_year', director='$director', note='$note' WHERE id='$id'";
        $mysqli->query($sql);
    } elseif (isset($_POST['remove_movie'])) {
        $id = $_POST['id'];
        $sql = "DELETE FROM movie3 WHERE id='$id'";
        $mysqli->query($sql);
    }
}

// Fetch movies from the database
$result = $mysqli->query('SELECT * FROM movie3');

?>

<!-- HTML and styling for admin panel -->


<body style=" background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(gsweet-high-resolution-logo.png);
    background-size: cover;
  background-attachment: fixed;
  background-repeat: no-repeat;">
<div class="bg">


    <h2>Admin Panel</h2>

    <!-- Form for adding a new movie -->
    <form style="top: 60px;" method="post" enctype="multipart/form-data">

        <label for="title">Movie Title:</label>
        <input type="text" name="title" required><br>

        <label for="genre">Genre:</label>
        <input type="text" name="genre" required><br>

        <label for="release_year">Release Year:</label>
        <input type="text" name="release_year" required><br>

        <label for="director">Director:</label>
        <input type="text" name="director" required><br>

        <label for="note">Note:</label>
        <input type="text" name="note" required><br>

        <label for="poster">Movie Poster:</label>
        <input type="file" name="poster" required><br>

        <input type="submit" name="add_movie" value="Add Movie">
    </form>
    <div class="movie-container">
    <!-- Display existing movies for editing -->
    <?php while ($movie = $result->fetch_assoc()) : ?>
        <form class="movie-form" method="post">
            <input type="hidden" name="id" value="<?php echo $movie['id']; ?>">
            <label for="title">Movie Title:</label>
            <input type="text" name="title" value="<?php echo $movie['title']; ?>" required><br>

            <label for="genre">Genre:</label>
            <input type="text" name="genre" value="<?php echo $movie['genre']; ?>" required><br>

            <label for="release_year">Release Year:</label>
            <input type="text" name="release_year" value="<?php echo $movie['release_year']; ?>" required><br>

            <label for="director">Director:</label>
            <input type="text" name="director" value="<?php echo $movie['director']; ?>" required><br>

            <label for="note">Note:</label>
            <input type="text" name="note" value="<?php echo $movie['note']; ?>" required><br>

            <label for="new_poster">New Movie Poster:</label>
            <input type="file" name="new_poster"><br>

            <!-- Display the current movie poster -->
            <img src="<?php echo $movie['poster']; ?>" alt="Current Poster" style="max-width: 150px; max-height: 150px; margin-bottom: 10px;">
            <input type="submit" name="edit_movie" value="Edit Movie">
             <!-- Remove Movie Button -->
             <button type="submit" class="remove-movie-btn" name="remove_movie" onclick="return confirm('Are you sure you want to remove this movie?');">
                Remove Movie
            </button>
        </form>
    <?php endwhile; ?>
    </div>
    <button onclick="goBack()" class="back-button">Go Back</button>

<!-- Your existing HTML and PHP code -->

<script>
function goBack() {
    window.history.back();
}
</script>
    </div>
<style>
.back-button {
    margin-right: 1300px;
    display: inline-block;
    background-color: #3498db;
    color: #fff;
    padding: 8px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-bottom: 20px; /* Adjust spacing as needed */
    text-decoration: none; /* Remove default underline for anchor tags */
}

.back-button:hover {
    background-color: #2980b9;
}

.bg{
       
    max-height: 5000px;
            background-color: rgba(0, 0, 0, 0.7);
           

            max-width: 1500px;
                  margin: 50px auto;
                  padding: 30px;
                 
                  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                  font-family: Arial, sans-serif;
                  font-size: 18px;
                  text-align: center;
                  border-radius: 10px;
              }
          


h2 {
    text-align: center;
    margin-bottom: 70px;
    font-size: 50px;
    color: red;
}

form {
    max-width: 600px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

form label {
    display: block;
    margin-bottom: 8px;
    color: #333;
}

form input[type="text"],
form input[type="file"] {
    width: calc(100% - 20px);
    padding: 10px;
    margin-bottom: 15px;
    box-sizing: border-box;
}

form input[type="submit"] {
    background-color: #4caf50;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

form input[type="submit"]:hover {
    background-color: #45a049;
}

form input[type="hidden"] {
    display: none;
}

/* Style for movie display/edit forms */
form:not(:first-child) {
    margin-top: 30px;
}

.movie-container {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 5px;
        justify-content: center;
    }

    .movie-form {
        max-width: 350px;
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        text-align: center;
    }

    .movie-image {
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        margin-bottom: 10px;
    }
.movie h2,
.movie p {
    margin: 5px 0;
    color: #333;
}

.movie button {
    background-color: #3498db;
    color: #fff;
    padding: 8px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
    margin-top: 10px;
    width: 50%;
}

.movie button:hover {
    background-color: #2980b9;
}

.remove-movie-btn {
    background-color: #e74c3c;
    color: #fff;
    padding: 8px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s;
    width: 25%;
}

.remove-movie-btn:hover {
    background-color: #c0392b;
}


</style>
</html>
