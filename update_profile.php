<?php
session_start(); // Start the session

$host = "localhost";
$user = "root";
$password = "";
$db = "bsit";

$data = mysqli_connect($host, $user, $password, $db);
if ($data === false) {
    die("connect error");
}

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== 'yes') {
    header("Location: index.php?page=login");
    exit();
}

// Check if the stid is set in the session
if (!isset($_SESSION['stid'])) {
    echo 'User identifier (stid) is not set in the session.';
    exit();
}

$stid = $_SESSION['stid'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['change_profile_picture'])) {
        if ($_FILES['profile_picture']['error'] == UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/'; // Specify your upload directory
            $file_name = basename($_FILES['profile_picture']['name']);
            $target_path = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['profile_picture']['tmp_name'], $target_path)) {
                // Update the profile picture filename in the database
                $update_query = "UPDATE students SET profile_picture = '$file_name' WHERE stid = $stid";
                $update_result = mysqli_query($data, $update_query);

                if ($update_result) {
                    // Update the profile picture filename in the session
                    $_SESSION['profile_picture'] = $file_name;
                    // Refresh the session data
                    $select_query = "SELECT profile_picture FROM students WHERE stid = $stid";
                    $select_result = mysqli_query($data, $select_query);
                    if ($select_result) {
                        $row = mysqli_fetch_assoc($select_result);
                        $_SESSION['profile_picture'] = $row['profile_picture'];
                    }
                    header("Location: profile.php");
                    exit();
                } else {
                    echo 'Error updating profile picture in the database: ' . mysqli_error($data);
                }
            } else {
                echo 'Error uploading file.';
            }
        } else {
            echo 'Error: ' . $_FILES['profile_picture']['error'];
        }
    } elseif (isset($_POST['save_changes'])) {
        // Handle saving other information
        // Validate and sanitize the input data
        $new_fname = mysqli_real_escape_string($data, $_POST['new_fname']);
        $new_lname = mysqli_real_escape_string($data, $_POST['new_lname']);
        $new_username = mysqli_real_escape_string($data, $_POST['new_username']);
        $new_age = mysqli_real_escape_string($data, $_POST['new_age']);
        $new_password = mysqli_real_escape_string($data, $_POST['new_password']);

        // Update the user information in the database
        $update_query = "UPDATE students 
                        SET fname = '$new_fname', 
                            lname = '$new_lname', 
                            username = '$new_username', 
                            age = '$new_age', 
                            password = '$new_password'
                        WHERE stid = $stid";

        $update_result = mysqli_query($data, $update_query);

        if ($update_result) {
            header("Location: profile.php");
            exit();
        } else {
            echo 'Error updating user information: ' . mysqli_error($data);
        }
    }
} else {
    echo 'Invalid request method.';
} 
?>