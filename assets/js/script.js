// Filter
// Filter Modal Reveal
const filterButton = document.getElementById("filter_task_button");
const filterContainer = document.getElementById("filter_container");
const filterSubmitButton = document.getElementById("submit-button-filter");

filterButton.addEventListener("click", function () {
  filterContainer.style.display = "block";
  filterContainer.style.visibility = "visible";
  filterContainer.style.opacity = "1";
});

// Filter Modal Unreveal
const filterButtonBack = document.getElementById("back_to_home_filter_button");

filterButtonBack.addEventListener("click", function () {
  filterContainer.style.display = "none";
  filterContainer.style.visibility = "hidden";
  filterContainer.style.opacity = "0";
  get_data();
});

// Modal Data
function filterTask() {
  var form = $("#filter_form_container"); // Definisikan variabel form
  // Mengumpulkan data formulir menggunakan serialize()
  var formFilter = form.serialize();

  // Menambahkan data "act" secara manual ke dalam data formulir
  formFilter += "&act=filter";
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: formFilter,
    success: function (result) {
      $("#active_tasks").html(result);

      filterContainer.style.display = "none";
      filterContainer.style.visibility = "hidden";
      filterContainer.style.opacity = "0";
    },
  });
}

// Profile Image
function previewFile(event) {
  var preview = document.getElementById("previewImage");
  var file = event.target.files[0];
  var reader = new FileReader();

  reader.onloadend = function () {
    preview.src = reader.result;
  };

  if (file) {
    reader.readAsDataURL(file);
  } else {
    preview.src = "";
  }
}

// Edit Profil
$("#submit-button-profile").click(function (e) {
  e.preventDefault();

  var formProfile = $("#form_profile_edit");

  // Mengumpulkan data formulir menggunakan serialize()
  var formData = formProfile.serialize();

  // Menambahkan data "act" secara manual ke dalam data formulir
  formData += "&act=editProfile";

  $.ajax({
    url: "sv_profile.php",
    method: "POST",
    data: formData,
    success: function () {
      alert("Data Berhasil");
    },
  });
});

// Task

// Memunculkan modal add task
const addButton = document.getElementById("add_task_button");
const editButton = document.getElementById("edit_task_button");
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
});

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
      loadingPET();
      addXP(task_id);
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
      loadingPET();
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
      loadingPET();
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

// Add Task Baru
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
      loadingPET();

      // Mengatur ulang form
      $("#add_task_form_container")[0].reset();
    },
  });
});

// Edit Task
function editTask(task_id) {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: { id: task_id, act: "edit" },

    success: function (result) {
      var data = result.split("|");

      var id = $("#id").val(data[1]);
      $("#title_task").html("Edit Task");
      $("#task_name").val(data[2]);
      $("#task_desc").val(data[3]);
      $("#category_id").val(data[4]);
      $("#priority_id").val(data[5]);
      $("#task_date").val(data[6]);
      $("#task_time").val(data[7]);
      $("#status_id").val(data[8]);

      // Tambahkan kode untuk menampilkan modal
      var addTaskForm = document.getElementById("add_task_form_container");
      addTaskForm.style.display = "block";
      addTaskForm.style.visibility = "visible";
      addTaskForm.style.opacity = "1";

      // Mengikat ulang event handler untuk tombol submit
      $("#submit-button").unbind("click");
      $("#submit-button").on("click", function () {
        update_task(task_id);
      });
    },
  });
}

function update_task(task_id) {
  var id = $("#id").val();
  var task_name = $("#task_name").val();
  var task_desc = $("#task_desc").val();
  var category_id = $("#category_id").val();
  var priority_id = $("#priority_id").val();
  var task_date = $("#task_date").val();
  var task_time = $("#task_time").val();
  var status_id = $("#status_id").val();
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      id: task_id,
      task_name: task_name,
      task_desc: task_desc,
      category_id: category_id,
      priority_id: priority_id,
      task_date: task_date,
      task_time: task_time,
      status_id: status_id,
      act: "update",
    },
    success: function (result) {
      get_data();
    },
  });
}

// XP and PET

function addXP(task_id) {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      act: "addXP",
      task_id: task_id,
    },
    success: function (result) {
      $("#pet_xp").html(result);
    },
  });
}

function loadingPET() {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      act: "loadingPET",
    },
    success: function (result) {
      $("#container_pet").html(result);
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

// Date and Time Checker
function checkDateTime() {
  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: {
      act: "checkDateTime",
    },
    success: function (result) {
      $("#reminder").html(result);
    },
  });
}

//Reload page setiap 1 menit
setInterval(refreshPage, 60000);

function refreshPage() {
  location.reload(); // Memuat ulang halaman

  // Mengecek tanggal dan waktu realtime
  checkDateTime();
}

$(document).ready(function () {
  get_data();
  completed_data();
  loadingPET();
});
