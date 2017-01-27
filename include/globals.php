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
  return array(
    MenuLink("technology") => Translate("menuTechnologyPage"),
    MenuLink("team") => Translate("menuTeamPage"),
    MenuLink("contact") => Translate("menuContactPage")
  );
}
