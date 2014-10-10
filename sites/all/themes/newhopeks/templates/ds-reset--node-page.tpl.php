<?php

/**
 * @file
 * Display Suite reset template.
 */
?>



<?php
newhopeks_get_page_children($node->nid);



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
?>



<?php print $ds_content; ?>
<?php if (!empty($drupal_render_children)): ?>
  <?php print $drupal_render_children ?>
<?php endif; ?>
