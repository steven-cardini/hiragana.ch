<?php
class LessonAdminView extends View {

  private $course;

  public function __construct ($course) {
    parent::__construct();
    $this->course = $course;
  }

  protected function getContent () {
    $content = '<ol class="breadcrumb">
                  <li><a href="'.ROOT_DIR.'admin/courseadmin">Course Administration</a></li>
                  <li class="active">'.$this->course->getName('en').'</li>
                </ol>';
    $content .= '<table class="table table-hover">
        <thead>
          <tr>
            <th>Lesson Nr</th>
            <th>Name EN</th>
            <th>Name DE</th>
            <th>Points</th>
            <th>Timestamp added</th>
            <th colspan="2">Edit</th>
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
                    <td><a class="btn btn-default btn-sm" href="'.ROOT_DIR.'admin/exerciseadmin/'.$lesson->getId().'">Exercises</a></td>
                    <td><form method="post">
                      <input type="hidden" name="action" value="deleteLesson" />
                      <input type="hidden" name="lessonId" value="'.$lesson->getId().'" />
                      <input type="submit" class="btn btn-default btn-sm" value="Delete" />
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
      <input type="submit" class="btn btn-default" value="Add Lesson" />
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
          <td><input type="text" name="points" placeholder="Points" /></td>
          <td><input type="submit" class="btn btn-default" value="Save" /></td>
        </tr>
      </table>
    </form>');
  }

  public function addDeleteConfirmation() {
    $this->addContentBefore('<form method="post">
      <a class="btn btn-default" href="'.ROOT_DIR.'admin/courseadmin">Cancel</a>
      <input type="hidden" name="action" value="deleteLesson" />
      <input type="hidden" name="confirmed" value="true" />
      <input type="hidden" name="lessonId" value="'.$_POST['lessonId'].'" />
      <input type="submit" class="btn btn-danger" value="Delete" />
    </form>');
  }

}
