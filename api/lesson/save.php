<?php

require_once('../../lib/php/classes/filefunctions.class.php');

$lessonId = $_POST['lesson_id'];
$content = $_POST['content'];

$file = "../../pages/lessons/$lessonId.html";
file_put_contents($file, $content);

FileFunctions::log("i was called.. lesson_id=$lessonId - content=$content");
