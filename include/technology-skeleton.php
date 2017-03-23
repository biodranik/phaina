<?php
require_once(dirname(__FILE__).'/../config.php');
$pageContent = ob_get_contents();
ob_end_clean();

$filter = ['pageName' => $CURRENT_PAGE_NAME];
$CURRENT_PAGE = FindPageObjectByFilter($filter);

$NEXT_PAGE = array_key_exists('next', $CURRENT_PAGE) ? FindPageObjectByFilter(['pageName' => $CURRENT_PAGE['next']]) : [];
$PREV_PAGE = array_key_exists('prev', $CURRENT_PAGE) ? FindPageObjectByFilter(['pageName' => $CURRENT_PAGE['prev']]) : [];

// initialize $showNavigation if not initialized.
$showNavigation = isset($showNavigation) ? $showNavigation : false; 

HTML_HEAD([
  'link' => $CURRENT_PAGE['link'],
  'title' => $CURRENT_PAGE['title']]);
?>

<body>
<?php HTML_HEADER('technology/index.php'); ?>

<main role="main">
  <section class="section technology">
    <?php if($showNavigation === true) : ?>
    <div class="technology-nav">
      <?php TechnologyMenu($CURRENT_PAGE_NAME); ?>
    </div>
    <?php endif; ?>

    <div class="technology-content">
      <h1><?= T($CURRENT_PAGE['title']) ?></h1>
      
      <?= $pageContent ?>

      <div class="technology-content-nav">
        <?php if(array_key_exists('link', $PREV_PAGE)) : ?>
        <a class="prev-page" href="<?= URL($PREV_PAGE['link']) ?>">< <?= T('techPrevPage') ?></a>
        <?php endif; ?>
        <?php if(array_key_exists('link', $NEXT_PAGE)) : ?>
        <a class="next-page" href="<?= URL($NEXT_PAGE['link']) ?>"><?= T('techNextPage') ?> ></a>
        <?php endif; ?>
      </div>
    </div>
  </section>
</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
