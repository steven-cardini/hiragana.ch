<?php
require AUTH_DIR.'requireadminrights.routine.php';

$users = User::getMultipleUsers(50,0);
?>

<h1><?php echo I18n::t('admin.useroverview.title') ?></h1>

<table class="table table-hover">
    <thead>
      <tr>
        <th>Nickname</th>
        <th><?php echo I18n::t('text.email') ?></th>
        <th><?php echo I18n::t('admin.useroverview.admin'); ?></th>
        <th><?php echo I18n::t('register.title'); ?></th>
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
