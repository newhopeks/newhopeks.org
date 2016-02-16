<?php if ($teaser || $view_mode == 'teaser_featured') : ?>
	<article class="article-listing__item<?php if ($view_mode == 'teaser_featured') : ?> article-listing__item--featured<?php endif; ?>">
		<header>
			<?php
				if ($content['field_image']) {
					print render($content['field_image']);
				}
			?>
			<div class="field field-name-title">
				<h2 class="article-listing__item__title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
			</div>
			<?php if ($field_subtitle) : ?>
				<p class="article-listing__item__subtitle"><?php print $field_subtitle; ?></p>
			<?php endif; ?>
		</header>

		<div class="article-listing__item__body">
			<?php
				hide($content['field_image']);
				hide($content['comments']);
				hide($content['links']);
				print render($content);
			?>
		</div>

		<div class="field field-name-node-link">
			<p class="article-listing__item__more"><a href="<?php print $node_url; ?>">Read more »</a></p>
		</div>
	</article> <!-- end .article-listing__item -->
<?php else : ?>
	<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

	  <?php print $user_picture; ?>

	  <?php print render($title_prefix); ?>
	  <?php if (!$page): ?>
	    <h2<?php print $title_attributes; ?>><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h2>
	  <?php endif; ?>
	  <?php print render($title_suffix); ?>

	  <?php if ($display_submitted): ?>
	    <div class="submitted">
	      <?php print $submitted; ?>
	    </div>
	  <?php endif; ?>

	  <div class="content"<?php print $content_attributes; ?>>
	    <?php
	      // We hide the comments and links now so that we can render them later.
	      hide($content['comments']);
	      hide($content['links']);
	      print render($content);
	    ?>
	  </div>

	  <?php print render($content['links']); ?>

	  <?php print render($content['comments']); ?>

	</div>
<?php endif; ?>
