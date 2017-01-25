<?php
// This include should be used only if you want pretty urls and web server
// routes all requests to index.php.
// Possible implementation for nginx:
// location / {
//    # Serve static content first, use php as a last resort.
//    try_files $uri $uri/ /index.php$is_args$args;
//  }
// TODO: Probably it can be moved to the main.php.
require(dirname(__FILE__)."/../include/uri_routing.php");
require(dirname(__FILE__)."/../main.php");
?>
<!DOCTYPE html>
<html lang="<?php echo LANG; ?>">
<head>
<title><?php T("titleOfIndexPage"); ?></title>
<?php HTML_HEAD(); ?>
</head>
<body>

<?php HTML_HEADER(); ?>

<main role="main">
TODO: index.php
</main>

<?php HTML_FOOTER(); ?>

</body>
</html>
