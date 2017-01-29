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

// Load translations from external file to global variable.
$translations = json_decode(file_get_contents(dirname(__FILE__)."/../strings.json"), true);
if ($translations === NULL || json_last_error() != JSON_ERROR_NONE) exit(json_last_error_msg() . ": strings.json can not be loaded.");

// Returns translated string if translation is present, otherwise
// returns translation in default language if translation is absent, otherwise
// returns the key itself.
function T($key, $lang = LANG) {
  global $translations;

  // Bad: given key is not translated at all. Use it as a translation.
  if (!array_key_exists($key, $translations)) return $key;
  // Good: we have a translation for given language.
  if (array_key_exists($lang, $translations[$key])) return $translations[$key][$lang];
  // Bad: default language translation is missing. Key is used by default.
  if ($lang == $defaultLanguage) return $key;
  // Not good: translation is missing but at least we have a default one.
  if (array_key_exists($defaultLanguage, $translations[$key])) return $translations[$key][$defaultLanguage];
  // Bad: both target and default language translations are missing. Key is used by default.
  return $key;
}

// Prints translated string.
function TR($key) {
  echo T($key);
}