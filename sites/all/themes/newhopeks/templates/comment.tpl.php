<div class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>

	<p class="comment-author"><?php print $author; ?> says:</p>
	
	<div class="comment-content"<?php print $content_attributes; ?>>
		<?php
			hide($content['links']);
			print render($content);
		?>
	</div>
	
	<p class="comment-date">Posted on <?php print date('M j, Y \a\t g:i A T', $node->created); ?></p>
	
	<p class="comment-permalink"><?php print $permalink; ?></p>
	
	<?php print render($content['links']); ?>

</div>
