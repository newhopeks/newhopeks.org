<div class="field-file-upload">
  <h2 class="label-above field-file-upload__title">Downloads</h2>

  <ul class="field-file-upload__list">
    <?php foreach ($items as $delta => $item): ?>
      <li class="field-file-upload__list__item"><?php print render($item); ?></li>
    <?php endforeach; ?>
  </ul>
</div>
