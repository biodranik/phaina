<?php

define("BASE_URL", "http://vibrobox.local:8888/");
define("LANG", "ru");

function HTML_HEAD() {
  require_once("head.php");
}

function HTML_HEADER() {
  require_once("header.php");
}

function HTML_FOOTER() {
  require_once("footer.php");
}

require_once("translations.php");

function MenuLink($uri) {
  // TODO: take into an account absolute/relative urls?
  return BASE_URL . $uri;
}

// Returns current page URI.
function PageURI() {
  $scheme = isset($_SERVER['HTTPS']) && !empty($_SERVER['HTTPS']) ? "https" : "http";
  // TODO: Using HTTP_HOST can have security implications.
  // See http://stackoverflow.com/questions/6768793/get-the-full-url-in-php
  return "$scheme://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
}