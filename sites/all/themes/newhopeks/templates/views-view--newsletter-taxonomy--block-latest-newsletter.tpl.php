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
			// Output newsletter article teasers
			$term_nodes = taxonomy_select_nodes($tid);

			// Initialize the count
			$count = 1;
		?>

		<?php foreach ($term_nodes as $nid) : ?>

			<?php
				// Set up variables
				$node = node_load($nid);
				if ($count == 0) {
					$featured = TRUE;
				} else {
					$featured = FALSE;
				}
				if ($featured) {
					if ($node->field_image) {
						$image_field = field_get_items('node', $node, 'field_image');
						$image = field_view_value('node', $node, 'field_image', $image[0], array(
							'type' => 'image',
							'settings' => array(
								'image_style' => 'thumbnail',
								'image_link' => 'nothing',
							),
						));
					}
				}
				$title = check_plain($node->title);
				$path = drupal_get_path_alias('node/' . $nid);
				if ($node->field_subtitle) {
					$subtitle_field = array_shift(field_get_items('node', $node, 'field_subtitle'));
					$subtitle = $subtitle_field['value'];
				} else {
					$subtitle = '';
				}
				if ($node->field_newsletter_author_info) {
			        $field_newsletter_author_output = array();
			        foreach ($node->field_newsletter_author_info['und'] as $id) {
				        $collection = entity_metadata_wrapper('field_collection_item', $id['value']);
				        $field_newsletter_author = $collection->field_newsletter_author->value();
				        $field_newsletter_author_url = url(taxonomy_term_uri($field_newsletter_author)['path']);
				        $field_newsletter_author_name = $field_newsletter_author->name;
				        $field_newsletter_author_output[] = '<a href="' . $field_newsletter_author_url . '">' . $field_newsletter_author_name . '</a>';
			        }
			        $author = join(' and ', array_filter(array_merge(array(join(', ', array_slice($field_newsletter_author_output, 0, -1))), array_slice($field_newsletter_author_output, -1)), 'strlen'));
				} else {
					$author = '';
				}
				$body = field_view_field('node', $node, 'body', 'teaser');
			?>

			<article class="article-listing__item<?php if ($featured) : ?> article-listing__item--featured<?php endif; ?>">
				<?php if ($featured && $image) : ?>
					<div class="article-listing__item__img">
						<?php print render($image); ?>
					</div>
				<?php endif; ?>
				<header>
					<h2 class="article-listing__item__title"><a href="<?php print $path; ?>"><?php print $title; ?></a></h2>
					<?php if ($subtitle) : ?><p class="article-listing__item__subtitle"><?php print $subtitle; ?></p><?php endif; ?>
					<?php if ($author) : ?><p class="article-listing__item__author">By <?php print $author; ?></p><?php endif; ?>
				</header>
				<div class="article-listing__item__body">
					<?php print render($body); ?>
				</div>
			</article> <!-- end .article-listing__item -->

			<?php ++$count; ?>

		<?php endforeach; ?>
	</div> <!-- end .article-listing -->

<?php endif; ?>
