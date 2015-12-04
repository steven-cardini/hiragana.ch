<?php
require AUTH_DIR.'requireadminrights.routine.php';

$frontController = new FrontController(new CourseAdminController());
?>

<h1>Course Overview</h1>
<?php
$frontController->display();
