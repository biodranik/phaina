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

function URL($link) {
  return BaseURL() . $link;
}

// Without parameters returns current page name (e.g. 'page.php').
// If $property is not empty, returns given property of the page or empty string if it does not exist.
// See $PAGES in config.php for more details.
function CurrentPage($property = '') {
  global $PAGES;
  $INDEX_PAGE = 'index.php';
  $includes = get_included_files();
  $isIndexPage = false;
  foreach ($includes as $path) {
    $path = basename($path);
    foreach ($PAGES as $page => $properties) {
      if ($page == $path) {
        // Special case: index page can route to other pages (or can not).
        if ($page == $INDEX_PAGE) {
          $isIndexPage = true;
          break;
        } else {
          if (empty($property)) return $page;
          else return array_key_exists($property, $PAGES[$page]) ? $PAGES[$page][$property] : '';
        }
      }
    }
  }
  if ($isIndexPage) {
    if (empty($property)) return $INDEX_PAGE;
    else return array_key_exists($property, $PAGES[$INDEX_PAGE]) ? $PAGES[$INDEX_PAGE][$property] : '';
  }
  exit('ERROR: Please add your page to $PAGES in config.php.');
}

function PageDescription() {
  $description = CurrentPage('description');
  return empty($description) ? DEFAULT_META_DESCRIPTION : $description;
}

function PageKeywords() {
  $keywords = CurrentPage('keywords');
  return empty($keywords) ? DEFAULT_META_KEYWORDS : $keywords;
}

require_once('translations.php');

// Page title for <title> tag is taken from $PAGES in config.php.
// Some pages need custom <head> block tags, here is the solution:
// $HEAD_TAGS can optionally contain anly valid HTML tag like <link …> or <meta …>,
function HTML_HEAD($HEAD_TAGS = []) {
  return require_once('head.php');
}

function HTML_HEADER() {
  return require_once('header.php');
}

function HTML_FOOTER() {
  return require_once('footer.php');
}

function MainMenu() {
  global $PAGES;
  // TODO: support empty menu?
  $currentPage = CurrentPage();
  foreach ($PAGES as $page => $props) {
    if (array_key_exists('menu', $props)) {
      $menu[] = new MenuItem(URL($props['link']), T($props['menu']), $currentPage == $page);
    }
  }
  return $menu;
}

?>