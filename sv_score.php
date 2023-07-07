<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act']; // membedakan prosesnya

if ($act == "saveScore") {
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
} else if ($act == "saveXP") {
    $sql = "SELECT tb_pets.* FROM tb_users LEFT JOIN tb_pets ON tb_users.pet_id = tb_pets.id";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        while ($result = mysqli_fetch_array($query)) {
            ?>
                <p>
                <?php echo $result['pet_score']; ?>XP
                </p>
            <?php
        }
    } else {
        echo "Error: " . mysqli_error($conn); // Tampilkan pesan error jika query gagal
    }
} else if ($act == "increaseXP") {
    $id = $_POST['id']; // Ambil nilai id dari input data POST

    // Ambil prioritas dari tabel tb_tasks berdasarkan id
    $sql = "SELECT priority_id FROM tb_tasks WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);

    if ($query) {
        $result = mysqli_fetch_assoc($query);
        $priority = $result['priority_id'];
        $xp_increase = 0;

        // Menghitung penambahan XP berdasarkan prioritas
        switch ($priority) {
            case 1:
                $xp_increase = 5;
                break;
            case 2:
                $xp_increase = 10;
                break;
            case 3:
                $xp_increase = 20;
                break;
            default:
                $xp_increase = 0;
                break;
        }

        // Memperbarui kolom "pet_score" dalam tabel "tb_pets" berdasarkan id
        $update_pet_score = "UPDATE tb_pets SET pet_score = pet_score + $xp_increase WHERE id = $id";
        mysqli_query($conn, $update_pet_score);
    } else {
        echo "Error: " . mysqli_error($conn); // Tampilkan pesan error jika query gagal
    }
}
?>