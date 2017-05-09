<?php

include dirname(__FILE__).'/../include/strings.php';

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
];

function testPretty() {
  foreach (self::TESTS as $original => $result)
    $this->assertEquals($result, MakePrettyLink($original), $original);
}

}
?>
