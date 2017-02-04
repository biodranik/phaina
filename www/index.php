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

<?php 
  // Initialization of page data models.

  $plusSectionItems = [
    'plusAutomaticSystem' => [
      'title' => T('plusAutomaticSystemTitle'), 
      'description' => T('plusAutomaticSystemDescription'),
      'icon' => 'plus-icon__automatic'
    ],
    'plusEconomy' => [
      'title' => T('plusEconomyTitle'), 
      'description' => T('plusEconomyDescription'),
      'icon' => 'plus-icon__economy'
    ],
    'plusAvailability' => [
      'title' => T('plusAvailabilityTitle'), 
      'description' => T('plusAvailabilityDescription'),
      'icon' => 'plus-icon__availability'
    ],
    'plusSimpliticy' => [
      'title' => T('plusSimpliticyTitle'), 
      'description' => T('plusSimpliticyDescription'),
      'icon' => 'plus-icon__simpliticy'
    ]
  ];

  $solutionSectionItems = [
    'systemEquipment' => [
      'title' => T('systemEquipmentTitle'), 
      'description' => T('systemEquipmentDescription'), 
      'css' => 'system-container__equipment',
      'icon' => 'system-icon__equipment'
    ],
    'systemTransfer' => [
      'title' => T('systemTransferTitle'), 
      'description' => T('systemTransferDescription'),
      'css' => 'system-container__transfer',
      'icon' => 'system-icon__transfer'
    ],
    'systemProcessing' => [
      'title' => T('systemProcessingTitle'), 
      'description' => T('systemProcessingDescription'),
      'css' => 'system-container__processing',
      'icon' => 'system-icon__processing'
    ],
    'systemGReport' => [
      'title' => T('systemGReportTitle'), 
      'description' => T('systemGReportDescription'),
      'css' => 'system-container__g-report',
      'icon' => 'system-icon__g-report'
    ],
    'systemUReport' => [
      'title' => T('systemUReportTitle'), 
      'description' => T('systemUReportDescription'), 
      'css' => 'system-container__u-report',
      'icon' => 'system-icon__u-report'
    ]
  ];

  $faqSectionItems = [
    'q1' => [
      'question' => T("faqQuestion1"),
      'title' => T("faqTitle1"),
      'answer' => T("faqAnswer1")
    ],
    'q2' => [
      'question' => T("faqQuestion2"),
      'title' => T("faqTitle2"),
      'answer' => T("faqAnswer2")
    ],
    'q3' => [
      'question' => T("faqQuestion3"),
      'title' => T("faqTitle3"),
      'answer' => T("faqAnswer3")
    ],
    'q4' => [
      'question' => T("faqQuestion4"),
      'title' => T("faqTitle4"),
      'answer' => T("faqAnswer4")
    ]
  ]
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  
  <section class="section banner">
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

  <section class="section plus">
    <div class="section__container">
      <h2 class="title title__second"><?= T("plusTitle") ?></h2>
      <div class="plus-container">
        <?php foreach ($plusSectionItems as $item) : ?>
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

  <section class="section system">
    <div class="section__container">
      <h2 class="title title__second"><?= T("systemItem") ?></h2>
      <p class="preface">
        <?= T("systemPreface") ?>
      </p>
      <div class="system-container">
        <?php foreach ($solutionSectionItems as $item) : ?>
          <div class="system-container__item  <?php echo $item['css'] ?> ">
            <h3 class="system-container__title system-icon <?php echo $item['icon'] ?>">
              <?= $item['title'] ?>
            </h3>
            <p class="system-container__text"><?= $item['description'] ?></p>
          </div>
        <?php endforeach; ?>
      </div>

      <div class="faq">
        <?php foreach($faqSectionItems as $item) : ?>
          <div class="faq__item">
            <div class="faq__question"><?= $item['question'] ?></div>
            <div class="faq__title"><?= $item['title'] ?></div>
            <p class="faq__answer"><?= $item['answer'] ?></p>
          </div>
        <?php endforeach; ?>
      </div>

    </div>
  </section>

</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
