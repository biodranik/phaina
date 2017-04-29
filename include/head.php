<!DOCTYPE html>
<html lang="<?= LANG ?>">
<head>
  <title><?= PageTitle() ?></title>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
  <meta name="copyright" content="<?= T('copyright') ?>">
  <meta name="description" content="<?= PageDescription() ?>">
  <meta name="keywords" content="<?= PageKeywords() ?>">

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

  <?php foreach (PageCSS() as $url) : ?>
  <link rel="stylesheet" type="text/css" href="<?= $url ?>">
  <?php endforeach; ?>

  <!-- TODO: Move JS scripts to the footer. -->
  <?php foreach (PageJS() as $url) : ?>
  <script defer type="text/javascript" src="<?= $url ?>">
  <?php endforeach; ?>
</head>
