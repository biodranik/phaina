<?php
  // This include should be used only if you want pretty urls and only if web server
  // routes all requests to index.php.
  // Possible implementation for nginx:
  // location / {
  //    # Serve static content first, use php as a last resort.
  //    try_files $uri $uri/ /index.php$is_args$args;
  //  }
  // TODO: Probably it can be moved to the config.php.
  require_once(dirname(__FILE__).'/../config.php');
  require(dirname(__FILE__).'/../include/uri_routing.php');
  HTML_HEAD();
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  
  <section class="section banner" id="banner">
    <div class="section__container section__container--banner">
      <h1 class="title title__main">
        <?= T("indexMainTitle") ?>
      </h1>
      <p class="preface">
        <?= T("indexPreface") ?>
      </p>
      <a class="btn" href="#"><?= T("indexButton") ?></a>
    </div>
  </section>

  <section class="section plus" id="benefits">
    <div class="section__container">
      <h2 class="title title__second"><?= T("plusTitle") ?></h2>
      <div class="plus-container">
        <?php foreach (GetPlusSectionItems() as $item) : ?>
          <div class="plus-container__item">
            <h3 class="plus-container__title plus-icon <?php echo $item['icon'] ?>">
              <span><?= $item['title'] ?></span>
            </h3>
            <p class="plus-container__text"><?= $item['description'] ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    </div>
  </section>

  <section class="section system" id="solution">
    <div class="section__container">
      <h2 class="title title__second"><?= T("systemItem") ?></h2>
      <p class="preface">
        <?= T("systemPreface") ?>
      </p>
      <div class="system-container">
        <?php foreach (GetSolutionSectionItems() as $item) : ?>
          <div class="system-container__item  <?php echo $item['css'] ?> ">
            <h3 class="system-container__title system-icon <?php echo $item['icon'] ?>">
              <?= $item['title'] ?>
            </h3>
            <p class="system-container__text"><?= $item['description'] ?></p>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="faq">
        <div class="faq__item">
          <div class="faq__question"><?= T("faqQuestion1") ?></div>
          <div class="faq__title"><?= T("faqTitle1") ?></div>
          <p class="faq__answer"><?= T("faqAnswer1") ?></p>
        </div>

        <div class="faq__item">
          <div class="faq__question"><?= T("faqQuestion2") ?></div>
          <div class="faq__title"><?= T("faqTitle2") ?></div>
          <p class="faq__answer"><?= T("faqAnswer2") ?></p>
        </div>

        <div class="faq__item">
          <div class="faq__question"><?= T("faqQuestion3") ?></div>
          <div class="faq__title"><?= T("faqTitle3") ?></div>
          <p class="faq__answer"><?= T("faqAnswer3") ?></p>
        </div>

        <div class="faq__item">
          <div class="faq__question"><?= T("faqQuestion4") ?></div>
          <div class="faq__title"><?= T("faqTitle4") ?></div>
          <p class="faq__answer"><?= T("faqAnswer4") ?></p>
        </div>
      </div>

    </div>
  </section>

</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
