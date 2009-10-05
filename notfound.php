<div class="post" id="post-<?php the_ID(); ?>">
	<div class="posttitle">
		<h2>404</h2>
		<p class="post-info">We're sorry. The page you requested isn't available.</p>
	</div>
	<div class="entry">
		<p>
			May I suggest you visit the <a href="http://zanshin.net/archives" title="Archives">archives</a>, or 
			perhaps the <a href="http://zanshin.net" title="Zanshin.net">home page</a>.
		<p>
		<p>
			You could also try doing a search.
		</p>
		<p>
			<form method="get" id="searchform" action="<?php bloginfo('home'); ?>">
				<input type="text" class="textbox" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" />
				<input type="submit" id="searchsubmit" value="Search" />
			</form>
		</p>
	</div>
	<p class="postmetadata">Posted as Not Found</p>
</div>	