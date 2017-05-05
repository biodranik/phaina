<?php
require_once(dirname(__FILE__).'/../config.php');
// Page properties.
define('TITLE', 'titleFaqPage');
define('DESCRIPTION', 'metaDescriptionFaqPage');
define('KEYWORDS', 'metaKeywordsFaqPage');
define('FILE', __FILE__);
define('META', [
  ['property' => 'og:image', 'content' => URL('img/meta/Diagnostics_Report_Example.png')],
  ['property' => 'og:image:width', 'content' => '1200'],
  ['property' => 'og:image:height', 'content' => '600'],
]);

HTML_HEAD();
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  <section class="section">
    <h1><?= T('faqTitle') ?></h1>
    <p class="preface"><?= T('faqPreface') ?></p>
    <div class="content content__faq">
      <?php IncludeContent('faq') ?>
    </div>
  </section>
</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
