<?php   
include "config/security.php";
include "config/connection.php";
    $user_id = $_SESSION['id'];
    $email = $_SESSION['email'];
    $username = $_SESSION['username'];
    $profile_img = $_SESSION['profile_img']
 
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
<div id="add_task_form_container">
        <div class="form_container">
        <h1>NEW TASK</h1>
            <form method="post" action="sv_form.php">
                <h3>Title</h3>
                <div class="inputForm">
                    <input class="textField" type="text" name="task_name" id="task_name" placeholder="Type your email..."
                        required />
                    </div>
                    <h3>Description</h3>
                    <div class="inputForm">
                    <input class="textField" type="text" name="task_desc" id="task_desc" placeholder="Type your description..."
                    required />
                </div>
                <div class="inputForm">
                <h3>Category</h3>
                    <div class="customSelect">
                        <select name="category_id" id="category_id" required>
                        <option value="" selected disabled>Select a category</option>
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
                        <select name="priority_id" id="priority_id" required>
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
                    <h3>Due Date</h3>
                    <div class="inputForm">
                        <input class="textField" type="datetime-local" name="task_date" id="task_date" placeholder="Type your email..."
                            required />
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

</html>