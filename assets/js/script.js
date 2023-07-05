function check_task(task_id)
{
  // var checkbox = document.getElementById('done');
  // if (checkbox.checked = true)
  // {
  //   taskSubtitle = document.querySelector(".task_subtitle");
  //   taskSubtitle.classList.toggle("done");
  // }

  $.ajax({
    url: 'sv_task.php',
    method: 'POST',
    data: {
      id: task_id,
      act: 'set_done'
    },
    success: function( result ) {
      get_data();
    }
  });
}

function get_data()
{
  $.ajax({
    url: 'sv_task.php',
    method: 'POST',
    data: {
      act: 'loading'
    },
    success: function( result ) {
      $("#active_tasks").html( result );
    }
  });
}


$
