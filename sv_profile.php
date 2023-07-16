<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act']; // membedakan prosesnya
$id = $_POST['id'] ?? '';
?>

<?php
if ($act == "editProfile") {
    $user_id = $_REQUEST['id'];
    $profile_img = ''; // Inisialisasi variabel dengan nilai default kosong

    if (isset($_FILES['profile_img']) && $_FILES['profile_img']['size'] > 0) {
        // User mengunggah file baru
        $file = $_FILES['profile_img'];
        $file_name = md5($file['name']) . '_' . date('y-m-d') . '.' . pathinfo($file['name'], PATHINFO_EXTENSION);
        $file_tmp = $file['tmp_name'];

        // Folder tujuan
        $folder = './assets/images/profile/';

        // Pindahkan file ke folder tujuan
        if (move_uploaded_file($file_tmp, $folder . $file_name)) {
            echo 'File berhasil diunggah ke folder tujuan.';

            // Atur profile_img = $file_name
            $profile_img = $file_name;
        } else {
            echo 'Gagal mengunggah file.';
        }
    } else {
        // User tidak mengunggah file baru, gunakan data yang ada di database
        $sqlProfile = "SELECT profile_img FROM tb_users WHERE id = '$user_id'";
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
    $new_password = $_POST['new_password'];

    $action_type = "updateProfile";
    $addition_command = "";
    $exec = true;

    if ($new_password != "") {
        $sqlOldPassword = "SELECT password FROM tb_users WHERE id = '$user_id'";
        $queryOldPassword = mysqli_query($conn, $sqlOldPassword);
        $resultOldPassword = mysqli_fetch_array($queryOldPassword);
        if ($password == $resultOldPassword['password']) {
            $new_password = md5($new_password);
            $addition_command = ", password = '$new_password'";
            $action_type = "updateProfilePassword";
        } else {
            $message = "password lama Anda salah!";
            $action_type = "wrongPassword";
            $exec = false;
        }
    }

    if ($exec) {
        $sql_update = "UPDATE tb_users SET 
                                profile_img = '$profile_img', 
                                fullname = '$fullname', 
                                email = '$email',
                                pet_id = '$pet_id'  
                                $addition_command 
                                WHERE id = '$user_id'";
        $run_query_check = mysqli_query($conn, $sql_update) or die($sql_update);

        $actionType = "DataBerhasil";
        $message = "Data Berhasil diubah";



    }

    echo "|" . $action_type . "|" . $message . "|";
    ?>

    <?php
} else if ($act == "loadingProfile") {
    $sql = "SELECT profile_img, username, email FROM tb_users WHERE id = '$user_id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    ?>
        <div class="container_profile">
            <img class="profile_img" src=" ./assets/images/profile/<?php echo $result['profile_img']; ?>" alt="">
        </div>
        <div class="profile_desc">
            <p class="profile_desc_username">
            <?php echo $result['username']; ?>
            </p>
            <p class="profile_desc_email">
            <?php echo $result['email']; ?>
            </p>
        </div>
        <div class="profile_action">
            <div class="editProfile">
                <a href="edit_profile.php">
                    <button class="button_logout">
                        <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i> Edit
                    </button>
                </a>
            </div>
            <div class="logout">
                <a href="logout.php">
                    <button class="button_logout">
                        <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i> Logout
                    </button>
                </a>
            </div>
        </div>
    <?php
}
?>