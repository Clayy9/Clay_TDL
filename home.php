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
                <img class="profile_img" src=" ./assets/images/profile/<?php echo $profile_img; ?>" alt="">
            </div>
            <div class="profile_desc">
                <p class="profile_desc_username">
                    <?php echo $username; ?>
                </p>
                <p class="profile_desc_email">
                    <?php echo $email ?>
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

        </div>

        <div class="container_pet" id="container_pet">
            <div class="loader"></div>
        </div>
    </div>


    <div class="right">
        <div class="container_task">
            <div class="task_active">
                <div class="task_head">
                    <div class="task_title">
                        <p>Your task</p>
                    </div>
                    <div class="task_feature">
                        <a id="add_task_button">
                            <i class="fa-sharp fa-solid fa-plus" style="color: #ffffff;"></i> </a>
                        <a id="filter_task_button">
                            <i class="fa-solid fa-filter" style="color: #ffffff;"></i>
                        </a>
                        <a id="all_task_button" onclick="location.href='box.php'">
                            <i class="fa-solid fa-box-open" style="color: #ffffff;"></i> </a>
                    </div>

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

    <!-- Form -->
    <form id="add_task_form_container">
        <div class="form_container">
            <div class="back_to_home">
                <a onclick="location.href='home.php'"><i class="fa-solid fa-xmark fa-xl"
                        style="color: #ffffff;"></i></a>
            </div>
            <input type="hidden" name="id" class="id form-control" id="id" value="">
            <h1 id="title_task">NEW TASK</h1>
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

            <div class="inputForm">
                <div class="inputForm">
                    <h3>Date</h3>
                    <div class="inputForm">
                        <input class="textField" type="date" name="task_date" id="task_date" value="" />
                    </div>
                </div>
            </div>

            <div class="inputForm">
                <div class="inputForm">
                    <h3>Time</h3>
                    <div class="inputForm">
                        <input class="textField" type="time" name="task_time" id="task_time" />
                    </div>
                </div>
            </div>

            <input type="hidden" name="reminder_id" class="id form-control" id="reminder_id" value="">
            <input type="hidden" name="status_id" class="id form-control" id="status_id" value="">


            <div class="button_submit">
                <td colspan="2"><input class="form_button" type="button" value="SAVE" id="submit-button" name="submit">
                </td>
            </div>
        </div>
        </div>
    </form>

    <!-- Modal Filter -->
    <div id="filter_container">
        <div class="back_to_home_filter">
            <a id="back_to_home_filter_button"><i class="fa-solid fa-xmark fa-xl" style="color: #ffffff;"></i></a>
        </div>
        <form id="filter_form_container">
            <div class="date_filter">
                <div class="inputForm_date">
                    <div class="inputFormFilter">
                        <h3>Date</h3>
                        <div class="inputForm_date">
                            <div>
                                <input class="date_filter_input" type="date" name="task_date_filter_from"
                                    id="task_date_filter_from" />
                            </div>
                            <div>
                                <p class="inputForm_date_text"> s/d </p>
                            </div>
                            <div>
                                <input class="date_filter_input" type="date" name="task_date_filter_to_date"
                                    id="task_date_filter_to_date" />
                            </div>
                        </div>

                        <div class="inputFormFilter">
                            <h3>Status</h3>
                            <div class="customSelect">
                                <select name="status_id_filter" id="status_id_filter">
                                    <option value="all">All</option>
                                    <option value="1">Active</option>
                                    <option value="2">Done</option>
                                    <option value="3">Expired</option>
                                </select>
                                <span class="arrow"></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="button_submit">
                <td colspan="2"><input class="form_button_filter" type="button" value="VIEW" id="submit-button-filter"
                        onclick="filterTask()" name="submit">
                </td>
            </div>
        </form>
    </div>


    <!-- Script -->
    <script src="./assets/js/jquery-3.7.0.js"></script>
    <script src="./assets/js/script.js"></script>
    <script src="https://kit.fontawesome.com/67a87c1aef.js" crossorigin="anonymous"></script>

    <script>
        $(document).ready(function () {
            get_data();
            completed_data();
            delete_task();
            loadingPET();
        });
    </script>
</body>

</html>