<?php
// Page properties.
define('TITLE', 'titleTechnologyPage');
define('FILE', __FILE__);
require_once(dirname(__FILE__).'/../config.php');

HTML_HEAD();
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  <section class="section technology">
    <h1><?= T('titleTechnologyPage') ?></h1>
    <div class="technology__content">
      <?php IncludeContent('technology') ?>
    </div>
  </section>
</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
