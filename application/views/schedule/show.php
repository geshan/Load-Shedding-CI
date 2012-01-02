<table id="ls_table" class="ls-tbl">
  <tr>
    <td>Group/Day</td>
    
    <?php foreach ($days as $day): ?>
          <td><?php print $day?></td>
    <?php endforeach;?>
  </tr>
  <tr>
  	<td>Group - 1</td>
  	<?php foreach ($days as $day): ?>
          <td class="-light"><?php print $group1[$day]?></td>
    <?php endforeach;?>
  </tr>
  <?php //print_r($group2to7);
    $loopcount = 2;
  ?>
  <?php foreach ($group2to7 as $group) : ?>
  <?php //print_r($group);
    //exit();
  ?>
  <tr>
  	<td>Group - <?php print $loopcount?></td>
  	<?php foreach ($days as $day): ?>
          <td class="-light"><?php print $group[$day]?></td>
    <?php endforeach;?>
  </tr>
  <?php
  $loopcount++;
  endforeach; ?>
</table>