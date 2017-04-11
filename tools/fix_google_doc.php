<?php

if (count($argv) < 3) {
  echo "This script cleans up and fixes html document exported from Google Docs.\n";
  echo "NOTE: you should have tidy-html5 installed in your PATH.\n";
  echo "See more details at https://github.com/htacg/tidy-html5\n\n";
  echo "Usage: ${argv[0]} <html_from_google_docs> <out_clean_html> [optional_path_to_tidy_binary]\n";
  exit(1);
}

// &nbsp; replacement, should be done before tidy as it removes <span>s.
echo "* Replacing &nbsp; which are randomly inserted by Google Docs after <span> tags by normal space...\n";
$html = '<!DOCTYPE html>' . file_get_contents($argv[1]);
if ($html === FALSE)
  die("ERROR: Can't open file $argv[1].");
$html = str_replace('>&nbsp;', '> ', $html, $count);
echo "* Done ($count replacements)\n\n";

// Html exported from GDocs can be malformed. Fix it before processing with DOMDocument.
echo "* Launching tidy-html5 to fix non-closed <p> tags...\n";
RunTidy("-utf8 -q --preserve-entities yes --logical-emphasis yes --anchor-as-name no -w 0", $html);

// Fix google links and remove document comments, should be done on complete <html><head><body> doc.
echo "* Removing intermediate google redirect for all external links and strip comments...\n";
$doc = new DOMDocument();
$doc->preserveWhiteSpace = false;
$doc->loadHTML($html);
$count = 0;
$nodesToRemove = array();
foreach ($doc->getElementsByTagName('a') as $a) {
  $href = $a->getAttribute('href');
  // Fix google redirects.
  if (0 === strpos($href, 'https://www.google.com/url?q=')) {
    $query = parse_url($href, PHP_URL_QUERY);
    parse_str($query, $query);
    $a->setAttribute('href', $query['q']);
    $a->setAttribute('target', '_blank');
    ++$count;
  } else if (0 === strpos($href, '#cmnt_ref')) {
    // Strip comments <div><p><a>.
    $nodesToRemove[] = $a->parentNode->parentNode;
  } else if (0 === strpos($href, '#cmnt')) {
    // Strip references to comments <sup><a>.
    $nodesToRemove[] = $a->parentNode;
  }
}
// Remove nodes in the separate foreach to avoid undefined behavior if we do it in above foreach.
foreach ($nodesToRemove as $node)
  $node->parentNode->removeChild($node);
$commentsAndRefs = count($nodesToRemove);
if ($count or $commentsAndRefs) {
  $html = $doc->SaveHTML();
  echo "* Done (replaced $count links, removed $commentsAndRefs comments and references)\n\n";
} else {
  echo "* Done (no changes have been made).\n\n";
}

// Final document cleanup and extraction of <body>'s content.
echo "* Launching tidy-html5 again to do all the dirty work...\n";
RunTidy("-q --show-body-only yes -w 0 -gdoc -output ${argv[2]}", $html);

///////////////////////////////////////////////////////////////////////////////

function RunTidy($params, &$text) {
  global $argv;
  if (isset($argv[3])) $tidy = $argv[3];
  else $tidy = 'tidy';
  $ret = RunCmdStdinStdout($tidy . ' ' . $params, $text);
  switch ($ret) {
    case 0:  echo "* Done.\n\n"; break;
    case 1:  echo "* Done with some warnings.\n\n"; break;
    case 2:  echo "* Tidy has encountered errors while processing html.\n\n"; break;
    case -1:
    case 127: echo "* ERROR: `$tidy` has not been found.\n\n"; exit(-1);
    default: echo "* Unknown return code $ret.\n\n"; break;
  }
}

// Pipes $text to $cmd stdin.
// Returns $cmd exit code and $text contains $cmd's stdout.
function RunCmdStdinStdout($cmd, &$text) {
  $process = proc_open($cmd, [0 => ['pipe', 'r'], 1 => ['pipe', 'w']], $pipes);
  if (!is_resource($process))
    die("ERROR launching `$cmd`.\n");
  fwrite($pipes[0], $text);
  fclose($pipes[0]);
  $text = stream_get_contents($pipes[1]);
  fclose($pipes[1]);
  return proc_close($process);
}
