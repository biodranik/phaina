== Simple php landing page with optional static site generation

== Requirements
* PHP should be installed.
* *php-fpm* + *nginx* are needed for dynamic workflow.
* *sassc* is needed to build css from sass.
* Please check nginx config and some vars in include/global.php

To generate static pages in the docs folder:
```$ php generate.php www docs```

=== Notes ===
* Translations are stored in strings.json (separate folder with mergeable translation files could be better).
* php files in www are loaded directly or via index.php routing (compare REQUEST_URI with existing pages).
* Github permanently redirects /uri to /uri/ so it makes sense to always use /links/ instead of /links.
* TODO: Sitemap.
* TODO: Windows workflow (sassc, php).
* TODO: Easy configuration.
