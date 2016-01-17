<h1><?php echo I18n::t('courseoverview.title'); ?></h1>

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
