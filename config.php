<?php
/* Must be included by inserting <?php require("../config.php"); ?> at the top of every page in www folder. */
// Global PHP setting. We love UTF-8.
ini_set('default_charset', 'UTF-8');

// Production base url, also used for static pages generation.
// Please use BaseURL() function instead of direct access, it makes development easier.
define('BASE_URL', 'https://deathbaba.github.io/landing-php/');

$PAGES = [
  'index.php' => [
    // Empty link means the root (index) page.
    'link' => '',
    'title' => 'titleIndexPage'
    // Index page does not have 'menu' key so it's not added into the menu.
  ],
  'technology.php' => [
    'link' => 'technology/',
    'menu' => 'menuTechnologyPage',
    'title' => 'titleTechnologyPage'
  ],
  'team.php' => [
    'link' => 'team/',
    'menu' => 'menuTeamPage',
    'title' => 'titleTeamPage'
  ],
  'contact.php' => [
    'link' => 'contact/',
    'menu' => 'menuContactPage',
    'title' => 'titleContactPage'
  ],
  '404.php' => [
    // Page without a link key is 404 HTTP Not Found page.
    // It's also (obviously) not present in the menu.
    'title' => 'title404Page'
  ],
];

require("include/globals.php");
require("include/menuItem.php");