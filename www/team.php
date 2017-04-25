<?php
// Page properties.
define('TITLE', 'titleTeamPage');
define('DESCRIPTION', 'metaDescriptionTeamPage');
define('KEYWORDS', 'metaKeywordsTeamPage');
define('FILE', __FILE__);

require_once(dirname(__FILE__).'/../config.php');
HTML_HEAD();

$team = [[
    'img' => 'img/team/Igor_Davydov.jpg',
    'name' => T('Igor Davydov'),
    'title' => T('idavydovTitle'),
    'description' => T('idavydovDescription')],
  [
    'img' => 'img/team/Alexander_Zolotarev.jpg',
    'name' => T('Alexander Zolotarev'),
    'title' => T('zolotarevTitle'),
    'description' => T('zolotarevDescription')],
  [
    'img' => 'img/team/Yury_Aslamov.jpg',
    'name' => T('Yury Aslamov'),
    'title' => T('yaslamovTitle'),
    'description' => T('yaslamovDescription')],
  [
    'img' => 'img/team/Sergei_Vasukevich.jpg',
    'name' => T('Sergey Vasukevich'),
    'title' => T('vasukevichTitle'),
    'description' => T('vasukevichDescription')],
  [
    'img' => 'img/team/Aliaksei_Maniuk.jpg',
    'name' => T('Aliaksei Maniuk'),
    'title' => T('maniukTitle'),
    'description' => T('maniukDescription')],
  [
    'img' => 'img/team/Aleksandr_Tsurko.jpg',
    'name' => T('Aleksandr Tsurko'),
    'title' => T('tsurkoTitle'),
    'description' => T('tsurkoDescription')],
  [
    'img' => 'img/team/Andrey_Aslamov.jpg',
    'name' => T('Andrey Aslamov'),
    'title' => T('aslamovTitle'),
    'description' => T('aslamovDescription')],
  [
    'img' => 'img/team/Anatoliy_Shevchenko.jpg',
    'name' => T('Anatoliy Shevchenko'),
    'title' => T('shevchenkoTitle'),
    'description' => T('shevchenkoDescription')],
  [
    'img' => 'img/team/Mikita_Kasmach.jpg',
    'name' => T('Mikita Kasmach'),
    'title' => T('kasmachTitle'),
    'description' => T('kasmachDescription')],
  [
    'img' => 'img/team/Petr_Riabtsev.jpg',
    'name' => T('Petr Riabtsev'),
    'title' => T('riabtsevTitle'),
    'description' => T('riabtsevDescription')],
  [
    'img' => 'img/team/Oleg_Avsyankin.jpg',
    'name' => T('Oleg Avsyankin'),
    'title' => T('avsyankinTitle'),
    'description' => T('avsyankinDescription')],
  [
    'img' => 'img/team/Roman_Tolkach.jpg',
    'name' => T('Roman Tolkach'),
    'title' => T('tolkachTitle'),
    'description' => T('tolkachDescription')],
  [
    'img' => 'img/team/Mihail_Bogdanec.jpg',
    'name' => T('Mihail Bogdanec'),
    'title' => T('bogdanecTitle'),
    'description' => T('bogdanecDescription')],
  [
    'img' => 'img/team/Yaraslava_Herasimuk.jpg',
    'name' => T('Yaraslava Herasimuk'),
    'title' => T('herasimukTitle'),
    'description' => T('herasimukDescription')],
  [
    'img' => 'img/team/Artem_Bourak.jpg',
    'name' => T('Artem Bourak'),
    'title' => T('bourakTitle'),
    'description' => T('bourakDescription')]
];
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  <section class="section team">
    <h1><?= T('teamH1') ?></h1>
    <p class="preface"><?= T('teamPreface') ?></p>
    <div class="team-container">
      <?php foreach ($team as $m) : ?>
      <div class="team-member">
        <img class="team-member__img" src="<?= URL($m['img']) ?>" alt="<?= $m['name'] ?>" />
        <div class="team-member__description">
          <h3 class="team-member__name"><?= $m['name'] ?></h3>
          <h4 class="team-member__title"><?= $m['title'] ?></h4>
          <div><?= $m['description'] ?></div>
        </div>
      </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
