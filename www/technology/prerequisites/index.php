<?php
require_once(dirname(__FILE__).'/../../../config.php');
$CURRENT_PAGE_NAME = 'technology/prerequisites/index.php';
$CURRENT_PAGE = FindPageObjectByName($CURRENT_PAGE_NAME);

HTML_HEAD([
    'link' => $CURRENT_PAGE['link'],
    'title' => $CURRENT_PAGE['title']]);

$pageContent['en'] = 'English';
$pageContent['ru'] = '<strong>Вибрационная диагностика</strong> — метод <u>оценки технического</u> состояния машин и 
механизмов, основанный на анализе вибрационного сигнала, создаваемого работающим оборудованием.';

?>

<body>

<?php HTML_HEADER('technology/index.php'); ?>

<main role="main">
  <section class="section technology">
    <div class="technology-nav">
      <?php TECHNOLOGY_MENU($CURRENT_PAGE_NAME); ?>
    </div>
    <div class="technology-content">
      <h1><?= T($CURRENT_PAGE['title']) ?></h1>
      <?= $pageContent[LANG] ?>
    </div>
  </section>
</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
