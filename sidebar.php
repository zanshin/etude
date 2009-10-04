<div id="sidebar">
<ul>
<?php if ( function_exists('dynamic_sidebar') && dynamic_sidebar() ) : else : ?>
<?php if(is_home())  etude_ShowAbout(); ?>
<?php if(!is_home())  etude_ShowRecentPosts();?>

<li class="sidebox">
	<h3><?php _e('Archives'); ?></h3>
	<ul><?php wp_get_archives('type=monthly&show_post_count=true'); ?></ul>
</li>

<li class="sidebox">
	<h3><?php _e('Categories'); ?></h3>
	<ul>
		<?php 
		if (function_exists('wp_list_categories')) 
		{	
			wp_list_categories('show_count=1&hierarchical=1&title_li='); 
		}
		else 
		{   
			wp_list_cats('optioncount=1');  
		}  
		?>
	</ul>		
</li>
<?php if (function_exists('wp_tag_cloud')) {	?>
<li class="sidebox">	
	<h3><?php _e('Tags'); ?></h3>
	<p>
		<?php wp_tag_cloud(); ?>
	</p>
</li>
<?php } ?>
<li class="sidebox">
	<h3><?php _e('Pages'); ?></h3>
	<ul><?php wp_list_pages('exclude=1398&title_li=' ); ?></ul>	
</li>
<?php if(is_home()) {  etude_ShowLinks(); ?>
<li class="sidebox">
	<h3><?php _e('Meta'); ?></h3>
	<ul>
		<?php wp_register(); ?>
		<li><?php wp_loginout(); ?></li>
		<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
		<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
		<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
		<?php wp_meta(); ?>
	</ul>	
</li>
<?php }?>
  <?php endif; ?>
</ul>
</div><!-- end id:sidebar -->
</div><!-- end id:content -->
</div><!-- end id:container -->