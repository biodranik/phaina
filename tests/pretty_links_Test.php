<?php

include_once dirname(__FILE__).'/../include/strings.php';

use PHPUnit\Framework\TestCase;

class PrettyLinksTest extends TestCase {

const TESTS = [
  'Some Text' => 'some_text',
  'текст НА русском' => 'текст_на_русском',
  '' => '',
  '!!!' => '_',
  '1' => '1',
  '1. Title' => 'title',
  '1.2 Title' => 'title',
  '1.2.3. Title' => 'title',
  '1 Title.' => 'title',
  'II Rome' => 'rome',
  '2) Huh?' => 'huh',
  ' 2. Huh?' => '2_huh',
  '2.Huh' => '2_huh',
  'XII. Title' => 'title',
  '¿Вопросы?' => 'вопросы',
  '_-_' => '-',
  'a - b' => 'a-b',
  'a ---- b' => 'a-b',
  'a --, -- b' => 'a-b',
  '«Индустрия 4.0»' => 'индустрия_4_0',
  "12. Text: \"comma\", &semi#colon; em — '20–30' И-dash!\nAnd\ttab, dot. And многоточие…" =>
      'text_comma_semi_colon_em-20-30_и-dash_and_tab_dot_and_многоточие',
  'In 2008, his work' => 'in_2008_his_work',
];

function testPretty() {
  foreach (self::TESTS as $original => $result)
    $this->assertEquals($result, MakePrettyLink($original), $original);
}

const TESTS_SHORT = [
  '1_2_3' => [2 /* Max words */, 100 /* Max chars */, '1_2' /* Result */],
  '1_2_3' => [3, 100, '1_2_3'],
  '1_2_3' => [3, 1, '1'],
  '1_2_3' => [3, 4, '1_2_'],
  'смачна_есьцi' => [1, 12, 'смачна'],
  'смачна_есьцi' => [2, 12, 'смачна_есьцi'],
  'смачна_есьцi' => [1, 4, 'смач'],
  '' => [1, 10, ''],
  '__' => [1, 10, '_'],
  null => [1, 10, null],
];

function testPrettyShort() {
  foreach (self::TESTS_SHORT as $str => $wordsCharsRes)
    $this->assertEquals($wordsCharsRes[2], MakePrettyLink($str, $wordsCharsRes[0], $wordsCharsRes[1]), $str);
}

}
?>
