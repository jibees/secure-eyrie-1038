
    <link href="stylesheets/reset.css" rel="stylesheet" type="text/css" media="all" />
    <link href="stylesheets/style.css" rel="stylesheet" type="text/css" media="all" />

    <script type="text/javascript" src="/javascript/scoop.js"></script>
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
			$cache_filename = $cache_folder."/topic_$topicId$page.cache";
			
			$time_expire = time() - $cache_time*60; 
			$topic = null;
			if (!file_exists($cache_filename) || filectime($cache_filename) <= $time_expire) {
				//file too old -> query
				$curated=$nbPostsPerPage;
				$curable=0;
				$topic = $scoop->topic($topicId, $curated, $curable, $page - 1);
				file_put_contents($cache_filename, mySerialize($topic));
			} else {
				//get from cache
				$topic = myUnserialize(file_get_contents($cache_filename));
			}
		} else {
			//NO cache
			$curated=$nbPostsPerPage;
			$curable=0;
			$topic = $scoop->topic($topicId, $curated, $curable, $page - 1);
		}
		
		$totalPostCount = $topic->curatedPostCount;
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
		
			<script type="text/javascript">
				jQuery(document).ready(function() {
					var totalWidth = parseInt(jQuery("#scit_viewbox").css("width"), 10);
					var postWidth = totalWidth/2 - 10;
					var youTubeWidth = postWidth - 10;
					
					jQuery(".onePost .htmlFragment").each(function() {
						jQuery("object", jQuery(this)).attr("width", youTubeWidth);
						jQuery("embed", jQuery(this)).attr("width", youTubeWidth);
					});
				});

			</script>
		
			<table cellpadding="0" cellspacing="0" width="100%">
				<tr valign="top">
					<td width="50%" style="padding-right: 10px">
						<?php 
							$absoluteCounter = ($page-1)*$nbPostsPerPage;
							
							if(isset($topic->pinnedPost) && $page == 1) {
								$post = $topic->pinnedPost;
								include 'include_a_post.php';
							}
							
							for ($i = 0; $i < count($topic->curatedPosts); $i++) {
								$post = $topic->curatedPosts[$i];
								if(isset($topic->pinnedPost) && $page == 1 && $i == 0) {
									$condition = ($i-1) % 2 == 0;
								} else {
									$condition = ($i-1) % 2 != 0;
								}
								if ($condition && (!isset($topic->pinnedPost) || $post->id != $topic->pinnedPost->id)) {
									$absolutePosition = $absoluteCounter + $i;
									include 'include_a_post.php';
								}
							}
						?>
		             </td>
		             <td width="50%">
		             	<?php 
							for ($i = 0; $i < count($topic->curatedPosts); $i++) {
								$post = $topic->curatedPosts[$i];
								if(isset($topic->pinnedPost) && $page == 1 && $i == 0) {
									$condition = ($i-1) % 2 != 0;
								} else {
									$condition = ($i-1) % 2 == 0;
								}
								if ($condition && (!isset($topic->pinnedPost) || $post->id != $topic->pinnedPost->id)) {
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
	            			<img src="images/poweredbyscoopit_35_transp-1.png"></img>
	            		</a>
	            	</center>
	            </div>
	        </div>