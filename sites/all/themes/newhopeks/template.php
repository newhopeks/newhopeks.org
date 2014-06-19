<?php

function newhopeks_html_head_alter(&$head_elements) {

	/* Remove content-type meta tag. The HTML5 version will be added in the theme. */
	unset($head_elements['system_meta_content_type']);

	/* Remove the generator meta tag */
	unset($head_elements['system_meta_generator']);

	/* Remove Drupal-generated RSS feed */
	foreach ($head_elements as $key => $element) {
		if (isset($element['#attributes']['type']) && $element['#attributes']['type'] == 'application/rss+xml') {
			unset($head_elements[$key]);
		}
	}

}



/**
 * template_preprocess_page
 * Preprocess variables for page.tpl.php
 *
 * http://api.drupal.org/api/drupal/includes--theme.inc/function/template_preprocess_page
 * http://louis-sawtell.com/content/drupal-preprocesspage-define-custom-template-variables
 * http://drupal.org/node/784996
 */

function newhopeks_preprocess_page(&$variables) {

	/* Get variables for use in page.tpl.php */

	$variables['site_name'] = filter_xss_admin(variable_get('site_name', 'New Hope Church'));
	$variables['main_menu'] = menu_main_menu();
	$variables['secondary_menu'] = menu_navigation_links('menu-secondary-menu');

}



function newhopeks_process_html(&$vars) {

	/* Minify HTML output. */

	$minify_html = FALSE;

	if ($minify_html) {

		$before = array(
			"/>\s\s+/",
			"/\s\s+</",
			"/>\t+</",
			"/\s\s+(?=\w)/",
			"/(?<=\w)\s\s+/"
		);

		$after = array('> ', ' <', '> <', ' ', ' ');

		// Page top.
		$page_top = $vars['page_top'];
		$page_top = preg_replace($before, $after, $page_top);
		$vars['page_top'] = $page_top;

		// Page content.
		if (!preg_match('/<pre|<textarea/', $vars['page'])) {
			$page = $vars['page'];
			$page = preg_replace($before, $after, $page);
			$vars['page'] = $page;
		}

		// Page bottom.
		$page_bottom = $vars['page_bottom'];
		$page_bottom = preg_replace($before, $after, $page_bottom);
		$vars['page_bottom'] = $page_bottom . drupal_get_js('footer');

	}

}



function newhopeks_process_html_tag(&$vars) {

	/* Purge needless XHTML stuff. */

	$el = &$vars['element'];

	// Remove type="..." and CDATA prefix/suffix.
	unset($el['#attributes']['type'], $el['#value_prefix'], $el['#value_suffix']);

	// Remove media="all" but leave others unaffected.
	if (isset($el['#attributes']['media']) && $el['#attributes']['media'] === 'all') {
		unset($el['#attributes']['media']);
	}

}



/**
 * theme_menu_local_tasks
 * Returns HTML for primary and secondary local tasks.
 *
 * http://api.drupal.org/api/drupal/includes%21menu.inc/function/theme_menu_local_tasks/7
 */

function newhopeks_menu_local_tasks(&$variables) {

	$output = '';

	if (!empty($variables['primary'])) {
		$variables['primary']['#prefix'] = '<h2 class="element-invisible">' . t('Primary tabs') . '</h2>';
		$variables['primary']['#prefix'] .= '<ul class="tabs primary">';
		$variables['primary']['#suffix'] = '</ul>';
		$output .= drupal_render($variables['primary']);
	}
	if (!empty($variables['secondary'])) {
		$variables['secondary']['#prefix'] = '<h2 class="element-invisible">' . t('Secondary tabs') . '</h2>';
		$variables['secondary']['#prefix'] .= '<ul class="tabs secondary">';
		$variables['secondary']['#suffix'] = '</ul>';
		$output .= drupal_render($variables['secondary']);
	}

	return $output;

}



/**
 * Get the current section of the site
 *
 * Taken from SonSpring, "HTML5 in Drupal 7"
 *   http://sonspring.com/journal/html5-in-drupal-7
 */

function get_section() {

	$section_path = explode('/', request_uri());
	$section_name = $section_path[1];
	$section_q = strpos($section_name, '?');

	if ($section_q) {
		$section_name = substr($section_name, 0, $section_q);
	}

	switch ($section_name) {
		case '':
			return 'section-home';
			break;
		case 'about':
			return 'section-about';
			break;
		case 'contact':
			return 'section-contact';
			break;
		case 'search':
			return 'section-search';
			break;
		case 'user':
			return 'section-user';
			break;
		case 'users':
			return 'section-user';
			break;
		case 'filter':
			return 'section-filter';
			break;
		case 'admin':
			return 'section-admin';
			break;
		default:
			return 'section-default';
	}

}
