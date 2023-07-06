<?php
include "config/connection.php";

$username = $_POST['username'];
$_SESSION['name'] = $username;
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$password = md5($_POST['password']);

$sql_select = "select * from tb_users where email='$email' and password='$password'";
$query = mysqli_query($conn, $sql_select);
$num = mysqli_num_rows($query); //mengambil jumlah data yang muncul
$result = mysqli_fetch_array($query); //mengambil array data

if ($num > 0) 
{
    ?>
    <script>
        alert("Account Already Exist");
    </script>
    <?php
    header("Refresh:0.1; url=register.php");

} else {
    $sql_insert = "INSERT INTO tb_users (profile_img, username, fullname, email, status, password, pet_id) VALUES ('none','$username','$fullname','$email','User','$password','1')";
    $run_query_check = mysqli_query($conn, $sql_insert);
    if (!$run_query_check) {
        die('Query error: ' . mysqli_error($conn));
    } else {
        ?>
        <script>
            alert("Registration Succeed");
        </script>
        <?php
        header("Refresh:0.1; url=index.php");
    }
}
?>