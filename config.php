<?php
/* Must be included by inserting <?php require_once("../config.php"); ?> at the top of every page in www folder. */
// Global PHP setting. We love UTF-8.
ini_set('default_charset', 'UTF-8');

// Production base url, also used for static pages generation.
// Please use BaseURL() function instead of direct access, it makes development easier.
define('BASE_URL', 'https://deathbaba.github.io/landing-php/');

// Default site language, used in <html lang="…"> attributes and for default translation language.
define('LANG', 'ru');

define('DEMO_URL', 'https://www.dev.vibrobox.com/site/login');

$PAGES = [
  'index.php' => [
    // Empty link means the root (index) page.
    'link' => '',
    'title' => 'titleIndexPage'
    // Index page does not have 'menu' key so it's not added into the menu.
  ],
  // Temporary remove technology page from menu
  // 'technology.php' => [
  //   'link' => 'technology',
  //   'menu' => 'menuTechnologyPage',
  //   'title' => 'titleTechnologyPage'
  // ],
  'team.php' => [
    'link' => 'team',
    'menu' => 'menuTeamPage',
    'title' => 'teamTitle'
  ],
  'faq.php' => [
    'link' => 'faq',
    'menu' => 'menuFaqPage',
    'title' => 'faqTitle'
  ],
  'contact.php' => [
    'link' => 'contact',
    'menu' => 'menuContactPage',
    'title' => 'titleContactPage'
  ],
  '404.php' => [
    // Page without a link key is 404 HTTP Not Found page.
    // It's also (obviously) not present in the menu.
    'title' => 'title404Page'
  ],
];

require_once('include/globals.php');
require_once('include/menuItem.php');
