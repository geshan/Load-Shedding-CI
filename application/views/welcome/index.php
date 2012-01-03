
<div id="container">
	<h1>Welcome to Web Services!</h1>

	<div id="body">
		<p>It now has Load Sheddding Kathmandu live info.</p>

		<?php
		/*
$dateTime = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
echo $dateTime->format("Y-m-d H:i:s");

$dateTimeZone = new DateTimeZone('Asia/Kathmandu');
$dateTime->setTimezone($dateTimeZone);

echo '<br/><br/>'. $dateTime->format("Y-m-d H:i:s");
*/
?>
	<div class="menu-wrap">
		<div class="menu-header">Menu</div>
			<div class="menuitem"><?php print anchor('schedule/show', 'Live Load shedding Schedule', 'title="Live Load shedding Scheculde"');?></div>
			<?php 
			  for($i=1; $i<=7; $i++):
			?>
			  <div class="menuitem"><?php print anchor('schedule/check/'.$i, 'Current Status for Group - '.$i, 'title="Current status of group - "'.$i);?></div>
			<?php endfor;?>
			<div class="menu-header">XML Output - For Web API ???</div>
			<?php 
			  for($i=1; $i<=7; $i++):
			?>
			  <div class="menuitem"><?php print anchor('schedule/check_current/'.$i, 'Current Status for Group - '.$i, 'title="Current status of group - "'.$i);?></div>
			<?php endfor;?>
			<div class="menu-header">Group 1 - All 7 Days - Current Time</div>
			<?php 
			  $days= array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');
			  foreach($days as $day):
			?>
			  <div class="menuitem"><?php print anchor('schedule/check/1/'.$day, 'Status for Group 1 on - '.$day, 'title="Current status of group 1 on - "'.$day);?></div>
			<?php endforeach;?>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>