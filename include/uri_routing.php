<?php
// Correctly routes to specific page if php is invoked via CGI interface.
// Should be included from index.php.

// Returns and continues with index.php if invoked from command line.
if (!array_key_exists("REQUEST_URI", $_SERVER) or empty($_SERVER['REQUEST_URI']) or
  $_SERVER['REQUEST_URI'] == "/") return;

function GetBaseURIWithoutSlashFromVars() {
  $scheme = (isset($_SERVER['HTTPS']) and !empty($_SERVER['HTTPS'])) ? "https" : "http";
  $port = (isset($_SERVER['SERVER_PORT']) and $_SERVER['SERVER_PORT'] != "80") ? ":${_SERVER['SERVER_PORT']}" : "";
  return "${scheme}://${_SERVER['SERVER_NAME']}${port}";
}

function FileByRequestUri($uri) {
  // TODO: Support multilingual and custom urls.
  // Do like Github for better SEO: redirect /link to /link/ and keep in mind that
  // both /link and /link/ should finally render the same /link.php script.
  if (substr($uri, -1) == "/") {
    $phpFile = trim($uri, "/").".php";
    if (file_exists($phpFile)) return $phpFile;
  } else {
    $phpFile = ltrim($uri, "/").".php";
    if (file_exists($phpFile)) {
      // 301 Redirect!
      header("Location: " . GetBaseURIWithoutSlashFromVars() . $uri . "/", true, 301);
      exit;
    }
  }
  return "404.php";
}

require_once(FileByRequestUri($_SERVER['REQUEST_URI']));
// It's important to avoid rendering index.php at the end.
exit;