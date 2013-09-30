<?php
function newhope2_3_regions() {
  return array(
    'left' => t('left sidebar'),
    'content' => t('content'),
    'header' => t('header'),
    'footer' => t('footer'),
    'sidebar_admin' => t('admin sidebar'),
    'info_panel1' => t('info panel 1'),
    'info_panel2' => t('info panel 2'),
    'info_panel3' => t('info panel 3'),
  );
}

function newhope2_3_user_bar() {
  global $user;

  if ($user->name) {
    $output .= t('Welcome, !name!', array( '!name' => theme('username', $user)));
    $output .= ' ' . l('log out', 'logout');
  }

  else {
    if ($_GET['q'] != 'user/login') {
      $output .= drupal_get_form('user_login_block');
#                  <form action="/user/login?destination=<?php print drupal_urlencode($_GET['q']) >" id="theme_user_login" method="post">
#                    <label for="theme-edit-name">login</label>
#                    <input type="text" id="theme-edit-name" name="edit[name]" size="8" maxlength="60"/>
#                    <label for="theme-edit-pass">password</label>
#                    <input type="password" id="theme-edit-pass" name="edit[pass]" size="8"/>
#                    <input type="hidden" id="theme-edit-user-login" name="edit[form_id]" value="user_login"/>
#                    <input type="submit" name="op" value="Log in"/>
#                  </form>
    }
  }

  return $output;
}

function phptemplate_wrap_content($text) {
  $text = preg_replace('!<pre>!i', '<div class="pre"><pre>', $text);
  $text = preg_replace('!</pre>!i', '</pre></div>', $text);
  return $text;
}
function phptemplate_wrap_links($link, $n) {
  $classes = array("lw1", "lw2");
  $before = $after = "";
  foreach ($classes as $c) {
    $before .= '<span class="'. $c .'">';
    $after .= '</span>';
  }
  $link = preg_replace('!<a[^>]*>!i', '\0'. $before, $link);
  $link = preg_replace('!</a[^>]*>!i', $after . '\0', $link);
  return $link;
}

# function phptemplate_links($links, $delimiter = " – ") {
#   return implode($delimiter, $links);
# }

function phptemplate_menu_item_link($item, $link_item) {
  /* Wrapper span */
  return l('<span class="lw1">'. check_plain($item['title']) .'</span>', $link_item['path'], array_key_exists('description', $item) ? array('title' => $items['description']) : array(), NULL, NULL, FALSE, TRUE);
}

function phptemplate_comment_thread_min($comment, $threshold, $pid = 0) {
  if (comment_visible($comment, $threshold)) {
    $output  = '<div style="padding-left:'. ($comment->depth * 25) ."px;\">\n";
    $output .= theme('comment_view', $comment, '', 0);
    $output .= "</div>\n";
  }
  return $output;
}

function phptemplate_comment_thread_max($comment, $threshold, $level = 0) {
  $output = '';
  if ($comment->depth) {
    $output .= '<div style="padding-left:'. ($comment->depth * 25) ."px;\">\n";
  }

  $output .= theme('comment_view', $comment, theme('links', module_invoke_all('link', 'comment', $comment, 0)), comment_visible($comment, $threshold));

  if ($comment->depth) {
    $output .= "</div>\n";
  }
  return $output;
}

function phptemplate_flexinode_url($field_id, $label, $value, $formatted_value) {
  if ($field_id == 11) {
    return theme('form_element', $label, '<a href="http://'.$value.'">Download MP3</a>');
  } else { 
    return theme('form_element', $label, $formatted_value);
  }
}

function pretty_date($date) {
	$output = '<div class="pretty-date">';
	$output .= '<span class="month">'.substr($date['month'], 0, 3).'<span class="abbr">'.substr($date['month'], 3).'</span></span> ';
	$output .= '<span class="day">'.$date['mday'].'</span> ';
	$output .= '<span class="year">'.$date['year'].'</span>';
	$output .= '</div>';

	return $output;
}

function pretty_time($date) {
	$hour = $date['hours'];
	$ampm = '';
	if ($hour > 12) {
		$hour -= 12;
		$ampm = 'pm';
	}
	else {
		$ampm = 'am';
	}

	$output = '<div class="pretty-time">';
	$output .= '<span class="hour">'.$hour.'</span>';
	$output .= '<span class="sep">:</span>';
	$output .= sprintf('<span class="minute">%02d</span>', $date['minutes']);
	$output .= '<span class="ampm">'.$ampm.'</span>';
	$output .= '</div>';

	return $output;
}

function newhope2_3_date_display_combination($field, $dates, $node = NULL) {
  if ($node->type == 'message') {
		$date = $dates['value']['object']->local->parts;
		$output = '<div class="date-display-pretty">';
		$output .= pretty_date($date);
		$output .= '</div>';

		return $output;
  }

  elseif ($node->type == 'event') {
		$test_date1 = $dates['value']['formatted'];
		$test_date2 = $dates['value2']['formatted'];

		$date1 = $dates['value']['object']->local->parts;
		$date2 = $dates['value2']['object']->local->parts;

		$output = '<div class="date-display-pretty">';
		$output .= '<div class="start">';
		$output .= pretty_date($date1);
		$output .= pretty_time($date1);
		$output .= '</div>';
		if (!empty($test_date2) && $test_date1 != $test_date2) {
			$output .= '<div class="tween"> to </div>';
			$output .= '<div class="end">';
			if ($date2['year'] != $date1['year'] || $date2['month'] != $date1['month'] || $date2['day'] != $date2['day']) {
				$output .= pretty_date($date2);
			}
			$output .= pretty_time($date2);
			$output .= '</div>';
			$output .= '</div>';
		}

		return $output;
  }

  else {
		$date1 = $dates['value']['formatted'];
		$date2 = $dates['value2']['formatted'];
		if ($date1 == $date2 || empty($date2)) {
			return '<span class="date-display-single">'. $date1 .'</span>';
		}
		else {
			return '<span class="date-display-start">'. $date1 .'</span><span class="date-display-separator"> - </span><span class="date-display-end">'. $date2 .'</span>';
		}
	}
}

function newhope2_3_audiofield($file, $item, $field) {
  $file = (array)$file;
  if (is_file($file['filepath'])) {
		drupal_add_js(path_to_theme() . '/js/ufo.js', 'theme');

    if ($file['fid'] == 'upload') {
      $path = file_create_filename($file['filename'], file_create_path());
    } else {
      $path = $file['filepath'];
    }
    $name = $file['filename'];
    $desc = $file['description'];

		// $output = '<p id="audio_'.$file['fid'].'"><a href="http://www.macromedia.com/go/getflashplayer">Get the Flash Player</a> to see this player.</p>';
	 
    $item['sample_rate'] = format_samplerate($item['sample_rate']);
    $item['bitrate'] = format_bitrate($item['bitrate']);
    $item['filesize'] = format_filesize($item['filesize']);
		$url  = file_create_url($path);
    $link = l($name, $url);

		// $inline_js = '$(document).ready(function(){';
		// $inline_js .= 'var FO = { movie:"https://media.dreamhost.com/mediaplayer.swf",width:"320",height:"20",majorversion:"7",build:"0",bgcolor:"#FFFFFF",flashvars:"file='.$url.'&amp;showdigits=true&amp;autostart=false" };';
		// $inline_js .= 'UFO.create(FO,"audio_'.$file['fid'].'");';
		// $inline_js .= '});';
		// drupal_add_js($inline_js, 'inline');

    $output .= sprintf("<style>.content div.field-field-audio div.field-items { height:auto; min-height: 3.5em; }</style><audio preload='auto' controls><source src='%s' type='audio/mpeg; codecs=\"mp3\"'></source></audio><p id='playLink'><a href='%s'>Click Here to Play</a></p>", $url, $url);
    $output .= sprintf("<p class='audio-download'><a href='%s'>Right-click Here to Download</a></p>", $url);

    return $output;

    // $output .= sprintf("<p class='audio-download'> %s %s min (%s) </p>", $link, $item['playtime'], $item['filesize']);

    // return $output;
  }
}

drupal_add_js("misc/jquery.js");

function phptemplate_field(&$node, &$field, &$items, $teaser, $page) {
  $field_empty = TRUE;
  foreach ($items as $delta => $item) {
    if (!empty($item['view']) || $item['view'] === "0") {
      $field_empty = FALSE;
      break;
    }
  }

  $variables = array(
    'node' => $node,
    'field' => $field,
    'field_type' => $field['type'],
    'field_name' => $field['field_name'],
    'field_type_css' => strtr($field['type'], '_', '-'),
    'field_name_css' => strtr($field['field_name'], '_', '-'),
    'label' => t($field['widget']['label']),
    'label_display' => isset($field['display_settings']['label']['format']) ? $field['display_settings']['label']['format'] : 'above',
    'field_empty' => $field_empty,
    'items' => $items,
    'teaser' => $teaser,
    'page' => $page,
  );

  return _phptemplate_callback('field', $variables, array('field-'. $field['field_name']));
}

?>
