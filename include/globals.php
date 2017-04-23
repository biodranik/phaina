<?php

// Returns true if site is running on localhost.
function IsLocalhostDevelopmentMode() {
  return array_key_exists('REMOTE_ADDR', $_SERVER) and ($_SERVER['REMOTE_ADDR'] == '127.0.0.1'
      or $_SERVER['REMOTE_ADDR'] == '::1');
}

function BaseURL() {
  // Replace BaseURL when developing on localhost.
  if (IsLocalhostDevelopmentMode()) {
    $scheme = (isset($_SERVER['HTTPS']) and !empty($_SERVER['HTTPS'])) ? 'https' : 'http';
    return "${scheme}://${_SERVER['HTTP_HOST']}/";
  }
  return BASE_URL;
}

// $link can be any absolute link without leading slash or .php page name from $PAGES.
function URL($link) {
  global $PAGES;
  if (strlen($link) > 4 and substr_compare($link, '.php', -4) == 0) $link = $PAGES[$link]['link'];
  return BaseURL() . $link;
}

require_once('translations.php');

function HTML_HEAD($PARAMS = []) {
  require_once('head.php');
}

function HTML_HEADER($currentPageFileName = null) {
  require_once('header.php');
}

function HTML_FOOTER($currentPageFileName = null) {
  require_once('footer.php');
}

function MainMenu($currentPageFileName = null) {
  global $PAGES;
  // TODO: support empty menu?
  foreach ($PAGES as $page => $props) {
    if (array_key_exists('menu', $props)) {
      $menu[] = new MenuItem(URL($props['link']), T($props['menu']), $currentPageFileName === $page);
    }
  }

  return $menu;
}

function BuildSiteMapXml() {
  global $PAGES;
  $siteMap = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

  foreach($PAGES as $page => $props) {
    // Ignoring 404.php page or other pages without link property.
    if (array_key_exists('link', $props)) {
      $siteMap = $siteMap.'<url><loc>'.URL($props['link']).'</loc></url>';
    }
  }

  $siteMap = $siteMap.'</urlset>';

  return $siteMap;
}

// TODO: Move base content folder path to web-site settings file.
// Main purpose of this function is to include specific content to the page.
// Function uses current language and pick necessary content using knowledge about it.
// Function expects that there is folder with translations in content folder.
// Function takes $baseName parameter, used for determining, what content package should be loaded.
function IncludeContent($baseName) {
  $basePath = dirname(__FILE__).'/../content/' . $baseName;

  // Array of possible content paths.
  // Should be ordered in the way, that path for translation appears first.
  $pathsToCheck = [
    $basePath . '.' . LANG . '.html',  // content/baseName.ru.html
    $basePath . '.' . LANG . '.php',  // content/baseName.ru.php
    $basePath . '/index.' . LANG . '.html',  // content/baseName/index.ru.html
    $basePath . '/index.' . LANG . '.php',  // content/baseName/index.ru.php
    $basePath . '.html',  // content/baseName.html
    $basePath . '.php',  // content/baseName.php
    $basePath . '/index.html',  // content/baseName/index.html
    $basePath . '/index.php',  // content/baseName/index.php
  ];

  foreach ($pathsToCheck as $file) {
    if (file_exists($file)) {
      include($file);
      return;
    }
  }

  die("Error loading content with name: $baseName");
}
?>
