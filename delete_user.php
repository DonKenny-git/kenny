<?php
// delete_user.php

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["stid"])) {
    $db = new mysqli("localhost", "root", "", "bsit");

    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    $userId = $_POST["stid"];

    // Perform the deletion query
    $deleteQuery = "DELETE FROM students WHERE stid = $userId";
    $result = $db->query($deleteQuery);

    if ($result) {
        echo "User deleted successfully";
    } else {
        echo "Error deleting user: " . $db->error;
    }

    $db->close();
} else {
    echo "Invalid request";
}
?>
