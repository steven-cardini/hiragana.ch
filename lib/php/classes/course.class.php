<?php
 class Course {

   private $id;
   private $nameEN;
   private $nameDE;

   // private constructor - obejcts can be exclusively retrieved via static methods below
   private function __construct ($id, $nameEN, $nameDE) {
     if (!isset($this->id))
        $this->id = $id;

     if (!isset($this->nameEN))
        $this->nameEN = $nameEN;

     if (!isset($this->nameDE))
        $this->nameDE = $nameDE;
   }

   public function getId () {
     return $this->id;
   }

   public function getNameEN () {
     return $this->nameEN;
   }

   public function getNameDE () {
     return $this->nameDE;
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

 }
