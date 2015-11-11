<?php
include CONTROL_DIR.'requireadminrights.routine.php';

$courses = Course::getMultipleCourses(50,0);
?>

<h1>Course Administration</h1>

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
                <td>'.$course->getNameEN().'</td>
                <td>'.$course->getNameDE().'</td>
                <td><form method="post" action="'.ROOT_DIR.'lessonadmin"><input type="hidden" name="course_id" value="'.$course->getId().'" /><input type="submit" value="Edit" /></form></td>
              </tr>';
      } ?>
    </tbody>
  </table>
