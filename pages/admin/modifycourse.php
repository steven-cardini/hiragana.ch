<?php
include CONTROL_DIR.'requireadminrights.routine.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
  die ("Please first select a course!");
}

$courseId = htmlspecialchars($_GET['id']);
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
        <th colspan="2">Edit</th>
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
                <td><a class="btn btn-default" href="'.ROOT_DIR.'admin/modifylessontutorial/'.$lesson->getId().'">Tutorial</a></td>
                <td><a class="btn btn-default" href="'.ROOT_DIR.'admin/modifylessonexercises/'.$lesson->getId().'">Exercises</a></td>
              </tr>';
      } ?>
    </tbody>
  </table>
