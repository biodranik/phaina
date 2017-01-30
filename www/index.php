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
  <section class="section banner">
    <div class="section__cont">
      <h1 class="title title__main">
        <?= T("indexMainTitle") ?>
      </h1>
      <p class="preface preface--mod">
        <?= T("indexPreface") ?>
      </p>
      <a class="btn btn__custom goToContactForm" href="/landing/demo-access"><?= T("indexButton") ?></a>
    </div>
  </section>

  <section class="section plus" id="benefits">
    <div class="section__cont">
      <h2 class="title title__second">
        <?= T("plusTitle") ?>
      </h2>
      <div class="plus-container">
        <div class="plus-container__item">
          <h3 class="plus-container__title">
            <i class="icon automatic-icon"></i>
            <span>Полностью автоматическая система</span>
          </h3>
          <p class="plus-container__text">
            Сервис VibroBox не требует наличия на предприятии специально обученного персонала или эксперта по диагностике
          </p>
        </div>
        <div class="plus-container__item">
          <h3 class="plus-container__title">
            <i class="icon saving-icon"></i>
            <span>Экономия на</span>
            <span>оборудовании</span>
          </h3>
          <p class="plus-container__text">
            Используйте имеющееся на предприятии виброизмерительное оборудование или получите вместе с сервисом наше
          </p>
        </div>
        <div class="plus-container__item">
          <h3 class="plus-container__title">
            <i class="icon available-icon"></i>
            <span>Удобно</span>
            <span>и доступно</span>
          </h3>
          <p class="plus-container__text">
            Результаты оценки технического состояния вашего оборудования всегда доступны онлайн, а также посредством SMS или E-mail, где бы вы ни находились
          </p>
        </div>
        <div class="plus-container__item">
          <h3 class="plus-container__title">
            <i class="icon integration-icon"></i>
            <span>Простота</span>
            <span>интеграции</span>
          </h3>
          <p class="plus-container__text">
            VibroBox легко интегрируется с системами управления предприятием, производственными процессами и техническим обслуживанием (ERP, MES, CMMS, SCADA)
          </p>
        </div>
      </div>
    </div>
  </section>

  <section class="section system" id="solution">
    <div class="section__cont">
      <h2 class="title title__second"><?= T("systemItem") ?></h2>
      <p class="preface">
        <?= T("systemPreface") ?>
      </p>
      <div class="system-container">
        <div class="system-container__item system-container__equipment">
          <h3 class="system-container__title">
            <i class="icon equipment-icon"></i>
            Оборудование
          </h3>
          <p class="system-container__text">
            На контролируемое оборудование устанавливаются датчики вибрации и телеметрическая система VibroBox, либо, по необходимости, используется оборудование партнёров
          </p>
        </div>
        <div class="system-container__item system-container__transfer">
          <h3 class="system-container__title">
            <i class="icon data-transfer-icon"></i>
            Сбор и передача данных
          </h3>
          <p class="system-container__text">
            Снятые с оборудования данные передаются для обработки и анализа в облачный сервис либо на сервера заказчика
          </p>
        </div>
        <div class="system-container__item system-container__processing">
          <h3 class="system-container__title">
            <i class="icon data-processing-icon"></i>
            Обработка данных
          </h3>
          <p class="system-container__text">
            Система обработки данных основана на открытых стандартах, использует как собственные, так и традиционные алгоритмы выделения наборов информативных признаков из телеметрической информации. Оценка технического состояния оборудования выполняется в полностью автоматическом режиме
          </p>
        </div>
        <div class="system-container__item system-container__g-report">
          <h3 class="system-container__title">
            <i class="icon generate-report-icon"></i>
            Состояние оборудования
          </h3>
          <p class="system-container__text">
            Результаты диагностики представляются в виде краткой и развёрнутой оценки технического состояния оборудования и набора рекомендуемых мероприятий
          </p>
        </div>
        <div class="system-container__item system-container__u-report">
          <h3 class="system-container__title">
            <i class="icon using-report-icon"></i>
            Техническое обслуживание
          </h3>
          <p class="system-container__text">
            Результаты работы сервиса достаточны для принятия решений по техническому обслуживанию оборудования и могут быть интегрированы через ERP, MES, CMMS и SCADA системы
          </p>
        </div>
      </div>
    </div>
  </section>


</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
