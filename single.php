<?php get_header();?>
<div id="content">
<div id="content-main">
<?php if (have_posts()) : ?>
		<div class="postnav">
			<div class="alignleft"><?php previous_post_link('&laquo; %link') ?></div>
			<div class="alignright"><?php next_post_link('%link &raquo;') ?></div>
		</div>
		<?php while (have_posts()) : the_post(); ?>
				
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="posttitle">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<p class="post-info"><?php the_time('M jS, Y') ?> by <?php the_author_posts_link() ?> <?php edit_post_link('Edit', '', ' | '); ?> </p>
				</div>
				<div class="entry">
					<?php the_content(); ?>
					<?php wp_link_pages(); ?>
					<p class="postmetadata">
            <?php if (function_exists('the_tags')) the_tags('Tags: ', ', ', '<br/>'); ?> </p>
				</div>
				<p class="postmetadata">Posted in <?php the_category(', ') ?></p>				
			</div>
			<?php comments_template(); ?>	
		<?php endwhile; ?>
	<?php else : include_once(TEMPLATEPATH.'/notfound.php');?>
	<?php endif; ?>
</div><!-- end id:content-main -->
<?php get_sidebar();?>
<?php get_footer();?>