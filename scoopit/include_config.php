<?php 

	/* *********************************** OAUTH CONFIGURATION ********************************* */
	$localUrl = "https://secure-eyrie-1038.herokuapp.com/";
	$consumerKey = "mipimworld|fbHpL8ek1f6SzJLg5kV-C7poHsSimtX2nZ2H3Ak3mco";
	$consumerSecret = "32kmA4X2MUBX@DYnEzUiFyemgpG6Zk5bcNTrAidR5IF1zZpMOF";
	
	/* *********************************** TYPE CONFIGURATION ********************************** */
	
	// Topic(s) to render : 
	// a comma separated list to get a compilation of all topics -> include include_aggregation
	// a single id to display one topic -> include include_topic
	$topicId="589511";
	
	// Does post will be liked to original or not
	// if unset it wil lead to scoop.it
	$whiteLabel=false;
	
	
	
	/* ********************************** DISPLAY CONFIGURATION ******************************** */
	
	// nb post to display per page
	$nbPostsPerPage = 12;

	
	
	/* *********************************** CACHE CONFIGURATION ********************************* */
	//location on the server for cache : do not set it for no cache
	$cache_folder = "/tmp/cache";
	//cache expiration time in minutes
	$cache_time = 1;
	
	

?>
