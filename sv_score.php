<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act']; //membedakan prosesnya
$id = $_POST['id'];
$completedVariable = 1;

if ($act == "saveScore") {
    $sql = "select * from tb_pets where id='$id'";
    $query = mysqli_query($conn, $sql);
    ?>

    <div class="pet_info">
            <div class="pet_info_name">
                <p><?php echo $petResult['pet_name']; ?></p>
            </div>

            <div class="pet_info_task_completed">
                <div class="pet_info_task_completed_track">
                    <p><?php echo $petResult['task_completed']; ?> Task Completed</p>
                </div>
                <div class="pet_info_task_completed_percentage">
                    <p><?php echo $completed_percentage; ?>XP</p>
                </div>
            </div>
        </div>        
        <?php
} else {}
?>


