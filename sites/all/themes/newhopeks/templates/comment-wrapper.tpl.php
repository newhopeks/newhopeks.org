<div id="comments" class="<?php print $classes; ?>"<?php print $attributes; ?>>

	<?php if ($content['comments'] && $node->type != 'forum') : ?>
		<?php print render($title_prefix); ?>
		<h2 class="comment-wrapper-title"><?php print t('Comments'); ?></h2>
		<?php print render($title_suffix); ?>
	<?php endif; ?>
	
	<?php print render($content['comments']); ?>
	
	<?php if ($content['comment_form']) : ?>
		<h2 class="comment-form-title"><?php print t('Add new comment'); ?></h2>
		<?php print render($content['comment_form']); ?>
	<?php endif; ?>

</div>
