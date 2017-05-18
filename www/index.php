<?php
// This include should be the first one in every site's php page.
require_once(dirname(__FILE__).'/../config.php');

// This include should be used only if you want pretty urls and only if web server
// routes all requests to index.php.
//
// Built-in PHP server (which is used for development) routes all requests to index.php by default.
//
// Possible implementation for nginx:
// location / {
//    # Serve static content first, use php as a last resort.
//    try_files $uri $uri/ /index.php$is_args$args;
//  }
// TODO: Move this include to the config.php.
require(dirname(__FILE__).'/../include/uri_routing.php');

// Page properties in the index file should be after the routing.
define('TITLE', 'titleIndexPage');
define('FILE', __FILE__);
define('META', [
  ['property' => 'og:image', 'content' => URL('img/logo.png')]
]);

HTML_HEAD();
?>

<body>
<?php HTML_HEADER(); ?>

<main role="main" class="index">
  <section class="index__banner">
    <h1 class="index__title"><?= T('indexH1') ?></h1>
    <p class="preface"><?= T('indexPreface') ?></p>
  </section>
  <section class="index__content">
    <?= IncludeContent('index') ?>
    <a class="index__button" href="https://github.com/deathbaba/phaina" title=<?= T('codeAndDocs') ?>><?= T('codeAndDocs') ?></a>
  </section>
</main>

<?php HTML_ASIDE(); ?>
<?php HTML_FOOTER(); ?>

</body>
</html>
