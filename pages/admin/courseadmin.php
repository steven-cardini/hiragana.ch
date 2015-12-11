<?php
require AUTH_DIR.'requireadminrights.routine.php';

FrontController::display(new CourseAdminController());
