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
      <button type="submit" class="btn btn-default btn-block">'.I18n::t('lesson.startexercises').'</button>
    </form>
  </div>';

  // display content
  echo '<ol class="breadcrumb">
                <li><a href="'.ROOT_DIR.'courseoverview">'.I18n::t('courseoverview.title').'</a></li>
                <li><a href="'.ROOT_DIR.'course/'.$course->getId().'">'.$course->getName(I18n::getLang()).'</a></li>
                <li class="active">'.$lesson->getName(I18n::getLang()).'</li>
              </ol>';
  echo $exerciseComponent;
  echo '<h1>'.$lesson->getName(I18n::getLang()).'</h1>';
  if (file_exists($filePath) && filesize($filePath) > 1) {
    echo '<h2>Tutorial</h2>';
    echo file_get_contents($filePath);
    echo $exerciseComponent;
  }
