<h1>Courses</h1>

<p>
  Below, all available courses are listed. Please select one to get started!
</p>

<?php
  $courses = Course::getMultipleCourses(20,0);

  foreach ($courses as $course) {
    echo '<a href="'.ROOT_DIR.'lessons/'.$course->getId().'">
            <div class="jumbotron course">
              '.$course->getName('en').'
            </div>
          </a>';
  }
