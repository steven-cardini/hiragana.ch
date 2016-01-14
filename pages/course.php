<?php require AUTH_DIR.'requirelogin.routine.php'; ?>

<?php
  if (!isset($_GET['id']) || empty($_GET['id'])) {
    die ("Please first select a course!");
  }
  $courseId = htmlspecialchars($_GET['id']);
  $courseId = DB::escapeString($courseId);
  $course = Course::getCourseById($courseId);

  if (!isset($course)) {
    die ("This course was not found!");
  }

 ?>
 <ol class="breadcrumb">
   <li><a href="<?php echo ROOT_DIR; ?>courseoverview">Course Overview</a></li>
   <li class="active"><?php echo $course->getName('en'); ?></li>
</ol>

<h1><?php echo $course->getName('en'); ?></h1>

<p>
  Below, all lessons of the course are listed. Please select one to get started!
</p>

<?php
  $lessons = Lesson::getMultipleLessons($courseId,20,0);

  foreach ($lessons as $lesson) {
    $percentage = Exercise::getPercentageCorrect($_SESSION['user']->getEmail(), $lesson->getId());
    $width = $percentage > 3 ? $percentage : 3;
    echo '<a href="'.ROOT_DIR.'lesson/'.$lesson->getId().'">
            <div class="jumbotron course">
              '.$lesson->getLessonNr().') '.$lesson->getName('en').'
              <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="'.$percentage.'" aria-valuemin="0" aria-valuemax="100" style="width: '.$width.'%;">
                  '.$percentage.'%
                </div>
              </div>
            </div>
          </a>';
  }
