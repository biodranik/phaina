<?php

ini_set('default_charset', 'UTF-8');

# Trick for easier development.
if (array_key_exists("REMOTE_ADDR", $_SERVER) and
    ($_SERVER['REMOTE_ADDR'] == "127.0.0.1" or $_SERVER['REMOTE_ADDR'] == "::1")) {
  $scheme = (isset($_SERVER['HTTPS']) and !empty($_SERVER['HTTPS'])) ? "https" : "http";
  define("BASE_URL", "${scheme}://${_SERVER['HTTP_HOST']}/");
} else {
  define("BASE_URL", "https://deathbaba.github.io/landing-php/");
}
define("LANG", "ru");
define("TEAM_PAGE", "team");
define("CONTACT_PAGE", "contact");
define("TECHNOLOGY_PAGE", "technology");

require("translations.php");

function HTML_HEAD() {
  return require("head.php");
}

function HTML_HEADER() {
  return require("header.php");
}

function HTML_FOOTER() {
  return require("footer.php");
}

function MenuLink($uri) {
  return BASE_URL . "${uri}/";
}

function MainMenu() {
  $currentPage = strtolower(basename($_SERVER['REQUEST_URI']));
  
  $menu = array();
  $menu[0] = new MenuItem(MenuLink(TECHNOLOGY_PAGE), Translate("menuTechnologyPage"),($currentPage == TECHNOLOGY_PAGE ? true : false));
  $menu[1] = new MenuItem(MenuLink(TEAM_PAGE), Translate("menuTeamPage"), ($currentPage == TEAM_PAGE ? true : false));
  $menu[2] = new MenuItem(MenuLink(CONTACT_PAGE), Translate("menuContactPage"), ($currentPage == CONTACT_PAGE ? true : false));
  
  return $menu;
}

?>