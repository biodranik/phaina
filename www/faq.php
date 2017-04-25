<?php
// Page properties.
define('TITLE', 'titleFaqPage');
define('DESCRIPTION', 'metaDescriptionFaqPage');
define('KEYWORDS', 'metaKeywordsFaqPage');
define('FILE', __FILE__);

require_once(dirname(__FILE__).'/../config.php');
HTML_HEAD();
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  <section class="section">
    <h1><?= T('faqTitle') ?></h1>
    <p class="preface"><?= T('faqPreface') ?></p>
    <div class="faq__content">
      <?php IncludeContent('faq') ?>
    </div>
  </section>
</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
