<?php
// Generates static web site pages.

require_once('config.php');

define('kPhpExtension', '.php');
define('kNewDirPermissions', 0755);
define('kIndex', 'index.php');
define('k404', '404.php');

function HtmlFromPhp($phpFile) {
  // TODO: Handle errors.
  return shell_exec(PHP_BINARY." ".$phpFile);
}

function IsPhp($fileName) {
  $pos = strrpos($fileName, kPhpExtension);
  return ($pos === false) ? false : strlen($fileName) - $pos == strlen(kPhpExtension);
}

// Does not delete $dir itself, only everything (except .git directory) inside. Does not stop execution on errors.
// .git directory is used in deployment scripts. On Windows it can have read only attributes set on some files. As a result
// not all files will be deleted and deployment scripts go crazy.
function RemoveFilesAndSubdirs($dir, $excludeDirs = array(".git")) {
  if (file_exists($dir) === false)
    return;
  // Simple sanity check.
  if ($dir == "/" or substr($dir, -2) == ":\\") {
    echo "Do you really want to delete " . $dir . "?";
    return;
  }

  $filter = function ($file, $key, $iterator) use ($excludeDirs) {
    if ($iterator->hasChildren() && !in_array($file->getFilename(), $excludeDirs))
      return true;
    return $file->isFile();
  };
  $innerIterator = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
  $iterator = new RecursiveIteratorIterator(new RecursiveCallbackFilterIterator($innerIterator, $filter), RecursiveIteratorIterator::CHILD_FIRST);
  foreach ($iterator as $fileInfo) {
    $realPath = $fileInfo->getRealPath();
    if ($fileInfo->isDir()) {
      if (rmdir($realPath) === false)
        echo "Error while rmdir " . $realPath . "\n";
    } else {
      if (unlink($realPath) === false)
        echo "Error while unlink " . $realPath . "\n";
    }
  }
}

// $phpFiles is an array of filename => full/file/path/filename.
function BuildSiteMapXml($phpFiles) {
  $siteMap = '<?xml version="1.0" encoding="UTF-8"?><urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';

  foreach ($phpFiles as $file => $fullPath) {
    // Ignore special 404.php page.
    if (EndsWith($file, k404))
      continue;
    $url = URL($file);
    // TODO: Lastmod should take into an account the modified date of page's included content.
    $lastmod = date(DATE_W3C, filemtime($fullPath));
    $siteMap = "$siteMap\n<url>\n  <loc>$url</loc>\n  <lastmod>$lastmod</lastmod>\n</url>";
  }

  return "$siteMap\n</urlset>";
}

function Generate($inDir, $outDir) {
  $staticFilesCopied = 0;

  if (file_exists($outDir))
    RemoveFilesAndSubdirs($outDir);
  else
    mkdir($outDir, kNewDirPermissions, true);

  print("Generating static html pages from php files:\n");
  $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($inDir),
      RecursiveIteratorIterator::SELF_FIRST);
  foreach($iter as $fileName => $fileInfo) {
    $fileName = $iter->getFilename();
    // Skip hidden files and directories, '.' and '..' directories.
    if ($fileName[0] === '.')
      continue;
    // Generate html from .php files and simply copy everything else into the $outDir.
    $outPath = FullPathTo($outDir, $iter->getSubPathName());
    if ($fileInfo->isDir()) {
      mkdir($outPath, kNewDirPermissions);
      continue;
    }
    if (IsPhp($fileName)) {
      $phpFileWithoutExtension = substr($outPath, 0, -strlen(kPhpExtension));
      // Create folders with index.html files to redirect visitors to the same url without a slash.
      if ($fileName != kIndex and $fileName != k404) {
        mkdir($phpFileWithoutExtension, kNewDirPermissions);
        $pageUrl = URL($fileName);
        $redirectHtmlTemplate = <<<RHTML
<!DOCTYPE html>
<html>
  <head>
    <title>$pageUrl</title>
    <link rel="canonical" href="$pageUrl"/>
    <meta http-equiv="content-type" content="text/html; charset=utf-8"/>
    <meta http-equiv="refresh" content="0; url=$pageUrl"/>
  </head>
</html>
RHTML;
        file_put_contents(FullPathTo($phpFileWithoutExtension, 'index.html'), $redirectHtmlTemplate);
      }

      $outPath = $phpFileWithoutExtension . '.html';
      // TODO: Handle errors.
      file_put_contents($outPath, HtmlFromPhp($fileInfo));
      print("+ ".$outPath."\n");
      $processedPhpFiles[$fileName] = $fileInfo;
    }
    else {
      copy($fileInfo, $outPath);
      $staticFilesCopied++;
    }
  }
  $count = count($processedPhpFiles);
  print("Processed $count php files.\n");
  if ($staticFilesCopied)
    print("Also copied ${staticFilesCopied} static resources.\n\n");

  $sitemapPath = FullPathTo($outDir, 'sitemap.xml');
  if (file_put_contents($sitemapPath, BuildSiteMapXml($processedPhpFiles)))
    print("Generated sitemap $sitemapPath.\n");
  else
    print("ERROR creating sitemap $sitemapPath.\n");
}

function Usage($self) {
  echo "Usage: php ".$self." <input www dir> <output www dir>\n";
  echo "WARNING: All files in <output www dir> will be deleted!\n";
}

/////////////////////////////////////////////////////////////////////////////////////////
// Let's go!
/////////////////////////////////////////////////////////////////////////////////////////
if ($argc < 3) {
  Usage($argv[0]);
  exit;
}
Generate($argv[1], $argv[2]);
