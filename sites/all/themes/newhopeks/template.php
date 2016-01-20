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

	//$search_form = drupal_get_form('search_form');
	//$search_form['#attributes']['role'][] = 'form';
	$variables['search_form'] = drupal_render(drupal_get_form('search_form'));



    // check to make sure this is a node
    if (isset($variables['node'])) {
        $node = $variables['node'];

        // created date
        $variables['date'] = format_date($node->created);

        // subtitle field
        $field_subtitle = field_get_items('node', $node, 'field_subtitle');
        if ($field_subtitle) { $variables['field_subtitle'] = $field_subtitle[0]['value']; }

	    // newsletter fields
	    if ($node->type == 'newsletter') {
	        // author
	        if (!empty($node->field_newsletter_author_info)) {
		        $field_newsletter_author_output = array();
		        foreach ($node->field_newsletter_author_info['und'] as $id) {
			        $collection = entity_metadata_wrapper('field_collection_item', $id['value']);
			        $field_newsletter_author = $collection->field_newsletter_author->value();
			        $field_newsletter_author_url = url(taxonomy_term_uri($field_newsletter_author)['path']);
			        $field_newsletter_author_name = $field_newsletter_author->name;
			        $field_newsletter_author_output[] = '<a href="' . $field_newsletter_author_url . '">' . $field_newsletter_author_name . '</a>';
		        }
		        $variables['field_newsletter_author'] = join(' and ', array_filter(array_merge(array(join(', ', array_slice($field_newsletter_author_output, 0, -1))), array_slice($field_newsletter_author_output, -1)), 'strlen'));
		    }

		    // edition and date
			if (!empty($node->field_newsletter_edition)) {
				$edition = taxonomy_term_load($node->field_newsletter_edition['und'][0]['tid']);
				$edition_name = $edition->name;
				$edition_date = $edition->field_newsletter_date['und'][0]['value'];

				if (is_numeric($edition_name)) {
					switch ((int) $edition_name) {
						case 1:
							$edition_name_suffix = 'st';
							break;
						case 2:
							$edition_name_suffix = 'nd';
							break;
						case 3:
							$edition_name_suffix = 'rd';
							break;
						default:
							$edition_name_suffix = 'th';
					}
					$edition_name .= $edition_name_suffix;
				}
				$variables['field_newsletter_edition'] = $edition_name . ' Edition';

				$variables['field_newsletter_date'] = date_format(date_create($edition_date), 'F j, Y');
			}
		}
    }



    $variables['hero'] = views_embed_view('hero', 'embed');

}



function newhopeks_breadcrumb(&$variables) {
    $breadcrumb = $variables['breadcrumb'];

    if (!empty($breadcrumb)) {
        $output = implode(' &raquo; ', $breadcrumb);
        return $output;
    }
}



function newhopeks_pager($variables) {
    $tags = $variables['tags'];
    $element = $variables['element'];
    $parameters = $variables['parameters'];
    $quantity = $variables['quantity'];
    global $pager_page_array, $pager_total;

    // Calculate various markers within this pager piece:
    // Middle is used to "center" pages around the current page.
    $pager_middle = ceil($quantity / 2);
    // current is the page we are currently paged to
    $pager_current = $pager_page_array[$element] + 1;
    // first is the first page listed by this pager piece (re quantity)
    $pager_first = $pager_current - $pager_middle + 1;
    // last is the last page listed by this pager piece (re quantity)
    $pager_last = $pager_current + $quantity - $pager_middle;
    // max is the maximum page number
    $pager_max = $pager_total[$element];
    // End of marker calculations.

    // Prepare for generation loop.
    $i = $pager_first;
    if ($pager_last > $pager_max) {
        // Adjust "center" if at end of query.
        $i = $i + ($pager_max - $pager_last);
        $pager_last = $pager_max;
    }
    if ($i <= 0) {
        // Adjust "center" if at start of query.
        $pager_last = $pager_last + (1 - $i);
        $i = 1;
    }
    // End of generation loop preparation.

    $li_first = theme('pager_first', array('text' => (isset($tags[0]) ? $tags[0] : t('« first')), 'element' => $element, 'parameters' => $parameters));
    $li_previous = theme('pager_previous', array('text' => (isset($tags[1]) ? $tags[1] : t('‹ previous')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
    $li_next = theme('pager_next', array('text' => (isset($tags[3]) ? $tags[3] : t('next ›')), 'element' => $element, 'interval' => 1, 'parameters' => $parameters));
    $li_last = theme('pager_last', array('text' => (isset($tags[4]) ? $tags[4] : t('last »')), 'element' => $element, 'parameters' => $parameters));

    if ($pager_total[$element] > 1) {
        if ($li_first) {
            $items[] = array(
                'class' => array('pager-first'),
                'data' => $li_first,
            );
        }
        if ($li_previous) {
            $items[] = array(
                'class' => array('pager-previous'),
                'data' => $li_previous,
            );
        }

        // When there is more than one page, create the pager list.
        if ($i != $pager_max) {
            if ($i > 1) {
            $items[] = array(
            'class' => array('pager-ellipsis'),
            'data' => '…',
            );
            }
            // Now generate the actual pager piece.
            for (; $i <= $pager_last && $i <= $pager_max; $i++) {
                if ($i < $pager_current) {
                    $items[] = array(
                        'class' => array('pager-item'),
                        'data' => theme('pager_previous', array('text' => $i, 'element' => $element, 'interval' => ($pager_current - $i), 'parameters' => $parameters)),
                    );
                }
                if ($i == $pager_current) {
                    $items[] = array(
                        'class' => array('pager-current'),
                        'data' => $i,
                    );
                }
                if ($i > $pager_current) {
                    $items[] = array(
                        'class' => array('pager-item'),
                        'data' => theme('pager_next', array('text' => $i, 'element' => $element, 'interval' => ($i - $pager_current), 'parameters' => $parameters)),
                    );
                }
            }
            if ($i < $pager_max) {
                $items[] = array(
                    'class' => array('pager-ellipsis'),
                    'data' => '…',
                );
            }
        }
        // End generation.
        if ($li_next) {
            $items[] = array(
                'class' => array('pager-next'),
                'data' => $li_next,
            );
        }
        if ($li_last) {
            $items[] = array(
                'class' => array('pager-last'),
                'data' => $li_last,
            );
        }
        return '<h2 class="element-invisible">' . t('Pages') . '</h2>' . theme('item_list', array(
            'items' => $items,
            'attributes' => array('class' => array('pager')),
        ));
    }
}



function newhopeks_get_page_children($nid) {



/*

$menu_active_trail = menu_get_active_trail();

$menu_name = $menu_active_trail[1]['menu_name'];

$menu_items = menu_tree_page_data($menu_name);

foreach($menu_items as $key => $m) {
   if ($m['link']['in_active_trail'] && $menu_items[$key]['below']) {
       $menu = render(menu_tree_output($menu_items[$key]['below']));
   }
}

if ($menu) {
    print $menu;
}
*/




    $parentPath = 'node/' . $nid;
    $parentID = db_query("SELECT mlid FROM {menu_links} WHERE link_path ='" . $parentPath . "'");

    foreach ($parentID as $pid) {
        $finalID = $pid->mlid;
    }

    $getChildren = db_query("SELECT link_path FROM {menu_links} WHERE plid='" . $finalID . "' ORDER BY weight");

    foreach ($getChildren as $child) {
        $nodeID = str_replace('node/', '', $child->link_path);
        $children[] = $nodeID;
    }

    if (isset($children)) {
        print '<ul class="media-list">';

        foreach($children as $nid){

            $node = node_load($nid);

            if ($node->status == 1) { //check node is published
                //print '<h1>' . $node->title . '</h1>';
                //print render(node_view($node, $view_mode = 'teaser'));
                print '<li class="media">';
                print '<div class="media-body">';
                print '<h2 class="media-heading"><a href="' . drupal_get_path_alias('node/' . $nid) . '">' . $node->title . '</a></h2>';
                print '</div>';
                print '</li>';
            }
        }

        print '</ul>';
    }
}



/**
 * hook_form_FORM_ID_alter
 *
 * Notes:
 * - Form API Reference (https://api.drupal.org/api/drupal/developer!topics!forms_api_reference.html/7)
 * - Altering Search Form - The Element Wrapper (https://www.drupal.org/node/2189521)
 */

function newhopeks_form_search_form_alter(&$form, &$form_state, $form_id) {

    $search_placeholder_text = t('Search');
    $search_btn_text = t('Go');

	// basic form attributes
	$form['#attributes'] = array(
		'class' => array(
			'search-form',
			'form-inline',
	    ),
	);

    // input attributes (text field and submit button)
    /*
    $form['basic']['#attributes'] = array(
        'class' => array(
	        'form-group',
        ),
    );
    */

    // text field
    $form['basic']['keys'] = array(
        //'#prefix' => '<div class="prefix-test">',
        //'#suffix' => '</div>',
        '#type' => 'textfield',
        '#title' => 'Search',
        '#theme' => 'textfield',
        '#attributes' => array(
            'placeholder' => $search_placeholder_text,
            'class' => array(
            	'form-control',
            ),
        ),
    );

    // submit button
    $form['basic']['submit'] = array(
        '#type' => 'submit',
        '#value' => $search_btn_text,
        '#attributes' => array(
            'class' => array(
                'btn',
                'btn-primary',
            ),
        ),
    );

    $form['basic']['keys']['#title_display'] = 'invisible';

}

function newhopeks_custom_search_form_wrapper($variables) {

    $element = $variables['element'];

    $output  = '<div class="test">';
    $output .= $element['#children'];
    $output .= '</div>';

    return $output;

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
