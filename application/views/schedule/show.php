<div id="wrapper">
  <div id="title"><h2 class="page-title-h1">Load Shedding Kathmandu Nepal - Schedule of 20-Dec-2011</h2></div>
  <table id="ls_table" class="ls-tbl">
    <tr>
      <td>Group/Day</td>
      
      <?php foreach ($days as $day): ?>
            <td class="td-today-<?php $dark = ($day == $nepal_day) ? '1' : '0'; print $dark;?>"><?php print $day?></td>
      <?php endforeach;?>
    </tr>
    <tr class="light-<?php $flag = ($statuses[1]) ? '1' : '0'; print $flag;?>">
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
    <tr class="light-<?php $flag = ($statuses[$loopcount]) ? '1' : '0'; print $flag;?>">
    	<td>Group - <?php print $loopcount?></td>
    	<?php foreach ($days as $day): ?>
            <td class="-light"><?php print $group[$day]?></td>
      <?php endforeach;?>
    </tr>
    <?php
    $loopcount++;
    endforeach; ?>
  </table>
  <div id="legand">
  Legand
  	<ul>
  		<li> <span class="no-light">Red</span> : Currently there is no light in that group</li>
  		<li> <span class="yes-light">Blue</span> : Currently there is light in that group</li>
  		<li> <span class="td-today-1">Grey</span> : Today
  	</ul>
  </div>
</div>