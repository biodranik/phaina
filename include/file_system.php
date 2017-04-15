<?php
require_once('strings.php');

// TODO(AlexZ): Rename to JoinPath and refactor to join any files and directories combinations.
function FullPathTo($outDir, $objectName) {
  if (EndsWith($outDir, DIRECTORY_SEPARATOR))
    return $outDir . $objectName;

  return $outDir . DIRECTORY_SEPARATOR . $objectName;
}

function DirectoryCopy($src, $dst) {
  $dir = opendir($src);
  if (!file_exists($dst) and !is_dir($dst))
    @mkdir($dst);

  while (($file = readdir($dir)) !== false) {
    if (($file != '.') and ($file != '..')) {
      $srcPath = FullPathTo($src, $file);
      $dstPath = FullPathTo($dst, $file);
      if (is_dir($srcPath))
        DirectoryCopy($srcPath, $dstPath);
      else
        copy($srcPath, $dstPath);
    }
  }

  closedir($dir);
}
?>
