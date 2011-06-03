<?php
/*
// Create a Single comment
// Google Buzz API Page: http://code.google.com/apis/buzz/v1/using_rest.html#create-comment
// Location: 'includes/createComment.php'
*/
?>
<?php 
/* Create a empty comment box */
/* To Do: Add in an incremental value for each comment */
echo "<div class=\"create-comment\">"; 
echo "<form class=\"comment-form\" method=\"post\">
			   <textarea class=\"postComment\" name=\"buzzPostComment\" col=\"80\"></textarea>
			   <input class=\"comment-submit\" type=\"submit\" value=\"Comment\">
			   <input class=\"comment-cancel\" type=\"button\" value=\"Cancel\">
	   </form>";
echo "</div>";

/* Create a reshare comment box 
echo "<div id=\"comment" . commentID() . "\">"; 
echo "<form method=\"post\">
			   <b>Enter comment text:</b><br>
			   <textarea name=\"buzzPostComment\" col=\"80\"></textarea><br>
			   <input type=\"submit\" value=\"Create Comment\">
	   </form>";
echo "</div>";*/
?>

<?php
 /* // the comment to create
    $postComment = array(
        'data' => array(
            'object' => array('type' => 'note',
                'content' => '$_POST("buzzPostComment")')));

// create an activity
    $activity = $buzz->insertActivities('@self', $postComment); */
?>