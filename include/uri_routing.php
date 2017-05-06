<?php
// Correctly routes to specific page if php is invoked via CGI interface.
// Should be included from index.php.
// TODO: Support plain .html pages, not only .php files.

// Returns and continues with index.php if invoked from command line.
if (!array_key_exists('REQUEST_URI', $_SERVER) or empty($_SERVER['REQUEST_URI']) or
  $_SERVER['REQUEST_URI'] == '/') return;

function FileByRequestUri() {
  global $PAGES;
  // urldecode helps to support localized URLs.
  $urlPath = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
  // TODO: Support custom links to pages.
  $file = substr($urlPath, 1);

  if (EndsWith($file, '/'))
    $file .= 'index.php';
  else if (!EndsWith($file, '.php'))
    $file .= '.php';

  // TODO: Check if Windows works correctly for subdirectories and paths with `/` slashes.
  if (file_exists(dirname(__FILE__).'/../www/'.$file))
    return $file;
  return '404.php';
}

require_once(FileByRequestUri());
// It's important to avoid rendering index.php at the end.
exit;
