<?php

$lessonId = $_POST['lesson_id'];

$url = "../../pages/lessons/$lessonId.html";
$file = file_get_contents($url);
echo $file;
