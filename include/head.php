<!DOCTYPE html>
<html lang="<?= LANG ?>">
<head>
  <title><?php global $PAGES; TR($PAGES[CurrentPage()]['title']); ?></title>
  <base href="<?= BaseURL() ?>">
  <?php require_once("meta.php"); ?>

  <link rel="icon" type="image/x-icon" href="<?= URL('favicon.ico') ?>?">
  <link rel="stylesheet" type="text/css" href="<?= URL('css/style.css') ?>">

  <!-- TODO: Generate hreflang links for every language.
    <link href="" rel="alternate" hreflang="">
  -->
  <?php
    foreach ($HEAD_TAGS as $tag) echo "$tag\n";
  ?>
</head>
