
	<!-- Thoose script are needed -->
	<script	src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js" type="text/javascript"></script>
	<script src="resources/js/jquery.hiddendimensions.js" type="text/javascript"></script>
	<script src="resources/js/jquery.popup.js" type="text/javascript"></script>
	<script src="resources/js/ZeroClipboard.custom.js" type="text/javascript" ></script>
	<script src="resources/js/scoop.js" type="text/javascript" ></script>
	<script type="text/javascript" src="https://apis.google.com/js/plusone.js"></script>
    <link href="resources/css/reset.css" rel="stylesheet" type="text/css" media="all" />
    <link href="resources/css/style.css" rel="stylesheet" type="text/css" media="all" />
	<link href="resources/css/share.css" rel="stylesheet" type="text/css" media="all" />
	<?php 
		//files to include
		include_once 'Scoopit-PHP/ScoopIt.php';
		include_once 'include_commons.php';
		
		//configuration
		date_default_timezone_set('Europe/Paris');
		
		// Construct scoop var, which handle API communication
		$scoop = new ScoopIt(new SessionTokenStore(), $localUrl, $consumerKey, $consumerSecret);

		$page = isset($_REQUEST["page"]) ? (int)$_REQUEST["page"] : 1;
		
		if (isset($cache_folder)) {
			if (!file_exists($cache_folder)) {
				mkdir($cache_folder, 0700);
			}
			$cache_filename = $cache_folder."/aggregation_$topicId$page.cache";
			
			$time_expire = time() - $cache_time*60; 
			$aggregation = null;
			if (!file_exists($cache_filename) || filectime($cache_filename) <= $time_expire) {
				//file too old -> query
				$curated=$nbPostsPerPage;
				$curable=0;
				$aggregation = $scoop->getCustomRequest("/aggregation?topicIds=$topicId&count=$nbPostsPerPage&page=".($page-1));
				file_put_contents($cache_filename, mySerialize($aggregation));
			} else {
				//get from cache
				$aggregation = myUnserialize(file_get_contents($cache_filename));
			}
		} else {
			//NO cache
			$curated=$nbPostsPerPage;
			$curable=0;
			$aggregation = $scoop->getCustomRequest("/aggregation?topicIds=$topicId&count=$nbPostsPerPage&page=".($page-1));
		}
		
		$totalPostCount = $aggregation->totalPostCount;
		$pageCount = ceil($totalPostCount/$nbPostsPerPage);
		if($pageCount==0) $pageCount=1;
		if($page > $pageCount) $page = $pageCount;
		
	?>
		<div id="scit_viewbox">
			<!-- Is there a post to show on overlay -->
			<?php if (isset($_REQUEST["post"])) {
				$post = $scoop->aPost($_REQUEST["post"]);
				include 'include_a_post_on_overlay.php';
			} ?>
		
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr valign="top">
					<td width="50%" style="padding-right: 10px">
						<?php 
							$absoluteCounter = ($page-1)*$nbPostsPerPage;
							
							for ($i = 0; $i < count($aggregation->posts); $i++) {
								$post = $aggregation->posts[$i];
								if(isset($aggregation->posts) && $page == 1 && $i == 0) {
									$condition = ($i-1) % 2 == 0;
								} else {
									$condition = ($i-1) % 2 != 0;
								}
								if ($condition) {
									$absolutePosition = $absoluteCounter + $i;
									include 'include_a_post.php';
								}
							}
						?>
		             </td>
		             <td width="50%">
		             	<?php 
							for ($i = 0; $i < count($aggregation->posts); $i++) {
								$post = $aggregation->posts[$i];
								if(isset($aggregation->posts) && $page == 1 && $i == 0) {
									$condition = ($i-1) % 2 != 0;
								} else {
									$condition = ($i-1) % 2 == 0;
								}
								if ($condition) {
									$absolutePosition = $absoluteCounter + $i;
									include 'include_a_post.php';
								}
							}
						?>
		             </td>
		        </tr>
		    </table>
		
			<!-- PAGINATION -->
			<?php 
				include_once 'include_paginator.php';
			?>
	            

	            <div class="scoopitPowered">
	            	<center>
	            		<a href="http://www.scoop.it">
	            			<img src="resources/img/poweredbyscoopit_35_transp-1.png"></img>
	            		</a>
	            	</center>
	            </div>
	        </div>