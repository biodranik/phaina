<header class="header">
  <a href="" class="logo"></a>
  <nav class="nav">
    <ul>
<?php foreach (MainMenu() as $url => $title): ?>
      <li><!-- TODO: Support active menu item. -->
        <a href="<?= $url ?>"><?= $title ?></a>
      </li>
<?php endforeach; ?>
    </ul>
  </nav>
</header>
