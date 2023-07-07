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

} else if ($act == "deleteTask") {
    $sql = "DELETE FROM tb_tasks WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);

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
    $task_date = $result['task_date'];
    $task_time = $result['task_time'];
    $task_desc = $result['task_desc'];
    $priority_id = $result['priority_id'];
    $user_id = $result['user_id'];
    $category_id = $result['category_id'];
    $reminder_id = $result['reminder_id'];
    $status_id = $result['status_id'];

    echo "|" . $task_id . "|" . $task_name . "|" . $task_date . "|" . $task_desc . "|" . $priority_id . "|" . $user_id . "|" . $category_id . "|" . $reminder_id . "|" . $status_id . "|";

    // Untuk display priority jika sebelumnya user sudah menambahkan value
    $priority_display = 'None';
    if ($priority_id == '1') {
        $priority_display = 'Low';
    } else if ($priority_id == '2') {
        $priority_display = 'Medium';
    } else if ($priority_id == '3') {
        $priority_display = 'High';
    }

    // Untuk display category jika sebelumnya user sudah menambahkan value
    $category_display = 'None';
    if ($category_id == '0') {
        $category_display = 'None';
    } else if ($category_id == '1') {
        $category_display = 'Medic';
    } else if ($category_id == '2') {
        $category_display = 'Meeting';
    } else if ($category_id == '3') {
        $category_display = 'Sport';
    } else if ($category_id == '4') {
        $category_display = 'Study';
    }

    // Query untuk memperbarui data tugas
    $sql_update = "UPDATE tb_tasks SET task_name = '$task_name', task_date = '$task_date', task_time = '$task_time', task_desc = '$task_desc', priority_id = '$priority_id', category_id = '$category_id', reminder_id = '$reminder_id', status_id = '$status_id', user_id = '$user_id' WHERE id = '$id'";
    mysqli_query($conn, $sql_update);

} else if ($act == "loading") {
    $sql = "SELECT t.*, c.category_name, c.category_img FROM tb_tasks t LEFT JOIN tb_categories c ON t.category_id = c.id WHERE user_id = '$user_id' AND status_id = 1 ORDER BY task_date ASC";
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
                                    <input type="checkbox" id="undone<?php echo $task_id; ?>" onclick="check_task(<?php echo $task_id; ?>)" />
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
                                            onclick="location.href='form_update.php?task_id=<?php echo $task_id; ?>'" class="button_update"
                                            value="Edit">
                                            <p style="cursor:pointer">Edit</p>
                                        </button>
                                    </div>
                                </div>

                                <br>
        <?php
    }
}
?>