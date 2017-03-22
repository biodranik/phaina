<?php
// Correctly routes to specific page if php is invoked via CGI interface.
// Should be included from index.php.

// Returns and continues with index.php if invoked from command line.
if (!array_key_exists('REQUEST_URI', $_SERVER) or empty($_SERVER['REQUEST_URI']) or
  $_SERVER['REQUEST_URI'] == '/') return;

function FileByRequestUri() {
  global $PAGES;
  // urldecode helps to support localized URLs.
  $urlPath = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

  if (strpos($urlPath, '.php') !== false){
    return $urlPath;
  }

  $filter = ['pageLink'=> $urlPath];
  $currentPage = FindPageObjectByFilter($filter);

  if (isset($currentPage)) {
    $path = GetPath(key($currentPage));
    return $path;
  }

  // TODO: Treat page without a link as 404 or is it better to hard-code it?
  return '/404.php';
}

function GetPath($page) {
  if (strpos($page, '/') === 0) {
    return $page;
  }
  else {
    return '/'.$page;
  }
}

require_once(dirname(__FILE__).'/../www'.FileByRequestUri());
// It's important to avoid rendering index.php at the end.
