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

    $profile_picture = isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : $user_data['profile_picture'];
    $default_image_path = 'images/defaultpic.jpg'; // Set the default image path
    
?>
  <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)),
                url(gsweet-high-resolution-logo.png);
            background-size: cover;
            background-attachment: fixed;
            background-repeat: no-repeat;
            color: #ffffff;
        }

        .profile-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 30px;
            background-color: rgba(255, 255, 255, 0.9); /* Make background color semi-transparent */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            text-align: center;
            border: 1px solid rgba(0, 0, 0, 0.1); /* Make border color semi-transparent */
            color: #333;
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
        }

        h2 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #333;
        }

        p {
            margin: 10px 0;
            font-size: 18px;
            color: #666;
        }

        .profile-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 20px 0;
        }

        .editable-field,
        .new-field {
            display: block;
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
            box-sizing: border-box;
        }

        .new-field {
            display: none;
        }

        button.btn-dark,
        .back-button {
            padding: 12px 24px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button.btn-dark {
            background-color: #333;
            color: #ffffff;
        }

        button.btn-dark:hover {
            background-color: #555;
        }

        .back-button {
            background-color: #4F8FFF;
            color: #ffffff;
            display: none;
            transition: background-color 0.3s ease;
        }

        .back-button:hover {
            background-color: #4F70D6;
        }
    </style>
</head>

<body>

<div class="profile-container">
        <div class="profile-image" id="profileImageContainer">
            <?php
            if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === 'yes' && isset($_SESSION['profile_picture'])) {
                $profile_picture = $_SESSION['profile_picture'];
                echo '<img src="uploads/' . $profile_picture . '" alt="Profile Image">';
            } else {
                echo '<img src="' . $default_image_path . '" alt="Profile Image">';
            }
            ?>
        </div>

        <h2><?php echo $user_data['fname'] . ' ' . $user_data['lname']; ?></h2>
        <p>@<?php echo $user_data['usertype']; ?> </p>

        <form action="update_profile.php" method="post" enctype="multipart/form-data">
            <p class="profile-info">
                <strong>Profile Picture:</strong>
                <input type="file" class="choose" name="profile_picture" id="profile_picture" accept="image/*">
                <button type="submit" class="btn btn-dark" name="change_profile_picture">Change Profile Picture</button>
            </p>

            <p class="profile-info">
                <strong>First Name:</strong>
                <span class="editable-field" id="fname"><?php echo $user_data['fname']; ?></span>
                <input type="text" class="new-field" name="new_fname" id="new_fname" style="display: none;" value="<?php echo $user_data['fname']; ?>">
            </p>
            <p class="profile-info">
                <strong>Last Name:</strong>
                <span class="editable-field" id="lname"><?php echo $user_data['lname']; ?></span>
                <input type="text" class="new-field" name="new_lname" id="new_lname" style="display: none;" value="<?php echo $user_data['lname']; ?>">
            </p>
            <p class="profile-info">
                <strong>Username:</strong>
                <span class="editable-field" id="username"><?php echo $user_data['username']; ?></span>
                <input type="text" class="new-field" name="new_username" id="new_username" style="display: none;" value="<?php echo $user_data['username']; ?>">
            </p>
            <p class="profile-info">
                <strong>Password:</strong>
                <span class="editable-field" id="password"><?php echo $user_data['password']; ?></span>
                <input type="password" class="new-field" name="new_password" id="new_password" style="display: none;" value="<?php echo $user_data['password']; ?>">
            </p>
            <p class="profile-info">
                <strong>Age:</strong>
                <span class="editable-field" id="age"><?php echo $user_data['age']; ?></span>
                <input type="text" class="new-field" name="new_age" id="new_age" style="display: none;" value="<?php echo $user_data['age']; ?>">
            </p>

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
            $('.back-button').hide();
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