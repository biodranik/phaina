<header class="header">
  <div class="header__cont">
    <a href="<?= BaseURL() ?>" class="logo"></a>
    <ul class="menu">
      <?php foreach (MainMenu() as $m) : ?>
        <li class="menu__item">
          <a class="menu__link<?php if ($m->isCurrent) echo ' menu__link--selected'?>" href="<?= $m->url ?>"><?= $m->title ?></a>
        </li>
      <?php endforeach; ?>
      <li class="menu__item menu__item--login">
        <a class="menu__link menu__link--login" href="https://www.dev.vibrobox.com/site/login"><?= T("loginButton") ?></a>
      </li>
    </ul>

    <a href="#" class="nav-bar-btn navBarBtn"><!-- --></a>

  </div>
</header>