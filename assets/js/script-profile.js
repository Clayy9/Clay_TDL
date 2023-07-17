$("#profile_img").change(function (event) {
  var preview = document.getElementById('previewImage');
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
});


// Loading Profile
function loadingProfile(){
  $.ajax({
    url:"sv_profile.php",
    method:"POST",
    data: {
      act:"loadingProfile",
    }, success: function (result){
            $("#profile").html(result);
    },
  });
}

// Edit Profil
$("#submit-button-profile").click(function (e) {
  e.preventDefault();

var formProfile = document.getElementById("form_profile_edit");
var formData = new FormData(formProfile);

  // Ambil value dari password
  var oldPassword = $("#password").val();

  // Enkripsi password lama dengan MD5
  var oldPasswordMD5 = md5(oldPassword);

  // Tetapkan nilai yang dienkripsi ke input fields
  $("#password").val(oldPasswordMD5);

  // Mengumpulkan data formulir menggunakan serialize()
  var formData = new FormData(formProfile);

  // Mengembalikan nilai asli dari password input fields
  $("#password").val(oldPassword);

  // Menambahkan data "act" secara manual ke dalam data formulir
  formData.append("act", "editProfile");

  $.ajax({
    url: "sv_profile.php",
    method: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (result) {
      var data = result.split("|");

      var actionType = data[1];
      alert(data[2]);

      if (actionType == "updateProfilePassword") {
        window.location.href = "logout.php";
      } else if (actionType == "wrongPassword") {
        $("#password").val("");
        $("#new_password").val("");
      }
    },
  });
});



// Memilih PET
function selectedPet(id) {
  $("#pet_id").val(id);
  $(".edit_profile_pet_card").removeClass("selected");
  $("#pet_card_" + id).addClass("selected");
}


