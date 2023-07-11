<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act']; // membedakan prosesnya

if ($act == "loadingPET") {
    $sql = "SELECT COUNT(*) AS task_completed FROM tb_tasks WHERE user_id='$user_id' AND status_id=2";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $result = mysqli_fetch_array($query);
        $task_completed = $result['task_completed'];
        ?>

        <div class="pet_info_task_completed">
            <div class="pet_info_task_completed_track">
                <p>
                    <?php echo $task_completed ?> Task Completed
                </p>
            </div>
        </div>
        <?php
    } else {
        echo "Error: " . mysqli_error($conn); // Tampilkan pesan error jika query gagal
    }
}
?>