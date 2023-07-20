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
    // Lakukan penghapusan record di dalam tb_reminders
    $deleteRemindersQuery = "DELETE FROM tb_reminders WHERE task_id = '$id'";
    mysqli_query($conn, $deleteRemindersQuery);

    $sql = "DELETE FROM tb_tasks WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);

} else if ($act == "checkDateTime") {
    $user_id = $_SESSION['id'];

    // Menggunakan timezone Asia Jakarta
    date_default_timezone_set('Asia/Jakarta');

    // Mendapatkan tanggal dan waktu hari ini
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:00', time());

    $sql = "SELECT tb_reminders.*, tb_tasks.* FROM tb_reminders LEFT JOIN tb_tasks ON tb_reminders.task_id = tb_tasks.id WHERE reminder_date = '$currentDate' AND reminder_time = '$currentTime' AND tb_tasks.user_id = '$user_id' AND tb_tasks.status_id = 1";
    $query = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($query);

    if ($numRows > 0) {
        $result = mysqli_fetch_array($query);

        // Memanggil Ringtone
        $sqlRingtone = "SELECT tb_users.ringtone_id, tb_ringtones.* FROM tb_users LEFT JOIN tb_ringtones ON tb_users.ringtone_id = tb_ringtones.id WHERE tb_users.id = '$user_id'";
        $queryRingtone = mysqli_query($conn, $sqlRingtone);
        $resultRingtone = mysqli_fetch_array($queryRingtone);

        ?>
                    <script>

                        // Menutup modal reminder
                        const reminderModal = document.getElementById("reminder");
                        const reminderModalButton = document.getElementById("button_close_reminder");

                        reminderModalButton.addEventListener('click', function () {
                            reminderModal.style.display = "none";
                            reminderModal.style.visibility = "hidden";
                            reminderModal.style.opacity = "0";
                        });

                        // Mengecek apakah fitur Autoplay didukung oleh peramban
                        function isAutoplaySupported() {
                            // Periksa apakah peramban mendukung fitur Autoplay
                            if ("autoplay" in document.createElement("audio")) {
                                return true;
                            } else {
                                return false;
                            }
                        }

                        // Memainkan ringtone
                        function playRingtone() {
                            var ringtone = new Audio("./assets/ringtones/<?php echo $resultRingtone['sound']; ?>");
                            ringtone.play();
                            ringtone.autoplay = true;
                        }

                        // Fungsi untuk memulai pemutaran ringtone setelah interaksi pengguna
                        function startAutoplay() {
                            if (isAutoplaySupported()) {
                                playRingtone();
                            } else {
                                // Jika Autoplay tidak didukung, tampilkan pesan untuk mengingatkan pengguna
                                alert("Reminder: ");
                            }
                        }

                        // Menambahkan event listener untuk deteksi interaksi pengguna
                        document.addEventListener('onload', function () {
                            startAutoplay();
                        });


                        // Memulai pemutaran otomatis saat halaman dimuat
                        startAutoplay();
                    </script>

                    <div class="reminder_container">
                        <div class="reminder_title">
                            <p>Task Reminder</p>
                        </div>
                        <div class="reminder_desc">
                            <p>You have an important task to complete</p>
                            <p>Title:
                    <?php echo $result['task_name']; ?> (
                    <?php echo $result['task_date']; ?>)
                            </p>
                        </div>
                        <div class="button_close_reminder">
                            <td colspan="2"><input class="reminder_button" type="button" value="CLOSE" id="button_close_reminder"
                                    onclick="closeReminder()">
                            </td>
                        </div>
                    </div>

            <?php

            header("Refresh:0");
    }

} else if ($act == "loadingPET") {
    $sql = "UPDATE tb_users
                    SET pet_phases_id = (
                    SELECT tb_pet_phases.id
                    FROM tb_pet_phases
                    LEFT JOIN tb_pets ON tb_pet_phases.pet_id = tb_pets.id
                    LEFT JOIN tb_users ON tb_users.pet_id = tb_pet_phases.pet_id
                    WHERE tb_users.id = '$user_id'
                    AND (
                    (xp >= min_xp AND xp <= max_xp)
                    OR (xp > max_xp AND max_xp = 100)
                    )
                    ORDER BY max_xp DESC
                    LIMIT 1
                    )
                    WHERE id = '$user_id'";

    $query = mysqli_query($conn, $sql);


    $sqlGetData = "SELECT tb_users.*, tb_pets.*, tb_pet_phases.*,
                            (SELECT COUNT(*) FROM tb_tasks WHERE user_id='$user_id' AND status_id=2) AS task_completed
                            FROM tb_users
                            LEFT JOIN tb_pet_phases ON tb_users.pet_phases_id = tb_pet_phases.id
                            LEFT JOIN tb_pets ON tb_users.pet_id = tb_pets.id
                            WHERE tb_users.id='$user_id' AND
                            ((xp >= min_xp AND xp <= max_xp) OR (xp > max_xp OR max_xp = 100))
                            AND tb_users.pet_id = (SELECT tb_users.pet_id FROM tb_users WHERE id='$user_id' LIMIT 1)
                            ORDER BY tb_pet_phases.max_xp DESC LIMIT 1";

    $query = mysqli_query($conn, $sqlGetData);
    $resultUpdatePET = mysqli_fetch_array($query);
    $task_completed = $resultUpdatePET['task_completed'];

    ?>

                    <div class="pet_display">
                        <img class="pet_display_img" id="pet_display_img"
                            src="./assets/images/pet/<?php echo $resultUpdatePET['phase_img']; ?>"
                            alt="<?php echo $resultUpdatePET['phase_img']; ?>" />
                    </div>

                    <div class="pet_info">
                        <div class="pet_info_name">
                            <p>
                <?php echo $resultUpdatePET['pet_name']; ?>
                            </p>
                        </div>

                        <div class="pet_info_task_completed">
                            <div id="pet_score">
                                <div class="pet_info_task_completed">
                                    <div class="pet_info_task_completed_track">
                                        <p>
                            <?php echo $task_completed ?> Task Completed
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="pet_info_task_completed_percentage" id="pet_xp">
                                <p>
                    <?php echo $resultUpdatePET['xp'] ?> XP
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>

    <?php
} else if ($act == "addXP") {
    $task_id = $_POST['task_id'];
    $user_id = $_SESSION['id'];
    ?>

        <?php
        $checkPriority = "SELECT priority_id from tb_tasks WHERE id = '$task_id' AND user_id = '$user_id'";
        $resultPriority = mysqli_query($conn, $checkPriority);

        $priority_value = mysqli_fetch_array($resultPriority)['priority_id'];

        $checkXP = "SELECT xp FROM tb_users WHERE id = '$user_id'";
        $result = mysqli_query($conn, $checkXP);
        $currentXP = mysqli_fetch_array($result)['xp'];

        $newScore = $currentXP + $priority_value;

        $sqlUpdate = "UPDATE tb_users SET xp = '$newScore' WHERE id = '$user_id'";
        $queryUpdate = mysqli_query($conn, $sqlUpdate);

        ?>
                        <p>
        <?php echo $newScore; ?> XP
                        </p>
    <?php

?>
    <?php
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

        $reminder_number = $_POST['reminder_number'];
        $reminder_type = $_POST['reminder_type'];
        $totalTime = 0;
        $execReminder = false;

        // Olah data dari multiple input reminder
        $arrayLength = count($reminder_number);

        // Periksa apakah $reminder_number dan $reminder_type adalah array
        if (is_array($reminder_number) && is_array($reminder_type)) {
            $arrayLength = count($reminder_number); // atau count($reminder_type), keduanya harus memiliki panjang yang sama
    
            // Buat array untuk menyimpan nilai yang dihitung
            $totalTime = array();
            $execReminder = false;

            for ($i = 0; $i < $arrayLength; $i++) {
                if (!empty($reminder_number[$i]) && !empty($reminder_type[$i])) {
                    // Proses reminder_number jika memiliki nilai
                    if ($reminder_number[$i] != "") {
                        if ($reminder_type[$i] == "minutes") {
                            $totalTime[$i] = $reminder_number[$i];
                        } else if ($reminder_type[$i] == "hours") {
                            $totalTime[$i] = $reminder_number[$i] * 60;
                        } else if ($reminder_type[$i] == "days") {
                            $totalTime[$i] = $reminder_number[$i] * 1440;
                        }
                        $execReminder = true;
                    }
                }
            }
        }

        $status_id = 1;
        $sql_insert = "INSERT INTO tb_tasks(task_name, task_date, task_time, task_desc, priority_id, user_id, category_id, status_id) VALUES ('$task_name', '$task_date', '$task_time', '$task_desc', '$priority_id', '$user_id', '$category_id', '$status_id')";
        $run_query_check = mysqli_query($conn, $sql_insert);

        if ($execReminder) {
            for ($i = 0; $i < $arrayLength; $i++) {
                $reminder_date[$i] = date('Y-m-d', strtotime($task_date . ' ' . $task_time . ' - ' . $totalTime[$i] . ' minutes'));
                $reminder_time[$i] = date('H:i', strtotime($task_time . ' - ' . $totalTime[$i] . ' minutes'));

                $sqlGetTaskId = "SELECT id FROM tb_tasks ORDER BY id DESC LIMIT 1";
                $queryGetTaskId = mysqli_query($conn, $sqlGetTaskId);
                $resultGetTaskId = mysqli_fetch_array($queryGetTaskId);

                $task_id = $resultGetTaskId['id'];
                $sqlReminder = "INSERT INTO tb_reminders(task_id, reminder_date, reminder_time) VALUES('$task_id', '$reminder_date[$i]', '$reminder_time[$i]')";
                mysqli_query($conn, $sqlReminder);
            }
        }

    } else if ($act == "edit") {
        $id = $_POST['id'];

        $sql = "SELECT * FROM tb_tasks LEFT JOIN tb_reminders ON tb_tasks.id = tb_reminders.task_id WHERE tb_tasks.id = '$id'";
        $query = mysqli_query($conn, $sql);
        $result = mysqli_fetch_array($query);

        $task_id = $result['id'];
        $task_name = $result['task_name'];
        $task_desc = $result['task_desc'];
        $category_id = $result['category_id'];
        $priority_id = $result['priority_id'];
        $task_date = $result['task_date'];
        $task_time = $result['task_time'];
        $status_id = $result['status_id'];

        echo "|" . $task_id . "|" . $task_name . "|" . $task_desc . "|" . $category_id . "|" . $priority_id . "|" . $task_date . "|" . $task_time . "|" . $status_id . "|";

    } else if ($act == "update") {

        $task_id = $_POST['id'];
        $task_name = $_POST['task_name'];
        $task_desc = $_POST['task_desc'];
        $category_id = $_POST['category_id'];
        $priority_id = $_POST['priority_id'];
        $task_date = $_POST['task_date'];
        $task_time = $_POST['task_time'];
        $status_id = $_POST['status_id'];

        $sql = "UPDATE tb_tasks SET task_name = '$task_name', task_time = '$task_time', task_date = '$task_date', task_desc = '$task_desc', priority_id = '$priority_id', user_id = '$user_id', category_id = '$category_id', status_id = '$status_id' WHERE id = '$task_id'";
        $query = mysqli_query($conn, $sql);

        if ($query) {
            echo $sql;
            echo "data berhasil diperbarui";
        }

    } else if ($act == "loading") {
        $sql = "SELECT t.*, c.category_name, c.category_img FROM tb_tasks t LEFT JOIN tb_categories c ON t.category_id = c.id WHERE user_id = '$user_id' AND status_id = 1 ORDER BY task_date ";
        $query = mysqli_query($conn, $sql);
        while ($result = mysqli_fetch_array($query)) {
            $task_id = $result['id'];
            $task_title = $result['task_name'];
            $task_date = $result['task_date'] == date('Y-m-d') ? 'Today' : date('d-m-Y', strtotime($result['task_date']));
            $task_time = $result['task_time'] == "00:00:00" ? '' : date('H:i', strtotime($result['task_time']));
            $task_desc = $result['task_desc'];
            $category = $result['category_name'];
            $category_img = $result['category_img'];
            $priority_id = $result['priority_id'];

            $task_date = $result['task_date'] == date('Y-m-d') ? 'Today' : date('d-m-Y', strtotime($result['task_date']));

            // Menentukan tag pada title task
            $priority_tag = "";
            if ($priority_id == 1) {
                $priority_tag = "Low";
            } else if ($priority_id == "2") {
                $priority_tag = "Medium";
            } else if ($priority_id == "3") {
                $priority_tag = "High";
            }


            if ($result['task_date'] < date('Y-m-d')) {
                $task_date = '<span style="color: red; font-family: \'Satoshi-Bold\';">' . $task_date . '</span>';
                $status_id = 3;
            }

            ?>

                                            <div class="task_active_card">
                                                <div class="task_category">
                                                    <img class="task_category_img" src="./assets/images/category/<?php echo $category_img ?>" alt="">
                                                </div>
                                                <div class=" task_info">
                                                    <div class="task_subtitle">
                                                        <p>
                        <?php echo $task_title; ?><span class="priority_tag">
                            <?php echo $priority_tag; ?>
                                                            </span>
                                                        </p>
                                                    </div>
                                                    <div class="task_deadline">
                                                        <i class="fa-regular fa-calendar" style="color: #ffffff;"></i>
                                                        <p>
                        <?php echo $task_date; ?>
                                                        </p>
                                                        <p>⠀
                                                            <i class="fa-solid fa-clock" style="color: white;"></i>
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
                                                    <input type="checkbox" id="undone<?php echo $task_id; ?>" data-task-id="<?php echo $task_id; ?>"
                                                        data-priority=" <?php echo $priority_id; ?>" onclick="check_task(<?php echo $task_id; ?>)" /> <button
                                                        type="button" style="cursor:pointer" id="delete_undone<?php echo $task_id; ?>"
                                                        onclick=" delete_task(<?php echo $task_id; ?>)" class="button_delete" value="Delete">
                                                        <p style="cursor:pointer">Delete</p>
                                                    </button>
                                                    <button type="button" style="cursor:pointer" id="update_undone<?php echo $task_id; ?>"
                                                        onclick=" editTask(<?php echo $task_id; ?>)" id="edit_task_button<?php echo $task_id; ?>"
                                                        class="button_update" value="Edit">
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
                                                    <div class=" task_info">
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
                                                            onclick="editTask(<?php echo $task_id; ?>)" id="edit_task_button<?php echo $task_id; ?>"
                                                            class="button_update" value="Edit">
                                                            <p style="cursor:pointer">Edit</p>
                                                        </button>
                                                    </div>
                                                </div>
                                                <br>
        <?php
        }
    } else if ($act == "filter") {
        $fromDate = $_POST['task_date_filter_from'];
        $toDate = $_POST['task_date_filter_to_date'];
        $statusFilter = $_POST['status_id_filter'];

        $sql = "SELECT t.*, c.category_name, c.category_img FROM tb_tasks t LEFT JOIN tb_categories c ON t.category_id = c.id WHERE user_id = '$user_id'";

        if ($statusFilter == "") {
            $sql .= " AND status_id = '$id'";
        } else if ($statusFilter == "1") {
            $sql .= " AND status_id = 1";
        } else if ($statusFilter == "2") {
            $sql .= " AND status_id = 2";
        } else if ($statusFilter == "3") {
            $sql .= " AND status_id = 3";
        }


        if ($fromDate !== '' && $toDate !== '') {
            $sql .= "AND (t.task_date BETWEEN DATE('$fromDate') AND DATE('$toDate'))";
        } else if ($fromDate !== '' && $toDate == '') {
            $sql .= "AND (t.task_date BETWEEN DATE('$fromDate') AND DATE(0000-00-00))";
        } else if ($fromDate == '' && $toDate !== '') {
            $sql .= "AND (t.task_date BETWEEN DATE(0000-00-00) AND DATE('$toDate'))";
        }

        $sql .= " ORDER BY t.task_date ASC";

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
                                                            <input type="checkbox" id="undone<?php echo $task_id; ?>" onclick="check_task(<?php echo $task_id; ?>)"
                                                                selected />
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
    }
?>