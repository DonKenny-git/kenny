<body style=" background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(illustration-anime-city.jpg);
    background-size: cover;
  background-attachment: fixed;
  background-repeat: no-repeat;">

<center>
    <div class="bg">
        <div class="product_container">
            <?php
            // Connect to the database (replace with your actual database credentials)
            $mysqli = new mysqli("localhost", "root", "", "bsit");

            // Check connection
            if ($mysqli->connect_error) {
                die('Connection failed: ' . $mysqli->connect_error);
            }

            // Fetch movies from the database
            $result = $mysqli->query('SELECT * FROM movie3');

            // Loop through the movies and display them
            while ($movie = $result->fetch_assoc()) {
                echo '<div class="product">';
                echo '<img src="' . $movie['poster'] . '" alt="' . $movie['title'] . '">';
                echo '<h2>' . $movie['title'] . '</h2>';
                echo '<p>Genre: ' . $movie['genre'] . '</p>';
                echo '<p>Release Year: ' . $movie['release_year'] . '</p>';
                echo '<p>Director: ' . $movie['director'] . '</p>';
                echo '<p>Note: ' . (strlen($movie['note']) > 100 ? substr($movie['note'], 0, 100) . '...' : $movie['note']) . '</p>';
                echo '<button>Watch</button>';
                echo '</div>';
            }

            // Close database connection
            $mysqli->close();
            ?>
        </div>
    </div>
</center>

<style>
    /* page style */
  
  .product_container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
      padding: 20px;
      width: 80%;
  }
  .product {
      font-family: 'Arial', sans-serif;
      border: 1px solid #ddd;
      padding: 15px;
      margin: 20px;
      width: 100%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
      background-color: #fff;
      border-radius: 10px;
  }
  .product:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
  }
  .product img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      margin-bottom: 15px;
      object-fit: cover;
      aspect-ratio: 16/9; /* Ensures landscape orientation */
  }
  .product h2 {
      margin: 10px 0;
      color: #333;
      font-size: 1.4rem;
  }
  .product p {
      margin: 5px 0;
      color: #666;
      font-size: 1rem;
  }
  .product button {
      margin-top: 10px;
      width: 100%;
      background-color: #3498db;
      color: #fff;
      padding: 10px;
      font-size: 1rem;
      font-weight: 600;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s, color 0.3s;
  }
  .product button:hover {
      background-color: #2980b9;
      color: #fff;
  }
</style>