<?php
 class Lesson {

   private $id;
   private $courseId;
   private $lessonNr;
   private $nameEN;
   private $nameDE;
   private $points;
   private $added;

   // private constructor - obejcts can be exclusively retrieved via static methods below
   private function __construct () {
   }

   public function getId () {
     return $this->id;
   }

   public function getCourseId () {
     return $this->courseId;
   }

   public function getLessonNr () {
     return $this->lessonNr;
   }

   public function getName ($lang) {
     switch($lang) {
       case 'de':
         return $this->nameDE;
       default:
         return $this->nameEN;
     }
   }

   public function getPoints () {
     return $this->points;
   }

   public function timestampAdded () {
     return $this->added;
   }


   // static methods

   public static function getLesson ($lessonId) {
     $sql = "SELECT lesson_id as id, course_id as courseId, lesson_nr as lessonNr, name_en as nameEN, name_de AS nameDE, points, t_added AS added FROM lesson WHERE lesson_id = $lessonId";
     $res = DB::doQuery($sql);

     if ($res==null || $res->num_rows == 0) {
       return null;
     }

     return $res->fetch_object(get_class());
   }

   public static function getMultipleLessons ($courseId, $amount, $offset) {
     $sql = "SELECT lesson_id as id, course_id as courseId, lesson_nr as lessonNr, name_en as nameEN, name_de AS nameDE, points, t_added AS added FROM lesson WHERE course_id = $courseId LIMIT $amount OFFSET $offset";
     $res = DB::doQuery($sql);

       if ($res==null || $res->num_rows == 0) {
         return null;
     }

     $list=array();
     while ($obj = $res->fetch_object(get_class())) {
       $list[] = $obj;
     }

     return $list;
   }

   public static function createLesson ($courseId, $nameEN, $nameDE, $points) {
     $newLessonNr = self::getNewLessonNr($courseId);
     $sql = sprintf("INSERT INTO lesson (course_id, lesson_nr, name_en, name_de, points)
                     VALUES ('%d', '%d', '%s', '%s', '%d')",
                     $courseId, $newLessonNr, $nameEN, $nameDE, $points);
     $res = DB::doQuery($sql);
     if (!isset($res) || $res==null) {
       return false;
     }
     return true;
   }

   public static function getNewLessonNr ($courseId) {
     $sql = "SELECT MAX(lesson_nr) FROM lesson WHERE course_id = '$courseId'";
     $res = DB::doQuery($sql);
     if (!isset($res) || $res==null) {
       return 1;
     }
     $row = mysqli_fetch_row($res);
     return $row[0] + 1;
   }

   public static function getNewestLesson ($courseId) {
     $sql = "SELECT lesson_id as id, course_id as courseId, lesson_nr as lessonNr, name_en as nameEN, name_de AS nameDE, points, t_added AS added FROM lesson
              WHERE course_id = $courseId
              ORDER BY t_added DESC
              LIMIT 1 OFFSET 0";
     $res = DB::doQuery($sql);

     if ($res==null || $res->num_rows == 0) {
       return null;
     }

     $list=array();
     while ($obj = $res->fetch_object(get_class())) {
       $list[] = $obj;
     }

     return $list[0];
   }

   public static function deleteLesson ($id) {
     $sql = sprintf("DELETE FROM lesson
                      WHERE lesson_id = '%d'",
                      $id);
     $res = DB::doQuery($sql);
     if (!isset($res) || $res==null) {
       return false;
     }

     return true;
   }

 }
