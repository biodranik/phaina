<?php require(dirname(__FILE__)."/../main.php");
// Set HTTP "404 Not found" code for this page.
// TODO: Probably it can be moved to the main.php.
http_response_code(404);
?>
<!DOCTYPE html>
<html lang="<?php echo LANG; ?>">
<head>
  <title><?php T("titleOf404Page"); ?></title>
  <?php HTML_HEAD(); ?>
</head>
<body>
<?php HTML_HEADER(); ?>

<p><?php T("404pageText"); ?></p>

<?php HTML_FOOTER(); ?>
</body>
</html>
