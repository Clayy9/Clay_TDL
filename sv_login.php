<?php
session_start();
include "config/connection.php";

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = md5($_POST['password']);
        
        $query = mysqli_query($conn, "SELECT * FROM tb_users WHERE email = '$email' AND password = '$password'");
                
        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);

            $status = $row['status'];
            $id = $row['id'];
            $username = $row['username'];
            $profile_img = $row['profile_img'];

            $_SESSION['id'] = $id;
            $_SESSION['email'] = $email;
            $_SESSION['username'] = $username;
            $_SESSION['profile_img'] = $profile_img;


            if ($status == "Admin") {
            // User is an admin (status = 1)
            ?>
                <script>
                    alert("Hello Admin");
                    location.href = "admin/admin.php";
                </script>
            <?php
                exit();
                } else if ($status == "User") {
                // User is not an admin (status = 0)
            ?>
                <script>
                    location.href = "home.php";
                </script>
            <?php
            }

        } else {
            ?>
            <script>
                alert("Invalid Data");
                location.href = "index.php";
            </script>
            <?php
        }
    }
}
?>