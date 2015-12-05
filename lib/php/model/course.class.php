<?php
 class Course {

   private $id;
   private $nameEN;
   private $nameDE;

   // private constructor - obejcts can be exclusively retrieved via static methods below
   private function __construct () {
   }

   public function getId () {
     return $this->id;
   }

   public function getName ($lang) {
     switch ($lang) {
       case 'de':
         return $this->nameDE;
       default:
         return $this->nameEN;
     }
   }

   // static methods

   public static function getCourseById ($id) {
     $sql = "SELECT course_id as id, name_en as nameEN, name_de AS nameDE FROM course WHERE course_id = '$id'";
     $res = DB::doQuery($sql);

     if ($res==null || $res->num_rows == 0) {
       return null;
     }

     return $res->fetch_object(get_class(), array(0, 'name_en', 'name_de'));
   }

   public static function getMultipleCourses ($amount, $offset) {
     $sql = "SELECT course_id as id, name_en as nameEN, name_de AS nameDE FROM course LIMIT $amount OFFSET $offset";
     $res = DB::doQuery($sql);

     if ($res==null || $res->num_rows == 0) {
       return null;
     }

     $list=array();
     while ($obj = $res->fetch_object(get_class(),array(0, 'name_en', 'name_de'))) {
       $list[] = $obj;
     }

     return $list;
   }

   public static function createCourse ($nameEN, $nameDE) {
     $sql = sprintf("INSERT INTO course (name_en, name_de)
                     VALUES ('%s', '%s')",
                     $nameEN, $nameDE);
     $res = DB::doQuery($sql);
     if (!isset($res) || $res==null) {
       return false;
     }

     return true;
   }

   public static function deleteCourse ($id) {
     $sql = sprintf("DELETE FROM course
                      WHERE course_id = '%d'",
                      $id);
     $res = DB::doQuery($sql);
     if (!isset($res) || $res==null) {
       return false;
     }

     return true;
   }

 }
