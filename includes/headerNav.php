<?php
/*
// Header Navigation
// Location: 'includes/headerNav.php'
// Function: To show general links for website and account information
*/
?>
<div id="header">
	<ul class="simpleNav left">
		<li><a href="/">Home</a></li>
		<li><a href="https://mail.google.com/mail/?shva=1" target"_blank">Gmail</a></li>
	</ul>
	<ul>
		<li><a href="/">$User</a></li>
		<li><a href="/">Profile</a></li>
		<li><a href="/">Settings</a></li>
		<li><a href="/">Sign Out</a></li>
	</ul>
	<?php
	$people = $buzz->getPeople('114519877662741226877', null);
	
	function displayUser() {
		echo $person['data']['profileUrl'];
	}
	
	echo $person['data']['profileUrl'];
	?>
</div>