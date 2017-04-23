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

// Returns number of replaced matches or 0 if nothing was changed.
function ReplacePattern($regexPatternWithOneGroup, &$subject, $filterFn, $mapFn) {
  if (false === preg_match_all($regexPatternWithOneGroup, $subject, $matches)
      or !array_key_exists(1, $matches))
    return 0;

  $filtered = array_filter($matches[1], $filterFn);
  if (empty($filtered))
    return 0;

  $mapped = array_map($mapFn, $filtered);
  $subject = str_replace($filtered, $mapped, $subject, $replacementsCount);
  return $replacementsCount;
}

?>
