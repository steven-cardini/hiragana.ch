<?php
class TutorialAdminView extends View {

  private $lesson;
  private $course;

  public function __construct ($lesson, $course) {
    parent::__construct();
    $this->lesson = $lesson;
    $this->course = $course;
  }

  protected function getContent () {
    $content = '<ol class="breadcrumb">
                  <li><a href="'.ROOT_DIR.'admin/courseadmin">Course Administration</a></li>
                  <li><a href="'.ROOT_DIR.'admin/lessonadmin/'.$this->course->getId().'">'.$this->course->getName('en').'</a></li>
                  <li class="active">Tutorial</li>
                </ol>';

    $content .= '<script>
                  var courseId = '.json_encode($this->course->getId()).';
                  var lessonId = '.json_encode($this->lesson->getId()).';
                </script>
                <div id="lesson-tutorial-feedback" class="alert" role="alert">&nbsp;</div>
                <form>
                  <textarea name="editor1" id="editor1" rows="10" cols="80">
                    Content is loading, please wait..
                  </textarea>
                </form>
                <br />
                <p align="right">
                  <button id="lesson-tutorial-save" class="btn btn-default">Save</button>
                </p>';

      return $content;
  }

/*
  public function addDeleteConfirmation() {
    $this->addContentBefore('<form method="post">
      <a class="btn btn-default" href="'.ROOT_DIR.'admin/courseadmin">Cancel</a>
      <input type="hidden" name="action" value="deleteLesson" />
      <input type="hidden" name="confirmed" value="true" />
      <input type="hidden" name="lessonId" value="'.$_POST['lessonId'].'" />
      <input type="submit" class="btn btn-danger" value="Delete" />
    </form>');
  } */

}
