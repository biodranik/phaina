## Simple PHP site builder with static page generator for Windows, Mac OS X and Linux.

The main idea is to have very simple but flexible development workflow and deployment strategy:

1. Develop site locally using built-in PHP web server (launch `watch` script and go to <http://localhost:8888> in your browser).
2. Generate static web site content (run `build` script) and publish it to [GitHub Pages](https://pages.github.com/) using `deploy` script (or use any other static content delivery service if you wish).
3. Or deploy dynamic PHP site as is and use it with Nginx, Apache or any other web server which works with PHP.
4. SCSS support is also included (`watch` script automatically rebuilds your CSS from SCSS after any changes).
5. Multiple languages are supported, see [strings.json](./strings.json).

## Why PHaina?

**Файна** (pronounced as *ˈfaina*) in Belarusian means *very good*. **PH** stays for PHP, **aina** stays for the *land* in Hawaiian, so *PHP landing* is another good interpretation.

## How it works
Start with reading comments in [config.php](https://github.com/deathbaba/phaina/blob/master/config.php) file and modifying it for your needs.
Custom pages should be added into *www* directory and contain the following code:

```php
<?php require_once(dirname(__FILE__).'/../config.php');
// Required property.
define('TITLE', 'titleTeamPage');
// Optional, to override value from the config.
define('DESCRIPTION', 'metaDescriptionTeamPage');
// Optional, to override value from the config.
define('KEYWORDS', 'metaKeywordsTeamPage');
// Required property.
define('FILE', __FILE__);
// Includes <head> template.
HTML_HEAD(); ?>
<body>
<?php HTML_HEADER() // Menu and logo template in the <header>. ?>
<main role="main">
  <!-- Your page custom content goes below. -->
  <h1><?= T('translatedTitleKey') ?></h1>
  <?php IncludeContent('file_name_in_content_folder') ?>
</main>
<?php HTML_ASIDE() // <aside> template. ?>
<?php HTML_FOOTER() // <footer> template. ?>
</body>
</html>
```

Customized headers, footers and other templates are located at *includes* directory.

Example: [index.php](https://github.com/deathbaba/phaina/blob/master/www/index.php).

### Development/production workflow
It's very easy (and free) to use GitHub for development and GitHub Pages for hosting/production. Please keep in mind that:
- If you use the same repo for development (store site's sources) and for GH Pages hosting your source code should be public. If by any reason you don't want to open your source code, you can always create a separate public GH repo just for the hosting purposes and deploy your static pages there.
- If you want a custom domain for your site then it won't be accessible by HTTPS. The easy (and free) solution here is to [use Cloudflare as a HTTPS proxy](https://blog.cloudflare.com/secure-and-fast-github-pages-with-cloudflare/) or use your own custom hosting.

The same single GitHub repo [can be used](https://help.github.com/articles/user-organization-and-project-pages/) for code development and for publishing/hosting.
- Static html pages can be generated/stored either at the *docs* folder of the *master* branch or at the root of *gh-pages* branch.
- Of course you can always create another separate GitHub Pages repo for hosting purposes only and deploy your site there.

If your site is multilingual and different language versions should be deployed to different domains or subdomains then it's much easier to use a separate GH Pages hosting repo for each subdomain. In this case the main code repo can be used to test your site before going live.

### Requirements
*PHP* should be installed and available in the PATH.
- Optional *git* in the PATH is used by `deploy` script.
- Optional [sassc](https://github.com/sass/sassc) to compile SCSS files into CSS and [fswatch](http://emcrisostomo.github.io/fswatch/) to monitor SCSS modifications and launch ```sassc``` compiler when necessary.

#### Installation: Mac OS X
That's very easy if you have [HomeBrew](http://brew.sh/) installed:
```bash
brew tap homebrew/dupes
brew tap homebrew/versions
brew tap homebrew/php
brew install php71 fswatch sassc
git clone <this repo url> --recursive
```

#### Installation: Windows
- Install [git for Windows](https://git-scm.com/download/win) or [GitHub Desktop](https://desktop.github.com/) and make sure that git.exe is available in your [PATH](http://stackoverflow.com/questions/31167181/adding-git-to-path-variable-cant-find-github-under-appdata-local).
- Download PHP for your platform from [official repo](http://windows.php.net/download/) (Non Thread Safe version fits well).
- ```git clone <this repo url> --recursive``` to use pre-compiled fswatch/sassc binaries in the bin directory/submodule.

In case you will not be able to start php, because of the following error:
>Unable to start the program as VCRUNTIME140.dll is missing on your computer. Try reinstalling the program to fix this problem.

Try to use following thread [php-7-missing-vcruntime140-dll](http://stackoverflow.com/questions/30811668/php-7-missing-vcruntime140-dll) for troubleshooting.

#### Installation: Linux
You can install *php*, *fswatch* and *sassc* packages in any convenient way or use pre-compiled binaries from the *bin* directory (helper scripts are aware of binaries in the PATH). Don't forget about recursive repo checkout to use binaries from *bin*: ```git clone <this repo url> --recursive```

### Site(s) configuration
All important variables and menu should be set up at [config.php](./config.php) in the root.

### Translations
When you use `T('key')` in your code, localized string is taken from any json file in *translations* folder. If it's absent, the key itself is used. This allows flexible approach when you use English string as a key and only add translations for languages other than English.

Example of json translations:
```json
{
  "yourCustomTranslationKeyForTFunction": {
    "comment": "This is a comment for this translation. It is ignored during generation/rendering.",
    "default": "Default translation which is used if language is missing.",
    "en":"English Translation",
    "be":"Тэкст на мове (text in Belarusian)"
  },
  "Menu": {
    "comment": "Неre the key itself (`Menu`) is a default English translation.",
    "ru": "Меню"
  }
}
```

If you prefer in-place translations, that's easy:
```php
// First translation ('en') is used as a default one if language is missing.
T(['en'=>'English', 'ru'=>'Русский', 'de'=>'Deutch']);
```

### Why another static generator?
I didn't found any static generators to simplify building sites with *different* and *unique* pages. Most of them are focused on templated blogs or any other cases when you don't need custom layout for each page (e.g. you mostly edit *content only*, not *layout and content together*).

### Unit Tests
All [PHPUnit](https://phpunit.de/) tests are located in the [tests](./tests) directory. All tests should end with `Test.php` in their file name. Tests are launched by `phpunit tests` command from the repo's root.

### Under the hood
Proposed workflow uses gh-pages branch in the same repository to serve static pages.

Alternative approach is to use *docs* directory from the *master* branch to publish web site. To do that you need to remove *docs* directory from *.gitignore* and change your GitHub Pages repository settings (and modify `deploy` script).

#### Manual initialization of gh-pages branch
You need to create a copy of the same repository (but with gh-pages branch instead of master) in the docs directory:
```bash
mkdir docs
cd docs
git clone git@github.com:YOURNAME/YOURREPO.git
git checkout --orphan gh-pages
git rm -rf .
touch README.md
git add README.md
git commit -m 'Initial gh-pages commit.'
git push -u origin gh-pages
git branch -d master
```

#### Generate static pages
To generate static pages in the docs directory:
```$ php generate.php www docs``` or better launch `build` script which also rebuilds CSS file from SCSS.

#### Clean up Google Docs html
There is an utility script in [tools/fix_google_doc.php](./tools/fix_google_doc.php) which cleans HTML exported from Google Docs and prepares it for publishing.
```$ php tools/fix_google_doc.php input_gdoc.html clean_output.html [optional path to tidy binary]```
Optional tidy path is useful if you don't have it in your PATH and would like to use *bin* repository submodule.

#### Notes
- php files in www directory can be either loaded/accessed directly or via [index.php](./www/index.php) routing.
- Github permanently redirects /uri to /uri/ so it makes sense to always use /links/ instead of /links.
- TODO: Sitemap.
- TODO: Easy configuration.

