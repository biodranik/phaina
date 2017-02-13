<?php
  require_once(dirname(__FILE__).'/../config.php');
  HTML_HEAD();

  $sections =[[
    'sectionName' => T("generalQuestionsTitle"),
    'anchor' => 'genetal-questions',
    'questions' => [[
      'question' => T("general_q1_question"),
      'anchor' => 'q1',
      'shortAnswer' => T("general_q1_short_answer"),
      'detailedAnswer' => T("general_q1_detailed_answer")],
     [
      'question' => T("general_q2_question"),
      'anchor' => 'q2',
      'shortAnswer' => T("general_q2_short_answer"),
      'detailedAnswer' => T("general_q2_detailed_answer")], 
    [
      'question' => T("general_q3_question"),
      'anchor' => 'q3',
      'shortAnswer' => T("general_q3_short_answer"),
      'detailedAnswer' => T("general_q3_detailed_answer")],
    [
      'question' => T("general_q4_question"),
      'anchor' => 'q4',
      'shortAnswer' => T("general_q4_short_answer"),
      'detailedAnswer' => T("general_q4_detailed_answer")]]],
  [
    'sectionName' => T("generalQuestionsTitle"),
    'anchor' => 'genetal-questions1',
    'questions' => [[
      'question' => T("general_q1_question"),
      'anchor' => 'q11',
      'shortAnswer' => T("general_q1_short_answer"),
      'detailedAnswer' => T("general_q1_detailed_answer")],
     [
      'question' => T("general_q2_question"),
      'anchor' => 'q21',
      'shortAnswer' => T("general_q2_short_answer"),
      'detailedAnswer' => T("general_q2_detailed_answer")], 
    [
      'question' => T("general_q3_question"),
      'anchor' => 'q31',
      'shortAnswer' => T("general_q3_short_answer"),
      'detailedAnswer' => T("general_q3_detailed_answer")],
    [
      'question' => T("general_q4_question"),
      'anchor' => 'q41',
      'shortAnswer' => T("general_q4_short_answer"),
      'detailedAnswer' => T("general_q4_detailed_answer")]]]
  ];
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  <section class="section">
    <h1><?= T("faqTitle") ?></h1>
    <p class="preface"><?= T("faqPreface") ?></p>

    <?php foreach ($sections as $s) : ?>
      <div class="faq-section">
        <h2 class="faq-section__h2">
          <a href="javascript:;" onclick="document.location.hash='<?= $s['anchor'] ?>'">
            <?= $s['sectionName'] ?>
          </a>
        </h2>
        <ul class="faq-section__list">
          <?php foreach ($s['questions'] as $q) : ?>
            <li class="faq-section__question">
              <a href="javascript:;" onclick="document.location.hash='<?= $q['anchor'] ?>'">
                <?= $q['question'] ?>
              </a>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    <?php endforeach; ?>
  </section>

  <section class="section">
    <?php foreach ($sections as $s) : ?>
      <h2 class="faq-main__h2" id="<?= $s['anchor'] ?>"><?= $s['sectionName'] ?></h2>
      <div class="faq-main__block">
        <?php foreach ($s['questions'] as $q) : ?>
          <div class="faq-main__answer">
            <h3 id="<?= $q['anchor'] ?>"><?= $q['question'] ?></h3>
            <h4><?= $q['shortAnswer'] ?></h4>
            <p><?= $q['detailedAnswer'] ?></p>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endforeach; ?>
  <section>
</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
