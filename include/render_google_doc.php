<?php
$html = file_get_contents($sourceFile);

$doc = new DOMDocument();
$doc->loadHTML($html);

RemoveTags($html, $doc);
RemoveAttributes($doc);

FixLinks($doc);
FixImages($doc);

$html = $doc->saveHTML();
$html = RemoveHtmlAndBody($html);

echo $html;

function FixImages($doc) {
  $nodes = $doc->getElementsByTagName('img');
  foreach($nodes as $node) {
    $src = $node->getAttribute('src');
    if (!empty($src)) {
      $filePath = basename($src);
      $node->setAttribute('src', Url('img/tech/'.$filePath));
    }
  }
}

function RemoveAttributes($doc) {
  RemoveAttributeByName('class', $doc);
  RemoveAttributeByName('style', $doc);
}

function RemoveHtmlAndBody($html) {
  $html = str_replace('<html>','', $html);
  $html = str_replace('</html>','', $html);
  $html = str_replace('<body>','', $html);
  $html = str_replace('</body>','', $html);
  $html = preg_replace('~<(?:!DOCTYPE|/?(?:html|body))[^>]*>\s*~i', '', $html);
  $html = preg_replace('/<!--(.|\s)*?-->/', '', $html);

  return $html;
}

function FixLinks($doc) {
  $nodes = $doc->getElementsByTagName('a');
  foreach($nodes as $node) {
    $url = $node->getAttribute('href');
    if (StartsWith($url, 'file:')){
      $anchor = parse_url($url, PHP_URL_FRAGMENT);
      $node->setAttribute('href', '#'.$anchor);
    }

    if (StartsWith($url, 'https://www.google.com/url?q=')) {
      // getting direct link from generated link
      $parts = parse_url($url);
      parse_str($parts['query'], $query);
      $link = $query['q'];

      $node->setAttribute('href', $link);
      $node->setAttribute('target', '_blank');
    }
  }
}

function RemoveTags($html, $doc) {
  RemoveElementsByTagName('script', $doc);
  RemoveElementsByTagName('style', $doc);
  RemoveElementsByTagName('link', $doc);
  RemoveElementsByTagName('head', $doc);
  RemoveElementsByTagName('meta', $doc);
}

function RemoveAttributeByName($attributeName, $doc) {
  $xpath = new DOMXPath($doc);
  $nodes = $xpath->query('//*[@'.$attributeName.']');
  foreach ($nodes as $node) {
    $node->removeAttribute($attributeName);
  }
}

function RemoveElementsByTagName($tagName, $doc) {
  $nodes = $doc->getElementsByTagName($tagName);
  foreach($nodes as $node) {
    $node->parentNode->removeChild($node);
  }
}

?>
