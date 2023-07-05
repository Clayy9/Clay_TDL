<?php
include "config/security.php";
include "config/connection.php";

$user_id = $_SESSION['id'];
$act = $_POST['act']; //membedakan prosesnya
$id = $_POST['id'];

if($act == "set_done"){
    $sql = "update tb_tasks set status_id=2 where id='$id'";
    $query = mysqli_query($conn, $sql);
} 
else if($act == "uncheck"){
    $sql = "update tb_tasks set status_id=1 where id='$id'";
    $query = mysqli_query($conn, $sql);
}
else if($act == "loading"){
    $sql = "select t.*, c.category_name, c.category_img from tb_tasks t left join tb_categories c on t.category_id = c.id where user_id='$user_id' and status_id=1";
    $query = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_array($query)) {
        $task_id = $result['id'];
        $task_title = $result['task_name'];
        $task_deadline = $result['task_date'];
        $task_desc = $result['task_desc'];
        $category = $result['category_name'];
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
                    <input type="checkbox" id="undone<?php echo $task_id; ?>" onclick="check_task(<?php echo $task_id; ?>)"/>
                </form>
            </div>
        </div>
        
        <br>
    <?php
    }
}else if($act == "completed"){
    $sql = "select t.*, c.category_name, c.category_img from tb_tasks t left join tb_categories c on t.category_id = c.id where user_id='$user_id' and status_id=2";
    $query = mysqli_query($conn, $sql);
    while ($result = mysqli_fetch_array($query)) {
        $task_id = $result['id'];
        $task_title = $result['task_name'];
        $task_deadline = $result['task_date'];
        $task_desc = $result['task_desc'];
        $category = $result['category_name'];
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
                    <input type="checkbox" id="done<?php echo $task_id; ?>" onclick="uncheck_task(<?php echo $task_id; ?>)"  checked/>
                </form>
            </div>
        </div>
        
        <br>
    <?php
    }
}
?>