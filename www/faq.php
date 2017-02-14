<?php
require_once(dirname(__FILE__).'/../config.php');
HTML_HEAD();

$sections =[[
  'sectionName' => T("generalQuestionsTitle"),
  'anchor' => 'general-questions',
  'questions' => [[
    'question' => T("general_q1_question"),
    'anchor' => T('general_q1_anchor'),
    'detailedAnswer' => T("general_q1_answer")],
  [
    'question' => T("general_q2_question"),
    'anchor' => T('general_q2_anchor'),
    'detailedAnswer' => T("general_q2_answer")], 
  [
    'question' => T("general_q3_question"),
    'anchor' => T('general_q3_anchor'),
    'detailedAnswer' => T("general_q3_answer")],
  [
    'question' => T("general_q4_question"),
    'anchor' => T('general_q4_anchor'),
    'detailedAnswer' => T("general_q4_answer")]]],
[
  'sectionName' => T("generalQuestionsTitle"),
  'anchor' => 'genetal-questions1',
  'questions' => [[
    'question' => T("general_q1_question"),
    'anchor' => 'q11',
    'detailedAnswer' => T("general_q1_answer")],
  [
    'question' => T("general_q2_question"),
    'anchor' => 'q21',
    'detailedAnswer' => T("general_q2_answer")], 
  [
    'question' => T("general_q3_question"),
    'anchor' => 'q31',
    'detailedAnswer' => T("general_q3_answer")],
  [
    'question' => T("general_q4_question"),
    'anchor' => 'q41',
    'detailedAnswer' => T("general_q4_answer")]]]
];

$pageFullPath = GetCurrentPageFullPath();

function BuildUrlWithAnchor($pageFullPath, $anchor) {
  return $pageFullPath . '#' . $anchor;  
}
?>

<body>

<?php HTML_HEADER(); ?>

<main role="main">
  <section class="section">
    <h1><?= T("faqTitle") ?></h1>
    <p class="preface"><?= T("faqPreface") ?></p>

    <?php foreach ($sections as $s) : ?>
      <div class="faq-summary-section">
        <h2 class="faq-summary-section__h2">
          <a href="<?= BuildUrlWithAnchor($pageFullPath, $s['anchor']) ?>">
            <?= $s['sectionName'] ?>
          </a>
        </h2>
        <ul class="faq-summary-section__list">
          <?php foreach ($s['questions'] as $q) : ?>
            <li class="faq-summary-section__question">
              <a href="<?= BuildUrlWithAnchor($pageFullPath, $q['anchor']) ?>">
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
