<?php
include CONTROL_DIR.'requireadminrights.routine.php';

if (!isset($_POST['course_id']) || empty($_POST['course_id'])) {
  die ("Please first select a course!");
}

$courseId = htmlspecialchars($_POST['course_id']);
$courseId = DB::escapeString($courseId);

$course = Course::getCourseById($courseId);
$lessons = Lesson::getMultipleLessons($courseId,50,0);
?>

<h1>Lesson Administration</h1>
<h2>Course: <?php echo $course->getNameEN(); ?></h2>

<table class="table table-hover">
    <thead>
      <tr>
        <th>Lesson Nr</th>
        <th>Name EN</th>
        <th>Name DE</th>
        <th>Points</th>
        <th>Timestamp added</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($lessons as $lesson) {
        echo '<tr>
                <td>'.$lesson->getLessonNr().'</td>
                <td>'.$lesson->getNameEN().'</td>
                <td>'.$lesson->getNameDE().'</td>
                <td>'.$lesson->getPoints().'</td>
                <td>'.$lesson->timestampAdded().'</td>
                <td><form method="post" action=""><input type="hidden" name="course_id" value="'.$lesson->getCourseId().'" /><input type="hidden" name="lesson_nr" value="'.$lesson->getLessonNr().'" /><input type="submit" value="Edit" /></form></td>
              </tr>';
      } ?>
    </tbody>
  </table>
