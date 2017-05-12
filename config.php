<?php
/* Must be included by inserting <?php require_once("../config.php"); ?>
   at the top of every page in www directory.
*/
// Site language which is used in <html lang="…"> attributes and for translations.
// TODO(Alex): Generate all supported languages from one launch, without editing this constant.
define('LANG', 'ru');

// Production base urls, also used for static pages generation.
// Please use BaseURL() function instead of direct access, it makes development easier.
// Url for current active language will be treated as base url.
define('LANG_SITES', [
//  'en' => 'https://www.vibrobox.com/',
  'ru' => 'https://deathbaba.github.io/phaina/']);
//define('GOOGLE_ANALYTICS_ID', 'UA-79782596-1');

// Translation defines for meta keywords and meta description if they are not customized in $PAGES.
define('DEFAULT_META_DESCRIPTION', 'metaDescriptionIndexPage');
define('DEFAULT_META_KEYWORDS', 'metaKeywordsIndexPage');

// Any custom constants can be defined here too.
define('CODE_AND_DOCS_URL', 'https://github.com/deathbaba/phaina');

require_once('include/globals.php');
require_once('include/strings.php');
require_once('include/file_system.php');

// TODO: Support direct html links in the menu.
define('MENU', [
    'index.php' => 'menuIndexPage',
  ]);

?>
