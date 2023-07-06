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
      saveScore();
      saveXP();
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
      saveScore();
      saveXP();
    }
  });
}

function delete_task(task_id) {
  $.ajax({
    url: 'sv_task.php',
    method: 'POST',
    data: {
      id: task_id,
      act: 'deleteTask'
    },
    success: function( result ) {
      get_data();
      completed_data();
      saveScore();
      saveXP();
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

function saveScore() {
  $.ajax({
    url: 'sv_score.php',
    method: 'POST',
    data: {
      act: 'saveScore',
    },
    success: function(result) {
      $("#pet_score").html(result);
    }
  });
}

function saveXP(){
  $.ajax({
    url: 'sv_score.php',
    method: 'POST',
    data:{
      act: 'saveXP',
    },
    success: function(result) {
      $("#pet_xp").html(result);
    }
  })
}