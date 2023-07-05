function check_task(task_id)
{
  $.ajax({
    url: 'sv_task.php',
    method: 'POST',
    data: {
      id: task_id,
      act: 'set_done'
    },
    success: function( result ) {
      get_data();
      completed_data();
    }
  });
}

function uncheck_task(task_id)
{
  $.ajax({
    url: 'sv_task.php',
    method: 'POST',
    data: {
      id: task_id,
      act: 'uncheck'
    },
    success: function( result ) {
      get_data();
      completed_data();
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

function completed_data()
{
  $.ajax({
    url: 'sv_task.php',
    method: 'POST',
    data: {
      act: 'completed'
    },
    success: function( result ) {
      $("#completed_tasks").html( result );
    }
  });
}
