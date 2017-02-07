<?php
  require_once(dirname(__FILE__).'/../config.php');
  HTML_HEAD();

  $team = [[
      'img' => "img/team/maniuk.png",
      'name' => T("maniukName"),
      'title' => T("maniukTitle"),
      'description' => T("maniukDescription")],
    [
      'img' => "img/team/zolotarev.png",
      'name' => T("zolotarevName"),
      'title' => T("zolotarevTitle"),
      'description' => T("zolotarevDescription")],
    [
      'img' => "img/team/maniuk.png",
      'name' => T("maniukName"),
      'title' => T("maniukTitle"),
      'description' => T("maniukDescription")],
    [
      'img' => "img/team/zolotarev.png",
      'name' => T("zolotarevName"),
      'title' => T("zolotarevTitle"),
      'description' => T("zolotarevDescription")],
    [
      'img' => "img/team/maniuk.png",
      'name' => T("maniukName"),
      'title' => T("maniukTitle"),
      'description' => T("maniukDescription")],
    [
      'img' => "img/team/zolotarev.png",
      'name' => T("zolotarevName"),
      'title' => T("zolotarevTitle"),
      'description' => T("zolotarevDescription")],
    [
      'img' => "img/team/maniuk.png",
      'name' => T("maniukName"),
      'title' => T("maniukTitle"),
      'description' => T("maniukDescription")],
    [
      'img' => "img/team/zolotarev.png",
      'name' => T("zolotarevName"),
      'title' => T("zolotarevTitle"),
      'description' => T("zolotarevDescription")],
    [
      'img' => "img/team/maniuk.png",
      'name' => T("maniukName"),
      'title' => T("maniukTitle"),
      'description' => T("maniukDescription")],
    [
      'img' => "img/team/zolotarev.png",
      'name' => T("zolotarevName"),
      'title' => T("zolotarevTitle"),
      'description' => T("zolotarevDescription")]
  ];
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  <section class="section section__container team">
    <h1 class="title__second"><?= T("teamTitle") ?></h1>
    <p class="preface preface--team">
      <?= T("teamPreface") ?>
    </p>
    <div class="team-container">
      <?php foreach ($team as $m) : ?>
        <div class="team-member">
          <div class="team-member__img">
            <img src="<?= $m['img'] ?>" />
          </div>
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
