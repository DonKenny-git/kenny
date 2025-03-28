<?php
// Connect to the database
$mysqli = new mysqli("localhost", "root", "", "bsit");

// Check connection
if ($mysqli->connect_error) {
    die('Connection failed: ' . $mysqli->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$price = $_POST['price'];
$image = $_POST['image'];

// Insert into the database
$sql = "INSERT INTO products1 (name, price, image) VALUES ('$name', $price, '$image')";
$mysqli->query($sql);

// Close database connection
$mysqli->close();

// Redirect back to the admin panel
header("Location: admin.php");
exit();
?>
