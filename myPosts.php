<?php require_once ('includes/buzzObject.php'); ?>
<?php require_once ('includes/header.php'); ?>
<body>
	<div id="container">
		<?php require_once ('includes/headerNav.php'); ?>
		<div id="inside-container">
		
			<div id="main-content">
				<?php include ('includes/createPost.php'); ?>

				<?php
				// Include the utility function to display a buzz post- This is only intended to be a demo and a developer should create the UI that works for their app
require_once 'includes/displayBuzzPost.php';

// Get the self stream (the activities from yourself) for @me, which means 'the authenticated user', using $buzz->listActivities()
$activities = $buzz->listActivities('@self', '@me', 50, 50, null, 50);
//echo "<pre>".print_r($activities, true)."</pre>";

foreach ($activities['items'] as $buzzPost) {
  displayBuzzPost($buzzPost);
}
?>

				
				<div id="load-more"><a href="/">Load More</a></div>
			</div>
			<?php include ('includes/sidebar.php'); ?>
		</div>
		<?php include ('includes/footer.php'); ?>
	</div>

</body>
</html>