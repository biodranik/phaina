<?php

include_once dirname(__FILE__).'/../include/strings.php';

use PHPUnit\Framework\TestCase;

// TODO: Add test case with a group match where pattern replacement fails.
class StringsTest extends TestCase {

const ORIGINAL = <<<EOD
<a href="#href1" id="1">
  <img src="pics/test.jpg">
</a>
EOD;

const WHOLE_MATCH_result = <<<EOD
<a href="replaced" id="1">
  <img src="pics/test.jpg">
</a>
EOD;

const SRC_AND_HREF_result = <<<EOD
<a href="http://localhost/#href1" id="1">
  <img src="http://localhost/pics/test.jpg">
</a>
EOD;

public function testReplacePatternSmoke() {
  $html = self::ORIGINAL;
  $this->assertEquals(1, ReplacePattern('/href="#href1"/', $html,
      function ($match) { return 'href="replaced"'; }));
  $this->assertEquals(self::WHOLE_MATCH_result, $html);

  $html = self::ORIGINAL;
  $this->assertEquals(2, ReplacePattern('/ (?:src|href)=[\'"]?([^\'" >]+)/', $html,
      function ($match) { return 'http://localhost/' . $match; }));
  $this->assertEquals(self::SRC_AND_HREF_result, $html);
}

}
?>
