<?php
class LessonAdminView extends View {

  private $course;

  public function __construct ($course) {
    parent::__construct();
    $this->course = $course;
  }

  protected function getContent () {
    $content = '<ol class="breadcrumb">
                  <li><a href="'.ROOT_DIR.'admin/courseadmin">'.I18n::t('courseoverview.title').'</a></li>
                  <li class="active">'.$this->course->getName(I18n::getLang()).'</li>
                </ol>';
    $content .= '<table class="table table-hover">
        <thead>
          <tr>
            <th>'.I18n::t('admin.lessonadmin.lessonnr').'</th>
            <th>Name EN</th>
            <th>Name DE</th>
            <th>'.I18n::t('admin.lessonadmin.points').'</th>
            <th>'.I18n::t('admin.lessonadmin.added').'</th>
            <th colspan="2">'.I18n::t('text.edit').'</th>
          </tr>
        </thead>
        <tbody>';
          foreach ((array) Lesson::getMultipleLessons($this->course->getId(),50,0) as $lesson) {
            $content .= '<tr>
                    <td>'.$lesson->getLessonNr().'</td>
                    <td>'.$lesson->getName('en').'</td>
                    <td>'.$lesson->getName('de').'</td>
                    <td>'.$lesson->getPoints().'</td>
                    <td>'.$lesson->timestampAdded().'</td>
                    <td><a class="btn btn-default btn-sm" href="'.ROOT_DIR.'admin/tutorialadmin/'.$lesson->getId().'">Tutorial</a></td>
                    <td><a class="btn btn-default btn-sm" href="'.ROOT_DIR.'admin/exerciseadmin/'.$lesson->getId().'">'.I18n::t('exercises.title').'</a></td>
                    <td><form method="post">
                      <input type="hidden" name="action" value="deleteLesson" />
                      <input type="hidden" name="lessonId" value="'.$lesson->getId().'" />
                      <input type="submit" class="btn btn-default btn-sm" value="'.I18n::t('button.delete').'" />
                    </form></td>
                  </tr>';
          }
      $content .= '</tbody>
      </table>';
      return $content;
  }

  public function addAddButton() {
    $this->addContentAfter('<form method="post">
      <input type="hidden" name="action" value="addLesson" />
      <input type="submit" class="btn btn-default" value="'.I18n::t('admin.lessonadmin.newlesson').'" />
    </form>');
  }

  public function addNewLessonInput() {
    $newLessonNr = Lesson::getNewLessonNr($this->course->getId());
    $this->addContentAfter('<form method="post">
      <input type="hidden" name="action" value="saveNewLesson" />
      <table class="table">
        <tr>
          <td>'.$newLessonNr.'</td>
          <td><input type="text" name="nameEN" placeholder="Name EN" /></td>
          <td><input type="text" name="nameDE" placeholder="Name DE" /></td>
          <td><input type="text" name="points" placeholder="'.I18n::t('admin.lessonadmin.points').'" /></td>
          <td><input type="submit" class="btn btn-default" value="'.I18n::t('button.save').'" /></td>
        </tr>
      </table>
    </form>');
  }

  public function addDeleteConfirmation() {
    $this->addContentBefore('<form method="post">
      <a class="btn btn-default" href="'.ROOT_DIR.'admin/courseadmin">'.I18n::t('button.cancel').'</a>
      <input type="hidden" name="action" value="deleteLesson" />
      <input type="hidden" name="confirmed" value="true" />
      <input type="hidden" name="lessonId" value="'.$_POST['lessonId'].'" />
      <input type="submit" class="btn btn-danger" value="'.I18n::t('button.delete').'" />
    </form>');
  }

}
