<?php

/**
 * @file
 * Display Suite reset template.
 */
?>
<div class="article-listing__item">
  <?php print $ds_content; ?>
  <?php if (!empty($drupal_render_children)): ?>
    <?php print $drupal_render_children ?>
  <?php endif; ?>
</div> <!-- end .article-listing__item -->
