<?php
// Translates interface strings from UTF-8 strings.json file in the following format:
// {
//   "title":{
//     "en":"Title in English",
//     "ru":"Заголовок по-русски"
//   },
//   "key":{
//     "en":"Default English translation with other translations missing."
//   }
// }

// Load all strings to the global variable $TRANSLATIONS.
$TRANSLATIONS = json_decode(file_get_contents(dirname(__FILE__)."/../translations/strings.json"), true);
if ($TRANSLATIONS === NULL || json_last_error() != JSON_ERROR_NONE) exit(json_last_error_msg() . ": strings.json can not be loaded.");

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
  if ($lang == $defaultLanguage) return $key;
  // Not good: translation is missing but at least we have a default one.
  if (array_key_exists($defaultLanguage, $TRANSLATIONS[$key])) return $TRANSLATIONS[$key][$defaultLanguage];
  // Bad: both target and default language translations are missing. Key is used by default.
  return $key;
}

// Prints translated string.
function TR($key) {
  echo T($key);
}