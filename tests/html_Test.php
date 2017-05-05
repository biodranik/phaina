<?php

include dirname(__FILE__).'/../tools/fix_google_doc.php';

use PHPUnit\Framework\TestCase;

class HtmlTest extends TestCase {

const ORIGINAL = <<<EOD
<div>
<p><img src="1"></p>
<p>Caption 1</p>
<p><img src="2"></p>
<p>Caption 2</p>
</div>
EOD;

const FIGURE = <<<EOD
<div>
<figure><img src="1"></figure>
<p>Caption 1</p>
<figure><img src="2"></figure>
<p>Caption 2</p>
</div>
EOD;

const CAPTION = <<<EOD
<div>
<figure><img src="1"><figcaption>Caption 1</figcaption></figure>
<figure><img src="2"><figcaption>Caption 2</figcaption></figure>
</div>
EOD;

const RENAMED = <<<EOD
<div>
<a><img src="1"></a>
<a>Caption 1</a>
<a><img src="2"></a>
<a>Caption 2</a>
</div>

EOD;

const FIGCAPTION = <<<EOD
<p><img alt="Установка на цилиндрические и сферические узлы оборудования с помощью магнитного держателя и самоустанавливающегося упора" src="images/image5.jpg" title="Установка на цилиндрические и сферические узлы оборудования с помощью магнитного держателя и самоустанавливающегося упора"></p>
<p>б) установка на цилиндрические и сферические узлы оборудования<br>
с помощью магнитного держателя и самоустанавливающегося упора.</p>
EOD;

const FIGCAPTION_FIXED = <<<EOD
<figure><img alt="Установка на цилиндрические и сферические узлы оборудования с помощью магнитного держателя и самоустанавливающегося упора" src="images/image5.jpg" title="Установка на цилиндрические и сферические узлы оборудования с помощью магнитного держателя и самоустанавливающегося упора"><figcaption>б) установка на цилиндрические и сферические узлы оборудования<br>
с помощью магнитного держателя и самоустанавливающегося упора.</figcaption></figure>
EOD;

function testReplace() {
  $res = preg_replace('|<p><img (.+)></p>|U', '<figure><img $1></figure>', self::ORIGINAL, -1, $count);
  $this->assertEquals(2, $count);
  $this->assertEquals($res, self::FIGURE);

  $res = preg_replace('|</figure>\s*<p>(.+)</p>|U', '<figcaption>$1</figcaption></figure>', self::FIGURE, -1, $count);
  $this->assertEquals(2, $count);
  $this->assertEquals(self::CAPTION, $res);
}

function testRenameTags() {
  $dom = new DOMDocument();
  $dom->recover = false;
  $dom->loadHTML(self::ORIGINAL, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
  $this->assertEquals(4, RenameTags($dom, 'p', 'a'));
  $this->assertEquals(self::RENAMED, $dom->saveHTML());
}

function testImgToFigures() {
  $html = self::FIGCAPTION;
  $res = ImgToFigures($html);
  $this->assertEquals(2, count($res));
  $this->assertEquals(self::FIGCAPTION_FIXED, $html);
}

}
?>
