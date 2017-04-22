<?php
require_once(dirname(__FILE__).'/../config.php');
HTML_HEAD([
    'title' => 'titleFaqPage',
    'description' => 'metaDescriptionFaqPage',
    'keywords' => 'metaKeywordsFaqPage']);
?>

<body>

<?php HTML_HEADER('faq.php'); ?>

<main role="main">
  <section class="section">
    <h1><?= T("faqTitle") ?></h1>
    <p class="preface"><?= T("faqPreface") ?></p>
    <div class="faq__content">
      <?php IncludeContent('faq') ?>
    </div>
  </section>
</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
