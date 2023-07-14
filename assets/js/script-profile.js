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

// Profile Image
function previewFile(event) {
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
    url:"sv_profile.php",
    method:"POST",
    data: formData,
    success: function () {
      alert("Data Berhasil");
    },
  });
});

// Memilih PET
function selectedPet(id){
  $("#pet_id").val(id);
  //css untuk menandai pet yang sedang dipilih

  // $.ajax({
  //   url:"sv_profile.php",
  //   method:"POST",
  //   data: {
  //     id: id,
  //     act: "selectPet"
  //   },
  //   success: function (){
  //      alert("Anda Berhasil Mengubah Pet");
  //   }
  // })
}
