## Simple PHP site builder with static page generator for Windows, Mac OS X and Linux.

The main idea is to have very simple but flexible development workflow and deployment strategy:

1. Develop site locally using built-in PHP web server (launch ```watch``` script and go to <http://localhost:8888> in your browser).
2. Generate static web site content (run ```build``` script) and publish it to [GitHub Pages](https://pages.github.com/) using ```deploy``` script (or use any other static content delivery service if you wish).
3. Deploy PHP site as is and use it with Nginx, Apache or any other web server which works with PHP.
4. SCSS support is also included (```watch``` script automatically rebuilds your CSS from SCSS after any changes).
5. Multiple languages are supported, see [strings.json](./strings.json).

### Requirements
*PHP* should be installed and available in the PATH.
- Optional *git* in the PATH is used by ```deploy``` script.
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
- ```git clone <this repo url> --recursive``` to use pre-compiled fswatch/sassc binaries in the bin folder/submodule.

In case you will not be able to start php, because of the following error:
>Unable to start the program as VCRUNTIME140.dll is missing on your computer. Try reinstalling the program to fix this problem.

Try to use following thread [php-7-missing-vcruntime140-dll](http://stackoverflow.com/questions/30811668/php-7-missing-vcruntime140-dll) for troubleshooting.

#### Installation: Linux
You can install *php*, *fswatch* and *sassc* packages in any convenient way or use pre-compiled binaries from the *bin* folder (helper scripts are aware of binaries in the PATH). Don't forget about recursive repo checkout to use binaries from *bin*: ```git clone <this repo url> --recursive```

### Site configuration
All important variables and menu should be set up at [config.php](./config.php) in the root.

### Why another static generator?
I didn't found any static generators to simplify building sites with *different* and *unique* pages. Most of them are focused on templated blogs or any other cases when you don't need custom layout for each page (e.g. you mostly edit *content only*, not *layout and content together*).

### Under the hood
Proposed workflow uses gh-pages branch in the same repository to serve static pages.

Alternative approach is to use *docs* folder from the *master* branch to publish web site. To do that you need to remove *docs* folder from *.gitignore* and change your GitHub Pages repository settings (and modify ```deploy``` script).

#### Manual initialization of gh-pages branch
You need to create a copy of the same repository (but with gh-pages branch instead of master) in the docs folder:
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
To generate static pages in the docs folder:
```$ php generate.php www docs``` or better launch ```build``` script which also rebuilds CSS file from SCSS.

#### Notes
- Translations are stored in [strings.json](./strings.json). TODO: separate folder with mergeable translation files could be better.
- php files in www directory can be either loaded/accessed directly or via [index.php](./www/index.php) routing.
- Github permanently redirects /uri to /uri/ so it makes sense to always use /links/ instead of /links.
- TODO: Sitemap.
- TODO: Easy configuration.
