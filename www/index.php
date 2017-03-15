<?php
require_once(dirname(__FILE__).'/../config.php');
// This include should be used only if you want pretty urls and only if web server
// routes all requests to index.php.
// Possible implementation for nginx:
// location / {
//    # Serve static content first, use php as a last resort.
//    try_files $uri $uri/ /index.php$is_args$args;
//  }
// TODO: Probably it can be moved to the config.php.
require(dirname(__FILE__).'/../include/uri_routing.php');

HTML_HEAD(['title' => 'titleIndexPage']);

// Initialization of page data models.
$plusSectionItems = [[
    'title' => T('plusAutomaticSystemTitle'),
    'description' => T('plusAutomaticSystemDescription'),
    'icon' => 'plus-icon__automatic'],
  [
    'title' => T('plusEconomyTitle'),
    'description' => T('plusEconomyDescription'),
    'icon' => 'plus-icon__economy'],
  [
    'title' => T('plusAvailabilityTitle'),
    'description' => T('plusAvailabilityDescription'),
    'icon' => 'plus-icon__availability'],
  [
    'title' => T('plusSimplicityTitle'),
    'description' => T('plusSimplicityDescription'),
    'icon' => 'plus-icon__simplicity']
];

$solutionSectionItems = [[
    'title' => T('systemEquipmentTitle'),
    'description' => T('systemEquipmentDescription'),
    'css' => 'system-container__equipment',
    'icon' => 'system-icon__equipment'],
  [
    'title' => T('systemTransferTitle'),
    'description' => T('systemTransferDescription'),
    'css' => 'system-container__transfer',
    'icon' => 'system-icon__transfer'],
  [
    'title' => T('systemProcessingTitle'),
    'description' => T('systemProcessingDescription'),
    'css' => 'system-container__processing',
    'icon' => 'system-icon__processing'],
  [
    'title' => T('systemGReportTitle'),
    'description' => T('systemGReportDescription'),
    'css' => 'system-container__g-report',
    'icon' => 'system-icon__g-report'],
  [
    'title' => T('systemUReportTitle'),
    'description' => T('systemUReportDescription'),
    'css' => 'system-container__u-report',
    'icon' => 'system-icon__u-report']
];
?>

<body>
<?php HTML_HEADER(); ?>

<main role="main">

  <section class="banner">
    <div class="section">
      <h1 class="title-index__main"><?= T('indexMainTitle') ?></h1>
      <p class="preface"><?= T('indexPreface') ?></p>
      <a class="action-button" href="<?= URL('technology.php') ?>"><?= T('moreAboutTechnology') ?></a>
      <a class="action-button" href="<?= DEMO_URL ?>"><?= T('viewDemo') ?></a>
    </div>
  </section>

  <section class="section system separator">
    <h2 class="title-index__second"><?= T("systemItem") ?></h2>
    <p class="preface"><?= T("systemPreface") ?></p>
    <div class="system-container">
      <?php foreach ($solutionSectionItems as $item) : ?>
      <div class="system-container__item  <?= $item['css'] ?> ">
        <h3 class="system-container__title system-icon <?= $item['icon'] ?>">
          <?= $item['title'] ?>
        </h3>
        <p class="system-container__text"><?= $item['description'] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <section class="section plus">
    <h2 class="title-index__second"><?= T("plusTitle") ?></h2>
    <div class="plus-container">
      <?php foreach ($plusSectionItems as $item) : ?>
      <div class="plus-container__item">
        <h3 class="plus-container__title plus-icon <?= $item['icon'] ?>">
          <span><?= $item['title'] ?></span>
        </h3>
        <p class="plus-container__text"><?= $item['description'] ?></p>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
