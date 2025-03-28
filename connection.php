<?php
$host = "sql.infinityfree.com";
$user = "epiz_username";
$password = "your_password";
$db = "epiz_database_name";

$data = mysqli_connect($host, $user, $password, $db);
if ($data === false) {
    die("connect error");
}