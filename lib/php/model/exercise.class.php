<?php
 class Exercise {

  private $id;
  private $question;
  private $answerEN;
  private $answerDE;

  // private constructor - obejcts can be exclusively retrieved via static methods below
  private function __construct () {
  }

  public function getId() {
    return $this->id;
  }

  public function getQuestion() {
    return $this->question;
  }

  public function getAnswer($lang) {
    switch ($lang) {
      case 'de':
        return $this->answerDE;
      default:
        return $this->answerEN;
    }
  }


  // static methods

  public static function getMultipleExercises ($lessonId, $amount, $offset) {
    $sql = "SELECT exercise_id as id, question, answer_en as answerEN, answer_de AS answerDE FROM exercise WHERE lesson_id = $lessonId LIMIT $amount OFFSET $offset";
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

  public static function update ($id, $question, $answerEN, $answerDE) {
    $sql = "UPDATE exercise SET question='".$question."', answer_en='".$answerEN."', answer_de='".$answerDE."' WHERE exercise_id=$id";
    $res = DB::doQuery($sql);

    if (!isset($res) || $res==null) {
      return false;
    }

    return true;
  }

}
