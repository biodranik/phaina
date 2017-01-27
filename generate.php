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

// Does not delete $dir itself, only everything (except .git folder) inside. Does not stop execution on errors.
// .git folder is used in deployment scripts. On Windows it can have read only attributes set on some files. As a result
// not all files will be deleted and deployment scripts go crazy.
function RemoveFilesAndSubdirs($dir, $excludeDirs = array(".git")) {
  if (file_exists($dir) === false) return;
  // Simple sanity check.
  if ($dir == "/" or substr($dir, -2) == ":\\") {
    echo "Do you really want to delete " . $dir . "?";
    return;
  }

  $filter = function ($file, $key, $iterator) use ($excludeDirs) {
    if ($iterator->hasChildren() && !in_array($file->getFilename(), $excludeDirs)) return true;
    return $file->isFile();
  };
  $innerIterator = new RecursiveDirectoryIterator($dir, RecursiveDirectoryIterator::SKIP_DOTS);
  $iterator = new RecursiveIteratorIterator(new RecursiveCallbackFilterIterator($innerIterator, $filter), RecursiveIteratorIterator::CHILD_FIRST); 
  foreach ($iterator as $fileInfo) {
    $realPath = $fileInfo->getRealPath();
    if ($fileInfo->isDir()) {
      if (rmdir($realPath) === false) echo "Error while rmdir " . $realPath . "\n";
    } else {
      if (unlink($realPath) === false) echo "Error while unlink " . $realPath . "\n";
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
