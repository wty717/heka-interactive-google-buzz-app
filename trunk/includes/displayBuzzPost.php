<?php

function displayBuzzPost($post)
{
	// Get the Current Date in a human readable format
	$current_date = date("Y") . "-" . date("m") . "-" . date("d");
	
	// Get the Post ID from the $post after the 25 character
	$postID = substr($post['id'],25);

	// Get the link that will be used for the tile of the article
	// This will link back to the static URL for the post on profiles.google.com/me
	$titleLink = isset($post['links']['alternate'][0]['href']) ? $post['links']['alternate'][0]['href'] : '#';
	
	// Set Content to be empty before receiving content, to ensure that it starts with clean slate before each new post
	$content = '';
	
	if (isset($post['object']))
	{
		switch ($post['object']['type'])
		{
			case 'note':
				$content = $post['object']['content'];
				break;
			case 'activity':
				$content = "<p>".$post['annotation'] . "</p><br>" .
					   "Reshared post by <a href=\"{$post['object']['actor']['name']}\" target=\"_blank\">{$post['object']['actor']['name']}</a>:<br>" .
					   "<div style=\"margin-left:12px; margin-top:12px\">{$post['object']['content']}</div>";
				break;
			default:
				// at the moment buzz only produces note objects, so anything else is unsupported
				$content = "<span class=\"error\">Unsupported activity object type: '{$post['object']['type']}'</span><br>";
				echo "<pre>" . print_r($post, true) . "</pre>";
				break;
		}
	}
	else
	{
		echo "[displayBuzzPost] object not set!<br>";
		// this happens on posts with a visibility set, currently private posts are not accessable through the REST API
	}

	// Set the Photo, article and video content to be blank, to start from a clean slate
	$photoContent = $articleContent = $videoContent = '';
	if (isset($post['object']['attachments']))
	{
		foreach ($post['object']['attachments'] as $attachment)
		{
			switch ($attachment['type'])
			{
				case 'article':
					$aTitle = isset($attachment['title']) ? $attachment['title'] : null;
					$aContent = isset($attachment['content']) ? $attachment['content'] : null;
					$aLink = isset($attachment['links']['alternate'][0]['href']) ? $attachment['links']['alternate'][0]['href'] : null;
					$articleContent .= "<br /><p><img src=\"http://lh4.ggpht.com/_kb6yL2ND7Fw/TURzCYUyAMI/AAAAAAAATBo/87zum3hgUuY/s800/None.jpg\" width=\"23\" height=\"20\" /> <a target=\"_blank\" class=\"articleLink\" href=\"$aLink\">$aTitle</a> $aContent<p>";
					break;
				case 'photo':
					$url = isset($attachment['links']['preview'][0]['href']) ? $attachment['links']['preview'][0]['href'] : null;
					$enclosure = isset($attachment['links']['enclosure'][0]['href']) ? $attachment['links']['enclosure'][0]['href'] : null;
					$onClick = $enclosure ? " onClick=\"window.location='$enclosure'\"" : '';
					//FIXME need to add proper click cursor here!
					/* $photoContent .= "<div $onClick class=\"photo\"> <img src=\"". htmlentities($url) . "\" /></div>"; */
					$photoContent .= "<div class=\"photo\"><a id=\"inline\" href=\"#photos\"><img src=\"". htmlentities($url) . "\" /></a></div>";
					break;
				case 'photo-album':
					if (isset($attachment['links']['alternate'][0]['href']))
					{
						$articleContent .= "<br><br><a target=\"_blank\" href=\"{$attachment['links']['alternate'][0]['href']}\">{$attachment['title']}</a><br>";
					}
					if (isset($attachment['content']))
					{
						$articleContent .= $attachment['content'] . "<br>";
					}
					break;
				case 'video':
				
					// Gets the flash video URL from the attachment link
					$flashUrl = isset($attachment['links']['alternate'][0]['href']) ? str_replace('&autoplay=1', '', $attachment['links']['alternate'][0]['href']) : null;
					
					// Sets up the default video include
					$videoContent .= "
						<object width=\"425\" height=\"344\">
							<param name=\"movie\" value=\"$flashUrl\"></param>
							<param name=\"allowFullScreen\" value=\"true\"></param>
							<param name=\"allowscriptaccess\" value=\"always\"></param>
							<embed src=\"$flashUrl\" type=\"application/x-shockwave-flash\" allowscriptaccess=\"always\" allowfullscreen=\"true\" width=\"425\" height=\"344\"></embed>
						</object>\n";
					break;
				default:
					
					// Displays unsupported attachment type
					$content = "<span class=\"error\">Unsupported attachment type:</span><pre>\n".print_r($attachment, true)."</pre>";
			}
		}
	}
  
	echo "<div class=\"post\" id=\""; 
	
	// Displays the post id
	echo $postID;
	
    echo "\">";
	
	// Creates post header
	echo "
	<div class=\"post-header\">
		<div class=\"header-angle\"></div>
		<div class=\"author-name\">
			<a target=\"_blank\" href=\"{$post['actor']['profileUrl']}\">{$post['actor']['name']}</a>
		</div>";
	
		// Displays the date/time that the post was created or last updated
		echo "
		<div class=\"author-date\"> - 
			<a href=\"" . ($post['links']['alternate']['0']['href']) . "\" target=\"_blank\">";
				$post_date = date('Y-m-d', strtotime($post['published']));
			
				if ($post_date == $current_date)
				{
					echo (date('g:ia', strtotime($post['published'])));
				}
				else
				{
					echo (date('M d', strtotime($post['published'])));
				}	
				echo "
			</a>
		</div>";
	
	// Displays options drop down menu
		echo "
		<div class=\"more\">Options
			<ul class=\"options\">
				<li><a href=\"/\">Reply to Author</a></li>
				<li><a href=\"/\">Translate</a></li>
				<li><a href=\"/\">Add to lists</a></li>
				<li><a href=\"/\">Email</a></li>
				<li><a href=\"/\">Share with Twitter</a></li>
				<li><a href=\"/\">Share with Facebook</a></li>
				<li><a href=\"/\">Stop Following $Author</a></li>
				<li class=\"minimize-post\">Minimize Post</li>
				<li><a href=\"\" target=\"\" title=\"\" alt=\"\">Delete Post</a></li>
			</ul>
		</div>";
		
		// Displays what source the post came from ie. Google Reader, Buzz, Twitter etc.
		echo "<div class=\"app-name\">{$post['source']['title']}</div>";
	
	// closing tag for the Post Header 
	echo"</div>";
		
	// Start of the Post's Post
	// This displays the body of the post
	echo "<div class=\"post-post\">";
	
		echo"
		<div class=\"post-body\">
			<div class=\"post-info\">
				<div class=\"author-thumbnail profile-btn\">
					<a target=\"_blank\" href=\" {$post['actor']['profileUrl']} \">";
					if ($post['actor']['thumbnailUrl'] == "")
					{
						echo "<img src=\"http://www.gstatic.com/s2/profiles/images/googleyeyes96.png\" width=\"60\" height=\"60\" />";
					}
					else
					{
						echo "<img src=\"" . $post['actor']['thumbnailUrl'] . "\" width=\"60\" height=\"60\"  />";
					}
	echo "
					</a>
			</div>
			<div class=\"profile\" id=\"" . $postID . "-profile\">
				<div class=\"profile-close\">X</div>
				<ul>
					<li>User Name 1</li>
					<li>User Name 1</li>
					<li>User Name 2</li>
					<li>User Name 3</li>
					<li>User Name 4</li>
					<li>User Name 5</li>
					<li>User Name 6</li>
					<li>User Name 7</li>
				</ul>
			</div>";
		
		echo"
				<ul>
					<li>";
			if 	($post['visibility']['entries']['0']['title'] == "Public")
				echo "Public";
			else
				echo "Private";
			echo		"</li><li class=\"comment-btn\">";
					
					// Show the number of Comments
					$commentNum = count($post['object']['comments']);
					
					if ($commentNum == 0)
						echo "";
					elseif ($commentNum == 1)
						echo "(" . $commentNum . ") Comment";
					elseif ($commentNum >= 2)
						echo "(" . $commentNum . ") Comments";
					
					echo"
					</li>
					<li class=\"reshare-btn\">";
					
					// Show the number of Reshares
					$reshareNum = count($post['object']['actor']['name']);
					
					if ($reshareNum == 0)
						echo "";
					elseif ($reshareNum == 1)
						echo "(" . $reshareNum . ") Reshare";
					elseif ($reshareNum >= 2)
						echo "(" . $reshareNum . ") Reshares";	
					
					
					echo "</li>";
					echo "<li class=\"likes-btn\"  id=\"" . $postID . "-likes\">";
					
					
					// Show the number of Likes
					$likeNum = count($post['object']['liked']);
					
					if ($likeNum == 0)
						echo "";
					elseif ($likeNum == 1)
						echo "(". $likeNum . ") Like";
					elseif ($likeNum >= 2)
						echo "(" . $likeNum . ") Likes";
					
					echo "<div class=\"likes\">;
						<ul>";
					
						foreach ($post['object']['liked'] as $person) {
							$implode[] = "<li><a href=\"{$person['profileUrl']}\" target=\"_blank\">{$person['displayName']}</a></li>";
						} 
						echo "</ul></div></div>";
		echo"			</li>
				</ul>
				";
		
		echo"
				<div class=\"reshare\" id=\"" . $postID . "-reshare\">
					<div class=\"close\">X</div>
					<ul>
						<li>User Name 1</li>
						<li>User Name 2</li>
						<li>User Name 3</li>
						<li>User Name 4</li>
						<li>User Name 5</li>
						<li>User Name 6</li>
						<li>User Name 7</li>
					</ul>
				</div>";
					

				
			
  			echo "<div class=\"post-content\">
  				$content
  				$articleContent";

	if (! empty($photoContent)) {
		echo "<div id=\"photos\" class=\"photos\">$photoContent</div>";
	}
	if (! empty($videoContent)) {
		echo "<div class=\"photos\" style=\"height:340px; clear:both\">$videoContent</div>";
	}
	echo "
		</div>
		</div>
		<div class=\"post-footer\">	
		</div>
	";
	if (isset($post['object']['liked']) && count($post['object']['liked']))
	{
		$implode = array();
		foreach ($post['object']['liked'] as $person)
		{
			$implode[] = "<a href=\"{$person['profileUrl']}\" target=\"_blank\">{$person['displayName']}</a>";
		}
    echo "<div class=\"likes\" id=\"" . $postID . "-likes\">" . count($implode) . " people liked this: " . implode(', ', $implode) . "</div>";
	}
  
	// START THE COMMENT CONTAINER
	echo "<br clear=\"both\" />";
	
	// Create the comment header
	echo "<div id=\"" . $postID . "comment\"";
	
	echo " class=\"comment-content\">";

	
	if (isset($post['object']['comments']) && count($post['object']['comments']))
	{
		foreach ($post['object']['comments'] as $comment)
		{
			//FIXME add $comment->person->thumbnailUrl
			echo "
			<div class=\"comment\">
				<div class=\"comment-photo\">
					<a target=\"_blank\" href=\"{$comment['actor']['profileUrl']}\">";
					/* echo $formatted_date; */
			
					if ($post['actor']['thumbnailUrl'] == "")
					{
						echo "<img src=\"http://www.gstatic.com/s2/profiles/images/googleyeyes96.png\" width=\"30\" height=\"30\" />";
					}	
					else
					{					
						echo "<img src=\"" . $comment['actor']['thumbnailUrl'] . "\" width=\"30\" height=\"30\"  />";
					}
					echo "</a>
				</div>
				<div class=\"comment-copy\">
					<div class=\"comment-header\">
						<a target=\"_blank\" href=\"{$comment['actor']['profileUrl']}\">{$comment['actor']['name']}</a>
						<span class=\"comment-date\">";
							$formatted_date = date('Y-m-d', strtotime($comment['published']));
							if ($formatted_date == $current_date)
							{
								echo (date('g:ia', strtotime($comment['published'])));
							}
							else
							{
								echo (date('M d', strtotime($comment['published'])));
							}
						echo "</span>
					</div>
					{$comment['content']}<span class=\"comment-reply\"> - <a href=\"\" target=\"\" title=\"\" alt=\"\">Reply</a></span>
					</div>
				</div>";
		}
	}
  
	// CLOSE COMMENT CONTAINER
	echo "</div>";
	
	
	// COMMENT FOOTER
	echo "
		<div class=\"comment-footer\" id=\"" . $postID . "-comment-footer\">
			<span class=\"comment-collapase\"></span>
			<ul>
				<li class=\"create-comment-btn\">Comment</li>
				<li><a href=\"/\">Like</a></li>
				<li><a href=\"/\">Reshare</a></li>
			</ul>
		</div>";
		
	
	// CLOSE POST
	echo "
	    </div>";
		include ('includes/createComment.php');
    	echo "</div>\n";
}
?>