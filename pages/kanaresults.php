<table class="table">
  <thead>
    <tr>
      <th>Symbol</th>
      <th>Score</th>
      <th>Percentage</th>
    </tr>
  </thead>

  <tbody>
<?php

$statistics = array();
  foreach ($statistics as $key => $row) {
    if ($row['amountPrompted']<=0) {
      continue;
    }
    $percentage = round ($row['amountCorrect'] / $row['amountPrompted'] * 100, 2);
    if ($percentage>=80) { // set the color for the progress bars
      $progressBarClass = 'progress-bar-success';
    } elseif ($percentage<50) {
      $progressBarClass = 'progress-bar-danger';
    } else {
      $progressBarClass = 'progress-bar-warning';
    }


?>
      <tr>
        <td><span class="h3"><?php echo $row['character']; ?></span> (<?php echo $key; ?>)</td>
        <td><?php echo $row['amountCorrect'].' / '.$row['amountPrompted']; ?></td>
        <td><div class="progress-bar <?php echo $progressBarClass; ?>" role="progressbar" aria-valuenow="<?php echo $percentage; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $percentage; ?>%;"><?php echo $percentage; ?>%</div></td>
      </tr>
  <?php
} // end foreach
   ?>
    </tbody>
 </table>

 <form method="post" action="">
   <input type="submit" class="btn btn-info" name="back" value="Back">
 </form>
