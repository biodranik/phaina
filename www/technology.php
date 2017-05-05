<?php
require_once(dirname(__FILE__).'/../config.php');
// Page properties.
define('TITLE', 'titleTechnologyPage');
define('FILE', __FILE__);
define('META', [
  ['property' => 'og:image', 'content' => URL('img/meta/Algorithms_Scheme.jpg')],
  ['property' => 'og:image:width', 'content' => '1200'],
  ['property' => 'og:image:height', 'content' => '627'],
]);

HTML_HEAD();
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  <section class="section technology">
    <h1><?= T('titleTechnologyPage') ?></h1>
    <div class="content content__technology">
      <?php IncludeContent('technology') ?>
    </div>
  </section>
</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
