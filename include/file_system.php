<?php 
require_once('strings.php');

function FullPathTo($outDir, $objectName) {
  if (EndsWith($outDir, DIRECTORY_SEPARATOR)) 
    return $outDir . $objectName;
  
  return $outDir . DIRECTORY_SEPARATOR . $objectName;
}

?>
