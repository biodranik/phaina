<header class="header">
  <a href="<?= BaseURL() ?>" class="logo"></a>

  <!-- Hidden checkbox is used for pure CSS toggle menu. -->
  <input type="checkbox" id="menu__trigger" class="menu__trigger" />
  <label for="menu__trigger"><?= T('Menu') ?></label>

  <ul class="menu">
    <?php foreach (MainMenu() as $m) : ?>
    <li class="menu__item">
      <a class="menu__link<?php if ($m->isCurrent) echo ' menu__link--selected'?>" href="<?= $m->url ?>"><?= $m->title ?></a>
    </li>
    <?php endforeach; ?>
    <li class="menu__item menu__item--login">
      <a class="menu__link menu__link--login" href="<?= DEMO_URL ?>"><?= T('loginButton') ?></a>
    </li>
  </ul>
</header>
