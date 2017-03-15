<?php
function TitleOrFileName($params) {
  if (array_key_exists('title', $params)) return T($params['title']);
  return T(basename(__FILE__, '.php'));
}
function MetaDescription($params) {
  if (array_key_exists('description', $params)) return T($params['description']);
  return T(DEFAULT_META_DESCRIPTION);
}
function MetaKeywords($params) {
  if (array_key_exists('keywords', $params)) return T($params['keywords']);
  return T(DEFAULT_META_KEYWORDS);
}
// TODO(AlexZ): More clean implementation for two similar functions below.
function HeadCSS($params) {
  $css = '';
  if (array_key_exists('css', $params)) {
    if (is_array($params['css'])) {
      foreach($params['css'] as $url) {
        $css = $css . "<link rel=\"stylesheet\" type=\"text/css\" href=\"$url\">\n";
      }
    } else $css = "<link rel=\"stylesheet\" type=\"text/css\" href=\"$params[css]\">\n";
  }
  return $css;
}
function HeadJS($params) {
  $js = '';
  if (array_key_exists('js', $params)) {
    if (is_array($params['js'])) {
      foreach($params['js'] as $url) {
        $js = $js . "<script type=\"text/javascript\" src=\"$url\">\n";
      }
    } else $js = "<script type=\"text/javascript\" src=\"$params[js]\" />\n";
  }
  return $js;
}
?>
<!DOCTYPE html>
<html lang="<?= LANG ?>">
<head>
  <title><?= TitleOrFileName($PARAMS) ?></title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <meta name="copyright" content="<?= T('copyright') ?>">
  <meta name="description" content="<?= MetaDescription($PARAMS) ?>">
  <meta name="keywords" content="<?= MetaKeywords($PARAMS) ?>">

  <link rel="icon" type="image/x-icon" href="<?= URL('favicon.ico') ?>?">
  <link rel="stylesheet" type="text/css" href="<?= URL('css/style.css') ?>">
  <!-- TODO: Generate hreflang links for every language. -->
  <?php /* $langSites = [
      'https://www.vibrobox.com/' => ['x-default', 'en'],
      'https://www.vibrobox.ru/' => ['ru', 'uk', 'kk'],
      'https://www.vibrobox.by/' => ['be'],
    ];
  ?>
  <?php foreach ($langSites as $url => $langs) : foreach ($langs as $lang) : ?>
  <link href="<?= $url ?>" hreflang="<?= $lang ?>" rel="alternate">
  <?php endforeach; endforeach; */?>

  <?= HeadCSS($PARAMS); HeadJS($PARAMS); ?>
</head>

