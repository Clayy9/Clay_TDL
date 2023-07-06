<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act']; //membedakan prosesnya
$completed_percentage = 0;

if ($act == "saveScore") {
    $sql = "SELECT COUNT(*) AS task_completed FROM tb_tasks WHERE user_id='$user_id' AND status_id=2";
    $query = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_array($query)) {
        $task_completed = $result['task_completed'];
        ?>

            <div class="pet_info_task_completed">
                <div class="pet_info_task_completed_track">
                    <p><?php echo $task_completed ?> Task Completed</p>
                </div>
            </div>
        </div>
        <?php
    }
} else if ($act == "saveXP")
{
    $sql = "SELECT tb_pets.* FROM tb_users LEFT JOIN tb_pets ON tb_users.pet_id = tb_pets.id";
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_array($query)) {
            ?>
            <p><?php echo $result['pet_score']; ?>XP</p>
            <?php
        }
}
?>


