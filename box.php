<?php
include "config/security.php";
include "config/connection.php";
$user_id = $_SESSION['id'];
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

    <?php
    $sql = "SELECT t.*, c.category_name, c.category_img FROM tb_tasks t LEFT JOIN tb_categories c ON t.category_id = c.id WHERE user_id = '$user_id' ORDER BY task_date ";
    $query = mysqli_query($conn, $sql);
    ?>

    <div class="container_task_all">
        <div class="task_active">
            <div class="task_head">
                <div class="task_feature">
                    <a id="back_button" onclick="location.href='home.php'" )>
                        <i class=" fa-solid fa-house" style="color: #ffffff;"></i>
                </div>
                <div class="task_title">
                    <p>Your task</p>
                </div>

            </div>

            <?php
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
                <div class="task_active_list" id="active_tasks">
                    <div class="task_active_card">
                        <div class="task_category">
                            <img class="task_category_img" src="./assets/images/category/<?php echo $category_img ?>"
                                alt="">
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
                        <!-- <div class="task_checkbox">
                            <input type="checkbox" id="undone<?php echo $task_id; ?>"
                                onclick="check_task(<?php echo $task_id; ?>)" />
                            <button type="button" style="cursor:pointer" id="delete_undone<?php echo $task_id; ?>"
                                onclick="delete_task(<?php echo $task_id; ?>)" class="button_delete" value="Delete">
                                <p style="cursor:pointer">Delete</p>
                            </button>
                            <button type="button" style="cursor:pointer" id="update_undone<?php echo $task_id; ?>"
                                onclick="editTask(<?php echo $task_id; ?>)" id="edit_task_button<?php echo $task_id; ?>"
                                class="button_update" value="Edit">
                                <p style="cursor:pointer">Edit</p>
                            </button>
                        </div> -->
                    </div>
                </div>

                <br>
                <?php
            }

            ?>
        </div>


</body>
<!-- Script -->
<script src="./assets/js/jquery-3.7.0.js"></script>
<script src="./assets/js/script.js"></script>
<script src="https://kit.fontawesome.com/67a87c1aef.js" crossorigin="anonymous"></script>

</html>