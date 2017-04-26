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

// Does global pattern match in the &$subject, then filters matches with $filterFn
// and processes every filtered match with $mapFn.
// Returns number of replaced matches or 0 if nothing was changed.
// NOTE: Supports only one matching group (but can be upgraded for more).
function ReplacePattern($regexPatternWithOneGroup, &$subject, $filterFn, $mapFn) {
  if (false === preg_match_all($regexPatternWithOneGroup, $subject, $matches)
      or !array_key_exists(1, $matches) or empty($matches[1]))
    return 0;

  // Duplicates in $filtered cause wrong repeated replacements.
  $filtered = array_unique(array_filter($matches[1], $filterFn));
  if (empty($filtered))
    return 0;

  $mapped = array_map($mapFn, $filtered);
  $subject = str_replace($filtered, $mapped, $subject, $replacementsCount);
  return $replacementsCount;
}

?>
