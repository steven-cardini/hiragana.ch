<?php
class ExerciseView extends View {

  private $course;
  private $lesson;
  private $question;

  public function __construct ($lesson, $course) {
    parent::__construct();
    $this->lesson = $lesson;
    $this->course = $course;
    $this->question = "<>"; // dummy
  }

  protected function getContent () {
    $content = '<ol class="breadcrumb">
                  <li><a href="'.ROOT_DIR.'courseoverview">Course Overview</a></li>
                  <li><a href="'.ROOT_DIR.'course/'.$this->course->getId().'">'.$this->course->getName('en').'</a></li>
                  <li><a href="'.ROOT_DIR.'lesson/'.$this->lesson->getId().'">'.$this->lesson->getName('en').'</a></li>
                  <li class="active">Exercises</li>
                </ol>';

    $content .= '<h1>'.$this->lesson->getName('en').': Exercises</h1>
    <p>
      &nbsp;
    </p>
    <form method="post" class="form-horizontal"><input type="hidden" name="action" value="evaluate" />
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-3 control-label">'.$this->question.'</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="answer" placeholder="Your answer">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" class="btn btn-default">Submit</button>
        </div>
      </div>
    </form>';

    return $content;
  }

  public function setQuestion ($question) {
    $this->question = $question;
  }

}
