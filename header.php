<div class="title">
    <img src="images/gsweet-high-resolution-logo-transparent.png" alt="Logo" class="logo">
    <p class="centered-title"></p>
</div>

<?php
if (
    isset($_SESSION['logged_in']) &&
    $_SESSION['logged_in'] === 'yes' &&
    isset($_SESSION['profile_picture']) &&
    ($_SESSION['user_type'] == 'user' || $_SESSION['user_type'] == 'admin')
) {
    $profile_picture = $_SESSION['profile_picture'];
    echo '<li><a href="index.php?page=profile"><img src="uploads/' . $profile_picture . '" alt="Profile Image" style="width: 40px; height: 40px; object-fit: cover; border-radius: 50%; margin-top: 10px; position: fixed; margin-left: 1300px;"></a></li>';
}
?>

<style>


.logo {
    width: 100px;
    height: auto;
    margin-right: 400px;
}

.centered-title {
    font-size: 20px;
    font-weight: bold;
    text-align: center;
    margin-right: 800px;
    color: red;
}
</style>

