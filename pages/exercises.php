<?php

  require AUTH_DIR.'requirelogin.routine.php';
  FrontController::display(new ExerciseController());
