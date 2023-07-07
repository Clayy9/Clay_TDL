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
    <link rel="stylesheet" href="./assets/css/style.css">
</head>


<body>
    <div class="left">
        <div class="profile">
            <div class="container_profile">
                <img class="profile_img" src=" ./assets/images/<?php echo $profile_img; ?>" alt="">
            </div>
            <div class="profile_desc">
                <p class="profile_desc_username">
                    <?php echo $username; ?>
                </p>
                <p class="profile_desc_email">
                    <?php echo $email ?>
                </p>
            </div>
            <div class="logout">
                <a href="logout.php">
                    <button class="button_logout">
                        <i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i> Logout
                    </button>
                </a>
            </div>
        </div>

        <div class="container_pet" id="container_pet">
            <?php
            $sql = "SELECT tb_pets.* FROM tb_users LEFT JOIN tb_pets ON tb_users.pet_id = tb_pets.id";
            $query = mysqli_query($conn, $sql);
            while ($result = mysqli_fetch_array($query)) {
                ?>
                <div class="pet_display">
                    <img class="pet_display_img" src="./assets/images/pet/<?php echo $result['pet_img']; ?>" />
                </div>

                <div class="pet_info">
                    <div class="pet_info_name">
                        <p>
                            <?php echo $result['pet_name']; ?>
                        </p>
                    </div>

                    <div class="pet_info_task_completed">
                        <div id="pet_score">
                            <div class="loader"></div>
                        </div>
                        <div class="pet_info_task_completed_percentage" id="pet_xp">
                            <div class="loader"></div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>


    <div class="right">
        <div class="container_task">
            <div class="task_active">
                <div class="task_head">
                    <div class="task_title">
                        <p>Your task</p>
                    </div>
                    <a id="add_task_button">
                        <i class="fa-sharp fa-solid fa-plus" style="color: #ffffff;"></i>
                    </a>
                </div>

                <div class="task_active_list" id="active_tasks">
                    <div class="loader"></div>
                </div>
            </div>

            <div class="task_completed">
                <div class="task_title">
                    <p>Completed Task</p>
                </div>
                <div class="task_active_list" id="completed_tasks">
                    <div class="loader"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form untuk menambahkan data tugas -->
    <form id="add_task_form_container">
        <div class="form_container">
            <div class="back_to_home">
                <a onclick="location.href='home.php'"><i class="fa-solid fa-xmark fa-xl"
                        style="color: #ffffff;"></i></a>
            </div>
            <h1>NEW TASK</h1>
            <div class="inputForm">
                <h3>Title</h3>
                <input class="textField" type="text" name="task_name" id="task_name" maxlength="30"
                    placeholder="Type your title..." required />
            </div>
            <div class="inputForm">
                <h3>Description</h3>
                <input class="textField" type="text" name="task_desc" id="task_desc"
                    placeholder="Type your description..." />
            </div>
            <div class="inputForm">
                <h3>Category</h3>
                <div class="customSelect">
                    <select name="category_id" id="category_id">
                        <option class="option" value="" selected disabled>Select a category</option>
                        <option class="option" value="0" default selected="selected">
                            <p>None</p>
                        </option>
                        <option class="option" value="1">
                            <p>Medic</p>
                        </option>
                        <option class="option" value="2">
                            <p>Meeting</p>
                        </option>
                        <option class="option" value="3">
                            <p>Sport</p>
                        </option>
                        <option class="option" value="4">
                            <p>Study</p>
                        </option>
                    </select>
                    <span class="arrow"></span>
                </div>
            </div>

            <div class="inputForm">
                <h3>Priority</h3>
                <div class="customSelect">
                    <select name="priority_id" id="priority_id">
                        <option value="" selected disabled>Select a priority</option>
                        <option value="1" default selected="selected">Low</option>
                        <option value="2">Medium</option>
                        <option value="3">High</option>
                    </select>
                    <span class="arrow"></span>
                </div>
            </div>

            <div class="inputForm_date">
                <div class="inputForm">
                    <h3>Date</h3>
                    <div class="inputForm">
                        <input class="textField" type="date" name="task_date" id="task_date" />
                    </div>
                </div>
            </div>

            <div class="inputForm_date">
                <div class="inputForm">
                    <h3>Time</h3>
                    <div class="inputForm">
                        <input class="textField" type="time" name="task_time" id="task_time" />
                    </div>
                </div>
            </div>

            <div class="button_submit">
                <td colspan="2"><input class="form_button" type="button" value="ADD TASK" id="submit-button"
                        name="submit">
                </td>
            </div>
        </div>
        </div>
    </form>


    <!-- Script -->
    <script src="./assets/js/jquery-3.7.0.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="https://kit.fontawesome.com/67a87c1aef.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            get_data();
            completed_data();
            delete_task();
            saveScore();
            // addTask()
            // editTask()
        });
    </script>
</body>

</html>