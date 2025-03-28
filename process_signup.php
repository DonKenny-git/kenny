<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "bsit";

// Create connection
$conn = new mysqli($host, $user, $password, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data using prepared statements to prevent SQL injection
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $username = $_POST["username"];
    $password = $_POST["password"];
    $age = $_POST["age"];
    $captcha = $_POST["captcha"];

    // Perform server-side validation and checks
    // ...

    // Check CAPTCHA
    if ($captcha != $_SESSION['generated_captcha']) {
        $_SESSION['error_msg'] = "Invalid CAPTCHA...!!!";
        header("Location: login.php");
        exit();
    }

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO students (fname, lname, username, password, age) VALUES ('$fname', '$lname', '$username', '$password', $age)";
    
    $stmt = $conn->prepare($sql);

    if ($stmt->execute()) {
        // Redirect to the login page after successful signup
        header("Location: index.php?page=login");
        exit();
    } else {
        $_SESSION['error_msg'] = "Error: " . $sql . "<br>" . $stmt->error;
        header("Location: index.php?page=login");
        exit();
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
