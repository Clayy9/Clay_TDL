<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "to_do_list";

$conn = mysqli_connect($server, $user, $pass, $db);

if (!$conn) {
    die("Database Error!");
}
?>