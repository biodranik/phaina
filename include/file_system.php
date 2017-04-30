<?php
require_once('strings.php');

// TODO(AlexZ): Rename to JoinPath and refactor to join any files and directories combinations.
function FullPathTo($outDir, $objectName, $separator = DIRECTORY_SEPARATOR) {
  if (EndsWith($outDir, $separator)) {
    if (StartsWith($objectName, $separator))
      return $outDir . $objectName.substr(1);   // 'path/', '/to'
    return $outDir . $objectName;               // 'path/', 'to'
  } else {
    if (StartsWith($objectName, $separator))
      return $outDir . $objectName;             // 'path', '/to'
    return $outDir . $separator . $objectName;  // 'path', 'to'
  }
}

function JoinIRI($pathLeft, $pathRight) { return FullPathTo($pathLeft, $pathRight, '/'); }

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
