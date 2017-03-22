<?php if(array_key_exists('childPages', $PAGES['technology/index.php'])) : ?>
<ul class="tech-menu tech-menu--top">
  <?php foreach ($PAGES['technology/index.php']['childPages'] as $h2_page => $h2_props) : ?>
  <li><a href="<?= URL($h2_props['link']) ?>"><?= T($h2_props['title']) ?></a>
    <?php if(array_key_exists('childPages', $h2_props)) : ?>
    <ul class="tech-menu tech-menu--inner">
      <?php foreach ($h2_props['childPages'] as $h3_page => $h3_props) : ?>
        <li><a href="<?= URL($h3_props['link']) ?>"> <?= T($h3_props['title']) ?></a></li>
      <?php endforeach; ?>
    </ul>
    <?php endif; ?>
  </li>
  <?php endforeach; ?>
</ul>
<?php endif; ?>
