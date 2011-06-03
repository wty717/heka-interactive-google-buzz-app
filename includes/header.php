<?php
/*
// General Hader
// Things to work on:
[] Create a dedicated Javascript page
[] Create a dynamic <title> element
*/
session_start();
include 'config.php';
?>

<!DOCTYPE HTML>
<HTML>
<head>
<title></title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/> 
<link href="css/reset.css" rel="stylesheet" type="text/css" />
<link href="css/styles.css?=ver1" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="js/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />

<!-- INCLUDE JAVASCRIPT -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js" type="text/javascript"></script>
<script src="js/jquery.lazyload.mini.js" type="text/javascript"></script>
<script src="js/jquery-ui-1.8.8.custom.min.js" type="text/javascript" ></script>
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<script>
		
	$(document).ready(function() {
		// Sets up images so that they load as the page srolls down, to save on bandwidth and loading times
		$("img").lazyload({ threshold : 200 });
		
		// Selects the h4 element from the right sidebar, and upon click
		// the ul element below it will be hidden
		$('h4').click(function() {
			$(this).next('ul').toggle('fast');
		});
		
		
		
		// Selects the comment-footer element and upon click
		// the comments above it will be hidden
		$('.comment-collapase').click(function() {
			$(this).parent().prev('.comment-content').toggle();
		});
		
		
		$('.comment-btn').click(function() {
			$(this).parent().parent().parent().next('.comment-content').toggle();
		});
		
		$('.comment-cancel').click(function() {
			$(this).parent().parent().toggle();
			$(this).parent().find('textarea').val("");
		});
		
		
		//$('.more').click(function() {
		//	$(this).next('.options').toggle();
		//});
		
		$('.create-comment-btn').click(function() {
			$(this).parent().parent().parent().next('.create-comment').toggle();
		});
		
		
		// Selects the comment-footer element and upon click
		// the comments above it will be hidden
		$('h4').val('Collapse All Comments').click(function() {
			$('.comment-content').toggle();
		});
	});
	//});
	</script>
</head>