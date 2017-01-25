<?php

ini_set('default_charset', 'UTF-8');

// TODO: It can be calculated
define("BASE_URL", "http://www.vibrobox.local:8888/");
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
  // TODO: take into an account absolute/relative urls?
  return BASE_URL . $uri;
}

function MainMenu() {
  return array(
    MenuLink("technology") => Translate("menuTechnologyPage"),
    MenuLink("team") => Translate("menuTeamPage"),
    MenuLink("contact") => Translate("menuContactPage")
  );
}
