<?php
session_start();

$host = "localhost";
$user = "root";
$password = "";
$db = "bsit";

$data = mysqli_connect($host, $user, $password, $db);
if ($data === false) {
    die("connect error");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE username='" . $username . "' AND password='" . $password . "'";
    $result = mysqli_query($data, $sql);

    $row = mysqli_fetch_array($result);

    if ($row) {
        // User found in the database
        $_SESSION["logged_in"] = 'yes';
        $_SESSION["username"] = $username;

        // Set the user identifier in the session
        $_SESSION['stid'] = $row['stid'];

        // Retrieve the profile picture information and store it in the session
        $select_query = "SELECT profile_picture FROM students WHERE stid = " . $_SESSION['stid'];
        $select_result = mysqli_query($data, $select_query);

        if ($select_result) {
            $profile_row = mysqli_fetch_assoc($select_result);
            $_SESSION['profile_picture'] = $profile_row['profile_picture'];
        } else {
            echo 'Error retrieving profile picture information: ' . mysqli_error($data);
            // Handle the error or redirect to an error page
        }

        if ($row["usertype"] == "admin") {
            $_SESSION["user_type"] = 'admin';
            header("location: index.php?page=admin"); // Redirect to admin page
        } else {
            $_SESSION["user_type"] = 'user';
            header("location: index.php?page=home"); // Redirect to regular user page
        }
    } else {
        // User not found in the database
        $_SESSION['error_msg'] = 'Invalid username and/or password.';
        header("location: index.php?page=login");
    }
}
?>
