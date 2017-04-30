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
// Matches are not filtered if $filterFn is `true`.
// Returns number of replaced matches or 0 if nothing was changed.
// NOTE: Works with zero or one matching group.
function ReplacePattern($regexPatternWithOneGroup, &$subject, $mapFn, $filterFn = true) {
  if (false === preg_match_all($regexPatternWithOneGroup, $subject, $matches))
    die("ERROR: invalid pattern `$regexPatternWithOneGroup`\n");

  switch (count($matches)) {
    // No matches.
    case 0: return 0;
    // Duplicates cause wrong repeated replacements.
    case 1: $values = array_unique($matches[0]); break;
    case 2: $values = array_unique($matches[1]); break;
    default: die("ERROR: More than one matching groups are not supported yet.\n");
  }

  if (is_callable($filterFn))
    $values = array_filter($values, $filterFn);

  $mapped = array_map($mapFn, $values);

  // Use matches[0] for final replacements when using matching group to avoid incorrect replaces.
  if (count($matches) >= 2) {
    foreach ($mapped as $key => $value) {
      $mapped[$key] = str_replace($values[$key], $mapped[$key], $matches[0][$key]);
      $newValues[$key] = $matches[0][$key];
    }
    $values = $newValues;
  }

  $subject = str_replace($values, $mapped, $subject, $replacementsCount);
  return $replacementsCount;
}

?>
