<?php
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
      'name' => T('Sergei Vasukevich'),
      'title' => T('vasukevichTitle'),
      'description' => T('vasukevichDescription')],
    [
      'img' => 'img/team/Aliaksei_Maniuk.jpg',
      'name' => T('Aliaksei Maniuk'),
      'title' => T('maniukTitle'),
      'description' => T('maniukDescription')]
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
            <p><?= $m['description'] ?></p>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </section>
</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
