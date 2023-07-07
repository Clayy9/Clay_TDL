<?php
session_start();

if (!isset($_SESSION['email']) && !isset($_SESSION['emails'])) {
    ?>
    <script>
        alert("Please Login!");
        location.href = "index.php";
    </script>
    <?php
    exit(); // Add exit() after the redirect to stop further code execution
}

$user_id = $_SESSION['id'];
$email = $_SESSION['email'];
$username = $_SESSION['username'];
$profile_img = $_SESSION['profile_img']


    ?>