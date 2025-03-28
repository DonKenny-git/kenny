<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "bsit";

$data = mysqli_connect($host, $user, $password, $db);
if ($data === false) {
    die("connect error");
}