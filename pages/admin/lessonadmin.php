<?php
include AUTH_DIR.'requireadminrights.routine.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
  die ("Please first select a course!");
}

$courseId = htmlspecialchars($_GET['id']);
$courseId = DB::escapeString($courseId);

$course = Course::getCourseById($courseId);
$lessons = Lesson::getMultipleLessons($courseId,50,0);
?>

<h1>Course Administration</h1>

<?php
FrontController::display(new LessonAdminController());
