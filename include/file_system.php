<?php 
require_once('strings.php');

function FullPathTo($outDir, $objectName) {
  if (EndsWith($outDir, DIRECTORY_SEPARATOR)) 
    return $outDir . $objectName;
  
  return $outDir . DIRECTORY_SEPARATOR . $objectName;
}

function DirectoryCopy($src, $dst) { 
  $dir = opendir($src); 

  if (!file_exists($dst) && !is_dir($dst)) {
    @mkdir($dst);        
  }

  while(false !== ($file = readdir($dir))) { 
    if (($file != '.') && ($file != '..')) { 
      if (is_dir($src . DIRECTORY_SEPARATOR . $file)) { 
        DirectoryCopy($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file); 
      } 
      else { 
        copy($src . DIRECTORY_SEPARATOR . $file, $dst . DIRECTORY_SEPARATOR . $file); 
      } 
    } 
  }

  closedir($dir); 
} 

?>
