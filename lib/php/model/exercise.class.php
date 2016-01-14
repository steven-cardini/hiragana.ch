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

  public static function getRandomExercise ($lessonId) {
    $sql = "SELECT exercise_id as id, question, answer_en as answerEN, answer_de AS answerDE FROM exercise WHERE lesson_id = $lessonId ORDER BY RAND() LIMIT 1";
    $res = DB::doQuery($sql);

    if ($res==null || $res->num_rows == 0) {
      return null;
    }

    return $res->fetch_object(get_class());
  }

  public static function getNotAnsweredExercise ($email, $lessonId) {
    $sql = "SELECT exercise.exercise_id as id, question, answer_en as answerEN, answer_de AS answerDE
            FROM exercise LEFT JOIN user_exercise ON exercise.exercise_id = user_exercise.exercise_id
            WHERE email = '$email' AND lesson_id = $lessonId AND correct = 0
            OR t_answered IS NULL AND lesson_id = $lessonId
            ORDER BY RAND()
            LIMIT 1";
    $res = DB::doQuery($sql);

    if ($res==null || $res->num_rows == 0) {
      return null;
    }

    return $res->fetch_object(get_class());
  }

  public static function addCorrectAnswer ($email, $exerciseId) {
    $sql = "INSERT INTO user_exercise (email, exercise_id, correct)
            VALUES ('$email', $exerciseId, 1)";
    $res = DB::doQuery($sql);

    if (!isset($res) || $res==null) {
      return false;
    }

    return true;
  }

  public static function getPercentageCorrect ($email, $lessonId) {
    $totalNr = 0;
    $sql = "SELECT count(exercise_id) as amount FROM exercise
            WHERE lesson_id = $lessonId";
    $res = DB::doQuery($sql);
    $res = $res->fetch_assoc();
    $totalNr = $res['amount']>0 ? $res['amount'] : 1;

    $correctNr = 0;
    $sql = "SELECT count(user_exercise.exercise_id) as amount
            FROM user_exercise LEFT JOIN exercise ON user_exercise.exercise_id = exercise.exercise_id
            WHERE email = '$email' AND lesson_id = $lessonId AND correct = 1";
    $res = DB::doQuery($sql);

    if ($res!=null) {
      $res = $res->fetch_assoc();
      $correctNr = $res['amount'];
    }

    return ($correctNr / $totalNr)*100;
  }

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

  public static function createExercise ($lessonId, $question, $answerEN, $answerDE) {
    $sql = sprintf("INSERT INTO exercise (lesson_id, question, answer_en, answer_de)
                    VALUES ('%d', '%s', '%s', '%s')",
                    $lessonId, $question, $answerEN, $answerDE);
    $res = DB::doQuery($sql);
    if (!isset($res) || $res==null) {
      return false;
    }
    return true;
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
