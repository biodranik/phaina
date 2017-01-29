<?php
  require(dirname(__FILE__).'/../config.php');
  // Set HTTP "404 Not found" code for this page.
  // TODO: Probably it can be moved to the config.php.
  http_response_code(404);
  HTML_HEAD();
?>

<body>
<?php HTML_HEADER(); ?>

<p><?php T("404pageText"); ?></p>

<?php HTML_FOOTER(); ?>
</body>
</html>
