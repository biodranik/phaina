<?php
require_once(dirname(__FILE__).'/../config.php');

$html = file_get_contents(dirname(__FILE__).'/../technology-source/VibroBox.html');

$doc = new DOMDocument();
$doc->loadHTML($html);

$html = RemoveTags($html, $doc);
$html = RemoveAttributeByName('class', $doc);
$html = RemoveAttributeByName('style', $doc);
$html = FixLinks($doc);
$html = FixImages($doc);

echo $html;

function FixImages($doc){
  $nodeList = $doc->getElementsByTagName('img');

   for ($i = $nodeList->length; --$i >= 0; ) {
    $node = $nodeList->item($i);
    $src = $node->getAttribute('src');
    $filePath = basename($src);
    $node->setAttribute('src', Url('img/tech/'.$filePath));
  }

  return $doc->saveHTML();
}


function FixLinks($doc) {
  $nodeList = $doc->getElementsByTagName('a');

  for ($i = $nodeList->length; --$i >= 0; ) {
    $node = $nodeList->item($i);
    $url = $node->getAttribute('href');

    if (StartsWith($url, 'file:')){
      $anchor = parse_url($url, PHP_URL_FRAGMENT);
      $node->setAttribute('href', '#'.$anchor);
    }
  }

  return $doc->saveHTML();
}

function RemoveTags($html, $doc) {
  removeElementsByTagName('script', $doc);
  removeElementsByTagName('style', $doc);
  removeElementsByTagName('link', $doc);

  return $doc->saveHTML();
}

function RemoveAttributeByName($attributeName, $doc) {
  $xpath = new DOMXPath($doc);

  $nodes = $xpath->query('//*[@'.$attributeName.']');
  foreach ($nodes as $node) {
    $node->removeAttribute($attributeName);
  }

  return $doc->saveHTML();
}

function RemoveElementsByTagName($tagName, $doc) {
  $nodeList = $doc->getElementsByTagName($tagName);

  for ($i = $nodeList->length; --$i >= 0; ) {
    $node = $nodeList->item($i);
    $node->parentNode->removeChild($node);
  }
}

function StartsWith($haystack, $needle)
{
  $length = strlen($needle);
  return (substr($haystack, 0, $length) === $needle);
}

?>