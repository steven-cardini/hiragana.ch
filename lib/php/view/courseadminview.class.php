<?php
class CourseAdminView extends View {

  protected function getContent() {
    $content = '<ol class="breadcrumb">
                  <li class="active">'.I18n::t('courseoverview.title').'</li>
                </ol>';
    $content .= '<table class="table table-hover">
        <thead>
          <tr>
            <th>Name EN</th>
            <th>Name DE</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>';
    foreach ((array) Course::getMultipleCourses(50,0) as $course) {
      $content .= '<tr>
              <td>'.$course->getName('en').'</td>
              <td>'.$course->getName('de').'</td>
              <td><a class="btn btn-default" href="'.ROOT_DIR.'admin/lessonadmin/'.$course->getId().'">'.I18n::t('admin.courseadmin.lessons').'</a></td>
              <td><form method="post">
                <input type="hidden" name="action" value="deleteCourse" />
                <input type="hidden" name="courseId" value="'.$course->getId().'" />
                <input type="submit" class="btn btn-default" value="'.I18n::t('button.delete').'" />
              </form></td>
            </tr>';
    }
    $content .= '</tbody>
    </table>';
    return $content;
  }

  public function addAddButton() {
    $this->addContentAfter('<form method="post">
      <input type="hidden" name="action" value="addCourse" />
      <input type="submit" class="btn btn-default" value="'.I18n::t('admin.courseadmin.newcourse').'" />
    </form>');
  }

  public function addNewCourseInput() {
    $this->addContentAfter('<form method="post">
      <input type="hidden" name="action" value="saveNewCourse" />
      <table class="table">
        <tr>
          <td>'.I18n::t('text.new').'</td>
          <td><input type="text" name="nameEN" placeholder="Name EN" /></td>
          <td><input type="text" name="nameDE" placeholder="Name DE" /></td>
          <td><input type="submit" class="btn btn-default" value="'.I18n::t('button.save').'" /></td>
        </tr>
      </table>
    </form>');
  }

  public function addDeleteConfirmation() {
    $this->addContentBefore('<form method="post">
      <a class="btn btn-default" href="'.ROOT_DIR.'admin/courseadmin">Cancel</a>
      <input type="hidden" name="action" value="deleteCourse" />
      <input type="hidden" name="confirmed" value="true" />
      <input type="hidden" name="courseId" value="'.$_POST['courseId'].'" />
      <input type="submit" class="btn btn-danger" value="Delete" />
    </form>');
  }

}
