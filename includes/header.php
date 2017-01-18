<?php
  $menuItems = array(
    MenuLink("technology") => Translate("menuTechnologyPage"),
    MenuLink("team") => Translate("menuTeamPage"),
    MenuLink("contact") => Translate("menuContactPage")
  );
?>

<ul>
  <?php foreach ($menuItems as $pageUrl => $pageTitle): ?>
  <li <?= PageURI() == $pageUrl ? 'class="active"' : '' ?>>
    <a href="<?=$pageUrl?>"><?=$pageTitle?></a>
  </li>
  <?php endforeach; ?>
</ul>

<header class="header">
  <a href="" class="logo"></a>
  <nav class="nav">
    <ul>
    <li class="nav__hamburger">Menu</li>
    <!-- Home menu item -->
    <a class="nav__item{{ if .IsHome }} nav__item--active{{ end }}" href="" title="{{ T "homePageTitle" }}">{{ T "homeMenu" }}</a>
    <!-- All other menu items -->
    {{- $currentNode := . -}}
    {{- range .Site.Menus.main -}}
    <a class="nav__item{{ if $currentNode.IsMenuCurrent "main" . }} nav__item--active{{ end }}" href="{{ .URL }}" title="{{ T .Name }}">{{ T .Name }}</a>
    {{ end }}
    </ul>
  </nav>
</header>
