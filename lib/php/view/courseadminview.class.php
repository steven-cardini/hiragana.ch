<?php
class CourseAdminView extends View {

  public function render() {
    echo '<table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name EN</th>
            <th>Name DE</th>
            <th>&nbsp;</th>
          </tr>
        </thead>
        <tbody>';
          foreach (Course::getMultipleCourses(50,0) as $course) {
            echo '<tr>
                    <td>'.$course->getId().'</td>
                    <td>'.$course->getName('en').'</td>
                    <td>'.$course->getName('de').'</td>
                    <td><a class="btn btn-default" href="'.ROOT_DIR.'admin/modifycourse/'.$course->getId().'">Edit</a></td>
                  </tr>';
          }
        echo '</tbody>
      </table>';
  }

}
