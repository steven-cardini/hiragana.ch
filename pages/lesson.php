<?php
  if (!isset($_GET['id']) || empty($_GET['id'])) {
    die ("Please first select a lesson!");
  }
  $lessonId = htmlspecialchars($_GET['id']);
  $lessonId = DB::escapeString($lessonId);
  $lesson = Lesson::getLesson($lessonId);
  $course = Course::getCourseById($lesson->getCourseId());

  if (!isset($lesson)) {
    die ("This lesson was not found!");
  }

  $courseId = $lesson->getCourseId();
  $filePath = PAGE_DIR."lessons/$courseId-$lessonId.html";

  $exerciseComponent = '<div class="well ui">
    <form action="'.ROOT_DIR.'exercises/'.$lessonId.'" method="post">
      <button type="submit" class="btn btn-default btn-block">Start exercises</button>
    </form>
  </div>';

  // display content
  echo '<ol class="breadcrumb">
                <li><a href="'.ROOT_DIR.'courseoverview">Course Overview</a></li>
                <li><a href="'.ROOT_DIR.'course/'.$course->getId().'">'.$course->getName('en').'</a></li>
                <li class="active">'.$lesson->getName('en').'</li>
              </ol>';
  echo $exerciseComponent;
  echo '<h1>'.$lesson->getName('en').'</h1>';
  if (file_exists($filePath) && filesize($filePath) > 1) {
    echo '<h2>Tutorial</h2>';
    echo file_get_contents($filePath);
    echo $exerciseComponent;
  }
