<div id="create-post">
	<div id="post-entry-info">
		<img class="post-thumbnail" src="http://lh3.ggpht.com/_kb6yL2ND7Fw/TSqTof3DooI/AAAAAAAASdI/QDakvJIKS6A/s800/artists-are-sensitive-1.jpg" width="60" height="60" alt="" title="" />
		<div id="public-option">Public</div>
		<ul id="public">
			<li>Public on the web</li>
			<li>Private</li>
		</ul>
	</div>
	<div id="post-entry">
<?php
	
	//$buzz = createBuzz();
	
	// Set the default value for a new post to be False
	//$newPost = false;
	//if (isset($_POST['buzzPostContent']))
	//{
	//	$object = new buzzObject($_POST['buzzPostContent']);
	//	$post = buzzPost::createPost($object);
	//	$newPost = $buzz->createPost($post);
	//}
	
	// My oAuth Key
	$oAuthKey = 'buzz.hekainteractive.com';
	
	// My API key
	$apiKey = 'AIzaSyBl28hAJjlt9CU10uSnPaKEGBAbx_PmO18';
	
	// Get the users id
	//** Find out how to get the users ID
	// Until I can figure out how to get the logged in users ID, I will use the default @me
	//userId = userId;
	$userId = '@me';
	
	// Send the POST request to this address
	$postAddr = 'https://www.googleapis.com/buzz/v1/activities/' . $userId . '/@self?' . $apiKey . '&alt=json';

	// Default new post form
	echo "<div id=\"buzzStream\">
			<div class=\"buzzPost\">
				<form action=\"" . $postAddr . "\" method=\"post\">
					<b>Enter post text:</b><br>
					<textarea name=\"buzzPostContent\" class=\"ui-corner-all\"></textarea><br>
					<input type=\"submit\" value=\"Create post\">
				</form>
			</div>";
			
		// If the user creates a new post, let them know that the new post has been created
		//if ($newPost)
		//{
		//	echo "<br><span style=\"margin-left:12px; font-weight:bold\">New post has been created:</span><br/>";
		//	displayBuzzPost($buzz, $newPost);
		//}
	echo "</div>\n";
?>
		<div id="attach">Attach: <a href="/">Link</a> <a href="/">Photo</a></div>
	</div>
</div>
<?php
 /* // the post to create
    $post = array(
        'data' => array(
            'object' => array('type' => 'note',
                'content' => '$_POST("buzzPostContent")')));

// create an activity
    $activity = $buzz->insertActivities('@self', $post); */
?>