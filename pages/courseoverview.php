<h1><?php echo I18n::t('courseoverview.title'); ?></h1>

<?php
  if (!Auth::isLoggedIn()) {
    echo '<div class="alert alert-danger" role="alert">'.I18n::t('courseoverview.err.nologin').'</div>';
  }
 ?>

<p>
  <?php echo I18n::t('courseoverview.text'); ?>
</p>

<?php
  $courses = Course::getMultipleCourses(20,0);

  foreach ($courses as $course) {
    echo '<a href="'.ROOT_DIR.'course/'.$course->getId().'">
            <div class="jumbotron course">
              '.$course->getName(I18n::getLang()).'
            </div>
          </a>';
  }
