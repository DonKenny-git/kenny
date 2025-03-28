<?php
$db = new mysqli("localhost", "root", "", "bsit");

if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get data from POST request
    $userId = $_POST["stid"];
    $updatedFirstName = $_POST["fname"];
    $updatedLastName = $_POST["lname"];
    $updatedUsername = $_POST["username"];
    $updatedPassword = $_POST["password"];

    // Update data in the database
    $sql = "UPDATE students SET fname='$updatedFirstName', lname='$updatedLastName', username='$updatedUsername', password='$updatedPassword' WHERE stid=$userId";

    if ($db->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $db->error;
    }
}

$db->close();
?>
