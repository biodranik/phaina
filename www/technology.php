<?php
require_once(dirname(__FILE__).'/../config.php');
HTML_HEAD([
    'link' => 'technology',
    'title' => 'titleTechnologyPage']);
?>

<body>

<?php HTML_HEADER('technology.php'); ?>

<main role="main">
  <section class="section technology">
    <div class="technology-content">
      <h1><?= T('titleTechnologyPage') ?></h1>

      <?php RenderGoogleDoc(dirname(__FILE__).'/../technology-source/') ?>
    </div>
  </section>
</main>

<?php HTML_FOOTER(); ?>
</body>
</html>
