<?php
// Generates static web site pages.

define("kPhpExtension", ".php");
define("kNewDirPermissions", 0755);
define("kIndex", "index.php");
define("k404", "404.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

function HtmlFromPhp($phpFile) {
  // TODO: Handle errors.
  return shell_exec(PHP_BINARY." ".$phpFile);
}

function IsPhp($fileName) {
  $pos = strrpos($fileName, kPhpExtension);
  return ($pos === false) ? false : strlen($fileName) - $pos == strlen(kPhpExtension);
}

// Does not delete $dir itself, only everything inside. Stops on any error.
// TODO: Print errors.
function RemoveFilesAndSubdirs($dir) {
  if (file_exists($dir) === false or $dir == "/") return;

  $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir,
      RecursiveDirectoryIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);
  foreach ($iter as $fileInfo) {
    if ($fileInfo->isDir()) {
      if (rmdir($fileInfo->getRealPath()) === false) return;
    } else {
      if (unlink($fileInfo->getRealPath()) === false) return;
    }
  }
}

function Generate($inDir, $outDir) {
  if (file_exists($outDir)) RemoveFilesAndSubdirs($outDir);
  else mkdir($outDir, kNewDirPermissions, true);

  $iter = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($inDir),
      RecursiveIteratorIterator::SELF_FIRST);
  foreach($iter as $fileName => $fileInfo) {
    $fileName = $iter->getFilename();
    // Skip hidden files and directories, '.' and '..' directories.
    if ($fileName[0] === '.') continue;
    // Generate html from .php files and simply copy everything else into the $outDir.
    $outPath = $outDir . DIRECTORY_SEPARATOR . $iter->getSubPathName();
    if ($fileInfo->isDir()) {
      mkdir($outPath, kNewDirPermissions);
      continue;
    }
    if (IsPhp($fileName)) {
      // Remove .php extension.
      $outPath = substr($outPath, 0, -strlen(kPhpExtension));
      // Special cases:
      // - index page does not need a folder
      // - optional custom 404 page generates 404.html in the root folder.
      if ($fileName == kIndex or $fileName == k404) {
        $outPath .= ".html";
      } else {
        // Create directory with index.html inside.
        mkdir($outPath, kNewDirPermissions);
        $outPath .= DIRECTORY_SEPARATOR . "index.html";
      }
      // TODO: Handle errors.
      file_put_contents($outPath, HtmlFromPhp($fileInfo));
      print("+ ".$outPath."\n");
    }
    else {
      copy($fileInfo, $outPath);
      print("= ".$outPath."\n");
    }
  }
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
