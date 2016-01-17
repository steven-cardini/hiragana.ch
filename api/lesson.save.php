<?php
require_once('config.php');
//TODO: secure access to this resource
//include AUTH_DIR.'requireadminrights.routine.php';

$courseId = htmlspecialchars($_POST['course_id']);
$lessonId = htmlspecialchars($_POST['lesson_id']);
$content = $_POST['content'];

$file = PAGE_DIR."lessons/$courseId-$lessonId.html";
file_put_contents($file, $content);
