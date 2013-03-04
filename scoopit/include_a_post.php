<?php
// Parameters
// ----------
// $post : a post to print
// $isPinnedPost : true to display the pinned post
// $inPopup : true to display the post in a popup
// $whiteLabel : true to work as white label
//
// FIXME  : check unicity with Scoop.it web site

if (!isset($isPinnedPost)) {
	$isPinnedPost = false;
}
if (!isset($inPopup)) {
	$inPopup = false;
}

if (!isset($whiteLabel)) {
	$whiteLabel = false;
}

$url = null;
$shareUrl = null;
if ($whiteLabel) {
	$url = $post->url;
	$shareUrl = $localUrl.'&amp;post='.$post->id;
} else {
	$url = $post->scoopUrl;
	$shareUrl = $post->scoopUrl;
}

?>

<div class="onePost <?php if($isPinnedPost && !$inPopup) echo "sticky" ?>">
	 <div class="clear"></div>
	 <div id="post<?php if($inPopup) echo "InPopup" ?>_<?php echo $post->id ?>">
	 	<div class="postView post <?php if($isPinnedPost && !$inPopup) echo "favorite" ?> <?php if(isset($post->imageSize)) echo $post->imageSize; ?> <?php if(isset($post->imagePosition)) echo $post->imagePosition; ?>">
	 		
	 		<!-- POST META -->
	 		<div class="metas">
   						<span><?php echo date("M d, Y", $post->curationDate / 1000 ) ?></span> - 
   						<span><?php if(isset($post->url)) { ?>
		                           	<a target="_blank" href="<?php echo $post->url ?>">
		                				<?php echo getDomain($post->url); ?>
		            				</a>
		              			<?php } ?>
		              </span>
            </div>
            
            <!-- POST TITLE -->
            <div class="title">
              	<h2 class="postTitleView">
                	<a href="<?php echo $url ?>" target="_blank" id="post_title"><?php echo $post->title ?></a>
              	</h2>
            </div>
            
            
            <!-- HTML FRAGMENT OR IMAGE URL -->
            <?php
              if(property_exists($post, "htmlFragment")) { ?>
                <div class="htmlFragment"><?php echo $post->htmlFragment ?></div><?php
              } else if(property_exists($post, "imageUrl")) { ?>
                <div class="image">
                  	<a href="<?php echo $url ?>" target="_blank" id="post_title">
                    	<img src="<?php echo $post->imageUrl ?>" onload="adjustImage(this, 'false')"/>
					</a>
                </div> <?php
              }
            ?>
            
            <div class="description">
						  <div id="post_description">
                <?php echo isset($post->htmlContent) ? $post->htmlContent : $post->content ?>
						  </div>
						  <div class="clear"></div>
            </div>
            
            <div style="clear:both"></div>
        
        </div>
        <table cellspacing="0" cellpadding="0" class="actionsBar">
          <tbody>
            <tr>
            <td class="actionsBar-left">
                <div class="clear">
                  <?php if(isset($post->source)) ?>
                  <?php print_r($post->source) ?>
                    <div class="postSource">
                      Source : 
                      <a target="_blank" href="">
                        zawya.com
                      </a>
                    </div>
                </div>
                <?php ?>
            </td>
            <td class="actionsBar-right">
              
            </td>
          </tr>
        </tbody>
      </table>
	 </div>
</div>

