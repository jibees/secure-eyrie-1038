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
                  <!-- SOURCE -->
                <div class="postSource">
                                  Source : 
                    <a target="_blank" href="http://www.zawya.com/story/Mapping_the_future_of_megacities-ZAWYA20130303051415/">
                      zawya.com                 </a>
                                  </div>
                </div>
            </td>
            <td class="actionsBar-right">
              
              <!-- AddThis Button BEGIN -->
              <div class="addthis_toolbox addthis_default_style " addthis:url="http://blog.mipimworld.com/sustainability/industry-news/?1=1&amp;post=3997785389" addthis:title="Mapping the future of megacities - Zawya (registration), zawya.com">
              <a class="addthis_button_facebook at300b" title="Facebook" href="#"><span class="at16nc at300bs at15nc at15t_facebook at16t_facebook"><span class="at_a11y">Share on facebook</span></span></a>
              <a class="addthis_button_twitter at300b" title="Tweet" href="#"><span class="at16nc at300bs at15nc at15t_twitter at16t_twitter"><span class="at_a11y">Share on twitter</span></span></a>
              <a class="addthis_button_linkedin at300b" href="http://www.addthis.com/bookmark.php?v=250&amp;winname=addthis&amp;pub=reedanalyticsimmo&amp;source=tbx-250,wpp-262&amp;lng=en&amp;s=linkedin&amp;u508=1&amp;url=http%3A%2F%2Fblog.mipimworld.com%2Fsustainability%2Findustry-news%2F%3F1%3D1%26post%3D3997785389&amp;title=Mapping%20the%20future%20of%20megacities%20-%20Zawya%20(registration)%2C%20zawya.com&amp;ate=AT-reedanalyticsimmo/-/-/5134b1f12810f0d7/2&amp;frommenu=1&amp;uid=5134b1f1e3584653&amp;ct=1&amp;tt=0&amp;captcha_provider=nucaptcha" target="_blank" title="Linkedin"><span class="at16nc at300bs at15nc at15t_linkedin at16t_linkedin"><span class="at_a11y">Share on linkedin</span></span></a>
              <a class="addthis_button_google_plusone at300b"><div style="height: 15px; width: 70px; display: inline-block; text-indent: 0px; margin: 0px; padding: 0px; background-color: transparent; border-style: none; float: none; line-height: normal; font-size: 1px; vertical-align: baseline; background-position: initial initial; background-repeat: initial initial;" id="___plusone_0"><iframe frameborder="0" hspace="0" marginheight="0" marginwidth="0" scrolling="no" style="position: static; top: 0px; width: 70px; margin: 0px; border-style: none; left: 0px; visibility: visible; height: 15px;" tabindex="0" vspace="0" width="100%" id="I0_1362407921636" name="I0_1362407921636" src="https://plusone.google.com/_/+1/fastbutton?bsv&amp;size=small&amp;hl=en-US&amp;origin=http%3A%2F%2Fblog.mipimworld.com&amp;url=http%3A%2F%2Fblog.mipimworld.com%2Fsustainability%2Findustry-news%2F%3F1%3D1%26post%3D3997785389&amp;jsh=m%3B%2F_%2Fscs%2Fapps-static%2F_%2Fjs%2Fk%3Doz.gapi.fr.mpoN34iO7qk.O%2Fm%3D__features__%2Fam%3DqQ%2Frt%3Dj%2Fd%3D1%2Frs%3DAItRSTOr2Xk_2R1bNdsogHk9Xir4zE683A#_methods=onPlusOne%2C_ready%2C_close%2C_open%2C_resizeMe%2C_renderstart%2Concircled&amp;id=I0_1362407921636&amp;parent=http%3A%2F%2Fblog.mipimworld.com&amp;rpctoken=25873273" allowtransparency="true" data-gapiattached="true" title="+1"></iframe></div></a>
              <a class="addthis_button_compact at300m" href="#"><span class="at16nc at300bs at15nc at15t_compact at16t_compact"><span class="at_a11y">More Sharing Services</span></span></a>
              <a class="addthis_counter addthis_bubble_style" style="display: inline-block;" href="#"><a class="addthis_button_expanded" title="View more services" href="#">0</a><a class="atc_s addthis_button_compact"><span></span></a></a>
              <div class="atclear"></div></div>       
              <!-- AddThis Button END -->
        
            </td>
          </tr>
        </tbody>
      </table>
	 </div>
</div>

