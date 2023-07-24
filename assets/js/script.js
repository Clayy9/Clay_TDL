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
      alert("Data berhasil ditambah!");

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

      var reminderDetail = JSON.parse(data[9]);

      // Kosongkan dulu default dari reminder wrapper
      $("#inputForm_reminder_wrapper").empty();

      // Memproses data dari reminderDetail dan melakukan append pada div
      reminderDetail.forEach(function (reminder) {
        $("#inputForm_reminder_wrapper").append(
          '<div class="inputForm reminder">' +
          '<input class="textField reminder" type="number" name="reminder_number[]" value="' + reminder.reminder_number + '" placeholder="Type number" />' +
          '<div class="customSelect reminder">' +
          '<select name="reminder_type[]">' +
          '<option value="minutes"' + (reminder.reminder_type === 'minutes' ? ' selected' : '') + '>Minute(s)</option>' +
          '<option value="hours"' + (reminder.reminder_type === 'hours' ? ' selected' : '') + '>Hour(s)</option>' +
          '<option value="days"' + (reminder.reminder_type === 'days' ? ' selected' : '') + '>Day(s)</option>' +
          '</select>' +
          '<span class="arrow"></span>' +
          '</div>' +
          '<a id="delete_reminder"><i class="fas fa-trash" style="color: #ffffff;"></i></a>' +
          '</div>'
        );
      });

      // Initialize select2 untuk elemen select collaborator
      $("#collaborator").select2();

      var collaborators = JSON.parse(data[10]);

      // Kosongkan dulu collaborator wrapper
      $("#collaborator").empty();

      // Memproses data dari collaborators dan melakukan append pada div
      collaborators.forEach(function (collaborator) {
        $("#collaborator").append('<option value="' + collaborator.user_id + '" selected>' + collaborator.collaborator_username + '</option>');
      });


      // Tampilkan semua collaborator di database
      var allCollaborators = JSON.parse(data[11]);

      // Memproses data dari all collaborators dan melakukan append pada div
      allCollaborators.forEach(function (allCollaborator) {
        $("#collaborator").append('<option value="' + allCollaborator.user_id + '">' + allCollaborator.collaborator_username + '</option>');
      });

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

      //  foreach $reminders, panggil ulang yang append
      // foreach $collaborator 
    },
  });
}

function update_task(task_id) {

  var form = $("#add_task_form_container");

  // Mengumpulkan data formulir menggunakan serialize()
  var formData = form.serialize();

  // Menambahkan data "act" secara manual ke dalam data formulir
  formData += "&act=update";

  $.ajax({
    url: "sv_task.php",
    method: "POST",
    data: formData,
    success: function (result) {
      alert("Data berhasil diedit!");

      get_data();
      completed_data();
      loadingPET();

      // Mengatur ulang form
      $("#add_task_form_container")[0].reset();
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
// setInterval(refreshPage, 60000);

function refreshPage() {
  location.reload(); // Memuat ulang halaman

  // Mengecek tanggal dan waktu realtime
  checkDateTime();
}

$(document).ready(function () {
  get_data();
  completed_data();
  loadingPET();

  // Select2
  $('.js-example-basic-multiple').select2();

  // Reminder Multiply Input
  var max_fields = 5; // Maksimal Input
  var x = 1; // Input bawaan

  $("#add_reminder").click(function (e) {
    e.preventDefault();

    if (x < max_fields) {
      x++;

      $("#inputForm_reminder_wrapper").append(
        '<div class="inputForm reminder">' +
        '<input class="textField reminder" type="number" name="reminder_number[]" placeholder="Type number" />' +
        '<div class="customSelect reminder">' +
        '<select name="reminder_type[]">' +
        '<option value="minutes" default selected="selected">Minute(s)</option>' +
        '<option value="hours">Hour(s)</option>' +
        '<option value="days">Day(s)</option>' +
        '</select>' +
        '<span class="arrow"></span>' +
        '</div>' +
        '<a id="delete_reminder"><i class="fas fa-trash" style="color: #ffffff;"></i></a>' +
        '</div>'
      );
    }
  });

  // Delete Reminder
  $("#inputForm_reminder_wrapper").on("click", "#delete_reminder", function (e) {
    e.preventDefault();
    $(this).parent('div').remove();
    x--;
  });
});

