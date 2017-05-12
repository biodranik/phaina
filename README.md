## Simple PHP site builder with static page generator for Windows, Mac OS X and Linux.

The main idea is to have very simple but flexible development workflow and deployment strategy:

1. Develop site locally using built-in PHP web server (launch `watch` script and go to <http://localhost:8888> in your browser).
2. Generate static web site content (run `build` script) and publish it to [GitHub Pages](https://pages.github.com/) using `deploy` script (or use any other static content delivery service if you wish).
3. Deploy PHP site as is and use it with Nginx, Apache or any other web server which works with PHP.
4. SCSS support is also included (`watch` script automatically rebuilds your CSS from SCSS after any changes).
5. Multiple languages are supported, see [strings.json](./strings.json).

## Why PHaina?

**Файна** (pronounced as *ˈfaina*) in Belarusian means *very good*. **PH** stays for PHP, **aina** stays for the *land* in Hawaiian, so *PHP landing* is another good interpretation.

## How it works
*TODO: Update this section*
Let's pick "team" page for example to see how it works. Pages of your site are defined in [config.php](https://github.com/deathbaba/landing-php/blob/master/config.php) `$PAGES` array. There is an entry `team.php` in `$PAGES` that defines "team" page:

```
'team.php' => [
  'link' => 'team',
  'menu' => 'menuTeamPage',
  'title' => 'titleTeamPage',
  'description' => 'metaDescriptionTeamPage',
  'keywords' => 'metaKeywordsTeamPage'
],
```
Such configuration indicates that "team" page will have url `yoursite.com/team`, menu `menuTeamPage`, title `titleTeamPage` and also description and keywords. `menuTeamPage`, `titleTeamPage` and other properties are defined in [translations/team.json](https://github.com/deathbaba/landing-php/blob/master/translations/team.json).
The "team" page itself is located at [www/team.php](https://github.com/deathbaba/landing-php/blob/master/www/team.php) and its first part contains all the data that page displays:

```
[
  'img' => 'img/team/Igor_Davydov.jpg',
  'name' => T('Igor Davydov'),
  'title' => T('idavydovTitle'),
  'description' => T('idavydovDescription')
]
```
This entry describes team member with image path, name, title and description. Last three properties' content is defined also in [translations/team.json](https://github.com/deathbaba/landing-php/blob/master/translations/team.json). Let's take a closer look at these properties:
```
"titleTeamPage":{
  "en":"VibroBox Team: Scientists and engineers from Minsk, Belarus.",
  "ru":"Команда VibroBox: Учёные и инженеры из Минска."
},
"menuTeamPage":{
  "en":"Team",
  "ru":"Команда"
},
...
```
As you can see it's not only content is defined, but it's also defined for two languages (hence `translations` directory name).

This is the example for "team" page, for other pages data structure could be different (e.g. see [index.php](https://github.com/deathbaba/landing-php/blob/master/www/index.php) or absent at all: [404.php](https://github.com/deathbaba/landing-php/blob/master/www/404.php))
"Team" page second part describes how the information should be presented (i.e. contains layout):

```
<div class="team-container">
  <?php foreach ($team as $m) : ?>
    <div class="team-member">
      <img class="team-member__img" src="<?= URL($m['img']) ?>" alt="<?= $m['name'] ?>" />
      <div class="team-member__description">
        <h3 class="team-member__name"><?= $m['name'] ?></h3>
        <h4 class="team-member__title"><?= $m['title'] ?></h4>
        <p><?= $m['description'] ?></p>
      </div>
    </div>
  <?php endforeach; ?>
</div>
```
For more complex example with several sections and different layouts of each section please take a look at [index.php](https://github.com/deathbaba/landing-php/blob/master/www/index.php).

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

### Site configuration
All important variables and menu should be set up at [config.php](./config.php) in the root.

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
- Translations are stored in [strings.json](./strings.json). TODO: separate directory with mergeable translation files could be better.
- php files in www directory can be either loaded/accessed directly or via [index.php](./www/index.php) routing.
- Github permanently redirects /uri to /uri/ so it makes sense to always use /links/ instead of /links.
- TODO: Sitemap.
- TODO: Easy configuration.

