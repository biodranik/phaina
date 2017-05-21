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
    case 0:
      return 0;

    case 1:
      if (empty($matches[0]))
        return 0;
      // Duplicates cause wrong repeated replacements.
      $values = array_unique($matches[0]);
      break;

    case 2:
      if (empty($matches[1]))
        return 0;
      // Duplicates cause wrong repeated replacements.
      $values = array_unique($matches[1]);
      break;

    default:
      die("ERROR: More than one matching groups are not supported yet.\n");
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

function MakePrettyLink($text) {
  // Replace/remove leading arabic or roman numerals if they are present:
  // '1. Text' => 'Text', 'XI Text' => 'Text' etc.
  $num = strstr($text, ' ', true);
  if (!empty($num) and
      false !== mb_eregi('[XVI\d][XVI\d\.\)]*$', $num) and
      strrpos($text, ' ') + 1 < strlen($text))
    $text = strstr($text, ' ');
  // Replace em and en dashes with hyphen.
  $pretty = str_replace(['–', '—'], ['-', '-'], $text);
  $pretty = mb_ereg_replace('[^\w\-]', '_', $pretty);
  // Lowercase everything.
  $pretty = mb_strtolower($pretty);
  // Merge 2+ sequential underscores to a single underscore.
  $pretty = mb_ereg_replace('_+', '_', $pretty);
  // Remove redundant underscores in `_-_`, `_-` or `-_`.
  $pretty = mb_ereg_replace('_*-_*', '-', $pretty);
  // Merge 2+ sequential hyphens to a single hyphen.
  $pretty = mb_ereg_replace('-+', '-', $pretty);
  $pretty = trim($pretty, '_');
  // Return `_` if original string did not contain any characters.
  if (empty($pretty) and !empty($text))
    return '_';
  return $pretty;
}

?>
