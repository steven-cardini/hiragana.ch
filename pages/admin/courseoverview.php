<?php
require AUTH_DIR.'requireadminrights.routine.php';

?>

<h1>Course Overview</h1>

<?php
FrontController::display(new CourseAdminController());
