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
<h1><?php echo $course->getName('en'); ?></h1>

<p>
  Below, all lessons of the course are listed. Please select one to get started!
</p>

<?php
  $lessons = Lesson::getMultipleLessons($courseId,20,0);

  foreach ($lessons as $lesson) {
    echo '<a href="'.ROOT_DIR.'lesson/'.$lesson->getId().'">
            <div class="jumbotron course">
              '.$lesson->getLessonNr().') '.$lesson->getName('en').'
            </div>
          </a>';
  }
