<?php
session_start();
include "config/connection.php";

if (isset($_POST['submit'])) {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $_SESSION['email'] = $email;

        $password = md5($_POST['password']);

        $query = mysqli_query($conn, "SELECT * FROM tb_users WHERE email = '$email'");

        $statusResult = mysqli_query($conn, "SELECT status FROM tb_users WHERE email = '$email'");
        $status = mysqli_fetch_assoc($statusResult)['status'];

        if (mysqli_num_rows($query) > 0) {
            $row = mysqli_fetch_assoc($query);
            $hashedPassword = $row['password'];
            $id = $row['id'];
            $_SESSION['id'] = $id;

            if ($password == $hashedPassword) {
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
                        exit();
                } else {
                    // Invalid status value
                    echo "Invalid user status";
                }
            } else {
                // Incorrect password
                ?>
                <script>
                    alert("Wrong Password");
                    location.href = "index.php";
                </script>
                <?php
            }
        } else {
            // Username not found
            ?>
            <script>
                alert("Email Not Found");
                location.href = "index.php";
            </script>
            <?php
        }
    }
}
?>