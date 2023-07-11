<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act']; // membedakan prosesnya
$id = $_POST['id'] ?? '';

if ($act == "set_done") {
    $sql = "UPDATE tb_tasks SET status_id = 2 WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);

} else if ($act == "uncheck") {
    $sql = "UPDATE tb_tasks SET status_id = 1 WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);

} else if ($act == "loadingPET") {
    $sql = "SELECT tb_pets.*, tb_users.*, tb_tasks.*, (SELECT COUNT(*) FROM tb_tasks WHERE user_id='$user_id' AND status_id=2) AS task_completed FROM tb_users LEFT JOIN tb_pets ON tb_users.pet_id = tb_pets.id LEFT JOIN tb_tasks ON tb_users.id = tb_tasks.user_id";
    $query = mysqli_query($conn, $sql);
    $result = mysqli_fetch_array($query);
    $task_completed = $result['task_completed'];

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
                        <div class="pet_info_task_completed">
                            <div class="pet_info_task_completed_track">
                                <p>
                            <?php echo $task_completed ?> Task Completed
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="pet_info_task_completed_percentage" id="pet_xp">
                        <p>
                    <?php echo $result['xp'] ?> XP
                        </p>
                    </div>
                </div>
            </div>
            </div>

    <?php
} else if ($act == "addXP") {
    $task_id = $_POST['task_id'];
    $user_id = $_SESSION['id'];
    $checkPriority = "SELECT priority_id from tb_tasks WHERE id = '$task_id' AND user_id = '$user_id'";
    $resultPriority = mysqli_query($conn, $checkPriority);

    $priority_value = mysqli_fetch_array($resultPriority)['priority_id'];

    $checkXP = "SELECT xp FROM tb_users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $checkXP);
    $currentXP = mysqli_fetch_array($result)['xp'];

    $newScore = $currentXP + $priority_value;

    $sqlUpdate = "UPDATE tb_users SET xp = '$newScore' WHERE id = '$user_id'";
    $queryUpdate = mysqli_query($conn, $sqlUpdate);

    ?>
                <p>
        <?php echo $newScore; ?> XP
                </p>
    <?php

?>
    <?php
    } else if ($act == "add") {
        $task_name = $_POST['task_name'];
        $task_date = $_POST['task_date'];
        if (empty($task_date)) {
            $task_date = date('Y-m-d');
        }

        $task_time = $_POST['task_time'];
        if (empty($task_time)) {
            $task_time = "00:00";
        }

        $task_desc = $_POST['task_desc'];
        if (empty($task_desc)) {
            $task_desc = "Tidak ada deskripsi";
        }

        $priority_id = $_POST['priority_id'];
        if (empty($priority_id)) {
            $priority_id = "1";
        }

        $user_id = $_SESSION['id'];

        $category_id = $_POST['category_id'];
        if (empty($category_id)) {
            $category_id = "0";
        }

        $reminder_id = 1; // Nilai kunci asing reminder_id yang valid
        $status_id = 1; // Nilai kunci asing status_id yang valid
    
        $sql_insert = "INSERT INTO tb_tasks (task_name, task_date, task_time, task_desc, priority_id, user_id, category_id, reminder_id, status_id) VALUES ('$task_name', '$task_date', '$task_time', '$task_desc', '$priority_id', '$user_id', '$category_id', '$reminder_id', '$status_id')";
        $run_query_check = mysqli_query($conn, $sql_insert);
        if (!$run_query_check) {
            die('Query error: ' . mysqli_error($conn));
        } else {
            ?>
                        <script>
                            alert("New Task Succeed");
                        </script>
            <?php
            header("Refresh:0.1; url=home.php");
        }

    } else if ($act == "edit") {
        $sql = "SELECT * FROM tb_tasks WHERE id = '$id'";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($query);

        $task_id = $result['id'];
        $task_name = $result['task_name'];
        $task_desc = $result['task_desc'];
        $category_id = $result['category_id'];
        $priority_id = $result['priority_id'];
        $task_date = $result['task_date'];
        $task_time = $result['task_time'];
        $reminder_id = $result['reminder_id'];
        $status_id = $result['status_id'];

        echo "|" . $task_id . "|" . $task_name . "|" . $task_desc . "|" . $category_id . "|" . $priority_id . "|" . $task_date . "|" . $task_time . "|" . $reminder_id . "|" . $status_id . "|";

    } else if ($act == "update") {
        $task_id = $_REQUEST['id'];
        $task_name = $_POST['task_name'];
        $task_desc = $_POST['task_desc'];
        $category_id = $_POST['category_id'];
        $priority_id = $_POST['priority_id'];
        $task_date = $_POST['task_date'];
        $task_time = $_POST['task_time'];
        $reminder_id = $_POST['reminder_id'];
        $status_id = $_POST['status_id'];

        $sql = "UPDATE tb_tasks SET task_name = '$task_name', task_time = '$task_time', task_date = '$task_date', task_name = '$task_name', task_desc = '$task_desc', priority_id = '$priority_id', user_id = '$user_id', category_id = '$category_id', reminder_id = '$reminder_id', status_id = '$status_id' WHERE id = '$task_id'";
        mysqli_query($conn, $sql);


        // } else if ($act == "expiredTask") {
//     $task_id = $_REQUEST['id'];
//     $sql = "SELECT * FROM tb_tasks WHERE user_id = '$user_id' AND task_id = '$task_id'";
//     $query = mysqli_query($conn, $sql);
//     $result = mysqli_fetch_array($query);
    

        //     $task_date = $result['task_date'];
    
        //     if ($result['task_date'] < date('Y-m-d')) {
//         $sqlUpdate = "UPDATE tb_task SET status_id = 3 WHERE task_id = '$task_id'";
//         mysqli_query($conn, $sqlUpdate);
//     }
    


    } else if ($act == "loading") {
        $sql = "SELECT t.*, c.category_name, c.category_img FROM tb_tasks t LEFT JOIN tb_categories c ON t.category_id = c.id WHERE user_id = '$user_id' AND status_id = 1 ORDER BY task_date ";
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_array($query)) {
            $task_id = $result['id'];
            $task_title = $result['task_name'];
            $task_date = $result['task_date'] == date('Y-m-d') ? 'Today' : date('d-m-Y', strtotime($result['task_date']));
            $task_time = $result['task_time'] == "00:00:00" ? '' : date('H:i', strtotime($result['task_time']));
            $task_desc = $result['task_desc'];
            $category = $result['category_name'];
            $category_img = $result['category_img'];

            $task_date = $result['task_date'] == date('Y-m-d') ? 'Today' : date('d-m-Y', strtotime($result['task_date']));

            if ($result['task_date'] < date('Y-m-d')) {
                $task_date = '<span style="color: red; font-family:"Satoshi-Bold";">' . $task_date . '</span>';
                $status_id = 3;
            }

            ?>

                                    <div class="task_active_card">
                                        <div class="task_category">
                                            <img class="task_category_img" src="./assets/images/category/<?php echo $category_img ?>" alt="">
                                        </div>
                                        <div class="task_info">
                                            <div class="task_subtitle">
                                                <p>
                        <?php echo $task_title; ?>
                                                </p>
                                            </div>
                                            <div class="task_deadline">
                                                <i class="fa-solid fa-clock" style="color: white;"></i>
                                                <p>
                        <?php echo $task_date; ?>
                                                </p>
                                                <p>⠀
                        <?php echo $task_time; ?>
                                                </p>
                                            </div>
                                            <div class="task_desc">
                                                <p>
                        <?php echo $task_desc; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="task_checkbox">
                                            <input type="checkbox" id="undone<?php echo $task_id; ?>" data-task-id="<?php echo $task_id; ?>"
                                                data-priority="<?php echo $priority_id; ?>" onclick="check_task(<?php echo $task_id; ?>)" />
                                            <button type="button" style="cursor:pointer" id="delete_undone<?php echo $task_id; ?>"
                                                onclick="delete_task(<?php echo $task_id; ?>)" class="button_delete" value="Delete">
                                                <p style="cursor:pointer">Delete</p>
                                            </button>
                                            <button type="button" style="cursor:pointer" id="update_undone<?php echo $task_id; ?>"
                                                onclick="editTask(<?php echo $task_id; ?>)" id="edit_task_button<?php echo $task_id; ?>"
                                                class="button_update" value="Edit">
                                                <p style="cursor:pointer">Edit</p>
                                            </button>
                                        </div>
                                    </div>

                                    <br>
        <?php
        }
    } else if ($act == "completed") {
        $sql = "SELECT t.*, c.category_name, c.category_img FROM tb_tasks t LEFT JOIN tb_categories c ON t.category_id = c.id WHERE user_id = '$user_id' AND status_id = 2";
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_array($query)) {
            $task_id = $result['id'];
            $task_title = $result['task_name'];
            $task_date = $result['task_date'] == date('Y-m-d') ? 'Today' : date('d-m-Y', strtotime($result['task_date']));
            $task_time = $result['task_time'] == "00:00:00" ? '' : date('H:i', strtotime($result['task_time']));
            $task_desc = $result['task_desc'];
            $category = $result['category_name'];
            $category_img = $result['category_img'];

            ?>

                                        <div class="task_active_card">
                                            <div class="task_category">
                                                <img class="task_category_img" src="./assets/images/category/<?php echo $category_img ?>" alt="">
                                            </div>
                                            <div class="task_info">
                                                <div class="task_subtitle">
                                                    <p>
                        <?php echo $task_title; ?>
                                                    </p>
                                                </div>
                                                <div class="task_deadline">
                                                    <i class="fa-solid fa-clock" style="color: white;"></i>
                                                    <p>
                        <?php echo $task_date; ?>
                                                    </p>
                                                </div>
                                                <div class="task_desc">
                                                    <p>
                        <?php echo $task_desc; ?>
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="task_checkbox">
                                                <input type="checkbox" id="done<?php echo $task_id; ?>" onclick="uncheck_task(<?php echo $task_id; ?>)"
                                                    checked />
                                                <button type="button" id="delete_done<?php echo $task_id; ?>" onclick="delete_task(<?php echo $task_id; ?>)"
                                                    class="button_delete" value="Delete">
                                                    <p style="cursor:pointer">Delete</p>
                                                </button>
                                                <button type="button" style="cursor:pointer" id="update_undone<?php echo $task_id; ?>"
                                                    onclick="editTask(<?php echo $task_id; ?>)" id="edit_task_button<?php echo $task_id; ?>"
                                                    class="button_update" value="Edit">
                                                    <p style="cursor:pointer">Edit</p>
                                                </button>
                                            </div>
                                        </div>

                                        <br>
        <?php
        }
    } else if ($act == "filter") {
        $fromDate = $_POST['task_date_filter_from'];
        $toDate = $_POST['task_date_filter_to_date'];
        $statusFilter = $_POST['status_id_filter'];

        $sql = "SELECT t.*, c.category_name, c.category_img FROM tb_tasks t LEFT JOIN tb_categories c ON t.category_id = c.id WHERE user_id = '$user_id'";

        if ($statusFilter == "") {
            $sql .= " AND status_id = '$id'";
        } else if ($statusFilter == "1") {
            $sql .= " AND status_id = 1";
        } else if ($statusFilter == "2") {
            $sql .= " AND status_id = 2";
        } else if ($statusFilter == "3") {
            $sql .= " AND status_id = 3";
        }


        if ($fromDate !== '' && $toDate !== '') {
            $sql .= "AND (t.task_date BETWEEN DATE('$fromDate') AND DATE('$toDate'))";
        } else if ($fromDate !== '' && $toDate == '') {
            $sql .= "AND (t.task_date BETWEEN DATE('$fromDate') AND DATE(0000-00-00))";
        } else if ($fromDate == '' && $toDate !== '') {
            $sql .= "AND (t.task_date BETWEEN DATE(0000-00-00) AND DATE('$toDate'))";
        }

        $sql .= " ORDER BY t.task_date ASC";

        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_array($query)) {
            $task_id = $result['id'];
            $task_title = $result['task_name'];
            $task_date = $result['task_date'] == date('Y-m-d') ? 'Today' : date('d-m-Y', strtotime($result['task_date']));
            $task_time = $result['task_time'] == "00:00:00" ? '' : date('H:i', strtotime($result['task_time']));
            $task_desc = $result['task_desc'];
            $category = $result['category_name'];
            $category_img = $result['category_img'];
            ?>

                                            <div class="task_active_card">
                                                <div class="task_category">
                                                    <img class="task_category_img" src="./assets/images/category/<?php echo $category_img ?>" alt="">
                                                </div>
                                                <div class="task_info">
                                                    <div class="task_subtitle">
                                                        <p>
                        <?php echo $task_title; ?>
                                                        </p>
                                                    </div>
                                                    <div class="task_deadline">
                                                        <i class="fa-solid fa-clock" style="color: white;"></i>
                                                        <p>
                        <?php echo $task_date; ?>
                                                        </p>
                                                        <p>⠀
                        <?php echo $task_time; ?>
                                                        </p>
                                                    </div>
                                                    <div class="task_desc">
                                                        <p>
                        <?php echo $task_desc; ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="task_checkbox">
                                                    <input type="checkbox" id="undone<?php echo $task_id; ?>" onclick="check_task(<?php echo $task_id; ?>)"
                                                        selected />
                                                    <button type="button" style="cursor:pointer" id="delete_undone<?php echo $task_id; ?>"
                                                        onclick="delete_task(<?php echo $task_id; ?>)" class="button_delete" value="Delete">
                                                        <p style="cursor:pointer">Delete</p>
                                                    </button>
                                                    <button type="button" style="cursor:pointer" id="update_undone<?php echo $task_id; ?>"
                                                        onclick="editTask(<?php echo $task_id; ?>)" class="button_update" value="Edit">
                                                        <p style="cursor:pointer">Edit</p>
                                                    </button>
                                                </div>
                                            </div>

                                            <br>
        <?php
        }
    }
?>