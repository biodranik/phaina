<?php

function BaseURL() {
  // Replace BaseURL when developing on localhost.
  if (array_key_exists('REMOTE_ADDR', $_SERVER) and ($_SERVER['REMOTE_ADDR'] == '127.0.0.1'
      or $_SERVER['REMOTE_ADDR'] == '::1')) {
    $scheme = (isset($_SERVER['HTTPS']) and !empty($_SERVER['HTTPS'])) ? 'https' : 'http';
    return "${scheme}://${_SERVER['HTTP_HOST']}/";
  }
  return BASE_URL;
}

function URL($link) {
  return BaseURL() . $link;
}

function CurrentPage() {
  global $PAGES;
  $includes = get_included_files();
  $isIndexPage = false;
  foreach ($includes as $path) {
    $path = basename($path);
    foreach ($PAGES as $page => $properties) {
      if ($page == $path) {
        // Special case: index page can route to other pages (or can not).
        if ($page == 'index.php') {
          $isIndexPage = true;
          break;
        } else {
          return $page;
        }
      }
    }
  }
  if ($isIndexPage) return 'index.php';
  exit('ERROR: Please add your page to $PAGES in config.php.');
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

function GetPlusSectionItems() {
  // TODO: think about some template engine.
  $items = [
    'plusAutomaticSystem' => [
      'title' => T('plusAutomaticSystemTitle'), 
      'description' => T('plusAutomaticSystemDescription'),
      'icon' => 'plus-icon__automatic'
    ],
    'plusEconomy' => [
      'title' => T('plusEconomyTitle'), 
      'description' => T('plusEconomyDescription'),
      'icon' => 'plus-icon__economy'
    ],
    'plusAvailability' => [
      'title' => T('plusAvailabilityTitle'), 
      'description' => T('plusAvailabilityDescription'),
      'icon' => 'plus-icon__availability'
    ],
    'plusSimpliticy' => [
      'title' => T('plusSimpliticyTitle'), 
      'description' => T('plusSimpliticyDescription'),
      'icon' => 'plus-icon__simpliticy'
    ],
  ];

  return $items;
}

function GetSolutionSectionItems(){
  $items = [
    'systemEquipment' => [
      'title' => T('systemEquipmentTitle'), 
      'description' => T('systemEquipmentDescription'), 
      'css' => 'system-container__equipment',
      'icon' => 'system-icon__equipment'
    ],
    'systemTransfer' => [
      'title' => T('systemTransferTitle'), 
      'description' => T('systemTransferDescription'),
      'css' => 'system-container__transfer',
      'icon' => 'system-icon__transfer'
    ],
    'systemProcessing' => [
      'title' => T('systemProcessingTitle'), 
      'description' => T('systemProcessingDescription'),
      'css' => 'system-container__processing',
      'icon' => 'system-icon__processing'
    ],
    'systemGReport' => [
      'title' => T('systemGReportTitle'), 
      'description' => T('systemGReportDescription'),
      'css' => 'system-container__g-report',
      'icon' => 'system-icon__g-report'
    ],
    'systemUReport' => [
      'title' => T('systemUReportTitle'), 
      'description' => T('systemUReportDescription'), 
      'css' => 'system-container__u-report',
      'icon' => 'system-icon__u-report'
    ],
  ];
  
  return $items;
}

?>