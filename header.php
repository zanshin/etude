<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php bloginfo('name'); ?> <?php wp_title(); ?><?php if ( is_single() ) { ?> &raquo; Blog Archive <?php } ?></title>
<meta name="generator" content="WordPress <?php bloginfo('version'); ?>" /> <!-- leave this for stats -->
<meta name="keywords" content="<?php bloginfo('description'); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<meta name="verify-v1" content="A5k3dyvCHXOl0UA3Ngqm4DSPvWMUWCkVFL4I9b7SBKU=" />
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php
global $page_sort;	
	if(get_settings(' etude_sortpages')!='')
	{ 
		$page_sort = 'sort_column='. get_settings(' etude_sortpages');
	}	
	global $pages_to_exclude;
	
	if(get_settings(' etude_excludepages')!='')
	{ 
		$pages_to_exclude = 'exclude='. get_settings(' etude_excludepages');
	}	
?>
<!-- skribit suggestion tab code -->
<link rel="stylesheet" type="text/css" media="screen" charset="utf-8" href="http://assets.skribit.com/stylesheets/SkribitSuggest.css"></link>
<style type="text/css" media="print" charset="utf-8">a#sk_tab{display:none !important;}</style>
<script src="http://assets.skribit.com/javascripts/SkribitSuggest.js" type="text/javascript"></script>
<script type="text/javascript" charset="utf-8">
      var skribit_settings = {};
      skribit_settings.placement = "left";
      skribit_settings.color = "#333333";
      skribit_settings.text_color = "white";
      skribit_settings.distance_vert = "20%";
      skribit_settings.distance_horiz = "";
      SkribitSuggest.suggest('http://skribit.com/lightbox/zanshinnet', skribit_settings);
</script>

<?php wp_head(); ?>
</head>
<body id="section-index">


<div id="navigation">
<ul>
	<li <?php if(is_home()){echo 'class="current_page_item"';}?>><a href="<?php bloginfo('siteurl'); ?>/" title="Home">Home</a></li>
		<?php wp_list_pages('title_li=&depth=1&'.$page_sort.'&'.$pages_to_exclude)?>
	<li class="search"><form method="get" id="searchform" action="<?php bloginfo('home'); ?>"><input type="text" class="textbox" value="<?php echo wp_specialchars($s, 1); ?>" name="s" id="s" /><input type="submit" id="searchsubmit" value="Search" /></form></li>
</ul>
</div><!-- end id:navigation -->


<div id="container">


<div id="header">
<h1><a href="<?php bloginfo('siteurl');?>/" title="<?php bloginfo('name');?>"><?php bloginfo('name');?></a></h1>
<p id="desc"><?php bloginfo('description');?></p>
</div><!-- end id:header -->


<div id="feedarea">
<dl>
	<dt><strong>Feed on</strong></dt>
	<dd><a href="<?php bloginfo('rss2_url'); ?>">Posts</a></dd>
	<dd><a href="<?php bloginfo('comments_rss2_url'); ?>">Comments</a></dd>
        <dd><a href="http://tumblr.zanshin.net/rss">Tumblr</a></dd>	
</dl>
</div><!-- end id:feedarea -->

  
  <div id="headerimage">
</div><!-- end id:headerimage -->