<?php
include AUTH_DIR.'requireadminrights.routine.php';

$courses = Course::getMultipleCourses(50,0);
?>

<h1>Course Overview</h1>

<table class="table table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name EN</th>
        <th>Name DE</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($courses as $course) {
        echo '<tr>
                <td>'.$course->getId().'</td>
                <td>'.$course->getName('en').'</td>
                <td>'.$course->getName('de').'</td>
                <td><a class="btn btn-default" href="'.ROOT_DIR.'admin/modifycourse/'.$course->getId().'">Edit</a></td>
              </tr>';
      } ?>
    </tbody>
  </table>
