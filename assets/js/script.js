function check_task(task_id) {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      id: task_id,
      act: "set_done",
    },
    success: function (result) {
      get_data();
      completed_data();
      saveScore();
      saveXP();
    },
  });
}

function uncheck_task(task_id) {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      id: task_id,
      act: "uncheck",
    },
    success: function (result) {
      get_data();
      completed_data();
      saveScore();
      saveXP();
    },
  });
}

function delete_task(task_id) {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      id: task_id,
      act: "deleteTask",
    },
    success: function (result) {
      get_data();
      completed_data();
      saveScore();
      saveXP();
    },
  });
}

function get_data() {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      act: "loading",
    },
    success: function (result) {
      $("#active_tasks").html(result);
    },
  });
}

function completed_data() {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      act: "completed",
    },
    success: function (result) {
      $("#completed_tasks").html(result);
    },
  });
}

function saveScore() {
  $.ajax({
    url: "sv_score.php",
    method: "POST",
    data: {
      act: "saveScore",
    },
    success: function (result) {
      $("#pet_score").html(result);
    },
  });
}

function saveXP() {
  $.ajax({
    url: "sv_score.php",
    method: "POST",
    data: {
      act: "saveXP",
    },
    success: function (result) {
      $("#pet_xp").html(result);
    },
  });
}

// function addTask() {
//   $.ajax({
//     url: "sv_task.php",
//     method: "POST",
//     data: "add",
//     success: function (result) {
//       document.getElementById("id").value = "";
//       document.getElementById("task_name").value = "";
//       document.getElementById("task_date").value = "";
//       document.getElementById("task_desc").value = "";
//       document.getElementById("priority_id").value = "";
//       document.getElementById("category_id").value = "";
//       document.getElementById("reminder_id").value = "";
//       document.getElementById("status_id").value = "";

//       alert("Data berhasil ditambah");
//     },
//     error: function (xhr, status, error) {
//       console.log(error);
//     },
//   });
// }

$("#submit-button").click(function (e) {
  e.preventDefault();

  var form = $("#add_task_form_container");

  // Mengumpulkan data formulir menggunakan serialize()
  var formData = form.serialize();

  // Menambahkan data "act" secara manual ke dalam data formulir
  formData += "&act=add";

  $.ajax({
    type: "POST",
    url: "sv_task.php",
    data: formData,
    success: function () {
      alert("Data Berhasil");

      get_data();
      completed_data();
      saveScore();
      saveXP();

      // Mengatur ulang form
      $("#add_task_form_container")[0].reset();
    },
  });
});

// function editTask(task_id) {
//   $.ajax({
//     url: "sv_task.php",
//     method: "POST",
//     data: "edit",
//     success: function (result) {
//       var data = result.split("|");

//       document.getElementById("id").value = data[1];
//       document.getElementById("task_name").value = data[2];
//       document.getElementById("task_date").value = data[3];
//       document.getElementById("task_desc").value = data[4];
//       document.getElementById("priority_id").value = data[5];
//       document.getElementById("user_id").value = data[6];
//       document.getElementById("category_id").value = data[7];
//       document.getElementById("reminder_id").value = data[8];
//       document.getElementById("status_id").value = data[9];
//     },
//     error: function (xhr, status, error) {
//       console.log(error);
//     },
//   });
// }

$(document).ready(function () {
  get_data();
  completed_data();
  saveScore();
  saveXP();
});

// Memunculkan modal add task
const addButton = document.getElementById("add_task_button");
const addTaskForm = document.getElementById("add_task_form_container");
const TaskFormButton = document.getElementById("submit-button");

addButton.addEventListener("click", function () {
  addTaskForm.style.display = "block";
  addTaskForm.style.visibility = "visible";
  addTaskForm.style.opacity = "1";

  get_data();
});

TaskFormButton.addEventListener("click", function () {
  addTaskForm.style.display = "none";
  addTaskForm.style.visibility = "hidden";
  addTaskForm.style.opacity = "0";

  editTaskForm.style.display = "none";
  editTaskForm.style.visibility = "hidden";
  editTaskForm.style.opacity = "0";
});
