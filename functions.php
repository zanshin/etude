<?php
// helper functions
  if ( function_exists('wp_list_bookmarks') ) //used to check WP 2.1 or not
    $numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='post' and post_status = 'publish'");
	else
    $numposts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_status = 'publish'");
  if (0 < $numposts) $numposts = number_format($numposts); 
	$numcmnts = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->comments WHERE comment_approved = '1'");
		if (0 < $numcmnts) $numcmnts = number_format($numcmnts);
// ----------------
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_widget' => '<li class="sidebox">', 
		'after_widget' => '</li>',
		'before_title' => '<h3>',
		'after_title' => '</h3>', 
	));
if ( function_exists('unregister_sidebar_widget') )
	{
		unregister_sidebar_widget( __('Links') );	
	}
	if ( function_exists('register_sidebar_widget') )
	{
		register_sidebar_widget(__('Links'), ' etude_ShowLinks');
	}
	if ( function_exists('register_sidebar_widget') )
	{
		register_sidebar_widget(__('About'), ' etude_ShowAbout');
	}
function  etude_ShowAbout() {?>
<li class="sidebox">
	<h3>About</h3>
	<p>
	<img src="<?php bloginfo('stylesheet_directory');?>/img/profile.jpg" alt="Profile" /><br/>
	<strong><?php bloginfo('name');?></strong><br/><?php bloginfo('description');?><br/>
	There are <?php global $numposts;echo $numposts; ?> Posts and <?php global $numcmnts;echo $numcmnts;?> Comments so far.
	</p>	
</li>
<?php }	

function  etude_ShowRecentPosts() {?>
<li class="sidebox">
	<h3>Recent Posts</h3>
	<ul><?php wp_get_archives('type=postbypost&limit=6');?></ul>
</li>
<?php }	

function  etude_ShowLinks() {?>
<li class="sidebox" id="sidelinks">
	<ul>
		<?php 
			if(function_exists('wp_list_bookmarks')) 
			{ 
				wp_list_bookmarks(); 
			} 
			else 
			{ 
				get_links_list('name');
			}
		?>
	</ul>
</li>
<?php  }

function  etude_add_theme_page() {
	if ( $_GET['page'] == basename(__FILE__) ) {
	
	    // save settings
		if ( 'save' == $_REQUEST['action'] ) {

			update_option( ' etude_asideid', $_REQUEST[ 's_asideid' ] );
			update_option( ' etude_sortpages', $_REQUEST[ 's_sortpages' ] );
			if( isset( $_POST[ 'excludepages' ] ) ) { update_option( ' etude_excludepages', implode(',', $_POST['excludepages']) ); } else { delete_option( ' etude_excludepages' ); }
			// goto theme edit page
			header("Location: themes.php?page=functions.php&saved=true");
			die;

  		// reset settings
		} else if( 'reset' == $_REQUEST['action'] ) {

			delete_option( ' etude_asideid' );
			delete_option( ' etude_sortpages' );			
			delete_option( ' etude_excludepages' );
			
			
			// goto theme edit page
			header("Location: themes.php?page=functions.php&reset=true");
			die;

		}
	}


    add_theme_page("Etude Options", "Etude Options", 'edit_themes', basename(__FILE__), ' etude_theme_page');

}

function  etude_theme_page() {

	// --------------------------
	// Etude theme page content
	// --------------------------

	if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>Etude Theme: Settings saved.</strong></p></div>';
	if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>Etude Theme: Settings reset.</strong></p></div>';
	
?>
<style>
	.wrap { border:#ccc 1px dashed;}
	.block { margin:1em;padding:1em;line-height:1.6em;}
	table tr td {border:#ddd 1px solid;font-family:Verdana, Arial, Serif;font-size:0.9em;}
	h4 {font-size:1.3em;color:#265e15;font-weight:bold;margin:0;padding:10px 0;}	
</style>
<div class="wrap">

<h2>Etude 0.2</h2>

<div class="block"><h4>Theme Page: <a href="http://etude.zanshin.net">Etude</a> </h4> 
					<h4>Designed & Coded by:<a href="http://zanshin.net" target="_blank">Mark Nichols</a></h4>
					
</div>


<form method="post">


<!-- blog layout options -->
<fieldset class="options">
<legend>Theme Settings</legend>

<p>Change the way your blog looks and acts with the many blog settings below</p>

<table width="100%" cellspacing="5" cellpadding="10" class="editform">
<tr>
<td valign="top" colspan="2" style="border:0px;margin:0;padding:0;">
	<input type="hidden" name="action" value="save" />
	<?php ml_input( "save", "submit", "", "Save Settings" );?>
</td>
</tr>
<tr valign="top">
<td align="left">
	<?php
	ml_heading("List Pages / Navigation");		
		global $wpdb;
		if (function_exists('wp_list_bookmarks')) //WP 2.1 or greater
			$results = $wpdb->get_results("SELECT ID, post_title from $wpdb->posts WHERE post_type='page' AND post_parent=0 ORDER BY post_title");
		else
			$results = $wpdb->get_results("SELECT ID, post_title from $wpdb->posts WHERE post_status='static' AND post_parent=0 ORDER BY post_title");
		
		$excludepages = explode(',', get_settings(' etude_excludepages'));
		if($results) {				
			_e('<br/>Exclude the Following Pages from the Top Navigation <br/><br/>');
			foreach($results as $page) 
      {
			  echo '<input type="checkbox" name="excludepages[]" value="' . $page->ID . '"';
        if(in_array($page->ID, $excludepages)==true) { echo ' checked="checked"'; }
				echo ' /> <a href="' . get_permalink($page->ID) . '">' . $page->post_title . '</a><br />';
			}		
		}		
		_e('<br/><br/>');
		echo "<br/><strong> Sort the List Pages by </strong><br/>";
		
		ml_input( "s_sortpages", "radio", "Page Title ?", "post_title", get_settings( ' etude_sortpages' ) );		
		ml_input( "s_sortpages", "radio", "Date ?", "post_date", get_settings( ' etude_sortpages' ) );		
		ml_input( "s_sortpages", "radio", "Page Order ?", "menu_order", get_settings( ' etude_sortpages' ) );
		echo "(Each Page can be given a page order number, from the wordpress admin, edit page area)";
		echo "<br/>";			
?>
</td>
<td>
<?php
	ml_heading( "Support for Asides / Side Notes" );	
	echo "Asides are the 'quick bits' of information you want to post. They do not have to look like a regular post.";
	echo "<br/><br/>Learn More at <a href='http://photomatt.net/2004/05/19/asides/'>Matt's Asides technique</a>";
?>
	<?php
		global $wpdb;
		$id = get_option(' etude_asideid');
		$defaults = array(
			'show_option_all' => '', 'show_option_none' => '', 
			'orderby' => 'ID', 'order' => 'ASC', 
			'show_last_update' => 0, 'show_count' => 0, 
			'hide_empty' => 1, 'child_of' => 0, 
			'exclude' => '', 'echo' => 1, 
			'selected' => 0, 'hierarchical' => 0, 
			'name' => 'cat', 'class' => 'postform'
		);
		$r = wp_parse_args( $args, $defaults );
		extract( $r );

		$asides_cats = get_categories($r);
	?>
			<p>Select the category here. Any posts under this category will look like an Aside.</p>
			<select name="s_asideid" id="s_asideid">
				<option value="0">NOT SELECTED</option>
				<?php
					foreach ($asides_cats as $cat) {
					if ($id == $cat->cat_ID)
					{
						$sIsSelected = "selected='true'";
					}
					else
					{
						$sIsSelected = "";			
					}
						echo '<option value="' . $cat->cat_ID . '"'. $sIsSelected. '>' . $cat->cat_name . '</option>';
				}?>
			</select>	
</td>

</td>
</tr>	
<tr>
<td valign="top" colspan="2" style="border:0px;margin:0;padding:0;">
	<input type="hidden" name="action" value="save" />
	<?php ml_input( "save", "submit", "", "Save Settings" );?>
</td>
</tr>
</table>
</fieldset>
</form>

<form method="post">

<fieldset class="options">
<legend>Reset</legend>

<p>If for some reason you want to uninstall Etude then press the reset button to clean things up in the database.</p>
<p>You have to make sure to delete the theme folder, if you want to completely remove the theme.</p>
<?php

	ml_input( "reset", "submit", "", "Reset Settings" );
	
?>

</div>
<input type="hidden" name="action" value="reset" />
</form>

<?php
}
add_action('admin_menu', ' etude_add_theme_page');


function ml_input( $var, $type, $description = "", $value = "", $selected="" ) {

	// ------------------------
	// add a form input control
	// ------------------------
	
 	echo "\n";
 	
	switch( $type ){
	
	    case "text":

	 		echo "<input name=\"$var\" id=\"$var\" type=\"$type\" style=\"width: 60%\" class=\"textbox\" value=\"$value\" />";
			
			break;
			
		case "submit":
		
	 		echo "<p class=\"submit\"><input name=\"$var\" type=\"$type\" value=\"$value\" /></p>";

			break;

		case "option":
		
			if( $selected == $value ) { $extra = "selected=\"true\""; }

			echo "<option value=\"$value\" $extra >$description</option>";
		
		    break;
  		case "radio":
  		
			if( $selected == $value ) { $extra = "checked=\"true\""; }
  		
  			echo "<label><input name=\"$var\" id=\"$var\" type=\"$type\" value=\"$value\" $extra /> $description</label><br/>";
  			
  			break;
  			
		case "checkbox":
		
			if( $selected == $value ) { $extra = "checked=\"true\""; }

  			echo "<label for=\"$var\"><input name=\"$var\" id=\"$var\" type=\"$type\" value=\"$value\" $extra /> $description</label><br/>";

  			break;

		case "textarea":
		
		    echo "<textarea name=\"$var\" id=\"$var\" style=\"width: 80%; height: 10em;\" class=\"code\">$value</textarea>";
		
		    break;
	}

}

function ml_heading( $title ) {

	// ------------------
	// add a table header
	// ------------------

   echo "<h4>" .$title . "</h4>";

}
?>
<?php

define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', '%s/img/etude.jpg'); // %s is theme dir uri
// define('HEADER_IMAGE_WIDTH', 760);
// define('HEADER_IMAGE_HEIGHT', 200);
define('HEADER_IMAGE_WIDTH', 940);
define('HEADER_IMAGE_HEIGHT', 300);
define( 'NO_HEADER_TEXT', true );

function  etude_admin_header_style() {
?>
<style type="text/css">
#headimg {
	background: url(<?php header_image() ?>) no-repeat;
}
#headimg {
	height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
	width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
}

#headimg h1, #headimg #desc {
	display: none;
}
</style>
<?php
}
function  etude_header_style() {
?>
<style type="text/css">
#headerimage {
	background: url(<?php header_image() ?>) no-repeat;
}
</style>
<?php
}
if ( function_exists('add_custom_image_header') ) {
	add_custom_image_header(' etude_header_style', ' etude_admin_header_style');
}
?>