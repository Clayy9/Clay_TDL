<?php   
include "config/connection.php";
include "config/security.php";
$id = $_SESSION['id'];
$email = $_SESSION['email'];
$getData = mysqli_query($conn, "select * from tb_users where id='$id'");
$row = mysqli_fetch_assoc($getData);
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

    <script src="https://kit.fontawesome.com/67a87c1aef.js" crossorigin="anonymous"></script>

<body>
    <div class="left">
    <div class="profile">
        <div class="container_profile">
            <img  class="profile_img" src=" ./assets/images/<?php echo $row['profile_img']; ?>" alt="">
        </div>
        <div class="profile_desc">
            <p class="profile_desc_username"><?php echo $row['username']; ?></p>
            <p class="profile_desc_email"><?php echo $email ?></p>
        </div>
        <div class="logout">
        <button class="button_logout"><a href="logout.php"><i class="fa-solid fa-right-from-bracket" style="color: #ffffff;"></i>Logout</a></button>
        </div>
    </div>

    <div class="container_pet">
        <div class="pet_display">

        <?php
            $sql = "select * from tb_users left join tb_pets on tb_users.pet_id = tb_pets.id";
            $query = mysqli_query($conn, $sql);
            while ($petResult = mysqli_fetch_array($query)) {
                ?>
                <img class="pet_display_img" src="./assets/images/pet/<?php echo $petResult['pet_img']?>"/>
        </div>

        <div class="pet_info">
            <div class="pet_info_name">
                <p><?php echo $petResult['pet_name']; ?></p>
            </div>
            <div class="pet_info_level">

            </div>
            <div class="pet_info_task_completed">
                <div class="pet_info_task_completed_track">
                    <p>30 Task Completed</p>
                </div>
                <div class="pet_info_task_completed_percentage">
                    <p>30%</p>
                </div>
            </div>
        </div>

        <?php } ?>
        

    </div>
</div>

<div class="right">
    <div class="container_task">
        <div class="task_active">
            <div class="task_head">
                <div class="task_title">
                    <p>Your task</p>
                </div>
                <div class="add_task">
                    <a onclick="addNewTask()"><i class="fa-sharp fa-solid fa-plus" style="color: #ffffff;"></i></a>
                </div>
            </div>

            <div class="task_active_list">
            <?php
            $sql = "select * from tb_tasks left join tb_categories on tb_tasks.category_id = tb_categories.id";
            $query = mysqli_query($conn, $sql);
            while ($result = mysqli_fetch_array($query)) {
                $task_title = $result['task_name'];
                $task_deadline = $result['task_date'];
                $task_desc = $result['task_desc'];
                $category = $result['category_id'];
                $category_img = $result['category_img'];
                ?>
                
                <div class="task_active_card">
                    <div class="task_category">
                        <img class="task_category_img" src="./assets/images/category/<?php echo $category_img?>" alt="">
                    </div>
                    <div class="task_info">
                        <div class="task_subtitle">
                            <p><?php echo $task_title; ?></p>
                        </div>
                        <div class="task_deadline">
                            <i class="fa-solid fa-clock" style="color: white;"></i>                        
                            <p><?php echo $task_deadline; ?></p>
                        </div>
                        <div class="task_desc">
                            <p><?php echo $task_desc; ?></p>
                        </div>
                        </div>
                    <div class="task_checkbox">
                        <form>
                            <input type="checkbox" id="done" onclick="check_task()"/>
                        </form>
                    </div>
            <?php
            }
            ?>
                </div>
            </div>
        </div>

        <div class="task_completed">
            <div class="task_title">
                <p>Completed Task</p>
            </div>
            <div class="task_active_list">
                <div class="task_active_card">
                    <div class="task_category">
                        <img class="task_category_img" src="./assets/images/category/Category=Medic.png" alt="">
                    </div>
                    <div class="task_info">
                        <div class="task_subtitle">
                            <p>Judul</p>
                        </div>
                        <div class="task_deadline">
                            <i class="fa-solid fa-clock" style="color: white;"></i>                        
                            <p>Tanggal</p>
                        </div>
                        <div class="task_desc">
                            <p>Ini adalah deskripsi dari task saya</p>
                        </div>
                        </div>
                    <div class="task_checkbox">
                        <form>
                            <input type="checkbox" id="done" onclick="check_task()"/>
                        </form>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<div id="add_task_form_container">
        <div class="form_container">
        <h1>Add New Task</h1>
            <form method="post" action="sv_task.php">
                <h3>Title</h3>
                <div class="inputForm">
                    <input class="textField" type="text" name="email" id="email" placeholder="Type your email..."
                        required />
                </div>
                <h3>Description</h3>
                <div class="inputForm">
                    <input class="textField" type="text" name="email" id="email" placeholder="Type your email..."
                        required />
                </div>
                <h3>Category</h3>
                <div class="inputForm">
                    <input class="textField" type="text" name="email" id="email" placeholder="Type your email..."
                        required />
                </div>
                <div class="button_submit">
                    <center>
                        <td colspan="2"><input class="button" type="submit" value="Login" name="submit"></td>
                    </center>
                </div>
            </form>
        </div>
</div>

</body>

<!-- Script -->
<script src="./assets/js/script.js"></script> 
</html>