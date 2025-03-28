<?php

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

$query = "SELECT * FROM students WHERE stid = $stid";
$result = mysqli_query($data, $query);

if ($result) {
    $user_data = mysqli_fetch_assoc($result);

    $profile_picture = $_SESSION['profile_picture'] ?? $user_data['profile_picture'];
    $default_image_path = 'images/defaultpic.jpg'; // Set the default image path
    
?>
    <style>
    
    .profile-container {
        max-width: 800px;
        margin: 50px auto;
        padding: 30px;
        background-color: #ffffff;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        text-align: center;
    }

    .profile-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        overflow: hidden;
        margin: 0 auto 20px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .profile-image img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures the image covers the entire container */
        border-radius: 50%;
    }

    h2 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #333333;
    }

    p {
        margin: 10px 0;
        font-size: 18px;
        color: #666666;
    }

    .profile-info {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin: 15px 0;
    }

    .editable-field,
    .new-field {
        display: inline-block;
        width: 70%;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 5px;
        margin-right: 10px;
    }

    .new-field {
        display: none;
    }

    button.btn-dark {
        background-color: #333333;
        color: #ffffff;
        padding: 10px 20px;
        font-size: 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button.btn-dark:hover {
        background-color: #555555;
    }

    .back-button {
        background-color: #4F8FFF;
        color: #ffffff;
        padding: 10px 20px;
        font-size: 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        display: none;
        transition: background-color 0.3s ease;
    }

    .back-button:hover {
        background-color: #4F70D6;
    }
</style>

<body style=" background-image:linear-gradient(rgba(0,0,0,0.5),rgba(0,0,0,0.5)), url(abstract-futuristic-background-with-3d-design.jpg);
    background-size: cover;
  background-attachment: fixed;
  background-repeat: no-repeat;">


<div class="profile-container">
        <div class="profile-image" id="profileImageContainer">
    <?php
    // Check if the user is logged in and the profile picture is set in the session
    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === 'yes' && isset($_SESSION['profile_picture'])) {
        $profile_picture = $_SESSION['profile_picture'];
        echo '<img src="uploads/' . $profile_picture . '" alt="Profile Image">';
    } else {
        // If not logged in or profile picture not set, display default image
        echo '<img src="' . $default_image_path . '" alt="Profile Image">';
    }
    ?>
</div>

        <h2><?php echo $user_data['fname'] . ' ' . $user_data['lname']; ?></h2>
        <p>@<?php echo $user_data['usertype']; ?> </p>

        <form action="update_profile.php" method="post" enctype="multipart/form-data">
            <!-- Your input fields and other form elements here -->

            <p class="profile-info">
                <strong>Profile Picture:</strong>
                <input type="file" class="choose" name="profile_picture" id="profile_picture" accept="image/*">
                <button type="submit" class="btn btn-dark" name="change_profile_picture">Change Profile Picture</button>
            </p>
  

<p class="profile-info">
    <strong>First Name:</strong>
    <span class="editable-field" id="fname"><?php echo $user_data['fname']; ?></span>
    <input type="text" class="new-field" name="new_fname" id="new_fname" style="display: none;">
</p>
<p class="profile-info">
    <strong>Last Name:</strong>
    <span class="editable-field" id="lname"><?php echo $user_data['lname']; ?></span>
    <input type="text" class="new-field" name="new_lname" id="new_lname" style="display: none;">
</p>
<p class="profile-info">
    <strong>Username:</strong>
    <span class="editable-field" id="username"><?php echo $user_data['username']; ?></span>
    <input type="text" class="new-field" name="new_username" id="new_username" style="display: none;">
</p>
<p class="profile-info">
    <strong>Password:</strong>
    <span class="editable-field" id="password"><?php echo $user_data['password']; ?></span>
    <input type="password" class="new-field" name="new_password" id="new_password" style="display: none;">
</p>
<p class="profile-info">
    <strong>Age:</strong>
    <span class="editable-field" id="age"><?php echo $user_data['age']; ?></span>
    <input type="text" class="new-field" name="new_age" id="new_age" style="display: none;">
</p>
    
        <!-- Add more rows for additional fields -->

        <button type="button" class="btn btn-dark" onclick="enableEdit()">Edit Profile</button>
            <button type="submit" class="btn btn-dark" style="display: none;" name="save_changes">Save Changes</button>
            <button type="button" class="back-button" onclick="disableEdit()">Back</button>
        </form>
    </div>

    <script>
        function enableEdit() {
            $('.editable-field').hide();
            $('.new-field').show();

            $('.btn-dark').hide();
            $('button[name="save_changes"]').show();

            $('.back-button').show();
            $('#profileImageContainer').show();
        }

        function disableEdit() {
            // Hide the back button
            $('.back-button').hide();

            // Reset the form to non-editable state
            $('.editable-field').show();
            $('.new-field').hide();

            $('.btn-dark').show();
            $('button[name="save_changes"]').hide();
        }
    </script>

<?php
} else {
    echo 'Error retrieving user data: ' . mysqli_error($data);
}
?>