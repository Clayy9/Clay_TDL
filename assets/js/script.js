function check_task()
{
  var checkbox = document.getElementById('done');
  if (checkbox.checked = true)
  {
    taskSubtitle = document.querySelector(".task_subtitle");
    taskSubtitle.classList.toggle("done");
  }

  }

