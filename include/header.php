<header class="header">
  <a href="<?= BaseURL() ?>" class="logo"></a>
  <nav class="nav">
    <ul class="menu">
      <?php foreach (MainMenu() as $m) : ?>
        <li class="menu__item">
          <a class="menu__link <?php if ($m->isCurrent == true) echo 'menu__link--selected'?>" href="<?= $m->url ?>"><?= $m->title ?></a>
        </li>
        <?php endforeach; ?>
        <li class="menu__item menu__item--login">
          <a class="menu__link menu__link--login" href="#">
            <i class="fa fa-sign-in"></i> 
            <?php T("menuLogin"); ?>
          </a>
        </li>
    </ul>
  </nav>
</header>

 