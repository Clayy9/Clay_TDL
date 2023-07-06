<?php
include "config/security.php";
include "config/connection.php";

if(isset($_POST['submit'])) {
    $task_id = $_POST['task_id'];
    $task_name = $_POST['task_name'];
    $task_date = $_POST['task_date'];
    $task_desc = $_POST['task_desc'];
    // Lanjutkan dengan kolom-kolom data lain yang ingin Anda perbarui

    // Query untuk memperbarui data tugas
    $sql_update = "UPDATE tb_tasks SET 
                    task_name = '$task_name',
                    task_date = '$task_date',
                    task_desc = '$task_desc'
                    WHERE id = '$task_id'";

    $run_query = mysqli_query($conn, $sql_update);
    if ($run_query) {
        echo "Data task berhasil diperbarui";
        // Redirect ke halaman tampilan tugas (misalnya home.php)
        header("Location: home.php");
        exit();
    } else {
        echo "Gagal memperbarui data task: " . mysqli_error($conn);
    }
}
?>
