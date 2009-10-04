<!- You should put in your Twitter account URL on line 14, Tumblr URL on line 20, and your Twitter username on line 55.  You can also change the number of Twitter posts to retrieve by changing the "count" number on line 55-->
<?php
/*
Template Name: microblog
*/
?>

<?php get_header(); ?>

<div id="main">
<div id="twitter_div">
<h6 class="twitter-title">Latest Tweet</h6>
<ul id="twitter_update_list"></ul>
<small><a href="http://twitter.com/zanshin">Follow me on Twitter</a></small></div>

<div id="tumblr_div">
<h6>Latest Tumbles</h6>
<?php

$url = 'http://zanshin.tumblr.com/api/read';

$xml = simplexml_load_file( $url );

foreach( $xml->posts->post AS $post )
{
    echo '<div class="tumblr_post">';
    $attrs = $post->attributes();
    $type = $attrs['type'];
    if( $type == 'link' ) {
        echo '<a href='.$post->{'link-url'}.'>'.$post->{'link-text'}.'</a><br/><p>'.$post->{'link-description'}.'</p>';
    } else if ( $type == 'photo' ) {
        echo $post->{'photo-url'}.'<br/><small>'.$post->{'photo-caption'}.'</small>';
    } else if ( $type == 'video' ) {
        echo $post->{'video-player'}.'<br/><small>'.$post->{'video-caption'}.'</small>';
    } else if ( $type == 'audio' ) {
        echo $post->{'audio-player'}.'<br/><small>'.$post->{'audio-caption'}.'</small>';
    } else if ( $type == 'quote' ) {
        echo '<h3>'.$post->{'quote-text'}.'</h3><br/><h6>'.$post->{'quote-source'}.'</h6>';
    } else if ( $type == 'regular' ) {
        echo '<h3>'.$post->{'regular-title'}.'</h3><br/><p>'.$post->{'regular-body'}.'</p>';
    } else if ( $type == 'conversation' ) {
        echo '<h6>'.$post->{'conversation-text'}.'</h6>';
    } else {
        echo 'other<br/>';
    }
    echo '</div>';
}

?>
</div>

</div>
<?php get_sidebar(); ?>
<script type="text/javascript" src="http://twitter.com/javascripts/blogger.js"></script>
<script type="text/javascript" src="http://twitter.com/statuses/user_timeline/zanshin.json?callback=twitterCallback2&count=1"></script>
<?php get_footer(); ?>
