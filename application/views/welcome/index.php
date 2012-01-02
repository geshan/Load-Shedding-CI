
<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<p>The page you are looking at is being generated dynamically by CodeIgniter.</p>

		<p>If you would like to edit this page you'll find it located at:</p>
		<code>application/views/welcome_message.php</code>

		<p>The corresponding controller for this page is found at:</p>
		<code>application/controllers/welcome.php</code>

		<p>If you are exploring CodeIgniter for the very first time, you should start by reading the <a href="user_guide/">User Guide</a>.</p>
		
		<?php
$dateTime = new DateTime("now", new DateTimeZone('Europe/Warsaw'));
echo $dateTime->format("Y-m-d H:i:s");

$dateTimeZone = new DateTimeZone('Asia/Kathmandu');
$dateTime->setTimezone($dateTimeZone);

echo '<br/><br/>'. $dateTime->format("Y-m-d H:i:s");

?>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>