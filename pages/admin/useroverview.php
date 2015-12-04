<?php
require AUTH_DIR.'requireadminrights.routine.php';

$users = User::getMultipleUsers(50,0);
?>

<h1>User Administration</h1>

<table class="table table-hover">
    <thead>
      <tr>
        <th>Nickname</th>
        <th>E-mail</th>
        <th>Admin Rights</th>
        <th>Timestamp registered</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($users as $user) {
        echo '<tr>
                <td>'.$user->getNickname().'</td>
                <td>'.$user->getEmail().'</td>
                <td>'.$user->isAdmin().'</td>
                <td>'.$user->timestampRegistered().'</td>
              </tr>';
      } ?>
    </tbody>
  </table>
