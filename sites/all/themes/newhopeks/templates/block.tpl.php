<div class="<?php print $classes; ?>">
  <section>
    <?php print render($title_prefix); ?>

    <?php if ($block->subject) : ?>
      <h2 class="block-title"><?php print $block->subject ?></h2>
    <?php endif;?>

    <?php print render($title_suffix); ?>

    <?php print $content; ?>
  </section>
</div> <!-- end .block -->
