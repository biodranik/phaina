<?php if(array_key_exists('childPages', $PAGES['technology/index.php'])) : ?>
<ul>
  <?php foreach ($PAGES['technology/index.php']['childPages'] as $h2_page => $h2_props) : ?>
  <li><?= T($h2_props['title']) ?>
    <?php if(array_key_exists('childPages', $h2_props)) : ?>
    <ul>
      <?php foreach ($h2_props['childPages'] as $h3_page => $h3_props) : ?>
        <li><?= T($h3_props['title']) ?></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
