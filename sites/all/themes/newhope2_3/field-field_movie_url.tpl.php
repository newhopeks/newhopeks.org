<div class="field-movie-url">
  <?php drupal_add_js(path_to_theme() . '/js/ufo.js', 'theme'); ?>
  
  <p class="movie" id="node-movie-<?php print $node->nid ?>"><a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.</p>

  <?php
	$inline_js = '$(document).ready(function(){';
	$inline_js .= 'var FO = { movie:"https://media.dreamhost.com/mediaplayer.swf",width:"320",height:"260",majorversion:"7",build:"0",bgcolor:"#FFFFFF",flashvars:"file='.$items[0]['value'].'&amp;showdigits=true&amp;autostart=false" };';
	$inline_js .= 'UFO.create(FO,"node-movie-'.$node->nid.'");';
	$inline_js .= '});';
	drupal_add_js($inline_js, 'inline');
	?>
</div>
