<?php
// $haystack - where to search, $needle - what to search.
function StartsWith($haystack, $needle) {
  return strpos($haystack, $needle) === 0;
}

// $haystack - where to search, $needle - what to search.
function EndsWith($haystack, $needle) {
  $length = strlen($needle);
  if ($length == 0)
    return true;

  return (substr($haystack, -$length) === $needle);
}
?>
