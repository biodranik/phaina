<?php
// TODO: Think about beautiful global object/class instead of $GLOBALS[].

function PageFile() {
  return FILE;
}

function ExtractLinkFromPage($pageFile) {
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
  if (defined('FILE'))
    return basename(FILE, '.php');  // TODO: Will not work for subdirectories.
  die("Please set page's LINK.\n");
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
