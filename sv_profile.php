<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act']; // membedakan prosesnya
$id = $_POST['id'] ?? '';

if ($act == "editProfile") {
    $user_id = $_REQUEST['id'];
    $profile_img = $_POST['profile_img'];

    if ($profile_img == "") {
        $sqlProfile = "SELECT * FROM tb_users WHERE id = '$user_id'";
        $queryProfile = mysqli_query($conn, $sqlProfile);
        $resultProfile = mysqli_fetch_array($queryProfile);
        $profile_img = $resultProfile['profile_img'];
    }

    $username = $_POST['username'];
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $pet_id = $_POST['pet_id'];
    if ($pet_id == "") {
        $sqlPET = "SELECT pet_id FROM tb_users WHERE id = '$user_id'";
        $PETquery = mysqli_query($conn, $sqlPET);
        $resultPET = mysqli_fetch_array($PETquery);
        $pet_id = $resultPET['pet_id'];
    }
    $password = $_POST['password'];
    $password_confirm = $_POST['password_confirm'];

    if ($password != "") {
        if ($password === $password_confirm) {
            $passwordValid = md5($password);

            $sql = "UPDATE tb_users
                SET profile_img = '$profile_img',
                    fullname = '$fullname',
                    email = '$email',
                    password = '$passwordValid',
                    pet_id = '$pet_id'
                WHERE id='$user_id'";
            $query = mysqli_query($conn, $sql);

            ?>
            <script>
                alert("Berhasil di Update");
                location.href = "logout.php";
            </script>
            <?php
        } else {
            ?>
            <script>
                alert("Password tidak sama");
            </script>
            <?php


        }
    } else {
        $sql = "UPDATE tb_users
                SET profile_img = '$profile_img',
                    fullname = '$fullname',
                    email = '$email',
                    pet_id = '$pet_id'
                WHERE id='$user_id'";
        $query = mysqli_query($conn, $sql);

        ?>
        <script>
            alert("Berhasil di Update");
            location.href = "logout.php";
        </script>
        <?php
    }
}
?>