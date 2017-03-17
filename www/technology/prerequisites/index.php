<?php
require_once(dirname(__FILE__).'/../../../config.php');
HTML_HEAD([
    'link' => 'technology',
    'title' => 'titleTechnologyPage']);

$CURRENT_PAGE_NAME = 'technology/prerequisites/index.php';
$CURRENT_PAGE = FindPageObjectByName($CURRENT_PAGE_NAME);
?>

<body>

<?php HTML_HEADER('technology/index.php'); ?>

<main role="main">
  <section class="section technology">
    <div class="technology-nav">
      <?php TECHNOLOGY_MENU($CURRENT_PAGE_NAME); ?>
    </div>
    <div class="technology-content">
    </div>
  </section>
</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
