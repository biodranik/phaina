<?php
// Loads strings from files in 'translations' folder. Each file is UTF-8 JSON like this:
// {
//   "title":{
//     "en":"Title in English",
//     "ru":"Заголовок по-русски"
//   },
//   "key":{
//     "en":"Default translation language is set in the config.php."
//   },
//   "Valid English String":{
//     "en_US":"Valid English String above will be used if string in default language is missing."
//   },
//   "copyright":{
//     "default":"Will be used for every language except be (see next line)",
//     "be":"© 2017 Мiнск, Беларусь"
//   }
// }

// Used if translation for required language is missing.
define('DEFAULT_LANGUAGE', 'default');

// Load all strings to the global variable $TRANSLATIONS.
$TRANSLATIONS = LoadTranslations(dirname(__FILE__).'/../translations/');

function LoadTranslations($fromDir) {
  $allTranslations = [];
  foreach (glob($fromDir . '*.json') as $file) {
    $arr = json_decode(file_get_contents($file), true);
    if ($arr === NULL || json_last_error() != JSON_ERROR_NONE) {
      exit("Error loading $file: " . json_last_error_msg());
    }
    // Filter comments and check for duplicates while merging.
    foreach ($arr as $key => $translations) {
      if (array_key_exists($key, $allTranslations)) exit("Error: duplicate translation '$key' in $file.");
      $withoutComment = array_filter($translations, function($lang) { return $lang !== 'comment'; }, ARRAY_FILTER_USE_KEY);
      if (empty($withoutComment)) continue;
      $allTranslations[$key] = $withoutComment;
    }
  }
  return $allTranslations;
}

// Returns translated string if translation is present, otherwise
// returns translation in default language if translation is absent, otherwise
// returns the key itself.
function T($key, $lang = LANG) {
  global $TRANSLATIONS;

  // Bad: given key is not translated at all. Use it as a translation.
  if (!array_key_exists($key, $TRANSLATIONS)) return $key;
  // Good: we have a translation for given language.
  if (array_key_exists($lang, $TRANSLATIONS[$key])) return $TRANSLATIONS[$key][$lang];
  // Bad: default language translation is missing. Key is used by default.
  if ($lang == DEFAULT_LANGUAGE) return $key;
  // Not good: translation is missing but at least we have a default one.
  if (array_key_exists(DEFAULT_LANGUAGE, $TRANSLATIONS[$key])) return $TRANSLATIONS[$key][DEFAULT_LANGUAGE];
  // Bad: both target and default language translations are missing. Key is used by default.
  return $key;
}

// Prints translated string.
function TR($key) {
  echo T($key);
}
