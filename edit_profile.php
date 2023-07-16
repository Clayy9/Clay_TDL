<?php
include "config/security.php";
include "config/connection.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>

    <!-- Link -->
    <link rel="stylesheet" href="./assets/css/style_profile.css">
</head>

<body>
    <?php
    $user_id = $_SESSION['id'];
    $sql = "SELECT * from tb_users WHERE id='$user_id'";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    ?>

    <div class="container_form_edit">
        <div class="form_edit">
            <form id="form_profile_edit" enctype="multipart/form-data">
                <div class="back_to_home">
                    <a onclick="location.href='home.php'"><i class="fa-solid fa-xmark fa-xl"
                            style="color: #ffffff;"></i></a>
                </div>

                <input type="hidden" name="id" class="id form-control" id="id" value="<?php echo $result['id'] ?>">

                <h1 id="title_task">EDIT PROFILE</h1>

                <div class="inputProfile">
                    <img src="./assets/images/profile/<?php echo $result['profile_img']; ?>" id="previewImage">
                    <input type="file" name="profile_img" id="profile_img" accept="image/*">
                    <label for="profile_img" class="upload-button">Change</label>
                </div>

                <div class="inputForm">
                    <h3>Username</h3>
                    <input class="textField" type="text" name="username" id="username" maxlength="30"
                        value="<?php echo $result['username'] ?>" readonly />
                </div>

                <div class="inputForm">
                    <h3>Fullname</h3>
                    <input class="textField" type="text" name="fullname" id="fullname" maxlength="30"
                        value="<?php echo $result['fullname'] ?>" />
                </div>

                <div class="inputForm">
                    <h3>Email</h3>
                    <input class="textField" type="email" name="email" id="email"
                        value="<?php echo $result['email'] ?>" />
                </div>

                <div class="inputForm">
                    <h3>Old Password</h3>
                    <input class="textField" type="password" name="password" id="password" placeholder="Old Password" />
                </div>

                <div class="inputForm">
                    <h3>Confirm New Password</h3>
                    <input class="textField" type="password" name="new_password" id="new_password"
                        placeholder="Confirm New Password" />
                </div>


                <input type="hidden" id="pet_id" name="pet_id">

                <div class="edit_profile_pet_container">
                    <h3>Pick Your Pet</h3>

                    <?php
                    $sqlPET = "SELECT * FROM tb_pets";
                    $queryPET = mysqli_query($conn, $sqlPET);
                    ?>
                    <div class="edit_profile_pet_card_container">
                        <?php
                        while ($result = mysqli_fetch_array($queryPET)) {
                            ?>
                            <div class="edit_profile_pet_card" id="pet_card_<?php echo $result['id']; ?>"
                                onclick="selectedPet(<?php echo $result['id']; ?>)">
                                <div class="edit_profile_pet_card_img">
                                    <img src="./assets/images/pet/default/<?php echo $result['pet_img']; ?>">
                                    <div class="edit_profile_pet_card_name">
                                        <p>
                                            <?php echo $result['pet_name']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>

                <input type="hidden" name="status" class="id form-control" id="status" value="">
                <input type="hidden" name="xp" class="id form-control" id="xp" value="">
                <input type="hidden" name="pet_phases_id" class="id form-control" id="pet_phases_id" value="">
                <input type="button" class="form_button_profile" value="SAVE" id="submit-button-profile" name="submit">
            </form>
        </div>
    </div>

    <!-- Script -->
    <script src="./assets/js/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js"
        integrity="sha512-Hmp6qDy9imQmd15Ds1WQJ3uoyGCUz5myyr5ijainC1z+tP7wuXcze5ZZR3dF7+rkRALfNy7jcfgS5hH8wJ/2dQ=="
        crossorigin="anonymous"></script>
    <script src="./assets/js/script-profile.js"></script>
    <script src="https://kit.fontawesome.com/67a87c1aef.js" crossorigin="anonymous"></script>
</body>

</html>