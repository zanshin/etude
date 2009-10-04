<?php get_header();?>
<div id="content">
<div id="content-main">
<?php if (have_posts()) : ?>
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
    
		<?php /* If this is a category archive */ if (is_category()) { ?>				
		<h2 class="pagetitle">Category Archive for '<?php echo single_cat_title(); ?>'</h2>
	
		<?php /* If this is a Tag archive */ } elseif (function_exists('is_tag')&& is_tag()) { ?>				
		<h2 class="pagetitle">Tag Archive '<?php echo single_tag_title(); ?>'</h2>
		
 		<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
		<h2 class="pagetitle">Daily Archive for <?php the_time('F jS, Y'); ?></h2>
		
		<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
		<h2 class="pagetitle">Monthly Archive for <?php the_time('F, Y'); ?></h2>

		<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
		<h2 class="pagetitle">Yearly Archive for <?php the_time('Y'); ?></h2>
		<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="pagetitle">Blog Archives</h2>

		<?php } ?>
		<?php while (have_posts()) : the_post(); ?>
				
			<div class="post" id="post-<?php the_ID(); ?>">
				<div class="posttitle">
					<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>"><?php the_title(); ?></a></h2>
					<p class="post-info">
						Posted in <?php the_category(', ') ?>  on <?php the_time('M jS, Y') ?></p>
				</div>
				
				<div class="entry">
					<?php the_excerpt(); ?>
					<p><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">Read Full Post &#187;</a></p>
				</div>
				<?php comments_template(); ?>
			</div>
	
		<?php endwhile; ?>

		<p align="center"><?php posts_nav_link(' - ','&#171; Prev','Next &#187;') ?></p>
		
	<?php else : include_once(TEMPLATEPATH.'/notfound.php');?>
	<?php endif; ?>
</div><!-- end id:content-main -->
<?php get_sidebar();?>
<?php get_footer();?>