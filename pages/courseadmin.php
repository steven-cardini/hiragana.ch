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

<h1>Course Administration</h1>
<h2><?php echo $course->getName('en'); ?></h2>

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
                <td>'.$lesson->getName('en').'</td>
                <td>'.$lesson->getName('de').'</td>
                <td>'.$lesson->getPoints().'</td>
                <td>'.$lesson->timestampAdded().'</td>
                <td><form method="post" action="'.ROOT_DIR.'lessonadmin"><input type="hidden" name="lesson_id" value="'.$lesson->getId().'" /><input type="hidden" name="lesson_nr" value="'.$lesson->getLessonNr().'" /><input type="submit" value="Edit" /></form></td>
              </tr>';
      } ?>
    </tbody>
  </table>
