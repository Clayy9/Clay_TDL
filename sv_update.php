<?php
include "config/security.php";
include "config/connection.php";

$task_id = $_POST['task_id'];
$task_name = $_POST['task_name'];
$task_date = $_POST['task_date'];
$task_time = $_POST['task_time'];
$task_desc = $_POST['task_desc'];
$priority_id = $_POST['priority_id'];
$category_id = $_POST['category_id'];
$reminder_id = $_POST['reminder_id'];
$status_id = $_POST['status_id'];
$user_id = $_SESSION['id'];




// Memanggil Data dari priority_id dan category_id
$sql_select = "SELECT priority_id, category_id FROM tb_tasks WHERE id = '$task_id'";
$result = mysqli_query($conn, $sql_select);
$task = mysqli_fetch_assoc($result);

if ($task) {
    $old_priority_id = $task['priority_id'];
    $old_category_id = $task['category_id'];
} else {
    echo "Data task tidak ditemukan";
    exit();
}

// Menggunakan value lama jika value baru kosong
if ($priority_id == '') {
    $priority_id = $old_priority_id;
}
if ($category_id == '') {
    $category_id = $old_category_id;
}

// Query untuk memperbarui data tugas
$sql_update = "UPDATE tb_tasks SET 
                task_name = '$task_name',
                task_date = '$task_date',
                task_time = '$task_time',
                task_desc = '$task_desc',
                priority_id = '$priority_id',
                category_id = '$category_id',
                reminder_id = '$reminder_id',
                status_id = '$status_id',
                user_id = '$user_id'
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
?>