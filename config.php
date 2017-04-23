<?php
/* Must be included by inserting <?php require_once("../config.php"); ?> at the top of every page in www directory. */
// Global PHP setting. We love UTF-8.
ini_set('default_charset', 'UTF-8');
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

// Production base url, also used for static pages generation.
// Please use BaseURL() function instead of direct access, it makes development easier.
define('BASE_URL', 'https://deathbaba.github.io/phaina/');

// Site language which is used in <html lang="…"> attributes and for translations.
// TODO(Alex): Generate all supported languages from one launch, without editing this constant.
define('LANG', 'ru');

define('DEMO_URL', 'https://www.demo.vibrobox.com/demo');
define('GOOGLE_ANALYTICS_ID', 'UA-79782596-1');
// Translation defines for meta keywords and description if they are not customized in $PAGES.
define('DEFAULT_META_DESCRIPTION', 'metaDescriptionIndexPage');
define('DEFAULT_META_KEYWORDS', 'metaKeywordsIndexPage');

$PAGES = [
  'index.php' => [
    // Empty link means the root (index) page.
    'link' => '',
    'menu' => 'menuIndexPage',
  ],
  'technology.php' => [
    'link' => 'technology',
    'menu' => 'menuTechnologyPage',
  ],
  'team.php' => [
    'link' => 'team',
    'menu' => 'menuTeamPage',
  ],
  'faq.php' => [
    'link' => 'faq',
    'menu' => 'menuFaqPage',
  ],
  'contact.php' => [
    'link' => 'contact',
    'menu' => 'menuContactPage',
  ],
  '404.php' => [
    // Page without a link key is 404 HTTP Not Found page.
    // It's also (obviously) not present in the menu.
  ]
];

require_once('include/globals.php');
require_once('include/menuItem.php');
require_once('include/strings.php');
require_once('include/file_system.php');
