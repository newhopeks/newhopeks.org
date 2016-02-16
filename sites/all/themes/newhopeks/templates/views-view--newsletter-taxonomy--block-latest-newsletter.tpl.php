<?php if ($rows && is_numeric($rows)) : ?>
	<?php
		$tid = $rows;

		// Latest newsletter title
		$term = taxonomy_term_load($tid);
		$term_link = url(taxonomy_term_uri($term)['path']);
		$term_date = date_format(date_create($term->field_newsletter_date['und'][0]['value']), 'F Y');
		print '<h1><a href="' . $term_link . '">Issue ' . $term->name . ', ' . $term_date . '</a></h1>';
	?>

	<div class="article-listing article-listing--newsletter--home">
		<?php
			$term_nodes = taxonomy_select_nodes($tid);
			$count = 1;
			foreach ($term_nodes as $nid) {
				if ($count == 1) {
					$view_mode = 'teaser_featured';
				} else {
					$view_mode = 'teaser';
				}
				$node = node_load($nid);
				print(drupal_render(node_view($node, $view_mode)));
				$count++;
			}
		?>
	</div> <!-- end .article-listing -->
<?php endif; ?>
