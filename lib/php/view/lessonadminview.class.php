<?php
class LessonAdminView extends View {

  private $course;

  public function __construct ($course) {
    parent::__construct();
    $this->course = $course;
  }

  protected function getContent () {
    $content = '<h2>'.$this->course->getName('en').'</h2>
    <table class="table table-hover">
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
          foreach (Lesson::getMultipleLessons($this->course->getId(),50,0) as $lesson) {
            $content .= '<tr>
                    <td>'.$lesson->getLessonNr().'</td>
                    <td>'.$lesson->getName('en').'</td>
                    <td>'.$lesson->getName('de').'</td>
                    <td>'.$lesson->getPoints().'</td>
                    <td>'.$lesson->timestampAdded().'</td>
                    <td><a class="btn btn-default" href="'.ROOT_DIR.'admin/modifylessontutorial/'.$lesson->getId().'">Tutorial</a></td>
                    <td><a class="btn btn-default" href="'.ROOT_DIR.'admin/modifylessonexercises/'.$lesson->getId().'">Exercises</a></td>
                  </tr>';
          }
      $content .= '</tbody>
      </table>';
      return $content;
  }

}
