<?php get_header();?>
<div id="content">
<div id="content-main">
		<?php if ($posts) {
				if (get_settings(' etude_asideid') != "")
					$AsideId = get_settings(' etude_asideid');
				function ml_hack($str)
				{
					return preg_replace('|</ul>\s*<ul class="asides">|', '', $str);
				}
				ob_start('ml_hack');
				foreach($posts as $post)
				{
					the_post();
				?>
				<?php if ( in_category($AsideId) && !is_single() ) : ?>
					<ul class="asides">
						<li id="p<?php the_ID(); ?>">
							<?php echo wptexturize($post->post_content); ?>							
							<br/>
							<p class="postmetadata"><?php comments_popup_link('(0)', '(1)','(%)')?>  | <a href="<?php the_permalink(); ?>" title="Permalink: <?php echo wptexturize(strip_tags(stripslashes($post->post_title), '')); ?>" rel="bookmark">#</a> <?php edit_post_link('(edit)'); ?></p>
						</li>						
					</ul>
				<?php else: // If it's a regular post or a permalink page ?>	
				<div class="post" id="post-<?php the_ID(); ?>">
				<div class="posttitle">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<p class="post-info"><?php the_time('M jS, Y') ?> by <?php the_author_posts_link() ?> <?php edit_post_link('Edit', '', ' | '); ?> </p>
				</div>
				
				<div class="entry">
					<?php the_content('Continue Reading &raquo;'); ?>
					<?php wp_link_pages(); ?>
					<p class="postmetadata"><?php if (function_exists('the_tags')) the_tags('Tags: ', ', ', '<br/>'); ?> </p>
				</div>
		
				<p class="postmetadata">Posted in <?php the_category(', ') ?> | <?php comments_popup_link('No Comments &#187;', '1 Comment &#187;', '% Comments &#187;'); ?></p>
				<?php comments_template(); ?>
			</div>
			<?php endif; // end if in category ?>
			<?php
				}
			}
			else include_once(TEMPLATEPATH.'/notfound.php');			
		?>
		<p align="center"><?php posts_nav_link(' - ','&#171; Newer Posts','Older Posts &#187;') ?></p>
</div><!-- end id:content-main -->
<?php get_sidebar();?>
<?php get_footer();?>