<?php
function PageFile() {
  if (!defined('FILE'))
    die("Please add `define('FILE', __FILE__);` in your rendered page.\n");
  // TODO: Add support for php files in subdirectories.
  return basename(FILE);
}

function ExtractLinkFromPage($pageFile) {
  if ($pageFile == 'index.php')
    return '';  // Empty link means a root index page.
  // Retrieve link directly from specified php file.
  $regex = '|[^/][^/] *define *\([\'"]LINK[\'"] *, *[\'"](.*)[\'"]\)|U';
  $content = file_get_contents(dirname(__FILE__).'/../www/'.$pageFile);
  if (preg_match($regex, $content, $match))
    return $match[1];
  // Use page file without extension as a link.
  if (EndsWith($pageFile, '.php'))
    return substr($pageFile, 0, -4);

  return $pageFile;
}

// TODO: Support localized links.
function PageLink() {
  if (defined('LINK'))
    return LINK;
  // TODO: Create correct IRI from file name.
  $file = PageFile();
  if ($file == 'index.php')
    return '';  // Empty link means a root index page.

  // Use file name without extension as a link.
  // TODO: Filter out IRI-incompatible symbols out of the file name and beautify IRI.
  return substr($file, 0, strrpos($file, '.'));
}

function PageTitle() {
  if (defined('TITLE'))
    return T(TITLE);
  // TODO: Better default title naming strategy (my-cool_title.php => My Cool Title).
  if (defined('FILE'))
    return T(basename(FILE));

  die("Please set page's TITLE.\n");
}

function PageDescription() {
  if (defined('DESCRIPTION'))
    return T(DESCRIPTION);

  return T(DEFAULT_META_DESCRIPTION);
}

function PageKeywords() {
  if (defined('KEYWORDS'))
    return T(KEYWORDS);

  return T(DEFAULT_META_KEYWORDS);
}

// Returns an array of links to page's CSS files.
function PageCSS() {
  if (!defined('CSS'))
    return [];

  if (is_array(CSS))
    return CSS;
  return [CSS];
}

// Returns an array of links to page's JavaScript files.
function PageJS() {
  if (!defined('JS'))
    return [];

  if (is_array(JS))
    return JS;
  return [JS];
}

?>
