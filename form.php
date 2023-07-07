<!-- Form untuk menambahkan data tugas -->
<form id="add_task_form_container" class="hidden">
    <div class=" back_to_home">
        <a onclick="location.href='home.php'"><i class="fa-solid fa-xmark fa-xl" style="color: #ffffff;"></i></a>
    </div>
    <div class="form_container">
        <h1>NEW TASK</h1>
        <h3>Title</h3>
        <div class="inputForm">
            <input class="textField" type="text" name="task_name" id="task_name" placeholder="Type your title..."
                required />
        </div>
        <h3>Description</h3>
        <div class="inputForm">
            <input class="textField" type="text" name="task_desc" id="task_desc"
                placeholder="Type your description..." />
        </div>
        <div class="inputForm">
            <h3>Category</h3>
            <div class="customSelect">
                <select name="category_id" id="category_id">
                    <option value="" selected disabled>Select a category</option>
                    <option value="0" default selected="selected">None</option>
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
                <select name="priority_id" id="priority_id">
                    <option value="" selected disabled>Select a priority</option>
                    <option value="1" default selected="selected">Low</option>
                    <option value="2">Medium</option>
                    <option value="3">High</option>
                </select>
                <span class="arrow"></span>
            </div>
        </div>

        <div class="inputForm_date">
            <div class="inputForm">
                <h3>Date</h3>
                <div class="inputForm">
                    <input class="textField" type="date" name="task_date" id="task_date" />
                </div>
            </div>
        </div>

        <div class="inputForm_date">
            <div class="inputForm">
                <h3>Time</h3>
                <div class="inputForm">
                    <input class="textField" type="time" name="task_time" id="task_time" />
                </div>
            </div>
        </div>

        <div class="button_submit">
            <td colspan="2"><input class="form_button" type="button" value="ADD TASK" name="submit" onclick="addTask()">
            </td>
        </div>
    </div>
    </div>
</form>

<!-- Form untuk update data tugas -->
<form id="edit_task_form_container" class="hidden">
    <div id="edit_task_form_container" class="hidden">
        <div class="back_to_home">
            <a onclick="location.href='home.php'"><i class="fa-solid fa-xmark fa-xl" style="color: #ffffff;"></i></a>
        </div>
        <div class="form_container">
            <h1>EDIT TASK</h1>
            <input type="hidden" name="task_id" value="<?php echo $task_id; ?>">
            <input type="hidden" name="status_id" value="<?php echo $status_id; ?>">
            <input type="hidden" name="reminder_id" value="<?php echo $reminder_id; ?>">
            <div class="back_to_home">
                <a onclick="location.href='home.php'"><i class="fa-solid fa-xmark fa-xl"
                        style="color: #ffffff;"></i></a>
            </div>
            <h3>Title</h3>
            <div class="inputForm">
                <input class="textField" type="text" value="<?php echo $task_name; ?>" name="task_name" id="task_name"
                    placeholder="Type your title..." required />
            </div>
            <h3>Description</h3>
            <div class="inputForm">
                <input class="textField" type="text" value="<?php echo $task_desc; ?>" name="task_desc" id="task_desc"
                    placeholder="Type your description..." />
            </div>
            <div class="inputForm">
                <h3>Category</h3>
                <div class="customSelect">
                    <select name="category_id" id="category_id" value="<?php echo $category_id; ?>">
                        <option value="" selected disabled>
                            <?php echo $category_display ?>
                        </option>
                        <option value="0">None</option>
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
                    <select name="priority_id" id="priority_id" value="<?php echo $priority_id; ?>">
                        <option value="" selected disabled>
                            <?php echo $priority_display ?>
                        </option>
                        <option value="1">Low</option>
                        <option value="2">Medium</option>
                        <option value="3">High</option>
                    </select>
                    <span class="arrow"></span>
                </div>
            </div>

            <div class="inputForm_date">
                <div class="inputForm">
                    <h3>Date</h3>
                    <div class="inputForm">
                        <input class="textField" type="date" name="task_date" id="task_date"
                            value="<?php echo $task_date; ?>" />
                    </div>
                </div>
            </div>

            <div class="inputForm_date">
                <div class="inputForm">
                    <h3>Time</h3>
                    <div class="inputForm">
                        <input class="textField" type="time" name="task_time" id="task_time"
                            value="<?php echo $task_date; ?>" />
                    </div>
                </div>
            </div>

            <div class="button_submit">
                <td colspan="2"><input class="form_button" type="button" value="ADD TASK" name="submit" onclick="editTask(<?php echo $task_id; ?>)></td>
                </div>
        </div>
</div>
</form>