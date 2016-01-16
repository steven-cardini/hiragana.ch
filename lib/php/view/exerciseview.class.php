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
                  <li><a href="'.ROOT_DIR.'courseoverview">'.I18n::t('courseoverview.title').'</a></li>
                  <li><a href="'.ROOT_DIR.'course/'.$this->course->getId().'">'.$this->course->getName(I18n::getLang()).'</a></li>
                  <li><a href="'.ROOT_DIR.'lesson/'.$this->lesson->getId().'">'.$this->lesson->getName(I18n::getLang()).'</a></li>
                  <li class="active">'.I18n::t('exercises.title').'</li>
                </ol>';

    $content .= '<h1>'.$this->lesson->getName(I18n::getLang()).': '.I18n::t('exercises.title').'</h1>
    <p>
      &nbsp;
    </p>
    <form method="post" class="form-horizontal"><input type="hidden" name="action" value="evaluate" />
      <div class="form-group">
        <label for="inputPassword3" class="col-sm-3 control-label">'.$this->question.'</label>
        <div class="col-sm-9">
          <input type="text" class="form-control" name="answer" placeholder="'.I18n::t('exercise.youranswer').'">
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button type="submit" class="btn btn-default">'.I18n::t('button.submit').'</button>
        </div>
      </div>
    </form>';

    return $content;
  }

  public function setQuestion ($question) {
    $this->question = $question;
  }

}
