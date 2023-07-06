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
    <link rel="stylesheet" href="./assets/css/style_form.css">
</head>


<body>
<div class="back_to_home">
    <a onclick="location.href='home.php'"><i class="fa-solid fa-xmark fa-xl" style="color: #ffffff;"></i></a>
</div>

<?php
if(isset($_GET['task_id'])){
    $task_id = $_GET['task_id'];

    // Query untuk mendapatkan data tugas berdasarkan ID
    $sql_select = "SELECT * FROM tb_tasks WHERE id = '$task_id'";
    $result = mysqli_query($conn, $sql_select);
    $task = mysqli_fetch_assoc($result);

    // Periksa apakah data tugas ditemukan
    if($task){
        $task_name = $task['task_name'];
        $task_date = $task['task_date'];
        $task_time = $task['task_time'];
        $task_desc = $task['task_desc'];
        $priority_id = $task['priority_id'];
        $category_id = $task['category_id'];
        $reminder_id = $task['reminder_id'];
        $status_id = $task['status_id'];

        $old_priority_id = $priority_id;
        $old_category_id = $category_id;
        $old_reminder_id = $reminder_id;
        $old_status_id = $status_id;
    }
}
?>

<!-- Form untuk update data tugas -->
<div id="add_task_form_container">
        <div class="form_container">
        <h1>EDIT TASK</h1>
            <form method="post" action="sv_update.php">
            <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
            <input type="hidden" name="status_id" value="<?php echo $status_id; ?>">
            <input type="hidden" name="reminder_id" value="<?php echo $reminder_id; ?>">
                <div class="back_to_home">
                    <a onclick="location.href='home.php'"><i class="fa-solid fa-xmark fa-xl" style="color: #ffffff;"></i></a>
                </div>
                <h3>Title</h3>
                <div class="inputForm">
                    <input class="textField" type="text" value="<?php echo $task_name; ?>" name="task_name" id="task_name" placeholder="Type your title..." required />
                    </div>
                    <h3>Description</h3>
                    <div class="inputForm">
                    <input class="textField" type="text" value="<?php echo $task_desc; ?>" name="task_desc" id="task_desc" placeholder="Type your description..." />
                </div>
                <div class="inputForm">
                <h3>Category</h3>
                    <div class="customSelect">
                        <select name="category_id" id="category_id" value="<?php echo $category_id; ?>">
                        <option value="" selected disabled>Select a category</option>
                        <option value="0">None</option>
                        <option value="1">Medic</option>
                        <option value="2">Meeting</option>
                        <option value="3">Sport</option>
                        <option value="4">Study</option>
                        </select>
                        <span class="arrow"></span>
                    </div>
                </div>

                <div class="inputForm">
                <h3>Priority</h3>
                    <div class="customSelect">
                        <select name="priority_id" id="priority_id" value="<?php echo $priority_id; ?>">
                        <option value="" selected disabled>Select a priority</option>
                        <option value="1">Low</option>
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
                        <input class="textField" type="date" name="task_date" id="task_date" value="<?php echo $task_date; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="inputForm_date">
                    <div class="inputForm">
                    <h3>Due Date</h3>
                    <div class="inputForm">
                        <input class="textField" type="time" name="task_time" id="task_time" value="<?php echo $task_date; ?>"/>
                        </div>
                    </div>
                </div>

                <div class="button_submit">
                    <center>
                        <td colspan="2"><input class="form_button" type="submit" value="ADD TASK" name="submit"></td>
                    </center>
            </form>
                </div>
            </form>
        </div>
</div>
</form>

<!-- Script -->
<script src="./assets/js/jquery-3.7.0.js"></script> 
<script src="./assets/js/script.js"></script> 
<script src="https://kit.fontawesome.com/67a87c1aef.js" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {
        get_data();
        completed_data();
    });
</script>
</body>
</head>
