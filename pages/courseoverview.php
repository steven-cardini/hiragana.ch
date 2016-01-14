<h1>Courses</h1>

<?php
  if (!Auth::isLoggedIn()) {
    echo '<div class="alert alert-danger" role="alert">Please sign in to view the courses!</div>';
  }
 ?>

<p>
  Below, all available courses are listed. Please select one to get started!
</p>

<?php
  $courses = Course::getMultipleCourses(20,0);

  foreach ($courses as $course) {
    echo '<a href="'.ROOT_DIR.'course/'.$course->getId().'">
            <div class="jumbotron course">
              '.$course->getName('en').'
            </div>
          </a>';
  }
