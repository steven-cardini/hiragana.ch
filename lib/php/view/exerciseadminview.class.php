<?php
class ExerciseAdminView extends View {

  private $lesson;
  private $course;

  public function __construct ($lesson, $course) {
    parent::__construct();
    $this->lesson = $lesson;
    $this->course = $course;
  }

  protected function getContent () {
    $content = '<ol class="breadcrumb">
                  <li><a href="'.ROOT_DIR.'admin/courseadmin">'.I18n::t('courseoverview.title').'</a></li>
                  <li><a href="'.ROOT_DIR.'admin/lessonadmin/'.$this->course->getId().'">'.$this->course->getName(I18n::getLang()).'</a></li>
                  <li class="active">'.$this->lesson->getName(I18n::getLang()).'</li>
                </ol>';

    $content .= '<form method="post"><input type="hidden" name="action" value="saveExercises" />
    <table id="exercise-admin-table" class="table table-hover">
    <thead>
    <tr>
    <th>'.I18n::t('admin.exerciseadmin.question').'</th>
    <th>'.I18n::t('admin.exerciseadmin.answer').' (EN)</th>
    <th>'.I18n::t('admin.exerciseadmin.answer').' (DE)</th>
    <th>&nbsp;</th>
    </tr>
    </thead>
    <tbody>';

    foreach ((array) Exercise::getMultipleExercises($this->lesson->getId(), 50, 0) as $exercise) {
      $content .= '<tr><input type="hidden" name="exercise_id[]" value="'.$exercise->getId().'" />
      <td><input type="text" name="question[]" value="'.$exercise->getQuestion().'" /></td>
      <td><input type="text" name="answer_en[]" value="'.$exercise->getAnswer('en').'" /></td>
      <td><input type="text" name="answer_de[]" value="'.$exercise->getAnswer('de').'" /></td>
      </tr>';
    }

    $content .= '</tbody>
    </table>
    <table width="100%">
    <tr><td width="50%" align="left"><button id="exercise-add-btn" class="btn btn-default" type="button">'.I18n::t('button.add').'</button></td>
    <td width="50%" align="right"><input type="submit" class="btn btn-default" value="'.I18n::t('button.save').'" /></td></tr>
    </table>
    </form>';

    return $content;
  }

}
